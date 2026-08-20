<?php
get_header();

$heroBg       = get_field("hero_bg_image"); 
$heroTitle    = get_field("hero_title");
$heroSubtitle = get_field("hero_subtitle");
$cardPhoto    = get_field("hero_card_image");
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

<?php get_footer(); ?>