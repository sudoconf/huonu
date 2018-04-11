<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/11 16:46
 */
namespace backend\modules\system\controllers;

use yii\rbac\Item;

class PermissionController extends ItemController {

    /**
     * @inheritdoc
     */
    public function labels()
    {
        return[
            'Item' => 'Permission',
            'Items' => 'Permissions',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return Item::TYPE_PERMISSION;
    }
}