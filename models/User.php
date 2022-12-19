<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $UserId
 * @property string $username
 * @property string $password
 * @property string $Fullname
 * @property string $Email
 * @property string $status
 * @property string $userImage
 * @property string $userBackImg
 * @property string $regDate
 *
 * @property Evaluation[] $evaluations
 * @property Anime[] $idAnimes
 * @property Reviews[] $reviews
 * @property Userlist[] $userlists
 * @property Anime[] $idAnimes0
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);

    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public function getId()
    {
        return $this->UserId;
    }

    public function getAuthKey()
    {
        /*return $this->authKey;*/
    }

    public function validateAuthKey($authKey)
    {
        /*return $this->authKey === $authKey;*/
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'Fullname', 'Email', 'status'], 'required'],
            [['regDate'], 'safe'],
            [['username'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 255],
            [['Fullname', 'Email'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 10],
            [['userImage'], 'string', 'max' => 1000],
            [['userBackImg'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'UserId' => 'User ID',
            'username' => 'Username',
            'password' => 'Password',
            'Fullname' => 'Fullname',
            'Email' => 'Email',
            'status' => 'Status',
            'userImage' => 'User Image',
            'userBackImg' => 'User Back Img',
            'regDate' => 'Reg Date',
        ];
    }


    public function setPassword($password){
        $this->password = sha1($password);
    }

    public function isAdmin(){
        return $this->status == 'admin';
    }

    public function validatePassword($password){
        return $this->password === sha1($password);
    }

    public function getImage(){
        if($this->userImage){
            return '/uploads/'.$this->userImage;
        }
        return '/uploads/no-image.png';
    }

    public function getBackImage(){
        return '/uploads/'.$this->userBackImg;
    }

    public function saveImage($fileName){
        $this->userImage = $fileName;
        return $this->save(false);
    }

    public function saveBack($fileName){
        $this->userBackImg = $fileName;
        return $this->save(false);
    }

    /**
     * Gets query for [[Evaluations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluations()
    {
        return $this->hasMany(Evaluation::className(), ['idUser' => 'UserId']);
    }

    /**
     * Gets query for [[IdAnimes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdAnimes()
    {
        return $this->hasMany(Anime::className(), ['idAnime' => 'idAnime'])->viaTable('evaluation', ['idUser' => 'UserId']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['idUser' => 'UserId']);
    }

    /**
     * Gets query for [[Userlists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserlists()
    {
        return $this->hasMany(Userlist::className(), ['idUser' => 'UserId']);
    }

    /**
     * Gets query for [[IdAnimes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdAnimes0()
    {
        return $this->hasMany(Anime::className(), ['idAnime' => 'idAnime'])->viaTable('userlist', ['idUser' => 'UserId']);
    }
}
