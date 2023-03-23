<?php if (!defined('WEBPATH')) die(); ?>
<!doctype html>
<html<?php printLangAttribute(); ?>>
<head>
	<?php include("_header.php"); ?>
</head>
<body>
	<?php zp_apply_filter('theme_body_open'); ?>
		<a href="#main-content" tabindex="0" class="skip-to-content">Skip to main content</a>

	<div class="grid-container">

		<header class="header">
				<nav class="navbar">
					<div class="navbar_title_container">
					<a href="<?php echo html_encode(getSiteHomeURL()); ?>" 
						class="navbar_title">
						<?php printGalleryTitle(); ?>
					</a>
					</div>
					<?php include("_navbar.php"); // <ul> with all items ?>
				</nav>
		</header>
			

<main class="container main">
	
		<div class="archive_grid">
			<div>
		<h3><?php echo gettext('Archive View'); ?></h3>
		<?php printAllDates( 'archive', 'year', 'month', 'desc'); ?>
		</div>
		
		<div>
		<h3><?php echo gettext('Popular Tags'); ?></h3>
		<?php printAllTagsAs('list', 'tags'); ?>
		</div>
		</div>

		</main>

		<footer class="footer"><?php include("_footer.php"); ?></footer>
	</div>
</body>
</html>

	</body>
</html>