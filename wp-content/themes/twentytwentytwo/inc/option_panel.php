<?php

/* 1. Panel de Opciones */

function custom_theme_options_page() {
    add_menu_page(
        'Opciones del tema',
        'Opciones del tema',
        'edit_others_posts',  // Cambiado para permitir acceso a editores y superiores
        'custom-theme-options',
        'custom_theme_options_callback',
        'dashicons-admin-generic',
        60
    );
}
add_action('admin_menu', 'custom_theme_options_page');



/* 2. Formulario para las Opciones */
function custom_theme_options_callback() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php
            settings_fields('custom_theme_options_group');
            do_settings_sections('custom-theme-options');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

/* 3. Registrar las Opciones */
function custom_theme_settings_init() {
    // Registrar las opciones
    register_setting('custom_theme_options_group', 'custom_theme_logo');
    register_setting('custom_theme_options_group', 'custom_theme_meta_keywords');
    register_setting('custom_theme_options_group', 'custom_theme_contact_email');
    register_setting('custom_theme_options_group', 'custom_theme_address');
    register_setting('custom_theme_options_group', 'custom_theme_google_maps');
    register_setting('custom_theme_options_group', 'custom_theme_phone');
    register_setting('custom_theme_options_group', 'custom_theme_whatsapp');
    register_setting('custom_theme_options_group', 'custom_theme_instagram');
    register_setting('custom_theme_options_group', 'custom_theme_facebook');
    register_setting('custom_theme_options_group', 'custom_theme_x');
    register_setting('custom_theme_options_group', 'custom_theme_google_analytics');
    register_setting('custom_theme_options_group', 'custom_theme_facebook_pixel');
    register_setting('custom_theme_options_group', 'custom_theme_custom_tracking');

    // Añadir sección
    add_settings_section(
        'custom_theme_options_section',
        'Configuraciones del tema',
        '',
        'custom-theme-options'
    );

    // Añadir campos
    add_settings_field('custom_theme_logo', __("Logotipo", ""), 'custom_theme_logo_callback', 'custom-theme-options', 'custom_theme_options_section');
    add_settings_field('custom_theme_meta_keywords', 'Meta Keywords', 'custom_theme_meta_keywords_callback', 'custom-theme-options', 'custom_theme_options_section');
    add_settings_field('custom_theme_contact_email', __("Email de Contacto", ""), 'custom_theme_contact_email_callback', 'custom-theme-options', 'custom_theme_options_section');
    add_settings_field('custom_theme_address', __("Dirección", ""), 'custom_theme_address_callback', 'custom-theme-options', 'custom_theme_options_section');
    add_settings_field('custom_theme_google_maps', 'Ubicación (Google Maps)', 'custom_theme_google_maps_callback', 'custom-theme-options', 'custom_theme_options_section');
    add_settings_field('custom_theme_phone', 'Teléfono Fijo', 'custom_theme_phone_callback', 'custom-theme-options', 'custom_theme_options_section');
    add_settings_field('custom_theme_whatsapp', 'WhatsApp', 'custom_theme_whatsapp_callback', 'custom-theme-options', 'custom_theme_options_section');

    // Redes sociales desglosadas
    add_settings_field('custom_theme_instagram', 'Instagram', 'custom_theme_instagram_callback', 'custom-theme-options', 'custom_theme_options_section');
    add_settings_field('custom_theme_facebook', 'Facebook', 'custom_theme_facebook_callback', 'custom-theme-options', 'custom_theme_options_section');
    add_settings_field('custom_theme_x', 'X (Twitter)', 'custom_theme_x_callback', 'custom-theme-options', 'custom_theme_options_section');

    // Tracking Codes
    add_settings_field('custom_theme_google_analytics', __("Código de Google Analytics", ""), 'custom_theme_google_analytics_callback', 'custom-theme-options', 'custom_theme_options_section');
    add_settings_field('custom_theme_facebook_pixel', __("Código de Facebook Pixel", ""), 'custom_theme_facebook_pixel_callback', 'custom-theme-options', 'custom_theme_options_section');
    add_settings_field('custom_theme_custom_tracking', __("Código de Tracking Personalizado", ""), 'custom_theme_custom_tracking_callback', 'custom-theme-options', 'custom_theme_options_section');
}
add_action('admin_init', 'custom_theme_settings_init');


/* 4. Callbacks para los Campos */
// Subir logotipo
function custom_theme_logo_callback() {
    $logo = get_option('custom_theme_logo');
    ?>
    <input type="text" name="custom_theme_logo" id="custom_theme_logo" value="<?php echo esc_url($logo); ?>" />
    <input type="button" class="button-primary" value="<?php _e('Subir logotipo', '');?>" id="upload_logo_button" />
    <input type="button" class="button button-secondary" value="<?php _e('Borrar logotipo', '');?>" id="remove_logo_button" />
    <br /><br /><img src="<?php echo esc_url($logo); ?>" id="logo_preview" style="max-width: 150px; box-shadow: 0px 0px 5px 1px black; display: <?php echo esc_url($logo) ? 'block' : 'none'; ?>;">
    <?php
}

// Meta Keywords
function custom_theme_meta_keywords_callback() {
    $keywords = get_option('custom_theme_meta_keywords');
    ?>
    <input type="text" name="custom_theme_meta_keywords" value="<?php echo esc_attr($keywords); ?>" placeholder="<?php _e('Separadas por comas', '');?>" />
    <?php
}

// Email de contacto
function custom_theme_contact_email_callback() {
    $email = get_option('custom_theme_contact_email');
    ?>
    <input type="email" name="custom_theme_contact_email" value="<?php echo esc_attr($email); ?>" placeholder="ejemplo@yo.com" />
    <?php
}

// Dirección
function custom_theme_address_callback() {
    $address = get_option('custom_theme_address');
    ?>
    <textarea name="custom_theme_address" rows="4" placeholder="<?php _e('Calle, número, torre, piso, departamento, pueblo, ciudad, provincia, código postal', '');?>"><?php echo esc_attr($address); ?></textarea>
    <?php
}

// Google Maps (textarea)
function custom_theme_google_maps_callback() {
    $map = get_option('custom_theme_google_maps');
    ?>
    <textarea name="custom_theme_google_maps" rows="4" placeholder="<?php _e('Código embebido de Google Maps', '');?>"><?php echo esc_textarea($map); ?></textarea>
    <?php
}

// Teléfono fijo (input type="tel")
function custom_theme_phone_callback() {
    $phone = get_option('custom_theme_phone');
    ?>
    <input type="tel" name="custom_theme_phone" value="<?php echo esc_attr($phone); ?>" placeholder="0351-4882213" />
    <?php
}

// WhatsApp (input type="tel")
function custom_theme_whatsapp_callback() {
    $whatsapp = get_option('custom_theme_whatsapp');
    ?>
    <input type="tel" name="custom_theme_whatsapp" value="<?php echo esc_attr($whatsapp); ?>" placeholder="5493514882213" />
    <?php
}

// Instagram
function custom_theme_instagram_callback() {
    $instagram = get_option('custom_theme_instagram');
    ?>
    <input type="text" name="custom_theme_instagram" value="<?php echo esc_attr($instagram); ?>" placeholder="@usuario" />
    <?php
}

// Facebook
function custom_theme_facebook_callback() {
    $facebook = get_option('custom_theme_facebook');
    ?>
    <input type="url" name="custom_theme_facebook" value="<?php echo esc_url($facebook); ?>" placeholder="https://facebook.com/tu_usuario" />
    <?php
}

// X (anteriormente Twitter)
function custom_theme_x_callback() {
    $x = get_option('custom_theme_x');
    ?>
    <input type="text" name="custom_theme_x" value="<?php echo esc_attr($x); ?>" placeholder="@usuario" />
    <?php
}

// Google Analytics
function custom_theme_google_analytics_callback() {
    $analytics_code = get_option('custom_theme_google_analytics');
    ?>
    <textarea name="custom_theme_google_analytics" rows="4"><?php echo esc_textarea($analytics_code); ?></textarea>
    <?php
}

// Facebook Pixel
function custom_theme_facebook_pixel_callback() {
    $pixel_code = get_option('custom_theme_facebook_pixel');
    ?>
    <textarea name="custom_theme_facebook_pixel" rows="4"><?php echo esc_textarea($pixel_code); ?></textarea>
    <?php
}

// Tracking personalizado
function custom_theme_custom_tracking_callback() {
    $custom_tracking_code = get_option('custom_theme_custom_tracking');
    ?>
    <textarea name="custom_theme_custom_tracking" rows="4"><?php echo esc_textarea($custom_tracking_code); ?></textarea>
    <?php
}


/* 5. Cargar la Librería de Subida de Archivos de WordPress */
function custom_theme_enqueue_scripts($hook) {
    if($hook != 'toplevel_page_custom-theme-options') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script('custom-admin-js', get_template_directory_uri() . '/js/custom-admin.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'custom_theme_enqueue_scripts');


/* 6. Agregar códigos al footer si están configurados */
function custom_theme_add_tracking_scripts() {
    // Obtener los valores de las opciones
    $google_analytics = get_option('custom_theme_google_analytics');
    $facebook_pixel = get_option('custom_theme_facebook_pixel');
    $custom_tracking = get_option('custom_theme_custom_tracking');

    // Inocular Google Analytics si tiene datos
    if (!empty($google_analytics)) {
        echo "<!-- Google Analytics -->\n";
        echo "<script type='text/javascript'>\n";
        echo $google_analytics;
        echo "\n</script>\n";
    }

    // Inocular Facebook Pixel si tiene datos
    if (!empty($facebook_pixel)) {
        echo "<!-- Facebook Pixel -->\n";
        echo "<script type='text/javascript'>\n";
        echo $facebook_pixel;
        echo "\n</script>\n";
    }

    // Inocular código de tracking personalizado si tiene datos
    if (!empty($custom_tracking)) {
        echo "<!-- Código de Tracking Personalizado -->\n";
        echo "<script type='text/javascript'>\n";
        echo $custom_tracking;
        echo "\n</script>\n";
    }
}
add_action('wp_footer', 'custom_theme_add_tracking_scripts');
