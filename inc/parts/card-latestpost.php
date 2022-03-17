<?php 
  $id = get_the_ID();   
?>
<div class="col my-5 text-black">
  <div class="card post-<?php echo $id; ?> bg-transparent ">
    <a class="card-link " href="<?php echo  get_permalink(  $id ); ?>" rel="noopener noreferrer">
      <div class="card-img mb-4 zoom_img"
        style="background-image: url(<?php   echo get_the_post_thumbnail_url( $id ); ?>);">
      </div>
    </a>

    <div class="card-body  p-0  ">

      <a class="card-link text-gray" href="<?php echo   get_permalink($id ); ?>" rel="noopener noreferrer">
        <div class="title link_main_style links-with-line">
          <?php  echo $post->post_title; ?>
        </div>
      </a>


      <!-- Show excerpt -->
      <div class="content text-gray">
        <?php the_excerpt($id); ?>
      </div>

      <!-- Show Author info -->

      <div class="author mt-3 py-4 d-flex borderY-2">
        <?php  
        //Author
        $authorId             = get_post_field('post_author' , $id);
        $user                 = get_userdata($authorId);
        $data                 = get_field('author_info', 'user_'. $authorId);
        
        $name                 = $data['data']['author_name_and_lastname'];
        $author_profession    = $data['data']['author_profession'];
        $author_description   = $data['data']['author_description'];
        $author_picture       = $data['author_picture'];
        $author_url           = get_author_posts_url($authorId);
      
      
      ?>
        <div class="author_pic px-2" style='background-image: url("<?php echo $author_picture['url']; ?>");'>
        </div>
        <div class="px-2 flex-grow-1 ">
          <div class="col-12 author_name">
            <a href="<?php echo $author_url;  ?>" target="_blank" rel="noopener noreferrer"><?php echo $name; ?>
            </a>
          </div>
          <div class="author_data d-flex">
            <div class="author_date">
              <?php echo date("F j, Y", strtotime($post->post_date)) . "<br>"; ?>
            </div>
            <div class="author_time_reading">
              <?php echo get_field( 'time_estimation', $id) ?: '5'; ?> min read
            </div>
          </div>

        </div>
      </div>


      <!-- Show Categories -->
      <div class="categories mt-3">
        <?php 
        $categories = get_the_category( $id );
        if ( ! empty( $categories ) ) {
            foreach( $categories as $category ) {
              echo '<a href="'. get_category_link( $category->term_id ) .'"  alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '"target="_blank" rel="noopener noreferrer">' . esc_html( $category->name ) . '</a>';
            }
          }
        ?>
      </div>

    </div>
    <!-- end card-body -->
  </div>
  <!-- end card -->

</div>
