<?php
    if (function_exists('get_field')) {
        $enable_sidebar=get_field('enable_sidebar','options');
    }
    $args = array(
         'taxonomy'     => 'novel_cat',
         'orderby'      => 'name',
         'show_count'   => 0,
         'pad_counts'   => 0,
         'hierarchical' => 1,
         'title_li'     => '',
         'hide_empty'   => 0
        );
    $novels = get_categories( $args );

    $args = array(
         'taxonomy'     => 'book_cat',
         'orderby'      => 'name',
         'show_count'   => 0,
         'pad_counts'   => 0,
         'hierarchical' => 1,
         'title_li'     => '',
         'hide_empty'   => 0
        );
    $books = get_categories( $args );

    if ($enable_sidebar== 1) {
    
 ?> 

<div class="col-12 col-lg-3">
    <div class="widget-area-wrap">
        <aside class="widget-sidebar">
            <!-- Novel_Category_Widget -->
            <section class="content-section">
                <header class="section-header">
                    <h2 class="h2"><a href="<?php echo get_site_url().'/all-novels/' ?>" class="text-link">Novel</a></h2>
                    <a href="<?php echo get_site_url().'/all-novels/' ?>" class="btn btn-primary btn-sm ml-auto">View More</a>
                </header>
                <div class="row">
        <?php if($novels) { 
                foreach($novels as $novel){
            ?>
                    <div class="col-6">
                        <a href="<?php echo get_category_link($novel->term_id) ?>" class="small text-truncate d-block cat-link" title="<?php echo $novel->name ?>"><?php echo $novel->name ?></a>
                    </div>
            <?php }
                } 
            ?>
                </div>
            </section>
            <!-- Books_Category_Widget -->
            <section class="content-section">
                <header class="section-header">
                    <h2 class="h2"><a href="<?php echo get_site_url().'/all-books/' ?>" class="text-link">Books</a></h2>
                    <a href="<?php echo get_site_url().'/all-books/' ?>" class="btn btn-primary btn-sm ml-auto">View More</a>
                </header>
                <div class="row">
            <?php if($books) { 
                foreach($books as $book){
            ?>
                    <div class="col-6">
                        <a href="<?php echo get_category_link($book->term_id) ?>" class="small text-truncate d-block cat-link" title="<?php echo $book->name ?>"><?php echo $book->name ?></a>
                    </div>
            <?php }
                } 
            ?>
                </div>
            </section>
        </aside>
    </div>
</div>

<?php } ?>