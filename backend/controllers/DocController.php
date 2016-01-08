<?php

namespace backend\controllers;

use Yii;
use common\models\Doc;
use common\search\Doc as DocSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocController implements the CRUD actions for Doc model.
 */
class DocController extends Controller {
    public $enableCsrfValidation = false;
    public function actions() {
        return [
            'upload' => [
                'class' => \xj\ueditor\actions\Upload::className(),
                'uploadBasePath' => Yii::$app->basePath . '/' .  Yii::$app->params['uploadPath'] . '/',
                'uploadBaseUrl' => '/doc/upload/', //web path
                'csrf' => true, //csrf校验
                'configPatch' => [
                    'imageMaxSize' => 500 * 1024, //图片
                    'scrawlMaxSize' => 500 * 1024, //涂鸦
                    'catcherMaxSize' => 500 * 1024, //远程
                    'videoMaxSize' => 1024 * 1024, //视频
                    'fileMaxSize' => 1024 * 1024, //文件
                    'imageManagerListPath' => '/', //图片列表
                    'fileManagerListPath' => '/', //文件列表
                ],
                // OR Closure
                'pathFormat' => [
                    'imagePathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'scrawlPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'snapscreenPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'snapscreenPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'catcherPathFormat' => 'image/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'videoPathFormat' => 'video/{yyyy}{mm}{dd}/{time}{rand:6}',
                    'filePathFormat' => 'file/{yyyy}{mm}{dd}/{time}{rand:6}',
                ],
                // For Closure
                'pathFormat' => [
                    'imagePathFormat' => [$this, 'format'],
                    'scrawlPathFormat' => [$this, 'format'],
                    'snapscreenPathFormat' => [$this, 'format'],
                    'snapscreenPathFormat' => [$this, 'format'],
                    'catcherPathFormat' => [$this, 'format'],
                    'videoPathFormat' => [$this, 'format'],
                    'filePathFormat' => [$this, 'format'],
                ],
                'beforeUpload' => function($action) {
//          throw new \yii\base\Exception('error message'); //break
        },
                'afterUpload' => function($action) {
            /* @var $action \xj\ueditor\actions\Upload */

            //var_dump($action->result);
            //  'state' => string 'SUCCESS' (length=7)
            //  'url' => string '/attachment/201109/1425310269294251.jpg' (length=61)
            //  'relativePath' => string '201109/1425310269294251.jpg' ()
            //  'title' => string '1425310269294251.jpg' (length=20)
            //  'original' => string 'Chrysanthemum.jpg' (length=17)
            //  'type' => string '.jpg' (length=4)
            //  'size' => int 879394

            //throw new \yii\base\Exception('error message'); //break
        },
            ],
        ];
    }

// for Closure Format
    public function format(\xj\ueditor\actions\Uploader $action) {
        $fileext = $action->fileType;
        $filehash = sha1(uniqid() . time());
        $p1 = substr($filehash, 0, 2);
        $p2 = substr($filehash, 2, 2);
        return "{$p1}/{$p2}/{$filehash}.{$fileext}";
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Doc models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new DocSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Doc model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Doc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Doc();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Doc model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Doc model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Doc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Doc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Doc::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
