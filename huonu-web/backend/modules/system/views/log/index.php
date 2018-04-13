<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \backend\models\Log;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\AdminLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '日志记录';
$this->params['breadcrumbs'][] = $this->title;
?>


<div id="page-wrapper">

    <div class="row">
        <div class="admin-log-index">

            <h1><?= Html::encode($this->title) ?></h1>
            <?php Pjax::begin(); ?>
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'username',
                    [
                        'attribute' => 'type',
                        'value' => function($model) {
                            return Log::getTypeDescription($model->type);
                        },
                    ],
                    'module',
                    'controller',
                    'action',
                    'url:url',
                    // 'params',
                    'ip',
                    // 'agent',
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:Y-m-d H:i:s'],
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '更多操作',
                        'template' => '{info}',
                        'buttons' => [
                            'info' => function ($url, $model, $key) {
                                return Html::button('详情', [
                                    'class' => 'btn btn-primary logo-info'
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>

    </div>
</div>

<script>

    $('.logo-info').on('click', function(){
        var ii = layer.load();
        //此处用setTimeout演示ajax的回调
        setTimeout(function(){
            layer.close(ii);
        }, 1000);

        layer.open({
            type: 1,
            title: '创建角色',
            shadeClose: true,
            shade: false,
            maxmin: false, //开启最大化最小化按钮
            area: ['462px', '430px'],
            content: $('.layer-form-create-user').html()
        });

    });

    $('.logo-info').click(function () {
        var id = this.value;
        var dataUrl = $(this).attr("data-url");
        //表单提交
        $.ajax({
            url: dataUrl,
            type: 'post',
            data: {'id': id},
            success: function (response) {
                console.log(id + '-----------' + dataUrl);
                if (response.data != null) {
                    layer.alert('操作成功', {icon: 1});
                    window.location.reload();
                } else {
                    layer.alert('操作失败', {icon: 2});
                }
            },
            error: function () {
                layer.alert('系统错误');
                return false;
            }
        });
    })

</script>