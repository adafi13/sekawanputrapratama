(() => {
    const isTransparent = (color) => {
        if (!color) {
            return true;
        }

        const normalized = color.replace(/\s+/g, '').toLowerCase();

        return (
            normalized === 'transparent' ||
            normalized === 'rgba(0,0,0,0)' ||
            normalized === '#00000000' ||
            normalized === 'hsla(0,0%,0%,0)'
        );
    };

    const waitForSignaturePad = () =>
        new Promise((resolve, reject) => {
            let attempts = 0;
            const maxAttempts = 120;

            const check = () => {
                if (window.SignaturePad) {
                    resolve(window.SignaturePad);

                    return;
                }

                attempts += 1;

                if (attempts >= maxAttempts) {
                    reject(new Error('SignaturePad library not found.'));

                    return;
                }

                requestAnimationFrame(check);
            };

            check();
        });

    const nextFrame = () => new Promise((resolve) => requestAnimationFrame(resolve));

    const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

    window.signaturePadComponent = function signaturePadComponent(
        penColor = 'black',
        backgroundColor = 'rgba(0,0,0,0)',
        downloadPadding = 12,
    ) {
        return {
            canvas: null,
            signaturePad: null,
            resizeHandler: null,
            resizeObserver: null,
            endStrokeHandler: null,
            downloadPadding: Number.isFinite(downloadPadding) ? Math.max(downloadPadding, 0) : 12,

            async initSignaturePad() {
                try {
                    await waitForSignaturePad();
                } catch (error) {
                    console.error('[filament-signature-pad] SignaturePad library could not be loaded.', error);

                    return;
                }

                this.canvas = this.$refs.canvas;

                this.canvas.style.width = '100%';
                this.canvas.style.height = '100%';

                this.signaturePad = new window.SignaturePad(this.canvas, {
                    penColor,
                    backgroundColor: isTransparent(backgroundColor)
                        ? 'rgba(0,0,0,0)'
                        : backgroundColor,
                });

                this.endStrokeHandler = () => this.updateSignatureValue();
                this.signaturePad.addEventListener('endStroke', this.endStrokeHandler);

                this.resizeHandler = () => this.resizeCanvas();
                window.addEventListener('resize', this.resizeHandler);

                if (window.ResizeObserver) {
                    this.resizeObserver = new ResizeObserver(() => this.resizeCanvas());
                    this.resizeObserver.observe(this.$refs.canvasContainer ?? this.canvas);
                }

                await nextFrame();
                this.resizeCanvas();

                const initialValue = this.$refs.input.value;

                if (initialValue) {
                    this.restoreFromDataUrl(initialValue, true);
                } else if (!isTransparent(backgroundColor)) {
                    this.fillBackground();
                }
            },

            fillBackground() {
                if (isTransparent(backgroundColor) || !this.canvas) {
                    return;
                }

                const context = this.canvas.getContext('2d');
                const rect = (this.$refs.canvasContainer ?? this.canvas).getBoundingClientRect();

                context.save();
                context.globalCompositeOperation = 'destination-over';
                context.fillStyle = backgroundColor;
                context.fillRect(0, 0, rect.width, rect.height);
                context.restore();
            },

            resizeCanvas() {
                if (!this.signaturePad) {
                    return;
                }

                const container = this.$refs.canvasContainer ?? this.canvas;
                const rect = container.getBoundingClientRect();

                if (!rect.width || !rect.height) {
                    return;
                }

                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                const existingData = this.signaturePad.isEmpty() ? null : this.signaturePad.toData();

                this.canvas.width = rect.width * ratio;
                this.canvas.height = rect.height * ratio;

                const context = this.canvas.getContext('2d');
                context.setTransform(1, 0, 0, 1, 0, 0);
                context.scale(ratio, ratio);

                this.signaturePad.clear();

                if (existingData && existingData.length) {
                    this.signaturePad.fromData(existingData);
                } else if (!isTransparent(backgroundColor)) {
                    this.fillBackground();
                }
            },

            updateSignatureValue() {
                if (!this.signaturePad) {
                    return;
                }

                const value = this.signaturePad.isEmpty()
                    ? ''
                    : this.signaturePad.toDataURL('image/png');

                this.$refs.input.value = value;
                this.$refs.input.dispatchEvent(new Event('input', { bubbles: true }));
            },

            clearPad() {
                if (!this.signaturePad) {
                    return;
                }

                this.signaturePad.clear();

                if (!isTransparent(backgroundColor)) {
                    this.fillBackground();
                }

                this.updateSignatureValue();
            },

            downloadImage() {
                if (!this.signaturePad || this.signaturePad.isEmpty()) {
                    return;
                }

                const bounds = this.getSignatureBounds();

                if (!bounds) {
                    return;
                }

                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                const width = Math.max(bounds.width, 1);
                const height = Math.max(bounds.height, 1);

                const exportCanvas = document.createElement('canvas');
                exportCanvas.width = Math.ceil(width * ratio);
                exportCanvas.height = Math.ceil(height * ratio);

                const exportContext = exportCanvas.getContext('2d');

                if (!isTransparent(backgroundColor)) {
                    exportContext.fillStyle = backgroundColor;
                    exportContext.fillRect(0, 0, exportCanvas.width, exportCanvas.height);
                }

                exportContext.drawImage(
                    this.canvas,
                    Math.floor(bounds.x * ratio),
                    Math.floor(bounds.y * ratio),
                    Math.ceil(width * ratio),
                    Math.ceil(height * ratio),
                    0,
                    0,
                    exportCanvas.width,
                    exportCanvas.height,
                );

                const triggerDownload = (url, revokeAfter = null) => {
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = 'signature.png';
                    link.rel = 'noopener';
                    link.click();

                    if (revokeAfter) {
                        setTimeout(() => URL.revokeObjectURL(url), revokeAfter);
                    }
                };

                if (exportCanvas.toBlob) {
                    exportCanvas.toBlob((blob) => {
                        if (!blob) {
                            return;
                        }

                        const objectUrl = URL.createObjectURL(blob);
                        triggerDownload(objectUrl, 2_000);
                    }, 'image/png');
                } else {
                    triggerDownload(exportCanvas.toDataURL('image/png'));
                }
            },

            restoreFromDataUrl(dataUrl, silent = false) {
                if (!this.signaturePad || !dataUrl) {
                    return;
                }

                try {
                    this.signaturePad.fromDataURL(dataUrl, {
                        ratio: Math.max(window.devicePixelRatio || 1, 1),
                    });
                } catch (error) {
                    console.warn('[filament-signature-pad] Unable to restore signature from data URL.', error);
                }

                if (!silent) {
                    this.updateSignatureValue();
                }
            },

            destroy() {
                if (this.resizeHandler) {
                    window.removeEventListener('resize', this.resizeHandler);
                    this.resizeHandler = null;
                }

                if (this.resizeObserver) {
                    this.resizeObserver.disconnect();
                    this.resizeObserver = null;
                }

                if (this.signaturePad && this.endStrokeHandler) {
                    this.signaturePad.removeEventListener('endStroke', this.endStrokeHandler);
                    this.endStrokeHandler = null;
                }

                this.signaturePad = null;
            },

            getSignatureBounds() {
                const data = this.signaturePad?.toData?.();

                if (!data || !data.length) {
                    return null;
                }

                let minX = Number.POSITIVE_INFINITY;
                let minY = Number.POSITIVE_INFINITY;
                let maxX = Number.NEGATIVE_INFINITY;
                let maxY = Number.NEGATIVE_INFINITY;

                for (const stroke of data) {
                    if (!stroke?.points?.length) {
                        continue;
                    }

                    for (const point of stroke.points) {
                        minX = Math.min(minX, point.x);
                        minY = Math.min(minY, point.y);
                        maxX = Math.max(maxX, point.x);
                        maxY = Math.max(maxY, point.y);
                    }
                }

                if (!Number.isFinite(minX) || !Number.isFinite(minY)) {
                    return null;
                }

                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                const canvasWidth = this.canvas.width / ratio;
                const canvasHeight = this.canvas.height / ratio;

                const padding = this.downloadPadding;
                const startX = clamp(minX - padding, 0, canvasWidth);
                const startY = clamp(minY - padding, 0, canvasHeight);
                const endX = clamp(maxX + padding, 0, canvasWidth);
                const endY = clamp(maxY + padding, 0, canvasHeight);

                return {
                    x: Math.floor(startX),
                    y: Math.floor(startY),
                    width: Math.ceil(Math.max(endX - startX, 1)),
                    height: Math.ceil(Math.max(endY - startY, 1)),
                };
            },
        };
    };
})();
