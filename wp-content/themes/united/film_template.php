<?php
/**
 * Template Name: Film Template
 * Template Post Type: films
 */

get_header(); ?>

<div id="primary" class="content-area col-sm-12 col-md-12">
    <main id="main" class="site-main" role="main">
        <?php
        get_template_part('content', 'page');
        echo "Дата выхода: " . get_post_meta($post->ID, 'date', true) . "<br>";
        echo "Стоимость сеанса: " . get_post_meta($post->ID, 'price', true) . " USDT<br>";

        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
