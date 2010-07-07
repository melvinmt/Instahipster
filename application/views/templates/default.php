<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en-us" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?= <?= html::chars($title) ?></title>
</head>
<body>
	<h1><?= html::chars($title) ?></h1>
	<div><?= $content ?></div>
</body>
</html>