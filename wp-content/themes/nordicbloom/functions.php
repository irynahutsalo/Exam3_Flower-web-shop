<?php

// ----------------------------------------------
// Custom SEO Title Filter
// ----------------------------------------------
add_filter('pre_get_document_title', function($title) {
    if (is_page()) {
        $seo_title = get_field('seo_title', get_queried_object_id());
        if ($seo_title) {
            return $seo_title;
        }
    }
    return $title;
});


// --------------------------------------------------------- Theme Setup --------------------------------------------------
function nordicbloom_theme_setup()
{

    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'nordicbloom'),
    ));
}

add_action('after_setup_theme', 'nordicbloom_theme_setup');


// ------------------------------------------------ CSS Stylesheets ----------------------------------------------
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
    if (is_page('contact')) {
        wp_enqueue_style(
            'nordicbloom-contact',
            get_template_directory_uri() . '/assets/css/pages/page-contact.css',
            ['nordicbloom-base'],
            '1.0'
        );
    }

        // Flower Club Page
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
    if (is_home()) {
        wp_enqueue_style(
            'nordicbloom-blog',
            get_template_directory_uri() . '/assets/css/pages/blog.css',
            ['nordicbloom-base']
        );
    }

    // Single Blog Post
    if (is_single()) {
        wp_enqueue_style(
            'nordicbloom-single',
            get_template_directory_uri() . '/assets/css/pages/single.css',
            ['nordicbloom-base']
        );
    }

    // Front Page
    if (is_front_page()) {
        wp_enqueue_style(
            'nordicbloom-home',
            get_template_directory_uri() . '/assets/css/pages/home.css',
            ['nordicbloom-base']
        );
    }
}

add_action('wp_enqueue_scripts', 'nordicbloom_enqueue_styles');



// ------------------------------------------------------------- Parsley Script ----------------------------------------------// ------------------------------------------------------------- Parsley Script ----------------------------------------------
function nordicbloom_enqueue_scripts(){

    if (is_page('contact')) {

        // jQuery
        wp_enqueue_script('jquery');

        // Parsley validation
        wp_enqueue_script(
            'parsley',
            'https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js',
            array('jquery'),
            '2.9.2',
            true
        );
    }
}

add_action(
    'wp_enqueue_scripts',
    'nordicbloom_enqueue_scripts'
);

// --------------------------------------------------------------- Contact Form Handler ---------------------------------------------
function nordicbloom_handle_contact_form(){

    // Security Check
    if (
        !isset($_POST['contact_form_nonce']) ||
        !wp_verify_nonce(
            $_POST['contact_form_nonce'],
            'contact_form_action'
        )
    ) {
        wp_die('Security check failed.');
    }

    // Sanitize Data
    $company_name = isset($_POST['company_name'])
        ? sanitize_text_field($_POST['company_name'])
        : '';

    $contact_person = isset($_POST['contact_person'])
        ? sanitize_text_field($_POST['contact_person'])
        : '';

    $email = isset($_POST['email'])
        ? sanitize_email($_POST['email'])
        : '';

    $phone = isset($_POST['phone'])
        ? sanitize_text_field($_POST['phone'])
        : '';

    $message = isset($_POST['message'])
        ? sanitize_textarea_field($_POST['message'])
        : '';

    // Required Fields
    if (
    empty($contact_person) ||
    empty($email) ||
    empty($phone)
    ){
    wp_die('Please fill in all required fields.');

    }

    // Valid Email
    if (!is_email($email)) {
        wp_die('Invalid email address.');
    }

    // Email Receiver
    $to = get_option('admin_email');

    // Email Subject
    $mail_subject =
        'Quote request from ' .
        $company_name;

    // Email Body
    $mail_message =
        "Company Name: " . $company_name . "\n" .
        "Contact Person: " . $contact_person . "\n" .
        "Email: " . $email . "\n" .
        "Phone: " . ($phone ? $phone : 'Not provided') . "\n\n" .
        "Message:\n" . ($message ? $message : 'No message provided');

    // Email Headers
    $headers = array(

        'Reply-To: ' .
            $contact_person .
            ' <' .
            $email .
            '>'
    );

    // Send Email
    wp_mail(
        $to,
        $mail_subject,
        $mail_message,
        $headers
    );

    // Redirect Back to Contact Page
    $redirect_url = wp_get_referer();

    if (!$redirect_url) {
        $redirect_url = home_url('/contact/');
    }

    wp_safe_redirect(

        add_query_arg(
            'sent',
            '1',
            $redirect_url
        )
    );

    exit;

}



//  --------------------------------------------------------- Contact Form Actions ----------------------------------------------

/* Not logged in */
add_action(
    'admin_post_nopriv_submit_contact_form',
    'nordicbloom_handle_contact_form'
);



/* Logged in */
add_action(
    'admin_post_submit_contact_form',
    'nordicbloom_handle_contact_form'
);