<?php

namespace AirtableConnect;

class AirtableApi {

	public $apiKey;
	public $baseUrl = 'https://api.airtable.com/v0';

	/*
	 * Constructor sets the api key saved in settings
	 */
	public function __construct() {

		$this->apiKey = get_option('airtable_api_key');

	}

	/*
	 * Make call to the AirTable API
	*/
	public function call( $endpoint, $method = 'get', $vars = false ) {

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $this->baseUrl . $endpoint );
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		'User-Agent: PHP',
		'Content-Type: application/json; charset=utf-8',
		'Authorization: Bearer ' . $this->apiKey
		));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// set options for posts
		if( $method == 'post' ) {
			curl_setopt( $curl, CURLOPT_POST, 1 );
			$varsJson = json_encode( $vars );
			curl_setopt( $curl, CURLOPT_POSTFIELDS, $varsJson );
		}

		// set options for put
		if( $method == 'put' ) {
			curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT");
			$varsJson = json_encode( $vars );
			curl_setopt( $curl, CURLOPT_POSTFIELDS, $varsJson );
		}

		// set options for patch
		if( $method == 'patch' ) {
			curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PATCH");
			$varsJson = json_encode( $vars );
			curl_setopt( $curl, CURLOPT_POSTFIELDS, $varsJson );
		}

		// set options for delete
		if( $method == 'delete' ) {
			curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE");
		}

		$response = new \stdClass;
		$response->raw = curl_exec( $curl );
		$response->data = json_decode( $response->raw );
		$response->code = curl_getinfo( $curl, CURLINFO_HTTP_CODE );

		\AirtableConnect\Log::entry(
		  'AirTable API Call',
			$response->code,
		  'Logging response from AirTable API call.',
		  [
				'response' => $response,
				'vars' 		 => $vars
			]
		);

		return $response;

 	}

}
