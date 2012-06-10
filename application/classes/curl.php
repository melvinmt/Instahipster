<?php defined('SYSPATH') or die('No direct script access.');

class curl{
	
	public static function multi_exec(array $handles){
		
		// Initialize MultiCURL
		$multi_handle = curl_multi_init();

		// Loop through each of the CURL handles and add them to the MultiCURL request.
		foreach ($handles as $handle)
		{
			curl_multi_add_handle($multi_handle, $handle);
		}

		$count = 0;

		// Execute
		do
		{
			$status = curl_multi_exec($multi_handle, $active);
		}
		while ($status == CURLM_CALL_MULTI_PERFORM || $active);

		// Define this.
		$handles_post = array();

		// Retrieve each handle response
		foreach ($handles as $key => $handle)
		{
			if (curl_errno($handle) == CURLE_OK)
			{
				// $http = new $this->request_class(null);
				$handles_post[$key] = curl_multi_getcontent($handle);
			}

			// Explicitly close each cURL handle.
			curl_multi_remove_handle($multi_handle, $handle);
			curl_close($handle);
		}

		return $handles_post;
	}
	
	public static function get_ssl($url, array $post = array(), $multicurl = false, $return_handle = false){
	
		$ch = curl_init();
		
		if(!empty($post)){
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}
		
		curl_setopt($ch, CURLOPT_URL, $url);	
		curl_setopt($ch, CURLOPT_FILETIME, true);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
		curl_setopt($ch, CURLOPT_CLOSEPOLICY, CURLCLOSEPOLICY_LEAST_RECENTLY_USED);
		// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		// curl_setopt($ch, CURLOPT_MAXREDIRS, 6);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5184000);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($ch, CURLOPT_NOSIGNAL, true);
			
		if($multicurl){	
			FlexSDB::handle($ch);
			return true;
		}
		elseif($return_handle)
		{
			return $ch;
		}else{
			
			$response = curl_exec($ch);
			return $response;
		}
		
	}
	
	public static function get_ssl_headers($url, array $post = array()){
	
		$ch = curl_init();
		
		if(!empty($post)){
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}
		
		curl_setopt($ch, CURLOPT_URL, $url);	
		curl_setopt($ch, CURLOPT_FILETIME, true);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
		curl_setopt($ch, CURLOPT_CLOSEPOLICY, CURLCLOSEPOLICY_LEAST_RECENTLY_USED);
		// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		// curl_setopt($ch, CURLOPT_MAXREDIRS, 6);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5184000);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($ch, CURLOPT_NOSIGNAL, true);
		
		$headers = curl_exec($ch);
		
		$headers = http_parse_headers($headers);
		
		return $headers;
		
	}
}