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
            'expires_in' => $this->expires_in,
            're_expires_in' => $this->re_expires_in,
            'r1_expires_in' => $this->r1_expires_in,
            'r2_expires_in' => $this->r2_expires_in,
            'w1_expires_in' => $this->w1_expires_in,
            'w2_expires_in' => $this->w2_expires_in,
            'r1_valid' => $this->r1_valid,
            'r2_valid' => $this->r2_valid,
            'w1_valid' => $this->w1_valid,
            'w2_valid' => $this->w2_valid,
            'expire_time' => $this->expire_time,
            'refresh_token_valid_time' => $this->refresh_token_valid_time,
            'expire_date' => $this->expire_date,
            'sync_status' => $this->sync_status,
        ]);

        $query->andFilterWhere(['like', 'taobao_user_id', $this->taobao_user_id])
            ->andFilterWhere(['like', 'taobao_user_nick', $this->taobao_user_nick])
            ->andFilterWhere(['like', 'access_token', $this->access_token])
            ->andFilterWhere(['like', 'refresh_token', $this->refresh_token])
            ->andFilterWhere(['like', 'token_type', $this->token_type])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
