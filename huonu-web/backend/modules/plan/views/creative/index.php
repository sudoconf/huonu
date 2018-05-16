<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = '创意列表';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                客户计划
                <small><?= $this->title ?></small>
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
                <a href="<?= Url::toRoute('creative/index') ?>"><?= $this->title ?></a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="tabbable">
                <ul class="nav nav-pills">
                    <li class=""><a href="<?= Url::toRoute('default/index') ?>" title="计划">计划</a></li>
                    <li class=""><a href="<?= Url::toRoute('unit/index') ?>" title="单元">单元</a></li>
                    <li class=""><a href="<?= Url::toRoute('target/index') ?>" title="定向">定向</a></li>
                    <li class=""><a href="<?= Url::toRoute('resource/index') ?>" title="资源位">资源位</a></li>
                    <li class="active"><a href="<?= Url::toRoute('creative/index') ?>" data-placement="top"
                                          data-toggle="tab" title="创意">创意</a></li>
                </ul>
                <div class="tab-content">
                    <!-- 创意 -->
                    <div class="tab-pane fade in active" id="creative">

                        <div class="control-group form-inline pt15 pb15">
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

                        <div class="control-group table-responsive">
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
                                </tr>
                                <tr class="odd gradeX cur-table-operation-tr dpn">
                                    <td colspan="9" class="operation-td">
                                        <a href="javascript:;" class="btn btn-primary mr10">移除</a>
                                        <a href="javascript:;" class="btn btn-primary mr10">同步</a>
                                        <a href="javascript:;" class="btn btn-primary mr10">报表</a>
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

    $(function () {
        $("[data-toggle='tab']").tooltip(); // 工具提示（Tooltip）插件 - 锚
    });

</script>