<?php

class WPML_Lang_Domain_Filters {

	private $wpml_url_converter;
	private $wpml_wp_api;
	private $debug_backtrace;
	private $domains = array();

	/**
	 * WPML_Lang_Domain_Filters constructor.
	 *
	 * @param $wpml_url_converter
	 * @param $wpml_wp_api
	 */
	public function __construct(
		WPML_URL_Converter $wpml_url_converter,
		WPML_WP_API $wpml_wp_api,
		WPML_Debug_BackTrace $debug_backtrace
	) {

		$this->wpml_url_converter = $wpml_url_converter;
		$this->wpml_wp_api        = $wpml_wp_api;
		$this->debug_backtrace    = $debug_backtrace;
	}

	public function add_hooks() {
		add_filter( 'upload_dir', array( $this, 'upload_dir_filter_callback' ) );
		add_filter( 'stylesheet_uri', array( $this, 'convert_url' ) );
		add_filter( 'option_siteurl', array( $this, 'siteurl_callback' ) );
		add_filter( 'content_url', array( $this, 'siteurl_callback' ) );
		add_filter( 'plugins_url', array( $this, 'siteurl_callback' ) );
		add_filter( 'login_url', array( $this, 'convert_url' ) );
		add_filter( 'logout_url', array( $this, 'convert_logout_url' ) );
		add_filter( 'admin_url', array( $this, 'admin_url_filter' ), 10, 2 );
		add_filter( 'login_redirect', array( $this, 'convert_url' ), 1, 3 );
	}

	/**
	 * @param string $url
	 *
	 * @return string
	 */
	public function convert_url( $url ) {
		return $this->wpml_url_converter->convert_url( $url );
	}

	/**
	 * @param array $upload_dir
	 *
	 * @return array
	 */
	public function upload_dir_filter_callback( $upload_dir ) {
		$convertWithMatchingTrailingSlash = function ( $url ) {
			$hasTrailingSlash = '/' === substr( $url , -1 );
			$newUrl           = $this->wpml_url_converter->convert_url( $url );

			return $hasTrailingSlash ? trailingslashit( $newUrl ) : untrailingslashit( $newUrl );
		};

		$upload_dir['url']     = $convertWithMatchingTrailingSlash( $upload_dir['url'] );
		$upload_dir['baseurl'] = $convertWithMatchingTrailingSlash( $upload_dir['baseurl'] );

		return $upload_dir;
	}

	/**
	 * @param string $url
	 *
	 * @return string
	 */
	public function siteurl_callback( $url ) {
		$getting_network_site_url = $this->debug_backtrace->is_function_in_call_stack( 'get_admin_url' ) && is_multisite();

		if ( ! $this->debug_backtrace->is_function_in_call_stack( 'get_home_path', false ) && ! $getting_network_site_url ) {
			$parsed_url = wpml_parse_url( $url );
			$host       = is_array( $parsed_url ) && isset( $parsed_url['host'] );
			if ( $host && isset( $_SERVER['HTTP_HOST'] ) && $_SERVER['HTTP_HOST'] ) {
				$domain_from_global = $this->get_host_from_HTTP_HOST();
				if ( $domain_from_global ) {
					$url = str_replace( $parsed_url['host'], $domain_from_global, $url );
				}
			}
		}

		return $url;
	}

	/**
	 * @return string
	 */
	private function get_host_from_HTTP_HOST() {
		$host = $_SERVER['HTTP_HOST'];

		if ( false !==  strpos( $_SERVER['HTTP_HOST'], ':' ) ) {
			$host = explode( ':', $_SERVER['HTTP_HOST'] );
			$host = $host[0];
		}

		return $this->is_host_valid( $host ) ? $host : null;
	}

	/**
	 * @param string $host
	 *
	 * @return bool
	 */
	private function is_host_valid( $host ) {
		$valid = false;

		foreach ( $this->get_domains() as $domain ) {
			if ( $domain === $host ) {
				$valid = true;
				break;
			}
		}

		return $valid;
	}

	/**
	 * @return array
	 */
	private function get_domains() {
		if ( ! $this->domains ) {
			$this->domains   = wpml_get_setting( 'language_domains' );
			$home_parsed     = wp_parse_url( $this->wpml_url_converter->get_abs_home() );
			$this->domains[] = $home_parsed['host'];
		}

		return $this->domains;
	}

	/**
	 * @param string $url
	 * @param string $path
	 *
	 * @return string
	 */
	public function admin_url_filter( $url, $path ) {
		if ( ( strpos( $url, 'http://' ) === 0
		       || strpos( $url, 'https://' ) === 0 )
		     && 'admin-ajax.php' === $path && $this->wpml_wp_api->is_front_end()
		) {
			global $sitepress;

			$url = $this->wpml_url_converter->convert_url( $url, $sitepress->get_current_language() );
		}

		return $url;
	}

	/**
	 * Convert logout url only for front-end.
	 *
	 * @param $logout_url
	 *
	 * @return string
	 */
	public function convert_logout_url( $logout_url ) {
		if ( $this->wpml_wp_api->is_front_end() ) {
			$logout_url = $this->wpml_url_converter->convert_url( $logout_url );
		}

		return $logout_url;
	}
}
