<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "anime".
 *
 * @property int $idAnime
 * @property string $Name
 * @property string $animeGenre
 * @property int $typeId
 * @property string $dateAdded
 * @property string $description
 * @property int $duration
 * @property int $ratingId
 * @property string $releaseDate
 * @property string $animeImage
 * @property int $categoryId
 *
 * @property Category $category
 * @property Evaluation[] $evaluations
 * @property User[] $idUsers
 * @property Reviews[] $reviews
 * @property Userlist[] $userlists
 * @property User[] $idUsers0
 */
class Anime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anime';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name',  'description',], 'required'],
            [['dateAdded', 'releaseDate'], 'date', 'format' => 'php:Y-m-d'],
            [['dateAdded'],'default','value' => date('Y-m-d')],
            [['duration', 'categoryId','typeId','ratingId',], 'integer'],
            [['Name'], 'string', 'max' => 50],
            [['animeGenre'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 3000],
            [['animeImage'], 'string', 'max' => 1000],
            [['animeImage'],'default','value' => 'no-image.png'],
            [['categoryId'],'default','value' => 1],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['categoryId' => 'categoryId']],
            [['typeId'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['typeId' => 'id']],
            [['ratingId'], 'exist', 'skipOnError' => true, 'targetClass' => Rating::className(), 'targetAttribute' => ['ratingId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idAnime' => 'Id Anime',
            'Name' => 'Name',
            'animeGenre' => 'Anime Genre',
            'animeType' => 'Anime Type',
            'dateAdded' => 'Date Added',
            'description' => 'Description',
            'duration' => 'Duration',
            'ratingMPAA' => 'Rating Mpaa',
            'releaseDate' => 'Release Date',
            'animeImage' => 'Anime Image',
            'categoryId' => 'Category ID',
            'typeId' => 'Type ID',
            'ratingId' => 'Rating ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['categoryId' => 'categoryId']);
    }

    public function getType(){
        return $this->hasOne(Type::className(), ['id' => 'typeId']);
    }

    public function getRating(){
        return $this->hasOne(Rating::className(), ['id' => 'ratingId']);
    }

    public function saveCategory($category_id){
        $category = Category::findOne($category_id);
        if($category != null){
            $this->link('category',$category);
            return true;
        }

    }


    public function getComments()
    {
        return $this->hasMany(Reviews::className(),['idAnime'=>'idAnime']);
    }

    public function getAvgRating(){
        return round($this->getEvaluation()->average('valueEvaluat'),1) ;
    }


    /**
     * Gets query for [[Evaluations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluation()
    {
        return $this->hasMany(Evaluation::className(), ['idAnime' => 'idAnime']);
    }

    public function getUserRating()
    {
        $anime = $this->getEvaluation()->where(['idUser'=>Yii::$app->user->id])->one();
        return $anime->valueEvaluat;
    }


    /**
     * Gets query for [[IdUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsers()
    {
        return $this->hasMany(User::className(), ['UserId' => 'idUser'])->viaTable('evaluation', ['idAnime' => 'idAnime']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['idAnime' => 'idAnime']);
    }

    /**
     * Gets query for [[Userlists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserlists()
    {
        return $this->hasMany(Userlist::className(), ['idAnime' => 'idAnime']);
    }

    /**
     * Gets query for [[IdUsers0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsers0()
    {
        return $this->hasMany(User::className(), ['UserId' => 'idUser'])->viaTable('userlist', ['idAnime' => 'idAnime']);
    }

    public function saveImage($fileName){
        $this->animeImage = $fileName;
        return $this->save(false);
    }

    public function getImage(){
        if($this->animeImage){
            return '/uploads/'.$this->animeImage;
        }
        return '/no-image.png';
    }

    public function deleteImage(){
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->animeImage);
    }

    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }
}
