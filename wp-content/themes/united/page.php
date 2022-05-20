<?php
/**
 * Template Name: Films
 *
 * This is the template that displays full width page without sidebar
 *
 * @package unite
 */


get_header(); ?>

<div id="primary" class="content-area col-sm-12 col-md-12">
    <main id="main" class="site-main" role="main">
        <?php
        $current = absint(max(1, get_query_var('paged') ? get_query_var('paged') : get_query_var('page')));
        $posts_per_page = 3;
        $query = new WP_Query(
            [
                'post_type' => 'films',
                'posts_per_page' => $posts_per_page,
                'paged' => $current,
            ]
        );
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                get_template_part('content', 'page');
                echo get_the_term_list('', 'genre', 'Жанры: ', ',', '<br>');
                echo get_the_term_list('', 'countries', 'Страны: ', ',', '<br>');
                ?><a href="<?= get_permalink() ?>"><button type="button" class="btn btn-primary">Подробнее</button></a><br><?php

            }
            wp_reset_postdata();

            echo wp_kses_post(
                paginate_links(
                    [
                        'total' => $query->max_num_pages,
                        'current' => $current,
                    ]
                )
            );
        } else {
            global $wp_query;
            $wp_query->set_404();
            status_header(404);
            nocache_headers();
            require get_404_template();
        }
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
