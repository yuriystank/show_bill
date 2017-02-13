<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "show".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $description
 *
 * @property Event[] $events
 */
class Show extends \yii\db\ActiveRecord
{
    public $upload_image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'show';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['title', 'image'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['upload_image'], 'safe'],
            [['upload_image'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['show_id' => 'id']);
    }

    public function delete()
    {
        @unlink(Yii::$app->params['uploadPath'].$this->image);

        parent::delete();
    }
}
