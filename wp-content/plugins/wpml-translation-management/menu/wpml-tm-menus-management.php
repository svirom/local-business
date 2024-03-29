<?php

use WPML\TM\Menu\TranslationBasket\Utility;
use function WPML\Container\make;

class WPML_TM_Menus_Management extends WPML_TM_Menus {

	const SKIP_TM_WIZARD_META_KEY = 'wpml_skip_tm_wizard';

	/** @var IWPML_Template_Service $template_service */
	private $template_service;

	/** @var WPML_Translation_Manager_Records $manager_records */
	private $manager_records;

	/** @var WPML_Translator_Records $translator_records */
	private $translator_records;

	private $active_languages;
	private $translatable_types;
	private $current_language;
	private $filter_post_status;
	private $filter_translation_type;
	private $post_statuses;
	private $selected_languages;
	private $source_language;
	/** @var \WPML_TM_Translation_Priorities */
	private $translation_priorities;
	private $dashboard_title_sort_link;
	private $dashboard_date_sort_link;
	private $documents;
	private $selected_posts = array();
	private $translation_filter;
	private $found_documents;
	/**
	 * @var \Mockery\MockInterface
	 */
	private $admin_sections;

	public function __construct(
		IWPML_Template_Service $template_service,
		WPML_Translation_Manager_Records $manager_records,
		WPML_Translator_Records $translator_records
	) {
		$this->template_service   = $template_service;
		$this->manager_records    = $manager_records;
		$this->translator_records = $translator_records;

		$wpml_wp_api     = new WPML_WP_API();

		$this->admin_sections = WPML\Container\make( 'WPML_TM_Admin_Sections' );
		$this->admin_sections->init_hooks();

		parent::__construct();
	}

	protected function render_main() {
		?>
		<div class="wrap">
			<h1><?php echo esc_html__( 'Translation Management', 'wpml-translation-management' ); ?></h1>

			<?php

			if ( $this->should_show_wizard() ) {
				?>
				<p class="wpml-tm-wizard-message">
					<?php
					$link = '<a href="https://wpml.org/?page_id=3416" target="_blank" rel="noopener">' .
							esc_html__( "WPML's Translation Management", 'wpml-translation-management' ) .
							'</a>';
					echo sprintf(
						esc_html__( 'Before you can use %s, you need to complete this quick setup.', 'wpml-translation-management' ),
						$link
					);

					?>
				</p>
				<?php
				$tm_strings_factory = new WPML_TM_Scripts_Factory();
				$tm_wizard          = new WPML_TM_Setup_Wizard( $tm_strings_factory );
				echo $tm_wizard->render();

			} else {

				do_action( 'icl_tm_messages' );
				$this->build_tab_items();
				$this->render_items();
			}
			?>
		</div>
		<?php
	}

	/**
	 * It builds all the sections.
	 */
	protected function build_tab_items() {
		$this->tab_items = array();

		$this->build_dashboard_item();
		$this->build_basket_item();

		/** @var \WPML_TM_Admin_Sections $admin_sections */
		foreach ( $this->admin_sections->get_tab_items() as $slug => $tab_item ) {

			$this->tab_items[ $slug ] = $tab_item;
		}

		$this->build_translation_jobs_item();
		$this->build_tp_com_log_item();

		$this->reorder_items();
	}

	/**
	 * It reorders all items based on their `order` key as well as the order (index) they were added.
	 */
	private function reorder_items() {
		$order_of_sections = array();
		$tab_items         = $this->tab_items;

		foreach ( $tab_items as $key => $value ) {
			$order_of_sections[ $key ] = (int) $value['order'];
		}

		if ( array_multisort( $order_of_sections, SORT_ASC, $tab_items ) ) {
			$this->tab_items = $tab_items;
		}
	}

	public function should_show_wizard() {

		$current_user_id = get_current_user_id();
		if (
			get_option( WPML_TM_Wizard_Options::WIZARD_COMPLETE_FOR_MANAGER, false ) || // Allow for pre 4.2.5 setting
			get_user_option( WPML_TM_Wizard_Options::WIZARD_COMPLETE_FOR_MANAGER, $current_user_id ) ||
			get_user_option( self::SKIP_TM_WIZARD_META_KEY, $current_user_id )
		) {
			return false;
		}

		if ( ! current_user_can( WPML_Manage_Translations_Role::CAPABILITY ) ) {
			return false;
		}

		if (
			! $this->is_wizard_running() &&
			(
				$this->translator_records->get_number_of_users_with_capability() ||
				$this->is_any_translation_service_active()
			)
		) {
			update_user_option( $current_user_id, WPML_TM_Wizard_Options::WIZARD_COMPLETE_FOR_MANAGER, true );
			return false;
		}

		return true;
	}

	private function is_wizard_running() {
		return get_option( WPML_TM_Wizard_Options::CURRENT_STEP, false );
	}

	private function is_any_translation_service_active() {
		$is_active     = TranslationProxy::get_current_service();
		$has_preferred = TranslationProxy::has_preferred_translation_service();

		return ( $is_active !== false || $has_preferred ) ? true : false;
	}

	private function build_dashboard_item() {
		$this->tab_items['dashboard'] = array(
			'caption'          => __( 'Translation Dashboard', 'wpml-translation-management' ),
			'current_user_can' => array( WPML_Manage_Translations_Role::CAPABILITY, 'manage_options' ),
			'callback'         => array( $this, 'build_content_dashboard' ),
			'order'            => 100,
		);
	}

	public function build_content_dashboard() {
		/** @var SitePress $sitepress */
		global $sitepress;
		$this->active_languages   = $sitepress->get_active_languages();
		$this->translatable_types = apply_filters( 'wpml_tm_dashboard_translatable_types', $sitepress->get_translatable_documents() );
		$this->build_dashboard_data();

		if ( $this->found_documents > $this->documents || $this->there_are_hidden_posts() ) {
			$this->display_hidden_posts_message();
		}
		$this->build_content_dashboard_remote_translations_controls();
		$this->build_content_dashboard_filter();
		$this->build_content_dashboard_results();
	}

	/**
	 * Used only by unit tests at the moment
	 */
	private function build_dashboard_data() {
		$this->build_dashboard_filter_arguments();
		$this->build_dashboard_documents();
	}

	private function build_dashboard_filter_arguments() {
		global $sitepress, $iclTranslationManagement;

		$this->current_language = $sitepress->get_current_language();
		$this->source_language  = TranslationProxy_Basket::get_source_language();

		if ( isset( $_COOKIE['wp-translation_dashboard_filter'] ) ) {
			parse_str( $_COOKIE['wp-translation_dashboard_filter'], $this->translation_filter );

			$this->translation_filter = filter_var_array(
				$this->translation_filter,
				array(
					'type'                 => FILTER_SANITIZE_STRING,
					'parent_type'          => FILTER_SANITIZE_STRING,
					'parent_id'            => FILTER_SANITIZE_NUMBER_INT,
					'from_lang'            => FILTER_SANITIZE_STRING,
					'to_lang'              => FILTER_SANITIZE_STRING,
					'tstatus'              => FILTER_SANITIZE_NUMBER_INT,
					'status'               => FILTER_SANITIZE_STRING,
					'translation_priority' => FILTER_SANITIZE_NUMBER_INT,
					'title'                => FILTER_SANITIZE_STRING,
				)
			);
		}

		$this->translation_filter['sort_by']    = isset( $_SESSION['wp-translation_dashboard_filter']['sort_by'] ) ?
			$_SESSION['wp-translation_dashboard_filter']['sort_by'] : null;
		$this->translation_filter['sort_order'] = isset( $_SESSION['wp-translation_dashboard_filter']['sort_order'] ) ?
			$_SESSION['wp-translation_dashboard_filter']['sort_order'] : null;

		if ( $this->source_language || ! isset( $this->translation_filter['from_lang'] ) ) {
			if ( $this->source_language ) {
				$this->translation_filter['from_lang'] = $this->source_language;
			} else {
				$this->translation_filter['from_lang'] = $this->current_language;
				if ( array_key_exists( 'lang', $_GET ) && $lang = filter_var( $_GET['lang'], FILTER_SANITIZE_STRING, FILTER_SANITIZE_FULL_SPECIAL_CHARS ) ) {
					$this->translation_filter['from_lang'] = $lang;
				}
			}
		}

		if ( ! isset( $this->translation_filter['to_lang'] ) ) {
			$this->translation_filter['to_lang'] = '';
			if ( array_key_exists( 'to_lang', $_GET ) && $lang = filter_var( $_GET['to_lang'], FILTER_SANITIZE_STRING, FILTER_SANITIZE_FULL_SPECIAL_CHARS ) ) {
				$this->translation_filter['to_lang'] = $lang;
			}
		}

		if ( $this->translation_filter['to_lang'] == $this->translation_filter['from_lang'] ) {
			$this->translation_filter['to_lang'] = false;
		}

		if ( ! isset( $this->translation_filter['tstatus'] ) ) {
			$this->translation_filter['tstatus'] = isset( $_GET['tstatus'] ) ? $_GET['tstatus'] : -1; // -1 == All documents
		}

		if ( ! isset( $this->translation_filter['sort_by'] ) || ! $this->translation_filter['sort_by'] ) {
			$this->translation_filter['sort_by'] = 'date';
		}
		if ( ! isset( $this->translation_filter['sort_order'] ) || ! $this->translation_filter['sort_order'] ) {
			$this->translation_filter['sort_order'] = 'DESC';
		}
		if ( ! isset( $this->translation_filter['type'] ) ) {
			$this->translation_filter['type'] = 'page';
		}
		$sort_order_next                 = $this->translation_filter['sort_order'] == 'ASC' ? 'DESC' : 'ASC';
		$this->dashboard_title_sort_link = 'admin.php?page=' . WPML_TM_FOLDER . $this->get_page_slug() . '&sm=dashboard&icl_tm_action=sort&sort_by=title&sort_order=' . $sort_order_next;
		$this->dashboard_date_sort_link  = 'admin.php?page=' . WPML_TM_FOLDER . $this->get_page_slug() . '&sm=dashboard&icl_tm_action=sort&sort_by=date&sort_order=' . $sort_order_next;

		$this->post_statuses          = array(
			'publish' => __( 'Published', 'wpml-translation-management' ),
			'draft'   => __( 'Draft', 'wpml-translation-management' ),
			'pending' => __( 'Pending Review', 'wpml-translation-management' ),
			'future'  => __( 'Scheduled', 'wpml-translation-management' ),
			'private' => __( 'Private', 'wpml-translation-management' ),
		);
		$this->post_statuses          = apply_filters( 'wpml_tm_dashboard_post_statuses', $this->post_statuses );
		$this->translation_priorities = new WPML_TM_Translation_Priorities();

		// Get the document types that we can translate
		/**
		 * attachments are excluded
		 *
		 * @since 2.6.0
		 */
		add_filter( 'wpml_tm_dashboard_translatable_types', array( $this, 'exclude_attachments' ) );
		$this->post_types = $sitepress->get_translatable_documents();
		$this->post_types = apply_filters( 'wpml_tm_dashboard_translatable_types', $this->post_types );
		$this->build_external_types();

		$this->selected_languages = array();
		if ( ! empty( $iclTranslationManagement->dashboard_select ) ) {
			$this->selected_posts     = $iclTranslationManagement->dashboard_select['post'];
			$this->selected_languages = $iclTranslationManagement->dashboard_select['translate_to'];
		}
		if ( isset( $this->translation_filter['icl_selected_posts'] ) ) {
			parse_str( $this->translation_filter['icl_selected_posts'], $this->selected_posts );
		}

		$this->filter_post_status = isset( $this->translation_filter['status'] ) ? $this->translation_filter['status'] : false;

		if ( isset( $_GET['type'] ) ) {
			$this->translation_filter['type'] = $_GET['type'];
		}

		$paged                            = (int) filter_input( INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT );
		$this->translation_filter['page'] = $paged ? $paged - 1 : 0;
		$this->filter_translation_type    = isset( $this->translation_filter['type'] ) ? $this->translation_filter['type'] : false;
	}

	private function build_dashboard_documents() {
		global $wpdb, $sitepress;
		$wpml_tm_dashboard_pagination = new WPML_TM_Dashboard_Pagination();
		$wpml_tm_dashboard_pagination->add_hooks();
		$tm_dashboard                         = new WPML_TM_Dashboard( $wpdb, $sitepress );
		$this->translation_filter['limit_no'] = $this->dashboard_pagination ? $this->dashboard_pagination->get_items_per_page() : 20;
		$dashboard_data                       = $tm_dashboard->get_documents( $this->translation_filter );
		$this->documents                      = $dashboard_data['documents'];
		$this->found_documents                = $dashboard_data['found_documents'];
	}

	/**
	 * @return bool
	 */
	private function there_are_hidden_posts() {
		return -1 === $this->found_documents;
	}

	private function display_hidden_posts_message() {
		?>
		<div class="notice notice-warning otgs-notice-icon inline">
			<p>
			<?php
				echo sprintf(
					esc_html__( 'To see more items, use the filter and narrow down the search. %s', 'wpml-translation-management' ), '<a href="https://wpml.org/documentation/translating-your-contents/how-to-send-content-for-translation/?utm_source=wpmlplugin&utm_campaign=content-translation&utm_medium=translation-dashboard&utm_term=how-to-send-content-for-translation" target="_blank">' . esc_html__( 'Help', 'wpml-translation-management' ) . '</a>'
				)
			?>
				</p>
		</div>
		<?php
	}

	private function build_content_dashboard_remote_translations_controls() {
		// shows only when translation polling is on and there are translations in progress
		$this->build_content_dashboard_fetch_translations_box();

		$active_service         = icl_do_not_promote() ? false : TranslationProxy::get_current_service();
		$service_dashboard_info = TranslationProxy::get_service_dashboard_info();
		if ( $active_service && $service_dashboard_info ) {
			?>
			<div class="icl_cyan_box">
				<h3>
				<?php
				echo $active_service->name . ' ' . __(
					'account status',
					'wpml-translation-management'
				)
				?>
																 </h3>
				<?php echo $service_dashboard_info; ?>
			</div>
			<?php
		}
	}

	private function build_content_dashboard_results() {
		?>
		<form method="post" id="icl_tm_dashboard_form">
			<?php
			// #############################################
			// Display the items for translation in a table.
			// #############################################
			$this->build_content_dashboard_documents();

			$this->heading( __( '2. Select translation options', 'wpml-translation-management' ) );
			$this->build_content_dashboard_documents_options();
			do_action( 'wpml_tm_dashboard_promo' );
			?>

		</form>
		<?php
	}

	private function build_content_dashboard_documents() {
		?>

		<input type="hidden" name="icl_tm_action" value="add_jobs"/>
		<input type="hidden" name="translate_from" value="<?php echo esc_attr( $this->translation_filter['from_lang'] ); ?>"/>
		<table class="widefat fixed striped" id="icl-tm-translation-dashboard">
			<thead>
			<?php $this->build_content_dashboard_documents_head_footer_cells(); ?>
			</thead>
			<tfoot>
			<?php $this->build_content_dashboard_documents_head_footer_cells(); ?>
			</tfoot>
			<tbody>
			<?php
			$this->build_content_dashboard_documents_body();
			?>
			</tbody>
		</table>
		<div class="tablenav clearfix">
			<div class="alignleft">
				<strong><?php echo esc_html__( 'Word count estimate:', 'wpml-translation-management' ); ?></strong>
				<?php printf( esc_html__( '%s words', 'wpml-translation-management' ), '<span id="icl-tm-estimated-words-count">0</span>' ); ?>
				<span id="icl-tm-doc-wrap" style="display: none">
					<?php printf( esc_html__( 'in %s document(s)', 'wpml-translation-management' ), '<span id="icl-tm-sel-doc-count">0</span>' ); ?>
				</span>
				<?php do_action( 'wpml_tm_dashboard_word_count_estimation' ); ?>
			</div>
			<?php
			if ( $this->dashboard_pagination && ! empty( $this->translation_filter['type'] ) ) {
				do_action( 'wpml_tm_dashboard_pagination', $this->dashboard_pagination->get_items_per_page(), $this->found_documents );
			}
			?>
		</div>
		<?php
		do_action( 'wpml_tm_after_translation_dashboard_documents' );
	}

	private function get_translate_tooltip_attributes() {
		$translate_radio_message = $this->get_translate_tooltip_text();

		if ( $translate_radio_message ) {
			return ' class="js-otgs-popover-tooltip" data-tippy-zIndex="999999" title="' . esc_attr( $translate_radio_message ) . '"';
		}

		return null;
	}

	private function get_translate_tooltip_text() {
		if ( ! wpml_tm_load_blog_translators()->has_translators() ) {
			if ( ! wpml_translation_management()->has_active_service() ) {
				/* translators: This text will be used to build a link to the translation roles page */
				$translators_link = $this->get_translation_roles_link( __( 'at least one translator', 'wpml-translation-management' ) );

				/* translators: This text will be used to build a link to the translation services page */
				$translation_services_link = $this->get_translation_services_link( __( 'active and authenticated translation service', 'wpml-translation-management' ) );

				/* translators: %1$s contains a link to the translation roles page with "at least one translator" as a text whilst %2$s is a link to the translation services page with "active and authenticated translation service" as a text */
				$tooltip_text = __( 'To send content to translation first make sure you either have %1$s or an %2$s.', 'wpml-translation-management' );

				return sprintf( $tooltip_text, $translators_link, $translation_services_link );
			}

			if ( wpml_translation_management()->service_activation_incomplete() ) {
				/* translators: %s is replaced with the name of the active translation service */
				$tooltip_text = __( 'To send content to translation first make sure "%s" is authenticated or you have at least one translator.', 'wpml-translation-management' );

				$translation_services_link = $this->get_translation_services_link( TranslationProxy::get_current_service_name() );

				return sprintf( $tooltip_text, $translation_services_link );
			}
		}

		return null;
	}

	private function build_content_dashboard_documents_options() {
		global $wpdb;

		$translate_checked  = 'checked="checked"';
		$duplicate_checked  = '';
		$do_nothing_checked = '';

		$flag_factory = new WPML_Flags_Factory( $wpdb );
		$flags        = $flag_factory->create();

		$translate_radio_text = __( 'Translate', 'wpml-translation-management' );

		$translate_tooltip_attributes = $this->get_translate_tooltip_attributes();
		if ( $translate_tooltip_attributes ) {
			$translate_checked  = 'disabled="disabled"';
			$do_nothing_checked = 'checked="checked"';
		}

		?>
		<div class="tm-dashboard-translation-options">


			<table id="icl_tm_languages" class="widefat">
				<thead>
				<tr>
					<th><?php echo esc_html__( 'All Languages', 'wpml-translation-management' ); ?></th>
					<td>
						<label <?php echo $translate_tooltip_attributes; ?>>
							<input type="radio" id="translate-all" value="1" name="radio-action-all" <?php echo $translate_checked; ?> /> <?php echo esc_html( $translate_radio_text ); ?>
						</label>
					</td>
					<td>
						<label>
							<input type="radio" id="duplicate-all" value="2" name="radio-action-all" <?php echo $duplicate_checked; ?> />
																												<?php
																												echo esc_html__(
																													'Duplicate content',
																													'wpml-translation-management'
																												)
																												?>
						</label>
					</td>
					<td>
						<label>
							<input type="radio" id="update-none" value="0" name="radio-action-all" <?php echo $do_nothing_checked; ?> /> <?php echo esc_html__( 'Do nothing', 'wpml-translation-management' ); ?>
						</label>
					</td>
				</tr>
				<tr class="blank_row">
					<td colspan="3" style="height:6px!important;"></td>
				</tr>
				</thead>
				<tbody>
				<?php foreach ( $this->active_languages as $lang ) : ?>
					<?php
					if ( $lang['code'] == $this->translation_filter['from_lang'] ) {
						continue;
					}
					$radio_prefix_html = '<input type="radio" name="tr_action[' . esc_attr( $lang['code'] ) . ']" ';
					?>
					<tr>
						<th>
							<img width="18" height="12" src="<?php echo esc_url( $flags->get_flag_url( $lang['code'] ) ); ?>" alt="<?php echo esc_url( sprintf( __( 'Flag for %s', 'wpml-translation-management' ), $lang['code'] ) ); ?>"/>
							<strong><?php echo esc_html( $lang['display_name'] ); ?></strong>
						</th>
						<td>
							<label <?php echo $translate_tooltip_attributes; ?>>
								<?php echo $radio_prefix_html; ?> value="1" <?php echo $translate_checked; ?>/>
								<?php echo esc_html( $translate_radio_text ); ?>
							</label>
						</td>
						<td>
							<label>
								<?php echo $radio_prefix_html; ?> value="2" <?php echo $duplicate_checked; ?>/>
								<?php echo esc_html__( 'Duplicate content', 'wpml-translation-management' ); ?>
							</label>
						</td>
						<td>
							<label>
								<?php echo $radio_prefix_html; ?> value="0" <?php echo $do_nothing_checked; ?>/>
								<?php echo esc_html__( 'Do nothing', 'wpml-translation-management' ); ?>
							</label>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

			<input name="iclnonce" type="hidden" value="<?php echo wp_create_nonce( 'pro-translation-icl' ); ?>"/>
			<?php
			$tm_jobs_submit_disabled = disabled( empty( $this->selected_languages ) && empty( $this->selected_posts ), true, false );
			$tm_jobs_submit_caption  = __( 'Add selected content to translation basket', 'wpml-translation-management' );
			?>

			<span class="wpml-display-block text-center wpml-margin-top-lg">
						  <button id="icl_tm_jobs_submit" class="button-primary button-lg wpml-tm-button-basket" type="submit" <?php echo $tm_jobs_submit_disabled; ?>><?php echo $tm_jobs_submit_caption; ?></button>
					  </span>

			<div id="icl_dup_ovr_warn" class="wpml-margin-top-base" style="display:none;">
				<?php
				$dup_message  = '<p>';
				$dup_message .= __( 'Any existing content (translations) will be overwritten when creating duplicates.', 'wpml-translation-management' );
				$dup_message .= '</p>';
				$dup_message .= '<p>';
				$dup_message .= __( "When duplicating content, please first duplicate parent pages to maintain the site's hierarchy.", 'wpml-translation-management' );
				$dup_message .= '</p>';

				ICL_AdminNotifier::display_instant_message( $dup_message, 'error' );

				?>
			</div>
			<div style="width: 45%; margin: auto; position: relative; top: -30px;">
				<?php
				ICL_AdminNotifier::display_messages( 'translation-dashboard-under-translation-options' );
				ICL_AdminNotifier::remove_message( 'items_added_to_basket' );
				?>
			</div>

		</div>
		<?php

		wp_enqueue_script( 'wpml-tooltip' );
		wp_enqueue_style( 'wpml-tooltip' );
	}


	private function build_content_dashboard_documents_head_footer_cells() {
		global $sitepress;
		?>
		<tr>
			<td scope="col" class="manage-column column-cb check-column">
				<?php
				$check_all_checked = checked( true, isset( $_GET['post_id'] ), false );
				?>
				<input type="checkbox" <?php echo $check_all_checked; ?>/>
			</td>
			<th scope="col" class="manage-column column-title">
				<?php
				$dashboard_title_sort_caption = __( 'Title', 'wpml-translation-management' );
				$this->build_content_dashboard_documents_sorting_link( $this->dashboard_title_sort_link, $dashboard_title_sort_caption, 'p.post_title' );
				?>
			</th>
			<th scope="col" class="manage-column wpml-column-type">
				<?php echo esc_html__( 'Type', 'wpml-translation-management' ); ?>
			</th>
			<?php
			$active_languages = $sitepress->get_active_languages();
			$lang_count       = count( $active_languages );
			$lang_col_width   = ( $lang_count - 1 ) * 26 . 'px';
			if ( $lang_count > 10 ) {
				$lang_col_width = '30%';
			}
			?>

			<th scope="col" class="manage-column column-active-languages wpml-col-languages" style="width: <?php echo esc_attr( $lang_col_width ); ?>">
				<?php
				if ( $this->translation_filter['to_lang'] && array_key_exists( $this->translation_filter['to_lang'], $active_languages ) ) {
					$lang = $active_languages[ $this->translation_filter['to_lang'] ];
					?>

					<span title="<?php echo esc_attr( $lang['display_name'] ); ?>"><img src="<?php echo esc_url( $sitepress->get_flag_url( $this->translation_filter['to_lang'] ) ); ?>" width="16" height="12" alt="<?php echo esc_attr( $this->translation_filter['to_lang'] ); ?>"/></span>
					<?php
				} else {
					foreach ( $active_languages as $lang ) {
						if ( $lang['code'] === $this->translation_filter['from_lang'] ) {
							continue;
						}
						?>
						<span title="<?php echo esc_attr( $lang['display_name'] ); ?>"><img src="<?php echo esc_url( $sitepress->get_flag_url( $lang['code'] ) ); ?>" width="16" height="12" alt="<?php echo esc_attr( $lang['code'] ); ?>"/></span>
						<?php
					}
				}
				?>
			</th>
			<th scope="col" class="manage-column column-date">
				<?php
				$dashboard_date_sort_label = __( 'Date', 'wpml-translation-management' );
				$this->build_content_dashboard_documents_sorting_link( $this->dashboard_date_sort_link, $dashboard_date_sort_label, 'p.post_date' );
				?>
			</th>
			<th scope="col" class="manage-column column-actions">
				<?php echo esc_html__( 'Actions', 'wpml-translation-management' ); ?>
			</th>

		</tr>
		<?php
	}

	private function build_content_dashboard_documents_body() {
		global $sitepress;

		if ( ! $this->documents ) {
			?>
			<tr>
				<td scope="col" colspan="6" align="center">
					<span class="no-documents-found"><?php echo esc_html__( 'No documents found', 'wpml-translation-management' ); ?></span>
				</td>
			</tr>
			<?php
		} else {
			$records_factory               = new WPML_TM_Word_Count_Records_Factory();
			$single_process_factory        = new WPML_TM_Word_Count_Single_Process_Factory();
			$translatable_element_provider = new WPML_TM_Translatable_Element_Provider(
				$records_factory->create(),
				$single_process_factory->create(),
				class_exists( 'WPML_ST_Package_Factory' ) ? new WPML_ST_Package_Factory() : null
			);

			wp_nonce_field( 'save_translator_note_nonce', '_icl_nonce_stn_' );
			$active_languages = $this->translation_filter['to_lang']
				? array( $this->translation_filter['to_lang'] => $this->active_languages[ $this->translation_filter['to_lang'] ] )
				: $this->active_languages;
			foreach ( $this->documents as $doc ) {
				$selected = is_array( $this->selected_posts ) && in_array( $doc->ID, $this->selected_posts );
				$doc_row  = new WPML_TM_Dashboard_Document_Row(
					$doc,
					$this->translation_filter,
					$this->post_types,
					$this->post_statuses,
					$active_languages,
					$selected,
					$sitepress,
					$translatable_element_provider
				);
				$doc_row->display();
			}
		}
	}

	/**
	 * @return bool
	 */
	private function current_user_can_manage_translations() {
		return current_user_can( WPML_Manage_Translations_Role::CAPABILITY );
	}

	private function build_content_dashboard_documents_sorting_link( $url, $label, $filter_argument ) {
		$caption = $label;
		if ( $this->translation_filter['sort_by'] === $filter_argument ) {
			$caption .= '&nbsp;';
			$caption .= $this->translation_filter['sort_order'] === 'ASC' ? '&uarr;' : '&darr;';
		}
		?>
		<a href="<?php echo esc_url( $url ); ?>">
			<?php echo $caption; ?>
		</a>
		<?php
	}

	private function build_basket_item() {
		$basket_items_count = TranslationProxy_Basket::get_basket_items_count( true );

		if ( $basket_items_count > 0 ) {

			$this->tab_items['basket'] = array(
				'caption'          => $this->build_basket_item_caption( $basket_items_count ),
				'current_user_can' => WPML_Manage_Translations_Role::CAPABILITY,
				'callback'         => array( $this, 'build_content_basket' ),
				'order'            => 101
			);

		}
	}

	/**
	 * @param int $basket_items_count
	 *
	 * @return string
	 */
	private function build_basket_item_caption( $basket_items_count = 0 ) {
		if ( isset( $_GET['clear_basket'] ) && $_GET['clear_basket'] ) {
			$basket_items_count = 0;
		} else {

			if ( ! is_numeric( $basket_items_count ) ) {
				$basket_items_count = TranslationProxy_Basket::get_basket_items_count( true );
			}
			if ( isset( $_GET['action'], $_GET['id'] ) && $_GET['action'] === 'delete' && $_GET['id'] ) {
				-- $basket_items_count;
			}
		}

		$basket_items_count_caption = esc_html__( 'Translation Basket', 'wpml-translation-management' );
		if ( $basket_items_count > 0 ) {
			$basket_item_count_badge     = '<span id="wpml-basket-items"><span id="basket-item-count">' . $basket_items_count . '</span></span>';
			$basket_items_count_caption .= $basket_item_count_badge;
		}

		return $basket_items_count_caption;
	}

	public function build_content_basket() {
		$basket_table = new SitePress_Table_Basket();

		do_action( 'wpml_tm_before_basket_items_display' );

		$basket_table->prepare_items();

		$action_url = esc_attr( 'admin.php?page=' . WPML_TM_FOLDER . $this->get_page_slug() . '&sm=' . $_GET['sm'] );

		$this->heading( __( '1. Review documents for translation', 'wpml-translation-management' ) );
		?>

		<form method="post" id="translation-jobs-basket-form" class="js-translation-jobs-basket-form"
			  data-message="
			  <?php
				echo esc_attr__(
					'You are about to delete selected items from the basket. Are you sure you want to do that?',
					'wpml-translation-management'
				)
				?>
												   "
			  name="translation-jobs-basket" action="<?php echo $action_url; ?>">
			<?php
			$basket_table->display();
			?>
		</form>
		<?php
		$this->build_translation_options();
	}

	private function build_translation_options() {
		global $sitepress, $wpdb;
		$basket_items_number = TranslationProxy_Basket::get_basket_items_count( true );

		if ( $basket_items_number > 0 ) {
			$deadline_estimate_factory = new WPML_TM_Jobs_Deadline_Estimate_Factory();
			$deadline_estimate_date    = $deadline_estimate_factory->create()->get(
				TranslationProxy_Basket::get_basket(),
				array(
					'translator_id' => TranslationProxy_Service::get_wpml_translator_id(),
					'service'       => TranslationProxy::get_current_service_id(),
				)
			);

			$basket_name_max_length  = TranslationProxy::get_current_service_batch_name_max_length();
			$source_language         = TranslationProxy_Basket::get_source_language();
			$basket                  = new WPML_Translation_Basket( $wpdb );
			$basket_name_placeholder = sprintf(
				__( '%1$s|WPML|%2$s', 'wpml-translation-management' ), htmlspecialchars_decode( get_option( 'blogname' ), ENT_QUOTES ), $source_language
			);
			$basket_name_placeholder = $basket->get_unique_basket_name( $basket_name_placeholder, $basket_name_max_length );

			$utility                      = make( Utility::class );
			$target_languages             = $utility->getTargetLanguages();
			$isTheOnlyAvailableTranslator = $utility->isTheOnlyAvailableTranslatorForTargetLanguages( $target_languages );

			$translators_dropdowns = \wpml_collect( $target_languages )->pluck( 'code', 'code' )
			                                                           ->map( [ $this, 'get_translators_dropdown' ] );

			$tooltip_content = esc_html__( 'This deadline is what WPML suggests according to the amount of work that you already sent to this translator. You can modify this date to set the deadline manually.', 'wpml-translation-management' );

			$translation_service_enabled = $this->is_translation_service_enabled();

			$model = array(
				'strings'                      => array(
					'heading_basket_name'    => __( '2. Set a batch name and deadline', 'wpml-translation-management' ),
					'heading_translators'    => __( '3. Choose translator or Translation Service', 'wpml-translation-management' ),
					'batch_name_label'       => __( 'Batch name:', 'wpml-translation-management' ),
					'batch_name_desc'        => __( 'Give a name to the batch. If omitted, the default name will be applied.', 'wpml-translation-management' ),
					'column_language'        => __( 'Language pair', 'wpml-translation-management' ),
					'column_translator'      => __( 'Translator', 'wpml-translation-management' ),
					'pro_translation_tip'    => __( 'Did you know that you can also set Translation Services and professional translators will handle your translation?', 'wpml-translation-management' ),
					'batch_deadline_label'   => __( 'Suggested deadline:', 'wpml-translation-management' ),
					'batch_deadline_tooltip' => $tooltip_content,
					'button_send_all'        => __( 'Send all items for translation', 'wpml-translation-management' ),
				),
				'source_language'              => $sitepress->get_language_details( $source_language ),
				'source_language_flag'         => $sitepress->get_flag_img( $source_language ),
				'basket_name_max_length'       => $basket_name_max_length,
				'basket_name_placeholder'      => $basket_name_placeholder,
				'target_languages'             => $target_languages,
				'dropdowns_translators'        => $translators_dropdowns,
				'pro_translation_link'         => '<br /><a href="' . admin_url( 'admin.php?page=' . WPML_TM_FOLDER . $this->get_page_slug() . '&sm=translation-services' ) . '">'
				                                  . __( 'Check available Translation Services', 'wpml-translation-management' ) . '</a>',
				'deadline_estimation_date'     => $deadline_estimate_date,
				'extra_basket_fields'          => TranslationProxy_Basket::get_basket_extra_fields_section(),
				'nonces'                       => array(
					'_icl_nonce_send_basket_items'  => wp_create_nonce( 'send_basket_items_nonce' ),
					'_icl_nonce_send_basket_item'   => wp_create_nonce( 'send_basket_item_nonce' ),
					'_icl_nonce_send_basket_commit' => wp_create_nonce( 'send_basket_commit_nonce' ),
					'_icl_nonce_check_basket_name'  => wp_create_nonce( 'check_basket_name_nonce' ),
					'_icl_nonce_refresh_deadline'   => wp_create_nonce( 'wpml-tm-jobs-deadline-estimate-ajax-action' ),
					'_icl_nonce_rollback_basket'    => wp_create_nonce( 'rollback_basket_nonce' ),
				),
				'translation_service_enabled'  => $translation_service_enabled,
				'current_user_only_translator' => $isTheOnlyAvailableTranslator,
			);
			echo $this->template_service->show( $model, 'basket/options.twig' );
		}

		do_action( 'wpml_translation_basket_page_after' );
	}

	public function get_translators_dropdown( $lang_code ) {
		$selected_translator = TranslationProxy_Service::get_wpml_translator_id();

		$args = array(
			'from'     => TranslationProxy_Basket::get_source_language(),
			'to'       => $lang_code,
			'name'     => 'translator[' . $lang_code . ']',
			'selected' => $selected_translator,
			'services' => array( 'local', TranslationProxy::get_current_service_id() ),
			'echo'     => false,
		);

		return wpml_tm_get_translators_dropdown()->render( $args );
	}

	private function build_translation_jobs_item() {
		$jobs_repository = wpml_tm_get_jobs_repository();
		$jobs_count      = $jobs_repository->get_count( new WPML_TM_Jobs_Search_Params() );

		if ( $jobs_count ) {
			$this->tab_items['jobs'] = array(
				'caption'          => __( 'Translation Jobs', 'wpml-translation-management' ),
				'current_user_can' => WPML_Manage_Translations_Role::CAPABILITY,
				'callback'         => array( $this, 'build_content_translation_jobs' ),
				'order'            => 100000,
			);
		}
	}

	public function build_content_translation_jobs() {
		echo "<div id='wpml-remote-jobs-container'></div>";
	}


	private function build_tp_com_log_item() {
		if ( isset( $_GET['sm'] ) && 'com-log' === $_GET['sm'] ) {
			$this->tab_items['com-log'] = array(
				'caption'          => __( 'Communication Log', 'wpml-translation-management' ),
				'current_user_can' => 'manage_options',
				'callback'         => array( $this, 'build_tp_com_log' ),
				'order'            => 1000000,
			);
		}
	}

	public function build_tp_com_log() {
		if ( isset( $_POST['tp-com-clear-log'] ) ) {
			WPML_TranslationProxy_Com_Log::clear_log();
		}

		if ( isset( $_POST['tp-com-disable-log'] ) ) {
			WPML_TranslationProxy_Com_Log::set_logging_state( false );
		}

		if ( isset( $_POST['tp-com-enable-log'] ) ) {
			WPML_TranslationProxy_Com_Log::set_logging_state( true );
		}

		$action_url = esc_attr( 'admin.php?page=' . WPML_TM_FOLDER . $this->get_page_slug() . '&sm=' . $_GET['sm'] );
		$com_log    = WPML_TranslationProxy_Com_Log::get_log();

		?>

		<form method="post" id="tp-com-log-form" name="tp-com-log-form" action="<?php echo $action_url; ?>">

			<?php if ( WPML_TranslationProxy_Com_Log::is_logging_enabled() ) : ?>

				<?php echo esc_html__( "This is a log of the communication between your site and the translation system. It doesn't include any private information and allows WPML support to help with problems related to sending content to translation.", 'wpml-translation-management' ); ?>

				<br />
				<br />
				<?php if ( $com_log != '' ) : ?>
					<textarea wrap="off" readonly="readonly" rows="16" style="font-size:10px; width:100%"><?php echo $com_log; ?></textarea>
					<br />
					<br />
					<input class="button-secondary" type="submit" name="tp-com-clear-log" value="<?php echo esc_attr__( 'Clear log', 'wpml-translation-management' ); ?>">
				<?php else : ?>
					<strong><?php echo esc_html__( 'The communication log is empty.', 'wpml-translation-management' ); ?></strong>
					<br />
					<br />
				<?php endif; ?>

				<input class="button-secondary" type="submit" name="tp-com-disable-log" value="<?php echo esc_attr__( 'Disable logging', 'wpml-translation-management' ); ?>">

			<?php else : ?>
				<?php echo esc_html__( 'Communication logging is currently disabled. To allow WPML support to help you with issues related to sending content to translation, you need to enable the communication logging.', 'wpml-translation-management' ); ?>

				<br />
				<br />
				<input class="button-secondary" type="submit" name="tp-com-enable-log" value="<?php echo esc_attr__( 'Enable logging', 'wpml-translation-management' ); ?>">

			<?php endif; ?>

		</form>
		<?php
	}

	public function get_dashboard_documents() {
		return $this->documents;
	}

	public function build_content_dashboard_filter() {
		global $wpdb;

		$dashboard_filter = new WPML_TM_Dashboard_Display_Filter(
			$this->active_languages,
			$this->source_language,
			$this->translation_filter,
			$this->post_types,
			$this->post_statuses,
			$this->translation_priorities->get_values(),
			$wpdb
		);
		$dashboard_filter->display();
	}

	private function build_external_types() {
		$this->post_types = apply_filters( 'wpml_get_translatable_types', $this->post_types );
		foreach ( $this->post_types as $id => $type_info ) {
			if ( isset( $type_info->prefix ) ) {
				// this is an external type returned by wpml_get_translatable_types
				$new_type                        = new stdClass();
				$new_type->labels                = new stdClass();
				$new_type->labels->singular_name = isset( $type_info->labels->singular_name ) ? $type_info->labels->singular_name : $type_info->label;
				$new_type->labels->name          = isset( $type_info->labels->name ) ? $type_info->labels->name : $type_info->label;
				$new_type->prefix                = $type_info->prefix;
				$new_type->external_type         = 1;

				$this->post_types[ $id ] = $new_type;
			}
		}
	}

	/**
	 * @param array $post_types
	 *
	 * @since 2.6.0
	 *
	 * @return array
	 */
	public function exclude_attachments( $post_types ) {
		unset( $post_types['attachment'] );

		return $post_types;
	}

	protected function get_page_slug() {
		return WPML_Translation_Management::PAGE_SLUG_MANAGEMENT;
	}

	protected function get_default_tab() {
		return 'dashboard';
	}

	/**
	 * @return bool|\TranslationProxy_Service|\WP_Error
	 */
	private function is_translation_service_enabled() {
		$translation_service_enabled = TranslationProxy::get_current_service();
		if ( is_wp_error( $translation_service_enabled ) ) {
			$translation_service_enabled = false;
		}

		return $translation_service_enabled;
	}

	/**
	 * @return string
	 */
	private function get_translation_roles_link( $text ) {
		return $this->get_tm_menu_link( WPML_TM_Translation_Roles_Section::SLUG, $text );
	}

	/**
	 * @return string
	 */
	private function get_translation_services_link( $text ) {
		return $this->get_tm_menu_link( WPML_TM_Translation_Services_Admin_Section::SLUG, $text );
	}

	private function get_tm_menu_link( $section, $text ) {
		$admin_url = admin_url( 'admin.php' );

		$args          = array(
			'page' => urlencode(WPML_TM_FOLDER . WPML_Translation_Management::PAGE_SLUG_MANAGEMENT),
			'sm'   => urlencode($section),
		);
		$menu_link_url = add_query_arg( $args, $admin_url );

		return '<a href="' . esc_url( $menu_link_url ) . '">' . esc_html( $text ) . '</a>';
	}
}
