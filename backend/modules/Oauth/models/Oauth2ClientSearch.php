<?php

namespace backend\modules\Oauth\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\Oauth\models\Oauth2Client;

/**
 * Oauth2ClientSearch represents the model behind the search form of `backend\modules\Oauth\models\Oauth2Client`.
 */
class Oauth2ClientSearch extends Oauth2Client
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title', 'redirect_uri', 'grant_type', 'scope'], 'safe'],
		//	[['created_at', 'updated_at'], 'string'],
		//	[['created_by', 'updated_by'], 'integer'],
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
		$query = Oauth2Client::find();

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$query->andFilterWhere([
			'title' => $this->title,
//			'created_at' => $this->created_at,
//			'updated_at' => $this->updated_at,
//			'created_by' => $this->created_by,
//			'updated_by' => $this->updated_by,
		]);

		$query->andFilterWhere(['ilike', 'redirect_uri', $this->redirect_uri])
			->andFilterWhere(['ilike', 'grant_type', $this->grant_type])
			->andFilterWhere(['ilike', 'scope', $this->scope]);

		return $dataProvider;
	}
}
