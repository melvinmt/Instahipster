<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Hipsterize extends Abstract_Controller_Page {

	protected $_logged_in = false;
	protected $_img;
	protected $_user;
	protected $_access_token;

	public function before()
	{

		if($this->_access_token = Cookie::get('access_token'))
		{
			// make a test!
			$url = 'http://api.via.me/v1/users/me';

			$params = array(
				'access_token' => $this->_access_token,
			);

			$request = Request::factory($url)->query($params)->execute();

			if($this->_user = Arr::path(json_decode($request->body(), true), 'response.user'))
			{
				$this->_logged_in = TRUE;
			}

		}

		if( ! $this->_logged_in)
			$this->request->redirect('/');

		parent::before();
	}

	public function action_edit()
	{
		if( ! $this->_img = Arr::get($_GET, 'img'))
			$this->request->redirect('/hipsterize');
	}

	public function action_save()
	{

		if($json = Arr::get($_POST, 'json'))
		{

			$json = json_decode($json, true);

			$stickers = Arr::get($json, 'cliparts', array());
			$picture_url = Arr::get($json, 'mainPic', '');

			if($picture_url)
			{

				$pic_size = getimagesize($picture_url);

				if($pic_size)
				{

					$width = $pic_size[0];
					$height = $pic_size[1];
					$img_type = $pic_size[2];
					$mime = $pic_size['mime'];

					$canvas = imagecreatetruecolor($width, $height);
					imagealphablending($canvas, true);
					imagesavealpha($canvas, true);

					// allocate certain color with alpha level
					$transparant = imagecolorallocatealpha($canvas, $red = 0, $green = 0, $blue = 0, 127);

					// create fullsize alpha (transparant) rectangle
					imagefilledrectangle($canvas, $x1 = 0, $y1 = 0, $x2 = $width, $y2 = $height, $color = $transparant);

					// retrieve mime type
					switch($img_type) {
						case 1 : $picture = imagecreatefromgif($picture_url); break;
						case 2 : $picture = imagecreatefromjpeg($picture_url); break;
						case 3 : $picture = imagecreatefrompng($picture_url); break;
						default: $picture = NULL;
					}

					if( ! $picture)
						return FALSE;

					// include alpha channel
					imagealphablending($picture, false);
					imagesavealpha($picture, true);

					// merge new img with base img
					imagecopy($dest = $canvas, $src = $picture, $dest_x = 0, $dest_y = 0, $src_x = 0, $src_y = 0, $src_w = $width, $src_h = $height);

					foreach($stickers as $sticker)
					{

						if($sticker['scale'] != 1)
						{
							$src_img = imagecreatefrompng($sticker['url']);
							$src_width = imagesx($src_img);
							$src_height = imagesy($src_img);

							$sticker_width = $src_width * $sticker['scale'];
							$sticker_height = $src_height * $sticker['scale'];

							$sticker_img = imagecreatetruecolor($sticker_width, $sticker_height);

							imagealphablending($sticker_img, false);
							imagesavealpha($sticker_img, true);

							// allocate certain color with alpha level
							$transparant = imagecolorallocatealpha($sticker_img, $red = 0, $green = 0, $blue = 0, 127);

							// create fullsize alpha (transparant) rectangle
							imagefilledrectangle($sticker_img, $x1 = 0, $y1 = 0, $x2 = $width, $y2 = $height, $color = $transparant);

							imagecopyresized($sticker_img, $src_img, 0, 0, 0, 0,
			$sticker_width, $sticker_height, $src_width, $src_height);

						}
						else
						{
							$sticker_img = imagecreatefrompng($sticker['url']);

							imagealphablending($sticker_img, false);
							imagesavealpha($sticker_img, true);

							// allocate certain color with alpha level
							$transparant = imagecolorallocatealpha($sticker_img, $red = 0, $green = 0, $blue = 0, 127);

						}

						if($sticker['rotation'] != 0)
							$sticker_img = images::imagerotateEquivalent($sticker_img, $sticker['rotation'], $transparant);

						// imagecolortransparent($sticker_img, imagecolorallocate($sticker_img, 0, 255, 0));

						images::imagecopymerge_alpha($canvas, $sticker_img, $sticker['x'], $sticker['y'], 0, 0, imagesx($sticker_img), imagesy($sticker_img), 0);

						imagedestroy($sticker_img);

						if($sticker['scale'] != 1)
							imagedestroy($src_img);

					}

					$tmp_dir = APPPATH.'/tmp';

		/*			if(!is_dir($tmp_dir)){
						mkdir($tmp_dir, 0777, true);
					} else if (!is_writable($tmp_dir)) {
						chmod($tmp_dir, 0777);
					}*/

					$img_path = $tmp_dir.'/'.sha1(rand()).rand().'.png';
					
					// save the image
					imagepng($canvas, $img_path);

					$url = 'http://api.via.me/v1/post';

					$params = array(
						'access_token' => $this->_access_token,
						'media_type' => 'photo',
						'media' => '@'.$img_path,
						'text' => 'Look at this hipster! Hipsterize your picture at http://instahipster.me',
					);

					$r = curl::get_ssl($url, $params);

					$response = json_decode($r, true);

					if($via_id = Arr::path($response, 'response.post.id'))
					{
						return $this->response->headers('Content-type', 'application/json')->body(json_encode(array('via_id'=>$via_id)));
					}

/*					$file_name = basename($img_path);

					return $this->response->headers('Content-type', 'application/json')->body(json_encode(array('image'=>$file_name)));
*/
				}					

				return $this->response->headers('Content-type', 'application/json')->body(json_encode(array('error'=>'pic_size')));

			}

			return $this->response->headers('Content-type', 'application/json')->body(json_encode(array('error'=>'picture_url')));
		}

		return $this->response->headers('Content-type', 'application/json')->body(json_encode(array('error'=>'post')));
	}

	public function action_index()
	{

	}

	public function after()
	{

		if($this->_view)
		{
			$this->_view
					->set('_user', $this->_user)
					->set('_access_token', $this->_access_token)
					->set('_img', $this->_img);
		}

		parent::after();
	}

	public function action_upload()
	{

		if($file = Arr::get($_FILES, 'file') AND !empty($file['tmp_name']))
		{

			$tmp_dir = APPPATH.'/tmp';
/*
			if(!is_dir($tmp_dir)){
				mkdir($tmp_dir, 0777, true);
			} else if (!is_writable($tmp_dir)) {
				chmod($tmp_dir, 0777);
			}*/

			$img_path = $tmp_dir.'/'.sha1($file['name'].rand()).$file['name'];

			file_put_contents($img_path, file_get_contents($file['tmp_name']));

			$url = '/hipsterize/edit/?'.http_build_query(array(
				'img' => 'http://instahipster.me/img/'.basename($img_path),
			));

			$this->request->redirect($url);

		}

		$this->request->redirect('/hipsterize');
	}


}
