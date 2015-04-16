<img id="logo" alt="Logo" src="<?php echo $logo_url; ?>">

<h1 id="title"><?php echo $title; ?></h1>

<h2 id="tagline"><?php echo $tagline; ?></h2>

<div id="text"><?php echo $text; ?></div>

<?php
if($button1){
?>
<a id="button1" class="button" href="<?php echo $button1_link; ?>"><?php echo $button1_text; ?></a>

<?php
}
?>

<?php
if($button2){
?>
<a id="button2" class="button" href="<?php echo $button2_link; ?>"><?php echo $button2_text; ?></a>
<?php
}
?>