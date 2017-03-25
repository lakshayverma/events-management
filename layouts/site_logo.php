<?php
include './images/lakshay.svg';

if (!isset($animation_duration)) {
    $animation_duration = 1750;
}
?>
<script src="custom/dist/js/jquery.drawsvg.js"></script>
<script type="text/javascript">
    $svg = $('.site_logo > svg').drawsvg({
        duration: <?php echo $animation_duration; ?>,
        callback: function () {
            $('.site_logo').addClass('active');
        }
    });

    function animateLogo() {
        $svg.drawsvg('animate');
    }

    animateLogo();
</script>