<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use backend\components\widget\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\TaobaoAuthorizeUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '客户报表 - 数据同步';
$this->params['breadcrumbs'][] = $this->title;
?>


<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                客户报表
                <small><?= Html::encode($this->title) ?></small>
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
                <a href="<?= Url::toRoute('index') ?>">客户报表</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">数据同步</a>
            </li>
        </ul>
    </div>
    <div class="taobao-authorize-user-index">

        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'taobao_user_id',
                'taobao_user_nick',
                'sync_status',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '更多操作',
                    'template' => '{sync}{forbidden}',
                    'buttons' => [
                        'sync' => function ($url, $model, $key) {
                            return Html::button('手动同步', [
                                'class' => 'btn btn-primary manual-sync mr10',
                                'data-loading-text' => 'Loading...',
                                'value' => $model->taobao_user_id,
                                'sync-status' => $model->sync_status,
                            ]);
                        },
                        'forbidden' => function ($url, $model, $key) {
                            return Html::button('禁用', [
                                'class' => 'btn btn-primary',
                            ]);
                        },
                    ],
                ],
            ],
            'filterSelector' => "select[name='" . $dataProvider->getPagination()->pageSizeParam . "'],input[name='" . $dataProvider->getPagination()->pageParam . "']",
            'pager' => [
                'class' => LinkPager::className(),
                'options' => ['class' => 'pagination', 'style' => "display:block;"],// 关闭自带分页
                'template' => '{pageButtons} {customPage} {pageSize}', // 分页栏布局
                'maxButtonCount' => 5, // 显示页数
                'firstPageLabel' => '首页',
                // 'prevPageLabel' => '上一页',
                // 'nextPageLabel' => '下一页',
                'lastPageLabel' => '末页',
                'pageSizeList' => [10, 20, 30, 50], // 页大小下拉框值
                'customPageWidth' => 50,            // 自定义跳转文本框宽度
                'customPageBefore' => ' 跳转到第 ',
                'customPageAfter' => ' 页 ',
            ],
        ]); ?>
    </div>

</div>

<script>

    $(function () {

        $('.manual-sync').click(function () {

            var userId = $(this).val();
            var syncStatus = $(this).attr('sync-status');

            $(this).button('loading');

            // ajax 提交
            $.ajax({
                url: 'default/ajax-sync.html',
                type: 'get',
                data: {'userId': userId, 'syncStatus': syncStatus},
                dataType: 'json',
                success: function (response) {

                    if (response.message == 'success!') {
                        layer.msg('提交成功', {
                            icon: 1,
                            shade: [0.5],
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        });
                    } else {
                        layer.msg('服务器异常', {
                            icon: 2,
                            shade: [0.5],
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        });
                    }

                    $(".manual-sync").button('reset');
                },
                error: function (e, jqxhr, settings, exception) {
                    $(".manual-sync").button('reset');
                }
            });
            return false;

        });

    });

</script>