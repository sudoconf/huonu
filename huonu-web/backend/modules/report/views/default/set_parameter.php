<div class="tab-pane fade in active" id="set-up-parameters">

    <?php
    $form = \yii\bootstrap\ActiveForm::begin(
        [
            'id' => 'form-set-parame',
            'method' => 'post',
            'action' => 'ajax-save-set-parameter.html',
        ]
    );
    ?>
    <div class="control-group">
        <div class="form-inline pd10">
            <label for="name">复盘名称</label>
            <input type="text" name="multitray_name" class="form-control" placeholder="请输入复盘名称"
                   value="<?= $setParameter['multitray_name'] ?>">
        </div>

        <div class="form-inline pd10">
            <span>店铺选择</span>
            <input type="text" name="taobao_name" class="form-control" placeholder="店铺选择"
                   value="<?= $setParameter['taobao_name'] ?>">
            <input type="hidden" name="taobao_id" value="<?= $setParameter['taobao_id'] ?>">
        </div>

        <div class="form-inline pd10">
            <span>时间选择</span>
            <input type="text" placeholder="请选择时间" class="form-control select-time" name="multitray_time">
            <input type="hidden" name="multitray_start_time" value="<?= $setParameter['multitray_start_time'] ?>"/>
            <input type="hidden" name="multitray_end_time" value="<?= $setParameter['multitray_end_time'] ?>"/>
        </div>

        <div class="form-inline pd10">
            <span>字段选择</span>
            <a href="javascript:;" data-toggle="modal"
               data-target="#fieldSelect">
                <i class="fa fa-gear"></i>
            </a>
            <input type="hidden" name="multitray_field">
        </div>

        <div class="form-inline pd10">
            <span>效果模型</span>
            <label class="radio-inline">
                <input type="radio" value="click"
                       name="multitray_effect_model" <?= ($setParameter['multitray_effect_model'] == 'click') ? 'checked' : '' ?>>点击效果
            </label>
            <label class="radio-inline">
                <input type="radio" value="impression"
                       name="multitray_effect_model" <?= ($setParameter['multitray_effect_model'] == 'impression') ? 'checked' : '' ?>>展示效果
            </label>
        </div>

        <div class="form-inline pd10">
            <span>数据周期</span>
            <label class="radio-inline">
                <input type="radio" value="3"
                       name="multitray_cycle" <?= ($setParameter['multitray_cycle'] == '3') ? 'checked' : '' ?>>3天
            </label>
            <label class="radio-inline">
                <input type="radio" value="7"
                       name="multitray_cycle" <?= ($setParameter['multitray_cycle'] == '7') ? 'checked' : '' ?>>7天
            </label>
            <label class="radio-inline">
                <input type="radio" value="15"
                       name="multitray_cycle" <?= ($setParameter['multitray_cycle'] == '15') ? 'checked' : '' ?>>15天
            </label>
        </div>

        <div class="form-inline pd10">
            <span class="btn btn-primary setParamConfirm">下一步，添加对比组</span>
        </div>
    </div>
    <?php \yii\bootstrap\ActiveForm::end(); ?>

</div>

<!--选择数据字段-->
<div class="modal fade" id="fieldSelect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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

                <ul class="fields-content">
                    <?php foreach (\backend\models\Multitray::$multitrayFields as $k => $v) { ?>
                        <li class="clearfix">
                            <span class="pdr20"><?= $k ?></span>
                            <?php if (is_array($v)) { ?>
                                <?php foreach ($v as $tk => $tv) { ?>
                                    <label class="cp pdr20">
                                        <input type="checkbox" name="multitray_field[]"
                                               value="<?= $tk ?>" <?= (in_array($tk, $setParameter['multitray_field'])) ? 'checked' : '' ?>> <?= $tv ?>
                                    </label>
                                <?php } ?>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left damoDiskOrientationConfirm" data-dismiss="modal">
                    确定
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    取消
                </button>
            </div>
        </div>
    </div>
</div>