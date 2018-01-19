<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\Oauth\models\Oauth2Client */

$this->title = Yii::t('app', 'Update Oauth2 Client: {nameAttribute}', [
    'nameAttribute' => $model->client_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oauth2 Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->client_id, 'url' => ['view', 'id' => $model->client_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="oauth2-client-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
