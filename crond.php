<?php
if(isset($_GET['key']) && $_GET['key'] == 'pRAeQjcTVPiB5tNyWoG4'){
	$humhubd = '/usr/bin/php-7.2 '.__DIR__.'/protected/yii queue/run >/dev/null 2>&1';
	exec($humhubd, $output, $return_var);
	var_dump($output);
	echo "\n";
	var_dump($return_var);
} else {
	echo 'Not authorized';
}