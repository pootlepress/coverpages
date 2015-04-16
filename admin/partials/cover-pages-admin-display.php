<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link   http://example.com
 * @since  1.0.0
 *
 * @packageCover_Pages
 * @subpackage Cover_Pages/admin/partials
 */

?>

<?php

// Getting Cover Page Settings
$cover_page_settings = $GLOBALS['cover-page-settings'];

foreach ($cover_page_settings as $k => $v) {

	$cover_page_sex['cover-pages-section-' . str_replace(array(' ', '_', ',', '.'), '-',strtolower($k))] = $k;

}

$tab = '';

if( isset( $_GET['tab'] ) ){

	$tab = $_GET['tab'];

}

if( !array_key_exists( $tab, $cover_page_sex ) ){

	$tab = 'cover-pages-section-general';

}
?>

<div class="wrap">
	<h2>Cover Page</h2>

	<p class="description">Welcome to Cover Page</p>

	<h2 class="nav-tab-wrapper">
	
	<?php
	foreach( $cover_page_sex as $sec => $name){
	?>
		<a href="?page=cover-pages-page&tab=<?php echo $sec; ?>" class="nav-tab <?php  echo $sec == $tab ? 'nav-tab-active' : ''; ?>"><?php echo $name; ?></a>
	<?php
	}
	
	?>
	</h2>

	<?php settings_errors(); ?>
	
	<?php if( $tab == 'cover-pages-section-template' ){ ?>
	<a style="margin:1em;" class="button button-primary right" href="<?php
		echo "customize.php?"
		. "url=http://wp/7/?coverpages-customize=yo&"
		. "coverpages-customize=yo&"
		. "return=%2F7%2Fwp-admin%2Fthemes.php%3Fpage%3Dcover-pages-page" ?>"> 
		Customize
	</a>
	<?php } ?>

	<form method="post" action="options.php">

		
		<?php settings_fields( $tab ); ?>
		<?php do_settings_sections( $tab ); ?> 
  
		<?php submit_button(); ?>

	</form>

</div>