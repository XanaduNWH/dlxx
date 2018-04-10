<?php

namespace oauth\modules\user\models;

/**
 * This is the ActiveQuery class for [[Oauth2AuthorizationCode]].
 *
 * @see Oauth2AuthorizationCode
 */
class Oauth2AuthorizationCodeQuery extends \yii\db\ActiveQuery
{
	/*public function active()
	{
		return $this->andWhere('[[status]]=1');
	}*/

	/**
	 * @inheritdoc
	 * @return Oauth2AuthorizationCode[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * @inheritdoc
	 * @return Oauth2AuthorizationCode|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
