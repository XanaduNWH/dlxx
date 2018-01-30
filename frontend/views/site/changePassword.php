<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-change-password">
	<h1><?= Html::encode($this->title) ?></h1>

	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'change-password-form']); ?>

				<?= $form->field($model, 'old_password')->passwordInput(['autofocus' => true]) ?>

				<?= $form->field($model, 'new_password')->passwordInput(['autofocus' => true]) ?>

				<?= $form->field($model, 'verify_new_password')->passwordInput(['autofocus' => true]) ?>

				<div class="form-group">
					<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
				</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
