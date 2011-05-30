<?php defined('SYSPATH') or die('No direct script access.');

class Minion_Task_App_Watch extends Minion_Task {

	public function execute(array $config)
	{
		$watch_path = APPPATH.'media/js';
		$events = '-e modify -e move -e create -e delete';
		$cmd = 'inotifywait '.$events.' -r -q --format \'%w%f\' "'.$watch_path.'"';
		while ($altered = exec($cmd))
		{
			Minion_CLI::write($altered);

			// Concat all the files
			$files = Kohana::list_files('media/js/app');
			$contents = $this->recursive_concat_contents($files, 'js');

			$tmp_path = APPPATH.'media/js/app.components.js.tmp';
			$components_path = APPPATH.'media/js/app.components.js';
			$app_path = APPPATH.'media/js/app.js';
			$app_compiled_path = APPPATH.'media/js/app.min.js';

			file_put_contents($tmp_path, $contents);
			file_put_contents($components_path, exec('uglifyjs "'.$tmp_path.'"'));
			file_put_contents($app_compiled_path, exec('uglifyjs "'.$app_path.'"'));

			unlink($tmp_path);
			sleep(1);
		}
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

				$content .= file_get_contents($path);
			}
		}

		return $content;
	}
}