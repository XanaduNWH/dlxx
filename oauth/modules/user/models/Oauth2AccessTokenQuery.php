<?php

namespace oauth\modules\user\models;

/**
 * This is the ActiveQuery class for [[Oauth2AccessToken]].
 *
 * @see Oauth2AccessToken
 */
class Oauth2AccessTokenQuery extends \yii\db\ActiveQuery
{
	/*public function active()
	{
		return $this->andWhere('[[status]]=1');
	}*/

	/**
	 * @inheritdoc
	 * @return Oauth2AccessToken[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * @inheritdoc
	 * @return Oauth2AccessToken|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
