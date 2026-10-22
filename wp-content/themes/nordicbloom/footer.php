<?php
// Get the front page ID to display footer content across the website
$front_page_id = get_option('page_on_front');
$footer_source = $front_page_id ?: false;

// Footer ACF Fields
$brandName    = get_field('footer_brand_name', $footer_source);
$brandAddress = get_field('footer_brand_address', $footer_source);
$csTitle      = get_field('footer_customer_service_title', $footer_source);
$socialTitle  = get_field('footer_social_media_title', $footer_source);
$copyright    = get_field('footer_copyright_text', $footer_source);
?>

<footer class="site-footer">
    <div class="footer-container">

        <!-- Brand Column -->
        <div class="footer-col footer-brand-col">
            <?php if ($brandName) : ?>
                <h3 class="footer-logo"><?= esc_html($brandName); ?></h3>
            <?php endif; ?>

            <?php if ($brandAddress) : ?>
                <p class="footer-address"><?= nl2br(esc_html($brandAddress)); ?></p>
            <?php endif; ?>
        </div>

        <!-- Customer Service Column -->
        <div class="footer-col">
            <?php if ($csTitle) : ?>
                <h4 class="footer-title"><?= esc_html($csTitle); ?></h4>
            <?php endif; ?>

            <?php if (have_rows('footer_customer_service_links', $footer_source)) : ?>
                <ul class="footer-links">
                    <?php while (have_rows('footer_customer_service_links', $footer_source)) : the_row();
                        $delivery      = get_sub_field('delivery_item');
                        $subscriptions = get_sub_field('subscriptions_item');
                        $faq           = get_sub_field('faq_item');
                        $contact       = get_sub_field('contact_us_item');
                    ?>

                        <?php if ($delivery) : ?>
                            <li><?= esc_html($delivery); ?></li>
                        <?php endif; ?>

                        <?php if ($subscriptions) : ?>
                            <li><?= esc_html($subscriptions); ?></li>
                        <?php endif; ?>

                        <?php if ($faq) : ?>
                            <li><?= esc_html($faq); ?></li>
                        <?php endif; ?>

                        <?php if ($contact) : ?>
                            <li>
                                <a href="<?= esc_url(home_url('/contact/')); ?>">
                                    <?= esc_html($contact); ?>
                                </a>
                            </li>
                        <?php endif; ?>

                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Social Media Column -->
        <div class="footer-col">
            <?php if ($socialTitle) : ?>
                <h4 class="footer-title"><?= esc_html($socialTitle); ?></h4>
            <?php endif; ?>

            <?php if (have_rows('footer_social_links', $footer_source)) : ?>
                <ul class="footer-links">
                    <?php while (have_rows('footer_social_links', $footer_source)) : the_row();
                        $name  = get_sub_field('platform_name');
                        $url   = get_sub_field('platform_url');
                        $badge = get_sub_field('platform_badge');
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

                    <?php endwhile; ?>
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
