<?php

namespace app\modules\news\controllers;

use Yii;
use app\modules\news\models\News;
use app\modules\news\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ManageController implements the CRUD actions for News model.
 */
class ManageController extends Controller
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $searchModel->getAuthors();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionList()
    {
        $searchModel = new NewsSearch();
        $searchModel->getAuthors();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDetail($permalink)
    {
        return $this->render('detail', [
            'model' => News::find()->where('permalink=:permalink', [':permalink' => $permalink])->one()
        ]);
    }

        /**
         * Displays a single News model.
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->main_image = UploadedFile::getInstance($model, 'main_image');
            if($model->validate()) {
                $filename = Yii::getAlias('@webroot').'/assets/'.uniqid($model->permalink).'.'.$model->main_image->getExtension();
                $model->main_image->saveAs($filename);
                $model->main_image = $filename;
                $model->save(false);
                \Yii::$app->session->setFlash('success', 'News Created Successfully');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->main_image = UploadedFile::getInstance($model, 'main_image');
            if($model->validate()) {
                $filename = Yii::getAlias('@webroot').'/assets/'.uniqid($model->permalink).'.'.$model->main_image->getExtension();
                $model->main_image->saveAs($filename);
                $model->main_image = $filename;
                $model->save();
                \Yii::$app->session->setFlash('success', 'News Updated Successfully');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            \Yii::$app->session->setFlash('error', implode('<br/>',$model->getErrors()));
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing News model.
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
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
