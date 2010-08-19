<?php PHP_SAPI === 'cli' or die('No direct script access.');

// This is usually defined in the VHOST so we need it also done in the crons
$arguments = getopt("e:");
putenv('ENVIRONMENT='.$arguments['e']);

// Continue the normal Kohana execution
require 'index.php';
