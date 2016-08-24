<?php

use Qaribou\Collection\ImmArray;

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}

Timber::$dirname = array('templates', 'components', 'modules');

require('php/_php.php');

class GardenHui extends TimberSite {

	function __construct() {

		$controller = new GardenHui_Controller();

		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );

		add_action( 'after_setup_theme', array($controller, 'thumbnails') );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_action( 'init', array( $controller, 'register_post_types' ) );
		add_action( 'init', array( $controller, 'register_taxonomies' ) );

		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );

		add_filter( 'login_redirect', array( $this, 'gardenhui_auth_signon'), 10, 3);

		add_filter( 'show_admin_bar', '__return_false' );

		add_filter('acf/fields/google_map/api', [$this, 'google_map']);

		if(function_exists('acf_add_options_page')) {
			acf_add_options_page();
		}

		parent::__construct();
	}

	function google_map($api) {
		return array_merge($api, [ 'key' => get_field('gmap_api_key', 'options') ]);
	}

	function add_to_context( $context ) {
		/**
		 *  components {array} an associative array of components and their template
		 *										 files to be used when including elements
		 *
		 *  usage: {% include components.header ... %}
		 */
		$context['components'] = array_reduce(
			// glob of all component directories
			glob(dirname(__FILE__) . '/components/*'),
			function($components, $path) {
				// get component directory name
				$name = explode("/", $path); $name = end($name);
				// merge with initial array
				return array_merge($components, array($name => "{$name}/{$name}.twig"));
			},
			// start with empty array
			array()
		);

		$context['menu'] = new TimberMenu();
		$current_user = wp_get_current_user();
		$context['current_user'] = $current_user;
		$context['is_logged_in'] = $current_user->exists();

		$context['site'] = $this;
		return $context;
	}


	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */

		$twig->addTokenParser(new Render_TokenParser() );

		$twig->addFilter(
			new Twig_SimpleFilter('parse_display_name',function($display_name) {
				return preg_replace('/\./', ' ', $display_name);
			})
		);

		$twig->addFunction(
			new Twig_SimpleFunction('edit_profile', function($user_id) {
				$form = new acf_form_user();
				$form->render($user_id, 'edit');
			})
		);

		$twig->addFunction(
			new Twig_SimpleFunction('register_form', function() {
				$test = new acf_form_user();
				$test->user_new_form();
			})
		);
		return $twig;
}

	function gardenhui_auth_signon( $redirect_to, $request, $user) {
		if(!is_wp_error($user)) {
			if(!in_array('administrator', $user->roles)) {
				return '/profile';
			}
		}
		return $redirect_to;
	}
}

new GardenHui();
