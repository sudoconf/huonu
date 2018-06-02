<div class="tab-pane fade" id="add-creative">

    <div class="control-group pd15">
        <div class="well s_fs_16">
            <i class="fa fa-picture-o"></i>
            <span class="s_fs_16">添加创意</span>
            <span class="mr5 ml20 s_fs_12">创意优选</span>
            <i class="fa fa-question-circle tips-help s_fs_12" data-placement="bottom" data-toggle="tab"
               title="系统将对创意特征及用户喜好进行深度匹配，优先展现最佳创意图片。生效条件：同一资源位的创意个数≥3；单元当日整体展现数量1万以上；仅支持图片格式。当前共有92% 的同行使用，平均点击率提升 10.46% 以上。"
               data-original-title="系统将对创意特征及用户喜好进行深度匹配，优先展现最佳创意图片。生效条件：同一资源位的创意个数≥3；单元当日整体展现数量1万以上；仅支持图片格式。当前共有92% 的同行使用，平均点击率提升 10.46% 以上。"></i>

            <span class="mr5 ml20 s_fc_9 s_fs_12">同一资源位的创意图片个数≥3时，建议开启创意优选！优先展现点击率较高的创意图片</span>
        </div>

        <div class="mt20 mb20">
            <span class="btn btn-primary chooseCreativeLibrary" data-toggle="modal" data-target="#chooseCreativeLibrary"
                  data-url="<?= \yii\helpers\Url::toRoute('creative/ajax-get-creative') ?>">
                <i class="fa fa-plus"></i> 从创意库选择
            </span>
            <span class="btn btn-gray"><i class="fa fa-flask"></i> 创意模板制作</span>
            <span class="btn btn-gray"><i class="fa fa-upload"></i> 本地上传</span>
            <span class="btn btn-gray"><i class="fa fa-mortar-board"></i> 创意快捷制作</span>
        </div>

        <div class="mt20 mb20 bg-fafafa">
            <div class="pd15">
                <i class="fa fa-exclamation-circle s_fc_notice"></i>
                添加创意内容信息有利于缓解创意冷启动问题，并可优化创意和人群匹配。若输入的信息与创意的内容不符，对投放有负向影响。
                <a href="https://alimama.bbs.taobao.com/detail.html?postId=8560047" target="_blank">操作说明</a>
            </div>
        </div>

        <div class="bannerCreativeBox clearfix">
            <div class="boxOver">
                <div class="fl w60 ellipsis">
                    <span class="s_fc_9">图片</span>
                </div>
                <!-- <div class="fl w150 ellipsis">
                    <span class="s_fc_9">尺寸：</span>
                    <span class="font-tahoma bold">640x200</span>
                </div>
                <div class="fl w180 ellipsis">
                    <span class="s_fc_9">预估流量：</span>
                    <span class="font-tahoma bold">318,530,795</span>

                </div>
                <div class="fl w150 ellipsis">
                     <span class="s_fc_9">建议创意等级<i class="fa fa-question-circle tips-help" data-placement="bottom"
                                                   data-toggle="tab" title="不同资源位要求的创意等级不同，请选择与资源位等级匹配的创意图片，否则无法投放。"
                                                   data-original-title="不同资源位要求的创意等级不同，请选择与资源位等级匹配的创意图片，否则无法投放。"></i>：</span>
                     <span>一级</span>
                 </div> -->
                <div class="fr ml20">
                    <a href="javascript:;" class="s_fc_3 creativeDels">全部移除</a>
                </div>
                <!-- <div class="fr">
                     <a href="javascript:;" class="link-blue creativeLink">查看同尺寸模板</a>
                </div> -->
            </div>
            <div class="boxCreatives clearfix">
            </div>

            <input type="hidden" name="creativeIdList" data-url="<?=\yii\helpers\Url::toRoute('creative/ajax-save-creative')?>" data-save-plan="<?=\yii\helpers\Url::toRoute('default/ajax-save-plan')?>">
            <input type="hidden" name="getSessionCreative" data-url="<?=\yii\helpers\Url::toRoute('creative/ajax-get-session-creative')?>">

        </div>

    </div>

    <div class="control-group pd15">
        <span class="btn btn-primary mr20 dpn">暂不添加创意，完成</span>
        <span class="btn btn-primary mr20 create-creative">下一步，完成</span>
        <span class="btn btn-gray creative-last-step">返回上一步</span>
    </div>

</div>


<!--添加创意-->
<div class="modal fade" id="chooseCreativeLibrary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog pull-right" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header" style="padding: 18px 40px">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <div class="pull-left">
                    <span class="modal-title s_fs_16" id="myModalLabel">
                        添加创意
                    </span>
                </div>
            </div>
            <div class="modal-body">

                <div class="control-group icon-filters pdl15">
                    <i class="fa fa-exclamation-circle"></i> 以下创意已按时间排序
                </div>

                <div class="control-group form-inline pdl15 pt20 pb10 pdr40">
                    <select name="creativeSize" class="form-control">
                        <option value="">所有尺寸</option>
                        <option value="520,280">520x280</option>
                        <option value="640,200">640x200</option>
                        <option value="1180,500">1180x500</option>
                    </select>

                    <select name="creativeLevel" class="form-control">
                        <option value="">全部等级</option>
                        <option value="1">一级</option>
                        <option value="2">二级</option>
                        <option value="3">三级</option>
                        <option value="4">四级</option>
                        <option value="10">十级</option>
                        <option value="99">未分级</option>
                    </select>

                    <select name="auditStatus" class="form-control">
                        <option value="">全部状态</option>
                        <option value="1">审核通过</option>
                        <option value="-4,-1,0">待审核</option>
                    </select>

                    <input name="creativeName" class="form-control" placeholder="创意名称">
                </div>

                <div class="control-group pdl15">
                    <label>
                        <input type="checkbox" class="mr5 creativeSelectAll">
                        创意全选
                    </label>
                </div>

                <div class="control-group pdl15">
                    <ul class="creativeIcons clearfix">
                    </ul>
                </div>

                <div class="control-group creativePage">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left creative-confirm" data-dismiss="modal">
                    确定
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    取消
                </button>
            </div>
        </div>
    </div>
</div>