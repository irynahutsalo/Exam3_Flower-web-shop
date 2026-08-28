<?php 
// Get the front page ID so the footer pulls data everywhere
$front_page_id = get_option('page_on_front');
$footer_source = $front_page_id ? $front_page_id : '';

$brandName    = get_field('footer_brand_name', $footer_source);
$brandAddress = get_field('footer_brand_address', $footer_source);
$brandSlogan  = get_field('footer_brand_slogan', $footer_source);
$csTitle      = get_field('cs_title', $footer_source);
$socialTitle  = get_field('social_title', $footer_source);
$copyright    = get_field('copyright_text', $footer_source);
?>

<footer class="site-footer">
    <div class="footer-container footer-3-cols">
        
        <!-- 1. Brand Column (Left) -->
        <div class="footer-col footer-brand-col">
            <?php if ($brandName) : ?>
                <h3 class="footer-logo"><?= esc_html($brandName); ?></h3>
            <?php endif; ?>
            
            <?php if ($brandAddress) : ?>
                <p class="footer-address"><?= nl2br(esc_html($brandAddress)); ?></p>
            <?php endif; ?>
            
            <?php if ($brandSlogan) : ?>
                <p class="footer-slogan"><?= esc_html($brandSlogan); ?></p>
            <?php endif; ?>
        </div>

        <!-- 2. Customer Service Column (from admin repeater) -->
        <div class="footer-col">
            <?php if ($csTitle) : ?>
                <h4 class="footer-title"><?= esc_html($csTitle); ?></h4>
            <?php endif; ?>

            <?php if (have_rows('customer_service_links', $footer_source)) : ?>
                <ul class="footer-links">
                    <?php while (have_rows('customer_service_links', $footer_source)) : the_row(); 
                        $delivery      = get_sub_field('delivery_item');
                        $subscriptions = get_sub_field('subscriptions_item');
                        $faq           = get_sub_field('faq_item');
                        $contact       = get_sub_field('Contact Us');
                    ?>
                        <?php if ($delivery) : ?>
                            <li><a href="#"><?= esc_html($delivery); ?></a></li>
                        <?php endif; ?>

                        <?php if ($subscriptions) : ?>
                            <li><a href="#"><?= esc_html($subscriptions); ?></a></li>
                        <?php endif; ?>

                        <?php if ($faq) : ?>
                            <li><a href="#"><?= esc_html($faq); ?></a></li>
                        <?php endif; ?>

                        <?php if ($contact) : ?>
                            <li><a href="#"><?= esc_html($contact); ?></a></li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </div>

        <!-- 3. Social Media Column (from admin repeater) -->
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
                        <li>
                            <a href="<?= esc_url($url); ?>" target="_blank" rel="noopener">
                                <?= esc_html($name); ?>
                                <?php if ($badge) : ?>
                                    <span class="footer-badge"><?= esc_html($badge); ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </div>

    </div>

    <!-- Bottom Row (Copyright) -->
    <?php if ($copyright) : ?>
        <div class="footer-bottom">
            <div class="footer-bottom-container">
                <p><?php echo esc_html($copyright); ?></p>
            </div>
        </div>
    <?php endif; ?>
</footer>

<?php wp_footer(); ?>

</body>
</html>