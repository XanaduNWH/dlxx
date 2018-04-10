<?php

namespace oauth\modules\user\models;

use Yii;

/**
 * This is the model class for table "oauth2_authorization_code".
 *
 * @property string $authorization_code
 * @property string $client_id
 * @property int $user_id
 * @property string $redirect_uri
 * @property int $expires
 * @property string $scope
 *
 * @property Oauth2Client $client
 */
class Oauth2AuthorizationCode extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'oauth2_authorization_code';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['authorization_code', 'client_id', 'redirect_uri', 'expires'], 'required'],
			[['user_id', 'expires'], 'default', 'value' => null],
			[['user_id', 'expires'], 'integer'],
			[['redirect_uri', 'scope'], 'string'],
			[['authorization_code'], 'string', 'max' => 40],
			[['client_id'], 'string', 'max' => 80],
			[['authorization_code'], 'unique'],
			[['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Oauth2Client::class, 'targetAttribute' => ['client_id' => 'client_id']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'authorization_code' => Yii::t('app', 'Authorization Code'),
			'client_id' => Yii::t('app', 'Client ID'),
			'user_id' => Yii::t('app', 'User ID'),
			'redirect_uri' => Yii::t('app', 'Redirect Uri'),
			'expires' => Yii::t('app', 'Expires'),
			'scope' => Yii::t('app', 'Scope'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getClient()
	{
		return $this->hasOne(Oauth2Client::class, ['client_id' => 'client_id']);
	}

	/**
	 * @inheritdoc
	 * @return Oauth2AuthorizationCodeQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new Oauth2AuthorizationCodeQuery(get_called_class());
	}
}
