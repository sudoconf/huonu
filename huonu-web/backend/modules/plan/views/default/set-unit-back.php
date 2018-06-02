<div class="tab-pane fade" id="set-unit">

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
            <i class="fa fa-bar-chart-o fa-fw"></i>
            设置定向人群
        </div>
        <div class="form-inline pd10">
            <label for="name">相似宝贝定向</label>
            <span class="pdl15 s_fc_9">近期对指定宝贝的竞品宝贝感兴趣的人群</span>
            <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
        </div>

        <div class="form-inline pd10">
            <label for="name">达摩盘定向</label>
            <span class="pdl15 s_fc_9">基于达摩盘自定义组合圈定的各类人群</span>
            <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
        </div>

        <div class="form-inline pd10">
            <label for="name">通投</label>
            <span class="pdl15 s_fc_9">不限人群投放</span>
            <input type="checkbox" id="inlineCheckbox2" value="option2">
        </div>

        <div class="form-inline pd10">
            <label for="name">营销场景定向</label>
            <span class="pdl15 s_fc_9">按用户与店铺之间更细粒度的营销关系划分圈定的人群</span>
            <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
        </div>

        <div class="form-inline pd10">
            <label for="name">访客定向</label>
            <span class="pdl15 s_fc_9">近期访问过某些店铺的人群</span>
            <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
        </div>

        <div class="form-inline pd10">
            <label for="name">行业店铺定向</label>
            <span class="pdl15 s_fc_9">近期访问过行业优质店铺的人群</span>
            <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
        </div>

        <div class="form-inline pd10">
            <label for="name">智能定向</label>
            <span class="pdl15 s_fc_9">系统根据店铺人群特征推荐的优质人群</span>
            <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
        </div>

        <div class="form-inline pd10">
            <label for="name">类目型定向-高级兴趣点</label>
            <span class="pdl15 s_fc_9">近期对某些购物兴趣点有意向的人群。兴趣点定向的升级版。</span>
            <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
        </div>

        <div class="form-inline pd10">
            <label for="name">店铺型定向</label>
            <span class="pdl15 s_fc_9">近期对某类店铺感兴趣的人群，或自己店铺的重定向人群</span>
            <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
        </div>

        <div class="form-inline pd10">
            <label for="name">达摩盘_平台精选</label>
            <span class="pdl15 s_fc_9">基于达摩盘丰富标签，由平台配置推荐的个性化人群包，满足您在活...</span>
            <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
        </div>
    </div>
    <!--设置定向人群 end -->

    <!--选择投放资源位 start-->
    <div class="control-group pd15">

        <div class="well s_fs_16 pd15">
            <i class="fa fa-bar-chart-o fa-fw"></i>
            选择投放资源位
        </div>

        <div class="text-center pt40 pb60">
            <div class="s_fs_16 pd15">未选择任何资源位</div>
            <span class="btn btn-primary">添加资源位</span>
        </div>

    </div>
    <!--选择投放资源位 end-->

    <!--设置出价 start-->
    <div class="control-group pd15">

        <div class="well s_fs_16">
            <i class="fa fa-bar-chart-o fa-fw"></i>
            设置出价
        </div>

        <div class="text-center pt40 pb60 handle-unit-crossover-premium">
            <div class="s_fs_16">请先添加人群和资源位</div>
        </div>

        <div class="mb60 mt20 offer-assistant dpn set-price">
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
            <div class="set-price-div" style="min-height: 300px; max-height: 600px; overflow-y: auto;">

                <div class="control-group form-inline pb60">
                    <div class="col-md-5 lh35">
                        <label class="mr10">
                            <input class="mr5" type="radio" name="type" value="1">
                        </label>
                        <i class="fa fa-minus-circle cp"></i>
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
                <div class="control-group form-inline pb60">
                    <div class="col-md-5 lh35">
                        <label class="mr10">
                            <input class="mr5" type="radio" name="type" value="1">
                        </label>
                        <i class="fa fa-minus-circle cp"></i>
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