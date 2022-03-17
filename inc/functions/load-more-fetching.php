<?php 

function loadmore_posts(){
  //Get all _Post data
  $postdata = file_get_contents("php://input");
  //make data and obj
  $data = json_decode($postdata);
  $current_page     = !empty($data->current_page) ? $data->current_page : 1;
  $offset           = !empty($data->offset) ? $data->offset : 1;

  //this values are the same offset will jump number of cols and post x pg have same value 
  $posts_per_page   =  $offset;
  //var_dump($GLOBALS);
 
    $args = array(
        'posts_per_page' => $posts_per_page,
        'post_type'       => 'post',
        'post_status'     => 'publish',
        'paged'           => $current_page,
    );
    $the_query = new WP_Query( $args );


    if ( $the_query->have_posts() ) {
      ob_start();
      while ( $the_query->have_posts() ) : $the_query->the_post(); 
      $post     = get_post();
      echo get_template_part('/inc/parts/card', 'latespost'); 
      endwhile; 
      wp_send_json_success(ob_get_clean());
     // wp_reset_postdata(); 
    }else{
      echo '<h1>ERROR NOTHING</h1>';
    }
  die; // here we exit the script and even no wp_reset_query() required!..
}
add_action('wp_ajax_nopriv_loadmore_posts', 'loadmore_posts');
add_action('wp_ajax_loadmore_posts', 'loadmore_posts');

?>
