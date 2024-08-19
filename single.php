<?php get_header();
setPostViews(get_the_ID());
 ?>
            <div id="content-wrap">
				<div class="py-2 breadCrumbMainWrap">
					<div class="container">
						<?php if (!is_front_page()) {
	ah_breadcrumb(); }?>
					</div>
				</div>
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-9">
                            <div class="main-content-wrap">

                            <?php
                                if (have_posts()){

                                    while(have_posts()){
                                        the_post();
                                        $date = get_post_time();
                                        $p_image=get_post_thumbnail_id($post->ID);
                                        $post_image=wp_get_attachment_image_url($p_image,'full'); 
                                        ?>
                                        <article id="content" class="content-section">
                                            <div class="rounded-lg mb-3 mb-md-4 position-relative">
                                                <h1 class="h2 font-weight-bold"><?php echo get_the_title() ?></h1>
                                                <div class="small text-muted mb-4"><?php echo date('F j, Y', $date) ?></div>
                                                <div class="text-center mb-3">
                                                    <img src="<?php echo $post_image ?>" class="img-fluid w-100" alt="image description">
                                                </div>
                                                <?php the_content(); ?>
                                            </div>
                                            <ul class="social-link-list d-flex list-unstyled mb-2">
                                                <li class="mr-2 mb-2">
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink()?>" class="facebook social-btn" rel="nofollow" target="_blank">
                                                        <svg class="svg-5 svg-secondary" fill="#fff" height="14px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg>
                                                        <span class="small d-none d-sm-inline">Facebook</span>
                                                    </a>
                                                </li>
                                                <li class="mr-2 mb-2">
                                                    <a href="https://twitter.com/home?status=<?php echo get_permalink()?>" class="twitter social-btn" rel="nofollow" target="_blank">
                                                        <svg class="svg-5 svg-secondary" fill="#fff" height="14px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg>
                                                        <span class="small d-none d-sm-inline">Twitter</span>
                                                    </a>
                                                </li>
                                                <li class="mr-2 mb-2">
                                                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo get_permalink()?>" class="pinterest social-btn" rel="nofollow" target="_blank">
                                                        <svg class="svg-5 svg-secondary" fill="#fff" height="14px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"></path></svg>
                                                        <span class="small d-none d-sm-inline">Pinterest</span>
                                                    </a>
                                                </li>
                                                <li class="mr-2 mb-2">
                                                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo get_permalink()?>&amp;title=Room Planner: <?php echo get_the_title() ?>&amp;summary=&amp;source=" class="linkedin social-btn" rel="nofollow" target="_blank">
                                                        <svg class="svg-5 svg-secondary" fill="#fff" height="14px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path></svg>
                                                        <span class="small d-none d-sm-inline">Linkedin</span>
                                                    </a>
                                                </li>
                                                <li class="mr-2 mb-2">
                                                    <a href="mailto:?subject=<?php echo get_the_title() ?>body=<?php echo get_permalink() ?>" class="email social-btn" rel="nofollow" target="_blank">
                                                        <svg class="svg-5 svg-secondary" fill="#fff" height="14px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm0 48v40.805c-22.422 18.259-58.168 46.651-134.587 106.49-16.841 13.247-50.201 45.072-73.413 44.701-23.208.375-56.579-31.459-73.413-44.701C106.18 199.465 70.425 171.067 48 152.805V112h416zM48 400V214.398c22.914 18.251 55.409 43.862 104.938 82.646 21.857 17.205 60.134 55.186 103.062 54.955 42.717.231 80.509-37.199 103.053-54.947 49.528-38.783 82.032-64.401 104.947-82.653V400H48z"></path></svg>
                                                        <span class="small d-none d-sm-inline">Email</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </article>
                                        <?php
                                    }
                                }else{ ?>
                                    <div class="col-12 col-sm-12 col-xl-12">
                                        <div class="alert alert-danger">Nothing found !</div>
                                    </div>
                                <?php
                                }
                                ?>
                                <!-- Single_Post -->
                                <?php
                                    $args = array(
                                    'post_type'         => array('books','novels'),
                                    'post_status'       => 'publish',
                                    'posts_per_page' => '6',
                                    'orderby'           => 'date',
                                    'orderby' => 'rand',
                                    'post__not_in' => array ($post->ID),                                    
                                    );
                                $related_topics = new WP_Query( $args ); ?>
                                <section class="recommended-section bg-white border rounded shadow-sm px-3 pt-3 mb-4">
                                    <h2 class="section-title font-weight-bold mb-3">Related Topics</h2>
                                    <div class="row">
                                        <!-- category-post -->
                            <?php if($related_topics->have_posts()):
                                        while($related_topics->have_posts()): $related_topics->the_post();
                                            $p_image=get_post_thumbnail_id($post->ID);
                                            $post_image=wp_get_attachment_image_url($p_image,'full'); 
                                            if (function_exists('get_field')) {
                                                $size=get_field('size',$post->id);
												$author=get_field('author',$post->id);
                                            }
                                         ?>     
                                            <div class="col-12 col-sm-6 col-xl-4">
                                                <a href="<?php echo get_permalink()?>" class="category-post" title="Concepts">
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
  <!--                               <section class="comment-section bg-white border rounded shadow-sm px-3 pt-3 mb-4">
                                    <h2 class="section-title font-weight-bold mb-3">Comments</h2>
                                    <ul class="commentList list-unstyled pl-0 mb-0">
                                        <li>
                                            <div class="d-flex mb-3 comment">
                                                <div class="text-center flex-shrink-0 mr-2">
                                                    <img src="images/img22.jpg" class="img-fluid rounded-circle" alt="image description" height="40" width="40">
                                                </div>
                                                <div class="bg-light flex-grow-1 p-2">
                                                    <div class="h6 text-break mb-1">Sello</div>
                                                    <div class="small text-break mb-1">Good ?</div>
                                                    <div class="small d-flex">
                                                        <a class="reply" href="javascript:void(0)"><span>Reply</span></a>
                                                        <span class="mx-2">-</span>
                                                        <time class="text-muted" datetime="November 21, 2022">November 21, 2022</time>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex mb-3 comment">
                                                <div class="text-center flex-shrink-0 mr-2">
                                                    <img src="images/img22.jpg" class="img-fluid rounded-circle" alt="image description" height="40" width="40">
                                                </div>
                                                <div class="bg-light flex-grow-1 p-2">
                                                    <div class="h6 text-break mb-1">Yuan</div>
                                                    <div class="small text-break mb-1">good</div>
                                                    <div class="small d-flex">
                                                        <a class="reply" href="javascript:void(0)"><span>Reply</span></a>
                                                        <span class="mx-2">-</span>
                                                        <time class="text-muted" datetime="October 13, 2022">October 13, 2022</time>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex mb-3 comment">
                                                <div class="text-center flex-shrink-0 mr-2">
                                                    <img src="images/img22.jpg" class="img-fluid rounded-circle" alt="image description" height="40" width="40">
                                                </div>
                                                <div class="bg-light flex-grow-1 p-2">
                                                    <div class="h6 text-break mb-1">Dheena</div>
                                                    <div class="small text-break mb-1">I like thish app</div>
                                                    <div class="small d-flex">
                                                        <a class="reply" href="javascript:void(0)"><span>Reply</span></a>
                                                        <span class="mx-2">-</span>
                                                        <time class="text-muted" datetime="August 27, 2022">August 27, 2022</time>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex mb-3 comment">
                                                <div class="text-center flex-shrink-0 mr-2">
                                                    <img src="images/img22.jpg" class="img-fluid rounded-circle" alt="image description" height="40" width="40">
                                                </div>
                                                <div class="bg-light flex-grow-1 p-2">
                                                    <div class="h6 text-break mb-1">Rangga</div>
                                                    <div class="small text-break mb-1">Cerita ini sangatbagus</div>
                                                    <div class="small d-flex">
                                                        <a class="reply" href="javascript:void(0)"><span>Reply</span></a>
                                                        <span class="mx-2">-</span>
                                                        <time class="text-muted" datetime="August 20, 2022">August 20, 2022</time>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>   
                                </section> -->
								<section class="review-section bg-white border rounded shadow-sm px-3 pt-3 mb-4">
								 <?php
									//Declare Vars
									$comment_send = 'Send Comment';
									$comment_reply = 'Leave a Comment';
									$comment_reply_to = 'Reply';

									$comment_author = 'Name';
									$comment_email = 'Email';
									$comment_body = 'Comment';


									$comment_cancel = 'Cancel Reply';

									//Array
									$comments_args = array(
										//Define Fields
										'fields' => array(
											//Author field
											'author' => '<div class="col-12 col-sm-6 form-group"><p class="comment-form-author"><input id="author" class="form-control" name="author" aria-required="true" placeholder="' . $comment_author .'"></input></p></div>',
											//Email Field
											'email' => '<div class="col-12 col-sm-6 form-group"><p class="comment-form-email"><input id="email" class="form-control" name="email" placeholder="' . $comment_email .'"></input></p></div>',
											//Cookies
											'cookies' => '<input type="checkbox" required>' . $comment_cookies_1 . '<a href="' . get_privacy_policy_url() . '">' . $comment_cookies_2 . '</a></div>',
										),
										// Change the title of send button
										'label_submit' => __( $comment_send ),
										// Change the title of the reply section
										'title_reply' => __( $comment_reply ),
										// Change the title of the reply section
										'title_reply_to' => __( $comment_reply_to ),
										//Cancel Reply Text
										'cancel_reply_link' => __( $comment_cancel ),
										// Redefine your own textarea (the comment body).
										'comment_field' => '<div class="row"><div class="col-12 form-group"><p class="comment-form-comment"><textarea id="comment" name="comment" class="form-control" rows="3" aria-required="true" placeholder="' . $comment_body .'"></textarea></p></div>',
										//Message Before Comment
										'comment_notes_before' => __( $comment_before),
										// Remove "Text or HTML to be displayed after the set of comment fields".
										'comment_notes_after' => '',
										//Submit Button ID
										'id_submit' => __( 'comment-submit' ),
									);
									comment_form( $comments_args );

                                  ?>
								</section>
                            </div>
                        </div>
                    
                        <div class="col-12 col-lg-3">
                            <div class="widget-area-wrap">
                                <aside class="widget-sidebar">
                                    <!-- Latest_Updates_Widget -->
                                    <?php $post_id= get_the_ID();
                                        $current_post_type = get_post_type($post_id);
                                        $query_args = array( 
                                            'post_type'      => $current_post_type,
                                            'post__not_in'    => array($post_id),
                                            'posts_per_page' => 6,
                                            'orderby' => 'date',
                                            'sort_order' => 'desc',
                                        );
                                    $related_products = new WP_Query( $query_args ); ?>
                                    <section class="content-section">
                                        <h2 class="h5 font-weight-semibold mb-3">Latest Updates</h2>

                                        <?php if($related_products->have_posts()):
                                                    while($related_products->have_posts()): $related_products->the_post();
                                                    $p_image=get_post_thumbnail_id($post->ID);
                                                    $post_image=wp_get_attachment_image_url($p_image,'full'); 
                                                     ?> 

                                                    <div class="mb-4 latest-cat-post">
                                                        <a href="<?php echo the_permalink(); ?>" class="d-flex position-relative archive-post" title="<?php echo the_title(); ?>">
                                                            <div class="flex-shrink-0 mr-2" style="width: 4rem;">
                                                                <img width="96" height="96" src="<?php echo $post_image?>" class="rounded-lg img-fluid" alt="<?php echo the_title(); ?>">
                                                            </div>
                                                            <h3 class="font-size-body font-weight-normal text-body mb-0"><?php echo the_title(); ?></h3>
                                                        </a>
                                                    </div>
                                                    <?php endwhile;
                                                    // Restore original Post Data
                                                    wp_reset_postdata();
                                                endif; ?>
                                    </section>

                                    <?php 
                                        $query_args = array( 
                                            'post_type'      => $current_post_type,
                                            'posts_per_page' => 6,
                                            'meta_key'=>'post_views_count',
                                            'orderby' => 'meta_value_num',
                                            'order' => 'DESC'
                                        );
                                    $populer_prodcuts = new WP_Query( $query_args ); ?>

                                    <!-- Popular_Widget -->
                                    <section class="content-section">
                                        <h2 class="h5 font-weight-semibold mb-3">Popular</h2>

                                        <?php if($populer_prodcuts->have_posts()):
                                                    while($populer_prodcuts->have_posts()): $populer_prodcuts->the_post();
                                                    $p_image=get_post_thumbnail_id($post->ID);
                                                    $post_image=wp_get_attachment_image_url($p_image,'full'); 
                                                     ?> 

                                                    <div class="mb-4 latest-cat-post">
                                                        <a href="<?php echo the_permalink(); ?>" class="d-flex position-relative archive-post" title="<?php echo the_title(); ?>">
                                                            <div class="flex-shrink-0 mr-2" style="width: 4rem;">
                                                                <img width="96" height="96" src="<?php echo $post_image?>" class="rounded-lg img-fluid" alt="<?php echo the_title(); ?>">
                                                            </div>
                                                            <h3 class="font-size-body font-weight-normal text-body mb-0"><?php echo the_title(); ?></h3>
                                                        </a>
                                                    </div>
                                                    <?php endwhile;
                                                    // Restore original Post Data
                                                    wp_reset_postdata();
                                                endif; ?>
                                    </section>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php get_footer() ?>