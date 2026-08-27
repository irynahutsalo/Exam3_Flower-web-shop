<?php 
get_header(); 

$blog_page_id    = get_option('page_for_posts');
$blogTitle       = get_field('blog_title', $blog_page_id);
$blogDescription = get_field('blog_description', $blog_page_id);
$blogHeroImage   = get_field('blog_hero_image', $blog_page_id);
$heroBgUrl       = is_array($blogHeroImage) ? $blogHeroImage['url'] : $blogHeroImage;
?>

<main class="blog-page">

  <!-- Hero секція через ACF -->
  <section class="blog-hero" <?php if($heroBgUrl): ?> style="background-image: url(<?= esc_url($heroBgUrl); ?>);" <?php endif; ?>>
    <div class="blog-hero-content">
      <h1><?= esc_html($blogTitle ? $blogTitle : 'Our Blog'); ?></h1>
      <?php if ($blogDescription): ?>
        <p><?= esc_html($blogDescription); ?></p>
      <?php endif; ?>
    </div>
  </section>

  <!-- Сітка ка картка автоматично з розділу Posts -->
  <div class="blog-container">
    <div class="blog-main">
      <div class="blog-grid">
        
        <?php if ( have_posts() ) : ?>
          <?php while ( have_posts() ) : the_post(); ?>
            
            <article class="blog-card">
              <!-- Обгортка із зображенням -->
              <a href="<?php the_permalink(); ?>" class="card-image-wrap">
                <?php if ( has_post_thumbnail() ) : ?>
                  <?php the_post_thumbnail('medium'); ?>
                <?php else : ?>
                  <img src="https://via.placeholder.com/400x280" alt="<?php the_title_attribute(); ?>">
                <?php endif; ?>
              </a>

              <div class="card-body">
                <!-- Категорія -->
                <span class="card-category">
                  <?php 
                  $cats = get_the_category();
                  echo !empty($cats) ? esc_html($cats[0]->name) : 'Blog'; 
                  ?>
                </span>

                <!-- Заголовок статті зі посиланням на single.php -->
                <h3 class="card-title">
                  <a href="<?php the_permalink(); ?>"><?= esc_html( get_the_title() ); ?></a>
                </h3>

                <!-- Короткий опис (Excerpt) -->
                <p class="card-excerpt">
                  <?= esc_html( wp_trim_words( get_the_excerpt(), 14, '...' ) ); ?>
                </p>

                <!-- Футер картки -->
                <div class="card-footer">
                  <span class="card-date"><?= esc_html( get_the_date('M j, Y') ); ?></span>
                  <a href="<?php the_permalink(); ?>" class="card-arrow">&rarr;</a>
                </div>
              </div>
            </article>

          <?php endwhile; ?>
        <?php else : ?>
          <p>Статей ще немає.</p>
        <?php endif; ?>

      </div>
    </div>
  </div>

</main>

<?php get_footer(); ?>