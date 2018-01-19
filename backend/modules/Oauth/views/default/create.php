<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\Oauth\models\Oauth2Client */

$this->title = Yii::t('app', 'Create Oauth2 Client');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oauth2 Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oauth2-client-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
