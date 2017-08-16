<?php

namespace frontend\controllers;

use Yii;
use frontend\models\thread\Thread;
use frontend\models\thread\ThreadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\HttpException;
use frontend\models\thread\Comments;
use yii\data\ActiveDataProvider;

/**
 * ThreadController implements the CRUD actions for Thread model.
 */
class ThreadController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['index'],
						'allow' => true,
						'roles' => ['?','@'],
					],
					[
						'actions' => ['index','view','update'],
						'allow' => true,
						'roles' => ['author'],
					],
					[
						'actions' => ['create'],
						'allow' => true,
						'roles' => ['createPost'],
					],
					[
						'actions' => ['delete'],
						'allow' => true,
						'roles' => ['deletePost'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return array_merge(parent::actions(),[
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		]);
	}

	/**
	 * Lists all Thread models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new ThreadSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Thread model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		$thread = $this->findModel($id);
		$comments = new Comments();
		$comments_dp = new ActiveDataProvider([
			'query' => Comments::find()->where(['thread_id' => $id]),
			'pagination' => [
				'pageSize' => 5,
			],
		]);

		$canupdate = Yii::$app->user->can('updatePost', ['thread' => $thread]);

		$candelete = Yii::$app->user->can('deletePost',['thread' => $thread]);

		if ($comments->load(Yii::$app->request->post()) && $comments->save()) {
			Yii::$app->session->setFlash('success', Yii::t('app','Your comment has been submitted.'));
			return $this->refresh();
		} else if ($comments->load(Yii::$app->request->post()) && !$comments->save()){
			Yii::$app->session->setFlash('error', Yii::t('app','Save comment failed.'));
		} else {
			return $this->render('view', [
				'model' => $thread,
				'canupdate'	=> $canupdate,
				'candelete' => $candelete,
				'comments' => $comments,
				'comments_dp' => $comments_dp,
			]);
		}
	}

	/**
	 * Creates a new Thread model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Thread();
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Thread model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if(Yii::$app->user->can('updatePost', ['thread' => $model])){
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		} else {
			throw new HttpException(403, 'You do not have permission to update this record.');
		}
	}

	/**
	 * Deletes an existing Thread model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Thread model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Thread the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Thread::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
