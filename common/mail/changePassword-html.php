<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="change-password">
	<p>Hello <?= Html::encode($user->username) ?>,</p>

	<p>Your password has been changed!If you made this change, you don't need to do anything.</p>

	<p>If you did not change your password, someone may have gained access to your account. Click the link below to reset your password using our secure server.</p>

	<p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

</div>
