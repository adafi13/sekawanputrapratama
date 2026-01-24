// Preloader Handler with Fade Out Effect
window.addEventListener('load', function() {
    const preloader = document.getElementById('preloader');
    if(preloader) {
        setTimeout(() => {
            preloader.style.transition = 'opacity 0.6s ease';
            preloader.style.opacity = '0';
            setTimeout(() => preloader.style.display = 'none', 600);
        }, 1000); // Tahan loading sedikit biar logo terlihat
    }
});

// Sticky Header Script
$(window).scroll(function() {
    if ($(this).scrollTop() > 30) {
        $('#main-header').addClass('sticky');
    } else {
        $('#main-header').removeClass('sticky');
    }
});

function open_preloader() {
    const preloader = document.getElementById('preloader');
    if(preloader) {
        // Hapus semua inline style, kembalikan ke kondisi awal
        preloader.removeAttribute('style');
    }
}
