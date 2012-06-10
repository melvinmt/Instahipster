<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Img extends Abstract_Controller_Page {

	public function action_get() {

		$id = str_replace('get/', '', $this->request->param('id'));

		if($id)
		{

			$tmp_dir = APPPATH.'/tmp';
/*
			if(!is_dir($tmp_dir)){
				mkdir($tmp_dir, 0777, true);
			} else if (!is_writable($tmp_dir)) {
				chmod($tmp_dir, 0777);
			}*/

			$img_path = $tmp_dir.'/'.$id;

			$img = file_get_contents($img_path);

			$this->response->body($img)->headers('Content-Type', File::mime($img_path));

		}

	}

}