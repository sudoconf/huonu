<?php

namespace backend\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaobaoAuthorizeUser;

/**
 * TaobaoAuthorizeUserSearch represents the model behind the search form of `backend\models\TaobaoAuthorizeUser`.
 */
class TaobaoAuthorizeUserSearch extends TaobaoAuthorizeUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taobao_user_id', 'taobao_user_nick', 'access_token', 'refresh_token', 'token_type', 'expire_date', 'email', 'phone'], 'safe'],
            [['expires_in', 're_expires_in', 'r1_expires_in', 'r2_expires_in', 'w1_expires_in', 'w2_expires_in', 'r1_valid', 'r2_valid', 'w1_valid', 'w2_valid', 'expire_time', 'refresh_token_valid_time', 'sync_status'], 'integer'],
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
        $query = TaobaoAuthorizeUser::find();

        // add conditions that should always apply here

        $pageSize = isset($params['per-page']) ? intval($params['per-page']) : 20;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,

            'pagination' => [
                'pageSize' => $pageSize,
            ],
            'sort' => [
                'defaultOrder' => [
                    'taobao_user_id' => SORT_DESC,
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
            'sync_status' => $this->sync_status,
        ]);

        $query->andFilterWhere(['like', 'taobao_user_id', $this->taobao_user_id])
            ->andFilterWhere(['like', 'taobao_user_nick', $this->taobao_user_nick])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
