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
    window.addEventListener('load', function() {
        var preloader = document.getElementById('preloader');
        if(preloader) {
            setTimeout(function() {
                preloader.style.transition = 'opacity 0.5s ease';
                preloader.style.opacity = '0';
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 500);
            }, 2000);
        }
    });
</script>

