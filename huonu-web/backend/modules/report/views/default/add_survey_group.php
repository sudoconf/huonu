<div class="tab-pane fade" id="add-survey-group">

    <?php
    $form = \yii\bootstrap\ActiveForm::begin(
        [
            'id' => 'add-survey-group',
            'method' => 'post',
            'action' => 'ajax-save-strategy-group.html',
        ]
    );
    ?>
    <div class="control-group">

        <div class="form-inline pd10">
            <input type="button" name="addPolicyGroups" value="添加策略组" class="btn btn-primary" data-toggle="modal"
                   data-target="#addPolicyGroups"
                   data-url="<?= \yii\helpers\Url::toRoute('default/ajax-get-target') ?>">
        </div>

        <div class="control-group survey-group" style="overflow: hidden;">
            <?php
            if (empty($strategyGroup)) { ?>
                <div class="not-added-policy-group text-center pt40 pb60">
                    <div class="s_fs_16 pd15">未添加策略组</div>
                </div>
            <?php } else {
                foreach ($strategyGroup as $k => $v) { ?>
                    <div class="card">
                        <div class="strategic-group">
                            <span class="list-group-item active">
                                <a href="javascript:;" class="badge del-strategic-group">
                                    <i class="fa fa-times">删除</i>
                                </a>
                                <a href="javascript:;" class="badge edit-strategic-group">
                                    <i class="fa fa-edit">编辑</i>
                                </a>
                                <h4 class="list-group-item-heading"><?= $k ?></h4>
                            </span>
                        </div>
                        <div class="pre-scrollable">
                            <ul class="list-group">
                                <?php foreach ($v as $tk => $tv) { ?>
                                    <li class="list-group-item">
                                        <?= $tv['targetName'] ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                <?php }
            } ?>
        </div>

        <input type="hidden" name="taskStaffs">
        <input type="hidden" name="cardHtml">

        <div class="form-inline pd10">
            <input type="button" value="下一步，生成报表" class="btn btn-primary generate-report">
            <input type="button" value="上一步" class="btn btn-primary last-step">
        </div>

    </div>
    <?php \yii\bootstrap\ActiveForm::end() ?>

</div>

<?=\yii\helpers\Html::jsFile('@web/vendor/bootstrap-select/js/bootstrap-select.js') ?>
<?= \yii\helpers\Html::jsFile('@web/vendor/bootstrap-select/js/defaults-zh_CN.js') ?>
<?= \yii\helpers\Html::cssFile('@web/vendor/bootstrap-select/css/bootstrap-select.css') ?>

<!--弹窗添加策略组-->
<div class="modal fade" id="addPolicyGroups" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header" style="padding: 18px 40px">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <div class="pull-left">
                    <span class="modal-title s_fs_16" id="myModalLabel">
                        选择数据字段
                    </span>
                </div>
            </div>
            <div class="modal-body">

                <div class="form-inline pd10">
                    <label class="pdr10">策略组名称</label>
                    <input type="text" name="target_name" class="form-control" placeholder="请输入策略组名称" value="">
                </div>

                <div class="form-inline pd10 dpIb lh35" style="width: 100%;">
                    <div class="fl mr10">
                        <label for="name">选择定向人群</label>
                    </div>
                    <div class="fl" style="width: 60%;">
                        <select name="target_name_selects" class="selectpicker form-control"
                                data-live-search="true" data-actions-box="true" title='请选择以下的一个...'
                                multiple>
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left addSurveyGroupOperateConfirm"
                        data-dismiss="modal">
                    确定
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    取消
                </button>
            </div>
        </div>
    </div>
</div>