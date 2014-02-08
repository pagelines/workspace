<?php
/*
	Section: SuperGrid
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: A simple list of stacked posts thumbnails.
	Class Name: SuperGrid
	Filter: full-width
	Loading: active
	Edition: Pro
	Section: SuperGrid
*/



class SuperGrid extends PageLinesSection {
	
	function section_opts(){
		$post_type_objects = get_post_types( array(), 'objects');

		$pts = array();

		foreach($post_type_objects as $key => $pt){

			if(post_type_supports( $key, 'thumbnail' ) && $pt->public){
				$pts[ $key ] = array(
					'name' => $pt->label
				);
			}

		}	
		
		$options = array();

		$options[] = array(

			'title' => __( 'Grid Configuration', 'pagelines' ),
			'type'	=> 'multi',
			'opts'	=> array(
				array(
					'key'			=> 'supergrid_post_type',
					'type' 			=> 'select',
					'opts'			=> $pts,
					'label' 	=> __( 'Which post type should SuperGrid use?', 'pagelines' ),
					'ref'           => __( '<strong>Note</strong><br/> Post types for this section must have "featured images" enabled and be public.<br/><strong>Tip</strong><br/> Use a plugin to create custom post types for use with SuperGrid.', 'pagelines' ),
				),			
				array(
					'key'			=> 'supergrid_total',
					'type' 			=> 'count_select',
					'count_start'	=> 5,
					'count_number'	=> 20,
					'default'		=> 10,
					'label' 		=> __( 'Total posts loaded', 'pagelines' ),

				),		
				array(
					'key'			=> 'supergrid_width',
					'type' 			=> 'count_select',
					'count_start'	=> 200,
					'count_number'	=> 400,
					'default'		=> 255,
					'label'		=> __( 'Post width in pixels', 'pagelines' ),
					'shortexp' 		=> __( 'Default is <strong>255px</strong>.', 'pagelines' )

				),
			)

		);

		return $options;
	}
	
	function section_styles(){
		
		wp_enqueue_script('masonry', $this->base_url.'/script.masonry.js', array( 'jquery' ), 1.0 , true);
		
	}

	function section_head(){
		
		$width = ($this->opt('supergrid_width', $this->oset)) ? $this->opt('supergrid_width', $this->oset) : 300;
		
		?>
		
		<style>.supergrid-item{ width: <?php echo $width;?>px; }</style>
		
		<script>

		jQuery(document).ready(function () {
		
			var gridContainer = jQuery('.supergrid-items');
			var gridWidth = gridContainer.width();			

			gridContainer.imagesLoaded(function(){

				gridContainer.masonry({
					itemSelector : '.supergrid-item',
					columnWidth: <?php echo $width; ?>,
					
					isFitWidth: true
				});

			});

		}); 

		</script>
	<?php }


	function current_page(){
		
		$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		return substr($url,0,strpos($url, '?'));
	}

	/**
	* Section template.
	*/
   function section_template() {


		global $wp_query;
		global $post;
		
		$posts_total = ($this->opt('supergrid_total')) ? $this->opt('supergrid_total') : '10';
		$post_type = ($this->opt('supergrid_post_type')) ? $this->opt('supergrid_post_type') : 'post';

		$query = array(
			'posts_per_page' 	=> $posts_total,
			'post_type' 		=> $post_type
		);
		
		$posts = get_posts( $query );

		$out = '';
		
		foreach( $posts as $key => $p ){

			if(has_post_thumbnail($p->ID) && get_the_post_thumbnail($p->ID) != ''){
				$thumb = get_the_post_thumbnail($p->ID, 'full');

				$image = sprintf('<div class="thumb-wrap"><a class="thumb" href="%s">%s</a></div>', get_permalink( $p->ID ), $thumb);
			} else{
				$image = ''; 
			};

			$title = sprintf(
				'<div class="grid-item-title"><h3><a href="%s">%s</a></h3></div>',
				get_permalink( $p->ID ),
				$p->post_title
			);

			$out .= sprintf(
				'<article class="supergrid-item"><a href="%s">%s</a> %s</article>',
				get_permalink( $p->ID ),
				$image,
				$title
			);
		}

		printf('<div class="fix"><div class="supergrid-items fix">%s</div><div class="clear"></div></div>', $out);
	}
 	 

	function load_posts( $number = 20){
		$query = array();

		$query['showposts'] = $number;

		$q = new WP_Query($query);

		return $q->posts;
	}
	
}
