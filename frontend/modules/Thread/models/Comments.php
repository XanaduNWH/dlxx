<?php

namespace frontend\modules\Thread\models;

use Yii;
use frontend\modules\Thread\models\Thread;
use common\models\User;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $thread_id
 * @property integer $author_id
 * @property string $author_email
 * @property string $author_ip
 * @property string $created_at
 * @property string $updated_at
 * @property integer $approve_status
 * @property integer $reply_to
 * @property string $content 
 *
 * @property Thread $thread
 * @property User $author
 */
class Comments extends \yii\db\ActiveRecord
{
	public $verifyCode;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['thread_id', 'author_id', 'approve_status', 'reply_to'], 'integer'],
            [['author_email', 'content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['author_ip'], 'string', 'max' => 50],
            [['thread_id'], 'exist', 'skipOnError' => FALSE, 'targetClass' => Thread::class, 'targetAttribute' => ['thread_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => FALSE, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
			['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'thread_id' => Yii::t('app', 'Thread ID'),
            'author_id' => Yii::t('app', 'Author ID'),
            'author_email' => Yii::t('app', '回复者邮箱'),
            'author_ip' => Yii::t('app', '回复者地址'),
            'created_at' => Yii::t('app', '创建日期'),
            'updated_at' => Yii::t('app', '更新日期'),
            'approve_status' => Yii::t('app', '审核状态'),
            'reply_to' => Yii::t('app', 'Replay To'),
			'content' => Yii::t('app', '内容'),
			'verifyCode' => Yii::t('app', 'Verification Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThread()
    {
        return $this->hasOne(Thread::class, ['id' => 'thread_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

	public function beforeSave($insert) {
		if(parent::beforeSave($insert)){
			$this->thread_id = Yii::$app->request->get('id');
			$this->author_id = Yii::$app->user->id;
			$this->author_ip = Yii::$app->request->getUserIP();
			$this->author_email = User::findOne(Yii::$app->user->id)->email;
			$this->approve_status = 10;
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function afterSave($insert,$changedAttributes)
	{
		if($this->thread->addacomment()) {
			return true;
		} else {
			return false;
		}
	}
}
