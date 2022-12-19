<?php

namespace app\controllers;

use app\models\Anime;
use app\models\Category;
use app\models\CommentsForm;
use app\models\Evaluation;
use app\models\FilterForm;
use app\models\ImageUpload;
use app\models\ListForm;
use app\models\Login;
use app\models\Rating;
use app\models\RatingForm;
use app\models\Reviews;
use app\models\Signup;
use app\models\SortForm;
use app\models\Type;
use app\models\Userlist;
use Yii;
use yii\base\BaseObject;
use yii\data\Pagination;

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


class SiteController extends Controller
{
    public function actionIndex(){
        $anime = Anime::find()->limit(16)->all();
        return $this->render('index', compact('anime'));
    }

    public function actionLogout(){
        if(!Yii::$app->user->isGuest){
            Yii::$app->user->logout();
            return $this->goHome();
        }
    }

    public function actionBrowse(){


            $model = new SortForm();
            $model2 = new FilterForm();
            $str = isset($_SESSION['sortStr']) ? $_SESSION['sortStr'] : null;

            $categories = ArrayHelper::map(Category::find()->all(),'categoryId','title');
            $types = ArrayHelper::map(Type::find()->all(),'id','title');
            $ratings = ArrayHelper::map(Rating::find()->all(),'id','title');



            if($model->load(Yii::$app->request->post()) && $model->validate()){

                if(isset($model->str)){

                    switch ($model->str){
                        case 0:
                            $str = 'dateAdded';
                            Yii::$app->session->set('sortStr',$str);
                            break;
                        case 1:
                            $str = 'Name';
                            Yii::$app->session->set('sortStr',$str);
                            break;
                        case 2:
                            $str = 'releaseDate';
                            Yii::$app->session->set('sortStr',$str);
                            break;
                        default:
                            $str = null;
                            Yii::$app->session->set('sortStr',$str);
                            break;

                    }
                }


            }



        if($model2->load(Yii::$app->request->post()) && $model2->validate()){

            if(isset($model2->categoryStr) && $model2->categoryStr!=0){
                    $arrParams['categoryId'] = $model2->categoryStr;
            }
            if ($model2->categoryStr ==0){
                unset($arrParams['categoryId']);
            }


            if(isset($model2->typeStr) && $model2->typeStr!=0){
                $arrParams['typeId'] = $model2->typeStr;
            }
            if ($model2->typeStr ==0){
                unset($arrParams['typeId']);
            }

            if(isset($model2->ratingStr) && $model2->ratingStr!=0){
                $arrParams['ratingId'] = $model2->ratingStr;
            }
            if ($model2->ratingStr ==0){
                unset($arrParams['ratingId']);
            }

            Yii::$app->session->set('params',$arrParams);

        }



            $query = Anime::find()->orderBy($str)->where($_SESSION['params']);
            $countQuery = $query->count();
            $pagination = new Pagination(['totalCount' => $countQuery,'pageSize'=>5]);
            $animes = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();



            return $this->render('browse', [
                'animes' => $animes,
                'pagination' => $pagination,
                'model' => $model,
                'categories' => $categories,
                'model2' => $model2,
                'types' => $types,
                'ratings' => $ratings,
            ]);
    }

    public function actionView($id){
        $anime = Anime::findOne($id);

        $comments = $anime->getComments()->orderBy('idReview desc')
            ->all();
        $commentsForm = new CommentsForm();

        $ratingForm = new RatingForm();

        $rating = $anime->getEvaluation()->where(['idUser'=>Yii::$app->user->id])->one();

        $userListForm = new ListForm();

        $categoryList = $anime->getUserlists()->where(['idUser'=>Yii::$app->user->id])->one();

        return $this->render('single',[
            'anime'=>$anime,
            'comments' => $comments,
            'commentsForm'=>$commentsForm,
            'ratingForm'=>$ratingForm,
            'rating' => $rating,
            'userListForm' => $userListForm,
            'categoryList' => $categoryList,
        ]);
    }

    public  function actionList($id){
        $model = new ListForm();
        if(!Yii::$app->user->isGuest){
            if(Yii::$app->request->isPost)
            {
                $model->load(Yii::$app->request->post());

                if($model->saveList($id)){
                    return $this->redirect(['site/view','id'=>$id]);
                }
            }
        }
        else{
            return $this->redirect(['site/login']);
        }

    }

    public function actionComment($id){
        $model = new CommentsForm();

            if(Yii::$app->request->isPost)
            {
                $model->load(Yii::$app->request->post());
                if($model->saveComment($id)){
                    return $this->redirect(['site/view','id'=>$id]);
                }
            }
    }

    public function actionRating($id){
        $model = new RatingForm();
    if(!Yii::$app->user->isGuest){
        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());

            if($model->saveRating($id))
            {

                return $this->redirect(['site/view','id'=>$id]);
            }

        }
    }
    else{
        return $this->redirect(['site/login']);
    }
    }

    public function actionSignup(){
        $model = new Signup();

        if(isset($_POST['Signup'])){
            $model->attributes = Yii::$app->request->post('Signup');

            if($model->validate() && $model->signup()){

                return $this->redirect('/site/login');
            }
        }
        return $this->render('signup',['model'=>$model]);
    }

    public function actionAccount(){

        $model = new ImageUpload();
        $backImg = new ImageUpload();

        if (Yii::$app->user->isGuest){
            return $this->redirect('/site/login');
        }
        return $this->render('account',['model'=>$model,'backimg'=>$backImg]);
    }

    public function actionUpdateimg($id){
        $model = new ImageUpload();
        if (Yii::$app->request->isPost){
            $user = Yii::$app->user->identity;
            $file = UploadedFile::getInstance($model,'image');
            if ($user->saveImage($model->uploadFile($file,$user->userImage))){
                return $this->redirect(['site/account']);
            }
        }
    }

    public function actionUpdateback($id){
        $model = new ImageUpload();
        if (Yii::$app->request->isPost){
            $user = Yii::$app->user->identity;
            $file = UploadedFile::getInstance($model,'image');
            if ($user->saveBack($model->uploadFile($file,$user->userBackImg))){
                return $this->redirect(['site/account']);
            }
        }
    }

    public function actionAnimelist(){

        $animes = Userlist::find()->where(['idUser'=>Yii::$app->user->id])->all();


        return $this->render('animelist',['animes'=>$animes]);
    }

    public function actionReviewlist(){
        $animes = Reviews::find()->where(['idUser'=>Yii::$app->user->id])->orderBy('idReview desc')->all();

        return $this->render('reviewlist',['animes'=>$animes]);
    }

    public function actionDeletereview($id_review)
    {
        $comment = Reviews::findOne($id_review);
        if($comment->delete()){
            return $this->redirect(['site/reviewlist']);
        }

    }

    public function actionSearch(){

        $search = Yii::$app->request->get('search');

        $search1 = str_replace(' ','', $search);

        $resAnime = Anime::find()->where(['like', 'replace(Name, " ", "")',$search1])->all();

        return $this->render('search', ['resAnime'=>$resAnime, 'search' => $search]);
    }

    public function actionLogin(){
        $login_model = new Login();

        if (Yii::$app->request->post('Login')){
            $login_model->attributes = Yii::$app->request->post('Login');

            if($login_model->validate()){
                Yii::$app->user->login($login_model->getUser());
                return $this->goHome();

            }
        }

        return $this->render('login',['login_model'=>$login_model]);
    }

    public function actionError(){
        /* @var HttpException $exception */
        $exception = \Yii::$app->getErrorHandler()->exception;

        return $this->render('error' );
    }
}
