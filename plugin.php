<?php
/*
Plugin Name:	Oxyblock Core WP
Plugin URI:		https://core.oxyblock.xyz
Description:	Modern CSS Framework based on Oxyblock UI
Version:		0.2.4
Author:			Oxyblock
Author URI:		https://oxyblock.com/
License:		GPL-3.0+
License URI:	http://www.gnu.org/licenses/gpl-3.0.txt

This plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.

This plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with This plugin. If not, see {URI to Plugin License}.
*/

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

include_once('enqueue.php');

function oxyblockCoreWp_load_custom_admin_style() {
    wp_enqueue_style( 'ob-core-admin', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-admin.css' );
}
add_action( 'admin_enqueue_scripts', 'oxyblockCoreWp_load_custom_admin_style' );

// Agrega una página al menú de administración para el plugin
add_action( 'admin_menu', 'oxyblockCoreWp_admin_menu' );
function oxyblockCoreWp_admin_menu() {
    add_options_page( 'Oxyblock Core', 'Oxyblock Core', 'manage_options', 'oxyblockCoreWp', 'oxyblockCoreWp_settings_page' );
}

// Agrega la sección de configuración y los campos correspondientes
add_action( 'admin_init', 'oxyblockCoreWp_admin_init' );
function oxyblockCoreWp_admin_init() {
    add_settings_section( 'oxyblockCoreWp_settings_section', 'CSS Options', '', 'oxyblockCoreWp' );
    add_settings_field( 'oxyblockCoreWp_tokens_css', 'Tokens CSS', 'oxyblockCoreWp_tokens_css_callback', 'oxyblockCoreWp', 'oxyblockCoreWp_settings_section' );
    add_settings_field( 'oxyblockCoreWp_components_css', 'Components CSS', 'oxyblockCoreWp_components_css_callback', 'oxyblockCoreWp', 'oxyblockCoreWp_settings_section' );
    add_settings_field( 'oxyblockCoreWp_utility_css', 'Utility CSS', 'oxyblockCoreWp_utility_css_callback', 'oxyblockCoreWp', 'oxyblockCoreWp_settings_section' );
    register_setting( 'oxyblockCoreWp_settings', 'oxyblockCoreWp_tokens_css' );
    register_setting( 'oxyblockCoreWp_settings', 'oxyblockCoreWp_components_css' );
    register_setting( 'oxyblockCoreWp_settings', 'oxyblockCoreWp_utility_css' );
}

// Renderiza la página de configuración con los campos correspondientes
function oxyblockCoreWp_settings_page() {
    ?>
    <div class="wrap">
        <h1 class="oba-admin-screen-home-title">Oxyblock Core WP</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'oxyblockCoreWp_settings' );
            do_settings_sections( 'oxyblockCoreWp' );
            submit_button ( '', 'oba-admin-screen-home-link' );
            ?>
        </form>
        <div class="oba-admin-screen-home-section">
            <p>Got more questions? Message us in the <a href="https://discord.gg/dJkdbqHZj4" target="_blank">Discord</a> or email us at <a href="mailto:support@oxyblock.xyz" target="_blank">support@oxyblock.xyz</a></p>
        </div>
    </div>
    <?php
}

// Renderiza los campos de checkbox para habilitar/deshabilitar el archivo CSS correspondiente
function oxyblockCoreWp_tokens_css_callback() {
    $tokens_css = get_option( 'oxyblockCoreWp_tokens_css', 'on' );
    ?>
    <label class="oba-theme-switch" for="oxyblockCoreWp_tokens_css">
        <input type="checkbox" id="oxyblockCoreWp_tokens_css" name="oxyblockCoreWp_tokens_css" <?php checked( $tokens_css, 'on' ); ?>>
        <div class="oba-slider oba-round"></div>
    </label>
    
    <?php
}

function oxyblockCoreWp_components_css_callback() {
    $components_css = get_option( 'oxyblockCoreWp_components_css', 'on' );
    ?>
    <label class="oba-theme-switch" for="oxyblockCoreWp_components_css">
        <input type="checkbox" id="oxyblockCoreWp_components_css" name="oxyblockCoreWp_components_css" <?php checked( $components_css, 'on' ); ?>>
        <div class="oba-slider oba-round"></div>
    </label>
    <?php
}

function oxyblockCoreWp_utility_css_callback() {
    $utility_css = get_option( 'oxyblockCoreWp_utility_css', 'on' );
    ?>
    <label class="oba-theme-switch" for="oxyblockCoreWp_utility_css">
        <input type="checkbox" id="oxyblockCoreWp_utility_css" name="oxyblockCoreWp_utility_css" <?php checked( $utility_css, 'on' ); ?>>
        <div class="oba-slider oba-round"></div>
    </label>
    <?php
}