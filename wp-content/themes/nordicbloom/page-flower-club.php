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
?>

<main class="flower-club-page">

    <section
        class="flower-club-hero"
        aria-labelledby="flower-club-hero-title"
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

</main>

<?php get_footer(); ?>