<script type="text/javascript" src="https://www.gstatic.com/cv/js/sender/v1/cast_sender.js?loadCastFramework=1"></script>
<script>
    window.SILVERMINE_VIDEOJS_CHROMECAST_CONFIG = {
        preloadWebComponents: true,
    };
</script>
<script src="<?php echo $global['webSiteRootURL'] ?>plugin/Chromecast/videojs-chromecast/silvermine-videojs-chromecast.js" type="text/javascript"></script>
<script>
        var options;

        options = {
            controls: true,
            techOrder: ['chromecast', 'html5'], // You may have more Tech, such as Flash or HLS
            plugins: {
                chromecast: {}
            }
        };

        videojs('mainVideo', options);
    $(document).ready(function () {

        if (typeof player === 'undefined') {
            player = videojs('mainVideo');
        }
        player.chromecast();
    });
</script>