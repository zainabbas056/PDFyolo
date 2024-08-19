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

get_header(); ?>

<div id="content-wrap">
    <div class="py-2 breadCrumbMainWrap">
        <div class="container singlePostBreadCrumb">
            <?php if (!is_front_page()) {
             ah_breadcrumb(); }?>
        </div>
    </div>
    <?php
        if(is_page('blogs')){ ?>
            <div class="container">
                <div class="main-content-wrap">
                    <?php
                    if (have_posts()){

                        while(have_posts()){
                            the_post();
                            the_content();
                        }
                    }else{ ?>
                        <div class="col-12 col-sm-12 col-xl-12">
                            <div class="alert alert-danger">Nothing found !</div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div><?php 
        }else{
            ?>
            <div class="container pt-3">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <div class="main-content-wrap">
                        <?php
                        if (have_posts()){

                        	while(have_posts()){
                        		the_post();
                        		the_content();
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
            </div> <?php 
    } ?>
</div>
<div class="whoWeAreWrapper">
</div>
        <?php

get_footer();
