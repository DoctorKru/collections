<?php if (!defined('WEBPATH'))	die(); ?>
<!doctype html>
<html lang="fr">
<head>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="<?php echo LOCAL_CHARSET; ?>">
	<?php zp_apply_filter('theme_head'); ?>
	<?php printHeadTitle(); ?>
	<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/styles.css" type="text/css" />
</head>
<body>
		<?php zp_apply_filter('theme_body_open'); ?>
	<div class="grid-container">
		<header class="header">
				<nav class="navbar">
					<div class="navbar_title_container">
					<a href="<?php echo html_encode(getGalleryIndexURL()); ?>" class="navbar_title">
					<?php printGalleryTitle(); ?></a><span class="breadcrumb"><?php printParentBreadcrumb('','',''); printAlbumBreadcrumb('', '');?></span>
					</div>
					<?php include("_navbar.php"); // <ul> with all items ?>
				</nav>
		</header>
		
		<main class="main">
			<div class="container album_head">
				<h1><?php printAlbumTitle(); ?></h1>
						<?php if (!empty(getAlbumDesc())) { ?>
					<div class="albumdes"><?php printAlbumDesc(); ?></div>
						<?php } else {} ?>
					</div>
			
			<div class="container galeries">
				<div id="album_masonry">
					<?php 
						if (isAlbumPage(true)) 
						{
							while (next_album()): ?>
							<figure class="sub_album"><a href="<?php echo html_encode(getAlbumURL()); ?>">
						<?php printCustomAlbumThumbImage(getAnnotatedAlbumTitle(), null, 600, 600, 600, 600, NULL, null, NULL,NULL); ?>
						<figcaption class="album-title"><?php printAlbumTitle(); ?></figcaption>
					</a></figure>
					<?php endwhile;
					;} 
					while (next_image()): 
					if (isImagePhoto()) { ?>
						<figure><a href="<?php echo html_encode(getImageURL()); ?>" title="<?php printBareImageTitle(); ?>">
						<img 
						src="<?php echo html_encode(getCustomImageURL(NULL,500,NULL,NULL,NULL,NULL,NULL,false,NULL)); ?>" 
						alt="<?php echo getBareImageTitle(); ?>" 
						width="<?php echo getFullWidth(); ?>" 
						height="<?php echo getFullHeight(); ?>" />
						</a></figure>
					<?php	} 
					 else { ?>
					<figure class="document">
						<a href="<?php echo html_encode(getImageURL()); ?>" title="<?php printBareImageTitle(); ?>">
						<?php printImageThumb(getBareImageTitle()); ?>
						</a>
					</figure>
				<?php	}  
						endwhile; ?>
				</div>
			    <!-- #album_masonry -->
					<div class="album_detail">
						<div class="album_descr"><?php printTags('links', '', 'taglist', ''); ?></div>
						<div class="picture_icons">				<?php	if(function_exists('printAddToFavorites')) {?>
					<div class="bloc-favs"><?php	printAddToFavorites($_zp_current_album); ?></div>
					<?php } ?></div>
					</div>
			<div class="pagelist-container"><?php printPageListWithNav("← " . gettext("prev"), gettext("next") . " →"); ?></div>
			</div><!-- container galeries -->
						<div class="media_supp xl_hmar">
	<div class="media_supp_content">
		<?php 
		if(function_exists('printRating')) {
			echo '<div class="bloc-rating">';
			echo '<h2>Rating</h2>';
			echo '<div class="bloc-rating-content">';
			@call_user_func('printRating'); 
			echo '</div>';
			echo '</div>';
		 } 
		if (function_exists('printCommentForm')) {
			if ($_zp_current_album->getCommentsAllowed() || $_zp_current_album->getCommentCount()) {
				echo '<div class="bloc-comments">';
				echo '<h2>Commentaires</h2>';
				printCommentForm();
				echo '</div>';
			}
		} 
		if(function_exists('printGoogleMap')) {
			echo '<div class="bloc-gmaps">';
			@call_user_func('printGoogleMap');
			echo '</div>';
		} 
		if(function_exists('printOpenStreetMap')) {
			#if (!is_null(printOpenStreetMap())) {
				echo '<div class="bloc-osm">';
				echo '<h2>Maps</h2>';
				@call_user_func('printOpenStreetMap');
				echo '</div>';
			#}
		}
		if (getImageMetaData()) {
			echo '<div class="bloc-metadata">';
			echo '<h2>Infos</h2>';
			printImageMetadata('',false,'imagemetadata');
			echo '</div>';
	 } 
	if (class_exists('ScriptlessSocialSharing')) {
		ScriptlessSocialSharing::printButtons();
	}
	?>
		</div> <!--END media_supp_content-->
</div> <!--END media_supp-->

		<script src="<?php echo $_zp_themeroot; ?>/js/macy.js"></script>
	
	    <script>
	        var masonry = new Macy({
	container: '.media_supp_content',
	trueOrder: false,
	waitForImages: false,
	useOwnImageLoader: false,
	debug: true,
	mobileFirst: true,
	columns: 1,
	margin: 10,
	breakAt: {
		1200: {
      margin: {
        x: 96,
				y:24,
      },
      columns: 2
    },
   950: {
      margin: {
        x: 54,
				y:24,
      },
      columns: 2
    },
		720: {
        margin: {
				x: 15,
				y:20,
			},
			columns: 2
			}
  }
});
</script>
		</main>
		
		<footer class="footer"><?php include("macy.php"); ?><?php include("_footer.php"); ?></footer>	
		</div>
</body>
</html>