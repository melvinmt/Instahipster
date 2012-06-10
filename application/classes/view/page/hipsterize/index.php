<?php defined('SYSPATH') or die('No direct script access.');

class View_Page_Hipsterize_Index extends Abstract_View_Page {

	public $title = 'Hipsterize';

	public function viame_pictures()
	{
		$url = 'http://api.via.me/v1/users/me/feed';

		$params = array(
			'access_token' => $this->_access_token,
		);

		$request = Request::factory($url)->query($params)->execute();

		$pictures = array();

		if($posts = Arr::path(json_decode($request->body(), true), 'response.posts.items'))
		{
			foreach ($posts as $post)
			{
				if(Arr::path($post, 'item.media_type') === 'photo')
				{
					$picture = Arr::get($post, 'item');
					$picture['edit_url'] = '/hipsterize/edit?img='.urlencode($picture['media_url']);

					$pictures[] = $picture;
				}
			}
		}

		return $pictures;
	}

}
