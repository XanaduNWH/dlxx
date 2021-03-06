<?php

namespace common\models\rbac;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\rbac\AuthAssignment;

/**
 * AuthAssignmentSearch represents the model behind the search form about `app\models\rbac\AuthAssignment`.
 */
class AuthAssignmentSearch extends AuthAssignment
{
	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id','username'], 'safe'],
            [['created_at'], 'integer'],
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
        $query = AuthAssignment::find()
				->alias('assign')
				;

		$user = \common\models\User::find()
				->alias('users')
				->select(['id','username','email'])
				->where(['status' => 10])
				;

		$query->select([
					'username'	=> 'users.username',
					'email'		=> 'users.email',
					'assign.*'
				])
				->leftJoin(['users' => $user],'users.id = assign.user_id')
				;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$dataProvider->setSort([
			'defaultOrder' => ['user_id'=>SORT_ASC],
			'attributes' => [
				'item_name',
				'username',
				'user_id' => [
					'asc' => ['user_id' => SORT_ASC],
					'default' => SORT_ASC,
				],
				'created_at',
			]
		]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'user_id', $this->user_id]);

        return $dataProvider;
    }
}
