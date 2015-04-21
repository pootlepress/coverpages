<img id="logo" alt="Logo" src="<?php echo esc_url( $logo_url ); ?>">

<h1 id="title"><?php echo esc_html( $title ); ?></h1>

<h2 id="tagline"><?php echo esc_html( $tagline ); ?></h2>

<div id="text"><?php echo wp_kses_post( $text ); ?></div>

<a id="button1" class="button" href="<?php echo esc_url( $button1_link ); ?>"><?php echo esc_html( $button1_text ); ?></a>
<a id="button2" class="button" href="<?php echo esc_url( $button2_link ); ?>"><?php echo esc_html( $button2_text ); ?></a>
