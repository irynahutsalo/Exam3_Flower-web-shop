<?php
get_header();

// Hero Section ACF
$heroBg       = get_field('hero_bg_image');
$heroTitle    = get_field('hero_title');
$heroSubtitle = get_field('hero_subtitle');

// Brand Section ACF (NEEDS TO BE ADJUSTED)
$tagline      = get_field('brand_tagline');
$heading      = get_field('brand_heading');
$description  = get_field('brand_description');

// Testimonials
$testimonials_label       = get_field('testimonials_label');
$testimonials_title       = get_field('testimonials_title');
$testimonials_description = get_field('testimonials_description');
$testimonials             = get_field('testimonials');

// Newsletter
$newsletter_label       = get_field('newsletter_label');
$newsletter_title       = get_field('newsletter_title');
$newsletter_description = get_field('newsletter_description');
$newsletter_image       = get_field('newsletter_image');
?>


<!-- Entire Main Page -->
<main class="front-page">

    <!-- Hero Section -->
    <section class="hero-section"
        <?php if ($heroBg) : ?> style="background-image: url('<?= esc_url($heroBg['url']); ?>');"
        <?php endif;
        ?>>

        <!-- Hero Container  -->
        <div class="hero-container">

            <!-- Hero Content -->
            <div class="hero-content">

                <?php if ($heroTitle) : ?>
                    <h1><?= esc_html($heroTitle); ?></h1>
                <?php endif; ?>

                <?php if ($heroSubtitle) : ?>
                    <p><?= esc_html($heroSubtitle); ?></p>
                <?php endif; ?>

                <!-- Buttons Wrapper -->
                <div class="hero-actions">

                    <a href="<?= esc_url(home_url('/shop')); ?>" class="hero-button hero-button-primary">
                        Shop Flowers
                    </a>

                    <a href="<?= esc_url(home_url('/sustainability')); ?>" class="hero-button hero-button-secondary">
                        How It Works
                    </a>

                </div>

            </div>

        </div>

    </section>


    <!-- Brand Message -->
    <section class="brand-section">

        <div class="brand-container">

            <?php if ($tagline) : ?>
                <span class="brand-tagline">
                    <?= esc_html($tagline); ?>
                </span>
            <?php endif; ?>

            <div class="brand-card">

                <div class="brand-divider"></div>

                <?php if ($heading) : ?>
                    <h2 class="brand-heading">
                        <?= esc_html($heading); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <p class="brand-text">
                        <?= esc_html($description); ?>
                    </p>
                <?php endif; ?>

                <div class="brand-badge" aria-hidden="true">

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C12 2 7 7 7 12C7 14.7614 9.23858 17 12 17C14.7614 17 17 14.7614 17 12C17 7 12 2 12 2Z"
                        fill="var(--color-accent)" />
                        <path d="M12 17V22"
                            stroke="var(--color-accent)"
                            stroke-width="2"
                            stroke-linecap="round" />
                    </svg>

                </div>

            </div>

        </div>

    </section>

    <!-- Brand Benefits -->
    <section class="benefits-section">
        <div class="benefits-container">

            <?php
            $benefitsTitle = get_field('benefits_title');
            $benefitsDescription = get_field('benefits_desc');
            ?>

            <?php if ($benefitsTitle) : ?>
                <h2 class="benefits-title"><?php echo esc_html($benefitsTitle); ?></h2>
            <?php endif; ?>

            <?php if ($benefitsDescription) : ?>
                <p class="benefits-description"><?php echo esc_html($benefitsDescription); ?></p>
            <?php endif; ?>

            <?php if (have_rows('benefits')) : ?>
                <div class="benefits-row">
                    <?php while (have_rows('benefits')) : the_row(); 
                    $icon  = get_sub_field('benefit_icon');
                    $name  = get_sub_field('benefit_name');
                    $about = get_sub_field('benefit_about');
                    ?>
                        <div class="benefit-card">
                            <?php if ($icon) : ?>
                                <div class="benefit-icon-wrap">
                                    <img src="<?php echo esc_url(is_array($icon) ? $icon['url'] : $icon); ?>" alt="<?php echo esc_attr($name); ?>" />
                                </div>
                            <?php endif; ?>

                            <?php if ($name) : ?>
                                <h3 class="benefit-name"><?php echo esc_html($name); ?></h3>
                            <?php endif; ?>

                            <?php if ($about) : ?>
                                    <p class="benefit-about"><?php echo esc_html($about); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

        </div>
    </section>

    
    <!-- Testimonials Section -->
    <?php if ($testimonials) : ?>
        <section class="testimonials-section">

            <!-- Testimonials Container -->
            <div class="testimonials-container">

                <!-- Testimonials Introduction Container -->
                <div class="testimonials-intro">

                    <span class="small-line"></span>

                    <!-- Label -->
                    <?php if ($testimonials_label) : ?>
                        <p class="eyebrow">
                            <?php echo esc_html($testimonials_label); ?>
                        </p>
                    <?php endif; ?>

                    <!-- Title -->
                    <?php if ($testimonials_title) : ?>
                        <h2>
                            <?php echo esc_html($testimonials_title); ?>
                        </h2>
                    <?php endif; ?>

                    <!-- Description -->
                    <?php if ($testimonials_description) : ?>
                        <p class="testimonials-description">
                            <?php echo esc_html($testimonials_description); ?>
                        </p>
                    <?php endif; ?>

                </div>


                <!-- Testimonial Grid -->
                <div class="testimonials-grid">
                    <!-- Loop through each testimonial -->
                    <?php foreach ($testimonials as $testimonial) : ?>

                        <!-- Gets the name, role, testimonial text and customer image-->
                        <?php
                        $name  = $testimonial['customer_name'] ?? '';
                        $role  = $testimonial['customer_role'] ?? '';
                        $text  = $testimonial['testimonial_text'] ?? '';
                        $image = $testimonial['customer_image'] ?? '';

                        if (is_array($image)) {
                            $image = $image['url'] ?? '';
                        }
                        ?>

                        <!-- testimonial Card -->
                        <article class="testimonial-card">
                            <!-- Starts -->
                            <div class="testimonial-stars">
                                ★★★★★
                            </div>

                            <!-- Testimonial Text -->
                            <?php if ($text) : ?>
                                <p class="testimonial-text">
                                    “<?php echo esc_html($text); ?>”
                                </p>
                            <?php endif; ?>

                            <!-- Customer Image -->
                            <div class="testimonial-person">
                                <?php if ($image) : ?>
                                    <img
                                        src="<?php echo esc_url($image); ?>"
                                        alt="<?php echo esc_attr($name); ?>">
                                <?php endif; ?>

                                <!-- Name + Role Container -->
                                <div>
                                    <!-- Name -->
                                    <?php if ($name) : ?>
                                        <h3>
                                            <?php echo esc_html($name); ?>
                                        </h3>
                                    <?php endif; ?>

                                    <!-- Role -->
                                    <?php if ($role) : ?>
                                        <span>
                                            <?php echo esc_html($role); ?>
                                        </span>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </article>

                    <?php endforeach; ?>

                </div>

            </div>

        </section>
    <?php endif; ?>


    <!-- Newsletter Section -->
    <section class="newsletter-section">

        <!-- Newsletter Container -->
        <div class="newsletter-container">

            <!-- Left Side -->
            <div class="newsletter-content">

                <span class="newsletter-line"></span>
                <!-- Label -->
                <?php if ($newsletter_label) : ?>
                    <p class="newsletter-label">
                        <?php echo esc_html($newsletter_label); ?>
                    </p>
                <?php endif; ?>

                <!-- Title -->
                <?php if ($newsletter_title) : ?>
                    <h2 class="newsletter-title">
                        <?php echo esc_html($newsletter_title); ?>
                    </h2>
                <?php endif; ?>

                <!-- Description -->
                <?php if ($newsletter_description) : ?>
                    <p class="newsletter-description">
                        <?php echo esc_html($newsletter_description); ?>
                    </p>
                <?php endif; ?>

                <!-- Newsletter Subscription -->
                <form class="newsletter-form">
                    
                    <div class="newsletter-form-row">
                        <!-- Input -->
                        <input type="email" name="newsletter_email" class="newsletter-input" placeholder="Your email address"
                            aria-label="Your email address" required
                        >
                        <!-- Button -->
                        <button type="submit" class="newsletter-button">
                            Subscribe
                        </button>
                    </div>

                    <!-- Disclaimer -->
                    <p class="newsletter-privacy">
                        We respect your privacy. You can unsubscribe at any time.
                    </p>

                </form>

            </div>


            <!-- Right Side -->
            <?php if ($newsletter_image) : ?>

                <!-- Checks for the image -->
                <?php $newsletter_image_url = is_array($newsletter_image) ? ($newsletter_image['url'] ?? ''): $newsletter_image;?>

                <!-- Imaage -->
                <div class="newsletter-image">
                    <img src="<?php echo esc_url($newsletter_image_url); ?>" alt="Nordic Bloom flower arrangement">
                </div>

            <?php endif; ?>

        </div>

    </section>

</main>

<?php get_footer(); ?>