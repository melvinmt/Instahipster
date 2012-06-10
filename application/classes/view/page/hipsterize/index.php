<?php defined('SYSPATH') or die('No direct script access.');

class View_Page_Hipsterize_Index extends Abstract_View_Page {

	public $title = 'Hipsterize';
	protected $viame_pictures;

	public function pictures()
	{

		if( $this->viame_pictures)
			return $this->viame_pictures;

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

		$url = 'http://api.via.me/v1/posts/popular';

		$params = array(
			'client_id' => Kohana::$config->load('viame.client_id'),
		);

		$request = Request::factory($url)->query($params)->execute();

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

		return $this->viame_pictures = $pictures;
	}

	public function has_pictures()
	{
		$pictures = $this->pictures();

		return !empty($pictures);
	}

}
