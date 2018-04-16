<?php
use yii\helpers\Url;
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                客户报表 <small>人群复盘列表</small>
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
                <a href="#">客户报表</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">人群复盘列表</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    查询条件
                </div>

                <div class="panel-body form-group">
                    <div class="form-filter">
                        <label class="form-filter-field">用户名：</label>
                        <div class="form-filter-content">
                            <input type="text" class="form-control" placeholder="用户名">
                        </div>
                    </div>
                    <div class="form-filter">
                        <label class="form-filter-field">复盘报告名称：</label>
                        <div class="form-filter-content">
                            <input type="text" class="form-control" placeholder="复盘报告名称">
                        </div>
                    </div>
                    <div class="form-filter-btn">
                        <button type="button" class="btn btn-primary">搜索</button>
                    </div>
                </div>

                <div class="panel-body">
                    <a href="<?= Url::toRoute('default/create')?>" class="btn btn-primary">新建定向人群复盘</a>
                </div>

                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>客户ID</th>
                            <th>客户名</th>
                            <th>复盘报告名称</th>
                            <th>复盘时间</th>
                            <th>创建时间</th>
                            <th>效果模型</th>
                            <th>数据周期</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="odd gradeX">
                            <td>Trident</td>
                            <td>Internet Explorer 4.0</td>
                            <td>Win 95+</td>
                            <td class="center">4</td>
                            <td>Win 95+</td>
                            <td class="center">4</td>
                            <td>Win 95+</td>
                            <td class="center">
                                <button type="button" class="btn btn-primary info">查看</button>
                                <button type="button" class="btn btn-primary del">删除</button>
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