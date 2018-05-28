package com.huonu.service.impl;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import javax.mail.internet.AddressException;

import org.json.JSONObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.huonu.domain.dao.ApiLogDao;
import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntryDao;
import com.huonu.domain.dao.UserDao;
import com.huonu.domain.dao.ZxhtZzAdgroupCreativeBindInfoDao;
import com.huonu.domain.dao.ZxhtZzCampaignInfoDao;
import com.huonu.domain.model.ApiLog;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry;
import com.huonu.domain.model.User;
import com.huonu.domain.model.ZxhtZzAdgroupCreativeBindInfo;
import com.huonu.domain.model.ZxhtZzCampaignInfo;
import com.huonu.mail.IMailService;
import com.huonu.mail.MailEntry;
import com.huonu.service.ZxhtCreativeMonitorTestService;
import com.huonu.utils.date.DateUtils;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.ApiException;
import com.taobao.api.TaobaoClient;
import com.taobao.api.request.ZuanshiBannerAdgroupStatusRequest;
import com.taobao.api.response.ZuanshiBannerAdgroupStatusResponse;

@Service
public class ZxhtCreativeMonitorTestServiceImpl implements ZxhtCreativeMonitorTestService{
	
	@Autowired
	private TaobaoClient taobaoClient;
	
	@Autowired 
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	@Autowired
	private ZxhtZzCampaignInfoDao zxhtZzCampaignInfoDao;
	
	@Autowired
	private ZxhtZzAdgroupCreativeBindInfoDao zxhtZzAdgroupCreativeBindInfoDao;
	
	@Autowired
	private TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntryDao taobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntryDao;
	
	@Autowired
	private UserDao userDao;
	
	@Autowired
	private IMailService iMailService;
	
	@Autowired
	private ApiLogDao apiLogDao;
	
	public void product(ZxhtZzCampaignInfo zxhtZzCampaignInfo) {
		
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(zxhtZzCampaignInfo.getTaobao_user_id());
		List<ZxhtZzCampaignInfo> zxhtZzCampaignInfoList = zxhtZzCampaignInfoDao.getChangeStatusAdgroup(zxhtZzCampaignInfo.getTaobao_user_id());
		String adgroupIdList="";
	    Long campaignId=0L;
	    Long mailStatus=0L;
	    
		for (int i = 0; i < zxhtZzCampaignInfoList.size(); i++) {
            ZxhtZzCampaignInfo data = zxhtZzCampaignInfoList.get(i);
            if (i == 0) {
                campaignId = data.getCampaign_id();
                mailStatus = data.getMail();
                Long adgroupId = data.getAdgroup_id();
                adgroupIdList = String.valueOf(adgroupId);
            }
            else if (i == zxhtZzCampaignInfoList.size() - 1) {
                Long adgroupId = data.getAdgroup_id();
                adgroupIdList += ","+String.valueOf(adgroupId);
            }
            else if (i < zxhtZzCampaignInfoList.size() - 1 && i > 0) {
                Long adgroupId = data.getAdgroup_id();
                adgroupIdList +=","+ String.valueOf(adgroupId);
            }
        }
		
		ZuanshiBannerAdgroupStatusRequest req=new ZuanshiBannerAdgroupStatusRequest();
		ZuanshiBannerAdgroupStatusResponse rsp = null;
		
		req.setCampaignId(campaignId);
		req.setAdgroupIdList(adgroupIdList);
		req.setStatus(0L);
		
		try {
			rsp = taobaoClient.execute(req, taobaoAuthorizeUser.getAccess_token());
  		} catch (ApiException e) {
  			LogUtils.logException(e);
  		}
		
		ApiLog apiLog = new ApiLog();
		//修改单元状态
		apiLog.setApi_name("taobao.zuanshi.banner.adgroup.status");
		apiLog.setCall_people("定时任务调用");
		apiLog.setCreate_at(new Date());
		apiLogDao.insertApiLog(apiLog);
		
		if(rsp!=null && rsp.getBody()!=null){
			
			JSONObject obj0 = new JSONObject(rsp.getBody());
			 if (obj0.has("zuanshi_banner_adgroup_modify_response")) {
				 JSONObject obj1 = obj0.getJSONObject("zuanshi_banner_adgroup_modify_response");
				 if (obj1.has("result")) {
					 JSONObject obj2 = obj1.getJSONObject("result");
                     String adgroupModifyMessage = obj2.getString("message");
                     if (adgroupModifyMessage.equals("成功")) {
                    	 //表中单元与创意解绑
                    	 ZxhtZzAdgroupCreativeBindInfo zxhtZzAdgroupCreativeBindInfo = new ZxhtZzAdgroupCreativeBindInfo();
                    	 zxhtZzAdgroupCreativeBindInfo.setTaobao_user_id(zxhtZzCampaignInfo.getTaobao_user_id());
                    	 zxhtZzAdgroupCreativeBindInfo.setCampaign_id(campaignId);
                    	 zxhtZzAdgroupCreativeBindInfo.setBind_status(0L);
                    	 zxhtZzAdgroupCreativeBindInfo.setLast_update_time(new Date());
                    	 zxhtZzAdgroupCreativeBindInfoDao.updateStatusByUerIdAndCampaignId(zxhtZzAdgroupCreativeBindInfo);
                    
                    	 //修改表里单元运行状态
                    	 ZxhtZzCampaignInfo Info = new ZxhtZzCampaignInfo();
                    	 Info.setTaobao_user_id(zxhtZzCampaignInfo.getTaobao_user_id());
                    	 Info.setLast_update_time(new Date());
                    	 zxhtZzCampaignInfoDao.updateTimeExpiresStatus(Info);
                    	 
                    	 //读取解绑数据发邮件
                    	 Long type = zxhtZzCampaignInfo.getCreative_test_type();
                         Long num = zxhtZzCampaignInfo.getCreative_test_num();
                         TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry condition = new TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry();
                         condition.setTaobao_user_id(zxhtZzCampaignInfo.getTaobao_user_id());
                         condition.setLog_date(DateUtils.dateToString(new Date(), "yyyy-MM-dd"));
                         List<TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry> unBindData = taobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntryDao.getUnbindData(condition);
                         String userAddress = taobaoAuthorizeUser.getEmail();
                         List<User> userNormal = userDao.getNormalMannageMail(zxhtZzCampaignInfo.getTaobao_user_id());
                         List<User> userAdvanced = userDao.getAdvancedMannageMail(zxhtZzCampaignInfo.getTaobao_user_id());
                         
                         String message = "<h1 style=text-align:center;font-size:20px;>" + "创意测试" + "      " + taobaoAuthorizeUser.getTaobao_user_nick() + "</h1>";
                         
                         message += "<table border=1 cellspacing=0 cellpadding=0 style=text-align:center;font-size:15px;>" +
                                 "<tr>" +
                                 "<td>计划名称</td>" +
                                 "<td>单元名称</td>" +
                                 "<td>创意名称</td>" +
                                 "<td>创意id</td>" +
                                 "<td>监控类型</td>" +
                                 "<td>监控阀值</td>" +
                                 "<td>展现/点击次数</td>" +
                                 "<td>结束时间</td>" +
                                 "</tr>";
                         
                        for (TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry data : unBindData) {
                        	message += "<tr>" +
                                    "<td>" + data.getCampaign_name() + "</td>" +
                                    "<td>" + data.getAdgroup_name() + "</td>" +
                                    "<td>" + data.getCreative_name() + "</td>" +
                                    "<td>" + data.getCreative_id() + "</td>";
                            if (type == 1) {
                                message += "<td>单图展现</td><td>" + num + "</td><td>" + data.getAd_pv() + "</td>";
                            }
                            if (type == 2) {
                                message += "<td>单图点击</td><td>" + num + "</td><td>" + data.getClick() + "</td>";
                            }
                            message += "<td>" + data.getLast_update_time() + "</td>" +
                                    "<tr>";
                        }
                        
                        message += "</table>";
                        
                        
                        MailEntry mailEntry = new MailEntry();
                		mailEntry.setText(message);
                		mailEntry.setSubject("创意测试");
                		String[] array = null;
                		
                        if(mailStatus==1){
                        	
                    		List<String> reclist = new ArrayList<String>();
                    		for (User email : userNormal) {
                    			 reclist.add(email.getEmail());
                    		}
                    		array = reclist.toArray(new String[reclist.size()]);
                    		try {
                    			mailEntry.setRecipients(array);
                    		} catch (AddressException e) {
                    			LogUtils.logException(e);
                    		}
                        }
                        
                        if(mailStatus==2){
                        	
                        }
 
                        if(mailStatus==3){
 	
                        }
 
                        if(mailStatus==4){
 	
                        }
                        
                        if(array.length>0){
                        	iMailService.sendMail(mailEntry);
                        	LogUtils.logInfo("邮件发送成功,接受人为"+ array.toString());
                        }
                         
                     }
				 }
			 }
		}
		
	}






}
