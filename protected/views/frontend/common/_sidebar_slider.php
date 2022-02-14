<div id="layerslider_widget-2" class="widget layerslider_widget">
    <script src="/assets/plugins/LayerSlider/js/layerslider.kreaturamedia.jquery.js"></script>
    <script src="/assets/plugins/LayerSlider/js/jquery-easing-1.3.js"></script>
    <script src="/assets/plugins/LayerSlider/js/jquerytransit.js"></script>
    <script>
        var lsjQuery = jQuery.noConflict();
        lsjQuery(document).ready(function() {
            if(typeof lsjQuery.fn.layerSlider == "undefined") { lsShowNotice('jquery'); }
            else if(typeof jQuery.transit == "undefined" || typeof jQuery.transit.modifiedForLayerSlider == "undefined") { lsShowNotice('transit'); }
            else {
                lsjQuery("#layerslider_1").layerSlider({
                    width : '245px',
                    height : '200px',
                    responsive : false,
                    responsiveUnder : 0,
                    sublayerContainer : 0,
                    autoStart : true,
                    pauseOnHover : true,
                    firstLayer : 1,
                    animateFirstLayer : true,
                    randomSlideshow : false,
                    twoWaySlideshow : true,
                    loops : 0,
                    forceLoopNum : true,
                    autoPlayVideos : true,
                    autoPauseSlideshow : 'auto',
                    youtubePreview : 'maxresdefault.jpg',
                    keybNav : false,
                    touchNav : false,
                    skin : 'defaultskin',
                    skinsPath : '/assets/plugins/LayerSlider/skins/',
                    globalBGColor : '#ffffff',
                    navPrevNext : false,
                    navStartStop : false,
                    navButtons : false,
                    hoverPrevNext : false,
                    hoverBottomNav : false,
                    thumbnailNavigation : 'disabled',
                    tnWidth : 100,
                    tnHeight : 60,
                    tnContainerWidth : '60%',
                    tnActiveOpacity : 35,
                    tnInactiveOpacity : 100,
                    imgPreload : true,
                    yourLogo : false,
                    yourLogoStyle : 'left: 10px; top: 10px;',
                    yourLogoLink : false,
                    yourLogoTarget : '_self',
                    cbInit : function(element) { },
                    cbStart : function(data) { },
                    cbStop : function(data) { },
                    cbPause : function(data) { },
                    cbAnimStart : function(data) { },
                    cbAnimStop : function(data) { },
                    cbPrev : function(data) { },
                    cbNext : function(data) { }
                });
            }
        });
    </script>
    <div id="layerslider_1" class="ls-wp-container" style="width: 245px; height: 200px; margin: 0px auto; margin-bottom:15px;">
        <div class="ls-layer"  style="slidedirection: right; slidedelay: 3000; durationin: 1500; durationout: 1500; easingin: easeInOutQuint; easingout: easeInOutQuint; delayin: 0; delayout: 0; timeshift: 0; transition2d: all; transition3d: all; "><img src="/assets/uploads/2014/03/sidebar-04.jpg" class="ls-bg"></div>
        <div class="ls-layer"  style="slidedirection: right; slidedelay: 3000; durationin: 1500; durationout: 1500; easingin: easeInOutQuint; easingout: easeInOutQuint; delayin: 0; delayout: 0; timeshift: 0; transition2d: all; transition3d: all; "><img src="/assets/uploads/2014/03/sidebar-03.jpg" class="ls-bg"></div>
        <div class="ls-layer"  style="slidedirection: right; slidedelay: 3000; durationin: 1500; durationout: 1500; easingin: easeInOutQuint; easingout: easeInOutQuint; delayin: 0; delayout: 0; timeshift: 0; transition2d: all; transition3d: all; "><img src="/assets/uploads/2014/03/sidebar-02.jpg" class="ls-bg"></div>
        <div class="ls-layer"  style="slidedirection: right; slidedelay: 3000; durationin: 1500; durationout: 1500; easingin: easeInOutQuint; easingout: easeInOutQuint; delayin: 0; delayout: 0; "><img src="/assets/uploads/2014/03/sidebar-01.jpg" class="ls-bg"></div>
    </div>
</div>