<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                客户计划
                <small>计划列表</small>
            </h3>
        </div>
    </div>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">客户计划</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">计划列表</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#plan" data-placement="top" data-toggle="tab" title="计划">计划</a></li>
                    <li class=""><a href="#unit" data-placement="top" data-toggle="tab" title="单元">单元</a></li>
                    <li class=""><a href="#target" data-placement="top" data-toggle="tab" title="定向">定向</a></li>
                    <li class=""><a href="#resources" data-placement="top" data-toggle="tab" title="资源位">资源位</a></li>
                    <li class=""><a href="#creative" data-placement="top" data-toggle="tab" title="创意">创意</a></li>
                </ul>
                <div class="tab-content">
                    <!-- 计划 -->
                    <div class="tab-pane fade in active" id="plan">

                        <div class="control-group form-inline">
                            <span href="javascript:;" id="create-plan" class="btn btn-primary create-plan">
                                <i class="fa fa-plus"></i>
                                新建推广计划
                            </span>

                            <select name="" class="form-control">
                                <option>全部状态</option>
                                <option>有效计划</option>
                                <option>正在投放</option>
                                <option>暂停投放</option>
                                <option>等待投放</option>
                                <option>结束投放</option>
                                <option>投放故障</option>
                            </select>

                            <select name="" class="form-control">
                                <option>全部计划类型</option>
                                <option>自定义计划</option>
                                <option>系统推荐计划</option>
                                <option>系统托管计划</option>
                            </select>

                            <select name="" class="form-control">
                                <option>所有付费方式</option>
                                <option>按展现付费(CPM)</option>
                                <option>按点击付费(CPC)</option>
                            </select>

                        </div>
                        
                        <div class="control-group">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox"></th>
                                        <th>状态</th>
                                        <th>计划信息</th>
                                        <th>投放时间</th>
                                        <th>日预算</th>
                                        <th>消耗</th>
                                        <th>展现量</th>
                                        <th>点击量</th>
                                        <th>千次展现成本</th>
                                        <th>点击率</th>
                                        <th>点击单价</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody class="plan-table">

                                    <tr class="odd gradeX operation-open">
                                        <th><input type="checkbox"></th>
                                        <td>
                                            <div class="w60">
                                                <div class="ux-status-handle">
                                                    <i class="glyphicon glyphicon-play-circle" title="正在投放"></i>
                                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                                    <div class="ux-status-info" style="display: none">
                                                        <ul class="ux-status-operations">
                                                            <li class="ux-operation-cur">
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;正在投放
                                                            </li>
                                                            <li>
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;暂停投放
                                                            </li>
                                                            <li>
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;结束投放
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr">
                                        <td colspan="12">
                                            <a>设置</a>
                                            <a>详情</a>
                                            <a>复制</a>
                                            <a>移除</a>
                                            <a>置顶</a>
                                            <a>报表</a>
                                        </td>
                                    </tr>

                                    <tr class="odd gradeX operation-open">
                                        <th><input type="checkbox"></th>
                                        <td>
                                            <div class="w60">
                                                <div class="ux-status-handle">
                                                    <i class="glyphicon glyphicon-play-circle" title="正在投放"></i>
                                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                                    <div class="ux-status-info" style="display: none">
                                                        <ul class="ux-status-operations">
                                                            <li class="ux-operation-cur">
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;正在投放
                                                            </li>
                                                            <li>
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;暂停投放
                                                            </li>
                                                            <li>
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;结束投放
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr" style="display: none;">
                                        <td colspan="12">
                                            <a>设置</a>
                                            <a>详情</a>
                                            <a>复制</a>
                                            <a>移除</a>
                                            <a>置顶</a>
                                            <a>报表</a>
                                        </td>
                                    </tr>
                                    
                                    <tr class="odd gradeX operation-open">
                                        <th><input type="checkbox"></th>
                                        <td>
                                            <div class="w60">
                                                <div class="ux-status-handle">
                                                    <i class="glyphicon glyphicon-play-circle" title="正在投放"></i>
                                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                                    <div class="ux-status-info" style="display: none">
                                                        <ul class="ux-status-operations">
                                                            <li class="ux-operation-cur">
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;正在投放
                                                            </li>
                                                            <li>
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;暂停投放
                                                            </li>
                                                            <li>
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;结束投放
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr" style="display: none;">
                                        <td colspan="12">
                                            <a>设置</a>
                                            <a>详情</a>
                                            <a>复制</a>
                                            <a>移除</a>
                                            <a>置顶</a>
                                            <a>报表</a>
                                        </td>
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

                    <!-- 单元 -->
                    <div class="tab-pane fade" id="unit">
                        
                        <div class="control-group form-inline">
                            <span href="javascript:;" id="create-plan" class="btn btn-primary create-plan">
                                <i class="fa fa-plus"></i>
                                新建推广单元
                            </span>

                            <select name="" class="form-control">
                                <option>全部计划类型</option>
                                <option>自定义计划</option>
                                <option>系统推荐计划</option>
                                <option>系统托管计划</option>
                            </select>

                            <select name="" class="form-control">
                                <option>所有付费方式</option>
                                <option>按展现付费(CPM)</option>
                                <option>按点击付费(CPC)</option>
                            </select>

                            <select name="" class="form-control">
                                <option>全部状态</option>
                                <option>有效单元</option>
                                <option>正在投放</option>
                                <option>暂停投放</option>
                                <option>结束投放</option>
                                <option>投放故障</option>
                            </select>

                        </div>
                        
                        <div class="control-group">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox"></th>
                                        <th>状态</th>
                                        <th>单元信息</th>
                                        <th>出价区间</th>
                                        <th>消耗</th>
                                        <th>展现量</th>
                                        <th>点击量</th>
                                        <th>千次展现成本</th>
                                        <th>点击率</th>
                                        <th>点击单价</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody class="plan-table">

                                    <tr class="odd gradeX operation-open">
                                        <th><input type="checkbox"></th>
                                        <td>
                                            <div class="w60">
                                                <div class="ux-status-handle">
                                                    <i class="glyphicon glyphicon-play-circle" title="正在投放"></i>
                                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                                    <div class="ux-status-info" style="display: none">
                                                        <ul class="ux-status-operations">
                                                            <li class="ux-operation-cur">
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;正在投放
                                                            </li>
                                                            <li>
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;暂停投放
                                                            </li>
                                                            <li>
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;结束投放
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr">
                                        <td colspan="12">
                                            <a>详情</a>
                                            <a>复制</a>
                                            <a>移除</a>
                                            <a>报表</a>
                                        </td>
                                    </tr>

                                    <tr class="odd gradeX operation-open">
                                        <th><input type="checkbox"></th>
                                        <td>
                                            <div class="w60">
                                                <div class="ux-status-handle">
                                                    <i class="glyphicon glyphicon-play-circle" title="正在投放"></i>
                                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                                    <div class="ux-status-info" style="display: none">
                                                        <ul class="ux-status-operations">
                                                            <li class="ux-operation-cur">
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;正在投放
                                                            </li>
                                                            <li>
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;暂停投放
                                                            </li>
                                                            <li>
                                                                <i class="">~</i>
                                                                <i class=""></i>
                                                                &nbsp;&nbsp;结束投放
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr" style="display: none">
                                        <td colspan="12">
                                            <a>详情</a>
                                            <a>复制</a>
                                            <a>移除</a>
                                            <a>报表</a>
                                        </td>
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

                    <!-- 定向 -->
                    <div class="tab-pane fade" id="target">
                        
                        <div class="control-group form-inline">
                            <span href="javascript:;" id="create-plan" class="btn btn-primary create-plan">
                                <i class="fa fa-plus"></i>
                                增加定向
                            </span>

                            <select name="" class="form-control">
                                <option>全部计划类型</option>
                                <option>自定义计划</option>
                                <option>系统推荐计划</option>
                            </select>

                            <select name="" class="form-control">
                                <option>所有付费方式</option>
                                <option>按展现付费(CPM)</option>
                                <option>按点击付费(CPC)</option>
                            </select>

                            <select name="" class="form-control">
                                <option>全部定向</option>
                                <option>访客定向</option>
                                <option>达摩盘定向</option>
                                <option>店铺型定向</option>
                                <option>C智能定向</option>
                                <option>类目型定向 - 高级兴趣点</option>
                                <option>相似宝贝定向</option>
                                <option>M智能定向</option>
                            </select>

                        </div>
                        
                        <div class="control-group">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox"></th>
                                        <th>定向信息</th>
                                        <th>出价</th>
                                        <th>消耗</th>
                                        <th>展现量</th>
                                        <th>点击量</th>
                                        <th>千次展现成本</th>
                                        <th>点击率</th>
                                        <th>点击单价</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody class="plan-table">

                                    <tr class="odd gradeX operation-open">
                                        <th><input type="checkbox"></th>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr">
                                        <td colspan="12">
                                            <a>编辑</a>
                                            <a>移除</a>
                                            <a>报表</a>
                                        </td>
                                    </tr>

                                    <tr class="odd gradeX operation-open">
                                        <th><input type="checkbox"></th>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr" style="display: none">
                                        <td colspan="12">
                                            <a>编辑</a>
                                            <a>移除</a>
                                            <a>报表</a>
                                        </td>
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

                    <!-- 资源位 -->
                    <div class="tab-pane fade" id="resources">
                        
                        <div class="control-group form-inline">
                            <span href="javascript:;" id="create-plan" class="btn btn-primary create-plan">
                                <i class="fa fa-plus"></i>
                                增加资源位
                            </span>

                            <select name="" class="form-control">
                                <option>全部计划类型</option>
                                <option>自定义计划</option>
                                <option>系统推荐计划</option>
                            </select>

                            <select name="" class="form-control">
                                <option>所有付费方式</option>
                                <option>按展现付费(CPM)</option>
                                <option>按点击付费(CPC)</option>
                            </select>

                            <select name="" class="form-control">
                                <option>全部状态</option>
                                <option>投放保障</option>
                            </select>

                            <select name="" class="form-control">
                                <option>全部创意类型</option>
                                <option>图片</option>
                                <option>Flash</option>
                                <option>视频</option>
                                <option>文字链</option>
                                <option>Flash 不遮盖</option>
                                <option>创意模板</option>
                            </select>

                            <select name="" class="form-control">
                                <option>全部资源位尺寸</option>
                                <option>0*0</option>
                                <option>110*300</option>
                                <option>130*280</option>
                                <option>145*165</option>
                                <option>160x200</option>
                                <option>160*310</option>
                                <option>168*76</option>
                                <option>190*43</option>
                            </select>

                        </div>
                        
                        <div class="control-group">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox"></th>
                                        <th>资源位信息</th>
                                        <th>出价</th>
                                        <th>创意要求</th>
                                        <th>消耗</th>
                                        <th>展现量</th>
                                        <th>点击量</th>
                                        <th>千次展现成本</th>
                                        <th>点击率</th>
                                        <th>点击单价</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody class="plan-table">

                                    <tr class="odd gradeX operation-open">
                                        <th><input type="checkbox"></th>
                                        <td>Trident</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr">
                                        <td colspan="12">
                                            <a>移除</a>
                                            <a>报表</a>
                                        </td>
                                    </tr>

                                    <tr class="odd gradeX operation-open">
                                        <th><input type="checkbox"></th>
                                        <td>Trident</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr" style="display: none">
                                        <td colspan="12">
                                            <a>移除</a>
                                            <a>报表</a>
                                        </td>
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

                    <!-- 创意 -->
                    <div class="tab-pane fade" id="creative">
                        
                        <div class="control-group form-inline">
                            <span href="javascript:;" id="create-plan" class="btn btn-primary create-plan">
                                <i class="fa fa-plus"></i>
                                从创意库选择
                            </span>
                            
                            <span href="javascript:;" id="create-plan" class="btn btn-primary create-plan">
                                添加新创意
                            </span>

                            <select name="" class="form-control">
                                <option>全部计划类型</option>
                                <option>自定义计划</option>
                                <option>系统推荐计划</option>
                                <option>系统托管计划</option>
                            </select>

                            <select name="" class="form-control">
                                <option>全部状态</option>
                                <option>待审核</option>
                                <option>审核通过</option>
                                <option>投放保障</option>
                            </select>

                            <select name="" class="form-control">
                                <option>全部等级</option>
                                <option>一级</option>
                                <option>二级</option>
                                <option>三级</option>
                                <option>四级</option>
                            </select>

                            <select name="" class="form-control">
                                <option>全部创意类型</option>
                                <option>图片</option>
                            </select>

                            <select name="" class="form-control">
                                <option>全部尺寸</option>
                                <option>520*280</option>
                                <option>640*200</option>
                            </select>

                        </div>
                        
                        <div class="control-group">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox"></th>
                                        <th>创意信息</th>
                                        <th>创意状态</th>
                                        <th>消耗</th>
                                        <th>展现量</th>
                                        <th>点击量</th>
                                        <th>千次展现成本</th>
                                        <th>点击率</th>
                                        <th>点击单价</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody class="plan-table">

                                    <tr class="odd gradeX operation-open">
                                        <th><input type="checkbox"></th>
                                        <td>Trident</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Win 95+</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr">
                                        <td colspan="12">
                                            <a>移除</a>
                                            <a>报表</a>
                                        </td>
                                    </tr>

                                    <tr class="odd gradeX operation-open">
                                        <th><input type="checkbox"></th>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                        <td>Win 95+</td>
                                        <td class="center">4</td>
                                        <td>Trident</td>
                                        <td>Internet Explorer 4.0</td>
                                    </tr>
                                    <tr class="odd gradeX cur-table-operation-tr" style="display: none">
                                        <td colspan="12">
                                            <a>移除</a>
                                            <a>报表</a>
                                        </td>
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