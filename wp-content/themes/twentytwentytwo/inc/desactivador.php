<?php
/* Eliminar version de WordPress */
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_null' );

/* Desactivar emojis */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/* Quitar s.w.org DNS prefetch */
add_filter('wp_resource_hints', function (array $urls, string $relation): array {
    if ($relation !== 'dns-prefetch') {
        return $urls;
    }
    $urls = array_filter($urls, function (string $url): bool {
        return strpos($url, 's.w.org') === false;
    });
    return $urls;
}, 10, 2);

/* Quitar wlwmanifest.xml */
remove_action( 'wp_head', 'wlwmanifest_link' );

/* Quitar RSD */
remove_action('wp_head', 'rsd_link');

/* Quitar shortlink */
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

/* Quitar feeds RSS y links de feeds RSS */
function itsme_disable_feed() {
 wp_die( __( 'Nothing here! Please go back to the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
}
add_action('do_feed', 'itsme_disable_feed', 1);
add_action('do_feed_rdf', 'itsme_disable_feed', 1);
add_action('do_feed_rss', 'itsme_disable_feed', 1);
add_action('do_feed_rss2', 'itsme_disable_feed', 1);
add_action('do_feed_atom', 'itsme_disable_feed', 1);
add_action('do_feed_rss2_comments', 'itsme_disable_feed', 1);
add_action('do_feed_atom_comments', 'itsme_disable_feed', 1);
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );

/* Quitar etiqueta meta duplicada de robots */
remove_filter('wp_robots', 'wp_robots_max_image_preview_large');

// Removes some links from the header
function remove_headlinks() {
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'start_post_rel_link' );
    remove_action( 'wp_head', 'index_rel_link' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
    remove_action( 'wp_head', 'adjacent_posts_rel_link' );
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    remove_action( 'wp_head', 'parent_post_rel_link' );
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
}
add_action( 'init', 'remove_headlinks' );

// Eliminar codigo SVG del HTML
function remove_parent_svg_icons()
    {
        remove_action('wp_footer', 'twentyseventeen_include_svg_icons', 9999);
    }
add_action('after_setup_theme', 'remove_parent_svg_icons');

// Eliminar REST API del head y headers
remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );


function ver_archivos_cargados() {
    global $wp_styles;
    global $wp_scripts;

    echo 'STYLES:';
    echo '<pre>';
    var_dump($wp_styles->queue);
    echo '</pre>';

    echo 'SCRIPTS:';
    echo '<pre>';
    var_dump($wp_scripts->queue);
    echo '</pre>';
}
add_action( 'wp_footer', 'ver_archivos_cargados' );