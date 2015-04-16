<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function cover_pages_customizer_classes(){
	
	class Cover_Page_Slider_Customize_Control extends WP_Customize_Control {
		protected function render() {
			$id = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
			$class = 'customize-control customize-control-' . $this->type; ?>
			<li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
					<?php $this->render_content(); ?>
			</li>
		<?php }
			public function render_content() {

				$id = 'cover-pages-slider-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) ); ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<div class="cover-pages-slider" id="<?php echo $id ?>"></div>
					<script>
					jQuery(document).ready(function($){
						var input = $('#input-<?php echo $id ?>');
						$('#<?php echo $id ?>').slider({
							value: input.val(),
							change: function( e, ui ) {
								var input = $('#input-<?php echo $id ?>')
								input.val(ui.value);
								input.change();
							}
						});
					})
					</script>
					<input id="input-<?php echo $id ?>" type="number" data-default-color="<?php echo $this->default; ?>" value="<?php echo intval( $this->value() ); ?>" class="cover-pages-slider" <?php $this->link(); ?>  />
		<?php }
	}

}

