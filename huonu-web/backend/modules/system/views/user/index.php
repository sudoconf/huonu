<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('admin', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                系统管理
                <small>用户</small>
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
                <a href="javascript:;">用户管理</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:;">账户列表</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    查询条件
                </div>

                <?php $form = ActiveForm::begin([
                    'id' => 'search-form',
                    'method' => 'get',
                    'action' => Url::toRoute('user/index')
                ]); ?>
                <div class="panel-body form-group form-inline">
                    <div class="form-filter">
                        <label class="form-filter-field">用户名：</label>
                        <div class="form-filter-content">
                            <?= $form->field($searchModel, 'username')->textInput(['placeholder' => $searchModel->getAttributeLabel('username')])->label(false) ?>
                        </div>
                    </div>

                    <?= $form->field($searchModel, 'role')->dropDownList($authItem, ['prompt' => '请选择', 'style' => 'width:120px']) ?>


                    <?= $form->field($searchModel, 'status')->dropDownList($authItem, ['prompt' => '请选择', 'style' => 'width:120px']) ?>

                    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>

                <div class="panel-body">
                    <button type="button" class="btn btn-primary create-user-button">添加管理员</button>
                </div>

                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        'columns' => [
                            'id',
                            [
                                'attribute' => 'username',
                                'content' => function ($dataProvider) {
                                    return $dataProvider['username'];
                                },
                            ],
                            [
                                'attribute' => 'role',
                                'content' => function ($dataProvider) {
                                    return $dataProvider['role'];
                                },
                            ],
                            'email:email',
                            [
                                'attribute' => 'created_at',
                                'format' => ['date', 'php:Y-m-d H:i:s'],
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    return $model->status == 0 ? 'Inactive' : 'Active';
                                },
                                'filter' => [
                                    0 => 'Inactive',
                                    10 => 'Active'
                                ]
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '操作',
                                'template' => '{password}{disable}',
                                'headerOptions' => ['width' => '200', 'class' => 'padding-left-5px',],
                                'contentOptions' => ['class' => 'padding-left-5px'],
                                'buttons' => [
                                    'password' => function ($url, $model, $key) {
                                        return Html::button('重置密码', [
                                            'class' => 'btn btn-primary reset-password'
                                        ]);
                                    },
                                    'disable' => function ($url, $model, $key) {
                                        return Html::button('禁用', [
                                            'class' => 'btn btn-primary forbidden'
                                        ]);
                                    },
                                ],
                            ],
                        ],
                        'emptyText' => '没有筛选到任何内容哦',
                    ]); ?>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- /#page-wrapper -->

<!-- 添加管理员弹出框 -->
<div class="layer-form-create-user" style="display: none">
    <div class="layer-form">

        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
            'method' => 'post',
            'action' => Url::toRoute('user/signup'),
        ]); ?>
        <?= $form->field($adminModel, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($adminModel, 'email') ?>

        <?= $form->field($adminModel, 'password')->passwordInput() ?>

        <?= $form->field($adminModel, 'role')->dropDownList($authItem, ['prompt' => '请选择', 'style' => 'width:120px']) ?>

        <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>
    $(function () {
        $(document).on('submit', 'form#form-signup', function () {
            var form = $(this);
            //返回错误的表单信息
            if (form.find('.has-error').length) {
                return false;
            }
            //表单提交
            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function (response) {
                    console.log(response);
                    if (response.data != null) {
                        layer.alert('保存成功', {icon: 1});
                        window.location.reload();
                    } else {
                        layer.alert('保存失败', {icon: 2});
                    }
                },
                error: function () {
                    layer.alert('系统错误');
                    return false;
                }
            });
            return false;
        });
    });
</script>

<!-- 重置密码弹出框 -->
<div class="layer-form-reset-password" style="display: none">
    <div class="layer-form">
        <div class="control-group">
            <div class="controls">
                <img src="http://a-ssl.duitang.com/uploads/item/201404/15/20140415192752_JGUFz.jpeg"
                     style="width: 50px">
                <span>管理员</span>
                <span>huonuadmin</span>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <input type="text" class="form-control" placeholder="设置密码">
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn btn-default">提交</button>
                <button type="submit" class="btn btn-default">重置</button>
            </div>
        </div>
    </div>
</div>