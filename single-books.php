<?php
/**
 * The template for displaying all pages
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

if ( function_exists('get_field') ) {
        $telegram_url= get_field('telegram_url','options');
    }
    if (empty($telegram_url)) {
        $telegram_url="#";
    }
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
                <?php
                if (have_posts()){

                	while(have_posts()){
                		the_post();

                        if (function_exists('get_field')) {
                            $post_id=get_the_id();
                            $author=get_field('author',$post_id);
                            $mod_info=get_field('mod_info',$post_id);
                            $genere=get_field('genere',$post_id);
                            $genere = get_term_by('term_id', $genere, 'book_cat'); 
                            $genere_link=get_term_link($genere);
                            $genere_name = $genere->name;  

                            $size=get_field('size',$post_id);
                            $updated_on=get_field('updated_on',$post_id);
                            $pages_count=get_field('pages_count',$post_id);
                            $release_date=get_field('release_date',$post_id);
                            $single_featured_image=get_field('single_featured_image',$post_id);
                            $download_instructions=get_field('download_instructions',$post_id);
                            // $date = get_post_time();
                            
                        }
                        
                        
                        

                		?>
                            <article id="content" class="content-section">
                                    <div class="rounded-lg mb-3 mb-md-4 position-relative" style="height: 300px">
                                        <img class="rounded-lg d-block object-cover img-fluid" src="<?php echo $single_featured_image['url'] ?>" alt="Nobodies: Murder Cleaner" style="height: 100%; width: 100%; object-fit: cover;">
                                        <div class="bg-overlay text-center text-white rounded-lg p-4 p-md-5 d-flex align-items-center justify-content-center position-absolute">
                                            <div class="px-md-3">
                                                <h1 class="h2 font-weight-bold"><?php echo get_the_title() ?></h1>
                                               <!--  <time class="d-block">
                                                <svg class="svg-5 svg-white mr-1" fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C201.7 512 151.2 495 109.7 466.1C95.2 455.1 91.64 436 101.8 421.5C111.9 407 131.8 403.5 146.3 413.6C177.4 435.3 215.2 448 256 448C362 448 448 362 448 256C448 149.1 362 64 256 64C202.1 64 155 85.46 120.2 120.2L151 151C166.1 166.1 155.4 192 134.1 192H24C10.75 192 0 181.3 0 168V57.94C0 36.56 25.85 25.85 40.97 40.97L74.98 74.98C121.3 28.69 185.3 0 255.1 0L256 0zM256 128C269.3 128 280 138.7 280 152V246.1L344.1 311C354.3 320.4 354.3 335.6 344.1 344.1C335.6 354.3 320.4 354.3 311 344.1L239 272.1C234.5 268.5 232 262.4 232 256V152C232 138.7 242.7 128 256 128V128z"></path></svg>
                                                <em class="align-middle">
                                                    <?php echo date('F j, Y', $date) ?>
                                                </em>
                                                </time> -->
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-borderless">
                                        <tbody>
                                             <?php if (!empty(get_the_title())) { ?>
                                            <tr>
                                                <th style="width: 45%;">
                                                    <svg class="svg-5 svg-secondary mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-half" viewBox="0 0 16 16">
                                                        <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                                    </svg>
                                                   App name
                                                </th>
                                                <td style="width: 55%;"><?php echo get_the_title() ?></td>
                                            </tr>
                                            <tr>
                                                <th style="width: 45%;">
                                                    <svg class="svg-5 svg-secondary mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                                    </svg>
                                                    Author
                                                </th>
                                                <td style="width: 55%;"><a href="#" class="anchore-link"><?php echo $author ?></a></td>
                                            </tr>
                                            <?php } if (!empty($genere_name)) { ?>
                                            
                                                <tr>
                                                    <th style="width: 45%;">
                                                        <svg class="svg-5 svg-secondary mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-laughing-fill" viewBox="0 0 16 16">
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5c0 .501-.164.396-.415.235C6.42 6.629 6.218 6.5 6 6.5c-.218 0-.42.13-.585.235C5.164 6.896 5 7 5 6.5 5 5.672 5.448 5 6 5s1 .672 1 1.5zm5.331 3a1 1 0 0 1 0 1A4.998 4.998 0 0 1 8 13a4.998 4.998 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5zm-1.746-2.765C10.42 6.629 10.218 6.5 10 6.5c-.218 0-.42.13-.585.235C9.164 6.896 9 7 9 6.5c0-.828.448-1.5 1-1.5s1 .672 1 1.5c0 .501-.164.396-.415.235z"/>
                                                        </svg>
                                                        Genre
                                                    </th>
                                                    <td style="width: 55%;"><a href="<?php echo $genere_link ?>" class="anchore-link"><?php echo $genere_name ?></a></td>
                                                </tr>
                                            <?php } if (!empty($size)) {  ?>
                                            <tr>
                                                <th style="width: 45%;">
                                                    <svg class="svg-5 svg-secondary mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hdd-fill" viewBox="0 0 16 16">
                                                        <path d="M0 10a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-1zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2 0a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zM.91 7.204A2.993 2.993 0 0 1 2 7h12c.384 0 .752.072 1.09.204l-1.867-3.422A1.5 1.5 0 0 0 11.906 3H4.094a1.5 1.5 0 0 0-1.317.782L.91 7.204z"/>
                                                    </svg>
                                                    Size
                                                </th>
                                                <td style="width: 55%;"><?php echo $size ?></td>
                                            </tr>
                                            <?php } if (!empty($updated_on)) {  ?>
                                            <tr>
                                                <th style="width: 45%;">
                                                    <svg class="svg-5 svg-secondary mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lightning-fill" viewBox="0 0 16 16">
                                                        <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641l2.5-8.5z"/>
                                                    </svg>
                                                    Update On
                                                </th>
                                                <td style="width: 55%;"><time datetime="2008-02-14 20:00"><?php echo $updated_on ?></time></td>
                                            </tr>
                                            <?php } if (!empty($pages_count)) {  ?>
                                            <tr>
                                                <th style="width: 45%;">
                                                    <svg class="svg-5 svg-secondary mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text-fill" viewBox="0 0 16 16">
                                                        <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
                                                    </svg>
                                                    Pages
                                                </th>
                                                <td style="width: 55%;"><?php echo $pages_count ?> </td>
                                            </tr>
                                            <?php } if (!empty($release_date)) {  ?>
                                            <tr>
                                                <th style="width: 45%;">
                                                    <svg class="svg-5 svg-secondary mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-rocket-fill" viewBox="0 0 16 16">
                                                        <path d="M10.175 1.991c.81 1.312 1.583 3.43 1.778 6.819l1.5 1.83A2.5 2.5 0 0 1 14 12.202V15.5a.5.5 0 0 1-.9.3l-1.125-1.5c-.166-.222-.42-.4-.752-.57-.214-.108-.414-.192-.627-.282l-.196-.083C9.7 13.793 8.85 14 8 14c-.85 0-1.7-.207-2.4-.635-.068.03-.133.057-.198.084-.211.089-.411.173-.625.281-.332.17-.586.348-.752.57L2.9 15.8a.5.5 0 0 1-.9-.3v-3.298a2.5 2.5 0 0 1 .548-1.562l.004-.005L4.049 8.81c.197-3.323.969-5.434 1.774-6.756.466-.767.94-1.262 1.31-1.57a3.67 3.67 0 0 1 .601-.41A.549.549 0 0 1 8 0c.101 0 .17.027.25.064.037.017.086.041.145.075.118.066.277.167.463.315.373.297.85.779 1.317 1.537ZM9.5 6c0-1.105-.672-2-1.5-2s-1.5.895-1.5 2S7.172 8 8 8s1.5-.895 1.5-2Z"/>
                                                      <path d="M8 14.5c.5 0 .999-.046 1.479-.139L8.4 15.8a.5.5 0 0 1-.8 0l-1.079-1.439c.48.093.98.139 1.479.139Z"/>
                                                    </svg>

                                                    Release Date
                                                </th>
                                                <td style="width: 55%;"><time datetime="2008-02-14 20:00"><?php echo $release_date ?></time></td>
                                            </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                    
                                </article>
								<form target="_blank" method="POST" action="/download/">
									<input type="hidden" name="post_id" value="<?php echo $post_id ?>">
									<button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
										<svg class="svg-5 mr-1" fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
											<path d="M528 288h-92.1l46.1-46.1c30.1-30.1 8.8-81.9-33.9-81.9h-64V48c0-26.5-21.5-48-48-48h-96c-26.5 0-48 21.5-48 48v112h-64c-42.6 0-64.2 51.7-33.9 81.9l46.1 46.1H48c-26.5 0-48 21.5-48 48v128c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V336c0-26.5-21.5-48-48-48zm-400-80h112V48h96v160h112L288 368 128 208zm400 256H48V336h140.1l65.9 65.9c18.8 18.8 49.1 18.7 67.9 0l65.9-65.9H528v128zm-88-64c0-13.3 10.7-24 24-24s24 10.7 24 24-10.7 24-24 24-24-10.7-24-24z"></path>
										</svg>
										Download (<?php echo $size ?>)</button>
								</form>
                                <div class="post-detail-wrap bg-white border rounded shadow-sm p-3 mb-4">
<!--                                     <div class="mb-3">
                                        <a class="btn btn-light explore-btn collapsed" data-toggle="collapse" href="#table-of-contents" aria-expanded="false">Explore this article</a>
                                        <div id="table-of-contents" class="collapse" style="">
                                            <div class="bg-light rounded d-inline-block p-3 table-of-contents" style="margin-top: -1px;">
                                                <div class="links">
                                                    <a class="anchore-link d-block mb-2" href="#take-information-and-go">TAKE INFORMATION AND GO</a>
                                                    <a class="anchore-link d-block mb-2" href="#the-game-full-of-horror">THE GAME FULL OF HORROR</a>
                                                    <a class="anchore-link d-block mb-2" href="#easy-control-to-play-puzzles">EASY CONTROL TO PLAY PUZZLES</a>
                                                    <a class="anchore-link d-block mb-2" href="#no-traces-must-remain">NO TRACES MUST REMAIN</a>
                                                </div>
                                                <a class="anchore-link d-block" href="#download">Download</a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <?php the_content(); ?>
                                    <h2 id="download" class="h5 font-weight-semibold mb-3">Download <?php echo get_the_title() ?></h2>
                                    <?php if (!empty($download_instructions)) { ?>
                                        <div class="small mb-3">
                                            <p><em>You are now ready to download <strong><?php echo get_the_title() ?>&nbsp;</strong>for free. Here are some notes:</em></p>
                                            <ul>
                                                <li>
                                                    <em><?php echo $download_instructions ?></em>
                                                </li>
                                            </ul>
                                        </div>
                                <?php } ?>
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
																<span class="align-middle"><?php $author ?></span>
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
            </div>
            <?php get_template_part( 'template-parts/content-sidebar' ); ?>
        </div>
    </div>
</div>

        <?php

get_footer();
