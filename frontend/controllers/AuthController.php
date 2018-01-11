<?php
namespace frontend\controllers;
 
use common\models\LoginForm;
use yii\web\Controller;
 
class AuthController extends Controller
{
    public function behaviors()
    {
        return [
            /** 
             * checks oauth2 credentions
             * and performs OAuth2 authorization, if user is logged on
             */
            'oauth2Auth' => [
                'class' => \conquer\oauth2\AuthorizeFilter::className(),
                'only' => ['index'],
            ],
        ];
    }
    public function actions()
    {
        return [
            // returns access token
            'token' => [
                'class' => \conquer\oauth2\TokenAction::classname(),
            ],
        ];
    }
    /**
     * Display login form to authorize user
     */
    public function actionIndex()
    {
        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('/site/login', [
                'model' => $model,
            ]);
        }
    }
}