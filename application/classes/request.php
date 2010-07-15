<?php defined('SYSPATH') or die('No direct script access.');

class Request extends Kohana_Request {

	/**
	 * Checks if a file larger than the post_max_size has been uploaded
	 */
	public static function upload_too_large()
	{
		echo Kohana::debug((isset($_GET['uploading']) && empty($_POST) && empty($_FILES)));
		return (bool) (isset($_GET['uploading']) && empty($_POST) && empty($_FILES));
	}

} // End Request
