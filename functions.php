<?php

// Load Framework //
require_once( dirname(__FILE__) . '/setup.php' );

class workspaceTheme {


	function __construct() {

		$this->init();
		$this->options();

	}

	function init() {


	}

	// Draw Welcome Panel
	function welcome(){

		ob_start();
		?>
			 <div style="font-size:12px;line-height:14px;color:#444;">
        <p><?php _e('Welcome to Workspace Theme! Please let me know if you have any questions or concerns, and enjoy your product.','workspace');?></p>
      </div>
      <div class="row">
        <div class="span6 zmb" style="text-align:center;">
          <a href="http://jamesgiroux.ca" target="_blank" class="btn btn-info btn-mini"><i class="icon icon-globe"></i>  <?php _e('Website','workspace');?></a>
        </div>
        <div class="span6 zmb" style="text-align:center;">
          <a href="http://www.pagelines.com/forum/" target="_blank" class="btn btn-info btn-mini"><i class="icon icon-ambulance"></i>  <?php _e('Support','workspace');?></a>
        </div>
      </div>
      <div style="margin-top:20px;color:#444;">
        <p style="border-bottom:1px solid #ccc;margin:0 0 0.75em;"><strong><?php _e('Overview','workspace');?></strong></p>
        <p style="font-size:12px;line-height:14px;"><?php _e('Workspace Theme is designed to work with core PageLines sections. To edit sections, click the pencil icon in the top left corner.','workspace');?></p>
      </div>
      <div style="margin-top:20px;color:#444;">
        <p style="border-bottom:1px solid #ccc;margin:0 0 0.75em;"><strong><?php _e('Instructions','workspace');?></strong></p>
        <p style="font-size:12px;line-height:14px;"><?php _e('In depth instructions are available in the theme folder, or by <a href="/wp-content/themes/workspace/theme_installation_instructions.pdf" target="_blank">clicking here.</a></p>','workspace');?>
        <ul class="unstyled" style="font-size:12px;line-height:14px;">
          <li style="margin-bottom:7px;"><strong><?php _e('1.','workspace');?> </strong><?php _e('Activate the theme in Appearance > Themes. Well done!','workspace');?></li>
          <li style="margin-bottom:7px;"><strong><?php _e('2.','workspace');?> </strong><?php _e('Import <a href="/wp-content/themes/workspace/content.xml" target="_blank">content.xml</a> using the WordPress Importer.','workspace');?></li>
          <li style="margin-bottom:7px;"><strong><?php _e('3.','workspace');?> </strong><?php _e('Click <a href="/wp-admin/options-reading.php">here</a> and set your front page to the home page, and the posts page to the blog page.','workspace');?></li>
          <li style="margin-bottom:7px;"><strong><?php _e('4.','workspace');?> </strong><?php _e('In the Global Options panel, locate the Import/Export area and click on it.','workspace');?></li>
          <li style="margin-bottom:7px;"><strong><?php _e('5.','workspace');?> </strong><?php _e('To recreate the demo, click the Child Theme Config Import button.','workspace');?></li>
          <li style="margin-bottom:7px;"><strong><?php _e('6.','workspace');?> </strong><?php _e('That\'s it! Templates and look will all be loaded.  If you want to create more pages, in your Templates area you can apply any of the templates from the demo to new pages.','workspace');?></li>
          <li style="margin-bottom:7px;"><strong><?php _e('6.','workspace');?> </strong><?php _e('To edit the main color of the theme, simply change the Link Color in Global Options and your entire theme will change to match.','workspace');?></li>
				</ul>
			</div>
		<?php
		return ob_get_clean();
	}

	// Theme Options
	function options(){
		$theme_settings = array();

		$theme_settings['workspace_theme_config'] = array(
		   'pos'                  => 50,
		   'name'                 => __('Workspace Theme','workspace'),
		   'icon'                 => 'icon-circle',
		   'opts'                 => array(
		   		array(
		       	    'type'          => 'template',
            		'title'         => __('Welcome to Workspace Theme','workspace'),
            		'template'      => $this->welcome()
		       	),
		   )
		);
		pl_add_theme_tab($theme_settings);
	}


}

new workspaceTheme;

add_filter( 'render_css_posix_', '__return_true' ); //Flywheel Support