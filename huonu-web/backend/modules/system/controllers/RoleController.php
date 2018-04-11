<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/9 16:23
 */

namespace backend\modules\system\controllers;

use yii\rbac\Item;

/**
 * @property integer $type
 * Class ItemController
 * @package backend\modules\system\controllers
 */
class RoleController extends ItemController
{
    /**
     * @inheritdoc
     */
    public function labels()
    {
        return [
            'Item' => 'Role',
            'Items' => 'Roles',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return Item::TYPE_ROLE;
    }
}