<?php return array (
  'components' => 
  array (
    'db' => 
    array (
      'class' => 'yii\\db\\Connection',
      /*
      'dsn' => 'mysql:host=6801o.myd.infomaniak.com;dbname=6801o_humhub',
      'username' => '6801o_humhub',
      'password' => 'wq3D32LPtqFo',
        */
        'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=opoint',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8'
    ),
    'user' => 
    array (
    ),
    'mailer' => 
    array (
      'transport' => 
      array (
        'class' => 'Swift_MailTransport',
      ),
    ),
    'cache' => 
    array (
      'class' => 'yii\\caching\\FileCache',
      'keyPrefix' => 'humhub',
    ),
    'formatter' => 
    array (
      'defaultTimeZone' => 'Europe/Zurich',
    ),
    'formatterApp' => 
    array (
      'defaultTimeZone' => 'Europe/Zurich',
      'timeZone' => 'Europe/Zurich',
    ),
  ),
  'params' => 
  array (
    'installer' => 
    array (
      'db' => 
      array (
        'installer_hostname' => 'grnz.myd.infomaniak.com',
        'installer_database' => 'grnz_humhub',
      ),
    ),
    'config_created_at' => 1556631270,
    'horImageScrollOnMobile' => '1',
    'databaseInstalled' => true,
    'installed' => true,
  ),
  'name' => 'O-Point',
  'language' => 'fr',
  'timeZone' => 'Europe/Zurich',
); ?>