<?php

namespace app\modules\news\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $permalink
 * @property string $teaser
 * @property string $article
 * @property string $main_image
 * @property string $author
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'permalink', 'teaser', 'article', 'main_image', 'author'], 'required'],
            [['author'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['permalink'], 'string', 'max' => 130],
            [['teaser'], 'string', 'max' => 500],
            [['article'], 'string', 'max' => 4000],
            [['main_image'], 'file', 'maxSize' => 2560000, 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg, png'],
            [['permalink'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'permalink' => Yii::t('app', 'Permalink'),
            'teaser' => Yii::t('app', 'Teaser'),
            'article' => Yii::t('app', 'Article'),
            'main_image' => Yii::t('app', 'Main Image'),
            'author' => Yii::t('app', 'Author'),
        ];
    }
    function getAuthors(){
        $databasename = self::getDb()->createCommand("SELECT DATABASE()")->queryScalar();
        $query = "SELECT COLUMN_TYPE 
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_SCHEMA = '".$databasename."' 
AND TABLE_NAME = '".self::tableName()."' 
AND COLUMN_NAME = 'author';";

        $authors_enum = self::getDb()->createCommand($query)->query()->read();
        if (preg_match('/enum\((.*?)\)/', $authors_enum['COLUMN_TYPE'], $match) == 1) {
            $authors = explode(',',str_replace("'","",$match[1]));
        }
        return array_combine($authors,$authors);
        //ArrayHelper::map($authors);
    }
}
