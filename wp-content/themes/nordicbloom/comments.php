<section id="comments" class="comments-area">
  <?php if ( have_comments() ) : ?>
    <h2><?= get_comments_number() ?> comments</h2>

    <ol class="comment-list">
      <?php 
      wp_list_comments( array(
          'style'       => 'ol',
          'short_ping'  => true,
          'avatar_size' => 60,
      ) ); 
      ?>
    </ol>

    <?php the_comments_navigation(); ?>
  <?php endif; ?>

  <?php if ( comments_open() ) : ?>
    <?php comment_form(); ?>
  <?php elseif ( have_comments() ) : ?>
    <p>Comments are closed</p>
  <?php endif; ?>
</section>