<?php get_header(); ?>

<main id="primary" class="single-post-page">
  <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>
      
      <!-- Article Header -->
      <header class="single-post-header">
        <div class="single-container">
          
          <div class="single-post-meta">
            <span class="post-category">
              <?php 
              $cats = get_the_category();
              if ( ! empty( $cats ) ) {
                  echo esc_html( $cats[0]->name );
              }
              ?>
            </span>
            <span class="meta-separator">•</span>
            <span class="post-date"><?= esc_html( get_the_date('M j, Y') ); ?></span>
          </div>

          <h1 class="single-post-title"><?= esc_html( get_the_title() ); ?></h1>

          <div class="post-author">
            By <span><?= esc_html( get_the_author() ); ?></span>
          </div>

        </div>
      </header>

      <!-- Featured Image -->
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="single-featured-image single-container">
          <?php the_post_thumbnail('full'); ?>
        </div>
      <?php endif; ?>

      <!-- Main Post Content -->
      <div class="single-post-content single-container">
        <?php the_content(); ?>
      </div>

     <!-- Back to All Articles Button -->
<div class="back-to-posts single-container">
  <a href="<?= esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog' ) ); ?>" class="btn-all-articles">
    &larr; All articles
  </a>
</div>

      <!-- Comments Section -->
      <?php 
      $enable_comments = get_field('enable_comments');

      if ( $enable_comments !== false ) : 
      ?>
        <div class="single-container">
          <?php 
          // Load the comments.php template file using standard WordPress functionality
          if ( comments_open() || get_comments_number() ) {
              comments_template();
          }
          ?>
        </div>

        <?php endif;
      ?>

    </article>

  <?php endwhile; ?>
</main>

<?php get_footer(); ?>