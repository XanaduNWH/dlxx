<?php

namespace frontend\models\thread;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\thread\Thread;
use yii\db\Expression;

/**
 * ThreadSearch represents the model behind the search form about `frontend\models\thread\Thread`.
 */
class ThreadSearch extends Thread
{
	/**
	* @inheritdoc
	*/
	public function rules()
	{
		return [
			[['id', 'author_id', 'status'], 'integer'],
			[['title', 'content','author_name'], 'safe'],
		];
	}

	/**
	* @inheritdoc
	*/
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	* Creates data provider instance with search query applied
	*
	* @param array $params
	*
	* @return ActiveDataProvider
	*/
	public function search($params)
	{
		$query = Thread::find()->alias('t');

		$user = \common\models\User::find();

		$last_comment = Comments::find()
				->select(['thread_id','count(1) as comments_count','max(created_at) as lc'])
				->groupBy('thread_id')
				;

		$query->select(['"t".*', '"u".username as author_name','"c".lc','"c".comments_count as comments_count'])
				->leftJoin(['u' => $user],'"u".id = t.author_id')
				->leftJoin(['c' => $last_comment],'"c".thread_id = "t".id')
				;

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 10,
			],
		]);

		$dataProvider->setSort([
			// 'defaultOrder' => ['lc' => SORT_DESC],
			'attributes' => [
				'author_name',
				'lc' => [
					'asc' => [new Expression('lc NULLS FRIST,created_at')],
					'desc' => [new Expression('lc DESC NULLS LAST,created_at DESC')],
					'default' => SORT_DESC,
				],
			],
		]);
		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$query->andFilterWhere([
			// 'id' => $this->id,
			// 'author_id' => $this->author_id,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'status' => $this->status,
			// 'comments_count' => $this->comment_count,
		]);

		$query->andFilterWhere(['ilike', 'title', $this->title])
				->andFilterWhere(['ilike', 'content', $this->content])
				->andFilterWhere(['ilike' , '"user".username', $this->author_name])
				;

		return $dataProvider;
	}
}
