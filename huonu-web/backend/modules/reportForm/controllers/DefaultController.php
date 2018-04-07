<?php

namespace backend\modules\reportForm\controllers;

use backend\controllers\BaseController;

class DefaultController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
