<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\Oauth\models\Oauth2Client */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oauth2 Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oauth2-client-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
			'title',
            'client_id',
            'client_secret',
            'redirect_uri:ntext',
            // 'grant_type:ntext',
            'scope:ntext',
            'created_at:datetime',
            // 'updated_at:datetime',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->client_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
