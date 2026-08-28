<?php 
get_header(); 

$blog_page_id    = get_option('page_for_posts');
$blogTitle       = get_field('blog_title', $blog_page_id);
$blogDescription = get_field('blog_description', $blog_page_id);
$blogHeroImage   = get_field('blog_hero_image', $blog_page_id);
$heroBgUrl       = is_array($blogHeroImage) ? $blogHeroImage['url'] : $blogHeroImage;

// Check what the user selected in the dropdown filter (default to DESC - newest first)
$current_sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'desc';
$order_value  = ($current_sort === 'asc') ? 'ASC' : 'DESC';

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$blog_args = array(
    'post_type'      => 'post',
    'posts_per_page' => 9,
    'orderby'        => 'date',
    'order'          => $order_value, // Dynamic order based on user selection
    'paged'          => $paged
);

$blog_query = new WP_Query($blog_args);
?>

<main class="blog-page">

  <!-- Hero section via ACF -->
  <section class="blog-hero" <?php if($heroBgUrl): ?> style="background-image: url(<?= esc_url($heroBgUrl); ?>);" <?php endif; ?>>
    <div class="blog-hero-content">
      <h1><?= esc_html($blogTitle ? $blogTitle : 'Our Blog'); ?></h1>
      <?php if ($blogDescription): ?>
        <p><?= esc_html($blogDescription); ?></p>
      <?php endif; ?>
    </div>
  </section>

  <!-- Blog container with interactive filter and posts grid -->
  <div class="blog-container">
    <div class="blog-main">
      
      <!-- Interactive sort filter for users -->
      <div class="blog-filter-bar" style="margin-bottom: 30px; text-align: right;">
        <form method="get" action="">
          <label for="sort-order" style="margin-right: 10px; font-weight: 500;">Sort by date:</label>
          <select name="sort" id="sort-order" onchange="this.form.submit()" style="padding: 8px 12px; border-radius: 4px; border: 1px solid #ccc;">
            <option value="desc" <?php selected($current_sort, 'desc'); ?>>Newest First</option>
            <option value="asc" <?php selected($current_sort, 'asc'); ?>>Oldest First</option>
          </select>
        </form>
      </div>

      <!-- Posts grid -->
      <div class="blog-grid">
          <?php if ( $blog_query->have_posts() ) : ?>
              <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                  
                  <article class="blog-card">
                      <!-- Image wrapper -->
                      <a href="<?php the_permalink(); ?>" class="card-image-wrap">
                          <?php if ( has_post_thumbnail() ) : ?>
                              <?php the_post_thumbnail('medium'); ?>
                          <?php else : ?>
                              <img src="https://via.placeholder.com/400x280" alt="<?php the_title_attribute(); ?>">
                          <?php endif; ?>
                      </a>

                      <div class="blog-body">
                          <!-- Category -->
                          <span class="card-category">
                              <?php 
                              $cats = get_the_category();
                              echo !empty($cats) ? esc_html($cats[0]->name) : 'Blog'; 
                              ?>
                          </span>

                          <!-- Article title -->
                          <h3 class="card-title">
                              <a href="<?php the_permalink(); ?>"><?= esc_html( get_the_title() ); ?></a>
                          </h3>

                          <!-- Short excerpt -->
                          <p class="card-excerpt">
                              <?= esc_html( wp_trim_words( get_the_excerpt(), 14, '...' ) ); ?>
                          </p>

                          <!-- Card footer -->
                          <div class="card-footer">
                              <span class="card-date"><?= esc_html( get_the_date('M j, Y') ); ?></span>
                              <a href="<?php the_permalink(); ?>" class="card-arrow">&rarr;</a>
                          </div>
                      </div>
                  </article>

              <?php endwhile; ?>
              <?php wp_reset_postdata(); ?>
          <?php else : ?>
              <p>No posts found.</p>
          <?php endif; ?>
      </div>

    </div>
  </div>

</main>

<?php get_footer(); ?>