<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/5/8 14:06
 */

namespace backend\modules\plan\services;

use backend\models\UserAreaTemplate;
use backend\models\UserTimeTemplate;
use common\components\CtHelper;
use common\components\Toolkit\ArrayToolkit;
use common\services\BaseService;
use Yii;
use yii\base\InvalidArgumentException;

class TemplateService extends BaseService
{
    /**
     * 获取地域模板列表
     */
    public function getUserAreaTemplates()
    {
        $get = Yii::$app->request->get();

        $userAreaTemplateModal = UserAreaTemplate::find()
            ->where(['taobao_user_id' => 0]);

        if (isset($get['taobaoShopId'])) {
            $userAreaTemplateModal->orWhere(['taobao_user_id' => $get['taobaoShopId']]);
        }
        $data['userAreaTemplates'] = $userAreaTemplateModal->asArray()->all();
        CtHelper::response(true, '', $data);
    }

    /**
     * 添加地域模板
     */
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

    /**
     * 获取时间模板列表
     */
    public function getUserTimeTemplates()
    {
        $get = Yii::$app->request->get();

        $userTimeTemplateModal = UserTimeTemplate::find()
            ->where(['taobao_user_id' => 0]);

        if (isset($get['taobaoShopId'])) {
            $userTimeTemplateModal->orWhere(['taobao_user_id' => $get['taobaoShopId']]);
        }
        $data['userTimeTemplates'] = $userTimeTemplateModal->asArray()->all();
        CtHelper::response(true, '', $data);
    }

    /**
     * 添加时间模板
     */
    public function createTimeTemplate()
    {
        $fields = Yii::$app->request->post();

        $userTimeTemplates = UserTimeTemplate::find()->where(
            ['taobao_user_id' => $fields['taobao_user_id']]
        )->asArray()->all();

        if (count($userTimeTemplates) > 10) {
            CtHelper::response(false, '自定义模板最多保存10个，如果您要添加新模板，请先对老模板进行移除。');
        }

        $fields['time_template_workday'] = '[' . $fields['time_template_workday'] . ']';
        $fields['time_template_weekend'] = '[' . $fields['time_template_weekend'] . ']';

        $fields = $this->filterCreateTimeTemplateFields($fields);

        $userTimeTemplateModel = new UserTimeTemplate();

        $userTimeTemplateModel->setAttributes($fields);

        if (!$userTimeTemplateModel->save()) {
            CtHelper::response(false, $userTimeTemplateModel->getErrors());
        }

        CtHelper::response(true, '添加成功', $userTimeTemplateModel);
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

    /**
     * 添加时间模板检测参数
     * @param $fields
     * @return mixed
     */
    protected function filterCreateTimeTemplateFields($fields)
    {
        $requiredFields = array(
            'taobao_user_id',
            'time_template_name',
            'time_template_workday',
            'time_template_weekend'
        );

        if (!ArrayToolkit::requires($fields, $requiredFields)) {
            throw new InvalidArgumentException('Missing required fields when creating area template');
        }

        return $fields;
    }
}