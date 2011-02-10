<?php defined('SYSPATH') or die('No direct script access.');

class Request extends Kohana_Request {

	/**
	 * Checks if a file larger than the post_max_size has been uploaded
	 */
	public static function upload_too_large()
	{
		return (bool) (isset($_GET['uploading']) AND empty($_POST) AND empty($_FILES));
	}

} // End Request
