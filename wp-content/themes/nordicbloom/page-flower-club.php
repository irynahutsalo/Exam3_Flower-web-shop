<?php
get_header();

// get the current fields for the flower club page
$page_id = get_queried_object_id();

$hero_label = get_field('flower_club_hero_label', $page_id);
$hero_title = get_field('flower_club_hero_title', $page_id);
$hero_description = get_field('flower_club_hero_description', $page_id);
$hero_image = get_field('flower_club_hero_image', $page_id);
$hero_primary_text = get_field('flower_club_hero_primary_text', $page_id);
$hero_secondary_text = get_field('flower_club_hero_secondary_text', $page_id);

// get its ID in the media library
$hero_image_id = is_array($hero_image)
    ? absint($hero_image['ID'] ?? 0)
    : 0;

// If the title is accidentally left empty, use the page title.
if (!$hero_title) {
    $hero_title = get_the_title($page_id);
}

// Benefits: text and image
$benefits_title = get_field('flower_club_benefits_title', $page_id);
$benefits_image = get_field('flower_club_benefits_image', $page_id);

// Image ID for the benefits image, default to 0 if not set
$benefits_image_id = 0;

if (is_array($benefits_image)) {
    $benefits_image_id = absint($benefits_image['ID']);
}
?>

<main class="flower-club-page">

    <section
        class="flower-club-hero"
    >

        <?php if ($hero_image_id) : ?>
            <?php
            echo wp_get_attachment_image(
                $hero_image_id,
                'full',
                false,
                [
                    'class'         => 'flower-club-hero__image',
                    'loading'       => 'eager',
                    'fetchpriority' => 'high',
                    'sizes'         => '100vw',
                ]
            );
            ?>
        <?php endif; ?>

        <div class="container flower-club-hero__container">

            <div class="flower-club-hero__content">

                <?php if ($hero_label) : ?>
                    <p class="flower-club-hero__label">
                        <?php echo esc_html($hero_label); ?>
                    </p>
                <?php endif; ?>

                <h1 id="flower-club-hero-title">
                    <?php echo esc_html($hero_title); ?>
                </h1>

                <?php if ($hero_description) : ?>
                    <p class="flower-club-hero__description">
                        <?php echo esc_html($hero_description); ?>
                    </p>
                <?php endif; ?>

                <?php if ($hero_primary_text || $hero_secondary_text) : ?>
                    <div class="flower-club-hero__actions">

                        <?php if ($hero_primary_text) : ?>
                            <a
                                class="flower-club-button flower-club-button--primary"
                                href="#flower-club-plans"
                            >
                                <?php echo esc_html($hero_primary_text); ?>
                            </a>
                        <?php endif; ?>

                        <?php if ($hero_secondary_text) : ?>
                            <a
                                class="flower-club-button flower-club-button--secondary"
                                href="#flower-club-how-it-works"
                            >
                                <?php echo esc_html($hero_secondary_text); ?>
                            </a>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

            </div>

        </div>

    </section>

    <!-- Benefits: block 2 -->
<section class="flower-club-benefits">

    <div class="container flower-club-benefits__container">

        <!-- Left column: title and benefits -->
        <div class="flower-club-benefits__content">

            <?php if ($benefits_title) : ?>
                <h2 class="flower-club-benefits__title">
                    <?php echo esc_html($benefits_title); ?>
                </h2>
            <?php endif; ?>

            <?php if (have_rows('flower_club_benefits', $page_id)) : ?>

                <div class="flower-club-benefits__list">

                    <?php
                    while (have_rows('flower_club_benefits', $page_id)) :
                        the_row();

                        $benefit_title = get_sub_field('benefit_title');
                        $benefit_description = get_sub_field('benefit_description');
                    ?>

                        <?php if ($benefit_title || $benefit_description) : ?>
                            <div class="flower-club-benefits__item">

                                <?php if ($benefit_title) : ?>
                                    <h3 class="flower-club-benefits__item-title">
                                        <?php echo esc_html($benefit_title); ?>
                                    </h3>
                                <?php endif; ?>

                                <?php if ($benefit_description) : ?>
                                    <p class="flower-club-benefits__description">
                                        <?php echo esc_html($benefit_description); ?>
                                    </p>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>

                    <?php endwhile; ?>

                </div>

            <?php endif; ?>

        </div>

        <!-- Right column: image -->
        <?php if ($benefits_image_id) : ?>
            <div class="flower-club-benefits__media">

                <?php
                echo wp_get_attachment_image(
                    $benefits_image_id,
                    'large',
                    false,
                    [
                        'class' => 'flower-club-benefits__image',
                    ]
                );
                ?>

            </div>
        <?php endif; ?>

    </div>

</section>

</main>

<?php get_footer(); ?>