<div id="preloader">
    <div class="darksoul-layout">
        <div class="darksoul-grid">
            <div class="item1"></div>
            <div class="item3"></div>
        </div>
        <h3 class="darksoul-loader-h">Sekawan Putra Pratama</h3>
    </div>
</div>

<script>
    // Optimized preloader - hide as soon as page is ready
    (function() {
        var preloader = document.getElementById('preloader');
        if (!preloader) return;
        
        function hidePreloader() {
            preloader.style.transition = 'opacity 0.3s ease';
            preloader.style.opacity = '0';
            setTimeout(function() {
                preloader.style.display = 'none';
            }, 300);
        }
        
        // Hide immediately if DOM is already loaded
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            setTimeout(hidePreloader, 300);
        } else {
            window.addEventListener('load', function() {
                setTimeout(hidePreloader, 300);
            });
        }
    })();
</script>


