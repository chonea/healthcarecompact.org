<div id="block-block-24">
	<style type="text/css" media="screen">
		/*
			Load CSS before JavaScript
		*/
		#slides {
			position: relative;
			width: 630px;
			height: 280px;
			margin: 0 0 0 -10px;
			overflow: hidden;
			background: #f7f7f7;
			-moz-box-shadow: 0px 3px 4px #111;
			-webkit-box-shadow: 0px 3px 4px #111;
			box-shadow: 0px 3px 4px #111;
			/* For IE 8 */
			-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=2, Direction=180, Color='#111111')";
			/* For IE 5.5 - 7 */
			filter: progid:DXImageTransform.Microsoft.Shadow(Strength=2, Direction=180, Color='#111111');
		}
		
		/*
			Slides container
			Important:
			Set the width of your slides container
			Set to display none, prevents content flash
		*/
		#slides .slides_container {
			position: relative;
			/*width: 550px;
			height: 245px;
			padding: 20px 40px 15px;*/
			width: 630px;
			height: 280px;
			padding: 0;
			margin: 0;
			display: none;
		}

		/*
			Each slide
			Important:
			Set the width of your slides
			If height not specified height will be set by the slide content
			Set to display block
		*/
		#slides .slides_container .slide {
			display: block;
			/*width: 550px;
			height: 245px;
			padding: 0;*/
			width: 550px;
			height: 245px;
			padding: 20px 40px 15px;
			margin: 0;
			color: #000;
			overflow: hidden;
		}
		
		/*
			Optional:
			Reset list default style
		*/
		#slides ul.pagination {
			position: absolute;
			left: 40px;
			bottom: 20px;
			list-style: none;
			margin: 0;
			padding: 0;
			z-index: 99;
		}
		#slides ul.pagination li {
			float: left;
			width: 22px;
			height: 22px;
		}
		#slides .pagination a {
			display: block;
			width: 22px;
			height: 22px;
			text-align: center;
			line-height: 22px;
			color: #8d8d8d;
			font-weight: bold;
			text-decoration: none;
			background: none;
			cursor: pointer;
		}
		#slides .pagination a:hover {
			text-decoration: none;
		}

		/*
			Optional:
			Show the current slide in the pagination
		*/
		#slides .pagination .current a {
			color: #eeeded;
			background: transparent url('<?=path_to_theme(); ?>/images/hcca_slider_13.png') top center no-repeat;
		}
		#slides a.prev,
		#slides a.next {
			position: absolute;
			display: block;
			top: 125px;
			width: 14px;
			height: 33px;
			line-height: 0;
			font-size: 0;
			text-indent: -999px;
			overflow: hidden;
			cursor: pointer;
			z-index: 99;
		}
		#slides a.prev {
			left: 10px;
			background: url('<?=path_to_theme(); ?>/images/hcca_slider_03.png') top center no-repeat;
		}
		#slides a.next {
			right: 10px;
			background: url('<?=path_to_theme(); ?>/images/hcca_slider_05.png') top center no-repeat;
		}
		#slides a.slide-button {
			position: absolute;
			display: block;
			bottom: 20px;
			right: 40px;
			width: 89px;
			height: 22px;
			line-height: 0;
			font-size: 0;
			text-indent: -999px;
			overflow: hidden;
			cursor: pointer;
			background: url('<?=path_to_theme(); ?>/images/hcca_slider_10.png') top center no-repeat;
			z-index: 99;
		}
		#slides div.slide-gradient {
			position: absolute;
			bottom: 15px;
			left: 0;
			right: 0;
			width: 100%;
			height: 60px;
			line-height: 0;
			font-size: 0;
			background: url('<?=path_to_theme(); ?>/images/hcca_slider_gradient_large.png') top center repeat-x;
			z-index: 98;
		}

		/*
			Theme the slider.
		*/
		#slides {
			font-size: 12px;
			line-height: 18px;
			color: #000000;
			font-weight: normal;
		}
		#slides h2.slide-title {
			font-size: 22px;
			line-height: 30px;
			color: #ae0600;
			font-weight: bold;
			padding: 0 0 12px;
			margin: 0;
			letter-spacing: 1px;
		}
		#slides h2.slide-title a {
			color: #ae0600;
		}
		#slides h3.slide-source {
			font-size: 16px;
			line-height: 20px;
			color: #368392;
			font-style: italic;
			padding: 0 0 12px;
			margin: -6px 0 0;
			letter-spacing: 1px;
		}

<?php
$result = db_query("SELECT * FROM node WHERE type = 'slide' AND status = '1' AND promote = '1' ORDER BY created DESC LIMIT 10");

if (isset($result)) {

	foreach ($result as $obj) {

		$query1 = new EntityFieldQuery();
		$entities = $query1->entityCondition('entity_type', 'node')
			->propertyCondition('nid', $obj->nid)
			->range(0,1)
			->execute();
	
		if (!empty($entities['node'])) {
			$node = node_load(array_shift(array_keys($entities['node'])));
			if (isset($node->field_background_image)) {
				echo '
		#slide-node-'.$node->nid.' {
			background: url(/sites/default/files/slides/'.$node->field_background_image['und'][0]['filename'].') top center no-repeat;
		}';
			} // if
		}  // if
	} // foreach
} // isset result
?>
	</style>
	
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->
	<script src="<?=path_to_theme(); ?>/scripts/slides/source/slides.min.jquery.js"></script>
	
	<script type="text/javascript">
		(function($){
			$(function(){
				// Set starting slide to 1
				var startSlide = 1;
				// Get slide number if it exists
				if (window.location.hash) {
					startSlide = window.location.hash.replace('#','');
				}
				// Initialize Slides
				$('#slides').slides({
					preload: true,
					generateNextPrev: true,
					preloadImage: '<?=path_to_theme(); ?>/images/loader_1.gif',
					generatePagination: true,
					play: 12000,
					pause: 2500,
					hoverPause: true,
					// Get the starting slide
					start: startSlide,
					animationComplete: function(current){
						// Set the slide number as a hash
						// window.location.hash = '#' + current;
					}
				});
			});
		})(jQuery);
	</script>
	<div id="slides">
		<div class="slides_container">
			<?php
/*
			$query = new EntityFieldQuery();
			$entities = $query->entityCondition('entity_type', 'node', 'n')
				->leftJoin('field_data_field_background_image', 'i', 'n.nid = i.entity_id')
				->fields('n', array('nid'))
				->fields('i',array('entity_id', 'field_background_image_fid'))
				->condition('n.type', 'slide');
			$results = $query->execute();
			
			$n = 0;
			while ($row = $results->fetchAssoc()) {
					$slides[$n] = $row;
					$n++;
			}
*/
			$result = db_query("SELECT * FROM node WHERE type = 'slide' AND status = '1' AND promote = '1' ORDER BY created DESC LIMIT 10");

			if (isset($result)) {

				foreach ($result as $obj) {

					$query = new EntityFieldQuery();
					$entities = $query->entityCondition('entity_type', 'node')
						->propertyCondition('nid', $obj->nid)
						->range(0,1)
						->execute();
				
					if (!empty($entities['node'])) {
						$node = node_load(array_shift(array_keys($entities['node'])));
						echo '<div id="slide-node-'.$node->nid.'" class="slide"';
						/*
						if (isset($node->field_background_image)) {
							echo ' style="background: url(/sites/default/files/slides/'.$node->field_background_image['und'][0]['filename'].' top center no-repeat;"';
						}
						*/
						echo '>';
						echo '<h2 class="slide-title"><a href="'.drupal_get_path_alias("node/".$node->nid).'">'.$node->title.'</a></h2>';
						echo '<h3 class="slide-source">'.$node->field_source['und'][0]['value'].'</h3>';
						if ($node->body['und'][0]['safe_summary']) {
							echo $node->body['und'][0]['safe_summary'];
						} else {
							echo $node->body['und'][0]['safe_value'];
						}
						echo '<a class="slide-button" href="';
						if (isset($node->field_target_url)) {
							echo $node->field_target_url['und'][0]['value'];
						} else {
							echo drupal_lookup_path('alias',"node/".$node->nid);
						}
						echo '">'.$node->title.'</a>';
			//			echo '<pre style="display: none">';
			//			print_r ($node);
			//			echo '</pre>';
						if (!isset($node->field_background_image['und'][0]['filename'])) {
							echo '<div class="slide-gradient">&nbsp;</div>';
						}
						echo '</div>';
					}

				}

			} else {
				echo '<div>';
				echo '<p>No slides.<p>';
				echo '</div>';
			}
			?>

<?php
/*
			<div>
				<h2>Slide 1</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>

			<div>
				<h2>Slide 2</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>

			<div>
				<h2>Slide 3</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>

			<div>
				<h2>Slide 4</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>

			<div>
				<h2>Slide 5</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>

*/ ?>
		</div>
	</div>
</div>