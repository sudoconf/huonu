<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '客户计划 - 新建计划';

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                客户计划
                <small>新建计划</small>
            </h3>
        </div>
    </div>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?= Url::toRoute('/site') ?>">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">客户计划</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">新建计划</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel">

                <div class="view">
                    <div class="tabbable">

                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a href="#select-promotion-scene" data-toggle="tab" data-placement="top" title="选择推广场景">
                                    <!--去掉 data-toggle="tab" 就不能切换了-->
                                    <i class="create-step">1</i>
                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                    选择推广场景
                                </a>
                            </li>
                            
                            <li class="disabled">
                                <a href="#set-plan" data-toggle="tab" data-placement="top" title="设置计划">
                                    <i class="create-step">2</i>
                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                    设置计划
                                </a>
                            </li>
                            
                            <li class="disabled">
                                <a href="#set-unit" data-toggle="tab" data-placement="top" title="设置单元">
                                    <i class="create-step">2</i>
                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                    设置单元
                                </a>
                            </li>
                            
                            <li class="disabled">
                                <a href="#add-creative" data-toggle="tab" data-placement="top" title="添加创意">
                                    <i class="create-step">2</i>
                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                    添加创意
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!--选择推广场景 start-->
                            <div class="tab-pane fade in active" id="select-promotion-scene">
                                
                                <div class="control-group form-inline pd15">
                                    <label for="name">店铺名称：</label>
                                    <input type="text" class="form-control" id="name" placeholder="请输入店铺名称">
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
                                    <div class="form-inline">
                                    <!--<div class="col-md-6 col-md-offset-1">-->
                                        <label for="name">营销目标：</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option2" id="option2" value="option2" checked> 不限
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option2" id="option2"  value="option2"> 促进购买
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option2" id="option2"  value="option2"> 促进进店
                                        </label>
                                    </div>
                                </div>
                                <!--设置营销参数 end -->
                                
                                <!--基本信息 start -->
                                <div class="control-group pd15">
                                    <div class="well s_fs_16">
                                        <i class="fa fa-bar-chart-o fa-fw"></i>
                                        基本信息
                                    </div>
                                    
                                    <div class="form-inline pd10">
                                        <label for="name">计划名称：</label>
                                        <input type="text" class="form-control" id="name" placeholder="请输入名称">
                                    </div>
                                
                                    <div class="form-inline pd10">
                                        <label for="name">付款方式：</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option2" id="option2" value="option2" checked> 按展现付费（CPM）
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option2" id="option2"  value="option2"> 按点击付费（CPC）
                                        </label>
                                    </div>
                                
                                    <div class="form-inline pd10">
                                        <label for="name">地域设置：</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option2" id="option2" value="option2" checked> 自定义
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option2" id="option2"  value="option2"> 使用模板
                                        </label>
                                        <select class="form-control">
                                            <option>地域</option>
                                            <option>常用地域(系统模板)</option>
                                            <option>非偏远地区除外</option>
                                          </select>
                                    </div>
                                    
                                    <div class="form-inline pd10">
                                        <label for="name">时段设置：</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option2" id="option2" value="option2" checked> 自定义
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option2" id="option2"  value="option2"> 使用模板
                                        </label>
                                        <select class="form-control">
                                            <option>时段全选(系统模板)</option>
                                          </select>
                                    </div>
                                
                                    <div class="form-inline pd10">
                                        <label for="name">投放日期：</label>
                                        <input type="text" class="form-control" id="name" placeholder="请输入名称">
                                    </div>
                                
                                    <div class="form-inline pd10">
                                        <label for="name">投放方式：</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option2" id="option2" value="option2" checked> 尽快投放
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option2" id="option2"  value="option2"> 均匀投放
                                        </label>
                                    </div>
                                
                                    <div class="form-inline pd10">
                                        <label for="name">出价方式：</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option2" id="option2" value="option2" checked> 手动出价
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="option2" id="option2"  value="option2"> 自动出价
                                        </label>
                                    </div>
                                
                                    <div class="form-inline pd10">
                                        <label for="name">每日预算：</label>
                                        <input type="text" class="form-control" placeholder="最低300元"
                                        <span class="input-group-addon"> 元</span>
                                    </div>
                                </div>
                                <!--基本信息 end -->
                                
                                <div class="control-group pd15">
                                    <span class="btn btn-primary create-plan">下一步，设置推广单元</span>
                                </div>
                            </div>
                            <!--选择推广场景 end-->

                            <!--设置计划 start-->
                            <div class="tab-pane fade" id="set-plan">
                                
                                <div class="control-group form-inline pd15">
                                    <label for="name">单元名称：</label>
                                    <input type="text" class="form-control" id="name" placeholder="请输入单元名称">
                                </div>
                                
                                <!--设置定向人群 start -->
                                <div class="control-group pd15">
                                    <div class="well s_fs_16">
                                        <i class="fa fa-bar-chart-o fa-fw"></i>
                                        设置定向人群
                                    </div>
                                    <div class="form-inline pd10">
                                        <label for="name">相似宝贝定向：</label>
                                        <span class="pdl15 s_fc_9">近期对指定宝贝的竞品宝贝感兴趣的人群</span>
                                        <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
                                    </div>
                                    
                                    <div class="form-inline pd10">
                                        <label for="name">达摩盘定向：</label>
                                        <span class="pdl15 s_fc_9">基于达摩盘自定义组合圈定的各类人群</span>
                                        <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
                                    </div>
                                    
                                    <div class="form-inline pd10">
                                        <label for="name">通投：</label>
                                        <span class="pdl15 s_fc_9">不限人群投放</span>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox2" value="option2">
                                        </label>
                                    </div>
                                    
                                    <div class="form-inline pd10">
                                        <label for="name">营销场景定向：</label>
                                        <span class="pdl15 s_fc_9">按用户与店铺之间更细粒度的营销关系划分圈定的人群</span>
                                        <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
                                    </div>
                                    
                                    <div class="form-inline pd10">
                                        <label for="name">访客定向：</label>
                                        <span class="pdl15 s_fc_9">近期访问过某些店铺的人群</span>
                                        <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
                                    </div>
                                    
                                    <div class="form-inline pd10">
                                        <label for="name">行业店铺定向：</label>
                                        <span class="pdl15 s_fc_9">近期访问过行业优质店铺的人群</span>
                                        <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
                                    </div>
                                    
                                    <div class="form-inline pd10">
                                        <label for="name">智能定向：</label>
                                        <span class="pdl15 s_fc_9">系统根据店铺人群特征推荐的优质人群</span>
                                        <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
                                    </div>
                                    
                                    <div class="form-inline pd10">
                                        <label for="name">类目型定向-高级兴趣点：</label>
                                        <span class="pdl15 s_fc_9">近期对某些购物兴趣点有意向的人群。兴趣点定向的升级版。</span>
                                        <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
                                    </div>
                                    
                                    <div class="form-inline pd10">
                                        <label for="name">店铺型定向：</label>
                                        <span class="pdl15 s_fc_9">近期对某类店铺感兴趣的人群，或自己店铺的重定向人群</span>
                                        <a class="pdl15 s_fc_c" href="javascript:;">设置定向</a>
                                    </div>
                                    
                                    <div class="form-inline pd10">
                                        <label for="name">达摩盘_平台精选：</label>
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
                                    
                                    <div class="text-center pt40 pb60">
                                        <div class="s_fs_16">请先添加人群和资源位</div>
                                    </div>
                                    
                                </div>
                                <!--设置出价 end-->
                                
                                <div class="control-group pd15">
                                    <span class="btn btn-primary create-plan">下一步，上传创意</span>
                                </div>
                                
                            </div>
                            <!--设置计划 end-->
                            
                            <!--设置单元 start-->
                            <div class="tab-pane fade" id="set-unit">
                                33333333333
                            </div>
                            <!--设置单元 end-->
                            
                            <!--添加创意 start-->
                            <div class="tab-pane fade" id="add-creative">
                                4444444444444
                            </div>
                            <!--添加创意 end-->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<!-- 引入jQuery的js文件 -->
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    $("[data-toggle='tab']").tooltip(); // 工具提示（Tooltip）插件 - 锚
</script>