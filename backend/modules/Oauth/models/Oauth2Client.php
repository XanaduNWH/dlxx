<?php

namespace backend\modules\Oauth\models;

use Yii;

/**
 * This is the model class for table "oauth2_client".
 *
 * @property string $client_id
 * @property string $client_secret
 * @property string $redirect_uri
 * @property string $grant_type
 * @property string $scope
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Oauth2AccessToken[] $oauth2AccessTokens
 * @property Oauth2AuthorizationCode[] $oauth2AuthorizationCodes
 * @property Oauth2RefreshToken[] $oauth2RefreshTokens
 */
class Oauth2Client extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'oauth2_client';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'redirect_uri'], 'required'],
			[['title', 'redirect_uri'], 'safe'],
			[['redirect_uri', 'grant_type', 'scope'], 'string'],
			[['created_by'], 'default', 'value' => Yii::$app->user->id],
			[['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
			[['client_id', 'client_secret'], 'string', 'max' => 80],
			[['client_id'], 'unique'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'title' => Yii::t('app', 'Title'),
			'client_id' => Yii::t('app', 'Client ID'),
			'client_secret' => Yii::t('app', 'Client Secret'),
			'redirect_uri' => Yii::t('app', 'Redirect Uri'),
			'grant_type' => Yii::t('app', 'Grant Type'),
			'scope' => Yii::t('app', 'Scope'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
			'created_by' => Yii::t('app', 'Created By'),
			'updated_by' => Yii::t('app', 'Updated By'),
		];
	}

	public function beforeSave($insert) {
		if(parent::beforeSave($insert)) {
			if ($this->isNewRecord) {
				$this->client_id = Yii::$app->getSecurity()->generateRandomString(12);
				$this->client_secret = Yii::$app->getSecurity()->generateRandomString(48);
				$this->created_by = Yii::$app->user->id;
				return true;
			}
		}
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOauth2AccessTokens()
	{
		return $this->hasMany(Oauth2AccessToken::className(), ['client_id' => 'client_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOauth2AuthorizationCodes()
	{
		return $this->hasMany(Oauth2AuthorizationCode::className(), ['client_id' => 'client_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOauth2RefreshTokens()
	{
		return $this->hasMany(Oauth2RefreshToken::className(), ['client_id' => 'client_id']);
	}

	/**
	 * @inheritdoc
	 * @return Oauth2ClientQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new Oauth2ClientQuery(get_called_class());
	}
}
