<?php
/**
 * Template Name: Download-1 Page
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

if (isset($_POST['post_id'])) {
	$post_id=$_POST['post_id'];
}
if (isset($_POST['vers'])) {
    $vers=$_POST['vers'];
}

$post=get_post( $post_id );
$single_featured_image=get_field('single_featured_image',$post_id);
$date=$post->post_date;
$date=strtotime($date);

if(function_exists('get_field')){
    $download_instructions=get_field('download_instructions',$post_id);
	$author=get_field('author',$post_id);
	$size=get_field('size',$post_id);
    $pdf_version=get_field('pdf_version',$post_id);
    $filename= $pdf_version[$vers]['pdf_link']['title'];
    $file_url= $pdf_version[$vers]['pdf_link']['url'];
}
get_header(); ?>
			<div id="content-wrap">
				<div class="py-2 breadCrumbMainWrap">
					<div class="container singlePostBreadCrumb">
						<?php if (!is_front_page()) {
	ah_breadcrumb(); }?>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-9">
							<div class="main-content-wrap">
								<!-- Single_Download_Post -->
								<div class="post-detail-wrap bg-white border rounded shadow-sm p-3 mb-4">
									<div class="text-center">
										<img class="rounded-lg mb-3" src="<?php echo $single_featured_image['url'] ?>" alt="<?php echo $post->post_title ?>">
										<h1 class="h5 font-weight-semibold mb-3"><?php echo $post->post_title ?> - <?php echo $filename ?> -<?php echo get_term( $author )->name  ?></h1>
									</div>
									<div class="rounded text-center bg-light p-3 mb-3">
										<div class="text-center mb-2">
											<a class="btn btn-primary px-sm-5 download" href="<?php echo $file_url ?>" download="">
												<svg class="svg-5 mr-1" fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M528 288h-92.1l46.1-46.1c30.1-30.1 8.8-81.9-33.9-81.9h-64V48c0-26.5-21.5-48-48-48h-96c-26.5 0-48 21.5-48 48v112h-64c-42.6 0-64.2 51.7-33.9 81.9l46.1 46.1H48c-26.5 0-48 21.5-48 48v128c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V336c0-26.5-21.5-48-48-48zm-400-80h112V48h96v160h112L288 368 128 208zm400 256H48V336h140.1l65.9 65.9c18.8 18.8 49.1 18.7 67.9 0l65.9-65.9H528v128zm-88-64c0-13.3 10.7-24 24-24s24 10.7 24 24-10.7 24-24 24-24-10.7-24-24z"></path></svg>
												<span class="align-middle">
													Download (<?php echo $size ?>)	
												</span>
											</a>
										</div>
										<p class="text-center mb-0">
											If the download doesn't start in a few seconds,
											<a id="click-here" href="<?php echo $file_url ?>" download=""><span>click here</span></a>
										</p>
									</div>
								</div>
								 <?php
                                    $customTaxonomyTerms = wp_get_object_terms( $post->ID, 'book_cat', array('fields' => 'ids') );
                                    $args = array(
                                    'post_type'         => 'books',
                                    'post_status'       => 'publish',
                                    'posts_per_page' => '6',
                                    'orderby'           => 'date',
                                    'orderby' => 'rand',
                                    'post__not_in' => array ($post->ID),
                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'book_cat',
                                                            'field' => 'id',
                                                            'terms' => $customTaxonomyTerms
                                                        )
                                                    ),                                   
                                    );
                                $recommended = new WP_Query( $args ); ?>
                                <section class="recommended-section bg-white border rounded shadow-sm px-3 pt-3 mb-4">
                                    <h2 class="section-title font-weight-bold mb-3">Related Topics</h2>
                                    <div class="row">
                                        <!-- category-post -->
                            <?php if($recommended->have_posts()):
                                        while($recommended->have_posts()): $recommended->the_post();
                                            $p_image=get_post_thumbnail_id($post->ID);
                                            $post_image=wp_get_attachment_image_url($p_image,'full'); 
                                           if (function_exists('get_field')) {
                                                $size=get_field('size',$post->id);
												$author=get_field('author',$post->id);
                                            }
                                         ?>     
                                            <div class="col-12 col-sm-6 col-xl-4">
                                                <a href="<?php echo get_permalink()?>" class="category-post" title="<?php echo get_the_title() ?>">
                                                    <div class="cp-wrap">
                                                        <div class="img-wrap">
                                                            <img src="<?php echo $post_image ?>" class="img-fluid" alt="<?php echo get_the_title() ?>">
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
														<div class="button-wrap">
															<span class="btn btn-primary btn-sm ml-auto">PDF</span>
														</div>
                                                    </div>
                                                </a>
                                            </div>
                                    <?php endwhile;
                                            // Restore original Post Data
                                            wp_reset_postdata();
                                        endif; ?>
                                    </div>
                                </section>
							</div>
						</div>
						<?php get_template_part( 'template-parts/content-sidebar' ); ?>
					</div>
				</div>
			</div>
	<?php get_footer()	?>