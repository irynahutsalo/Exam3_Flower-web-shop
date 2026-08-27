<?php get_header(); ?>

<main class="single-post-page">
  <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>
      
      <!-- Шапка статті -->
      <header class="single-post-header">
        <div class="single-container">
          
          <div class="single-post-meta">
            <span class="post-category">
              <?php 
              $cats = get_the_category();
              if ( ! empty( $cats ) ) {
                  echo esc_html( $cats[0]->name );
              }
              ?>
            </span>
            <span class="meta-separator">•</span>
            <span class="post-date"><?= esc_html( get_the_date('M j, Y') ); ?></span>
          </div>

          <h1 class="single-post-title"><?= esc_html( get_the_title() ); ?></h1>

          <div class="post-author">
            By <span><?= esc_html( get_the_author() ); ?></span>
          </div>

        </div>
      </header>

      <!-- Головна картинка (Featured Image) -->
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="single-featured-image single-container">
          <?php the_post_thumbnail('full'); ?>
        </div>
      <?php endif; ?>

      <!-- Основний текст статті -->
      <div class="single-post-content single-container">
        <?php the_content(); ?>
      </div>

      <!-- Навігація на попередню / наступну статтю -->
      <nav class="post-navigation single-container">
        <div class="nav-previous">
          <?php previous_post_link('%link', '&larr; %title'); ?>
        </div>
        <div class="nav-next">
          <?php next_post_link('%link', '%title &rarr;'); ?>
        </div>
      </nav>

      <!-- Секція коментарів -->
      <?php 
      $enable_comments       = get_field('enable_comments');
      $comments_title        = get_field('comments_section_title') ?: 'Join the Discussion';
      $comments_subtitle     = get_field('comments_subtitle') ?: 'Share your thoughts, ask questions, or respond to other readers below.';
      $comments_button_label = get_field('comments_button_label') ?: 'Post Comment';

      if ( $enable_comments !== false ) : 
      ?>
        <section class="single-comments-section single-container">
          
          <div class="comments-header-acf">
            <h3 class="comments-main-title"><?php echo esc_html( $comments_title ); ?></h3>
            <?php if ( $comments_subtitle ) : ?>
              <p class="comments-subtitle-text"><?php echo esc_html( $comments_subtitle ); ?></p>
            <?php endif; ?>
          </div>

          <!-- Список існуючих коментарів -->
          <ul class="comments-chat-list">
              <?php
              $post_comments = get_comments( array(
                  'post_id' => get_the_ID(),
                  'status'  => 'approve'
              ) );

              if ( ! empty( $post_comments ) ) {
                  wp_list_comments( array(
                      'style'      => 'ul',
                      'short_ping' => true,
                      'callback'   => 'nordicbloom_comment_template',
                  ), $post_comments );
              } else {
                  echo '<p style="color: #666; font-style: italic;">No comments yet.</p>';
              }
              ?>
          </ul>

          <!-- Форма відповіді -->
          <?php 
          if ( comments_open() ) {
              $current_user = wp_get_current_user();
              $logged_in_preview = '';
              
              if ( is_user_logged_in() ) {
                  $acf_avatar = get_field('user_avatar', 'user_' . $current_user->ID);
                  
                  if ( $acf_avatar ) {
                      $avatar_img = '<img src="' . esc_url( is_array($acf_avatar) ? $acf_avatar['sizes']['thumbnail'] : $acf_avatar ) . '" class="avatar" width="40" height="40" alt="" />';
                  } else {
                      $avatar_img = get_avatar( $current_user->ID, 40 );
                  }

                  $logged_in_preview = '
                  <div class="comment-user-preview">
                      ' . $avatar_img . '
                      <span class="user-name">' . esc_html( $current_user->display_name ) . '</span>
                  </div>';
              }

              comment_form( array(
                  'title_reply'          => '',
                  'label_submit'         => esc_html( $comments_button_label ),
                  'comment_notes_before' => '',
                  'logged_in_as'         => $logged_in_preview,
              ) );
          }
          ?>

        </section>
      <?php endif; ?>

    </article>

  <?php endwhile; ?>
</main>

<?php get_footer(); ?>