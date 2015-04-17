<?php
/**
 * Base for all templates
 *
 * @link       http://pootlepress.com
 * @since      1.0.0
 * @package    Cover_Pages
 * @subpackage Cover_Pages/public/partials
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title('&raquo;','true','right'); ?><?php bloginfo('name'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<style>
	html, body, #wrap, #image-wrap{
		min-height:100vh;
		min-width:100%;
		padding:0;
		margin:0;
		background-size: cover;
	}
	<?php if( is_user_logged_in() && !is_customize_preview() ){ ?>
	#image-wrap{
		margin-top: 32px;
	}
	<?php } ?>
	#wrap, #image-wrap{
		text-align: center;
	}
	#wrap:after{
		content:'';
		display:block;
		clear:both;
	}
	.button{
		display:inline-block;
		padding:5px;
		text-align: center;
	}
</style>
<?php
/**
 * Doing cover pages head action to enqueue styles and scripts
 */
do_action('cover_pages_head');
?>
</head>

<body class="cover-page">
  <div id="image-wrap">
	<div id="wrap">

		<!-- Template Start -->
	<?php
		//Data for Template
		$tpls = array('1', '2');
		$tpl = get_option("cover-pages-template", "1");
		
		if(!in_array($tpl, $tpls)){
			$tpl = '1';
		}
		$logo_url = get_option("cover-pages-logo", "Sample");
		$title = get_option("cover-pages-title", "Sample");
		$tagline = get_option("cover-pages-tag-line", "Sample");
		$text = get_option("cover-pages-text", "Sample");
		$button1 = get_option("cover-pages-button1");
		$button1_link = $button1["link"];
		$button1_text = $button1["text"];
		$button2 = get_option("cover-pages-button2");
		$button2_link = $button2["link"];
		$button2_text = $button2["text"];

		//Calling the template here
		require plugin_dir_path( __FILE__ ) . "/tpl/{$tpl}.php";
	?>
		<!-- Template Done -->

	</div>
  </div>
<?php
/**
 * Doing cover pages footer action to enqueue scripts and other stuff
 */
do_action('cover_pages_footer');
?>
</body>
</html>