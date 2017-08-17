<?php

namespace frontend\modules\Thread\models;

use Yii;
use common\models\User;
use yii\db\Expression;

/**
 * This is the model class for table "thread".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $status
 * @property string $title
 * @property string $content
 * @property string $lc
 * @property integer $comments_count
 *
 * @property Comments[] $comments
 * @property User $author
 */
class Thread extends \yii\db\ActiveRecord
{
	const SCENARIO_ADDACOMMENT = 'addacomment';

	public $author_name;
	public $comments_count;
	public $lc;

	/**
	* @inheritdoc
	*/
	public static function tableName()
	{
		return 'thread';
	}

	/**
	* @inheritdoc
	*/
	public function rules()
	{
		return [
			[['author_id', 'status'], 'integer'],
			[['title','content'],'required'],
			[['author_name','lastcomment_at', 'updated_by'], 'safe'],
			[['content'], 'string'],
			[['title'], 'string', 'max' => 64],
			// [['title'],\common\models\cellphoneValidator::className()],
			[['author_id'], 'exist', 'skipOnError' => false, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
		];
	}

	public function scenarios() {
		return array_merge(parent::scenarios(),[
			self::SCENARIO_ADDACOMMENT => ['title','content'],
		]);
	}

	/**
	* @inheritdoc
	*/
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'author_id' => Yii::t('app', 'Author ID'),
			'author_name' => Yii::t('app', 'Author Name'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
			'lc' => Yii::t('app', 'Lastcomment At'),
			'status' => Yii::t('app', 'Status'),
			'title' => Yii::t('app', 'Title'),
			'content' => Yii::t('app', 'Content'),
			'comments_count' => Yii::t('app', 'Comment Count'),
			'updated_by' => Yii::t('app', 'Update By'),
		];
	}

	/**
	 *  @return boolean
	 */
	public function addacomment(){
		$this->setScenario(self::SCENARIO_ADDACOMMENT);
		$this->comment_count += 1;  // unused. just for testing.
		$this->save();
	}

	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if($this->isNewRecord){
				$this->lastcomment_at = NULL;
				$this->updated_by = NULL;
				$this->author_id = Yii::$app->user->id;
				$this->status = 10;
				return true;
			} else {
				$this->lastcomment_at = new Expression('NOW()');
				($this->scenario == Thread::SCENARIO_ADDACOMMENT) ? NULL:$this->updated_at = new Expression('NOW()');
				$this->updated_by = Yii::$app->user->id;
				return true;
			}
		} else {
			return false;
		}
	}

	/**
	* @return string
	*/
	public function getLa()
	{
		return Comments::find()->where(['thread_id' => $this->id])->max('created_at');
	}

	/**
	* @return \yii\db\ActiveQuery
	*/
	public function getComments()
	{
		return $this->hasMany(Comments::className(), ['thread_id' => 'id'])->orderBy('"created_at" DESC NULLS LAST');
	}

	/**
	* @return \yii\db\ActiveQuery
	*/
	public function getAuthor()
	{
		return $this->hasOne(User::className(), ['id' => 'author_id']);
	}

	/**
	* @inheritdoc
	* @return ThreadQuery the active query used by this AR class.
	*/
	public static function find()
	{
		return new ThreadQuery(get_called_class());
	}
}
