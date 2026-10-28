<?php
get_header();

// Hero Section ACF
$heroBg       = get_field('hero_bg_image');
$heroTitle    = get_field('hero_title');
$heroSubtitle = get_field('hero_subtitle');

// Brand Section ACF
$tagline     = get_field('brand_tagline');
$heading     = get_field('brand_heading');
$description = get_field('brand_description');

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
<main id="primary" class="front-page">

    <!-- Hero Section -->
    <section class="hero-section">
        <?php if (!empty($heroBg['ID'])) : ?>
            <?php
            echo wp_get_attachment_image(
                $heroBg['ID'],
                'full',
                false,
                [
                    'class'         => 'hero-image',
                    'alt'           => '',
                    'loading'       => 'eager',
                    'fetchpriority' => 'high',
                    'sizes'         => '100vw',
                ]
            );
            ?>
        <?php endif; ?>

        <div class="hero-container">
            <div class="hero-content">
                <?php if ($heroTitle) : ?>
                    <h1>
                        <?php echo esc_html($heroTitle); ?>
                    </h1>
                <?php endif; ?>

                <?php if ($heroSubtitle) : ?>
                    <p>
                        <?php echo esc_html($heroSubtitle); ?>
                    </p>
                <?php endif; ?>

                <div class="hero-actions">
                    <a href="<?php echo esc_url(home_url('/shop')); ?>" class="hero-button hero-button-primary">
                        Shop Flowers
                    </a>

                    <a href="<?php echo esc_url(home_url('/sustainability')); ?>" class="hero-button hero-button-secondary">
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
                    <?php echo esc_html($tagline); ?>
                </span>
            <?php endif; ?>

            <div class="brand-card">
                <div class="brand-divider"></div>

                <?php if ($heading) : ?>
                    <h2 class="brand-heading">
                        <?php echo esc_html($heading); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <p class="brand-text">
                        <?php echo esc_html($description); ?>
                    </p>
                <?php endif; ?>

                <div class="brand-badge" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C12 2 7 7 7 12C7 14.7614 9.23858 17 12 17C14.7614 17 17 14.7614 17 12C17 7 12 2 12 2Z"
                            fill="var(--color-accent)"
                        />
                        <path d="M12 17V22" stroke="var(--color-accent)" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Benefits -->
    <section class="benefits-section">
        <div class="benefits-container">
            <?php
            $benefitsTitle       = get_field('benefits_title');
            $benefitsDescription = get_field('benefits_desc');
            ?>

            <?php if ($benefitsTitle) : ?>
                <h2 class="benefits-title">
                    <?php echo esc_html($benefitsTitle); ?>
                </h2>
            <?php endif; ?>

            <?php if ($benefitsDescription) : ?>
                <p class="benefits-description">
                    <?php echo esc_html($benefitsDescription); ?>
                </p>
            <?php endif; ?>

            <?php if (have_rows('benefits')) : ?>
                <div class="benefits-row">
                    <?php while (have_rows('benefits')) : ?>
                        <?php
                        the_row();

                        $icon  = get_sub_field('benefit_icon');
                        $name  = get_sub_field('benefit_name');
                        $about = get_sub_field('benefit_about');
                        ?>

                        <div class="benefit-card">
                            <?php if ($icon) : ?>
                                <div class="benefit-icon-wrap">
                                    <img src="<?php echo esc_url(is_array($icon) ? $icon['url'] : $icon); ?>"
                                        alt="<?php echo esc_attr($name); ?>"
                                    />
                                </div>
                            <?php endif; ?>

                            <?php if ($name) : ?>
                                <h3 class="benefit-name">
                                    <?php echo esc_html($name); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ($about) : ?>
                                <p class="benefit-about">
                                    <?php echo esc_html($about); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Split Section B2B and B2C -->
    <?php
    $splitHeading = get_field('split_heading');
    $i = 0;
    ?>

    <section class="split-section">
        <?php if ($splitHeading) : ?>
            <h2 class="split-section__heading">
                <?php echo esc_html($splitHeading); ?>
            </h2>
        <?php endif; ?>

        <?php if (have_rows('split_panels')) : ?>
            <?php while (have_rows('split_panels')) : ?>
                <?php
                the_row();
                $i++;

                $image    = get_sub_field('split_image');
                $eyebrow  = get_sub_field('split_eyebrow');
                $title    = get_sub_field('split_title');
                $desc     = get_sub_field('split_description');
                $features = get_sub_field('split_features');
                $link     = get_sub_field('split_button');
                $style    = get_sub_field('button_style') ?: 'solid';
                $pos      = ($i % 2 === 1) ? 'left' : 'right';
                ?>

                <div class="split split--img-<?php echo esc_attr($pos); ?>">
                    <div class="split__image">
                        <?php if ($image) : ?>
                            <?php echo wp_get_attachment_image($image, 'medium'); ?>
                        <?php endif; ?>
                    </div>

                    <div class="split__content">
                        <?php if ($eyebrow) : ?>
                            <span class="eyebrow">
                                <?php echo esc_html($eyebrow); ?>
                            </span>
                        <?php endif; ?>

                        <?php if ($title) : ?>
                            <h3 class="split__title">
                                <?php echo esc_html($title); ?>
                            </h3>
                        <?php endif; ?>

                        <?php if ($desc) : ?>
                            <p class="split__desc">
                                <?php echo esc_html($desc); ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($features) : ?>
                            <ul class="split__features">
                                <?php foreach (preg_split('/\r\n|\r|\n/', trim($features)) as $feature) : ?>
                                    <?php if ($feature !== '') : ?>
                                        <li>
                                            <?php echo esc_html($feature); ?>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if ($link) : ?>
                            <a class="btn btn--<?php echo esc_attr($style); ?>" href="<?php echo esc_url($link['url']); ?>"
                                <?php if (!empty($link['target'])) : ?>
                                    target="<?php echo esc_attr($link['target']); ?>"
                                    rel="noopener"
                                <?php endif; ?>
                            >
                                <?php echo esc_html($link['title']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>

    <!-- Testimonials Section -->
    <?php if ($testimonials) : ?>
        <section class="testimonials-section">
            <div class="testimonials-container">
                <div class="testimonials-intro">
                    <span class="small-line"></span>

                    <?php if ($testimonials_label) : ?>
                        <p class="eyebrow">
                            <?php echo esc_html($testimonials_label); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($testimonials_title) : ?>
                        <h2>
                            <?php echo esc_html($testimonials_title); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($testimonials_description) : ?>
                        <p class="testimonials-description">
                            <?php echo esc_html($testimonials_description); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="testimonials-grid">
                    <?php foreach ($testimonials as $testimonial) : ?>
                        <?php
                        $name  = $testimonial['customer_name'] ?? '';
                        $role  = $testimonial['customer_role'] ?? '';
                        $text  = $testimonial['testimonial_text'] ?? '';
                        $image = $testimonial['customer_image'] ?? '';

                        if (is_array($image)) {
                            $image = $image['url'] ?? '';
                        }
                        ?>

                        <article class="testimonial-card">
                            <div class="testimonial-stars">
                                ★★★★★
                            </div>

                            <?php if ($text) : ?>
                                <p class="testimonial-text">
                                    “<?php echo esc_html($text); ?>”
                                </p>
                            <?php endif; ?>

                            <div class="testimonial-person">
                                <?php if ($image) : ?>
                                    <img
                                        src="<?php echo esc_url($image); ?>"
                                        alt="<?php echo esc_attr($name); ?>"
                                    />
                                <?php endif; ?>

                                <div>
                                    <?php if ($name) : ?>
                                        <h3>
                                            <?php echo esc_html($name); ?>
                                        </h3>
                                    <?php endif; ?>

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
        <div class="newsletter-container">
            <div class="newsletter-content">
                <span class="newsletter-line"></span>

                <?php if ($newsletter_label) : ?>
                    <p class="newsletter-label">
                        <?php echo esc_html($newsletter_label); ?>
                    </p>
                <?php endif; ?>

                <?php if ($newsletter_title) : ?>
                    <h2 class="newsletter-title">
                        <?php echo esc_html($newsletter_title); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($newsletter_description) : ?>
                    <p class="newsletter-description">
                        <?php echo esc_html($newsletter_description); ?>
                    </p>
                <?php endif; ?>


                <!-- Newsletter Subscription -->
                <form class="newsletter-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                    <input type="hidden" name="action"value="nordicbloom_newsletter"/>

                    <?php wp_nonce_field('newsletter_action', 'newsletter_nonce'); ?>

                    <div class="newsletter-form-row">
                        <input type="email" name="newsletter_email" class="newsletter-input" placeholder="Your email address"
                            aria-label="Your email address" required
                        />

                        <button type="submit" class="newsletter-button">
                            Subscribe
                        </button>
                    </div>

                    <p class="newsletter-privacy">
                        We respect your privacy. Your email will be sent to our team as a subscription request.
                    </p>

                    <?php if (isset($_GET['newsletter']) && $_GET['newsletter'] === 'success') : ?>
                        <p class="newsletter-success" role="status">
                            Thank you! Your subscription request has been received.
                        </p>
                    <?php endif; ?>
                </form>

            </div>

            <?php if (!empty($newsletter_image['ID'])) : ?>
                <div class="newsletter-image">
                    <?php
                    echo wp_get_attachment_image(
                        $newsletter_image['ID'],
                        'large',
                        false,
                        [
                            'alt'     => 'Nordic Bloom flower arrangement',
                            'loading' => 'lazy',
                            'sizes'   => '(max-width: 900px) 100vw, 45vw',
                        ]
                    );
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>