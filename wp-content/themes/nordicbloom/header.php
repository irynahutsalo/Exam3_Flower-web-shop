<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<!-- Adds Wordpress Classes to the body -->
<body <?php body_class(); ?>>

<!-- This allows WordPress and plugins to add content after the body opens -->
<?php wp_body_open(); ?>

<?php

// ACF
$front_page_id = get_option('page_on_front');
$logo = get_field('header_logo', $front_page_id);

// Gets the Logo URL from the ACF image array
$logo_url = is_array($logo) ? ($logo['url'] ?? '') : $logo;


// Stores the Navigation Links so they can be reused for both Desktop and Mobile Navigation
$navigation_items = [];

if (have_rows('header_navigation', $front_page_id)) {

    while (have_rows('header_navigation', $front_page_id)) {
        the_row();

        $page = get_sub_field('page_item');

        // Skips the row if no page has been selected
        if (!$page) {
            continue;
        }

        // Gets the selected page ID
        $page_id = $page->ID;

        // Gets the page title
        $page_title = get_the_title($page_id);

        // Gets the page URL
        $page_url = get_permalink($page_id);

        // Adds the page information to the navigation array
        $navigation_items[] = [
            'url'   => $page_url,
            'title' => $page_title
        ];
    }
}

?>

<!-- Navigation -->
<header class="site-header">

  <!-- Navigation Container-->
  <div class="header-container">

    <!-- Logo -->
    <div class="site-logo">

      <!-- Links to the Home Page -->
      <a href="<?php echo esc_url(home_url('/')); ?>">

        <!-- Checks for the image -->
        <?php if ($logo_url) : ?>
          <img src="<?php echo esc_url($logo_url); ?>" alt="Nordic Bloom">
          <?php else : ?>
          <span>NORDIC BLOOM</span>
        <?php endif; ?>

      </a>

    </div>


    <!-- Desktop Navigation -->
    <?php if (!empty($navigation_items)) : ?>

      <!-- Main Navigation -->
      <nav class="main-navigation" aria-label="Primary navigation">
        <ul>
          <!-- Loops through each Navigation Item -->
          <?php foreach ($navigation_items as $item) : ?>

            <li>
              <!-- Displays the URL and Page Title -->
              <a href="<?php echo esc_url($item['url']); ?>">
                <?php echo esc_html($item['title']); ?>
              </a>
            </li>

          <?php endforeach; ?>

        </ul>

      </nav>

    <?php endif; ?>


    <!-- Mobile Menu Button - Hamburger Icon -->
    <button class="menu-toggle" type="button" aria-label="Open navigation" aria-expanded="false" aria-controls="mobile-navigation">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-hidden="true"><path d="M0 0h16v16H0z" fill="none" />
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m2.75 12.25h10.5m-10.5-4h10.5m-10.5-4h10.5"/>
        </svg>
    </button>

  </div>

  <!-- Mobile Menu Overlay -->
  <div class="mobile-menu-overlay"></div>

    <!-- Mobile Navigation -->
    <nav id="mobile-navigation" class="mobile-navigation" aria-label="Mobile navigation">

      <!-- Close Button -->
      <button class="mobile-menu-close" type="button" aria-label="Close navigation">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
          <path d="M0 0h24v24H0z" fill="none" />
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m18 18l-6-6m0 0L6 6m6 6l6-6m-6 6l-6 6" />
        </svg>
      </button>

      <?php if (!empty($navigation_items)) : ?>
        <ul>
          <!-- Loops thorugh each Navigation Item -->
          <?php foreach ($navigation_items as $item) : ?>
            <li>
              <a href="<?php echo esc_url($item['url']); ?>">
                  <?php echo esc_html($item['title']); ?>
              </a>
            </li>

          <?php endforeach; ?>
        </ul>

      <?php endif; ?>

    </nav>

</header>


<script>
document.addEventListener('DOMContentLoaded', function () {

    // Gets the Mobile Menu Elements
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenu = document.querySelector('.mobile-navigation');
    const closeButton = document.querySelector('.mobile-menu-close');
    const overlay = document.querySelector('.mobile-menu-overlay');

    // Stops if the Mobile Menu does not exist
    if (!menuToggle || !mobileMenu || !closeButton || !overlay) {
        return;
    }

    // Opens the Mobile Navigation
    function openMenu() {
        mobileMenu.classList.add('is-open');
        overlay.classList.add('is-open');
        menuToggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    // Closes the Mobile Navigation
    function closeMenu() {
        mobileMenu.classList.remove('is-open');
        overlay.classList.remove('is-open');
        menuToggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    // Opens Menu when clicking the hamburger
    menuToggle.addEventListener('click', openMenu);

    // Closes Menu when clicking the close button
    closeButton.addEventListener('click', closeMenu);

    // Close Menu when clicking outside the menu
    overlay.addEventListener('click', closeMenu);

});
</script>