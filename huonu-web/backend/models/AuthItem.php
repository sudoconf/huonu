<?php

namespace backend\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%auth_item}}".
 *
 * @property string $name
 * @property int $type type=1角色,type=2权限
 * @property string $description
 * @property string $rule_name
 * @property resource $data
 * @property int $created_at
 * @property int $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 * @property HuonuAuthItem[] $children
 * @property HuonuAuthItem[] $parents
 */
class AuthItem extends \yii\db\ActiveRecord
{
    public $name;
    public $type;
    public $description;
    public $ruleName;
    public $data;

    private $_item;

    public function __construct($item = null, $config = [])
    {
        $this->_item = $item;
        if ($item !== null) {
            $this->name = $item->name;
            $this->type = $item->type;
            $this->description = $item->description;
            $this->ruleName = $item->ruleName;
            $this->data = $item->data === null ? null : Json::encode($item->data);
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ruleName'], 'checkRule'],
            [['name', 'type'], 'required'],
            [['name'], 'checkUnique', 'when' => function () {
                return $this->isNewRecord || ($this->_item->name != $this->name);
            }],
            [['type'], 'integer'],
            [['description', 'data', 'ruleName'], 'default'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'type' => '类型',
            'description' => '描述',
            'rule_name' => '规则名称',
            'data' => '数据',
            'created_at' => '添加时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * 角色检查
     */
    public function checkUnique()
    {
        $authManager = Yii::$app->authManager;
        $value = $this->name;
        if ($authManager->getRole($value) !== null || $authManager->getPermission($value) !== null) {
            $message = "属性{$value}已经被采用";
            $params = [
                'attribute' => $this->getAttributeLabel('name'),
                'value' => $value,
            ];
            $this->addError('name', Yii::$app->getI18n()->format($message, $params, Yii::$app->language));
        }
    }

    /**
     * 规则检查
     */
    public function checkRule()
    {
        $name = $this->ruleName;
        $authManager = Yii::$app->authManager;
        if (!$authManager->getRule($name)) {
            try {
                $rule = Yii::createObject($name);
                if ($rule instanceof \yii\rbac\Rule) {
                    $rule->name = $name;
                    $authManager->add($rule);
                } else {
                    $this->addError('ruleName', "无效的规则{$name}");
                }
            } catch (\Exception $exc) {
                $this->addError('ruleName', "规则{$name}不存在");
            }
        }
    }

    /**
     * 检查是否为新记录
     */
    public function getIsNewRecord()
    {
        return $this->_item === null;
    }

    /**
     * Find role
     * @param string $id
     * @return null|\self
     */
    public static function find($id = '')
    {
        $authManager = Yii::$app->authManager;
        $item = $authManager->getRole($id);
        if ($item !== null) {
            return new self($item);
        }

        return null;
    }
}
