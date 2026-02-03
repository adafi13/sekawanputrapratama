

<?php $__env->startSection('title', 'Halaman Tidak Ditemukan - Sekawan Putra Pratama'); ?>

<?php $__env->startSection('content'); ?>
<section class="error-section text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="error-title" style="font-size: 150px; font-weight: 900; line-height: 1; background: linear-gradient(45deg, #FFF, #666); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 24px;">404</h1>
                <h2 class="white mb-24">Halaman Tidak Ditemukan</h2>
                <p class="medium-gray mb-48">
                    Maaf, halaman yang Anda cari mungkin telah dihapus, <br> 
                    namanya diubah, atau sedang tidak tersedia untuk sementara waktu.
                </p>
                <a href="<?php echo e(route('home')); ?>" class="cus-btn">
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SPP\resources\views/errors/404.blade.php ENDPATH**/ ?>