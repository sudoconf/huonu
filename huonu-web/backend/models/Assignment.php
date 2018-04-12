<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/12 11:27
 */

namespace backend\models;

use backend\components\RouteHelper;
use Yii;
use yii\base\Object;

class Assignment extends Object
{
    /**
     * @var 用户id
     */
    public $id;

    /**
     * @var \yii\web\IdentityInterface User
     */
    public $user;

    /**
     * @inheritdoc
     */
    public function __construct($id, $user = null, $config = array())
    {
        $this->id = $id;
        $this->user = $user;
        parent::__construct($config);
    }

    /**
     * 从用户那里获得角色
     * @param $items
     * @return int
     */
    public function assign($items)
    {
        $manager = Yii::$app->authManager;
        $success = 0;
        foreach ($items as $name) {
            try {
                $item = $manager->getRole($name);
                $item = $item ?: $manager->getPermission($name);
                $manager->assign($item, $this->id);
                $success++;
            } catch (\Exception $exc) {
                Yii::error($exc->getMessage(), __METHOD__);
            }
        }
        RouteHelper::invalidate();
        return $success;
    }

    /**
     * 从用户撤消角色。
     * @param $items
     * @return int
     */
    public function revoke($items)
    {
        $manager = Yii::$app->authManager;
        $success = 0;
        foreach ($items as $name) {
            try {
                $item = $manager->getRole($name);
                $item = $item ?: $manager->getPermission($name);
                $manager->revoke($item, $this->id);
                $success++;
            } catch (\Exception $exc) {
                Yii::error($exc->getMessage(), __METHOD__);
            }
        }
        RouteHelper::invalidate();
        return $success;
    }

    /**
     * 获得所有可用的和指定的 roles/permission
     * @return array
     */
    public function getItems()
    {
        $manager = Yii::$app->authManager;
        $available = [];
        foreach (array_keys($manager->getRoles()) as $name) {
            $available[$name] = 'role';
        }

        foreach (array_keys($manager->getPermissions()) as $name) {
            if ($name[0] != '/') {
                $available[$name] = 'permission';
            }
        }

        $assigned = [];
        foreach ($manager->getAssignments($this->id) as $item) {
            $assigned[$item->roleName] = $available[$item->roleName];
            unset($available[$item->roleName]);
        }

        return [
            'available' => $available,
            'assigned' => $assigned,
        ];
    }

    /**
     * @inheritdoc
     */
    public function __get($name)
    {
        if ($this->user) {
            return $this->user->$name;
        }
    }
}
