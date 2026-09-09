<?php

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


// ------------------------------------------------------------ Comment Reply ---------------------------------------------------
function nordicbloom_enqueue_comment_reply_script()
{

    if (
        is_singular() &&
        comments_open() &&
        get_option('thread_comments')
    ) {
        wp_enqueue_script('comment-reply');
    }
}

add_action(
    'wp_enqueue_scripts',
    'nordicbloom_enqueue_comment_reply_script'
);

// ----------------------------------------------------------- Comment Template --------------------------------------------------
function nordicbloom_comment_template($comment, $args, $depth)
{

    $GLOBALS['comment'] = $comment;

    $user_id = $comment->user_id;
    $avatar_img = '';

    if ($user_id) {

        $acf_avatar = get_field(
            'user_avatar',
            'user_' . $user_id
        );

        if ($acf_avatar) {

            $avatar_url = is_array($acf_avatar)
                ? $acf_avatar['sizes']['thumbnail']
                : $acf_avatar;

            $avatar_img =
                '<img src="' .
                esc_url($avatar_url) .
                '" width="60" height="60" alt="" />';
        }
    }

    if (empty($avatar_img)) {
        $avatar_img = get_avatar($comment, 60);
    }

?>

    <li
        <?php comment_class('comment-item'); ?>
        id="li-comment-<?php comment_ID(); ?>">

        <div
            id="comment-<?php comment_ID(); ?>"
            class="comment-message-box">

            <div class="comment-avatar">
                <?php echo $avatar_img; ?>
            </div>

            <div class="comment-content-wrap">

                <div class="comment-header">

                    <strong class="comment-author-name">
                        <?php comment_author(); ?>
                    </strong>

                    <span class="comment-date">
                        <?php comment_date('j F Y, H:i'); ?>
                    </span>

                </div>


                <div class="comment-text">

                    <?php
                    if ('0' == $comment->comment_approved) :
                    ?>

                        <em
                            class="comment-awaiting-moderation"
                            style="
                                display: block;
                                margin-bottom: 8px;
                                color: #d97706;
                            ">
                            Ваш коментар очікує на перевірку модератором.
                        </em>

                    <?php endif; ?>

                    <?php comment_text(); ?>

                </div>


                <div class="comment-reply-btn">

                    <?php

                    comment_reply_link(
                        array_merge(
                            $args,
                            array(
                                'reply_text' => 'Reply',
                                'depth'      => $depth,
                                'max_depth'  => $args['max_depth']
                            )
                        )
                    );

                    ?>

                </div>

            </div>

        </div>

    </li>

<?php
}


// ------------------------------------------------------------- Parsley Script ----------------------------------------------
function nordicbloom_enqueue_scripts()
{

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

add_action(
    'wp_enqueue_scripts',
    'nordicbloom_enqueue_scripts'
);

// --------------------------------------------------------------- Contact Form Handler ---------------------------------------------
function nordicbloom_handle_contact_form()
{

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
    $name = isset($_POST['name'])
        ? sanitize_text_field($_POST['name'])
        : '';

    $email = isset($_POST['email'])
        ? sanitize_email($_POST['email'])
        : '';

    $subject = isset($_POST['subject'])
        ? sanitize_text_field($_POST['subject'])
        : '';

    $message = isset($_POST['message'])
        ? sanitize_textarea_field($_POST['message'])
        : '';


    // Required Fields
    if (
        empty($name) ||
        empty($email) ||
        empty($subject) ||
        empty($message)
    ) {
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
        'Contact form: ' .
        $subject;


    // Email Body
    $mail_message =
        "Name: " . $name . "\n" .
        "Email: " . $email . "\n\n" .
        "Message:\n" . $message;


    // Email Headers
    $headers = array(
        'Reply-To: ' .
            $name .
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

    // Redirect Back to Home Page
    wp_safe_redirect(
        add_query_arg(
            'sent',
            '1',
            wp_get_referer()
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
