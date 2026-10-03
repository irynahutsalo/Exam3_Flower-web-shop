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

// Section: How it works
$how_title = get_field('flower_club_how_title', $page_id);
$how_image = get_field('flower_club_how_image', $page_id);
$how_image_id = 0;

if (is_array($how_image)) {
    $how_image_id = absint($how_image['ID'] ?? 0);
}

// Section: Flower Club Plans
$plans_title = get_field('flower_club_plans_title', $page_id);
$plans_description = get_field('flower_club_plans_description', $page_id);

// Section: Flower Club FAQ
$faq_title = get_field('flower_club_faq_title', $page_id);

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

    <!-- How it works: block 3 -->
    <section
        class="flower-club-how"
        id="flower-club-how-it-works"
    >

        <div class="container">

            <!-- How it works content -->
            <div class="flower-club-how__content">

                <?php if ($how_title) : ?>
                    <h2 class="flower-club-how__title">
                        <?php echo esc_html($how_title); ?>
                    </h2>
                <?php endif; ?>

                <?php if (have_rows('flower_club_steps', $page_id)) : ?>

                    <ol class="flower-club-how__steps">

                        <?php
                        // Начинаем нумерацию с первого шага.
                        $step_number = 1;

                        while (have_rows('flower_club_steps', $page_id)) :
                            the_row();

                            $step_title = get_sub_field('step_title');
                            $step_description = get_sub_field('step_description');
                        ?>

                            <?php if ($step_title || $step_description) : ?>
                                <li class="flower-club-how__step">

                                    <span class="flower-club-how__number">
                                        <?php
                                        if ($step_number < 10) {
                                            echo '0';
                                        }

                                        echo $step_number;
                                        ?>
                                    </span>

                                    <?php if ($step_title) : ?>
                                        <h3 class="flower-club-how__step-title">
                                            <?php echo esc_html($step_title); ?>
                                        </h3>
                                    <?php endif; ?>

                                    <?php if ($step_description) : ?>
                                        <p class="flower-club-how__description">
                                            <?php echo esc_html($step_description); ?>
                                        </p>
                                    <?php endif; ?>

                                </li>

                                <?php
                                // Увеличиваем номер после выведенного шага.
                                $step_number++;
                                ?>
                            <?php endif; ?>

                        <?php endwhile; ?>

                    </ol>

                <?php endif; ?>

            </div>

            <!-- How it works image -->
            <?php if ($how_image_id) : ?>
                <div class="flower-club-how__media">

                    <?php
                    echo wp_get_attachment_image(
                        $how_image_id,
                        'large',
                        false,
                        [
                            'class'   => 'flower-club-how__image',
                            'loading' => 'lazy',
                        ]
                    );
                    ?>

                </div>
            <?php endif; ?>

        </div>

    </section>

    <!-- Flower Club plans: block 4 -->
    <section class="flower-club-plans" id="flower-club-plans">
        <div class="container">

            <?php if ($plans_title) : ?>
                <h2 class="flower-club-plans__title">
                    <?php echo esc_html($plans_title); ?>
                </h2>
            <?php endif; ?>

            <?php if ($plans_description) : ?>
                <p class="flower-club-plans__description">
                    <?php echo esc_html($plans_description); ?>
                </p>
            <?php endif; ?>

            <?php if (have_rows('flower_club_plans', $page_id)) : ?>
                <div class="flower-club-plans__cards">

                    <?php
                    while (have_rows('flower_club_plans', $page_id)) :
                        the_row();

                        $plan_image = get_sub_field('plan_image');
                        $plan_badge = get_sub_field('plan_badge');
                        $plan_title = get_sub_field('plan_title');
                        $plan_price = get_sub_field('plan_price');
                        $plan_description = get_sub_field('plan_description');
                        $plan_best_for = get_sub_field('plan_best_for');
                        $plan_includes = get_sub_field('plan_includes');
                        $plan_button_text = get_sub_field('plan_button_text');
                        $plan_button_url = get_sub_field('plan_button_url');

                        $plan_image_id = 0;

                        if (is_array($plan_image)) {
                            $plan_image_id = absint($plan_image['ID'] ?? 0);
                        }
                    ?>

                        <article class="flower-club-plan">

                            <div class="flower-club-plan__media">

                                <?php if ($plan_image_id) : ?>
                                    <?php
                                    echo wp_get_attachment_image(
                                        $plan_image_id,
                                        'medium_large',
                                        false,
                                        [
                                            'class' => 'flower-club-plan__image',
                                            'loading' => 'lazy',
                                        ]
                                    );
                                    ?>
                                <?php endif; ?>

                                <?php if ($plan_badge) : ?>
                                    <span class="flower-club-plan__badge">
                                        <?php echo esc_html($plan_badge); ?>
                                    </span>
                                <?php endif; ?>

                            </div>

                            <div class="flower-club-plan__content">

                                <div class="flower-club-plan__heading">

                                    <?php if ($plan_title) : ?>
                                        <h3 class="flower-club-plan__title">
                                            <?php echo esc_html($plan_title); ?>
                                        </h3>
                                    <?php endif; ?>

                                    <?php if ($plan_price) : ?>
                                        <p class="flower-club-plan__price">
                                            <?php echo esc_html($plan_price); ?>
                                        </p>
                                    <?php endif; ?>

                                </div>

                                <?php if ($plan_description) : ?>
                                    <p class="flower-club-plan__description">
                                        <?php echo esc_html($plan_description); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ($plan_best_for) : ?>
                                    <div class="flower-club-plan__details">

                                        <h4 class="flower-club-plan__subtitle">
                                            Best for
                                        </h4>

                                        <ul class="flower-club-plan__list">
                                            <?php
                                            $best_for_items = explode("\n", $plan_best_for);
                                            ?>

                                            <?php foreach ($best_for_items as $item) : ?>
                                                <?php $item = trim($item); ?>

                                                <?php if ($item !== '') : ?>
                                                    <li>
                                                        <?php echo esc_html($item); ?>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>

                                    </div>
                                <?php endif; ?>

                                <?php if ($plan_includes) : ?>
                                    <div class="flower-club-plan__details">

                                        <h4 class="flower-club-plan__subtitle">
                                            Includes
                                        </h4>

                                        <ul class="flower-club-plan__list">
                                            <?php
                                            $included_items = explode("\n", $plan_includes);
                                            ?>

                                            <?php foreach ($included_items as $item) : ?>
                                                <?php $item = trim($item); ?>

                                                <?php if ($item !== '') : ?>
                                                    <li>
                                                        <?php echo esc_html($item); ?>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>

                                    </div>
                                <?php endif; ?>

                                <?php if ($plan_button_text && $plan_button_url) : ?>
                                    <a
                                        href="<?php echo esc_url($plan_button_url); ?>"
                                        class="flower-club-button flower-club-button--primary flower-club-plan__button"
                                    >
                                        <?php echo esc_html($plan_button_text); ?>
                                    </a>
                                <?php endif; ?>

                            </div>

                        </article>

                    <?php endwhile; ?>

                </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- FAQ: block 5 -->
    <?php if (have_rows('flower_club_faq_items', $page_id)) : ?>
        <section class="flower-club-faq">
            <div class="container">
                <div class="flower-club-faq__content">

                    <?php if ($faq_title) : ?>
                        <h2 class="flower-club-faq__title">
                            <?php echo esc_html($faq_title); ?>
                        </h2>
                    <?php endif; ?>

                    <?php
                    $first_question = true;

                    while (have_rows('flower_club_faq_items', $page_id)) :
                        the_row();

                        $faq_question = get_sub_field('faq_question');
                        $faq_answer = get_sub_field('faq_answer');
                    ?>

                        <?php if ($faq_question && $faq_answer) : ?>
                            <details
                                class="flower-club-faq__item"
                                <?php if ($first_question) : ?>open<?php endif; ?>
                            >
                                <summary class="flower-club-faq__question">
                                    <span>
                                        <?php echo esc_html($faq_question); ?>
                                    </span>

                                    <span
                                        class="flower-club-faq__icon"
                                        aria-hidden="true"
                                    ></span>
                                </summary>

                                <p class="flower-club-faq__answer"><?php echo esc_html($faq_answer); ?></p>
                            </details>

                            <?php $first_question = false; ?>
                        <?php endif; ?>

                    <?php endwhile; ?>

                </div>
            </div>
        </section>
    <?php endif; ?>

</main>

<?php get_footer(); ?>