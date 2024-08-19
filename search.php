<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package PDFyolo
 */

get_header();
?>
	<header class="headBannerBlock bgCover textCenter">
			<div class="alignHolder">
				<div class="align">
					<div class="container">
						<h1 class="textUppercase fwBlack">Resluts for: <?php echo get_search_query(); ?></h1>
					</div>
				</div>
			</div>
	</header>
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
                		<div class="row">
                <?php
                if (have_posts()){

                	while(have_posts()){
			                		the_post();
			                		the_content();
			                		global $post;
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
													<div class="small text-truncate text-muted">
														<svg class="svg-6 svg-muted mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M567.938 243.908L462.25 85.374A48.003 48.003 0 0 0 422.311 64H153.689a48 48 0 0 0-39.938 21.374L8.062 243.908A47.994 47.994 0 0 0 0 270.533V400c0 26.51 21.49 48 48 48h480c26.51 0 48-21.49 48-48V270.533a47.994 47.994 0 0 0-8.062-26.625zM162.252 128h251.497l85.333 128H376l-32 64H232l-32-64H76.918l85.334-128z"></path></svg>
														<span class="align-middle">2023108.1.26390</span>
														<span class="align-middle"> + </span>
														<span class="align-middle">500M</span>
													</div>
													<div class="small text-truncate text-muted">
														<svg class="svg-6 svg-muted mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M501.1 395.7L384 278.6c-23.1-23.1-57.6-27.6-85.4-13.9L192 158.1V96L64 0 0 64l96 128h62.1l106.6 106.6c-13.6 27.8-9.2 62.3 13.9 85.4l117.1 117.1c14.6 14.6 38.2 14.6 52.7 0l52.7-52.7c14.5-14.6 14.5-38.2 0-52.7zM331.7 225c28.3 0 54.9 11 74.9 31l19.4 19.4c15.8-6.9 30.8-16.5 43.8-29.5 37.1-37.1 49.7-89.3 37.9-136.7-2.2-9-13.5-12.1-20.1-5.5l-74.4 74.4-67.9-11.3L334 98.9l74.4-74.4c6.6-6.6 3.4-17.9-5.7-20.2-47.4-11.7-99.6.9-136.6 37.9-28.5 28.5-41.9 66.1-41.2 103.6l82.1 82.1c8.1-1.9 16.5-2.9 24.7-2.9zm-103.9 82l-56.7-56.7L18.7 402.8c-25 25-25 65.5 0 90.5s65.5 25 90.5 0l123.6-123.6c-7.6-19.9-9.9-41.6-5-62.7zM64 472c-13.2 0-24-10.8-24-24 0-13.3 10.7-24 24-24s24 10.7 24 24c0 13.2-10.7 24-24 24z"></path></svg>
														<span class="align-middle">Free Purchase</span>
													</div>
												</div>
											</div>
										</a>
									</div>
							<!-- category-post -->
					<?php
					}
    			}else{ ?>
    				<div class="col-12 col-sm-12 col-xl-12">
    					<div class="alert alert-danger">Nothing found !</div>
    				</div>
    					 <?php
    			}
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
