<?php
get_header();

$heroBg       = get_field("hero_bg_image"); 
$heroTitle    = get_field("hero_title");
$heroSubtitle = get_field("hero_subtitle");
$cardPhoto    = get_field("hero_card_image");

$tagline     = get_field('brand_tagline');
$heading     = get_field('brand_heading');
$description = get_field('brand_description');
?>

<div class="hero-section" style="background-image: url(<?= esc_url($heroBg["url"]); ?>);">
    <div class="hero-container">
        <div class="hero-content">
            <h1><?= esc_html($heroTitle); ?></h1>
            <p><?= esc_html($heroSubtitle); ?></p>
        </div>
        <div class="hero-media">
            <div class="hero-card">
                <img src="<?= esc_url($cardPhoto["url"]); ?>" alt="">
            </div>
        </div>
    </div>
</div>

<!-- Brand message -->
<section class="brand-section">
    <div class="brand-container">
        <?php if ($tagline) : ?>
            <span class="brand-tagline"><?php echo esc_html($tagline); ?></span>
        <?php endif; ?>
        
        <div class="brand-card">
            <div class="brand-divider"></div>
            
            <?php if ($heading) : ?>
                <h2 class="brand-heading"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>
            
            <?php if ($description) : ?>
                <p class="brand-text"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
            
            <div class="brand-badge">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C12 2 7 7 7 12C7 14.7614 9.23858 17 12 17C14.7614 17 17 14.7614 17 12C17 7 12 2 12 2Z" fill="var(--color-accent)"/>
                    <path d="M12 17V22" stroke="var(--color-accent)" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>