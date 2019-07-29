<?php
if(isset($_GET['key']) && $_GET['key'] == 'pRAeQjcTVPiB5tNyWoG4'){
	$humhubh = '/usr/bin/php-7.2 '.__DIR__.'/protected/yii cron/run >/dev/null 2>&1';
	exec($humhubh, $output, $return_var);
	var_dump($output);
	echo "\n";
	var_dump($return_var);
} else {
	echo 'Not authorized';
}