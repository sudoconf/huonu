package com.huonu.service.impl;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import javax.mail.internet.AddressException;

import org.json.JSONArray;
import org.json.JSONObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.huonu.domain.dao.ApiLogDao;
import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.dao.UserDao;
import com.huonu.domain.dao.ZxhtZzCampaignInfoDao;
import com.huonu.domain.model.ApiLog;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry;
import com.huonu.domain.model.User;
import com.huonu.domain.model.ZxhtZzCampaignInfo;
import com.huonu.mail.IMailService;
import com.huonu.mail.MailEntry;
import com.huonu.service.CreativeMonitorCtrService;
import com.huonu.utils.date.DateUtils;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.ApiException;
import com.taobao.api.TaobaoClient;
import com.taobao.api.request.ZuanshiAdvertiserCreativeRtrptsTotalGetRequest;
import com.taobao.api.response.ZuanshiAdvertiserCreativeRtrptsTotalGetResponse;

@Service("creativeMonitorCtrService")
public class CreativeMonitorCtrServiceImpl implements CreativeMonitorCtrService{

	@Autowired
	private TaobaoClient taobaoClient;
	
	@Autowired
	private ZxhtZzCampaignInfoDao zxhtZzCampaignInfoDao;
	
	@Autowired
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	@Autowired
	private ApiLogDao apiLogDao;
	
	@Autowired
	private UserDao userDao;
	
	@Autowired
	private IMailService iMailService;
	
	public void coustomer(String user_id,String call_people) {
		
		List<List<TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry>> dataList = new ArrayList<List<TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry>>();
		//获取用户需要监控的计划信息
		List<ZxhtZzCampaignInfo> zxhtCampaignInfoList = zxhtZzCampaignInfoDao.getCtrMonitorInfo(user_id);
		
		//获取用户信息
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		
		List<User> userNormal = userDao.getNormalMannageMail(user_id);
        List<User> userAdvanced = userDao.getAdvancedMannageMail(user_id);
        String userAddress = taobaoAuthorizeUser.getEmail();
        
		String message1 = "";
        String message2 = "";
        String message3 = "";
        String messageone ="";
        
        messageone += "<h1 style=text-align:center;font-size:20px;>" + "创意点击率监控" + "      " + taobaoAuthorizeUser.getTaobao_user_nick() + "</h1>";
        messageone += "<div align=center><table border=1 cellspacing=0 cellpadding=0 style=text-align:center;font-size:15px;><tr><td>计划名称</td><td>单元名称</td><td>创意名称</td><td>创意id</td><td>单元平均点击率</td><td>创意点击率</td></tr>";
        
		ZuanshiAdvertiserCreativeRtrptsTotalGetRequest req = new ZuanshiAdvertiserCreativeRtrptsTotalGetRequest ();
		ZuanshiAdvertiserCreativeRtrptsTotalGetResponse rsp = null;
		
		for (ZxhtZzCampaignInfo zxhtCampInfoList : zxhtCampaignInfoList) {
			
			List<TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry> data = new ArrayList<TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry>();
            
			req.setCampaignId(zxhtCampInfoList.getCampaign_id());
            req.setAdgroupId(zxhtCampInfoList.getAdgroup_id());
            req.setCampaignModel(zxhtCampInfoList.getCampaign_model());
            req.setOffset(0L);
            req.setPageSize(200L);
            req.setLogDate(DateUtils.getYesterdayString());
            
            try {
    			rsp = taobaoClient.execute(req, taobaoAuthorizeUser.getAccess_token());
    		} catch (ApiException e) {
    			LogUtils.logException(e);
    		}
            
            ApiLog apiLog = new ApiLog();
    		apiLog.setApi_name("taobao.zuanshi.advertiser.creative.rtrpts.total.get");
    		apiLog.setCall_people(call_people);
    		apiLog.setCreate_at(new Date());
    		apiLogDao.insertApiLog(apiLog);
    		
    		if(rsp!=null && rsp.getBody()!=null){
    			
    			JSONObject obj1 = new JSONObject(rsp.getBody());
    			if(obj1.has("zuanshi_advertiser_creative_rtrpts_total_get_response")){
    				JSONObject obj2 = obj1.getJSONObject("zuanshi_advertiser_creative_rtrpts_total_get_response");
    				if(obj2.has("creative_realtime_rpt_total_list")){
    					JSONObject obj3 = obj2.getJSONObject("creative_realtime_rpt_total_list");
    					if (obj3.has("data")) {
    						JSONArray obj4 = obj3.getJSONArray("data");
    						for (int i = 0; i < obj4.length(); i++) {
    							TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry creativeRtrpts = new TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry();
    							JSONObject jsonObject = obj4.getJSONObject(i);
    			                if(jsonObject.has("ad_pv")){
    			                    String ad_pv = jsonObject.getString("ad_pv");
    			                    creativeRtrpts.setAd_pv(ad_pv);
    			                }
    			                if(jsonObject.has("ecpm")){
    			                    String ecpm = jsonObject.getString("ecpm");
    			                    creativeRtrpts.setEcpm(ecpm);
    			                }
    			                if(jsonObject.has("ctr")){
    			                    String ctr = jsonObject.getString("ctr");
    			                    creativeRtrpts.setCtr(ctr);
    			                }
    			                if(jsonObject.has("ecpc")){
    			                    String ecpc = jsonObject.getString("ecpc");
    			                    creativeRtrpts.setEcpc(ecpc);
    			                }
    			                if(jsonObject.has("img_url")){
    			                    String img_url = jsonObject.getString("img_url");
    			                    creativeRtrpts.setImg_url(img_url);
    			                }
    			                String adgroup_id = jsonObject.getString("adgroup_id");
    			                String campaign_id = jsonObject.getString("campaign_id");
    			                String click = jsonObject.getString("click");
    			                String creative_id = jsonObject.getString("creative_id");
    			                String charge = jsonObject.getString("charge");
    			                String log_date = jsonObject.getString("log_date");
    			                String campaign_name = jsonObject.getString("campaign_name");
    			                String adgroup_name = jsonObject.getString("adgroup_name");
    			                String creative_name = jsonObject.getString("creative_name");
    			                creativeRtrpts.setAdgroup_id(adgroup_id);
    			                creativeRtrpts.setAdgroup_name(adgroup_name);
    			                creativeRtrpts.setCampaign_id(campaign_id);
    			                creativeRtrpts.setCampaign_name(campaign_name);
    			                creativeRtrpts.setCreative_id(creative_id);
    			                creativeRtrpts.setCreative_name(creative_name);
    			                creativeRtrpts.setCharge(charge);
    			                creativeRtrpts.setClick(click);
    			                creativeRtrpts.setLog_date(log_date);
    			                creativeRtrpts.setTaobao_user_id(user_id);
    			                creativeRtrpts.setLast_update_time(new Date());
    			                data.add(creativeRtrpts);
    						}
    					}
    				}
    			}
    		}
    		dataList.add(data);
		}
		
		int i = 0;
		for (List<TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry> data : dataList) {
			
			Long mailStatus = zxhtCampaignInfoList.get(i).getMail();
			
			if(data.size()>0) {
				Long clickAll = 0L;
                Long adPvAll = 0L;
                for (TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry data0 : data) {
                    clickAll += Long.parseLong(data0.getClick());
                    adPvAll += Long.parseLong(data0.getAd_pv());
                }
                if (adPvAll != 0L & clickAll != 0L) {
                	 double avgCtr = (double) clickAll / (double) adPvAll;
                	 for (TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry data0 : data) {
                		 long adPv = Long.parseLong(data0.getAd_pv());
                         String messageone1 = "";
                         double ctr=0.0000;
                         if(adPv!=0L){
                             ctr = Double.parseDouble(data0.getCtr());
                         }
                         if (ctr < avgCtr) {
                             messageone1 += "<tr><td>" + data0.getCampaign_name() + "</td>";
                             messageone1 += "<td>" + data0.getAdgroup_name() + "</td>";
                             messageone1 += "<td>" + data0.getCreative_name() + "</td>";
                             messageone1 += "<td>" + data0.getCreative_id() + "</td>";
                             messageone1 += "<td>" + String.format("%.2f", avgCtr * 100) + "</td>";
                             messageone1 += "<td>" + data0.getCtr() + "</td></tr>";
                         }
                         if (mailStatus == 1) {
                        	 message1 += messageone1;
                         } else if (mailStatus == 2) {
                             message1 += messageone1;
                             message2 += messageone1;
                         } else if (mailStatus == 3) {
                             message1 += messageone1;
                             message3 += messageone1;
                         } else if (mailStatus == 4) {
                             message1 += messageone1;
                             message2 += messageone1;
                             message3 += messageone1;
                         }
                	 }
                }
			}
			i= i+1;
		}

		MailEntry mailEntry = new MailEntry();
		
		if(message1.length()!=0) {
			message1 = messageone + message1+"</table></div>";
			mailEntry.setText(message1);
			mailEntry.setSubject("Ctr监控");
			List<String> reclist = new ArrayList<String>();
            for (User email: userNormal) {
            	reclist.add(email.getEmail());
            }
            String[] array = reclist.toArray(new String[reclist.size()]); 
            try {
    			mailEntry.setRecipients(array);
    			iMailService.sendMail(mailEntry);
    			LogUtils.logInfo("邮件发送成功,接受人为"+ array.toString());
    		} catch (AddressException e) {
    			LogUtils.logException(e);
    		}
		}
		
		if (message2.length()!=0){
            message2 = messageone + message2+"</table></div>";
            mailEntry.setText(message3);
            mailEntry.setSubject("Ctr监控");
            List<String> reclist = new ArrayList<String>();
            for (User email: userAdvanced) {
            	reclist.add(email.getEmail());
            }
            String[] array = reclist.toArray(new String[reclist.size()]); 
            try {
            	mailEntry.setRecipients(array);
     			iMailService.sendMail(mailEntry);
     			LogUtils.logInfo("邮件发送成功,接受人为"+ array.toString());
     		} catch (AddressException e) {
     			LogUtils.logException(e);
     		} 
        }
		 
		 
        if (message3.length()!=0){
        	message3 = messageone + message3+"</table></div>";
            mailEntry.setText(message3);
            mailEntry.setSubject("Ctr监控");
            List<String> reclist = new ArrayList<String>();
            reclist.add(userAddress);
            String[] array = reclist.toArray(new String[reclist.size()]);
            try {
            	mailEntry.setRecipients(array);
     			iMailService.sendMail(mailEntry);
     			LogUtils.logInfo("邮件发送成功,接受人为"+ array.toString());
     		} catch (AddressException e) {
     			LogUtils.logException(e);
     		}
        }

	}
	
	

}
