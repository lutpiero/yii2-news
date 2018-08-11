<?php

namespace app\modules\news;

/**
 * employee module definition class
 */
class News extends \yii\base\Module
{
    //public $layout = '@app/modules/ocr/views/layouts/main';
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\news\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
