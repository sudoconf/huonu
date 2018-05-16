<?php

namespace backend\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ApiLogs;
use yii\db\Expression;

/**
 * ApiLogSearch represents the model behind the search form of `backend\models\ApiLogs`.
 */
class ApiLogSearch extends ApiLogs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['api_name', 'created_at', 'call_people', 'endAt', 'startAt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'startAt',
            'endAt'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'startAt' => '开始时间',
            'endAt' => '结束时间',
        ]);
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
        // 首先要setAttributes
        $this->setAttributes($params);

        $query = ApiLogs::find()->select(['`id`', '`api_name`', '`created_at`', '`call_people`', 'count(`id`) as `callNumber`']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
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
            'id' => $this->id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['>=', 'created_at', $this->getAttribute('startAt')]);
        $query->andFilterWhere(['<=', 'created_at', $this->getAttribute('endAt')]);

        $query->andFilterWhere(['like', 'api_name', $this->api_name])
            ->andFilterWhere(['like', 'call_people', $this->call_people]);

        $query->groupBy(['`api_name`']);

        return $dataProvider;
    }
}
