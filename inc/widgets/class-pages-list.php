<?php

#--------------------------------------------------------------------------------------#
/**
 * ----------------------------------
 * Recent Pages List
 * @author PDFyoloni
 * --------------------------------
 * */
#--------------------------------------------------------------------------------------#

    function PDFyolo_load_allpages2_widget() {
        register_widget( 'PDFyolo_allpages2_widget' );
    }
    
    add_action( 'widgets_init', 'PDFyolo_load_allpages2_widget' );

 class PDFyolo_allpages2_widget extends WP_Widget {
    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        parent::__construct(
            'PDFyoloallpages2', // Base ID
            esc_html__( 'PDFyolo Menu Widget',"PDFyolo" ), // Name
            array( 'description' => esc_html__( 'Place This widget to show Links', "PDFyolo" ), ) // Args
        );
    }
    /**
     * Display the content of the widget (FrontEnd)
     *
     * @param array $args
     * @param array $instance
     *
     */
    public function widget( $args, $instance )
    {       ?>

            <aside class="sidebar">
                <nav class="widget widgetInfoCats">
                    <h3 class="bgPrimary"><?php echo $instance['alp_heading']; ?></h3>
                    <ul class="listUnstyled bgSuccess">
                        <?php
                            $menu_items = wp_get_nav_menu_items($instance['choose_menu']);
                            if(!empty($menu_items)){
                            foreach ( (array) $menu_items as $key => $menu_item ) {
                                $qcPageID = $menu_item->object_id;
                                $qcPageData = get_page( $qcPageID );
                                   echo ' <li><a href="'.get_the_permalink($qcPageData->ID).'">'.$qcPageData->post_title.'</a></li>';
                            }}
                        ?>
                    </ul>
                </nav>
            </aside>
                                      
    <?php
    }
    /**
     * Outputs the options form on admin (Backend)
     *
     * @param array $instance The widget options
     */
    public function form( $instance) { ?>
       <p>
        <label for="alp_heading">
            <?php esc_html_e( "Heading" , "PDFyolo" ); ?>
            <input class="widefat" id="alp_heading" type="text" value="<?php echo isset($instance['alp_heading']) ? esc_attr($instance['alp_heading']) :''; ?>" name="<?php echo $this->get_field_name("alp_heading"); ?>" >
        </label>
     </p>

      <p>
        
        <label for="choose_menu">
            <?php esc_html_e( "Menu" , "PDFyolo" ); ?>
            <select class="widefat" id="choose_menu" type="text"  name="<?php echo $this->get_field_name("choose_menu"); ?>" >
               <?php $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ));
                     foreach ($menus as $key) {
                              if($instance['choose_menu']==$key->term_id){
                                $select='selected';
                              }else{
                                $select='';
                              }
                          echo '<option value="'.$key->term_id.'"  '.$select.'>'.$key->name.'</option>';
                     }
                    ?>

             </select>   
        </label>
     </p>
     
   
    <?php }
    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['alp_heading']   = ($new_instance['alp_heading']);
        $instance['choose_menu']   = ($new_instance['choose_menu']);

        return $instance;
    }
}