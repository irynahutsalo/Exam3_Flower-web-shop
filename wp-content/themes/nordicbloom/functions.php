<?php

function nordicbloom_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'nordicbloom' ),
    ) );
}
add_action( 'after_setup_theme', 'nordicbloom_theme_setup' );

function nordicbloom_enqueue_front_page_styles() {
    if ( is_front_page() ) {
        wp_enqueue_style(
            'nordicbloom-benefits',
            get_template_directory_uri() . '/benefits.css',
            array(),
            filemtime( get_template_directory() . '/benefits.css' )
        );
    }
}
add_action( 'wp_enqueue_scripts', 'nordicbloom_enqueue_front_page_styles' );

function nordicbloom_enqueue_comment_reply_script() {
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'nordicbloom_enqueue_comment_reply_script' );

function nordicbloom_comment_template( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    
    $user_id = $comment->user_id;
    $avatar_img = '';
    
    if ( $user_id ) {
        $acf_avatar = get_field('user_avatar', 'user_' . $user_id);
        if ( $acf_avatar ) {
            $avatar_url = is_array($acf_avatar) ? $acf_avatar['sizes']['thumbnail'] : $acf_avatar;
            $avatar_img = '<img src="' . esc_url( $avatar_url ) . '" width="60" height="60" alt="" />';
        }
    }
    
    if ( empty( $avatar_img ) ) {
        $avatar_img = get_avatar( $comment, 60 );
    }
    ?>
    <li <?php comment_class('comment-item'); ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment-message-box">
            
            <div class="comment-avatar">
                <?php echo $avatar_img; ?>
            </div>

            <div class="comment-content-wrap">
                <div class="comment-header">
                    <strong class="comment-author-name"><?php comment_author(); ?></strong>
                    <span class="comment-date"><?php comment_date('j F Y, H:i'); ?></span>
                </div>

                <div class="comment-text">
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <em class="comment-awaiting-moderation" style="display:block; margin-bottom:8px; color:#d97706;">
                            Ваш коментар очікує на перевірку модератором.
                        </em>
                    <?php endif; ?>
                    <?php comment_text(); ?>
                </div>

                <div class="comment-reply-btn">
                    <?php 
                    comment_reply_link( array_merge( $args, array(
                        'reply_text' => 'Reply',
                        'depth'      => $depth,
                        'max_depth'  => $args['max_depth']
                    ) ) ); 
                    ?>
                </div>
            </div>

        </div>
    </li>
    <?php
}

function nordicbloom_enqueue_scripts() {
    wp_enqueue_script('jquery');

    wp_enqueue_script(
        'parsley',
        'https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js',
        array('jquery'),
        '2.9.2',
        true
    );
}

add_action('wp_enqueue_scripts', 'nordicbloom_enqueue_scripts');
function nordicbloom_handle_contact_form() {

    if (
        !isset($_POST['contact_form_nonce']) ||
        !wp_verify_nonce(
            $_POST['contact_form_nonce'],
            'contact_form_action'
        )
    ) {
        wp_die('Security check failed.');
    }

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);

    if (
        empty($name) ||
        empty($email) ||
        empty($subject) ||
        empty($message)
    ) {
        wp_die('Please fill in all required fields.');
    }

    if (!is_email($email)) {
        wp_die('Invalid email address.');
    }

    $to = get_option('admin_email');

    $mail_subject = 'Contact form: ' . $subject;

    $mail_message =
        "Name: " . $name . "\n" .
        "Email: " . $email . "\n\n" .
        "Message:\n" . $message;

    $headers = array(
        'Reply-To: ' . $name . ' <' . $email . '>'
    );

    wp_mail(
        $to,
        $mail_subject,
        $mail_message,
        $headers
    );

    wp_safe_redirect(
        add_query_arg(
            'sent',
            '1',
            wp_get_referer()
        )
    );

    exit;
}

add_action(
    'admin_post_nopriv_submit_contact_form',
    'nordicbloom_handle_contact_form'
);

add_action(
    'admin_post_submit_contact_form',
    'nordicbloom_handle_contact_form'
);