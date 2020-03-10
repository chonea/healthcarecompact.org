<?php
// session_start();
// echo '<div id="block-block-13" class="banner-'.$_SESSION['state'].'">';
echo '<div id="block-block-13">';
// echo "STATE-session: ".$_SESSION['state'];
echo '</div>';
?>
<?php if (isset($_SESSION['state'])) {?>
<script type="text/javascript">
	(function($){
		if ($('body').hasClass('node-type-statepage')) {
			$('#block-block-13').addClass('banner-<?=$_SESSION['state'];?>');
			$('#block-block-13').removeClass('gsc-campaign');
		}
	})(jQuery);
</script>
<?php } ?>