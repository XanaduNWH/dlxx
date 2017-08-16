<?php

namespace common\models\rbac;

use Yii;
use common\models\User;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property string $item_name
 * @property integer $user_id
 * @property string $created_at
 *
 * @property AuthItem $itemName
 * @property User $user
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
	public $username;
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
			[['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['item_name'], 'string', 'max' => 64],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['item_name' => 'name']],
			[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_name' => Yii::t('app', 'Item Name'),
			'username' => Yii::t('app', 'User Name'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'item_name']);
    }

	/**
	* @return \yii\db\ActiveQuery
	*/
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

    /**
     * @inheritdoc
     * @return AuthAssignmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthAssignmentQuery(get_called_class());
    }
}
