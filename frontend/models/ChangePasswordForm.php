<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class ChangePasswordForm extends Model
{
	public $old_password;
	public $new_password;
	public $verify_new_password;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['old_password','new_password','verify_new_password'], 'required'],
			[['old_password','new_password','verify_new_password'], 'string', 'min' => 6],
			[
				'verify_new_password',
				'compare',
				'compareAttribute' => 'new_password',
				'message' => Yii::t('yii',"New passwords don't match!"),
			],
		];
	}

	/**
	 * Change user's password
	 * 
	 * @param string $old_password Old password
	 * @param string $new_password New Password
	 * @param string $verify_new_password Repeat new password
	 * @return boolean whether the password has been changed
	 */
	public function changePassword()
	{
		$user = User::findOne([
			'status' => User::STATUS_ACTIVE,
			'username' => Yii::$app->user->identity->username,
		]);

		if($user->validatePassword($this->old_password)){
			$user->setPassword($this->new_password);
			$this->sendEmail($user);
			return $user->save(FALSE);
		} else {
			$this->addError('old_password', 'Wrong old password given.');
		}
	}

	/**
	 * Sends an email with a link, for resetting the password.
	 *
	 * @return boolean whether the email was send
	 */
	public function sendEmail($user)
	{
		if (!$user) {
			return false;
		}

		return Yii::$app
			->mailer
			->compose(
				['html' => 'changePassword-html','text' => 'changePassword-text'],
				['user' => $user]
			)
			->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
			->setTo($user->email)
			->setSubject('Password for ' . Yii::$app->name . 'has been changed.')
			->send();
	}
}
