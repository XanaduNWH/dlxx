<?php

namespace frontend\models\thread;

/**
 * This is the ActiveQuery class for [[Thread]].
 *
 * @see Thread
 */
class ThreadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Thread[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Thread|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
