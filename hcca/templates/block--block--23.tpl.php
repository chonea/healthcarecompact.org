<?php
echo '<div id="block-block-23">';
?>


<?php
	/*
//						$result = db_query('SELECT nid FROM {node} WHERE status = 1 AND type = "%s" ORDER BY `created` DESC', 'video');
	$result = db_query(
		'SELECT n.nid FROM node n 
		INNER JOIN field_data_field_featured c ON n.vid = c.vid
		WHERE n.status = "1" AND n.type = "%s" AND c.field_featured_value = "1" 
		ORDER BY n.created DESC',
		'video'
	);
	$subnid = db_fetch_object($result);
	$subnode = node_load(array(
		"nid" => $subnid->nid,
	));

	*/
         
	$query = db_select('node', 'n');
	$query
//		->leftJoin('field_data_field_featured', 'c', 'n.nid = c.entity_id')
		->fields('n', array('nid', 'title', 'type'))
//		->fields('c', array('entity_id', 'field_featured_value'))
//		->condition('n.type', 'video', '=')
//		->condition('n.field_featured_value', 1, '=')
		->range(0,1)
		->orderBy('n.created', 'DESC');
	$result = $query->execute();
	$row = $result->fetchAssoc();
	$subnode = node_load(array(
		"nid" => $row->nid,
	));

//	echo '<pre style="display:none">';
	echo '<pre>';
	print_r($subnode);
	echo '</pre>';
?>
<?php /* if (is_object($subnode)) { ?>
<div id="share-video">
	<h1>Video</h1>
	<div id="node-<?php print $subnode->nid; ?>" class="clearfix">					
	<?php if ($subnode->field_video_embed[0]['value']): ?>
		<div class="video-embed"><?php print $subnode->field_video_embed[0]['value']; ?></div>
	<?php endif; ?>		
	<?php if ($subnode->title): ?>
		<h2 class="title"><a href="<?php print $subnode->path ?>"><?php print $subnode->title; ?></a></h2>
	<?php endif; ?>
		<div class="meta">
			<span class="submitted"><?php print format_date($subnode->created) . ' &ndash; ' . theme('username', $subnode); ?></span>
		</div>
		<div class="content">
			<?php print $subnode->teaser; ?>
			<p style="text-align: right;">
				<? // <a href="/share/video">&laquo; Read All Shared</a> &nbsp;|&nbsp; ?>
				<a href="<?php print $subnode->path ?>">Read More &raquo;</a>
			</p>
			<div class="node_social_share">
				<div class="share-social share-social-google">
					<!-- Place this tag where you want the +1 button to render -->
					<div class="g-plusone" data-annotation="none" data-href="http://www.dewhurstfortexas.com/<?php echo rawurlencode($subnode->path); ?>"></div>
				</div>

				<div class="share-social share-social-facebook"><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo rawurlencode('http://www.dewhurstfortexas.com/'.$subnode->path); ?>" title="Share this via Facebook"></a></div>
				<div class="share-social share-social-twitter"><a target="_blank" href="https://twitter.com/share?text=<?php echo rawurlencode($subnode->title); ?>&url=<?php echo rawurlencode('http://www.dewhurstfortexas.com/'.$subnode->path); ?>" title="Share this via Twitter"></a></div>
				<div class="share-social share-social-email"><a href="mailto:?subject=<?php echo rawurlencode($subnode->title); ?>&amp;body=http://www.dewhurstfortexas.com/<?php echo rawurlencode($subnode->path); ?>" title="Share this via Email"></a></div>
				<div class="share-social share-social-sharethis"></div>
				<br class="clear" />
			</div>
		</div>
	</div><!-- /.node -->
</div>
<?php } */ ?>

<?php
echo '</div>';
?>