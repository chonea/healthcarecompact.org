<div id="block-block-25">
	<div id="state-section-1">
		<div class="state-tab-1 state-tab-active">State News</div>
		<div class="state-tab-2">Statistics</div>
		<div id="state-section-1-content"></div>
	</div>
	<div id="state-section-2">
		<div class="state-tab-2 state-tab-active">Statistics</div>
		<div class="state-tab-1">State News</div>
		<div id="state-section-2-content">
			<h2 class="title">Statewide Healthcare Statistics</h2>
		</div>
	</div>
	<script type="text/javascript">
	(function($){
	
		$(document).ready(function() {
			$('.tabs').hide();
			$('.tabs').prependTo('#state-section-2-content');
			$('.field-name-field-state-statistics').appendTo('#state-section-2-content');
			$('#block-views-state-targeted-news-block').appendTo('#state-section-1-content');
			$('#block-views-state-targeted-news-block').show();
			$('.field-name-field-state-statistics').show();
			$('#state-section-2-content').show();
		});
	
		$('#state-section-1 .state-tab-2').click(function() {
			$('#state-section-1-content').hide();
			$('#state-section-1').fadeOut();
			$('#state-section-2-content').show();
			$('#state-section-2').fadeIn();
		});
	
		$('#state-section-2 .state-tab-1').click(function() {
			$('#state-section-2-content').hide();
			$('#state-section-2').fadeOut();
			$('#state-section-1-content').show();
			$('#state-section-1').fadeIn();
		});
	
	})(jQuery);
	</script>
</div>