<li><a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" onclick="open_preloader()">Home</a></li>
<li><a href="<?php echo e(route('about')); ?>" class="<?php echo e(request()->routeIs('about') ? 'active' : ''); ?>" onclick="open_preloader()">About Us</a></li>
<li><a href="<?php echo e(route('services.index')); ?>" class="<?php echo e(request()->routeIs('services.*') ? 'active' : ''); ?>" onclick="open_preloader()">Services</a></li>
<li><a href="<?php echo e(route('portfolio.index')); ?>" class="<?php echo e(request()->routeIs('portfolio.*') ? 'active' : ''); ?>" onclick="open_preloader()">Portfolio</a></li>
<li><a href="<?php echo e(route('blog.index')); ?>" class="<?php echo e(request()->routeIs('blog.*') ? 'active' : ''); ?>" onclick="open_preloader()">Blog</a></li>
<li><a href="<?php echo e(route('contact')); ?>" class="<?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>" onclick="open_preloader()">Contact</a></li>
<?php /**PATH C:\laragon\www\SPP\resources\views/frontend/layouts/menu-links.blade.php ENDPATH**/ ?>