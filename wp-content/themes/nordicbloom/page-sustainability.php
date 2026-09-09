<?php
/*
Template Name: Sustainability Page
*/

get_header();

// Hero content from ACF
$sustainability_hero_title       = get_field('sustainability_hero_title');
$sustainability_hero_image       = get_field('sustainability_hero_image');
$sustainability_hero_description = get_field('sustainability_hero_description');

// Get the hero image URL from the ACF image array
$hero_image_url = $sustainability_hero_image['url'] ?? '';

// Our Impact content from ACF 
$impact_label       = get_field('sustainability_impact_label');
$impact_title       = get_field('sustainability_impact_title');
$impact_description = get_field('sustainability_impact_description');
$impact_facts       = get_field('sustainability_impact_facts');
$impact_bouquet     = get_field('sustainability_impact_bouquet');

// Get the bouquet image URL from the ACF image array
$bouquet_url = $impact_bouquet['url'] ?? '';

// Our Approach content from ACF
$approach_label       = get_field('sustainability_approach_label');
$approach_title       = get_field('sustainability_approach_title');
$approach_description = get_field('sustainability_approach_description');
$approach_image       = get_field('sustainability_approach_image');

// Get the approach image URL from the ACF image array
$approach_image_url = $approach_image['url'] ?? '';

// Get the What's Next content from ACF
$future_label       = get_field('sustainability_future_label');
$future_title       = get_field('sustainability_future_title');
$future_description = get_field('sustainability_future_description');
$future_cards       = get_field('sustainability_future_cards');

?>

<!-- Sustainability Page -->
<main class="sustainability-page">

    <!-- If a hero image exists, use it as the background image -->
    <section class="sustainability-hero" <?php if ($hero_image_url): ?>
        style="background-image: url('<?php echo esc_url($hero_image_url); ?>');"
        <?php endif; ?>>

        <!-- Dark Overlay -->
        <div class="sustainability-hero-overlay"></div>

        <!-- Hero Content -->
        <div class="sustainability-container sustainability-hero-content">

            <!-- Title -->
            <?php if ($sustainability_hero_title): ?>
                <h1>
                    <?php echo esc_html($sustainability_hero_title); ?>
                </h1>
            <?php endif; ?>

            <!-- Description -->
            <?php if ($sustainability_hero_description): ?>
                <p>
                    <?php echo esc_html($sustainability_hero_description); ?>
                </p>
            <?php endif; ?>

        </div>

    </section>

    <!-- Our Impact Section -->
    <section class="sustainability-impact">

        <!-- Our Impact Container -->
        <div class="sustainability-container">
            <!-- Our Impact Introduction-->
            <div class="section-intro">

                <span class="small-line"></span>
                <!-- Our Impact Label -->
                <?php if ($impact_label): ?>
                    <p class="eyebrow">
                        <?php echo esc_html($impact_label); ?>
                    </p>
                <?php endif; ?>

                <!-- Title -->
                <?php if ($impact_title): ?>
                    <h2>
                        <?php echo esc_html($impact_title); ?>
                    </h2>
                <?php endif; ?>

                <!-- Description -->
                <?php if ($impact_description): ?>
                    <p class="section-description">
                        <?php echo esc_html($impact_description); ?>
                    </p>
                <?php endif; ?>

            </div>


            <?php
            // The icon is chosen by the position of the fact in the ACF repeater
            $impact_icons = [

                /* Fact 1 - Leaf */
                '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none" />
                    <path fill="currentColor" d="m21.88 2.15l-1.2.4a13.84 13.84 0 0 1-6.41.64a11.87 11.87 0 0 0-6.68.9A7.23 7.23 0 0 0 3.3 9.5a8.65 8.65 0 0 0 1.47 6.6c-.06.21-.12.42-.17.63A22.6 22.6 0 0 0 4 22h2a31 31 0 0 1 .59-4.32a9.25 9.25 0 0 0 4.52 1.11a11 11 0 0 0 4.28-.87C23 14.67 22 3.86 22 3.41zm-7.27 13.93c-2.61 1.11-5.73.92-7.48-.45a13.8 13.8 0 0 1 1.21-2.84A10.2 10.2 0 0 1 9.73 11a9 9 0 0 1 1.81-1.42A12 12 0 0 1 16 8V7a11.4 11.4 0 0 0-5.26 1.08a10.3 10.3 0 0 0-4.12 3.65a15 15 0 0 0-1 1.87a7 7 0 0 1-.38-3.73a5.24 5.24 0 0 1 3.14-4a8.9 8.9 0 0 1 3.82-.84c.62 0 1.23.06 1.87.11a16.2 16.2 0 0 0 6-.35C20 7.55 19.5 14 14.61 16.08" />
                </svg>',

                /* Fact 2 - Recycle */
                '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
	                <path d="M0 0h32v32H0z" fill="none" />
	                <path fill="currentColor" d="M14.037 5.65c.86-1.533 3.066-1.533 3.926 0l2.606 4.651l-1.601-.283a1.25 1.25 0 1 0-.436 2.462l4.25.75a1.25 1.25 0 0 0 1.404-.835l1.25-3.75a1.25 1.25 0 0 0-2.372-.791l-.373 1.12l-2.547-4.546c-1.814-3.237-6.474-3.237-8.288 0L9.651 8.363a1.25 1.25 0 1 0 2.18 1.222zm12.048 9.382a1.25 1.25 0 0 0-2.18 1.222l3.303 5.896c.84 1.5-.244 3.35-1.963 3.35h-6.327l.792-.95a1.25 1.25 0 0 0-1.92-1.601l-2.5 3a1.25 1.25 0 0 0 0 1.6l2.5 3a1.25 1.25 0 0 0 1.92-1.6L18.92 28h6.325c3.63 0 5.918-3.905 4.144-7.072zM11.748 25.5H6.753c-1.72 0-2.803-1.85-1.963-3.35l3.548-6.33l.809 1.518a1.25 1.25 0 0 0 2.206-1.176l-2-3.75a1.25 1.25 0 0 0-1.308-.645l-4.5.75a1.25 1.25 0 1 0 .41 2.466l2.19-.365l-3.536 6.31C.835 24.094 3.123 28 6.753 28h4.995a1.25 1.25 0 1 0 0-2.5" />
                </svg>',

                /* Fact 3 - Water */
                '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.963 14.938a6.54 6.54 0 0 0-.899-4.06l-4.89-7.26c-.42-.626-1.287-.804-1.936-.398a1.4 1.4 0 0 0-.41.397l-1.282 1.9M7.921 7.932l-1.986 2.946c-1.695 2.837-1.035 6.44 1.567 8.545s6.395 2.105 8.996 0a6.8 6.8 0 0 0 1.376-1.499M3 3l18 18" />
                </svg>',

                /* Fact 4 - Flower */
                '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none" />
                    <path fill="currentColor" d="M11.97 8C9.76 8.02 8.02 9.76 8 12.03c.02 2.21 1.76 3.95 4.03 3.97c2.21-.02 3.95-1.76 3.97-3.98v-.05c-.02-2.21-1.76-3.95-4.03-3.97M14 12.01A2 2 0 0 1 11.99 14c-1.1 0-1.98-.88-1.99-2.01A2 2 0 0 1 12.01 10c1.1 0 1.98.88 1.99 1.99h1l-1 .03Z" />
                    <path fill="currentColor" d="M16.76 5.45C16.11 3.43 14.21 2 12.01 2s-4.1 1.43-4.75 3.45c-2.13 0-4.08 1.37-4.75 3.46c-.68 2.1.1 4.34 1.82 5.59c-.66 2.02.03 4.29 1.81 5.59c.88.64 1.92.95 2.94.95s2.07-.32 2.94-.94a5.05 5.05 0 0 0 5.88 0a5 5 0 0 0 1.81-5.59a5.003 5.003 0 0 0-2.93-9.05Zm1.25 7.73c-.25.12-.45.33-.54.6s-.06.56.08.8a2.99 2.99 0 0 1-.85 3.89c-1.23.89-2.94.73-3.97-.38c-.38-.41-1.09-.41-1.46 0a3.015 3.015 0 0 1-3.97.38a2.99 2.99 0 0 1-.85-3.89c.14-.24.17-.53.08-.8s-.28-.49-.54-.6a2.996 2.996 0 0 1-1.6-3.65a3 3 0 0 1 3.44-2.02c.28.05.56 0 .78-.17c.23-.17.37-.42.4-.69c.17-1.51 1.45-2.64 2.98-2.64s2.8 1.14 2.98 2.64a.986.986 0 0 0 1.18.86c1.49-.3 2.98.57 3.44 2.02c.47 1.45-.22 3.02-1.6 3.65Z" />
                </svg>',

                /* Fact 5 - Packaging */
                '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m4 7l8-4l8 4v10l-8 4l-8-4V7Zm0 0l8 4l8-4M12 11v10"/>
                </svg>',

                /* Fact 6 - Delivery */
                '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                    <path d="M0 0h32v32H0z" fill="none" />
                    <path fill="currentColor" d="m29.92 16.61l-3-7A1 1 0 0 0 26 9h-3V7a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v17a1 1 0 0 0 1 1h2.14a4 4 0 0 0 7.72 0h6.28a4 4 0 0 0 7.72 0H29a1 1 0 0 0 1-1v-7a1 1 0 0 0-.08-.39M23 11h2.34l2.14 5H23ZM9 26a2 2 0 1 1 2-2a2 2 0 0 1-2 2m10.14-3h-6.28a4 4 0 0 0-7.72 0H4V8h17v12.56A4 4 0 0 0 19.14 23M23 26a2 2 0 1 1 2-2a2 2 0 0 1-2 2m5-3h-1.14A4 4 0 0 0 23 20v-2h5Z" />
                </svg>'
            ];
            ?>

            <!-- Displays the impact facts if the ACF repeater contains content -->
            <?php if (!empty($impact_facts)): ?>

                <div class="bouquet-impact-layout">

                    <!-- Left Side Impact -->
                    <div class="impact-facts impact-facts-left">

                        <?php
                        // Get the first three facts for the left side
                        // "true" keeps the original repeater indexes: 0, 1 and 2.
                        $left_facts = array_slice($impact_facts, 0, 3, true);

                        // Loop through each fact from the ACF repeater
                        foreach ($left_facts as $index => $fact):

                            // Get the title and description for the current impact fact
                            $title       = $fact['impact_title'] ?? '';
                            $description = $fact['impact_description'] ?? '';

                            // Match the fact with the icon stored in the code
                            $icon = $impact_icons[$index] ?? '';
                        ?>

                            <!-- Each Fact -->
                            <article class="impact-item">

                                <?php if ($icon): ?>
                                    <!-- Display the icon stored in the PHP array -->
                                    <div class="impact-icon">
                                        <?php echo $icon; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Title -->
                                <?php if ($title): ?>
                                    <h3>
                                        <?php echo esc_html($title); ?>
                                    </h3>
                                <?php endif; ?>

                                <!-- Description -->
                                <?php if ($description): ?>
                                    <p>
                                        <?php echo esc_html($description); ?>
                                    </p>
                                <?php endif; ?>

                            </article>

                        <?php endforeach; ?>

                    </div>


                    <!-- Bouquet Center Container-->
                    <div class="bouquet-center">

                        <!-- Left Top Arrow -->
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-left-top.png'); ?>"
                            alt="" class="impact-arrow arrow-left-top" aria-hidden="true">

                        <!-- Left Middle Arrow -->
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-middle.png'); ?>"
                            alt="" class="impact-arrow arrow-left-middle" aria-hidden="true">

                        <!-- Left Buttom Arrow -->
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-left-top.png'); ?>"
                            alt="" class="impact-arrow arrow-left-bottom" aria-hidden="true">

                        <!-- Right Top Arrow -->
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-left-top.png'); ?>"
                            alt="" class="impact-arrow arrow-right-top" aria-hidden="true">

                        <!-- Right Middle Arrow -->
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-middle.png'); ?>"
                            alt="" class="impact-arrow arrow-right-middle" aria-hidden="true">

                        <!-- Right Bottom Arrow -->
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-left-top.png'); ?>"
                            alt="" class="impact-arrow arrow-right-bottom" aria-hidden="true">

                        <!-- Displays the bouquet image if it exists in ACF -->
                        <?php if ($bouquet_url): ?>
                            <img src="<?php echo esc_url($bouquet_url); ?>" alt="Sustainable Nordic Bloom bouquet"
                                class="sustainability-bouquet">
                        <?php endif; ?>

                        <!-- Link to the Shop page -->
                        <a href="<?php echo esc_url(home_url('/shop/')); ?>" class="sustainability-button">
                            Shop Sustainable Bouquets
                        </a>

                    </div>


                    <!-- Right Side Impact -->
                    <div class="impact-facts impact-facts-right">

                        <?php
                        // Get the next three facts for the right side
                        // "true" keeps the original repeater indexes: 3, 4 and 5
                        $right_facts = array_slice($impact_facts, 3, 3, true);

                        // Loop through each fact from the ACF repeater
                        foreach ($right_facts as $index => $fact):

                            // Get the title and description for the current impact fact
                            $title       = $fact['impact_title'] ?? '';
                            $description = $fact['impact_description'] ?? '';

                            // Match the fact with the icon stored in the code
                            $icon = $impact_icons[$index] ?? '';
                        ?>

                            <!-- Each Fact -->
                            <article class="impact-item">
                                <?php if ($icon): ?>
                                    <!-- Display the icon stored in the PHP array -->
                                    <div class="impact-icon">
                                        <?php echo $icon; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Title -->
                                <?php if ($title): ?>
                                    <h3>
                                        <?php echo esc_html($title); ?>
                                    </h3>
                                <?php endif; ?>

                                <!-- Description -->
                                <?php if ($description): ?>
                                    <p>
                                        <?php echo esc_html($description); ?>
                                    </p>
                                <?php endif; ?>

                            </article>

                        <?php endforeach; ?>

                    </div>

                </div>

            <?php endif; ?>

        </div>

    </section>


    <!-- Our Approach Section -->
    <section class="sustainability-approach">

        <!-- Displays the approach image if it exists in ACF -->
        <?php if ($approach_image_url): ?>
            <div class="approach-image">
                <img src="<?php echo esc_url($approach_image_url); ?>"
                    alt="<?php echo esc_attr($approach_title ?: 'Nordic Bloom sustainability'); ?>">
            </div>
        <?php endif; ?>


        <div class="approach-content">

            <span class="small-line"></span>
            <!-- Label -->
            <?php if ($approach_label): ?>
                <p class="eyebrow">
                    <?php echo esc_html($approach_label); ?>
                </p>
            <?php endif; ?>

            <!-- Title -->
            <?php if ($approach_title): ?>
                <h2>
                    <?php echo esc_html($approach_title); ?>
                </h2>
            <?php endif; ?>

            <!-- Description -->
            <?php if ($approach_description): ?>
                <p>
                    <?php echo esc_html($approach_description); ?>
                </p>
            <?php endif; ?>

            <!-- Link to the About Us page -->
            <a href="<?php echo esc_url(home_url('/about-us/')); ?>" class="outline-button">
                About Us
            </a>

        </div>

    </section>

    <!-- What's Next Section -->
    <section class="sustainability-future">
        <!-- What's Next Container -->
        <div class="sustainability-container future-layout">

            <!-- What's Next Intro -->
            <div class="future-intro">

                <span class="small-line"></span>
                <!-- Label -->
                <?php if ($future_label): ?>
                    <p class="eyebrow">
                        <?php echo esc_html($future_label); ?>
                    </p>
                <?php endif; ?>

                <!-- Title -->
                <?php if ($future_title): ?>
                    <h2>
                        <?php echo esc_html($future_title); ?>
                    </h2>
                <?php endif; ?>

                <!-- Description -->
                <?php if ($future_description): ?>
                    <p>
                        <?php echo esc_html($future_description); ?>
                    </p>
                <?php endif; ?>

            </div>


            <!-- Display the future cards if the ACF repeater contains content -->
            <?php if (!empty($future_cards)): ?>

                <div class="future-cards">

                    <?php
                    // Store the three SVG icons used by the future cards
                    $future_icons = [

                        /* Card 1 - Local partners */
                        '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path d="M0 0h512v512H0z" fill="none" />
                            <path fill="currentColor" d="M408 304a168.21 168.21 0 0 0-152 96.5A168.21 168.21 0 0 0 104 304H16v16c0 92.636 75.364 168 168 168h144c92.636 0 168-75.364 168-168v-16ZM184 456c-69.581 0-127.124-52.519-135.064-120H104c69.581 0 127.124 52.519 135.064 120Zm144 0h-55.064c7.94-67.481 65.483-120 135.064-120h55.064c-7.94 67.481-65.483 120-135.064 120" />
                            <path fill="currentColor" d="M169.227 262.773a87.36 87.36 0 0 0 24.547 47.453l4.687 4.686h6.627A87.35 87.35 0 0 0 256 298.716a87.36 87.36 0 0 0 50.912 16.2h6.627l4.687-4.686a87.36 87.36 0 0 0 24.547-47.453a87.36 87.36 0 0 0 47.453-24.547l4.686-4.687v-6.627A87.35 87.35 0 0 0 378.716 176a87.36 87.36 0 0 0 16.2-50.912v-6.627l-4.686-4.687a87.36 87.36 0 0 0-47.453-24.547a87.36 87.36 0 0 0-24.547-47.453l-4.687-4.686h-6.627A87.36 87.36 0 0 0 256 53.284a87.35 87.35 0 0 0-50.912-16.2h-6.627l-4.687 4.686a87.36 87.36 0 0 0-24.547 47.453a87.36 87.36 0 0 0-47.453 24.547l-4.686 4.687v6.627A87.36 87.36 0 0 0 133.284 176a87.35 87.35 0 0 0-16.2 50.912v6.627l4.686 4.687a87.36 87.36 0 0 0 47.457 24.547m-3.736-98.086a55.57 55.57 0 0 1-16-32.8A55.57 55.57 0 0 1 184 120h16v-16a55.57 55.57 0 0 1 11.884-34.506a55.57 55.57 0 0 1 32.8 16L256 96.8l11.313-11.313a55.57 55.57 0 0 1 32.8-16A55.57 55.57 0 0 1 312 104v16h16a55.57 55.57 0 0 1 34.506 11.884a55.57 55.57 0 0 1-16 32.8L335.2 176l11.314 11.314a55.57 55.57 0 0 1 16 32.8A55.57 55.57 0 0 1 328 232h-16v16a55.57 55.57 0 0 1-11.884 34.506a55.57 55.57 0 0 1-32.8-16L256 255.2l-11.314 11.31a55.57 55.57 0 0 1-32.8 16A55.57 55.57 0 0 1 200 248v-16h-16a55.57 55.57 0 0 1-34.506-11.884a55.57 55.57 0 0 1 16-32.8L176.8 176Z" />
                        </svg>',

                        /* Card 2 - Delivery */
                        '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path d="M0 0h32v32H0z" fill="none" />
                            <path fill="currentColor" d="M4 16h12v2H4zm-2-5h10v2H2z" />
                            <path fill="currentColor" d="m29.919 16.606l-3-7A1 1 0 0 0 26 9h-3V7a1 1 0 0 0-1-1H6v2h15v12.556A4 4 0 0 0 19.142 23h-6.284a4 4 0 1 0 0 2h6.284a3.98 3.98 0 0 0 7.716 0H29a1 1 0 0 0 1-1v-7a1 1 0 0 0-.081-.394M9 26a2 2 0 1 1 2-2a2 2 0 0 1-2 2m14-15h2.34l2.144 5H23Zm0 15a2 2 0 1 1 2-2a2 2 0 0 1-2 2m5-3h-1.142A3.995 3.995 0 0 0 23 20v-2h5Z" />
                        </svg>',

                        /* Card 3 - Community */
                        '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 18v-1a5 5 0 0 1 5-5v0a5 5 0 0 1 5 5v1M1 18v-1a3 3 0 0 1 3-3v0m19 4v-1a3 3 0 0 0-3-3v0m-8-2a3 3 0 1 0 0-6a3 3 0 0 0 0 6m-8 2a2 2 0 1 0 0-4a2 2 0 0 0 0 4m16 0a2 2 0 1 0 0-4a2 2 0 0 0 0 4" />
                        </svg>'
                    ];

                    // Loop through each future card from the ACF repeater
                    foreach ($future_cards as $index => $card):

                        // Get the title and description for the current card
                        $card_title       = $card['future_cards_title'] ?? '';
                        $card_description = $card['future_cards_description'] ?? '';

                        // Skip the card if both fields are empty
                        if (!$card_title && !$card_description) {
                            continue;
                        }

                        // Matches each card with an icon - uses the third icon as a fallback
                        $icon = $future_icons[$index] ?? $future_icons[2];
                    ?>

                        <!-- Card Content -->
                        <article class="future-card">
                            <!-- Icon -->
                            <div class="future-card-icon">
                                <?php echo $icon; ?>
                            </div>

                            <!-- Title -->
                            <?php if ($card_title): ?>
                                <h3>
                                    <?php echo esc_html($card_title); ?>
                                </h3>
                            <?php endif; ?>

                            <!-- Description -->
                            <?php if ($card_description): ?>
                                <p>
                                    <?php echo esc_html($card_description); ?>
                                </p>
                            <?php endif; ?>

                        </article>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

    </section>


</main>


<?php get_footer(); ?>