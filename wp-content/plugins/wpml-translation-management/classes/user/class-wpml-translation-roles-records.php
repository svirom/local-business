<?php

abstract class WPML_Translation_Roles_Records {

	const USERS_WITH_CAPABILITY    = 'LIKE';
	const USERS_WITHOUT_CAPABILITY = 'NOT LIKE';
	const MIN_SEARCH_LENGTH        = 3;

	/** @var wpdb */
	protected $wpdb;

	/** @var WPML_WP_User_Query_Factory */
	private $user_query_factory;

	/** @var \WP_Roles */
	protected $wp_roles;

	/**
	 * WPML_Translation_Roles_Records constructor.
	 *
	 * @param \wpdb                       $wpdb
	 * @param \WPML_WP_User_Query_Factory $user_query_factory
	 * @param \WP_Roles                   $wp_roles
	 */
	public function __construct( wpdb $wpdb, WPML_WP_User_Query_Factory $user_query_factory, WP_Roles $wp_roles ) {
		$this->wpdb               = $wpdb;
		$this->user_query_factory = $user_query_factory;
		$this->wp_roles           = $wp_roles;
	}

	public function has_users_with_capability() {
		$sql = "
				SELECT EXISTS( 
				   SELECT user_id
				   FROM {$this->wpdb->usermeta}
				   WHERE meta_key = '{$this->wpdb->prefix}capabilities' AND meta_value LIKE %s
				)
			";

		$sql = $this->wpdb->prepare( $sql, '%' . $this->get_capability() . '%' );

		return (bool) $this->wpdb->get_var( $sql );
	}

	/**
	 * @return array
	 */
	public function get_users_with_capability() {
		return $this->get_records( self::USERS_WITH_CAPABILITY );
	}

	/**
	 * @return int
	 */
	public function get_number_of_users_with_capability() {
		return count( $this->get_users_with_capability() );
	}

	/**
	 * @param string $search
	 * @param int    $limit
	 *
	 * @return array
	 */
	public function search_for_users_without_capability( $search = '', $limit = -1 ) {
		return $this->get_records( self::USERS_WITHOUT_CAPABILITY, $search, $limit );
	}

	/**
	 * @param int $user_id
	 *
	 * @return bool
	 */
	public function does_user_have_capability( $user_id ) {
		$users = $this->get_users_with_capability();
		foreach ( $users as $user ) {
			if ( (int) $user->ID === (int) $user_id ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Delete records for all users
	 */
	public function delete_all() {
		$users = $this->get_users_with_capability();
		foreach ( $users as $user ) {
			$this->delete( $user->ID );
		}
	}

	/**
	 * Delete the record for the user
	 *
	 * @param int $user_id
	 */
	public function delete( $user_id ) {
		$user = new WP_User( $user_id );
		$user->remove_cap( $this->get_capability() );
	}

	/**
	 * @param string $compare
	 * @param string $search
	 * @param int    $limit
	 *
	 * @return array
	 */
	private function get_records( $compare, $search = '', $limit = -1 ) {
		$search = trim( $search );

		$query_args = array(
			'fields'     => 'ID',
			'meta_query' => array(
				array(
					'key'     => "{$this->wpdb->prefix}capabilities",
					'value'   => $this->get_capability(),
					'compare' => $compare,
				),
			),
			'number'     => $limit,
		);

		if ( 'NOT LIKE' === $compare ) {
			$required_wp_roles = $this->get_required_wp_roles();
			if ( $required_wp_roles ) {
				$query_args['role__in'] = $required_wp_roles;
			}
		}

		if ( $search ) {
			$query_args['search']         = '*' . $search . '*';
			$query_args['search_columns'] = array( 'user_login', 'user_nicename', 'user_email' );
		}

		$user_query = $this->user_query_factory->create( $query_args );
		$users      = $user_query->get_results();

		if ( $search && strlen( $search ) > self::MIN_SEARCH_LENGTH && ( $limit <= 0 || count( $users ) < $limit ) ) {
			$users_from_metas = $this->get_records_from_users_metas( $compare, $search, $limit );
			$users_with_dupes = array_merge( $users, $users_from_metas );
			$users            = wpml_array_unique( $users_with_dupes, SORT_REGULAR );
		}

		$results = array();
		foreach ( $users as $user_id ) {
			$user_data = get_userdata( $user_id );
			if ( $user_data ) {
				$language_pair_records = new WPML_Language_Pair_Records( $this->wpdb, new WPML_Language_Records( $this->wpdb ) );
				$language_pairs        = $language_pair_records->get( $user_id );

				$result    = (object) array(
					'ID'             => $user_data->ID,
					'full_name'      => trim( $user_data->first_name . ' ' . $user_data->last_name ),
					'user_login'     => $user_data->user_login,
					'user_email'     => $user_data->user_email,
					'display_name'   => $user_data->display_name,
					'language_pairs' => $language_pairs,
				);
				$results[] = $result;
			}
		}

		return $results;
	}

	/**
	 * @param string $compare
	 * @param string $search
	 * @param int    $limit
	 *
	 * @return array
	 */
	private function get_records_from_users_metas( $compare, $search, $limit = -1 ) {
		$search = trim( $search );
		if ( ! $search ) {
			return array();
		}

		$sanitized_search = preg_replace( '!\s+!', ' ', $search );
		$words            = explode( ' ', $sanitized_search );

		if ( ! $words ) {
			return array();
		}

		$search_by_names = array( 'relation' => 'OR' );

		foreach ( $words as $word ) {
			$search_by_names[] = array(
				'key'     => 'first_name',
				'value'   => $word,
				'compare' => 'LIKE',
			);
			$search_by_names[] = array(
				'key'     => 'last_name',
				'value'   => $word,
				'compare' => 'LIKE',
			);
			$search_by_names[] = array(
				'key'     => 'last_name',
				'value'   => $word,
				'compare' => 'LIKE',
			);
		}

		$query_args = array(
			'fields'     => 'ID',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key'     => "{$this->wpdb->prefix}capabilities",
					'value'   => $this->get_capability(),
					'compare' => $compare,
				),
				$search_by_names,
			),
			'number'     => $limit,
		);

		if ( 'NOT LIKE' === $compare ) {
			$required_wp_roles = $this->get_required_wp_roles();
			if ( $required_wp_roles ) {
				$query_args['role__in'] = $required_wp_roles;
			}
		}

		$user_query = $this->user_query_factory->create( $query_args );

		return $user_query->get_results();

	}

	/**
	 * @return string
	 */
	abstract protected function get_capability();

	/**
	 * @return array
	 */
	abstract protected function get_required_wp_roles();
}
