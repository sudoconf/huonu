<div class="tab-pane fade in active" id="set-plan">
    <?php
    $form = \yii\bootstrap\ActiveForm::begin(
        [
            'id' => 'form-set-plan',
            'method' => 'post',
            'action' => 'ajax-save-set-plan.html',
        ]
    );
    ?>
    <div class="control-group">
        <div class="form-inline pd10">
            <label for="name">店铺名称</label>
            <input type="text" class="form-control taobao-shop-name" placeholder="请输入店铺名称"
                   value="<?= $setPlan['taobao_shop_name'] ?>">
            <input type="hidden" class="taobao-shop-id" name="taobao_user_id" value="<?= $setPlan['taobao_user_id'] ?>">
            <input type="hidden" class="taobao-shop-name" name="taobao_shop_name"
                   value="<?= $setPlan['taobao_shop_name'] ?>">
            <input type="hidden" class="ajax-get-shop"
                   value="<?= \yii\helpers\Url::toRoute('/report/default/ajax-get-shop') ?>">
        </div>
    </div>

    <!--基本信息 start -->
    <div class="control-group">
        <div class="well s_fs_16">
            <i class="fa fa-bar-chart-o fa-fw"></i>
            基本信息
        </div>

        <div class="form-inline pd10">
            <label for="name">计划名称</label>
            <input style="width: 350px" type="text" class="form-control campaign-name" placeholder="请输入计划名称"
                   name="name" value="<?= $setPlan['name']; ?>">
        </div>

        <div class="form-inline pd10">
            <label for="name">付费方式</label>
            <label class="radio-inline">
                <input type="radio" name="payment_type" class="payment-type"
                       value="2" <?= ($setPlan['payment_type'] == 2) ? 'checked' : ''; ?>> 按展现付费（CPM）
            </label>
            <label class="radio-inline">
                <input type="radio" name="payment_type" class="payment-type"
                       value="8" <?= ($setPlan['payment_type'] == 8) ? 'checked' : ''; ?>> 按点击付费（CPC）
            </label>
        </div>

        <div class="form-inline pd10">
            <div class="form-inline">
                <label for="name">地域设置</label>
                <label class="radio-inline">
                    <input type="radio" name="region" class="region" value="1"> 自定义
                </label>
                <label class="radio-inline">
                    <input type="radio" name="region" class="region" value="2" checked> 使用模板
                </label>
                <select class="form-control area-template-id" name="area_template_id">
                    <?php foreach ($setPlan['userAreaTemplates'] as $k => $v) { ?>
                        <option value="<?= $v['area_template_id'] ?>"><?= $v['area_template_name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-inline region-select ml70 pa20 mt20 bg-fafafa radius4 dpn">

                <div class="control-group pt25 pb10">
                    <div class="form-inline">
                        <input type="checkbox" checked id="select-all-common-area" class="select-all-common-area">
                        <label for="name">全选 - 常用地域</label>
                    </div>

                    <div class="pb15 dpIb">

                        <div class="regionHalf">
                            <div class="pr pdl25 dpIb w100">
                                <div class="regionArea">
                                    <span>A</span>
                                </div>
                                <div class="regionProvince">
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="1"> 安徽
                                    </div>
                                </div>
                            </div>
                            <div class="pr pdl25 dpIb w100">
                                <div class="regionArea">
                                    <span>B</span>
                                </div>
                                <div class="regionProvince">
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="19"> 北京
                                    </div>
                                </div>
                            </div>

                            <div class="pr pdl25 dpIb w100">
                                <div class="regionArea">
                                    <span>C</span>
                                </div>
                                <div class="regionProvince">
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="532"> 重庆
                                    </div>
                                </div>
                            </div>

                            <div class="pr pdl25 dpIb w100">
                                <div class="regionArea">
                                    <span>F</span>
                                </div>
                                <div class="regionProvince">
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="39"> 福建
                                    </div>
                                </div>
                            </div>

                            <div class="pr pdl25 dpIb w100">
                                <div class="regionArea">
                                    <span>G</span>
                                </div>
                                <div class="regionProvince">
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="68"> 广东
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="92"> 广西
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="109"> 贵州
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="52"> 甘肃
                                    </div>
                                </div>
                            </div>
                            <div class="pr pdl25 dpIb w100">
                                <div class="regionArea">
                                    <span>H</span>
                                </div>
                                <div class="regionProvince">
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="165"> 黑龙江
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="125"> 河北
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="145"> 河南
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="184"> 湖北
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="212"> 湖南
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="120"> 海南
                                    </div>
                                </div>
                            </div>
                            <div class="pr pdl25 dpIb w100">
                                <div class="regionArea">
                                    <span>J</span>
                                </div>
                                <div class="regionProvince">
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="234"> 吉林
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="255"> 江苏
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="279"> 江西
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="regionHalf">
                            <div class="pr pdl25 dpIb w100">
                                <div class="regionArea">
                                    <span>L</span>
                                </div>
                                <div class="regionProvince">
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="294"> 辽宁
                                    </div>
                                </div>
                            </div>
                            <div class="pr pdl25 dpIb w100">
                                <div class="regionArea">
                                    <span>N</span>
                                </div>
                                <div class="regionProvince">
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="333"> 内蒙古
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="351"> 宁夏
                                    </div>
                                </div>
                            </div>
                            <div class="pr pdl25 dpIb w100">
                                <div class="regionArea">
                                    <span>Q</span>
                                </div>
                                <div class="regionProvince">
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="357"> 青海
                                    </div>
                                </div>
                            </div>
                            <div class="pr pdl25 dpIb w100">
                                <div class="regionArea">
                                    <span>S</span>
                                </div>
                                <div class="regionProvince">
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="393"> 山西
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="406"> 陕西
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="368"> 山东
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="417"> 上海
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="438"> 四川
                                    </div>
                                </div>
                            </div>

                            <div class="pr pdl25 dpIb w100">
                                <div class="regionArea">
                                    <span>T</span>
                                </div>
                                <div class="regionProvince">
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="461"> 天津
                                    </div>
                                </div>
                            </div>
                            <div class="pr pdl25 dpIb w100">
                                <div class="regionArea">
                                    <span>Y</span>
                                </div>
                                <div class="regionProvince">
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="488"> 云南
                                    </div>
                                </div>
                            </div>
                            <div class="pr pdl25 dpIb w100">
                                <div class="regionArea">
                                    <span>Z</span>
                                </div>
                                <div class="regionProvince">
                                    <div class="provinceItem">
                                        <input type="checkbox" class="common-area" checked
                                               value="508"> 浙江
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-inline mb10">
                        <input type="checkbox" id="select-all-rarely-used-area" class="select-all-rarely-used-area">
                        <label for="name">全选 - 非常用地域</label>
                    </div>

                    <div class="form-inline dpIb">
                        <div class="provinceItem">
                            <input type="checkbox" class="rarely-used-area" value="471"> 新疆
                        </div>
                        <div class="provinceItem">
                            <input type="checkbox" class="rarely-used-area" value="463"> 西藏
                        </div>
                        <div class="provinceItem">
                            <input type="checkbox" class="rarely-used-area" value="577"> 台湾
                        </div>
                        <div class="provinceItem">
                            <input type="checkbox" class="rarely-used-area" value="599"> 香港
                        </div>
                        <div class="provinceItem">
                            <input type="checkbox" class="rarely-used-area" value="576"> 澳门
                        </div>
                        <div class="provinceItem">
                            <input type="checkbox" class="rarely-used-area" value="531"> 中国其他
                        </div>
                    </div>
                </div>

                <div class="control-group save-plan">
                    <span class="btn btn-primary area-list-show-input">保存为模板</span>
                </div>
                <div class="control-group show-area-input dpn">
                    <input type="text" class="form-control fl mr10 area-template-name" placeholder="模板名">
                    <span class="cp save-area-operate">
                        <i class="fa fa-check-circle-o s_fc_brand s_fs_26 h32 lh32"></i>
                    </span>
                    <span class="cp cancel-plan-operate">
                        <i class="fa fa-times-circle-o s_fc_9 s_fs_26 h32 lh32"></i>
                    </span>
                </div>
                <div class="control-group save-success dpn">
                    <i class="fa fa-check-circle-o s_fc_green s_fs_26 h32 lh32"></i>
                    <span>保存成功</span>
                </div>
                <input type="hidden" class="ajax-get-user-area-templates"
                       value="<?php echo \yii\helpers\Url::toRoute('template/ajax-get-user-area-templates') ?>">
                <input type="hidden" class="ajax_create_area_template"
                       value="<?php echo \yii\helpers\Url::toRoute('template/ajax-create-area-template') ?>">
            </div>
        </div>

        <div class="form-inline pd10">
            <div class="form-inline">
                <label for="name">时段设置</label>
                <label class="radio-inline">
                    <input type="radio" name="period_type" class="period-type"
                           value="1" <?= ($setPlan['period_type'] == 1) ? 'checked' : '' ?>> 自定义
                </label>
                <label class="radio-inline">
                    <input type="radio" name="period_type" class="period-type" value="2"
                           checked <?= ($setPlan['period_type'] == 2) ? 'checked' : '' ?>> 使用模板
                </label>
                <select class="form-control time-template" name="time_template_id">
                    <?php foreach ($setPlan['userTimeTemplates'] as $k => $v) { ?>
                        <option value="<?= $v['time_template_id'] ?>"><?= $v['time_template_name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <?= \yii\helpers\Html::jsFile('@web/vendor/bootstrap-select/js/bootstrap-select.js') ?>
            <?= \yii\helpers\Html::jsFile('@web/vendor/bootstrap-select/js/defaults-zh_CN.js') ?>
            <?= \yii\helpers\Html::cssFile('@web/vendor/bootstrap-select/css/bootstrap-select.css') ?>

            <div class="form-inline period-type-select ml70 mt20 bg-fafafa radius4 dpn">
                <div class="periodWrapper">
                    <div class="period">
                        <ul class="hours mt40">
                            <li class="all allselected">
                                <span class="btnInfo">时间段</span>
                                <a href="javascript:;" class="allBtn">周一至周五</a>
                            </li>

                            <li class="all allselected" style="width: 70%">
                                <select id="work-days" class="selectpicker form-control"
                                        data-live-search="true" data-actions-box="true" multiple>
                                    <?php for ($i = 1; $i <= 24; $i++) { ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php } ?>
                                </select>
                            </li>
                        </ul>
                        <ul class="hours mt40">
                            <li class="all allselected">
                                <span class="btnInfo">时间段</span>
                                <a href="javascript:;" class="allBtn">周六至周日</a>
                            </li>

                            <li class="all allselected" style="width: 70%">
                                <select id="week-ends" class="selectpicker form-control"
                                        data-live-search="true" data-actions-box="true" multiple>
                                    <?php for ($i = 1; $i <= 24; $i++) { ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php } ?>
                                </select>
                            </li>
                        </ul>
                    </div>

                    <div class="form-inline pb15 pdl1 save-period">
                        <span class="btn btn-primary period-list-show-input">保存为模板</span>
                    </div>
                    <div class="form-inline pb15 pdl1 show-period-input dpn">
                        <input type="text" class="form-control fl mr10 time-template-name" placeholder="模板名">
                        <span class="cp save-period-operate">
                            <i class="fa fa-check-circle-o s_fc_brand s_fs_26 h32 lh32"></i>
                        </span>
                        <span class="cp cancel-period-operate">
                            <i class="fa fa-times-circle-o s_fc_9 s_fs_26 h32 lh32"></i>
                        </span>
                    </div>
                    <div class="form-inline pb15 pdl1 save-time-template-success dpn">
                        <i class="fa fa-check-circle-o s_fc_green s_fs_26 h32 lh32"></i>
                        <span>保存成功</span>
                    </div>
                    <input type="hidden" class="ajax-get-user-time-templates"
                           value="<?php echo \yii\helpers\Url::toRoute('template/ajax-get-user-time-templates') ?>">
                    <input type="hidden" class="ajax-create-time-template"
                           value="<?php echo \yii\helpers\Url::toRoute('template/ajax-create-time-template') ?>">
                </div>
            </div>

        </div>

        <div class="form-inline pd10">
            <label for="name">投放日期</label>
            <input type="text" class="form-control select-time" placeholder="请选择投放日期">
            <input type="hidden" class="campaign-start-time" name="start_time" value="<?= $setPlan['start_time'] ?>">
            <input type="hidden" class="campaign-end-time" name="end_time" value="<?= $setPlan['end_time'] ?>">
        </div>

        <div class="form-inline pd10">
            <label for="name">投放方式</label>
            <label class="radio-inline">
                <input type="radio" name="speed_type" class="campaign-speed-type"
                       value="1" <?= ($setPlan['speed_type'] == 1) ? 'checked' : '' ?>>
                尽快投放
            </label>
            <label class="radio-inline">
                <input type="radio" name="speed_type" class="campaign-speed-type"
                       value="2" <?= ($setPlan['speed_type'] == 2) ? 'checked' : '' ?>> 均匀投放
            </label>
        </div>

        <div class="form-inline pd10">
            <label for="name">每日预算</label>

            <input type="text" class="form-control " placeholder="最低300元" name="day_budget"
                   value="<?= $setPlan['day_budget'] ?>"> 元

            <span class="error dpn">请输入整数</span>
        </div>
    </div>
    <!--基本信息 end -->

    <div class="control-group pd15">
        <span class="btn btn-primary create-plan">下一步，设置推广单元</span>
    </div>
    <?php \yii\bootstrap\ActiveForm::end(); ?>
</div>