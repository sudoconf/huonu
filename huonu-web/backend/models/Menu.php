<?php

namespace backend\models;

use Yii;
use mdm\admin\components\Configs;
use yii\db\Query;

class Menu extends \yii\db\ActiveRecord
{
    /**
     * @var 父类名称
     */
    public $parent_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_name'], 'in',
                'range' => static::find()->select(['name'])->column(),
                'message' => '栏目 "{value}" 不存在.'],
            [['parent', 'route', 'data', 'order'], 'default'],
            [['parent'], 'filterParent', 'when' => function () {
                return !$this->isNewRecord;
            }],
            [['order'], 'integer'],
            [['route'], 'in',
                'range' => static::getSavedRoutes(),
                'message' => '路由 "{value}" 不存在.']
        ];
    }

    /**
     * filter Parent.
     */
    public function filterParent()
    {
        $parent = $this->parent;
        $db = Yii::$app->db;
        $query = (new Query)->select(['parent'])
            ->from(static::tableName())
            ->where('[[id]]=:id');
        while ($parent) {
            if ($this->id == $parent) {
                $this->addError('parent_name', 'Loop detected.');
                return;
            }
            $parent = $query->params([':id' => $parent])->scalar($db);
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin', 'ID'),
            'name' => Yii::t('admin', 'Name'),
            'parent' => Yii::t('admin', 'Parent'),
            'parent_name' => Yii::t('admin', 'Parent Name'),
            'route' => Yii::t('admin', 'Route'),
            'order' => Yii::t('admin', 'Order'),
            'data' => Yii::t('admin', 'Data'),
        ];
    }

    /**
     * Get menu parent
     * @return \yii\db\ActiveQuery
     */
    public function getMenuParent()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent']);
    }

    /**
     * Get menu children
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['parent' => 'id']);
    }

    private static $_routes;

    /**
     * @return array
     */
    public static function getSavedRoutes()
    {
        if (self::$_routes === null) {
            self::$_routes = [];
            foreach (Yii::$app->authManager->getPermissions() as $name => $value) {
                if ($name[0] === '/' && substr($name, -1) != '*') {
                    self::$_routes[] = $name;
                }
            }
        }
        return self::$_routes;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getMenuSource()
    {
        $tableName = static::tableName();
        return Menu::find()->select(['m.id', 'm.name', 'm.route', 'parent_name' => 'p.name'])
            ->from(['m' => $tableName])
            ->leftJoin(['p' => $tableName], '[[m.parent]]=[[p.id]]')
            ->asArray()->all();
    }
}
