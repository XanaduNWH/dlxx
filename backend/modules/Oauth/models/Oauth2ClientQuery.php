<?php

namespace backend\modules\Oauth\models;

/**
 * This is the ActiveQuery class for [[Oauth2Client]].
 *
 * @see Oauth2Client
 */
class Oauth2ClientQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Oauth2Client[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Oauth2Client|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
