<?php

// ----------------------------------------------
// Custom SEO Title Filter
// ----------------------------------------------

/*
 * Use a custom SEO title from ACF when one is available.
 * For regular pages, read the field from the current page.
 * For the blog listing, read it from the page assigned as the Posts page.
 * If the field is empty, keep the title value provided by WordPress.
 * This changes the browser tab title, not the visible page heading.
 */

add_filter('pre_get_document_title', function($title) {
    if (is_page()) {
        $seo_title = get_field('seo_title', get_queried_object_id());
        if ($seo_title) {
            return $seo_title;
        }
    } elseif (is_home()) { //adds title to the blog as well since it's not considered page but a home.php page
        $seo_title = get_field('seo_title', get_option('page_for_posts'));
        if ($seo_title) {
            return $seo_title;
        }
    } elseif (function_exists('is_shop') && is_shop()) { //adds title to shop since it is also not a regular page but a woocommerce
        $shop_page_id = wc_get_page_id('shop');
        $seo_title = get_field('seo_title', $shop_page_id);
        if ($seo_title) {
            return $seo_title;
        }
    } else {
        $seo_title = '';
    }

    return $seo_title ?: $title;
});


// --------------------------------------------------------- Theme Setup --------------------------------------------------

/*
 * Set up the main theme features.
 * Enable featured images for posts and supported post types.
 * Let WordPress generate the HTML title tag.
 * Register a menu location called Primary Menu.
 * The after_setup_theme hook runs this function during theme setup.
 */

function nordicbloom_theme_setup()
{

    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'nordicbloom'),
    ));
}

add_action('after_setup_theme', 'nordicbloom_theme_setup');

// WooCommerce support.

/*
 * Declare that this theme supports WooCommerce.
 * This allows WooCommerce to recognise the theme as compatible.
 * It does not install the plugin or create products.
 * Run this function during theme setup.
 */

function shop_enable_woocommerce()
{
    add_theme_support('woocommerce');
}   
add_action('after_setup_theme', 'shop_enable_woocommerce');


// ------------------------------------------------ CSS Stylesheets ----------------------------------------------

/*
 * Load the stylesheets used by the theme.
 * Load the main stylesheet, Inter font, base, header and footer styles on every page.
 * Load page-specific styles only on the matching pages.
 * Use stylesheet dependencies to load base styles before page styles.
 * On WooCommerce pages, load shared shop styles first,
 * then load the stylesheet for the current shop page.
 */

function nordicbloom_enqueue_styles()
{
    // Main WordPress stylesheet
    wp_enqueue_style(
        'nordicbloom-style',
        get_stylesheet_uri()
    );

    // Google Font - Inter
    wp_enqueue_style(
    'nordicbloom-google-fonts',
    'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap',
    []
    );

    // Global / base styles
    wp_enqueue_style(
        'nordicbloom-base',
        get_template_directory_uri() . '/assets/css/base.css',
        ['nordicbloom-style']
    );

    // Header styles
    wp_enqueue_style(
        'nordicbloom-header',
        get_template_directory_uri() . '/assets/css/header.css',
        ['nordicbloom-base']
    );

    // Footer styles
    wp_enqueue_style(
        'nordicbloom-footer',
        get_template_directory_uri() . '/assets/css/footer.css',
        ['nordicbloom-base']
    );

    // Front Page styles
    if (is_front_page()) {
        wp_enqueue_style(
            'nordicbloom-front-page',
            get_template_directory_uri() . '/assets/css/pages/front-page.css',
            ['nordicbloom-base'],
            '1.0'
        );
    }

    // Contact Page
    // Load styles only on the Contact page.
    // Use the file modification time as the stylesheet version.
    // When the file changes, its URL version changes to help refresh cached CSS.

    if (is_page('contact')) {
        wp_enqueue_style(
            'nordicbloom-contact',
            get_template_directory_uri() . '/assets/css/pages/page-contact.css',
            ['nordicbloom-base'],
            filemtime(
                get_template_directory() . '/assets/css/pages/page-contact.css'
            )
        );
    }

    // Flower Club Page
    // Load styles only on the Flower Club page.
    // Use the file modification time to update the CSS version after edits.
    if (is_page('flower-club')) {
        wp_enqueue_style(
            'nordicbloom-flower-club',
            get_template_directory_uri() . '/assets/css/pages/page-flower-club.css',
            ['nordicbloom-base'],
            filemtime(
                get_template_directory() . '/assets/css/pages/page-flower-club.css'
            )
        );
    }

    // Sustainability Page
    if (is_page('sustainability')) {
        wp_enqueue_style(
            'nordicbloom-sustainability',
            get_template_directory_uri() . '/assets/css/pages/page-sustainability.css',
            ['nordicbloom-base'],
            '1.0'
        );
    }

    // Blog Page
    // Load styles for the blog listing.
    // In WordPress, is_home() identifies the Posts page.
    if (is_home()) {
        wp_enqueue_style(
            'nordicbloom-blog',
            get_template_directory_uri() . '/assets/css/pages/blog.css',
            ['nordicbloom-base']
        );
    }

    // Single Blog Post
    // Load styles for individual blog posts, including their comments section.
    // This condition does not include WooCommerce product pages.
    if (is_singular('post')) {
        // Single blog post styles
        wp_enqueue_style(
            'nordicbloom-single',
            get_template_directory_uri() . '/assets/css/pages/single.css',
            ['nordicbloom-base'],
            filemtime(get_template_directory() . '/assets/css/pages/single.css')
        );

        // Blog comments styles
        wp_enqueue_style(
            'nordicbloom-comments',
            get_template_directory_uri() . '/assets/css/pages/comments.css',
            ['nordicbloom-single'],
            filemtime(get_template_directory() . '/assets/css/pages/comments.css')
        );
    }



// ----------------------------------------- WooCommerce styles --------------------------------------------
// Check that WooCommerce functions are available before calling them.
// Include the catalogue, products, cart, checkout and account pages.

if (
    function_exists('is_woocommerce')
    && (is_woocommerce() || is_cart() || is_checkout() || is_account_page())
) {
    // Shared styles.
    wp_enqueue_style(
        'nordicbloom-woocommerce',
        get_template_directory_uri() . '/assets/css/pages/woocommerce.css',
        ['nordicbloom-base']
    );

    // Select the stylesheet name for the current WooCommerce page.
    // Product, cart, checkout and account pages have their own files.
    // Other matching pages, such as product categories, use shop.css.
    if (is_product()) {
        $page_style = 'product';
    } elseif (is_cart()) {
        $page_style = 'cart';
    } elseif (is_checkout()) {
        $page_style = 'checkout';
    } elseif (is_account_page()) {
        $page_style = 'account';
    } else {
        $page_style = 'shop';
    }

    wp_enqueue_style(
        'nordicbloom-' . $page_style,
        get_template_directory_uri() . '/assets/css/pages/' . $page_style . '.css',
        ['nordicbloom-woocommerce']
    );
}

}

add_action('wp_enqueue_scripts', 'nordicbloom_enqueue_styles');



// ------------------------------------------------------------- Parsley Script ----------------------------------------------
/*
 * Load Parsley.js validation on the Contact page and homepage newsletter form.
 * Include jQuery as a dependency and load Parsley in the footer.
 * Initialize newsletter validation on the homepage.
 * Validate user input in the browser and again in PHP for security.
 */

function nordicbloom_enqueue_scripts() {

    if (is_page('contact') || is_front_page()) {

        wp_enqueue_script(
            'parsley',
            'https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js',
            array('jquery'),
            '2.9.2',
            true
        );

        if (is_front_page()) {
            wp_add_inline_script(
                'parsley',
                "jQuery(function ($) {
                    const newsletterForm = $('#newsletter-form');

                    if (newsletterForm.length && $.fn.parsley) {
                        newsletterForm.parsley();
                    }
                });"
            );
        }
    }
}

add_action('wp_enqueue_scripts', 'nordicbloom_enqueue_scripts');


// --------------------------------------------------------------- Contact Form Handler ---------------------------------------------

function nordicbloom_handle_contact_form() {

    // Security check
    if (
        !isset($_POST['contact_form_nonce']) ||
        !is_string($_POST['contact_form_nonce']) ||
        !wp_verify_nonce(
            sanitize_text_field(wp_unslash($_POST['contact_form_nonce'])),
            'contact_form_action'
        )
    ) {
        wp_die('Security check failed.');
    }

    // Sanitize
    $company_name   = isset($_POST['company_name'])   && is_string($_POST['company_name'])   ? sanitize_text_field(wp_unslash($_POST['company_name']))   : '';
    $contact_person = isset($_POST['contact_person']) && is_string($_POST['contact_person']) ? sanitize_text_field(wp_unslash($_POST['contact_person'])) : '';
    $email          = isset($_POST['email'])          && is_string($_POST['email'])          ? sanitize_email(wp_unslash($_POST['email']))              : '';
    $phone          = isset($_POST['phone'])          && is_string($_POST['phone'])          ? sanitize_text_field(wp_unslash($_POST['phone']))         : '';
    $message        = isset($_POST['message'])        && is_string($_POST['message'])        ? sanitize_textarea_field(wp_unslash($_POST['message']))   : '';

    // Validate
    if (empty($contact_person) || empty($email) || empty($phone)) {
        wp_die('Please fill in all required fields.');
    }

    if (!is_email($email)) {
        wp_die('Invalid email address.');
    }

    $phone_digits = preg_replace('/[\s-]/', '', $phone);
    if (!preg_match('/^(?:\+45)?[0-9]{8}$/', $phone_digits)) {
        wp_die('Please enter a valid Danish phone number.');
    }

    $message_length = preg_match_all('/./us', $message);
    if ($message_length === false || $message_length > 500) {
        wp_die('Your message must not exceed 500 characters.');
    }

    // Save to the Contacts post type
    $post_data = array(
        'post_title'   => $contact_person,
        'post_content' => $message,
        'post_status'  => 'pending',
        'post_type'    => 'contact',
    );

    $post_id = wp_insert_post($post_data, true);

    if (is_wp_error($post_id)) {
        wp_die(
            'Sorry, your message could not be saved. Please try again later.',
            'Error',
            array('response' => 500)
        );
    }

    // Save SCF fields
    update_field('company_name', $company_name, $post_id);
    update_field('email', $email, $post_id);
    update_field('contact_phone', $phone, $post_id);
    update_field('company_name', $company_name, $post_id);

    // Redirect back to the contact page
    wp_safe_redirect(add_query_arg('sent', '1', home_url('/contact/')));
    exit;
}

add_action('admin_post_nopriv_submit_contact_form', 'nordicbloom_handle_contact_form');
add_action('admin_post_submit_contact_form', 'nordicbloom_handle_contact_form');


// -------------------------------- Newsletter Form Handler --------------------------------
function nordicbloom_handle_newsletter() {

    // Verify nonce
    if (
        !isset($_POST['newsletter_nonce']) ||
        !is_string($_POST['newsletter_nonce']) ||
        !wp_verify_nonce(
            sanitize_text_field(wp_unslash($_POST['newsletter_nonce'])),
            'newsletter_action'
        )
    ) {
        wp_die('Security check failed.');
    }

    // Sanitize email
    $email = isset($_POST['newsletter_email']) && is_string($_POST['newsletter_email'])
        ? sanitize_email(wp_unslash($_POST['newsletter_email']))
        : '';

    // Validate email
    if (!is_email($email)) {
        wp_die('Please enter a valid email address.');
    }

    // Check for existing subscriber
    $existing = get_posts(array(
        'post_type'      => 'newsletter',
        'post_status'    => array('pending', 'publish', 'draft'),
        'title'          => $email,
        'posts_per_page' => 1,
        'fields'         => 'ids',
    ));

    if (empty($existing)) {

        // Save subscription request
        $post_id = wp_insert_post(array(
            'post_title'  => $email,
            'post_status' => 'pending',
            'post_type'   => 'newsletter',
        ), true);

        if (is_wp_error($post_id) || !$post_id) {
            wp_die(
                'Sorry, your request could not be saved. Please try again later.',
                'Error',
                array('response' => 500)
            );
        }

        // Save SCF email field
        if (function_exists('update_field')) {
            update_field('email', $email, $post_id);
        }
    }

    // Redirect to homepage with success message
    wp_safe_redirect(home_url('/?newsletter=success#newsletter-form'));
    exit;   
}

add_action('admin_post_nopriv_nordicbloom_newsletter', 'nordicbloom_handle_newsletter');
add_action('admin_post_nordicbloom_newsletter', 'nordicbloom_handle_newsletter');