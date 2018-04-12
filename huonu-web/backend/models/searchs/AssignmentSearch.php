<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/12 11:26
 */

namespace backend\models\searchs;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class AssignmentSearch extends ActiveRecord
{
    public $id;
    public $username;

    public static function tableName()
    {
        return '{{%auth_assignment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'username' => Yii::t('admin', 'Username'),
            'name' => Yii::t('admin', 'Name'),
        ];
    }

    /**
     * 搜索
     * @param $params
     * @param $class
     * @param $usernameField
     * @return ActiveDataProvider
     */
    public function search($params, $class, $usernameField)
    {
        $query = $class::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', $usernameField, $this->username]);

        return $dataProvider;
    }
}
