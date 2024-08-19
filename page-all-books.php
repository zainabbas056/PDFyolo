<?php
/**
 * Template Name: Books All Category
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PDFyolo
 */

get_header(); ?>

<div id="content-wrap">
    <div class="py-2 breadCrumbMainWrap">
        <div class="container">
            <?php if (!is_front_page()) {
             ah_breadcrumb(); }?>
        </div>
    </div>
    <div class="container pt-3">
        <div class="row">
            <div class="col-12 col-lg-9">
                <div class="main-content-wrap">
                	<section class="content-section">
						<header class="section-header">
							<h2 class="h2"><a href="#" class="text-link"><?php echo get_the_title() ?></a></h2>
						</header>
						<div class="row">
			                <?php
			                if(is_front_page()){                 
				                $paged = (get_query_var('page')) ? get_query_var('page') : 1;   
				             }else{
				                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  
				             }
							$args = array(
								'post_type'         => 'books',
								'post_status'       => 'publish',
								'posts_per_page' => '24',
								'orderby'           => 'date',
								'order'             =>  "DESC",
								'paged'       =>  $paged,
							);
							query_posts($args);
			                if (have_posts()){

			                	while(have_posts()){
			                		the_post();
			                		global $post;
									if (function_exists('get_field')) {
										$size=get_field('size',$post->id);
										$author=get_field('author',$post->id);
									}
			                        $post_id =$post->id;
			                        $img_url = wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?>

									<!-- category-post -->
									<div class="col-12 col-sm-6 col-xl-4">
										<a href="<?php echo get_post_permalink() ?>" class="category-post" title="<?php echo get_the_title() ?>">
											<div class="cp-wrap">
												<div class="img-wrap">
													<img src="<?php echo $img_url ?>" class="img-fluid" alt="<?php echo get_the_title() ?>">
												</div>
												<div class="content-wrap">
													<h6 class="h6"><?php echo get_the_title() ?></h6>
													<?php if(!empty($size)){ ?>
													<div class="small text-truncate text-muted">
														<svg class="svg-6 svg-muted mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M567.938 243.908L462.25 85.374A48.003 48.003 0 0 0 422.311 64H153.689a48 48 0 0 0-39.938 21.374L8.062 243.908A47.994 47.994 0 0 0 0 270.533V400c0 26.51 21.49 48 48 48h480c26.51 0 48-21.49 48-48V270.533a47.994 47.994 0 0 0-8.062-26.625zM162.252 128h251.497l85.333 128H376l-32 64H232l-32-64H76.918l85.334-128z"></path></svg>
														<span class="align-middle"><?php echo $size ?></span>
													</div>
													<?php	}
													if(!empty($author)){
													?>
													<div class="small text-truncate text-muted">
														<svg class="svg-6 svg-muted mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16"><path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/></svg>
														<span class="align-middle"><?php echo get_term( $author )->name ?></span>
													</div>
													<?php } ?>   
												</div>
											</div>
										</a>
									</div>
							<!-- category-post -->
								<?php
								}
							} 
							echo PDFyolo_PDFyolo_pagination();
							wp_reset_query();
							
							?>
						</div>
				</section>
            </div>
        </div>
            <?php get_template_part( 'template-parts/content-sidebar' ); ?>
        </div>
    </div>
</div>

        <?php

get_footer();
	