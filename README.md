# yii2-news
Yii2 News Module

Add Following Entry to your route section in web modules config file
````php
'modules' => [
....
'news' => [
            'class' => 'app\modules\news\News',
        ],
 'redactor' => ['class'=>'yii\redactor\RedactorModule',
             'uploadDir' => '@webroot/uploads',
                   'uploadUrl' => '/uploads'],
 ....
  ],
  ````
  Add Following Entry to your route section web modules config file
  ````php
  'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
                 ....
	               'news/index'=>'news/manage/list',
 	               'news/list'=>'news/manage/list',
	    	         'news/lihat/<permalink>'=>'news/manage/detail',
		             ....
            ],
        ],      
````        

Change your database config as needed
