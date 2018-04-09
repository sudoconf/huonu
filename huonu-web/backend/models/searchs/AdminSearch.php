<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/9 13:20
 */

namespace backend\models\searchs;

use backend\models\Admin;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class AdminSearch extends Admin
{
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username'], 'safe'],
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
     * 搜索
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Admin::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => '1',
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC,
                    'last_time' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'role' => $this->role,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}