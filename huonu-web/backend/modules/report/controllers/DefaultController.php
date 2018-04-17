<?php

namespace backend\modules\report\controllers;

use backend\controllers\BaseController;

/**
 * Default controller for the `report` module
 */
class DefaultController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    // 创建第一步
    public function actionCreate()
    {
        return $this->render('create');
    }

    // 第一步 ajax 获取店铺
    public function actionAjaxGetShop()
    {
    }

    // 第二步
    public function actionCreateTwo()
    {
    }

    // 第三步 完成，生成统计数据
    public function actionCreateThere()
    {
        // 通过策略组
    }

}
