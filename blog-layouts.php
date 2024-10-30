<?php
/**
	Plugin Name: Blog Layouts
	Plugin URI: http://weblumia.com/wp-blog-layouts/
	Description: To make your blog layout responsive, attractive and colorful.
	Version: 1.4.5
	Author: Jinesh.P.V
	Author URI: http://weblumia.com/
	License: GPLv2 or later
 */
/**
	Copyright 2016 Jinesh.P.V (email: jinuvijay5@gmail.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */


add_action( 'admin_menu', 'wp_blog_layouts_add_menu' );
add_action( 'admin_init', 'wp_blog_layouts_reg_function' );
add_action( 'admin_init', 'wp_blog_layouts_admin_stylesheet' );
add_action( 'admin_init', 'wp_blog_layouts_scripts' );
add_action( 'wp_head', 'wp_blog_layouts_stylesheet', 20 );
add_shortcode( 'wp_blog_layouts', 'wp_blog_layouts_views' );

register_activation_hook( __FILE__, 'wp_blog_layouts_activate' );
register_deactivation_hook( __FILE__, 'wp_blog_layouts_deactivate' );

function wp_blog_layouts_add_menu() {
	add_menu_page( 'Blog layouts', 'Blog layouts', 'administrator', 'layouts_settings', 'wp_blog_layouts_menu_function' );
	add_submenu_page( 'layouts_settings', 'Blog layouts Settings', 'Settings', 'manage_options', 'layouts_settings', 'wp_blog_layouts_add_menu' ); 
}

function wp_blog_layouts_reg_function() {

	$settings						=	get_option( "wp_blog_layouts_settings" );
	if ( empty( $settings ) ) {
		$settings = array(
							'template_name' => 'classical',
							'template_bgcolor' => '#801638',
							'font_family' => 'Arial',
							'font_size' => '28',
							'template_ftcolor' => '#ffffff',
							'template_hvcolor' => '#0e5269',
							'cfont_family' => 'Arial',
							'cfont_size' => '14',
							'template_fccolor' => '#ffffff',
							'template_btnbgcolor' => '#027878',
							'template_btncolor' => '#fcfcfc'
						);
						
		add_option( "wp_blog_layouts_settings", $settings, '', 'yes' );
	}
}

if( $_REQUEST['action'] === 'save' && $_REQUEST['updated'] === 'true' ){
	
	update_option( "page_on_front", $_POST['page_on_front'] );
	update_option( "posts_per_page", $_POST['posts_per_page'] );
	update_option( "rss_use_excerpt", $_POST['rss_use_excerpt'] );
	
	$o_layouts = array();
	$o_layouts['ID'] = 2;
	$o_layouts['post_content'] = '';
	wp_update_post( $o_layouts );
	
	$layouts =	array();
	$layouts['ID'] = $_POST['page_on_front'];
	$layouts['post_content'] = '[wp_blog_layouts]';
	wp_update_post( $layouts );
	
	$settings =	$_POST;
	$settings =	is_array( $settings ) ? $settings : unserialize( $settings );
	$updated = update_option( "wp_blog_layouts_settings", $settings );
}

function wp_blog_layouts_activate() {
	
	if( 'posts' == get_option( 'show_on_front' ) && '0' == get_option( 'page_on_front' ) ){
		update_option( "show_on_front", 'page' );
		update_option( "page_on_front", 2 );
		
		$layouts					=	array();
		$layouts['ID']				=	2;
		$layouts['post_content']	=	'[wp_blog_layouts]';
		wp_update_post( $layouts );
	}
}

function wp_blog_layouts_deactivate() {
	
		update_option( "show_on_front", 'posts' );
		update_option( "page_on_front", 0 );
		
		$layouts					=	array();
		$layouts['ID']				=	2;
		$layouts['post_content']	=	'[wp_blog_layouts]';
		wp_update_post( $layouts );
		
		delete_option( 'wp_blog_layouts_settings' );
}

function wp_blog_layouts_admin_stylesheet() {
	
	wp_enqueue_style( 'wpl-admin', plugins_url( 'css/admin.css', __FILE__ ) );
	wp_enqueue_style( 'wpl-colorpicker', plugins_url( 'css/colorpicker.css', __FILE__ ) );
}

function wp_blog_layouts_scripts() {
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'cpicker', plugins_url( '/js/cpicker.js', __FILE__ ), '1.2' );
	wp_enqueue_script( 'eye', plugins_url( '/js/eye.js', __FILE__ ), '2.0' );
	wp_enqueue_script( 'bound', plugins_url( '/js/bound.js', __FILE__ ), '1.8.5' );
	wp_enqueue_script( 'layout', plugins_url( '/js/layout.js', __FILE__ ), '1.0.2' );
}

function wp_blog_layouts_stylesheet() {
	
	if( !is_admin() ){
		
		$settings =	get_option( "wp_blog_layouts_settings" );
		
		wp_register_style( 'wpl-google-fonts', 'http://fonts.googleapis.com/css?family=Oswald|Open+Sans|Fontdiner+Swanky|Crafty+Girls|Pacifico|Satisfy|Gloria+Hallelujah|Bangers|Audiowide|Sacramento');
		wp_enqueue_style( 'wpl-google-fonts' );
		wp_enqueue_style( 'wpl-layouts', plugins_url( 'css/layouts.css', __FILE__ ) );
		$custom_css = 	".blog_template {
							background:" . $settings['template_bgcolor'] . ";
						}
						.blog_template .blog_header h2 a{
							font:" . $settings['font_size'] . 'px/50px ' . $settings['font_family'] . ";
							color:" . $settings['template_ftcolor'] . ";
						}
						.blog_template .blog_header h2 a:hover {
							color:" . $settings['template_hvcolor'] . ";
						}
						.blog_template .post_content p {
							font:" . $settings['cfont_size'] . 'px/23px ' . $settings['cfont_family'] . ";
							color:" . $settings['template_fccolor'] . ";
						}
						.icon_cmt, .icon_date {
							background:" . $settings['template_btnbgcolor'] . ";
						}
						.icon_cmt a, .icon_date {
							color:" . $settings['template_btncolor'] . ";
						}
						.icon_readmore {
							background:" . $settings['template_btnbgcolor'] . ";
						}
						.icon_readmore a {
							color:" . $settings['template_btncolor'] . ";
						}
						.icon_category a:hover {
							color:" . $settings['template_bgcolor'] . ";
						}
						@media (max-width: 767px) {
							.blog_template .blog_header h2 a {
								font: 16px/23px " . $settings['font_family'] . ";
							}
						}
						.lightbreeze .blog_header h2 a {
							font:" . $settings['font_size'] . 'px/28px ' . $settings['font_family'] . ";
							display: inline-block;
						}
						.lightbreeze .bottom_box .icon_box.icon_readmore a:hover {
							color:" . $settings['template_bgcolor'] . ";
						}
						.lightbreeze .bottom_box .icon_box.icon_readmore {
							background:" . $settings['template_hvcolor'] . ";
						}
						.wl_pagination_box span.pages {
							background:" . $settings['template_bgcolor'] . ";
							color:" . $settings['template_fccolor'] . ";
						}
						.wl_pagination_box a {
							background:" . $settings['template_bgcolor'] . ";
							color:" . $settings['template_fccolor'] . ";
						}
						.wl_pagination_box a:hover, .wl_pagination_box span.current {
							background:" . $settings['template_btnbgcolor'] . ";
							color:" . $settings['template_fccolor'] . ";
						}
						.blog_template.spektrum h2 a{
							font:" . $settings['font_size'] . 'px/32px ' . $settings['font_family'] . ";
							color:" . $settings['template_ftcolor'] . ";
						}
						.blog_template.spektrum  .post_content .post_date .post_info_date::before {
    						border-bottom: 1px solid " . $settings['template_btnbgcolor'] . ";
						}
						.blog_template.spektrum  .post_content .post_date .post_info_date span {
    						background: " . $settings['template_bgcolor'] . ";
						}
						.blog_template.evolution .blog_header h2 a {
							font:" . $settings['font_size'] . 'px/32px ' . $settings['font_family'] . ";
							color:" . $settings['template_ftcolor'] . ";
							border-bottom:3px solid " . $settings['template_ftcolor'] . ";
						}
						.blog_template.evolution .blog_header span.comment, .blog_template.evolution a.read_more {
							background: " . $settings['template_btnbgcolor'] . ";
						}
						.blog_template.evolution .blog_header span.comment a, .blog_template.evolution a.read_more {
							color:" . $settings['template_btncolor'] . ";
						}
						";
        wp_add_inline_style( 'wpl-layouts', $custom_css );
	}
}

function continue_reading_link() {
	return ' <a href="' . esc_url( get_permalink() ) . '" class="readmore">' . __( 'Read more', 'twentyeleven' ) . '</a>';
}

function auto_excerpt_more( $more ) {
	return ' &hellip;' . continue_reading_link();
}
add_filter( 'excerpt_more', 'auto_excerpt_more' );


function wp_blog_layouts_views(){
	
	$settings =	get_option( "wp_blog_layouts_settings" );
	
    if( !isset( $settings['template_name'] ) || empty( $settings['template_name'] ) ) {
        return '[wp_blog_layouts] '.__('Invalid shortcode', 'wp_blog_layouts').'';

    }
	
    $theme = $settings['template_name'];
    $cat = $settings['template_category'];
	
	if( !empty( $cat ) ) { 
		foreach( $cat as $catObj ):
			$category .= $catObj . ',';
		endforeach;
		$cat = rtrim( $category, ',' );
	} else {
		$cat = '-1';
	}
	$posts_per_page = get_option( 'posts_per_page' );
	$paged = lumiapaged();
	
	
	$posts = query_posts( array( 'cat' =>  $cat , 'posts_per_page' => $posts_per_page, 'paged' => $paged ) );
	
	while ( have_posts() ) : the_post();
		if( $theme == 'classical' ){
			wp_classical_layout();
		} elseif( $theme == 'lightbreeze' ){
			$class		=	' lightbreeze';
			wp_lightbreeze_layout();
		} elseif( $theme == 'spektrum' ){
			$class		=	' spektrum';
			wp_spektrum_layout();
		} elseif( $theme == 'evolution' ){
			$class		=	' evolution';
			wp_evolution_layout();
		}
	endwhile;
	
	echo '<div class="wl_pagination_box">';
		lumia_pagination();
	echo '</div>';
	
	wp_reset_query();
}

/****************************** display function for classical layout *************************************/

function wp_classical_layout(){
	?>
    <div class="row">
        <div class="blog_template classical">
            <div class="blog_header">
                <?php the_post_thumbnail( 'full' );?>
                <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            </div>
            <div class="post_content">
                <div class="metadata_box top">
                    <div class="icon_cmt">
                        <?php comments_popup_link( '0', '1', '%' ); ?>
                    </div>
                    <div class="icon_date left">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        <span><?php the_time( __( "F j, Y, g:i a" ) );?></span>
                    </div>
                    <div class="icon_date right">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        <span><?php the_author();?></span>
                    </div>
                </div>
                <?php if( get_option( 'rss_use_excerpt' ) == 0 ):?>
                    <?php the_content(); ?>
                <?php else:?>
                    <?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) );?>
                <?php endif;?>
                <div class="metadata_box bottom">
                    <div class="icon_category">                
                        <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                        <?php
                        $categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );
                        if ( $categories_list ):
                            printf( __( ' %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-tag-links', $categories_list );
                            $show_sep = true;
                        endif; ?>
                    </div>
                    <div class="icon_readmore"> 
                        <a href="<?php the_permalink(); ?>"><?php echo __( 'Read more', 'twentyeleven' ); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php
}

/****************************** display function for lightbreeze layout *************************************/

function wp_lightbreeze_layout(){
	global $post;
	?>
    
	<div class="blog_template col-lg-6 lightbreeze">
		<div class="blog_header">
			<?php if ( has_post_thumbnail( $post->ID ) ) { the_post_thumbnail( 'full' );} else { echo '<img src="' . plugins_url( 'images/no_image.jpg', __FILE__ ) . '" alt="No Imges" />';}?>
            <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            <div class="clear"></div>
            <span class="mdate"><?php the_time( __( 'd M, Y' ) );?></span>
        </div>
        <div class="post_content">
            <?php if( get_option( 'rss_use_excerpt' ) == 0 ):?>
                <?php the_content(); ?>
            <?php else:?>
                <?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) );?>
            <?php endif;?>
        </div>
        <div class="metadata_box bottom">
            <div class="icon_category">                
                <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                <?php
                $categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );
                if ( $categories_list ):
                    printf( __( ' %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-tag-links', $categories_list );
                    $show_sep = true;
                endif; ?>
            </div>
        </div>
        <div class="bottom_box">
            <div class="icon_box icon_cmt">
                Comments: <?php comments_popup_link( '0', '1', '%' ); ?>
            </div>
            <div class="icon_box icon_readmore"> 
                <a href="<?php the_permalink(); ?>"><?php echo __( 'Read more', 'twentyeleven' ); ?></a>
            </div>
        </div>
        <div class="clear"></div>
	</div>
	<?php
}

/****************************** display function for spektrum layout *************************************/

function wp_spektrum_layout(){
	?>
    
	<div class="blog_template col-lg-6 spektrum">
		<div class="blog_header">
			<?php if ( has_post_thumbnail( $post->ID ) ) { the_post_thumbnail( 'full' );} else { echo '<img src="' . plugins_url( 'images/no_image.jpg', __FILE__ ) . '" alt="No Imges" />';}?>
        </div>
        <div class="post_content">
            <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            <div class="clear"></div>
            <div class="post_detail post_date">
				<span class="post_info_date">
			    	<span class="mdate"><?php the_time( __( 'd M, Y' ) );?></span>
                </span>
            </div>
            <?php if( get_option( 'rss_use_excerpt' ) == 0 ):?>
                <?php the_content(); ?>
            <?php else:?>
                <?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) );?>
            <?php endif;?>
        </div>
	</div>
	<?php
}


/****************************** display function for evolution layout *************************************/

function wp_evolution_layout(){
	?>
    
	<div class="blog_template evolution">
        <div class="blog_header">
            <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            <div class="col-lg-2 margin_top padding_left">
            	<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                <span class="date"><?php the_time( __( 'd M Y' ) );?></span>
            </div>
            <div class="col-lg-3 margin_top">
                <div class="metadate">
            		<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    Posted by <span class="author"><?php the_author();?></span>
                </div>
            </div>
            <div class="col-lg-2 right">
            	<span class="comment"><?php comments_popup_link( '0 Comment', '1 Comment', '% Comments' ); ?></span>
            </div>    
        </div>
        <?php if ( has_post_thumbnail() ) { ?>
        <div class="col-lg-6 padding_left margin_top_20">
			<?php the_post_thumbnail( 'full' );?>
        </div>
        <?php } ?>
        <div class="<?php if ( has_post_thumbnail() ) { ?>col-lg-6<?php } else { ?>col-lg-12 padding_left<?php } ?> margin_top_20">
            <div class="post_content">
                <?php if( get_option( 'rss_use_excerpt' ) == 0 ):?>
                    <?php the_content(); ?>
                <?php else:?>
                    <?php the_excerpt();?>
                <?php endif;?>
            </div>
            <a href="<?php the_permalink();?>" class="read_more">Read more &raquo;</a>
        </div>
	</div>
	<?php
}


function wp_blog_layouts_menu_function() {
?>

<div class="wrap">
    <h2><?php _e( 'Blog Layouts Settings', 'wp-blog_layouts' ) ?></h2>
    <?php if ( 'true' == esc_attr( $_GET['updated'] ) ) echo '<div class="updated" ><p>Layout Settings updated.</p></div>';?>
    <?php $settings			=	get_option( "wp_blog_layouts_settings" );?>
    <form method="post" action="?page=layouts_settings&action=save&updated=true">
        <div class="wl-pages" >
            <div class="wl-page wl-settings active">
                <div class="wl-box wl-settings">
                    <h3 class="header"><?php _e( 'General Settings', 'wp-blog_layouts' ) ?></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td><?php _e( 'Blog Page', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                        <?php printf( __( '%s' ), wp_dropdown_pages( array( 'name' => 'page_on_front', 'echo' => 0, 'show_option_none' => __( '&mdash; Select &mdash;' ), 'option_none_value' => '0', 'selected' => get_option( 'page_on_front' ) ) ) ); ?>
                                     </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Posts per Page', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                        <input name="posts_per_page" type="number" step="1" min="1" id="posts_per_page" value="<?php echo get_option( 'posts_per_page' ); ?>" class="small-text" /> <?php _e( 'posts' ); ?>
                                     </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'For each article in a feed, show ', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                        <input name="rss_use_excerpt" type="radio" value="0" <?php checked( 0, get_option( 'rss_use_excerpt' ) ); ?>	/> <?php _e( 'Full text' ); ?>
                                        <input name="rss_use_excerpt" type="radio" value="1" <?php checked( 1, get_option( 'rss_use_excerpt' ) ); ?> /> <?php _e( 'Summary' ); ?>
                                     </td>
                                </tr>
                            </tbody>
                        </table>
                        <h3 class="header"><?php _e( 'Global Settings', 'wp-blog_layouts' ) ?></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td><?php _e( 'Categories', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                    	<?php $categories 	=	get_categories( array( 'child_of' => '', 'hide_empty' => 1 ) );?>
                                        <select name="template_category[]" id="template_category" multiple="multiple">
                                        	<option value="-1" <?php selected( $categoryObj->term_id, -1 ); ?>><?php echo 'All';?></option>
                                        	<?php foreach( $categories as $categoryObj ):?>
                                            	<option value="<?php echo $categoryObj->term_id;?>" <?php if( @in_array( $categoryObj->term_id, $settings['template_category'] ) ) { echo 'selected="selected"'; } ?>><?php echo $categoryObj->name;?></option>
                                            <?php endforeach;?>
                                        </select>
                                     </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Blog Templates', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                        <select name="template_name" id="template_name">
                                        	<option value="">---select---</option>
                                            <option value="classical" <?php selected( $settings["template_name"], 'classical' ); ?>>Classical</option>
                                            <option value="lightbreeze" <?php selected( $settings["template_name"], 'lightbreeze' ); ?>>Light Breeze</option>
                                            <option value="spektrum" <?php selected( $settings["template_name"], 'spektrum' ); ?>>Spektrum</option>
                                            <option value="evolution" <?php selected( $settings["template_name"], 'evolution' ); ?>>Evolution</option>
                                        </select>
                                     </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Choose a background color for blog layout', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                        <div id="bgcolorSelector"><div style="background-color:<?php echo $settings["template_bgcolor"];?>"></div></div>
                                        <input type="hidden" name="template_bgcolor" id="template_bgcolor" value="<?php echo $settings["template_bgcolor"];?>"/>
                                     </td>
                                </tr>
                             </tbody>
                        </table>
                        <h3 class="header"><?php _e( 'Heading Settings', 'wp-blog_layouts' ) ?></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td><?php _e( 'Font Family', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                        <select id="font_family" name="font_family">
                                            <option value="Arial" <?php selected( $settings["font_family"], 'Arial' ); ?>>Arial</option>
                                            <option value="Verdana" <?php selected( $settings["font_family"], 'Verdana' ); ?>>Verdana</option>
                                            <option value="Helvetica" <?php selected( $settings["font_family"], 'Helvetica' ); ?>>Helvetica</option>
                                            <option value="Comic Sans MS" <?php selected( $settings["font_family"], 'Comic Sans MS' ); ?>>Comic Sans MS</option>
                                            <option value="Georgia" <?php selected( $settings["font_family"], 'Georgia' ); ?>>Georgia</option>
                                            <option value="Trebuchet MS" <?php selected( $settings["font_family"], 'Trebuchet MS' ); ?>>Trebuchet MS</option>
                                            <option value="Times New Roman" <?php selected( $settings["font_family"], 'Times New Roman' ); ?>>Times New Roman</option>
                                            <option value="Tahoma" <?php selected( $settings["font_family"], 'Tahoma' ); ?>>Tahoma</option>
                                            <option value="Oswald" <?php selected( $settings["font_family"], 'Oswald' ); ?>>Oswald</option>
                                            <option value="Open Sans" <?php selected( $settings["font_family"], 'Open Sans' ); ?>>Open Sans</option>
                                            <option value="Fontdiner Swanky" <?php selected( $settings["font_family"], 'Fontdiner Swanky' ); ?>>Fontdiner Swanky</option>
                                            <option value="Crafty Girls" <?php selected( $settings["font_family"], 'Crafty Girls' ); ?>>Crafty Girls</option>
                                            <option value="Pacifico" <?php selected( $settings["font_family"], 'Pacifico' ); ?>>Pacifico</option>
                                            <option value="Satisfy" <?php selected( $settings["font_family"], 'Satisfy' ); ?>>Satisfy</option>
                                            <option value="Gloria Hallelujah" <?php selected( $settings["font_family"], 'TGloria Hallelujah' ); ?>>TGloria Hallelujah</option>
                                            <option value="Bangers" <?php selected( $settings["font_family"], 'Bangers' ); ?>>Bangers</option>
                                            <option value="Audiowide" <?php selected( $settings["font_family"], 'Audiowide' ); ?>>Audiowide</option>
                                            <option value="Sacramento" <?php selected( $settings["font_family"], 'Sacramento' ); ?>>Sacramento</option>
                                        </select>
                                     </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Font Size', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                        <input name="font_size" type="number" step="1" min="1" value="<?php echo $settings["font_size"]; ?>" class="small-text" />
                                     </td>
                                </tr>                                
                                <tr>
                                    <td><?php _e( 'Font Color', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                        <div id="ftcolorSelector"><div style="background-color:<?php echo $settings["template_ftcolor"];?>"></div></div>
                                        <input type="hidden" name="template_ftcolor" id="template_ftcolor" value="<?php echo $settings["template_ftcolor"];?>"/>
                                     </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Hover Color', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                        <div id="hvcolorSelector"><div style="background-color:<?php echo $settings["template_hvcolor"];?>"></div></div>
                                        <input type="hidden" name="template_hvcolor" id="template_hvcolor" value="<?php echo $settings["template_hvcolor"];?>"/>
                                     </td>
                                </tr>
                            </tbody>
                        </table>
                        <h3 class="header"><?php _e( 'Content Settings', 'wp-blog_layouts' ) ?></h3>
                        <table>
                            <tbody>
                                <tr>
                                    <td><?php _e( 'Font Family', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                        <select id="font_family" name="cfont_family">
                                            <option value="Arial" <?php selected( $settings["cfont_family"], 'Arial' ); ?>>Arial</option>
                                            <option value="Verdana" <?php selected( $settings["cfont_family"], 'Verdana' ); ?>>Verdana</option>
                                            <option value="Helvetica" <?php selected( $settings["cfont_family"], 'Helvetica' ); ?>>Helvetica</option>
                                            <option value="Comic Sans MS" <?php selected( $settings["cfont_family"], 'Comic Sans MS' ); ?>>Comic Sans MS</option>
                                            <option value="Georgia" <?php selected( $settings["cfont_family"], 'Georgia' ); ?>>Georgia</option>
                                            <option value="Trebuchet MS" <?php selected( $settings["cfont_family"], 'Trebuchet MS' ); ?>>Trebuchet MS</option>
                                            <option value="Times New Roman" <?php selected( $settings["cfont_family"], 'Times New Roman' ); ?>>Times New Roman</option>
                                            <option value="Tahoma" <?php selected( $settings["cfont_family"], 'Tahoma' ); ?>>Tahoma</option>
                                            <option value="Oswald" <?php selected( $settings["cfont_family"], 'Oswald' ); ?>>Oswald</option>
                                            <option value="Open Sans" <?php selected( $settings["cfont_family"], 'Open Sans' ); ?>>Open Sans</option>
                                            <option value="Fontdiner Swanky" <?php selected( $settings["cfont_family"], 'Fontdiner Swanky' ); ?>>Fontdiner Swanky</option>
                                            <option value="Crafty Girls" <?php selected( $settings["cfont_family"], 'Crafty Girls' ); ?>>Crafty Girls</option>
                                            <option value="Pacifico" <?php selected( $settings["cfont_family"], 'Pacifico' ); ?>>Pacifico</option>
                                            <option value="Satisfy" <?php selected( $settings["cfont_family"], 'Satisfy' ); ?>>Satisfy</option>
                                            <option value="Gloria Hallelujah" <?php selected( $settings["cfont_family"], 'TGloria Hallelujah' ); ?>>TGloria Hallelujah</option>
                                            <option value="Bangers" <?php selected( $settings["cfont_family"], 'Bangers' ); ?>>Bangers</option>
                                            <option value="Audiowide" <?php selected( $settings["cfont_family"], 'Audiowide' ); ?>>Audiowide</option>
                                            <option value="Sacramento" <?php selected( $settings["cfont_family"], 'Sacramento' ); ?>>Sacramento</option>
                                        </select>
                                     </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Font Size', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                        <input name="cfont_size" type="number" step="1" min="1" value="<?php echo $settings["cfont_size"]; ?>" class="small-text" />
                                     </td>
                                </tr>                                
                                <tr>
                                    <td><?php _e( 'Font Color', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                        <div id="fccolorSelector"><div style="background-color:<?php echo $settings["template_fccolor"];?>"></div></div>
                                        <input type="hidden" name="template_fccolor" id="template_fccolor" value="<?php echo $settings["template_fccolor"];?>"/>
                                     </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Button background', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                        <div id="btnbgcolorSelector"><div style="background-color:<?php echo $settings["template_btnbgcolor"];?>"></div></div>
                                        <input type="hidden" name="template_btnbgcolor" id="template_btnbgcolor" value="<?php echo $settings["template_btnbgcolor"];?>"/>
                                     </td>
                                </tr>
                                <tr>
                                    <td><?php _e( 'Button Color', 'wp-blog_layouts' ) ?></td>
                                    <td>
                                        <div id="btncolorSelector"><div style="background-color:<?php echo $settings["template_btncolor"];?>"></div></div>
                                        <input type="hidden" name="template_btncolor" id="template_btncolor" value="<?php echo $settings["template_btncolor"];?>"/>
                                     </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
        <div class="wl-box wl-publish">
            <h3 class="header"><?php _e('Publish', 'wp-blog_layouts') ?></h3>
            <div class="inner">
                <input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'wp-blog_layouts' ); ?>" />
                <p class="wl-saving-warning"></p>
                <div class="clear"></div>
            </div>
        </div>
    </form>
</div>

<?php }
function lumia_pagination( $args = array() ) {
	
	if ( !is_array( $args ) ) {
		$argv = func_get_args();
		$args = array();
		foreach ( array( 'before', 'after', 'options' ) as $i => $key )
			$args[ $key ] = $argv[ $i ];
	}
	$args = wp_parse_args( $args, array(
		'before' => '',
		'after' => '',
		'options' => array(),
		'query' => $GLOBALS['wp_query'],
		'type' => 'posts',
		'echo' => true
	) );

	extract( $args, EXTR_SKIP );
	$instance = new LBNavi_Call( $args );	

	list( $posts_per_page, $paged, $total_pages ) = $instance->get_pagination_args();

	if ( 1 == $total_pages && !$options['always_show'] )
		return;

	$pages_to_show = 100;
	$larger_page_to_show = 3;
	$larger_page_multiple = 10;
	$pages_to_show_minus_1 = $pages_to_show - 1;
	$half_page_start = floor( $pages_to_show_minus_1/2 );
	$half_page_end = ceil( $pages_to_show_minus_1/2 );
	$start_page = $paged - $half_page_start;

	if ( $start_page <= 0 )
		$start_page = 1;

	$end_page = $paged + $half_page_end;

	if ( ( $end_page - $start_page ) != $pages_to_show_minus_1 )
		$end_page = $start_page + $pages_to_show_minus_1;

	if ( $end_page > $total_pages ) {
		$start_page = $total_pages - $pages_to_show_minus_1;
		$end_page = $total_pages;
	}

	if ( $start_page < 1 )
		$start_page = 1;

	$out = '';
	$options['style']				=	1;
	$options['pages_text']			=	'Page %CURRENT_PAGE% of %TOTAL_PAGES%';
	$options['current_text']		=	'%PAGE_NUMBER%';
	$options['page_text']			=	'%PAGE_NUMBER%';
	$options['first_text']			=	'&laquo; First';
	$options['last_text']			=	'Last &raquo;';
	$options['prev_text']			=	'';
	$options['next_text']			=	'';
	$options['dotright_text']		=	'';
	
	switch ( intval( $options['style'] ) ) {
		
		
		// Normal
		case 1:
			// Text
			if ( !empty( $options['pages_text'] ) ) {
				$pages_text = str_replace(
					array( "%CURRENT_PAGE%", "%TOTAL_PAGES%" ),
					array( number_format_i18n( $paged ), number_format_i18n( $total_pages ) ),
				$options['pages_text'] );
				$out .= "<span class='pages'>$pages_text</span>";
			}

			if ( $start_page >= 2 && $pages_to_show < $total_pages ) {
				// First
				$first_text = str_replace( '%TOTAL_PAGES%', number_format_i18n( $total_pages ), $options['first_text'] );
				$out .= $instance->get_single( 1, 'first', $first_text, '%TOTAL_PAGES%' );
			}

			// Previous
			if ( $paged > 1 && !empty( $options['prev_text'] ) )
				$out .= $instance->get_single( $paged - 1, 'previouspostslink', $options['prev_text'] );

			if ( $start_page >= 2 && $pages_to_show < $total_pages ) {
				if ( !empty( $options['dotleft_text'] ) )
					$out .= "<span class='extend'>{$options['dotleft_text']}</span>";
			}

			// Smaller pages
			$larger_pages_array = array();
			if ( $larger_page_multiple )
				for ( $i = $larger_page_multiple; $i <= $total_pages; $i+= $larger_page_multiple )
					$larger_pages_array[] = $i;

			$larger_page_start = 0;
			foreach ( $larger_pages_array as $larger_page ) {
				if ( $larger_page < ($start_page - $half_page_start) && $larger_page_start < $larger_page_to_show ) {
					$out .= $instance->get_single( $larger_page, 'smaller page', $options['page_text'] );
					$larger_page_start++;
				}
			}

			if ( $larger_page_start )
				$out .= "<span class='extend'>{$options['dotleft_text']}</span>";

			// Page numbers
			$timeline = 'smaller';
			foreach ( range( $start_page, $end_page ) as $i ) {
				if ( $i == $paged && !empty( $options['current_text'] ) ) {
					$current_page_text = str_replace( '%PAGE_NUMBER%', number_format_i18n( $i ), $options['current_text'] );
					$out .= "<span class='current'>$current_page_text</span>";
					$timeline = 'larger';
				} else {
					$out .= $instance->get_single( $i, "page $timeline", $options['page_text'] );
				}
			}

			// Large pages
			$larger_page_end = 0;
			$larger_page_out = '';
			foreach ( $larger_pages_array as $larger_page ) {
				if ( $larger_page > ($end_page + $half_page_end) && $larger_page_end < $larger_page_to_show ) {
					$larger_page_out .= $instance->get_single( $larger_page, 'larger page', $options['page_text'] );
					$larger_page_end++;
				}
			}

			if ( $larger_page_out ) {
				$out .= "<span class='extend'>{$options['dotright_text']}</span>";
			}
			$out .= $larger_page_out;

			if ( $end_page < $total_pages ) {
				if ( !empty( $options['dotright_text'] ) )
					$out .= "<span class='extend'>{$options['dotright_text']}</span>";
			}

			// Next
			if ( $paged < $total_pages && !empty( $options['next_text'] ) )
				$out .= $instance->get_single( $paged + 1, 'nextpostslink', $options['next_text'] );

			if ( $end_page < $total_pages ) {
				// Last
				$out .= $instance->get_single( $total_pages, 'last', $options['last_text'], '%TOTAL_PAGES%' );
			}
			break;

		// Dropdown
		case 2:
			$out .= '<form action="" method="get">'."\n";
			$out .= '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">'."\n";

			foreach ( range( 1, $total_pages ) as $i ) {
				$page_num = $i;
				if ( $page_num == 1 )
					$page_num = 0;

				if ( $i == $paged ) {
					$current_page_text = str_replace( '%PAGE_NUMBER%', number_format_i18n( $i ), $options['current_text'] );
					$out .= '<option value="'.esc_url( $instance->get_url( $page_num ) ).'" selected="selected" class="current">'.$current_page_text."</option>\n";
				} else {
					$page_text = str_replace( '%PAGE_NUMBER%', number_format_i18n( $i ), $options['page_text'] );
					$out .= '<option value="'.esc_url( $instance->get_url( $page_num ) ).'">'.$page_text."</option>\n";
				}
			}

			$out .= "</select>\n";
			$out .= "</form>\n";
			break;
	}
	$out = $before . "<div class='wl_pagination'>\n$out\n</div>" . $after;

	$out = apply_filters( 'lumia_pagination', $out );

	if ( !$echo )
		return $out;

	echo $out;
}
class LBNavi_Call {

	protected $args;

	function __construct( $args ) {
		$this->args = $args;
	}

	function __get( $key ) {
		return $this->args[ $key ];
	}

	function get_pagination_args() {
		global $numpages;

		$query = $this->query;

		switch( $this->type ) {
		case 'multipart':
			// Multipart page
			$posts_per_page = 1;
			$paged = max( 1, absint( get_query_var( 'page' ) ) );
			$total_pages = max( 1, $numpages );
			break;
		case 'users':
			// WP_User_Query
			$posts_per_page = $query->query_vars['number'];
			$paged = max( 1, floor( $query->query_vars['offset'] / $posts_per_page ) + 1 );
			$total_pages = max( 1, ceil( $query->total_users / $posts_per_page ) );
			break;
		default:
			// WP_Query
			$posts_per_page = intval( $query->get( 'posts_per_page' ) );
			$paged = max( 1, absint( $query->get( 'paged' ) ) );
			$total_pages = max( 1, absint( $query->max_num_pages ) );
			break;
		}

		return array( $posts_per_page, $paged, $total_pages );
	}

	function get_single( $page, $class, $raw_text, $format = '%PAGE_NUMBER%' ) {
		if ( empty( $raw_text ) )
			return '';

		$text = str_replace( $format, number_format_i18n( $page ), $raw_text );

		return "<a href='" . esc_url( $this->get_url( $page ) ) . "' class='$class'>$text</a>";
	}

	function get_url( $page ) {
		return ( 'multipart' == $this->type ) ? get_multipage_link( $page ) : get_pagenum_link( $page );
	}
}

function lumiapaged(){
	if( strstr( $_SERVER['REQUEST_URI'], 'paged' ) || strstr( $_SERVER['REQUEST_URI'], 'page' ) ){
		if( isset( $_REQUEST['paged'] ) ){
			$paged						=	$_REQUEST['paged'];
		} else {
			$uri						=	explode( '/', $_SERVER['REQUEST_URI'] );
			$uri						=	array_reverse( $uri );
			$paged						=	$uri[1];
		}
	}else{
		$paged							=	1;
	}
	
	return $paged;
}

?>