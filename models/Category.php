<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property int $categoryId
 * @property string $title
 *
 * @property Anime[] $animes
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'categoryId' => 'Category ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Animes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimes()
    {
        return $this->hasMany(Anime::className(), ['categoryId' => 'categoryId']);
    }



}
