<?php
add_action('init', 'register_post_types');
add_action('init', 'create_film_taxonomies');


function register_post_types()
{
    register_post_type('films', [
        'label' => null,
        'labels' => [
            'name' => 'фильмы', // основное название для типа записи
            'singular_name' => 'фильм', // название для одной записи этого типа
            'add_new' => 'Добавить фильм', // для добавления новой записи
            'add_new_item' => 'Добавление фильма', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item' => 'Редактирование фильм', // для редактирования типа записи
            'new_item' => 'Новое фильм', // текст новой записи
            'view_item' => 'Смотреть фильм', // для просмотра записи этого типа.
            'search_items' => 'Искать фильм', // для поиска по этим типам записи
            'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon' => '', // для родителей (у древовидных типов)
            'menu_name' => 'Фильмы', // название меню
        ],
        'description' => '',
        'public' => true,
        // 'publicly_queryable'  => null, // зависит от public
        // 'exclude_from_search' => null, // зависит от public
        // 'show_ui'             => null, // зависит от public
        // 'show_in_nav_menus'   => null, // зависит от public
        'show_in_menu' => null, // показывать ли в меню адмнки
        // 'show_in_admin_bar'   => null, // зависит от show_in_menu
        'show_in_rest' => null, // добавить в REST API. C WP 4.7
        'rest_base' => null, // $post_type. C WP 4.7
        'menu_position' => null,
        'menu_icon' => null,
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical' => false,
        'supports' => ['title', 'editor'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies' => [],
        'has_archive' => false,
        'rewrite' => true,
        'query_var' => true,
    ]);
}

function create_film_taxonomies()
{
    register_taxonomy('genre', array('films'), array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x('Жанры', 'taxonomy general name'),
            'singular_name' => _x('Жанр', 'taxonomy singular name'),
            'search_items' => __('Search genre'),
            'all_items' => __('All genre'),
            'parent_item' => __('Parent genre'),
            'parent_item_colon' => __('Parent genre:'),
            'edit_item' => __('Edit genre'),
            'update_item' => __('Update genre'),
            'add_new_item' => __('Add New genre'),
            'new_item_name' => __('New genre Name'),
            'menu_name' => __('Жанры'),
        ),
        'show_ui' => true,
        'query_var' => true,
    ));

    // Добавляем НЕ древовидную таксономию 'writer' (как метки)
    register_taxonomy('countries', 'films', array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x('Страны', 'taxonomy general name'),
            'singular_name' => _x('Страна', 'taxonomy singular name'),
            'search_items' => __('Search countries'),
            'all_items' => __('All countries'),
            'parent_item' => __('Parent countries'),
            'parent_item_colon' => __('Parent countries:'),
            'edit_item' => __('Edit countries'),
            'update_item' => __('Update countries'),
            'add_new_item' => __('Add New countries'),
            'new_item_name' => __('New countries Name'),
            'menu_name' => __('Страны'),
        ),
        'show_ui' => true,
        'query_var' => true,
    ));

    register_taxonomy('year', array('films'), array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x('Год', 'taxonomy general name'),
            'singular_name' => _x('Год', 'taxonomy singular name'),
            'search_items' => __('Search year'),
            'all_items' => __('All year'),
            'parent_item' => __('Parent year'),
            'parent_item_colon' => __('Parent year:'),
            'edit_item' => __('Edit year'),
            'update_item' => __('Update year'),
            'add_new_item' => __('Add New year'),
            'new_item_name' => __('New year Name'),
            'menu_name' => __('Год'),
        ),
        'show_ui' => true,
        'query_var' => true,
    ));
    register_taxonomy('actors', array('films'), array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x('Актеры', 'taxonomy general name'),
            'singular_name' => _x('Актер', 'taxonomy singular name'),
            'search_items' => __('Search actors'),
            'all_items' => __('All actors'),
            'parent_item' => __('Parent actors'),
            'parent_item_colon' => __('Parent actors:'),
            'edit_item' => __('Edit actors'),
            'update_item' => __('Update actors'),
            'add_new_item' => __('Add New actors'),
            'new_item_name' => __('New Genre Name'),
            'menu_name' => __('Актеры'),
        ),
        'show_ui' => true,
        'query_var' => true,
    ));
}

add_action('add_meta_boxes', 'my_extra_fields', 1);

function my_extra_fields()
{
    add_meta_box('extra_fields', 'Дополнительные поля', 'extra_fields_box_func', 'films', 'normal', 'high');
}

function extra_fields_box_func($post)
{
    ?>
    <label>Стоимость сеанса</label>
    <p><input type="text" name="extra[price]" value="<?php echo get_post_meta($post->ID, 'price', 1); ?>"
              style="width:25%"/></p>
    <label>Дата выхода</label>
    <p><input type="date" name="extra[date]" value="<?php echo get_post_meta($post->ID, 'date', 1); ?>"
              style="width:25%"/></p>

    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>"/>
    <?php
}

add_action('save_post', 'my_extra_fields_update', 0);

function my_extra_fields_update($post_id)
{
    if (
        empty($_POST['extra'])
        || !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__)
        || wp_is_post_autosave($post_id)
        || wp_is_post_revision($post_id)
    )
        return false;

    $_POST['extra'] = array_map('sanitize_text_field', $_POST['extra']);
    foreach ($_POST['extra'] as $key => $value) {
        if (empty($value)) {
            delete_post_meta($post_id, $key);
            continue;
        }
        update_post_meta($post_id, $key, $value);
    }

    return $post_id;
}

add_shortcode('filmlist', 'filmlist');

function filmlist()
{
    $posts_per_page = 5;
    $query = new WP_Query(
        [
            'post_type' => 'films',
            'posts_per_page' => $posts_per_page
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
    }
}