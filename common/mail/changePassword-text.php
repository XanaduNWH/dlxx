<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

Your password has been changed!If you made this change, you don't need to do anything.

If you did not change your password, someone may have gained access to your account. Click the link below to reset your password using our secure server.

<?= $resetLink ?>
