<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property integer $sort
 *
 * @property Event[] $events
 */
class Area extends \yii\db\ActiveRecord
{
    public $upload_image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['sort'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['title'], 'required'],
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
            'sort' => 'Sort',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['area_id' => 'id']);
    }

    public function delete()
    {
        @unlink(Yii::$app->params['uploadPath'].$this->image);

        parent::delete();
    }

    public function beforeSave($insert)
    {
        $same_sort = Area::find()->where(['sort' => $this->sort])->one();
        if (!empty($same_sort) && $same_sort->title != $this->title && $same_sort->id != $this->id) {
            // update sort
            $old_sort = $this->getOldAttribute('sort');
            if (!empty($old_sort) && $old_sort < $this->sort) {
                Yii::$app->db->createCommand("UPDATE area SET sort=sort+2 WHERE sort > '$this->sort' ")->execute();
                $this->sort += 1;
            } else {
                Yii::$app->db->createCommand("UPDATE area SET sort=sort+1 WHERE sort >= '$this->sort' ")->execute();
            }
        }

        if (parent::beforeSave($insert)) {
            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if (array_key_exists('sort', $changedAttributes)) {
            $this->updateSort();
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->updateSort();
    }

    protected function updateSort()
    {
        Yii::$app->db->createCommand("SET @pos := 0;UPDATE area SET sort = ( SELECT @pos := @pos + 1 ) ORDER BY sort ASC;")->execute();

        return true;
    }
}
