<?php get_header(); ?>

<main id="primary" class="container">

    <!-- Accessible Main Heading -->
    <h1 class="screen-reader-text">
        <?php esc_html_e('My Account', 'woocommerce'); ?>
    </h1>

    <!-- WooCommerce Account Content -->
    <?php echo do_shortcode('[woocommerce_my_account]'); ?>

</main>

<?php get_footer(); ?>