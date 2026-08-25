<?php
get_header();

$blogPageId = get_option('page_for_posts');
$heroBg       = get_field("hero_bg_image", $blogPageId);
$heroTitle    = get_field("hero_title", $blogPageId);
$heroSubtitle = get_field("hero_subtitle", $blogPageId);
$cardPhoto    = get_field("hero_card_image", $blogPageId);
?>

<main class="blog-page">

    <!-- BLOG HERO -->
    <section
        class="hero-section"
        style="background-image: url('<?= esc_url($heroBg["url"]); ?>');"
    >

        <div class="hero-container">

            <div class="hero-content">

                <h1>
                    <?= esc_html($heroTitle); ?>
                </h1>

                <p>
                    <?= esc_html($heroSubtitle); ?>
                </p>

            </div>


            <div class="hero-media">

                <div class="hero-card">

                    <img
                        src="<?= esc_url($cardPhoto["url"]); ?>"
                        alt=""
                    >

                </div>

            </div>

        </div>

    </section>


    <!-- BLOG POSTS -->
    <section class="blog-grid">

        <?php if (have_posts()): ?>

            <?php while (have_posts()): the_post(); ?>

                <article class="blog-card">

                    <!-- POST IMAGE -->
                    <?php if (has_post_thumbnail()): ?>

                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('large'); ?>
                        </a>

                    <?php endif; ?>


                    <!-- DATE -->
                    <p>
                        <?php echo get_the_date('M d, Y'); ?>
                    </p>


                    <!-- POST TITLE -->
                    <h2>

                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>

                    </h2>


                    <!-- LINK TO single.php -->
                    <a href="<?php the_permalink(); ?>">
                        Read More →
                    </a>

                </article>

            <?php endwhile; ?>


        <?php else: ?>

            <p>No posts found.</p>

        <?php endif; ?>

    </section>


    <!-- PAGINATION -->
    <?php the_posts_pagination(); ?>

</main>

<?php get_footer(); ?>