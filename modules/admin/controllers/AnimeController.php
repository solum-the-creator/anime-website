<?php

namespace app\modules\admin\controllers;

use app\models\Category;
use app\models\ImageUpload;
use app\models\Rating;
use app\models\Type;
use Yii;
use app\models\Anime;
use app\models\AnimeSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AnimeController implements the CRUD actions for Anime model.
 */
class AnimeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Anime models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnimeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSetImage($id){

        $model = new ImageUpload();

        if (Yii::$app->request->isPost){
            $anime = $this->findModel($id);

            $file = UploadedFile::getInstance($model,'image');

            if ($anime->saveImage($model->uploadFile($file,$anime->animeImage))){
                return $this->redirect(['anime/view','id'=>$id]);
            }

        }

        return $this->render('image', ['model'=>$model]);
    }



    public function actionSetCategory($id){
        $anime = $this->findModel($id);
        $selectedCategory = $anime->category->categoryId;
        $categories = ArrayHelper::map(Category::find()->all(),'categoryId','title');
        if(Yii::$app->request->isPost){

            $category = Yii::$app->request->post('category');

            if($anime->saveCategory($category)){
                return $this->redirect(['anime/view','id'=>$id]);
            }

        }

        return $this->render('category',[
           'anime'=>$anime,
            'selectedCategory'=>$selectedCategory,
            'categories'=>$categories,
        ]);
    }
    /**
     * Displays a single Anime model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Anime model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Anime();
        $categories = ArrayHelper::map(Category::find()->all(),'categoryId','title');
        $types = ArrayHelper::map(Type::find()->all(),'id','title');
        $ratings = ArrayHelper::map(Rating::find()->all(),'id','title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idAnime]);
        }

        return $this->render('create', [
            'model' => $model,
            'categories'=>$categories,
            'types' => $types,
            'ratings' => $ratings,
        ]);
    }

    /**
     * Updates an existing Anime model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = ArrayHelper::map(Category::find()->all(),'categoryId','title');
        $types = ArrayHelper::map(Type::find()->all(),'id','title');
        $ratings = ArrayHelper::map(Rating::find()->all(),'id','title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idAnime]);
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories,
            'types' => $types,
            'ratings' => $ratings,
        ]);
    }

    /**
     * Deletes an existing Anime model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Anime model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Anime the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Anime::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
