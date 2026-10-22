<?php
// Get the front page ID to display footer content across the website
$front_page_id = (int) get_option('page_on_front');
$footer_source = $front_page_id ?: false;

// Footer ACF Fields
$brandName    = get_field('footer_brand_name', $footer_source);
$brandAddress = get_field('footer_brand_address', $footer_source);
$csTitle      = get_field('footer_customer_service_title', $footer_source);
$socialTitle  = get_field('footer_social_media_title', $footer_source);
$copyright    = get_field('footer_copyright_text', $footer_source);

// Customer Service Links
$customerLinks = get_field('footer_customer_service_links', $footer_source);

// Social Media Links
$socialLinks = get_field('footer_social_media_links', $footer_source);

// Fallback for previously saved ACF repeater data
if (empty($socialLinks) && $front_page_id) {
    $socialLinks = get_post_meta(
        $front_page_id,
        'footer_social_links',
        true
    );

    if (!empty($socialLinks) && !is_array($socialLinks)) {
        $socialLinks = [];

        $oldRows = (int) get_post_meta(
            $front_page_id,
            'footer_social_links',
            true
        );

        for ($i = 0; $i < $oldRows; $i++) {
            $socialLinks[] = [
                'platform_name' => get_post_meta(
                    $front_page_id,
                    "footer_social_links_{$i}_platform_name",
                    true
                ),
                'platform_url' => get_post_meta(
                    $front_page_id,
                    "footer_social_links_{$i}_platform_url",
                    true
                ),
            ];
        }
    }
}
?>

<footer class="site-footer">
    <div class="footer-container">

        <!-- Brand Column -->
        <div class="footer-col footer-brand-col">
            <?php if ($brandName) : ?>
                <h3 class="footer-logo">
                    <?= esc_html($brandName); ?>
                </h3>
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
                <h4 class="footer-title">
                    <?= esc_html($csTitle); ?>
                </h4>
            <?php endif; ?>

            <?php if (!empty($customerLinks) && is_array($customerLinks)) : ?>
                <ul class="footer-links">
                    <?php foreach ($customerLinks as $row) :
                        $delivery      = $row['delivery_item'] ?? '';
                        $subscriptions = $row['subscriptions_item'] ?? '';
                        $faq           = $row['faq_item'] ?? '';
                        $contact       = $row['contact_us_item'] ?? '';
                    ?>

                        <?php if ($delivery) : ?>
                            <li>
                                <span class="footer-link-text">
                                    <?= esc_html($delivery); ?>
                                </span>
                            </li>
                        <?php endif; ?>

                        <?php if ($subscriptions) : ?>
                            <li>
                                <span class="footer-link-text">
                                    <?= esc_html($subscriptions); ?>
                                </span>
                            </li>
                        <?php endif; ?>

                        <?php if ($faq) : ?>
                            <li>
                                <span class="footer-link-text">
                                    <?= esc_html($faq); ?>
                                </span>
                            </li>
                        <?php endif; ?>

                        <?php if ($contact) : ?>
                            <li>
                                <a href="<?= esc_url(home_url('/contact/')); ?>">
                                    <?= esc_html($contact); ?>
                                </a>
                            </li>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Social Media Column -->
        <div class="footer-col">
            <?php if ($socialTitle) : ?>
                <h4 class="footer-title">
                    <?= esc_html($socialTitle); ?>
                </h4>
            <?php endif; ?>

            <?php if (!empty($socialLinks) && is_array($socialLinks)) : ?>
                <ul class="footer-links">
                    <?php foreach ($socialLinks as $row) :
                        $name  = $row['platform_name'] ?? '';
                        $url   = $row['platform_url'] ?? '';
                        $badge = $row['platform_badge'] ?? '';
                    ?>

                        <?php if ($name && $url) : ?>
                            <li>
                                <a
                                    href="<?= esc_url($url); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <?= esc_html($name); ?>

                                    <?php if ($badge) : ?>
                                        <span class="footer-badge">
                                            <?= esc_html($badge); ?>
                                        </span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </ul>
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

</body>
</html>
