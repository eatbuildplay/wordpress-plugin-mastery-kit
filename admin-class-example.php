<?php

namespace AirtableConnect;

class Admin {

	public function init() {

		add_action( 'admin_post_airtable_connect_api', array( '\AirtableConnect\Admin', 'processApiForm'));
		add_action( 'admin_post_airtable_connect_log_clear', array( '\AirtableConnect\Admin', 'processLogClearForm'));
		add_action( 'admin_post_airtable_connect_connections', array( '\AirtableConnect\Admin', 'processConnectionsForm'));
		add_action( 'admin_enqueue_scripts', array( $this, 'adminScripts'));

		add_action( 'wp_ajax_airtable_connect_api_test', array( $this, 'apiTest'));
		add_action( 'wp_ajax_airtable_connect_delete', array( $this, 'jxConnectDelete'));


	}

	public function apiTest() {

		$api = new AirtableApi();
		$api->apiKey = get_option('airtable_api_key');
		$response = $api->call('/apphyZq0vvoujFIQv/Quiz%20Stats');

		print json_encode( $response );

		wp_die();

	}

	public function jxConnectDelete() {

		$index = $_POST['index'];

		$connections = get_option( 'airtable_connect_connections', [] );
		if( !is_array( $connections )) {
			wp_die();
		}

		if( array_key_exists( $index, $connections )) {
			unset( $connections[ $index ] );
		}
		update_option( 'airtable_connect_connections', $connections );


		$response = array(
			'success' 		=> 1,
			'connections' => $connections
		);
		print json_encode( $response );
		wp_die();

	}

	public function adminScripts() {

		wp_enqueue_script(
			'airtable-connect-admin-script',
			AIRTABLE_CONNECT_URL . 'assets/script.admin.js',
			[],
			AIRTABLE_CONNECT_VERSION
		);

		wp_enqueue_style(
			'airtable-connect-admin-style',
			AIRTABLE_CONNECT_URL . 'assets/style.admin.css',
			[],
			AIRTABLE_CONNECT_VERSION
		);

	}

	public function addPages() {

		add_menu_page(
			'AirTable Connect',
			'AirTable Connect',
			'manage_options',
			'airtable-connect',
			array( '\AirtableConnect\Admin', 'pageDashboard'),
			'dashicons-redo',
			55
		);

		add_submenu_page(
			'airtable-connect',
			'Dashboard',
			'Dashboard',
			'manage_options',
			'airtable-connect',
			array( '\AirtableConnect\Admin', 'pageDashboard')
		);

		add_submenu_page(
			'airtable-connect',
			'Connections',
			'Connections',
			'manage_options',
			'airtable-connections',
			array( '\AirtableConnect\Admin', 'pageConnections')
		);

		add_submenu_page(
			'airtable-connect',
			'Settings',
			'Settings',
			'manage_options',
			'api',
			array( '\AirtableConnect\Admin', 'pageApi')
		);

		add_submenu_page(
			'airtable-connect',
			'Logs',
			'Logs',
			'manage_options',
			'logs',
			array( '\AirtableConnect\Admin', 'pageLogs')
		);

	}

	public static function pageDashboard() {

		$template = new \AirtableConnect\Template;
		$template->render('dashboard');

	}

	public static function pageConnections() {

		$template = new \AirtableConnect\Template;
		$template->render('connections');

	}

	public static function pageApi() {

		$template = new \AirtableConnect\Template;
		$template->render('api');

	}

	public static function pageLogs() {
		$template = new \AirtableConnect\Template;
		$template->render('logs');
	}

	public static function processApiForm() {

		$apiKey = $_POST['api_key'];
		update_option('airtable_api_key', $apiKey);

		wp_safe_redirect(admin_url('admin.php?page=api'));

	}

	public static function processLogClearForm() {

		$resetLog = $_POST['reset_log'];

		if( $resetLog ) {
			$log = new \AirtableConnect\Log;
			$log->reset();
		}

		wp_safe_redirect(admin_url('admin.php?page=logs'));

	}


	public static function processConnectionsForm() {

		$connections = get_option('airtable_connect_connections', array());

		$connectionType = $_POST['connection_type'];
		$baseId = $_POST['base_id'];

		if( $connectionType == 'learndash' ) {

			$tableQuizStat = $_POST['airtable_learndash_table_quiz_stat'];
			$tableQuestionStat = $_POST['airtable_learndash_table_question_stat'];
			$connections[] = array(
				'type' 		=> $connectionType,
				'base_id' => $baseId,
				'tables' => array(
					'quiz_stat' => $tableQuizStat,
					'question_stat' => $tableQuestionStat,
				)
			);

		}

		if( $connectionType == 'events_manager_pro' ) {

			$tableBooking = $_POST['airtable_event_manager_table_booking'];
			$connections[] = array(
				'type' 		=> $connectionType,
				'base_id' => $baseId,
				'tables' => array(
					'booking' => $tableBooking,
				)
			);

		}

		update_option( 'airtable_connect_connections', $connections );

		wp_safe_redirect(admin_url('admin.php?page=airtable-connections'));

	}


}
