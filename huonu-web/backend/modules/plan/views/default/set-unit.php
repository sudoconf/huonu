<div class="tab-pane fade in active" id="set-unit">

    <div class="control-group form-inline pd15">
        <div class="form-inline pd10">
            <label for="name">单元名称</label>
            <input style="width: 350px" type="text" class="form-control adgroup-name" placeholder="请输入单元名称"
                   name="adgroup_name" value="<?= $setUnit['adgroup_name']; ?>">
        </div>
    </div>

    <!--设置定向人群 start -->
    <div class="control-group pd15">
        <div class="well s_fs_16">
            <i class="fa fa-briefcase"></i>
            设置定向人群
        </div>
        <div class="form-inline pd10">
            <label for="name">相似宝贝定向</label>
            <span class="pdl15 s_fc_9">近期对指定宝贝的竞品宝贝感兴趣的人群</span>
            <a class="pdl15 s_fc_c cp similar-baby-orientation" data-toggle="modal"
               data-target="#similarBabyOrientation"
               data-url="<?= \yii\helpers\Url::toRoute('target/ajax-get-similar-baby-orientation') ?>">设置定向</a>
        </div>

        <div id="target_premium_131072_262144" class="pd10 dpn">
            <div class="mt10 clearfix">
                <div class="target-choose-result-item">
                    <span>喜欢相似宝贝的人群：Hisense/海信 KFR-35GW/ER33N3(1L04) 大1.5匹冷暖壁挂式空调挂机</span>
                    <a class="delete" href="javascript:;">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="mt10 clearfix">
                <div class="target-choose-result-item">
                    <span>喜欢相似宝贝的人群：Hisense/海信 KFR-35GW/ER33N3(1L04) 大1.5匹冷暖壁挂式空调挂机</span>
                    <a class="delete" href="javascript:;">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="form-inline pd10">
            <label for="name">达摩盘定向</label>
            <span class="pdl15 s_fc_9">基于达摩盘自定义组合圈定的各类人群</span>
            <a class="pdl15 s_fc_c cp damo-disk-orientation" data-toggle="modal"
               data-target="#damoDiskOrientation"
               data-url="<?= \yii\helpers\Url::toRoute('target/ajax-get-dmp-orientate') ?>">设置定向</a>
        </div>

        <div id="target_premium_128" class="pd10 dpn">
            <div class="mt10 clearfix">
                <div class="target-choose-result-item">
                    <span>火奴_品牌_A1_S1X_电商部20180518173306</span>
                    <a class="delete" href="javascript:;">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="form-inline pd10">
            <label for="name">通投</label>
            <span class="pdl15 s_fc_9">不限人群投放</span>
            <input type="checkbox" checked/>
        </div>

        <div class="form-inline pd10">
            <label for="name">营销场景定向</label>
            <span class="pdl15 s_fc_9">按用户与店铺之间更细粒度的营销关系划分圈定的人群</span>
            <a class="pdl15 s_fc_c cp marketing-scene-orientation" data-toggle="modal"
               data-target="#marketingSceneOrientation">设置定向</a>
        </div>

        <div id="target_premium_16384" class="pd10 dpn">
            <div class="mt10 clearfix">
                <div class="target-choose-result-item">
                    <span>触达人群：广告展现</span>
                    <a class="delete" href="javascript:;">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="target-choose-result-item">
                    <span>兴趣人群：广告点击</span>
                    <a class="delete" href="javascript:;">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="form-inline pd10">
            <label for="name">访客定向</label>
            <span class="pdl15 s_fc_9">近期访问过某些店铺的人群</span>
            <a class="pdl15 s_fc_c cp visitors-directional" data-toggle="modal"
               data-target="#visitorsDirectional">设置定向</a>
        </div>

        <div id="target_premium_16" class="pd10 dpn">
            <div class="mt10 clearfix">
                <div class="target-choose-result-item">
                    <span>自主店铺：海信官方旗舰店</span>
                    <a class="delete" href="javascript:;">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="form-inline pd10">
            <label for="name">智能定向</label>
            <span class="pdl15 s_fc_9">系统根据店铺人群特征推荐的优质人群</span>
            <a class="pdl15 s_fc_c cp intelligent-directional" data-toggle="modal"
               data-target="#intelligentDirectional">设置定向</a>
        </div>

        <div id="target_premium_32768_1048576" class="pd10 dpn">
            <div class="mt10 clearfix">
                <div class="target-choose-result-item">
                    <span>智能定向-店铺优质人群：智能定向-店铺</span>
                    <a class="delete" href="javascript:;">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="form-inline pd10">
            <label for="name">类目型定向-高级兴趣点</label>
            <span class="pdl15 s_fc_9">近期对某些购物兴趣点有意向的人群。兴趣点定向的升级版。</span>
            <a class="pdl15 s_fc_c cp class-orientation-advanced-interest-point" data-toggle="modal"
               data-target="#classOrientationAdvancedInterestPoint"
               data-url="<?= \yii\helpers\Url::toRoute('target/ajax-get-class-orientation-advanced-interest-point') ?>">设置定向</a>
        </div>

        <div id="target_premium_524288" class="pd10 dpn">
            <div class="mt10 clearfix">
                <div class="target-choose-result-item">
                    <span>长虹网络电视机液晶（大家电_平板电视）</span>
                    <a class="delete" href="javascript:;">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="target-choose-result-item">
                    <span>康佳网络电视32（大家电_平板电视）</span>
                    <a class="delete" href="javascript:;">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="target-choose-result-item">
                    <span>长虹电视机超高清（大家电_平板电视）</span>
                    <a class="delete" href="javascript:;">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="target-choose-result-item">
                    <span>海信65寸液晶电视机4k高清智能英寸（大家电_平板电视）</span>
                    <a class="delete" href="javascript:;">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="target-choose-result-item">
                    <span>海信超薄液晶电视机（大家电_平板电视）</span>
                    <a class="delete" href="javascript:;">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--设置定向人群 end -->

    <!--选择投放资源位 start-->
    <div class="control-group pd15">

        <div class="well s_fs_16 pd15">
            <i class="fa fa-puzzle-piece"></i>
            选择投放资源位
        </div>

        <div class="text-center pt40 pb60">
            <div class="s_fs_16 pd15">未选择任何资源位</div>
            <span class="btn btn-primary resource-list" data-toggle="modal"
                  data-target="#resourceList"
                  data-url="<?= \yii\helpers\Url::toRoute('resource/ajax-get-resource-condition') ?>"
                  data-resources-url="<?= \yii\helpers\Url::toRoute('resource/ajax-get-resources') ?>">添加资源位</span>
        </div>

        <div class="mb20 mt20 dpn">
            <div class="toolbar mb20">
                <a href="javascript:;" class="btn btn-primary mr10">
                    <i class="fa fa-plus s_fs_12"></i>
                    添加资源位
                </a>
                <a href="javascript:;" class="btn btn-default">
                    <i class="fa fa-trash-o"></i>
                    批量移除
                </a>
            </div>

            <div style="min-height: 99px; max-height: 348px; overflow-y: auto;">
                <table class="table table-hover scrolltable" id="dataTables-example">
                    <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>资源位信息</th>
                        <th>网站行业</th>
                        <th>创意最低等级</th>
                        <th>日均展现量</th>
                        <th>创意类型</th>
                        <th>资源位尺寸</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <th><input type="checkbox"></th>
                        <td>Trident</td>
                        <td>Trident</td>
                        <td>Trident</td>
                        <td>Trident</td>
                        <td>Trident</td>
                        <td>Trident</td>
                        <td>Trident</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
    <!--选择投放资源位 end-->

    <!--设置出价 start-->
    <div class="control-group pd15">

        <div class="well s_fs_16">
            <i class="fa fa-tasks"></i>
            设置出价
        </div>

        <div class="text-center pt40 pb60">
            <div class="s_fs_16">请先添加人群和资源位</div>
        </div>

        <div class="mb60 mt20 offer-assistant dpn">
            <div class="control-group form-inline pb60">
                <div class="col-md-5 lh35">
                    出价助手
                    <span class="s_fc_9">（帮您快速完成出价）</span>
                </div>
                <div class="col-md-7">
                    <label class="mr10">
                        <input type="radio" name="type" value="1">
                        <span class="ml5">市场平均价格</span>
                        <i class="fa fa-question-circle tips-help"></i>
                    </label>

                    <label class="mr10">
                        <input type="radio" name="type" value="2">
                        <span class="ml5">批量出价</span>
                        <i class="fa fa-question-circle tips-help"></i>
                    </label>

                    <div class="input-group wi100 mr30">
                        <input type="text" class="form-control">
                        <span class="input-group-addon">%</span>
                    </div>

                    <a class="btn btn-gray mr10">应用</a>
                    <a class="btn">全部展开</a>
                </div>
            </div>
            <div style="min-height: 300px; max-height: 600px; overflow-y: auto;">
                <div class="control-group form-inline pb60">

                    <div class="col-md-5 lh35">
                        <label class="mr10">
                            <input class="mr5" type="radio" name="type" value="1">
                        </label>
                        <i class="fa fa-plus-circle"></i>
                        <span class="ml5">达摩盘_平台精选：电视人群包</span>
                    </div>

                    <div class="col-md-7">
                        <div class="col-md-offset-2 col-md-10 pl40">
                            <label class="mr10">
                                <input type="radio" name="type" value="2">
                                <span class="ml5">批量出价</span>
                                <i class="fa fa-question-circle tips-help"></i>
                            </label>

                            <div class="input-group wi100 mr30">
                                <input type="text" class="form-control">
                                <span class="input-group-addon">元</span>
                            </div>

                            <span>市场平均价格<i class="fa fa-question-circle tips-help"></i> 1.50 元</span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <ul class="ml40">
                            <li style="height: 52px;">
                                <div class="col-md-5 lh35 s_fc_9">无线_流量包_网上购物_手淘app_手淘焦点图</div>
                                <div class="col-md-7">
                                    <div class="col-md-offset-2 col-md-10" style="padding-left: 97px">
                                        <span class="ml5">出价</span>

                                        <div class="input-group wi100 mr30">
                                            <input type="text" class="form-control">
                                            <span class="input-group-addon">元</span>
                                        </div>

                                        <span class="s_fc_9">市场平均价格<i class="fa fa-question-circle tips-help"></i> 1.50 元</span>
                                    </div>
                                </div>
                            </li>
                            <li style="height: 52px;">
                                <div class="col-md-5 lh35 s_fc_9">无线_流量包_网上购物_手淘app_手淘焦点图</div>
                                <div class="col-md-7">
                                    <div class="col-md-offset-2 col-md-10" style="padding-left: 97px">
                                        <span class="ml5">出价</span>

                                        <div class="input-group wi100 mr30">
                                            <input type="text" class="form-control">
                                            <span class="input-group-addon">元</span>
                                        </div>

                                        <span class="s_fc_9">市场平均价格<i class="fa fa-question-circle tips-help"></i> 1.50 元</span>
                                    </div>
                                </div>
                            </li>
                            <li style="height: 52px;">
                                <div class="col-md-5 lh35 s_fc_9">无线_流量包_网上购物_手淘app_手淘焦点图</div>
                                <div class="col-md-7">
                                    <div class="col-md-offset-2 col-md-10" style="padding-left: 97px">
                                        <span class="ml5">出价</span>

                                        <div class="input-group wi100 mr30">
                                            <input type="text" class="form-control">
                                            <span class="input-group-addon">元</span>
                                        </div>

                                        <span class="s_fc_9">市场平均价格<i class="fa fa-question-circle tips-help"></i> 1.50 元</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--设置出价 end-->

    <div class="control-group pd15">
        <span class="btn btn-primary create-plan">下一步，上传创意</span>
        <span class="btn btn-gray create-plan">返回上一步</span>
    </div>

</div>

<!--相似宝贝定向-->
<div class="modal fade" id="similarBabyOrientation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog pull-right" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header" style="padding: 18px 40px">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <div class="pull-left">
                    <span class="modal-title s_fs_16" id="myModalLabel">
                        相似宝贝定向
                    </span>
                </div>
                <div class="pull-left ml10">
                    <i class="fa fa-exclamation-circle s_fs_12 s_fc_9"></i>
                    <span class="s_fs_12">推荐宝贝人群数量“未知”状态将在投放24小时后更新</span>
                </div>
            </div>
            <div class="modal-body">

                <div class="pl40 pt20">

                    <div class="mb10" style="display: inline-block">
                        <div class="fl number-style mr10">1<span class="number-line"></span></div>
                        <div class="fl s_fs_15">选择定向人群</div>
                    </div>

                    <div class="pl40 mb25">
                        <label class="mr30">
                            <input class="mr5" type="checkbox" value="131072">喜欢相似宝贝的人群
                        </label>
                        <label class="mr30">
                            <input class="mr5" type="checkbox" value="262144">喜欢我的宝贝的人群
                        </label>
                    </div>

                    <div class="mb20">
                        <div class="fl number-style second-number-style mr10 mt4">2<span class="number-line"></span>
                        </div>
                        <div class="btn-group fl mr10">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown">
                                推荐宝贝 <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">推荐宝贝</a></li>
                                <li><a href="#">全部宝贝</a></li>
                            </ul>
                        </div>
                        <div class="input-group col-md-3">
                            <input type="text" class="form-control similar-baby-name" name="similarBabyName"
                                   placeholder="宝贝名称">
                            <span class="input-group-addon btn btn-primary similar-baby-orientation-search">搜索</span>
                        </div>
                    </div>

                </div>

                <div class="control-group table-responsive">

                    <div style="min-height: 99px; max-height: 348px; overflow-y: auto;">
                        <table class="table table-hover scrolltable" id="dataTables-example">
                            <thead>
                            <tr>
                                <th></th>
                                <th>宝贝信息</th>
                                <th></th>
                                <th>推荐指数<i class="fa fa-question-circle tips-help" data-placement="bottom"
                                           data-toggle="tab" title="根据最近30天内，统计宝贝成交金额在店铺整体成交额的比例来计算"></i></th>
                                <th>人群数量<i class="fa fa-question-circle tips-help" data-placement="bottom"
                                           data-toggle="tab" title="该定向投放一段时间后，系统预估的人群覆盖量会更加精准"></i></th>
                            </tr>
                            </thead>

                            <tbody class="similarBabyOrientationTable">
                            </tbody>
                        </table>
                    </div>

                    <div class="similarBabyOrientationPage">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left">
                    确定
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    取消
                </button>
            </div>
        </div>
    </div>
</div>

<!--达摩盘定向-->
<div class="modal fade" id="damoDiskOrientation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog pull-right" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header" style="padding: 18px 40px">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <div class="pull-left">
                    <span class="modal-title s_fs_16" id="myModalLabel">
                        达摩盘定向
                    </span>
                </div>
            </div>
            <div class="modal-body">

                <div class="pl40 pt20">
                    <div class="input-group col-md-3">
                        <input type="text" class="form-control dmp-crowd-name" name="dmp_crowd_name" placeholder="人群名称">
                        <span class="input-group-addon btn btn-primary damo-disk-orientation-search">搜索</span>
                    </div>
                </div>

                <div class="control-group table-responsive">

                    <div style="min-height: 99px; max-height: 348px; overflow-y: auto;">
                        <table class="table table-hover scrolltable" id="dataTables-example">
                            <thead>
                            <tr>
                                <th></th>
                                <th>人群名称</th>
                                <th>人群描述</th>
                                <th>人群相关度</th>
                                <th>全网人群数量</th>
                                <th>初次同步时间</th>
                            </tr>
                            </thead>

                            <tbody class="damoDiskOrientationTable">
                            </tbody>
                        </table>
                    </div>

                    <div class="damoDiskOrientationPage">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left">
                    确定
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    取消
                </button>
            </div>
        </div>
    </div>
</div>

<!--营销场景定向-->
<div class="modal fade" id="marketingSceneOrientation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog pull-right" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header" style="padding: 18px 40px">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <div class="pull-left">
                    <span class="modal-title s_fs_16" id="myModalLabel">
                        营销场景定向
                    </span>
                </div>
            </div>
            <div class="market-body">
                <ul class="market-content">
                    <li class="clearfix">
                        <div class="market-parent">
                            <label>
                                <input type="checkbox" class="mr5">触达人群
                                <i class="fa fa-question-circle tips-help"
                                   data-placement="bottom" data-toggle="tab"
                                   title="15天看过店铺投放广告的用户"
                                   data-original-title="15天看过店铺投放广告的用户"></i>
                            </label>
                        </div>
                        <div class="market-children clearfix">
                            <label>
                                <input type="checkbox" class="mr5">
                                <span>广告展现</span>
                            </label>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="market-parent">
                            <label>
                                <input type="checkbox" class="mr5">兴趣人群
                                <i class="fa fa-question-circle tips-help"
                                   data-placement="bottom" data-toggle="tab"
                                   title="15天点击过店铺投放广告的用户"
                                   data-original-title="15天点击过店铺投放广告的用户"></i>
                            </label>
                        </div>
                        <div class="market-children clearfix">
                            <label>
                                <input type="checkbox" class="mr5">
                                <span>广告点击</span>
                            </label>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="market-parent">
                            <label>
                                <input type="checkbox" class="mr5">意向人群
                                <i class="fa fa-question-circle tips-help"
                                   data-placement="bottom" data-toggle="tab"
                                   title="15天内有广告点击/内容渠道（如淘宝头条、微淘）浏览互动/进店/搜索/点击行为的用户"
                                   data-original-title="15天内有广告点击/内容渠道（如淘宝头条、微淘）浏览互动/进店/搜索/点击行为的用户"></i>
                            </label>
                        </div>
                        <div class="market-children clearfix">
                            <label>
                                <input type="checkbox" class="mr5">
                                <span>店铺搜索</span>
                            </label>
                            <label>
                                <input type="checkbox" class="mr5">
                                <span>店铺浏览</span>
                            </label>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="market-parent">
                            <label>
                                <input type="checkbox" class="mr5">行动人群
                                <i class="fa fa-question-circle tips-help"
                                   data-placement="bottom" data-toggle="tab"
                                   title="90天内有过收藏/加购店铺/宝贝行为的用户；或180天内有店铺下单（未付款）行为的用户"
                                   data-original-title="90天内有过收藏/加购店铺/宝贝行为的用户；或180天内有店铺下单（未付款）行为的用户"></i>
                            </label>
                        </div>
                        <div class="market-children clearfix">
                            <label>
                                <input type="checkbox" class="mr5">
                                <span>收藏宝贝</span>
                            </label>
                            <label>
                                <input type="checkbox" class="mr5">
                                <span>收藏店铺</span>
                            </label>
                            <label>
                                <input type="checkbox" class="mr5">
                                <span>添加购物车</span>
                            </label>
                            <label>
                                <input type="checkbox" class="mr5">
                                <span>确认订单</span>
                            </label>
                        </div>
                    </li>
                    <li class="clearfix">
                        <div class="market-parent">
                            <label>
                                <input type="checkbox" class="mr5">成交人群
                                <i class="fa fa-question-circle tips-help"
                                   data-placement="bottom" data-toggle="tab"
                                   title="180天内对您的店铺宝贝有购买行为的用户"
                                   data-original-title="180天内对您的店铺宝贝有购买行为的用户"></i>
                            </label>
                        </div>
                        <div class="market-children clearfix">
                            <label>
                                <input type="checkbox" class="mr5">
                                <span>购买宝贝</span>
                            </label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left">
                    确定
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    取消
                </button>
            </div>
        </div>
    </div>
</div>

<!--访客定向-->
<div class="modal fade" id="visitorsDirectional" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog pull-right" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header" style="padding: 18px 40px">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <div class="pull-left">
                    <span class="modal-title s_fs_16" id="myModalLabel">
                        访客定向
                    </span>
                </div>
            </div>
            <div class="modal-body" style="padding: 18px 40px">

                <div style="min-height: 370px; max-height: 730px; overflow-y: auto;">

                    <div class="mb20 clearfix">

                        <div class="shop-target-title mb10 col-md-12">
                            <label class="fl">
                                <input type="checkbox" checked>
                                <span class="s_fs_16">自主添加店铺</span>
                                <i class="fa fa-question-circle tips-help" data-placement="bottom" data-toggle="tab"
                                   title="请添加自己或者相似店铺的旺旺ID。"></i>
                            </label>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group col-md-7 mb15">
                                <input type="text" class="form-control" placeholder="输入自己或相似店铺的旺旺名">
                                <span class="input-group-addon btn btn-primary">获取推荐店铺</span>
                            </div>

                            <div class="pt5">

                                <div class="fl key-result-box">
                                    <div class="key-result-header">
                                        <span class="fl s_fc_9 mr5" style="width:130px">店铺推荐标签</span>
                                        <span class="fl s_fc_9" style="width:115px">目标人群相关度</span>
                                        <span class="fl s_fc_9">人群数量</span>
                                        <span class="fr s_fc_brand cp">全部添加</span>
                                    </div>
                                    <ul class="key-result-items" style="height: 205px;">
                                        <li class="key-result-item">
                                            <div class="fl mr5" style="width:130px">海信官方旗舰店</div>
                                            <div class="fl" style="width:115px;">
                                                <div class="relative-contain"><span class="relative-over width5"></span>
                                                </div>
                                            </div>
                                            <div class="fl" style="width: 90px;"><span
                                                        class="font-tahoma bold">80,420</span></div>
                                            <div class="fr s_fc_9 cp">添加</div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="key-result-gap">
                                    <i class="fa fa-angle-double-right"></i>
                                </div>

                                <div class="fl key-result-box">
                                    <div class="key-result-header">
                                        <span class="fl s_fc_9 mr5 pdl10" style="width:130px">已选择的标签</span>
                                        <span class="fl s_fc_9" style="width:115px">目标人群相关度</span>
                                        <span class="fl s_fc_9">人群数量</span>
                                        <a href="javascript:void(0)" class="fr s_fc_9 ml14">全部移除</a>
                                    </div>
                                    <ul class="key-result-items" style="height: 165px;">
                                        <li class="key-result-item">
                                            <div class="fl mr5" style="width:130px">海信官方旗舰店</div>
                                            <div class="fl" style="width:115px;">
                                                <div class="relative-contain"><span class="relative-over width5"></span>
                                                </div>
                                            </div>
                                            <div class="fl" style="width: 90px;"><span
                                                        class="font-tahoma bold">80,420</span></div>
                                            <div class="fr s_fc_9 cp">添加</div>
                                        </li>
                                    </ul>
                                    <div class="key-result-bottom">
                                        <span class="fl s_fc_9">已选个数 0/100</span>
                                        <!--<span class="fr btn btn-blue btn-small" value="获取圈定人数" style="margin-top:6px;">获取圈定人群</span>-->
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>


                    <div class="mb20 clearfix">

                        <div class="shop-target-title mb10 col-md-12">
                            <label class="fl cp">
                                <input class="add-seed-shop" type="checkbox">
                                <span class="s_fs_16">添加种子店铺</span>
                                <i class="fa fa-question-circle tips-help" data-placement="bottom" data-toggle="tab"
                                   title="请添加自己或者相似店铺的旺旺ID，建议输入1个。"></i>
                            </label>
                        </div>

                        <div class="col-md-12 dpn add-seed-shop-div">

                            <div class="pt5">

                                <div class="fl key-result-box">
                                    <div class="key-result-header">
                                        <span class="fl s_fc_9 mr5 pdl30" style="width: 313px">已选择的标签</span>
                                        <a href="javascript:void(0)" class="fr s_fc_9 ml14">全部移除</a>
                                    </div>
                                    <ul class="key-result-items" style="height: 205px;">
                                        <li class="key-result-item">
                                            <div class="fl mr5" style="width:30px; text-align: center">1</div>
                                            <div class="fl mr5" style="width:130px">海信官方旗舰店</div>
                                            <div class="fr s_fc_9 cp">添加</div>
                                        </li>
                                    </ul>

                                    <div class="key-result-bottom">
                                        <span class="fl s_fc_9">已选个数 0/5</span>
                                        <!--<span class="fr btn btn-blue btn-small" value="获取圈定人数" style="margin-top:6px;">获取圈定人群</span>-->
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left">
                    确定
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    取消
                </button>
            </div>
        </div>
    </div>
</div>

<!--智能定向-->
<div class="modal fade" id="intelligentDirectional" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog pull-right" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header" style="padding: 18px 40px">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <div class="pull-left">
                    <span class="modal-title s_fs_16" id="myModalLabel">
                        智能定向
                    </span>
                </div>
                <div class="pull-left ml10">
                    <span class="s_fs_12">若圈定人数无法显示，开启后24小时生效。</span>
                </div>
            </div>
            <div class="modal-body" style="padding: 18px 40px">

                <div class="mt20 mb20">
                    <div class="pt10 pb10">
                        <label class="mr20">
                            <input type="checkbox">
                            <span class="ml5">智能定向-店铺优质人群</span>
                        </label>
                        <span class="s_fc_9">系统根据您的店铺现状为您挑选的优质人群。勾选店铺时建议您投放到店铺页面效果更佳。</span>
                    </div>
                    <div class="pt10 pb10">
                        <label class="mr20">
                            <input type="checkbox">
                            <span class="ml5">智能定向-店铺扩展人群（原系统智能推荐）</span>
                        </label>
                        <span class="s_fc_9">系统根据店铺人群特征推荐的优质人群</span>
                    </div>
                    <div class="pt10 pb10">
                        <label class="mr20">
                            <input type="checkbox">
                            <span class="ml5">智能定向-宝贝优质人群</span>
                        </label>
                        <span class="s_fc_9">系统根据您选择的宝贝为您挑选的优质人群。勾选宝贝时建议您投放到宝贝详情页效果更佳。</span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left">
                    确定
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    取消
                </button>
            </div>
        </div>
    </div>
</div>

<!--类目型定向-高级兴趣点-->
<div class="modal fade" id="classOrientationAdvancedInterestPoint" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog pull-right" style="width: 70%;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 18px 40px">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <div class="pull-left">
                    <span class="modal-title s_fs_16" id="myModalLabel">
                        类目型定向-高级兴趣点
                    </span>
                </div>
            </div>
            <div class="modal-body" style="padding: 18px 40px">

                <div style="min-height: 370px; max-height: 730px; overflow-y: auto;">

                    <div class="mb20 clearfix">

                        <div class="col-md-12">
                            <div class="input-group col-md-6 mb15">
                                <input type="text" class="form-control" placeholder="这里可以输入兴趣点的关键词进行搜索，如：连衣裙">
                                <span class="input-group-addon btn btn-primary">搜索</span>
                            </div>

                            <div class="pt5">

                                <div class="fl key-result-box">
                                    <div class="key-result-header">
                                        <span class="fl s_fc_9 mr5" style="width:100px">标签</span>
                                        <span class="fl s_fc_9" style="width:100px">所属类目</span>
                                        <span class="fl s_fc_9" style="width: 82px">人群相关度</span>
                                        <span class="fl s_fc_9" style="width: 76px">人群数量</span>
                                        <span class="fr s_fc_brand cp hover-add-all">全部添加</span>
                                    </div>

                                    <div class="bb-e6 pt5 pb5 pdl10 clearfix">
                                        <div class="fl s_fc_9 lh32" style="width: 100px;">标签筛选：</div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <span>全部类目</span> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a class="cp">全部类目</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <ul class="key-hover-items class-orientation-advanced-interest-point-ul"
                                        style="height: 303px;">
                                    </ul>
                                </div>

                                <div class="key-result-gap" style="height: 403px; line-height: 403px">
                                    <i class="fa fa-angle-double-right"></i>
                                </div>

                                <div class="fl key-result-box">
                                    <div class="key-result-header">
                                        <span class="fl s_fc_9 mr5 pdl10" style="width:100px">标签</span>
                                        <span class="fl s_fc_9" style="width:100px">所属类目</span>
                                        <span class="fl s_fc_9" style="width: 82px">人群相关度</span>
                                        <span class="fl s_fc_9" style="76px">人群数量</span>
                                        <span class="fr cp s_fc_9 ml14 hover-remove-all">全部移除</span>
                                    </div>
                                    <ul class="key-result-items class-orientation-advanced-interest-point-ul-r"
                                        style="height: 310px;">
                                    </ul>
                                    <div class="key-result-bottom">
                                        <span class="fl s_fc_9  selected-number">已选个数 0/50</span>
                                        <!--<span class="fr btn btn-blue btn-small" value="获取圈定人数" style="margin-top:6px;">获取圈定人群</span>-->
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left">
                    确定
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    取消
                </button>
            </div>
        </div>
    </div>
</div>

<!--资源位列表-->
<div class="modal fade" id="resourceList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog pull-right" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header" style="padding: 18px 40px">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <div class="pull-left">
                    <span class="modal-title s_fs_16" id="myModalLabel">
                        资源位列表
                    </span>
                </div>
            </div>
            <div class="modal-body">

                <div class="dialog-body mb20 bb-e6 clearfix">
                    <ul class="adzoneGroups resource-list-ul">
                    </ul>
                </div>

                <div class="control-group clearfix" style="padding-left: 13px">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown">
                            全部收藏状态 <span class="top"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" style=" margin-top: 0px">
                            <li><a href="#">全部收藏状态</a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown">
                            全部资源位类型 <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" style=" margin-top: 0px">
                            <li><a href="#">全部资源位类型</a></li>
                        </ul>
                    </div>

                    <div class="input-group col-md-3 pull-right">
                        <input type="text" class="form-control" placeholder="搜索资源位">
                        <span class="input-group-addon btn btn-primary">搜索</span>
                    </div>
                </div>

                <div class="control-group table-responsive">

                    <div style="min-height: 99px; max-height: 348px; overflow-y: auto;">
                        <table class="table table-hover scrolltable" id="dataTables-example">
                            <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th><span class="cp tips-help" data-placement="bottom" data-toggle="tab" title="资源位名称。">资源位</span>
                                </th>
                                <th><span class="cp tips-help" data-placement="bottom" data-toggle="tab"
                                          title="资源位所属的网站行业。">网站行业</span></th>
                                <th><span class="cp tips-help" data-placement="bottom" data-toggle="tab"
                                          title="创意等级是指钻石展位根据每个媒体广告位的要求不同，将您提交的创意区分不同的等级，以便匹配投放对应的资源位。">创意最低等级</span>
                                </th>
                                <th><span class="cp tips-help" data-placement="bottom" data-toggle="tab"
                                          title="资源位可以投放的创意类型。">创意类型</span></th>
                                <th><span class="cp tips-help" data-placement="bottom" data-toggle="tab"
                                          title="资源位所能接受的全部创意的尺寸。">资源位尺寸</span></th>
                                <th><span class="cp tips-help" data-placement="bottom" data-toggle="tab"
                                          title="该资源位最近7天平均每天可竞得的最大流量。">日均可竞流量</span></th>
                                <th><span class="cp tips-help" data-placement="bottom" data-toggle="tab"
                                          title="该资源位最近7天平均点击率，点击率=点击量/展现量。">点击率</span></th>
                                <th><span class="cp tips-help">上架时间</span></th>
                                <th><span class="cp tips-help" data-placement="bottom" data-toggle="tab"
                                          title="该指数用来衡量点击单价的高低，范围为1~10，点击单价越低，指数越高，代表该资源位越好。">点击单价指数</span></th>
                                <th><span class="cp tips-help" data-placement="bottom" data-toggle="tab"
                                          title="该指数用来衡量千次展现成本的高低，范围为1~10，千次展现成本越低，指数越高，代表该资源位越好。">展现成本指数</span></th>
                                <th><span class="cp tips-help" data-placement="bottom" data-toggle="tab"
                                          title="该指数用来衡量资源位的竞价深度，范围为1~10，购买该资源位的广告主越多，竞争热度越高。">竞争热度</span></th>
                                <th><span class="cp tips-help" data-placement="bottom" data-toggle="tab"
                                          title="该指数用来衡量您选择的目标人群对资源位的偏好度，范围为1~10，偏好度指数越高，代表您选择的目标人群对这个资源位的偏好度越高，投放效果越好。">偏好度指数</span>
                                </th>
                                <th><span class="cp tips-help" data-placement="bottom" data-toggle="tab"
                                          title="该指数是基于对资源位的可竞流量、点击成本、千次展现成本和竞争热度等因素综合考虑给出的推荐值，范围为1~10。综合推荐指数越高，代表该资源位越好。">综合推荐指数</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="resource-list-tr">
                            <tr>
                                <th><input type="checkbox"></th>
                                <td>Trident</td>
                                <td>Trident</td>
                                <td>Trident</td>
                                <td>Trident</td>
                                <td>Trident</td>
                                <td>Trident</td>
                                <td>Trident</td>
                                <td>Trident</td>
                                <td>Trident</td>
                                <td>Trident</td>
                                <td>Trident</td>
                                <td>Trident</td>
                                <td>Trident</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left">
                    确定
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    取消
                </button>
            </div>
        </div>
    </div>
</div>

