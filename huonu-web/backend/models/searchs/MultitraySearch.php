<?php

namespace backend\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Multitray;

/**
 * MultitraySearch represents the model behind the search form of `backend\models\Multitray`.
 */
class MultitraySearch extends Multitray
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['multitray_id', 'multitray_start_time', 'multitray_end_time', 'created_at', 'updated_at'], 'integer'],
            [['taobao_id', 'taobao_name', 'multitray_name', 'multitray_effect_model', 'multitray_cycle', 'multitray_field'], 'safe'],
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
        $query = Multitray::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
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
            'multitray_id' => $this->multitray_id,
            'multitray_start_time' => $this->multitray_start_time,
            'multitray_end_time' => $this->multitray_end_time,
            'is_delete' => 0, // 已删除为1
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'taobao_id', $this->taobao_id])
            ->andFilterWhere(['like', 'taobao_name', $this->taobao_name])
            ->andFilterWhere(['like', 'multitray_name', $this->multitray_name])
            ->andFilterWhere(['like', 'multitray_effect_model', $this->multitray_effect_model])
            ->andFilterWhere(['like', 'multitray_cycle', $this->multitray_cycle])
            ->andFilterWhere(['like', 'multitray_field', $this->multitray_field]);

        return $dataProvider;
    }
}
