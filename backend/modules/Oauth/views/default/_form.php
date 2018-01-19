<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\Oauth\models\Oauth2Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oauth2-client-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'title')->textInput() ?>

	<?= $form->field($model, 'redirect_uri')->textInput() ?>

	<?= $form->field($model, 'scope')->textInput() ?>

	<div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
