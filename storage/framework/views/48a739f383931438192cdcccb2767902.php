<?php $__env->startSection('title', 'Blog & Artikel IT Terkini | Tips & Tutorial - Sekawan Putra Pratama'); ?>
<?php $__env->startSection('meta_description', 'Baca artikel terbaru seputar teknologi, tutorial programming, tips IT, dan tren digital. Update mingguan dari expert IT berpengalaman.'); ?>
<?php $__env->startSection('meta_keywords', 'blog IT, artikel teknologi, tutorial programming, tips website, tutorial aplikasi mobile, berita IT terkini'); ?>

<?php $__env->startSection('content'); ?>

<section class="position-relative py-5 overflow-hidden d-flex align-items-center" style="min-height: 400px; background-color: #0F172A;">
    <div class="position-absolute top-0 start-0 w-100 h-100">
        <div class="position-absolute" style="bottom: -10%; right: -5%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, rgba(0,0,0,0) 70%); filter: blur(80px);"></div>
        <div class="position-absolute w-100 h-100" style="background-image: radial-gradient(rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 30px 30px; opacity: 0.5;"></div>
    </div>

    <div class="container position-relative z-3 text-center">
        <span class="d-inline-flex align-items-center px-3 py-2 rounded-pill border border-white border-opacity-10 mb-4" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px);">
            <i class="fas fa-pen-nib text-primary me-2"></i>
            <span class="small fw-bold text-white-50 text-uppercase tracking-widest">Wawasan & Berita</span>
        </span>
        <h1 class="display-4 fw-bold text-white mb-3">Blog <span class="gradient-text">Teknologi</span></h1>
        <p class="lead text-secondary mx-auto" style="max-width: 600px; font-weight: 300;">
            Temukan artikel terbaru seputar pengembangan software, infrastruktur jaringan, dan tren digital masa depan.
        </p>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-lg-4">
        
        
        <div class="d-flex justify-content-center mb-5 animate-up">
            <div class="filter-scroll-wrapper p-2 bg-light rounded-pill d-inline-flex flex-nowrap gap-1 border shadow-sm" style="max-width: fit-content;">
                <button class="btn btn-filter <?php echo e(!request('category') ? 'active' : ''); ?> rounded-pill px-4 py-2 fw-bold small text-nowrap" data-filter="">Semua Artikel</button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button class="btn btn-filter <?php echo e(request('category') == $cat->slug ? 'active' : ''); ?> rounded-pill px-4 py-2 fw-bold small text-nowrap" data-filter="<?php echo e($cat->slug); ?>"><?php echo e($cat->name); ?></button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredPost && !request()->has('search') && !request()->has('category')): ?>
        <div class="row g-4 mb-5">
            <div class="col-12 blog-item" data-category="<?php echo e($featuredPost->category ? $featuredPost->category->slug : ''); ?>" style="opacity: 1; transition: opacity 0.3s ease;">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden blog-card featured">
                    <div class="row g-0">
                        <div class="col-md-6 position-relative">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredPost->featured_image): ?>
                                <img src="<?php echo e(Storage::url($featuredPost->featured_image)); ?>" class="h-100 w-100 object-fit-cover" alt="<?php echo e($featuredPost->title); ?>">
                            <?php else: ?>
                                <div class="h-100 w-100 bg-gradient d-flex align-items-center justify-content-center" style="min-height: 400px;">
                                    <i class="fas fa-newspaper fa-5x text-white opacity-25"></i>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div class="position-absolute top-0 start-0 p-3">
                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                    <i class="fas fa-fire me-1"></i> Featured
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 p-4 p-lg-5 d-flex flex-column justify-content-center">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredPost->category): ?>
                                <small class="text-primary fw-bold text-uppercase mb-2"><?php echo e($featuredPost->category->name); ?></small>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <h2 class="fw-bold text-dark mb-3">
                                <a href="<?php echo e(route('blog.show', $featuredPost->slug)); ?>" class="text-decoration-none text-dark hover-primary">
                                    <?php echo e($featuredPost->title); ?>

                                </a>
                            </h2>
                            <p class="text-muted mb-4"><?php echo e(Str::limit($featuredPost->excerpt, 150)); ?></p>
                            <div class="d-flex align-items-center mt-auto">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold small text-dark"><?php echo e($featuredPost->author->name ?? 'Admin'); ?></p>
                                    <small class="text-muted">
                                        <i class="far fa-calendar me-1"></i>
                                        <?php echo e($featuredPost->published_at->format('d M Y')); ?>

                                        <span class="mx-2">•</span>
                                        <i class="far fa-eye me-1"></i>
                                        <?php echo e($featuredPost->views); ?> views
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="row g-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-12 blog-item" data-category="<?php echo e($blog->category ? $blog->category->slug : ''); ?>" style="opacity: 1; transition: opacity 0.3s ease;">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden blog-card h-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="position-relative overflow-hidden h-100" style="min-height: 200px;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($blog->featured_image): ?>
                                        <img src="<?php echo e(Storage::url($blog->featured_image)); ?>" class="w-100 h-100 object-fit-cover transition-all" alt="<?php echo e($blog->title); ?>">
                                    <?php else: ?>
                                        <div class="w-100 h-100 bg-gradient d-flex align-items-center justify-content-center">
                                            <i class="fas fa-newspaper fa-3x text-white opacity-25"></i>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-2">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($blog->category): ?>
                                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 me-2"><?php echo e($blog->category->name); ?></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <small class="text-muted">
                                            <i class="far fa-calendar me-1"></i> <?php echo e($blog->published_at->format('d M Y')); ?>

                                        </small>
                                        <small class="text-muted ms-auto">
                                            <i class="far fa-eye me-1"></i> <?php echo e($blog->views ?? 0); ?> views
                                        </small>
                                    </div>
                                    <h5 class="fw-bold mb-2">
                                        <a href="<?php echo e(route('blog.show', $blog->slug)); ?>" class="text-decoration-none text-dark hover-primary">
                                            <?php echo e($blog->title); ?>

                                        </a>
                                    </h5>
                                    <p class="text-muted small mb-3"><?php echo e(Str::limit($blog->excerpt, 150)); ?></p>
                                    <div class="d-flex align-items-center mt-auto">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                <i class="fas fa-user small text-primary"></i>
                                            </div>
                                            <small class="text-muted fw-medium"><?php echo e($blog->author->name ?? 'Admin'); ?></small>
                                        </div>
                                        <a href="<?php echo e(route('blog.show', $blog->slug)); ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3 ms-auto">
                                            Baca Selengkapnya <i class="fas fa-arrow-right ms-1 small"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum ada artikel tersedia</h4>
                        <p class="text-muted">Artikel akan muncul di sini setelah dipublikasikan</p>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($blogs->hasPages()): ?>
        <nav class="mt-5 pt-4">
            <?php echo e($blogs->links('pagination::bootstrap-5')); ?>

        </nav>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</section>


<section class="py-5 bg-light">
    <div class="container">
        <div class="bg-white rounded-5 p-4 p-md-5 border shadow-sm position-relative overflow-hidden">
            <div class="position-absolute start-0 top-0 bottom-0 bg-primary" style="width: 6px;"></div>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">
                    <div class="d-inline-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                            <i class="fas fa-paper-plane text-primary"></i>
                        </div>
                        <span class="fw-bold text-primary text-uppercase small tracking-widest">Newsletter</span>
                    </div>
                    <h2 class="fw-bold text-dark mb-3 display-6">Stay ahead of the curve</h2>
                    <p class="text-muted fs-6 mb-0 pe-lg-5">
                        Dapatkan kurasi berita teknologi dan update project terbaru dari <span class="text-dark fw-semibold">Sekawan Putra Pratama</span> langsung di inbox Anda.
                    </p>
                </div>

                <div class="col-lg-6">
                    <div class="newsletter-box p-2 p-md-3 bg-light rounded-4 border">
                        <form class="row g-2" id="newsletterForm">
                            <?php echo csrf_field(); ?>
                            <div class="col-md-8 col-12">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control border-0 bg-white rounded-3 shadow-none" id="newsletterEmail" placeholder="name@example.com" required>
                                    <label for="newsletterEmail" class="text-muted small">Alamat Email Anda</label>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <button type="submit" id="btnSubscribe" class="btn btn-primary w-100 h-100 py-3 py-md-0 rounded-3 fw-bold transition-all hover-lift">
                                    Subscribe
                                </button>
                            </div>
                        </form>
                    </div>
                    <p class="small text-muted mt-3 text-center text-lg-start">
                        <i class="fas fa-info-circle me-1 opacity-50"></i> Kami menghargai privasi Anda sepenuhnya.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Logic Category Filter ---
        const filters = document.querySelectorAll('.btn-filter');
        const items = document.querySelectorAll('.blog-item');

        filters.forEach(filter => {
            filter.addEventListener('click', function(e) {
                e.preventDefault();
                filters.forEach(f => f.classList.remove('active'));
                this.classList.add('active');

                const category = this.getAttribute('data-filter');

                items.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    if (category === '' || itemCategory === category) {
                        item.style.display = 'block';
                        setTimeout(() => item.style.opacity = '1', 10);
                    } else {
                        item.style.opacity = '0';
                        setTimeout(() => item.style.display = 'none', 300);
                    }
                });
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SPP\resources\views/frontend/blog/index.blade.php ENDPATH**/ ?>