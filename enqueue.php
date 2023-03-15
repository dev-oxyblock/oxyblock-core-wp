<?php

add_action( 'wp_enqueue_scripts', 'oxyblockCoreWp_enqueue_files' );
function oxyblockCoreWp_enqueue_files() {
	if ( ! class_exists( 'CT_Component' ) ) { // if Oxygen is not active
		wp_enqueue_style( 'ob-core-tokens', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-tokens.css' );
		wp_enqueue_style( 'ob-core-framework', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-framework.css' );
		wp_enqueue_style( 'ob-core-layout', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-layout.css' );
		wp_enqueue_style( 'ob-core-spacing', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-spacing.css' );
		wp_enqueue_style( 'ob-core-sizing', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-sizing.css' );
		wp_enqueue_style( 'ob-core-helpers', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-helpers.css' );
		wp_enqueue_style( 'ob-core-components', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-components.css' );
	}
}

// Oxyblock Core Tokens
add_action( 'wp_head', 'oxyblockCoreTokens_enqueue_css_after_oxygens', 0 );
function oxyblockCoreTokens_enqueue_css_after_oxygens() {
	// if Oxygen is not active, abort.
	if ( ! class_exists( 'CT_Component' ) ) {
		return;
	}

	// Verifica si la opción de Tokens CSS está habilitada
	$tokens_css_enabled = get_option( 'oxyblockCoreWp_tokens_css', 'on' );
	if ( $tokens_css_enabled == 'on' ) {
		$styles = new WP_Styles;
		$styles->add( 'ob-core-tokens', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-tokens.css' );
		$styles->enqueue( array( 'ob-core-tokens' ) );
		$styles->do_items();
	}
}

// Oxyblock Core Utility
add_action( 'wp_head', 'oxyblockCoreUtility_enqueue_css_after_oxygens', 1000000 );
function oxyblockCoreUtility_enqueue_css_after_oxygens() {
	// if Oxygen is not active, abort.
	if ( ! class_exists( 'CT_Component' ) ) {
		return;
	}

	// Verifica si la opción de Utility CSS está habilitada
	$utility_css_enabled = get_option( 'oxyblockCoreWp_utility_css', 'on' );
	if ( $utility_css_enabled == 'on' ) {
		$styles = new WP_Styles;
		$styles->add( 'ob-core-framework', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-framework.css' );
		$styles->add( 'ob-core-layout', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-layout.css' );
		$styles->add( 'ob-core-spacing', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-spacing.css' );
		$styles->add( 'ob-core-sizing', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-sizing.css' );
		$styles->add( 'ob-core-helpers', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-helpers.css' );
		$styles->enqueue( array ('ob-core-framework', 'ob-core-layout', 'ob-core-spacing', 'ob-core-sizing', 'ob-core-helpers' ) );
		$styles->do_items();
	}
}

// Oxyblock Core Components
add_action( 'wp_head', 'oxyblockCoreComponents_enqueue_css_after_oxygens', 1000000 );
function oxyblockCoreComponents_enqueue_css_after_oxygens() {
	// if Oxygen is not active, abort.
	if ( ! class_exists( 'CT_Component' ) ) {
		return;
	}

	// Verifica si la opción de Components CSS está habilitada
	$components_css_enabled = get_option( 'oxyblockCoreWp_components_css', 'on' );
	if ( $components_css_enabled == 'on' ) {
		$styles = new WP_Styles;
		$styles->add( 'ob-core-components', plugin_dir_url( __FILE__ ) . 'assets/css/ob-core-components.css' );
		$styles->enqueue( array ( 'ob-core-components' ) );
		$styles->do_items();
	}
}