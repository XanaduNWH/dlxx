<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model frontend\models\thread\Thread */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Threads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thread-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?php
			if ($canupdate){
				echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
				echo "\t";
			} else {
				echo Html::label(Yii::t('app', 'Update'), 'update', ['class' => 'btn btn-primary','disabled' => true,'alt' => 'update']);
				echo "\t";
			}
			if($candelete){
				echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
					'class' => 'btn btn-danger',
					'data' => [
						'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
						'method' => 'post',
					],
				]);
			} else {
				echo Html::label(Yii::t('app', 'Delete'), 'delete', ['class' => 'btn btn-danger','disabled' => true,'alt' => 'delete']);

			}
		?>
	</p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			// 'id',
			// 'author_id',
			[
				'attribute' => 'author_name',
				'value' => $model->author->username,
				// 'captionOptions' => ['width' => 80],
			],
			'created_at:datetime',
			'updated_at:datetime',
			[
				'attribute' => 'lc',
				'format' => 'datetime',
				'value' => $model->la,
			],
			// 'status',
			'title',
			'content:raw',
			[
				'attribute' => 'comments_count',
				'value' => count($model->comments),
			],
		],
		'template' => '<tr><th{captionOptions} width = 180>{label}</th><td{contentOptions}>{value}</td></tr>',
	]) ?>
</div>
<hr />
<h1>Replies</h1>
<?php Pjax::begin(); ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th width = 120>回复人</th>
			<th>回复内容</th>
		</tr>
	</thead>
	<tbody>
<?php
echo ListView::widget([
	'dataProvider' => $comments_dp,
	'itemView' => '_comment',
	'summary' => false,
]);
?>
	</tbody>
</table>
<?php Pjax::end(); ?>
<hr />
<h1>Reply to this thread</h1>
<div class="comments-create">

	<?php $form = ActiveForm::begin(); ?>

	<?php //echo $form->field($comments, 'thread_id')->hiddenInput(['value'=> $model->id])->label(false) ?>

	<?php //echo $form->field($comments, 'author_id')->hiddenInput(['value'=> Yii::$app->user->getId()])->label(false) ?>

	<?php //echo $form->field($comments, 'author_ip')->hiddenInput(['value'=> Yii::$app->request->userIP])->label(false) ?>

	<?php //echo $form->field($comments, 'approve_status')->hiddenInput(['value'=> 10])->label(false) ?>

	<?php //echo $form->field($comments, 'author_email')->textInput(['maxlength' => true]) ?>

	<?= $form->field($comments, 'content')->widget(CKEditor::className(), [
			'options' => ['rows' => 6],
			'preset' => 'full',
		]) ?>
	<?= $form->field($comments, 'verifyCode')->widget(Captcha::className(), [
		'template' => '<div class="row"><div class="col-lg-2">{image}</div><div class="col-lg-2">{input}</div></div>',
		'captchaAction' => '/site/captcha',
		]) ?>

	<div class="form-group">
		<?= Html::submitButton($comments->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $comments->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>
</div>