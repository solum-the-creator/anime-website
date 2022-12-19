<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userlist".
 *
 * @property int $idUserList
 * @property int $idAnime
 * @property int $idUser
 * @property string $category
 * @property string $dateAdded
 *
 * @property User $idUser0
 * @property Anime $idAnime0
 */
class Userlist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userlist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idAnime', 'idUser', 'category', 'dateAdded'], 'required'],
            [['idAnime', 'idUser'], 'integer'],
            [['dateAdded'], 'safe'],
            [['category'], 'string', 'max' => 50],
            [['idAnime', 'idUser'], 'unique', 'targetAttribute' => ['idAnime', 'idUser']],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'UserId']],
            [['idAnime'], 'exist', 'skipOnError' => true, 'targetClass' => Anime::className(), 'targetAttribute' => ['idAnime' => 'idAnime']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUserList' => 'Id User List',
            'idAnime' => 'Id Anime',
            'idUser' => 'Id User',
            'category' => 'Category',
            'dateAdded' => 'Date Added',
        ];
    }

    /**
     * Gets query for [[IdUser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser0()
    {
        return $this->hasOne(User::className(), ['UserId' => 'idUser']);
    }

    /**
     * Gets query for [[IdAnime0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnime()
    {
        return $this->hasOne(Anime::className(), ['idAnime' => 'idAnime']);
    }
}
