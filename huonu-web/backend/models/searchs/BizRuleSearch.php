<?php

namespace backend\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use mdm\admin\models\BizRule as MBizRule;
use mdm\admin\components\RouteRule;
use mdm\admin\components\Configs;

class BizRuleSearch extends Model
{
    /**
     * @var 规则名称
     */
    public $name;

    public function rules()
    {
        return [
            [['name'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('admin', 'Name'),
        ];
    }

    /**
     * 搜索
     * @param $params
     * @return ArrayDataProvider
     */
    public function search($params)
    {
        $authManager = Yii::$app->authManager;
        $models = [];
        $included = !($this->load($params) && $this->validate() && trim($this->name) !== '');
        foreach ($authManager->getRules() as $name => $item) {
            if ($name != RouteRule::RULE_NAME && ($included || stripos($item->name, $this->name) !== false)) {
                $models[$name] = new MBizRule($item);
            }
        }

        return new ArrayDataProvider([
            'allModels' => $models,
        ]);
    }
}
