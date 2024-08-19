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
                            $genere = get_term_by('term_id', $genere, 'novel_cat'); 
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
                                    <div class="rounded-lg mb-3 mb-md-4 position-relative">
                                        <img class="rounded-lg d-block object-cover img-fluid" src="<?php echo $single_featured_image['url'] ?>" alt="Nobodies: Murder Cleaner" style="min-height: 200px;">
                                        <div class="bg-overlay text-center text-white rounded-lg p-4 p-md-5 d-flex align-items-center justify-content-center position-absolute">
                                            <div class="px-md-3">
                                                <h1 class="h2 font-weight-bold"><?php echo get_the_title() ?></h1>
                                            <!--     <time class="d-block">
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
                                                    <svg class="svg-5 svg-primary mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#f25132" viewBox="0 0 576 512"><path d="M420.55,301.93a24,24,0,1,1,24-24,24,24,0,0,1-24,24m-265.1,0a24,24,0,1,1,24-24,24,24,0,0,1-24,24m273.7-144.48,47.94-83a10,10,0,1,0-17.27-10h0l-48.54,84.07a301.25,301.25,0,0,0-246.56,0L116.18,64.45a10,10,0,1,0-17.27,10h0l47.94,83C64.53,202.22,8.24,285.55,0,384H576c-8.24-98.45-64.54-181.78-146.85-226.55"></path></svg>
                                                    App Name
                                                </th>
                                                <td style="width: 55%;"><?php echo get_the_title() ?></td>
                                            </tr>
                                              <?php } if (!empty($Version)) { ?>
                                            <tr>
                                                <th style="width: 45%;">
                                                    <svg class="svg-5 svg-primary mr-1" xmlns="http://www.w3.org/2000/svg"  fill="#f25132" viewBox="0 0 320 512"><path d="M296 160H180.6l42.6-129.8C227.2 15 215.7 0 200 0H56C44 0 33.8 8.9 32.2 20.8l-32 240C-1.7 275.2 9.5 288 24 288h118.7L96.6 482.5c-3.6 15.2 8 29.5 23.3 29.5 8.4 0 16.4-4.4 20.8-12l176-304c9.3-15.9-2.2-36-20.7-36z"></path></svg>
                                                    Version
                                                </th>
                                                <td style="width: 55%;"><a href="#" class="anchore-link"><?php echo $author ?></a></td>
                                            </tr>
                                            <?php } if (!empty($genere_name)) { ?>
                                            
                                                <tr>
                                                    <th style="width: 45%;">
                                                        <svg class="svg-5 svg-secondary mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-laughing-fill" viewBox="0 0 16 16">
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5c0 .501-.164.396-.415.235C6.42 6.629 6.218 6.5 6 6.5c-.218 0-.42.13-.585.235C5.164 6.896 5 7 5 6.5 5 5.672 5.448 5 6 5s1 .672 1 1.5zm5.331 3a1 1 0 0 1 0 1A4.998 4.998 0 0 1 8 13a4.998 4.998 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5zm-1.746-2.765C10.42 6.629 10.218 6.5 10 6.5c-.218 0-.42.13-.585.235C9.164 6.896 9 7 9 6.5c0-.828.448-1.5 1-1.5s1 .672 1 1.5c0 .501-.164.396-.415.235z"/>
                                                        </svg>
                                                         Category/genere
                                                    </th>
                                                    <td style="width: 55%;"><a href="<?php echo $genere_link ?>" class="anchore-link"><?php echo $genere_name ?></a></td>
                                                </tr>
                                            <?php } if (!empty($size)) {  ?>
                                            <tr>
                                                <th style="width: 45%;">
                                                   <svg class="svg-5 svg-secondary mr-1" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 576 512"><path d="M567.938 243.908L462.25 85.374A48.003 48.003 0 0 0 422.311 64H153.689a48 48 0 0 0-39.938 21.374L8.062 243.908A47.994 47.994 0 0 0 0 270.533V400c0 26.51 21.49 48 48 48h480c26.51 0 48-21.49 48-48V270.533a47.994 47.994 0 0 0-8.062-26.625zM162.252 128h251.497l85.333 128H376l-32 64H232l-32-64H76.918l85.334-128z"></path></svg>
                                                    Size
                                                </th>
                                                <td style="width: 55%;"><?php echo $size ?></td>
                                            </tr>
                                            <?php } if (!empty($updated_on)) {  ?>
                                            <tr>
                                                <th style="width: 45%;">
                                                    <svg class="svg-5 svg-primary mr-1" xmlns="http://www.w3.org/2000/svg" fill="#f25132" viewBox="0 0 640 512"><path d="M480.07 96H160a160 160 0 1 0 114.24 272h91.52A160 160 0 1 0 480.07 96zM248 268a12 12 0 0 1-12 12h-52v52a12 12 0 0 1-12 12h-24a12 12 0 0 1-12-12v-52H84a12 12 0 0 1-12-12v-24a12 12 0 0 1 12-12h52v-52a12 12 0 0 1 12-12h24a12 12 0 0 1 12 12v52h52a12 12 0 0 1 12 12zm216 76a40 40 0 1 1 40-40 40 40 0 0 1-40 40zm64-96a40 40 0 1 1 40-40 40 40 0 0 1-40 40z"></path></svg>
                                                    Mode info 
                                                </th>
                                                <td style="width: 55%;"><time datetime="2008-02-14 20:00"><?php echo $updated_on ?></time></td>
                                            </tr>
                                            <?php } if (!empty($pages_count)) {  ?>
                                            <tr>
                                                <th style="width: 45%;">
                                                    <svg class="svg-5 svg-secondary mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text-fill" viewBox="0 0 16 16">
                                                        <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
                                                    </svg>
                                                    Total download 
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

                                                   Get in on – playstore

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
                                    $customTaxonomyTerms = wp_get_object_terms( $post->ID, 'novel_cat', array('fields' => 'ids') );
                                    $args = array(
                                    'post_type'         => 'novels',
                                    'post_status'       => 'publish',
                                    'posts_per_page' => '6',
                                    'orderby'           => 'date',
                                    'orderby' => 'rand',
                                    'post__not_in' => array ($post->ID),
                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'novel_cat',
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
																<span class="align-middle"><?php echo $author ?></span>
															</div>
                                                         <?php } ?>   
                                                        </div>
														
                                                    </div>
                                                </a>
                                            </div>
                                    <?php endwhile;
                                            // Restore original Post Data
                                        endif; wp_reset_postdata(); ?>
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
