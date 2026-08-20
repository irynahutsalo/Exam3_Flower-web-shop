<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title <?php bloginfo("name"); ?>></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php $front_page_id = get_option( 'page_on_front' ); ?>

<header class="site-header">
  <div class="header-container">

    <!-- 1. Logo -->
    <div class="site-logo">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php 
        $logo = get_field( 'header_logo', $front_page_id ); 
        if ( $logo ) : ?>
          <img src="<?php echo esc_url( is_array($logo) ? $logo['url'] : $logo ); ?>" alt="Nordic Bloom">
        <?php else : ?>
          <span>NORDIC BLOOM</span>
        <?php endif; ?>
      </a>
    </div>

    <!-- 2. Navigation menu -->
  <nav class="main-navigation">
  <?php if ( have_rows( 'header_navigation', $front_page_id ) ) : ?>
    <ul>
      <?php while ( have_rows( 'header_navigation', $front_page_id ) ) : the_row(); 
        $page_url = get_sub_field( 'page_item' ); 

        if ( $page_url ) : 
          $page_id    = url_to_postid( $page_url );
          $page_title = get_the_title( $page_id );
        ?>
          <li>
            <a href="<?php echo esc_url( $page_url ); ?>">
              <?php echo esc_html( $page_title ? $page_title : 'Page' ); ?>
            </a>
          </li>
        <?php endif; ?>
      <?php endwhile; ?>
    </ul>
  <?php endif; ?>
</nav>

</header>