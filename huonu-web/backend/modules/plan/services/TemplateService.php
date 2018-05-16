<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/5/8 14:06
 */

namespace backend\modules\plan\services;

use backend\models\UserAreaTemplate;
use common\components\CtHelper;
use common\components\Toolkit\ArrayToolkit;
use common\services\BaseService;
use Yii;
use yii\base\InvalidArgumentException;

class TemplateService extends BaseService
{
    // TODO 添加地域模板
    public function createAreaTemplate()
    {
        $fields = Yii::$app->request->post();

        $userAreaTemplateList = UserAreaTemplate::find()->where(
            ['taobao_user_id' => $fields['taobao_user_id']]
        )->asArray()->all();

        if (count($userAreaTemplateList) > 10) {
            CtHelper::response(false, '自定义模板最多保存10个，如果您要添加新模板，请先对老模板进行移除。');
        }

        $fields = $this->filterCreateAreaTemplateFields($fields);

        $userAreaTemplate = new UserAreaTemplate();

        $userAreaTemplate->setAttributes($fields);

        if (!$userAreaTemplate->save()) {
            CtHelper::response(false, $userAreaTemplate->getErrors());
        }

        CtHelper::response(true, '添加成功', $userAreaTemplateList);

    }

    // TODO 修改地域模板
    public function updateAreaTemplate()
    {
    }

    // TODO 添加时间模板
    public function createTimeTemplate()
    {
    }

    // TODO 修改时间模板
    public function updateTimeTemplate()
    {
    }

    /**
     * 添加地域检测参数
     * @param $fields
     * @return mixed
     */
    protected function filterCreateAreaTemplateFields($fields)
    {
        $requiredFields = array(
            'taobao_user_id',
            'area_template_name',
            'area_id_list',
        );

        if (!ArrayToolkit::requires($fields, $requiredFields)) {
            throw new InvalidArgumentException('Missing required fields when creating area template');
        }

        return $fields;
    }

    /**
     * 修改地域检测参数
     * @param $fields
     * @return array
     */
    protected function filterUpdateParameterFields($fields)
    {
        $fields = ArrayToolkit::parts(
            $fields,
            array(
                'taobao_user_id',
                'area_template_name',
                'area_id_list',
            )
        );

        return $fields;
    }
}