<?php defined('SYSPATH') or die('No direct script access.');

class Minion_Task_App_Watch extends Minion_Task {

	public function execute(array $config)
	{
		$watch_path = APPPATH.'media/js/app';
		$events = '-e modify -e move -e create -e delete';
		$compile_dir = APPPATH.'media/js/app/compiled/';
		$cmd = 'inotifywait '.$events.' -r -q --format \'%w%f\' @"'.$compile_dir.'" "'.$watch_path.'"';

		// Compile right away
		$this->compile();

		Minion_CLI::write('Watching: '.$watch_path);
		while ($altered = exec($cmd))
		{
			Minion_CLI::write($altered);
			$this->compile();
		}
	}

	protected function compile()
	{
		// Start with the bootstrap at the top of the file
		$js = file_get_contents(APPPATH.'media/js/app/bootstrap.js');

		// Concat all the component files (MVC)
		$files = Kohana::list_files('media/js/app/components');
		$js .= $this->recursive_concat_contents($files, 'js');
		$views = trim($this->recursive_concat_contents($files, 'mustache'));

		// Append the app.js file so it runs last
		$js .= "\n".file_get_contents(APPPATH.'media/js/app/app.js');

		$compile_dir = APPPATH.'media/js/app/compiled/';

		// The JS without minification (use in dev environments)
		$js_concat_path = $compile_dir.'app.js';
		// Minified JS for production
		$js_min_path = $compile_dir.'app.min.js';
		// Concatinated views templates
		$views_concat_path = $compile_dir.'templates.mustache';

		file_put_contents($js_concat_path, $js);
		file_put_contents($views_concat_path, $views);
		// Not mangling variable names and not removing unused code
		file_put_contents($js_min_path, exec('uglifyjs --no-mangle --no-dead-code "'.$js_concat_path.'"'));
	}

	protected function recursive_concat_contents(array $files, $ext)
	{
		$content = '';
		foreach ($files as $path)
		{
			if (is_array($path))
			{
				$content .= $this->recursive_concat_contents($path, $ext);
			}
			else
			{
				$extension = pathinfo($path, PATHINFO_EXTENSION);
				if ($extension !== $ext)
					continue;

				$content .= "\n".file_get_contents($path);
			}
		}

		return $content;
	}
}