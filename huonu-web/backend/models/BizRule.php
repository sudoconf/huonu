<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\rbac\Rule;

/**
 * BizRule
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class BizRule extends \yii\base\Model
{
    /**
     * @var string name of the rule
     */
    public $name;

    /**
     * @var integer UNIX timestamp representing the rule creation time
     */
    public $createdAt;

    /**
     * @var integer UNIX timestamp representing the rule updating time
     */
    public $updatedAt;

    /**
     * @var string Rule classname.
     */
    public $className;

    /**
     * @var Rule
     */
    private $_item;

    /**
     * Initilaize object
     * @param \yii\rbac\Rule $item
     * @param array $config
     */
    public function __construct($item, $config = [])
    {
        $this->_item = $item;
        if ($item !== null) {
            $this->name = $item->name;
            $this->className = get_class($item);
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'className'], 'required'],
            [['className'], 'string'],
            [['className'], 'classExists']
        ];
    }

    /**
     * 验证类存在
     */
    public function classExists()
    {
        if (!class_exists($this->className)) {
            $message = Yii::t('admin', "Unknown class '{class}'", ['class' => $this->className]);
            $this->addError('className', $message);
            return;
        }
        if (!is_subclass_of($this->className, Rule::className())) {
            $message = Yii::t('admin', "'{class}' must extend from 'yii\rbac\Rule' or its child class", [
                    'class' => $this->className]);
            $this->addError('className', $message);
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('admin', 'Name'),
            'className' => Yii::t('admin', 'Class Name'),
        ];
    }

    /**
     * @return bool
     */
    public function getIsNewRecord()
    {
        return $this->_item === null;
    }

    /**
     * @param $id
     * @return null|static
     */
    public static function find($id)
    {
        $item = Yii::$app->authManager->getRule($id);
        if ($item !== null) {
            return new static($item);
        }

        return null;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function saveOperation()
    {
        if ($this->validate()) {
            $manager = Yii::$app->authManager;
            $class = $this->className;
            if ($this->_item === null) {
                $this->_item = new $class();
                $isNew = true;
            } else {
                $isNew = false;
                $oldName = $this->_item->name;
            }
            $this->_item->name = $this->name;

            if ($isNew) {
                $manager->add($this->_item);
            } else {
                $manager->update($oldName, $this->_item);
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     * @return Rule
     */
    public function getItem()
    {
        return $this->_item;
    }
}
