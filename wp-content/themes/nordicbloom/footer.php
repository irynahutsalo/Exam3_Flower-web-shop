<?php
// Get the front page ID for global footer content
$front_page_id = (int) get_option('page_on_front');
$footer_source = $front_page_id ?: false;

// Footer ACF Fields
$brandName     = get_field('footer_brand_name', $footer_source);
$brandAddress  = get_field('footer_brand_address', $footer_source);
$csTitle       = get_field('footer_customer_service_title', $footer_source);
$socialTitle   = get_field('footer_social_media_title', $footer_source);
$copyright     = get_field('footer_copyright_text', $footer_source);
$customerLinks = get_field('footer_customer_service_links', $footer_source);
$socialLinks   = get_field('footer_social_media_links', $footer_source);
?>

<footer class="site-footer">
    <div class="footer-container">

        <!-- Brand Column -->
        <div class="footer-col footer-brand-col">
            <?php if ($brandName) : ?>
                <p class="footer-logo">
                    <?= esc_html($brandName); ?>
                </p>
            <?php endif; ?>

            <?php if ($brandAddress) : ?>
                <p class="footer-address">
                    <?= nl2br(esc_html($brandAddress)); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Customer Service Column -->
        <div class="footer-col">
            <?php if ($csTitle) : ?>
                <h2 class="footer-title" id="footer-customer-service-title">
                    <?= esc_html($csTitle); ?>
                </h2>
            <?php endif; ?>

            <?php if (is_array($customerLinks) && $customerLinks) : ?>
                <nav
                    <?php if ($csTitle) : ?>
                        aria-labelledby="footer-customer-service-title"
                    <?php else : ?>
                        aria-label="Footer customer service"
                    <?php endif; ?>
                >
                    <ul class="footer-links">
                        <?php foreach ($customerLinks as $row) : ?>
                            <?php foreach (['delivery_item', 'subscriptions_item', 'faq_item'] as $field) : ?>
                                <?php if (!empty($row[$field])) : ?>
                                    <li>
                                        <span class="footer-link-text">
                                            <?= esc_html($row[$field]); ?>
                                        </span>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <?php if (!empty($row['contact_us_item'])) : ?>
                                <li>
                                    <a href="<?= esc_url(home_url('/contact/')); ?>">
                                        <?= esc_html($row['contact_us_item']); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>

        <!-- Social Media Column -->
        <div class="footer-col">
            <?php if ($socialTitle) : ?>
                <h2 class="footer-title" id="footer-social-media-title">
                    <?= esc_html($socialTitle); ?>
                </h2>
            <?php endif; ?>

            <?php if (is_array($socialLinks) && $socialLinks) : ?>
                <nav
                    <?php if ($socialTitle) : ?>
                        aria-labelledby="footer-social-media-title"
                    <?php else : ?>
                        aria-label="Footer social media"
                    <?php endif; ?>
                >
                    <ul class="footer-links">
                        <?php foreach ($socialLinks as $row) :
                            $name = $row['platform_name'] ?? '';
                            $url  = $row['platform_url'] ?? '';
                        ?>
                            <?php if ($name && $url) : ?>
                                <li>
                                    <a href="<?= esc_url($url); ?>" target="_blank"  rel="noopener noreferrer">
                                        <?= esc_html($name); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>

    </div>

    <!-- Copyright -->
    <?php if ($copyright) : ?>
        <div class="footer-bottom">
            <p><?= esc_html($copyright); ?></p>
        </div>
    <?php endif; ?>
</footer>

<?php wp_footer(); ?>