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
    <div class="control-group pd15">
        <div class="form-inline pd10">
            <label for="name">店铺名称</label>
            <input type="text" class="form-control taobao-shop-name" placeholder="请输入店铺名称">
            <input type="hidden" class="taobao-shop-id" name="taobao_user_id">
            <input type="hidden" class="taobao-shop-name" id="taobao_shop_name">
        </div>
    </div>

    <!--设置营销参数 start -->
    <div class="control-group pd15">
        <!--<div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i>
                设置营销参数
            </div>
        </div>-->
        <div class="well s_fs_16 pd15">
            <i class="fa fa-bar-chart-o fa-fw"></i>
            设置营销参数
        </div>
        <div class="form-inline pd10">
            <div class="planBoxContent">
                <div class="mb30 pr pdl90">
                    <div style="position: absolute; top: 20px; left: 0;" class="lh32">
                        <label>营销场景</label>
                    </div>
                    <div class="bg-fafafa radius4 pdl20 pdr20">
                        <!--                        <div class="bb-e6 pt20 pb20 lh32">-->
                        <!--                            <div class="pr" style="padding-left: 72px;">-->
                        <!--                                <div style="position: absolute; top: 0; left: 0; width: 72px; color: #999;">-->
                        <!--                                    常规场景-->
                        <!--                                </div>-->
                        <!--                                <div class="clearfix">-->
                        <!--                                    <div class="mr20 fl pr">-->
                        <!--                                        <input name="sceneRadio" class="mr5" type="radio" value="1">-->
                        <!--                                        <span>日常销售</span>-->
                        <!--                                    </div>-->
                        <!--                                    <div class="mr20 fl pr">-->
                        <!--                                        <input name="sceneRadio" class="mr5" type="radio" value="2">-->
                        <!--                                        <span>认知转化</span>-->
                        <!--                                    </div>-->
                        <!--                                    <div class="mr20 fl pr">-->
                        <!--                                        <input name="sceneRadio" class="mr5" type="radio" value="3">-->
                        <!--                                        <span>拉新</span>-->
                        <!--                                    </div>-->
                        <!--                                    <div class="mr20 fl pr">-->
                        <!--                                        <input name="sceneRadio" class="mr5" type="radio" value="4">-->
                        <!--                                        <span>老客召回</span>-->
                        <!--                                    </div>-->
                        <!--                                    <div class="mr20 fl pr">-->
                        <!--                                        <input name="sceneRadio" class="mr5" type="radio" value="0">-->
                        <!--                                        <span>自定义</span>-->
                        <!--                                    </div>-->
                        <!--                                    <div class="mr20 fl pr">-->
                        <!--                                        <input name="sceneRadio" class="mr5" type="radio" value="15">-->
                        <!--                                        <span>合约保量<i class="fa fa-question-circle tips-help"></i></span>-->
                        <!--                                    </div>-->
                        <!--                                    <div class="mr20 fl pr">-->
                        <!--                                        <input name="sceneRadio" class="mr5" type="radio" value="52">-->
                        <!--                                        <span>拉新保量<i class="fa fa-question-circle tips-help"></i></span>-->
                        <!--                                    </div>-->
                        <!--                                    <div class="mr20 fl pr">-->
                        <!--                                        <input name="sceneRadio" class="mr5" type="radio" value="20">-->
                        <!--                                        <span>站外拉新<i class="fa fa-question-circle tips-help"></i></span>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!---->
                        <!--                        </div>-->
                        <div class="pt20 pb20">
                            <!--                            <div class="mb15 pr" style="padding-left: 72px;">-->
                            <!--                                <div style="position: absolute; top: 0; left: 0; width: 72px; color: #999; line-height: 32px;">-->
                            <!--                                    场景命名-->
                            <!--                                </div>-->
                            <!--                                <div>-->
                            <!--                                    <input type="text" class="form-control" placeholder="请输入场景命名">-->
                            <!--                                </div>-->
                            <!--                            </div>-->

                            <!--                            <div class="mb10 lh32 pr" style="padding-left: 72px;">-->
                            <!--                                <div style="position: absolute; top: 0; left: 0; width: 72px; color: #999;">-->
                            <!--                                    目标人群-->
                            <!--                                </div>-->
                            <!--                                <div class="clearfix">-->
                            <!--                                    <div class="mr20 fl">-->
                            <!--                                        <input class="mr5" name="targetBuyer" type="checkbox">-->
                            <!--                                        <span>广泛未触达用户<i class="fa fa-question-circle tips-help"></i></span>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="mr20 fl">-->
                            <!--                                        <input class="mr5" name="targetBuyer" type="checkbox" value="64">-->
                            <!--                                        <span>精准未触达用户<i class="fa fa-question-circle tips-help"></i></span>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="mr20 fl">-->
                            <!--                                        <input class="mr5" name="targetBuyer" type="checkbox" value="2">-->
                            <!--                                        <span>触达用户<i class="fa fa-question-circle tips-help"></i></span>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="mr20 fl">-->
                            <!--                                        <input class="mr5" name="targetBuyer" type="checkbox" value="4">-->
                            <!--                                        <span>认知用户<i class="fa fa-question-circle tips-help"></i></span>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="mr20 fl">-->
                            <!--                                        <input class="mr5" name="targetBuyer" type="checkbox" value="8">-->
                            <!--                                        <span>成交用户<i class="fa fa-question-circle tips-help"></i></span>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->

                            <div class="mb10 lh32 pr" style="padding-left: 72px;">
                                <div style="position: absolute; top: 0; left: 0; width: 72px; color: #999; cursor: help;">
                                    营销目标
                                </div>
                                <div class="clearfix">
                                    <div class="mr20 fl">
                                        <input class="mr5" name="marketingAim" type="radio">
                                        <span>不限</span>
                                    </div>
                                    <div class="mr20 fl">
                                        <input class="mr5" name="marketingAim" type="radio" value="1">
                                        <span>促进购买</span>
                                    </div>
                                    <div class="mr20 fl">
                                        <input class="mr5" name="marketingAim" type="radio" value="2">
                                        <span>促进进店</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--                <div class="mb20">-->
                <!--                    <div class="w90 fl">-->
                <!--                        <label>生成方案</label>-->
                <!--                    </div>-->
                <!--                    <div class="clearfix fl">-->
                <!--                        <div class="mr20 fl">-->
                <!--                            <input class="mr5" name="targetBuyer" type="radio">-->
                <!--                            <span>系统托管<i class="fa fa-question-circle tips-help"></i></span>-->
                <!--                        </div>-->
                <!--                        <div class="mr20 fl">-->
                <!--                            <input class="mr5" name="targetBuyer" type="radio" value="64">-->
                <!--                            <span>系统推荐<i class="fa fa-question-circle tips-help"></i></span>-->
                <!--                        </div>-->
                <!--                        <div class="mr20 fl">-->
                <!--                            <input class="mr5" name="targetBuyer" type="radio" value="2">-->
                <!--                            <span>自定义<i class="fa fa-question-circle tips-help"></i></span>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
            </div>
        </div>
    </div>
    <!--设置营销参数 end -->

    <!--基本信息 start -->
    <div class="control-group mt20 pd15">
        <div class="well s_fs_16">
            <i class="fa fa-bar-chart-o fa-fw"></i>
            基本信息
        </div>

        <div class="form-inline pd10">
            <label for="name">计划名称</label>
            <input style="width: 300px" type="text" class="form-control campaign-name" placeholder="请输入计划名称"
                   name="campaign_name" value="<?= $setPlan['campaign_name']; ?>">
        </div>

        <div class="form-inline pd10">
            <label for="name">付款方式</label>
            <label class="radio-inline">
                <input type="radio" name="campaign_type" class="campaign-type" value="2" checked> 按展现付费（CPM）
            </label>
            <label class="radio-inline">
                <input type="radio" name="campaign_type" class="campaign-type" value="8"> 按点击付费（CPC）
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
                <select class="form-control">
                    <option>常用地域(系统模板)</option>
                </select>
                <input type="hidden" class="area-template-id" name="area_template_id">
            </div>

            <div class="form-inline region-select ml70 pa20 mt20 bg-fafafa radius4" style="display: block">

                <div class="control-group input-group col-md-5">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="搜索">
                </div>

                <div class="control-group pt25 pb10">
                    <div class="form-inline">
                        <input type="checkbox" id="select-all-common-area" class="select-all-common-area">
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
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
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
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
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
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
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
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
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
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="68"> 广东
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="92"> 广西
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="109"> 贵州
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
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
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="165"> 黑龙江
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="125"> 河北
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="145"> 河南
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="184"> 湖北
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="212"> 湖南
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
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
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="234"> 吉林
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="255"> 江苏
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
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
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
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
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="333"> 内蒙古
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
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
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
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
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="393"> 山西
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="406"> 陕西
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="368"> 山东
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
                                               value="417"> 上海
                                    </div>
                                    <div class="provinceItem">
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
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
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
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
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
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
                                        <input type="checkbox" name="area-id-list[]" class="common-area"
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
                            <input type="checkbox" name="area-id-list[]" class="rarely-used-area" value="471"> 新疆
                        </div>
                        <div class="provinceItem">
                            <input type="checkbox" name="area-id-list[]" class="rarely-used-area" value="463"> 西藏
                        </div>
                        <div class="provinceItem">
                            <input type="checkbox" name="area-id-list[]" class="rarely-used-area" value="577"> 台湾
                        </div>
                        <div class="provinceItem">
                            <input type="checkbox" name="area-id-list[]" class="rarely-used-area" value="599"> 香港
                        </div>
                        <div class="provinceItem">
                            <input type="checkbox" name="area-id-list[]" class="rarely-used-area" value="576"> 澳门
                        </div>
                        <div class="provinceItem">
                            <input type="checkbox" name="area-id-list[]" class="rarely-used-area" value="531"> 中国其他
                        </div>
                    </div>
                </div>

                <div class="control-group save-plan">
                    <span class="btn btn-primary area-list-show-input">保存为模板</span>
                </div>
                <div class="control-group show-area-input" style="display: none">
                    <input type="text" class="form-control fl mr10 area-template-name" placeholder="模板名" name="area_template_name">
                    <span class="cp save-area-operate">
                        <i class="fa fa-check-circle-o s_fc_brand s_fs_26 h32 lh32"></i>
                    </span>
                    <span class="cp cancel-plan-operate">
                        <i class="fa fa-times-circle-o s_fc_9 s_fs_26 h32 lh32"></i>
                    </span>
                </div>
                <input type="hidden" class="ajax_create_area_template" value="<?php echo \yii\helpers\Url::toRoute('template/ajax-create-area-template')?>">
            </div>
        </div>

        <div class="form-inline pd10">
            <div class="form-inline">
                <label for="name">时段设置</label>
                <label class="radio-inline">
                    <input type="radio" name="period_type" class="period-type" value="1"> 自定义
                </label>
                <label class="radio-inline">
                    <input type="radio" name="period_type" class="period-type" value="2" checked> 使用模板
                </label>
                <select class="form-control">
                    <option>时段全选(系统模板)</option>
                </select>
                <input type="hidden" class="time-template-id" name="time_template_id">
            </div>

            <div class="form-inline period-type-select ml70 mt20 bg-fafafa radius4" style="display: none">
                <div class="periodWrapper">
                    <div class="period">
                        <ul class="hours mt40">
                            <li class="all allselected">
                                <span class="btnInfo">时间段</span>
                                <a href="javascript:;" class="allBtn">周一至周五</a>
                            </li>

                            <li class="one hour milestone selected" value="0">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 10; display: block;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">0</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 10; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">1</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">0</span>
                                </div>
                            </li>

                            <li class="one hour selected" value="1" id="mx_n_17">
                                <div class="hourInner" id="mx_n_20">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 11; display: none;"
                                     id="mx_n_16">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">1</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 11; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">2</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">1</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="2" id="mx_n_19">
                                <div class="hourInner" id="mx_n_18">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 12; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">2</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 12; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">3</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">2</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="3">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 13; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">3</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 13; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">4</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">3</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="4">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 14; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">4</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 14; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">5</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">4</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="5">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 15; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">5</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 15; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">6</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">5</span>
                                </div>
                            </li>
                            <li class="one hour milestone selected" value="6">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 16; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">6</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 16; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">7</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">6</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="7">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 17; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">7</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 17; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">8</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">7</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="8">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 18; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">8</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 18; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">9</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">8</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="9">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 19; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">9</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 19; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">10</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">9</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="10">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 20; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">10</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 20; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">11</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">10</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="11">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 21; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">11</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 21; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">12</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">11</span>
                                </div>
                            </li>
                            <li class="one hour milestone selected" value="12">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 22; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">12</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 22; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">13</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">12</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="13">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 23; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">13</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 23; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">14</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">13</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="14">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 24; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">14</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 24; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">15</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">14</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="15">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 25; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">15</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 25; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">16</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">15</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="16">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 26; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">16</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 26; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">17</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">16</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="17">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 27; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">17</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 27; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">18</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">17</span>
                                </div>
                            </li>
                            <li class="one hour milestone selected" value="18">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 28; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">18</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 28; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">19</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">18</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="19">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 29; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">19</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 29; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">20</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">19</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="20">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 30; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">20</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 30; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">21</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">20</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="21">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 31; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">21</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 31; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">22</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">21</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="22">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 32; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">22</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 32; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">23</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">22</span>
                                </div>
                            </li>
                            <li class="one hour  selected" value="23">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 33; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">23</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 33; display: block;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">24</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">23</span>
                                </div>
                            </li>
                            <li class="hour milestone hourLast">
                                <span class="hourLine">
                                    <span class="hourInfo">24</span>
                                </span>
                            </li>
                        </ul>

                        <ul class="hours mt40">
                            <li class="all allselected">
                                <span class="btnInfo">时间段</span>
                                <a href="javascript:;" class="allBtn">周六至周日</a>
                            </li>

                            <li class="one hour milestone selected" value="0">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 10; display: block;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">0</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 10; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">1</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">0</span>
                                </div>
                            </li>

                            <li class="one hour selected" value="1" id="mx_n_17">
                                <div class="hourInner" id="mx_n_20">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 11; display: none;"
                                     id="mx_n_16">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">1</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 11; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">2</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">1</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="2" id="mx_n_19">
                                <div class="hourInner" id="mx_n_18">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 12; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">2</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 12; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">3</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">2</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="3">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 13; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">3</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 13; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">4</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">3</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="4">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 14; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">4</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 14; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">5</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">4</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="5">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 15; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">5</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 15; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">6</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">5</span>
                                </div>
                            </li>
                            <li class="one hour milestone selected" value="6">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 16; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">6</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 16; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">7</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">6</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="7">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 17; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">7</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 17; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">8</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">7</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="8">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 18; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">8</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 18; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">9</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">8</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="9">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 19; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">9</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 19; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">10</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">9</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="10">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 20; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">10</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 20; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">11</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">10</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="11">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 21; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">11</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 21; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">12</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">11</span>
                                </div>
                            </li>
                            <li class="one hour milestone selected" value="12">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 22; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">12</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 22; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">13</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">12</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="13">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 23; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">13</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 23; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">14</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">13</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="14">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 24; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">14</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 24; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">15</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">14</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="15">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 25; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">15</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 25; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">16</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">15</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="16">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 26; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">16</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 26; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">17</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">16</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="17">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 27; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">17</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 27; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">18</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">17</span>
                                </div>
                            </li>
                            <li class="one hour milestone selected" value="18">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 28; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">18</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 28; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">19</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">18</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="19">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 29; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">19</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 29; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">20</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">19</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="20">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 30; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">20</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 30; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">21</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">20</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="21">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 31; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">21</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 31; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">22</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">21</span>
                                </div>
                            </li>
                            <li class="one hour selected" value="22">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 32; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">22</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 32; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">23</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">22</span>
                                </div>
                            </li>
                            <li class="one hour  selected" value="23">
                                <div class="hourInner">
                                    <span class="hourInnerTop"></span>
                                </div>
                                <div class="curLineStart"
                                     style="z-index: 33; display: none;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">23</span>
                                </div>
                                <div class="curLineEnd"
                                     style="z-index: 33; display: block;">
                                    <span class="lineArrow"></span>
                                    <span class="lineInfo">24</span>
                                </div>
                                <div class="hourLine">
                                    <span class="hourInfo">23</span>
                                </div>
                            </li>
                            <li class="hour milestone hourLast">
                                <span class="hourLine">
                                    <span class="hourInfo">24</span>
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="form-inline pb15 pdl1">
                        <span class="btn btn-primary">清空</span>
                        <span class="pull-right">蓝色为已选投放时段</span>
                    </div>

                    <div class="form-inline pb15 pdl1 save-period">
                        <span class="btn btn-primary period-list-show-input">保存为模板</span>
                    </div>
                    <div class="form-inline pb15 pdl1 show-period-input" style="display: none">
                        <input type="text" class="form-control fl mr10" placeholder="模板名" name="area_template_name">
                        <span class="cp save-period-operate">
                            <i class="fa fa-check-circle-o s_fc_brand s_fs_26 h32 lh32"></i>
                        </span>
                        <span class="cp cancel-period-operate">
                            <i class="fa fa-times-circle-o s_fc_9 s_fs_26 h32 lh32"></i>
                        </span>
                    </div>
                </div>
            </div>

        </div>

        <div class="form-inline pd10">
            <label for="name">投放日期</label>
            <input type="text" class="form-control select-time" placeholder="请选择投放日期">
            <input type="hidden" class="campaign-start-time" name="campaign_start_time">
            <input type="hidden" class="campaign-end-time" name="campaign_end_time">
        </div>

        <div class="form-inline pd10">
            <label for="name">投放方式</label>
            <label class="radio-inline">
                <input type="radio" name="campaign_speed_type" class="campaign-speed-type" value="1" checked>
                尽快投放
            </label>
            <label class="radio-inline">
                <input type="radio" name="campaign_speed_type" class="campaign-speed-type" value="2"> 均匀投放
            </label>
        </div>

        <div class="form-inline pd10">
            <div class="form-group">
                <label for="name">每日预算</label>
            </div>
            <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="text" class="form-control " placeholder="最低300元" name="campaign_day_budget">
                <span class="input-group-addon">.00</span>
            </div>
        </div>
    </div>
    <!--基本信息 end -->

    <div class="control-group pd15">
        <span class="btn btn-primary create-plan">下一步，设置推广单元</span>
    </div>
    <?php \yii\bootstrap\ActiveForm::end(); ?>
</div>