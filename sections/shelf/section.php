<?php
/*
	Section: Shelf
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: A simple showcase shelf section
	Class Name: PLShelf
	Filter: full-width
	Edition: Pro
	Loading: active
*/


class PLShelf extends PageLinesSection {

	var $default_limit = 3;

	function section_opts(){
		$options = array(			
			
			array(
				'type' 			=> 'multi',
				'title' 		=> __( 'Shelf Settings', 'pagelines' ),
				'opts'	=> array(
					array(
						'key'			=> 'shelf_title',
						'version' 		=> 'pro',
						'type' 			=> 'text',
						'label' 		=> __( 'Title', 'pagelines' ),
					),
					array(
						'key'			=> 'shelf_subtitle',
						'version' 		=> 'pro',
						'type' 			=> 'textarea',
						'label' 		=> __( 'Subtitle', 'pagelines' ),
					),
					array(
						'title'	=> 'Background', 
						'type'	=> 'multi',
						'opts'	=> array(
							array(
								'type' 			=> 'image_upload',
								'key'			=> 'shelf_background',
								'label' 		=> __( 'Background Image', 'pagelines' ),
							),
							array(
								'type' 			=> 'select',
								'key'			=> 'shelf_background_repeat',
								'label' 		=> __( 'Background Repeat', 'pagelines' ),
								'opts'			=> array(
									'no-repeat'		=> array('name' => __( 'No Repeat (Default)', 'pagelines' )),
									'repeat-x'			=> array('name' => __( 'Repeat-X', 'pagelines' )),
									'repeat-y'			=> array('name' => __( 'Repeat-Y', 'pagelines' )),
								)
							),
						)
					),	
					array(
						'key'			=> 'shelf_text_color',
						'version' 		=> 'pro',
						'type' 			=> 'color',
						'label' 		=> __( 'Text Color', 'pagelines' ),
						'default' 		=> '#ffffff',
					),
				)
			),
				array(
					'key'		=> 'left_image',
					'label'		=> __( 'Left Image', 'pagelines' ),
					'type'		=> 'image_upload',
				),
				array(
					'key'		=> 'middle_image',
					'label'		=> __( 'Middle Image', 'pagelines' ),
					'type'		=> 'image_upload',
				),
				array(
					'key'		=> 'right_image',
					'label'		=> __( 'Right Image', 'pagelines' ),
					'type'		=> 'image_upload',
				),
			
		);

		return $options;

	}

   function section_template( ) { 
	
	$title = $this->opt('shelf_title');
	$subtitle = $this->opt('shelf_subtitle');
	$bg = ( $this->opt('shelf_background') ) ? sprintf('background-image: url(%s);', $this->opt('shelf_background')) : '';
	$leftimage = ( $this->opt('left_image') ) ? sprintf($this->opt('left_image')) : $this->base_url . '/screen1.jpg';
	$middleimage = ( $this->opt('middle_image') ) ? sprintf($this->opt('middle_image')) : $this->base_url . '/screen2.jpg';
	$rightimage = ( $this->opt('right_image') ) ? sprintf($this->opt('right_image')) : $this->base_url . '/screen3.jpg';
	
	$repeat_class = array(); 
	$bgrepeat = ( $this->opt('shelf_background_repeat') ) ? sprintf('background-repeat: %s;', $this->opt('shelf_background_repeat')) : '';
	?>
	
	<div class="shelf-wrap" style="<?php echo $bg . $bgrepeat ;?>">
		<h1 class="title"><?php echo $title; ?></h1>
		<div class="subtitle"><?php echo $subtitle; ?></div>
		
		<div class="pl-animation-group">
			
			<div class="pl-animation pla-from-bottom popshot popshot-1">
				<img src="<?php echo $leftimage; ?>" />
			</div>
			<div class="pl-animation pla-from-bottom popshot popshot-2">
				<img src="<?php echo $middleimage; ?>" />
			</div>
			<div class="pl-animation pla-from-bottom popshot popshot-3">
				<img src="<?php echo $rightimage; ?>" />
			</div>
			
		</div>
	</div>

<?php }


	function section_head(){ 	?>
	
		<style type="text/css">
			.shelf-wrap .title,
			.shelf-wrap .subtitle{
				color: <?php echo pl_hashify($this->opt('shelf_text_color')); ?>;
			}
        </style>
	
	
		<?php 
	}
}