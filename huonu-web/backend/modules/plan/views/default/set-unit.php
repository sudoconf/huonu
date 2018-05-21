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
            <i class="fa fa-bar-chart-o fa-fw"></i>
            设置定向人群
        </div>
        <div class="form-inline pd10">
            <label for="name">相似宝贝定向</label>
            <span class="pdl15 s_fc_9">近期对指定宝贝的竞品宝贝感兴趣的人群</span>
            <a class="pdl15 s_fc_c cp similar-baby-orientation" data-toggle="modal"
               data-target="#similarBabyOrientation">设置定向</a>
        </div>

        <div class="form-inline pd10">
            <label for="name">达摩盘定向</label>
            <span class="pdl15 s_fc_9">基于达摩盘自定义组合圈定的各类人群</span>
            <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
        </div>

        <div class="form-inline pd10">
            <label for="name">通投</label>
            <span class="pdl15 s_fc_9">不限人群投放</span>
            <input type="checkbox" checked/>
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
            <label for="name">智能定向</label>
            <span class="pdl15 s_fc_9">系统根据店铺人群特征推荐的优质人群</span>
            <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
        </div>

        <div class="form-inline pd10">
            <label for="name">类目型定向-高级兴趣点</label>
            <span class="pdl15 s_fc_9">近期对某些购物兴趣点有意向的人群。兴趣点定向的升级版。</span>
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

        <div class="text-center pt40 pb60">
            <div class="s_fs_16">请先添加人群和资源位</div>
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
    <div class="modal-dialog pull-right" style="width: 998px">
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
                            <input type="text" class="form-control" placeholder="宝贝名称">
                            <span class="input-group-addon btn btn-primary">搜索</span>
                        </div>
                    </div>

                </div>

                <div class="control-group table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th></th>
                            <th>宝贝信息</th>
                            <th>
                                推荐指数
                                <i class="fa fa-question-circle tips-help" data-placement="bottom" data-toggle="tab"
                                   title="根据最近30天内，统计宝贝成交金额在店铺整体成交额的比例来计算"></i>
                                
                            </th>
                            <th>
                                人群数量
                                <i class="fa fa-question-circle tips-help" data-placement="bottom" data-toggle="tab"
                                   title="该定向投放一段时间后，系统预估的人群覆盖量会更加精准"></i>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="plan-table">

                        <tr class="odd gradeX operation-open">
                            <th><input type="checkbox"></th>
                            <td>Trident</td>
                            <td>Trident</td>
                            <td>Trident</td>
                        </tr>

                        </tbody>
                    </table>

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
                <button type="button" class="btn btn-primary">
                    确定
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    取消
                </button>
            </div>
        </div>
    </div>
</div>