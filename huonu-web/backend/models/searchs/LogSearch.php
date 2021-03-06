<?php

namespace backend\models\searchs;

use backend\models\Admin;
use backend\models\SystemLog;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Log;

/**
 * LogSearch represents the model behind the search form of `backend\models\Log`.
 */
class LogSearch extends SystemLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'created_id'], 'integer'],
            [['type', 'module', 'controller', 'action', 'url', 'params', 'ip'], 'safe'],
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
        $query = SystemLog::find();

        // add conditions that should always apply here
        $query->select(SystemLog::tableName() . '.*,admin.username');
        $query->join('left join', Admin::tableName() . ' admin', 'admin.id = zxht_system_log.created_id');

        $pageSize = isset($params['per-page']) ? intval($params['per-page']) : 20;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,

            'pagination' => [
                'pageSize' => $pageSize,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
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
            'created_id' => $this->created_id,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'module', $this->module])
            ->andFilterWhere(['like', 'controller', $this->controller])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'params', $this->params])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
