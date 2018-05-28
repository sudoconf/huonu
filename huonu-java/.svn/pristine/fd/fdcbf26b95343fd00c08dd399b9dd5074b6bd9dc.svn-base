package com.huonu.service.impl;

import java.util.ArrayList;
import java.util.Calendar;
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
import com.huonu.domain.model.TaobaoZsAdvertiserCampRtrptsEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserCampRtrptsTotalEntry;
import com.huonu.domain.model.User;
import com.huonu.domain.model.ZxhtZzCampaignInfo;
import com.huonu.mail.IMailService;
import com.huonu.mail.MailEntry;
import com.huonu.service.ChargeMonitorService;
import com.huonu.utils.date.DateUtils;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.ApiException;
import com.taobao.api.TaobaoClient;
import com.taobao.api.request.ZuanshiAdvertiserCampaignRtrptsGetRequest;
import com.taobao.api.request.ZuanshiAdvertiserCampaignRtrptsTotalGetRequest;
import com.taobao.api.response.ZuanshiAdvertiserCampaignRtrptsGetResponse;
import com.taobao.api.response.ZuanshiAdvertiserCampaignRtrptsTotalGetResponse;

@Service("chargeMonitorService")
public class ChargeMonitorServiceImpl implements ChargeMonitorService{

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
	
	
	public void coustomer(String user_id, String call_people) {
		
		//获取用户信息
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
				
		List<User> userNormal = userDao.getNormalMannageMail(user_id);
		List<User> userAdvanced = userDao.getAdvancedMannageMail(user_id);
		String userAddress = taobaoAuthorizeUser.getEmail();
		
		String message1 = "";
        String message2 = "";
        String message3 = "";
		
	    Calendar calendar = Calendar.getInstance();
	    //获取当前的小时，取小时区间左值
	    int hour = calendar.get(Calendar.HOUR_OF_DAY);
	    //获取今天的星期，取值1-7
	    int weekIndex = calendar.get(Calendar.DAY_OF_WEEK);
		
		List<ZxhtZzCampaignInfo> zxhtCampaignInfoList = zxhtZzCampaignInfoDao.getChargeMonitorInfo(user_id);
		
		for(ZxhtZzCampaignInfo campaignInfo:zxhtCampaignInfoList){
			Long campmodel = campaignInfo.getCampaign_model();
			List<TaobaoZsAdvertiserCampRtrptsTotalEntry> campRtrptsTotalEntryList = getCampTotal(call_people,user_id,campmodel,taobaoAuthorizeUser.getAccess_token());
			for (TaobaoZsAdvertiserCampRtrptsTotalEntry campRtrptsTotalEntry : campRtrptsTotalEntryList) {
				//计划当日分时汇总数据中的计划id
				Long campaignIdTotal = Long.parseLong(campRtrptsTotalEntry.getCampaign_id());
                //获取表中满足条件的计划id及名称
                Long campaignId = campaignInfo.getCampaign_id();
                String campaignName = campaignInfo.getCampaign_name();
                //获取该计划消耗监控的类型，过慢，过快以及两个同时监,控
                Long monitorStatus = campaignInfo.getCharge_monitor();
		
                if (campaignIdTotal.equals(campaignId)) {
                	//开始对满足要求的计划进行消耗监控
                    //获取用户计划的投放时间段
                    String workdayTime = campaignInfo.getWorkday();
                    String weekendTime = campaignInfo.getWeekend();
                    //根据星期选出对应的投放时间段数组
                    List<Integer> list = new ArrayList<Integer>();
                    if (weekIndex > 1 & weekIndex < 7 & workdayTime != null) {
                        for (int i = 0; i < workdayTime.split(",").length; i++) {
                            Integer num = Integer.parseInt(workdayTime.split(",")[i]);
                            list.add(num);
                        }
                    }else {
                    	if (weekendTime != null) {
                            for (int i = 0; i < weekendTime.split(",").length; i++) {
                                Integer num = Integer.parseInt(weekendTime.split(",")[i]);
                                list.add(num);
                            }
                        }
                    }
                    //判断当前小时是否在投放的时间段中,只对投放时间段中的消耗进行监控
                    int position = list.indexOf(hour);
                    if (position >= 0) {
                    	//计算出计划投放还剩小时数+1
                        int restHour = list.size() - position;
                        //获取该计划今天的预算
                        Long day_budget = campaignInfo.getDay_budget();
                        //获取今天已经消耗的金额
                        float charge = Float.parseFloat(campRtrptsTotalEntry.getCharge());
                    
                        TaobaoZsAdvertiserCampRtrptsEntry taobaoZsAdvertiserCampRtrptsEntry = getCampHour(call_people,user_id,campaignId,hour - 1, campmodel,taobaoAuthorizeUser.getAccess_token());
                        float hourCharge = Float.parseFloat(taobaoZsAdvertiserCampRtrptsEntry.getCharge());
                        //判断公式：（剩余金额+前一个小时消耗）/（剩余时间+1））/前一个小时的消耗
                        double judgeCharge = (day_budget - charge + hourCharge) / restHour / charge;
                        //过慢的判断
                        if (judgeCharge > 2) {
                        	 if (monitorStatus == 1 || monitorStatus == 3) {
                        		 String message = "<tr>";
                                 message += "<td>" + campaignName + "</td>" +
                                         "<td>" + "消耗过慢" + "</td><tr>";
                                 if (campaignInfo.getMail() == 1) {
                                     message1 += message;
                                 }
                                 if (campaignInfo.getMail() == 2) {
                                     message1 += message;
                                     message2 += message;
                                 }
                                 if (campaignInfo.getMail() == 3) {
                                     message1 += message;
                                     message3 += message;
                                 }
                                 if (campaignInfo.getMail() == 4) {
                                     message1 += message;
                                     message2 += message;
                                     message3 += message;
                                 }
                        	}
                        }else if (judgeCharge < 0.5) {
                        	//过快的判断
                        	if (monitorStatus == 2 || monitorStatus == 3) {
                                String message = "<tr>";
                                message += "<td>" + campaignName + "</td>" +
                                        "<td>" + "消耗过快" + "</td><tr>";
                                if (campaignInfo.getMail() == 1) {
                                    message1 += message;
                                }else if (campaignInfo.getMail() == 2) {
                                    message1 += message;
                                    message2 += message;
                                }else if (campaignInfo.getMail() == 3) {
                                    message1 += message;
                                    message3 += message;
                                }else if (campaignInfo.getMail() == 4) {
                                    message1 += message;
                                    message2 += message;
                                    message3 += message;
                                }
                            }
                        }
                    }else{
                    	String message = "<tr>";
                        message += "<td>" + campaignName + "</td>" +
                                 "<td>" + "未消耗" + "</td><tr>";
                        if (campaignInfo.getMail() == 1) {
                            message1 += message;
                        } else if (campaignInfo.getMail() == 2) {
                            message1 += message;
                            message2 += message;
                        }else if (campaignInfo.getMail() == 3) {
                            message1 += message;
                            message3 += message;
                        }else if (campaignInfo.getMail() == 4) {
                            message1 += message;
                            message2 += message;
                            message3 += message;
                        }
                    }
                }
			}
		}
		
		String message = "<h1 style=text-align:center;font-size:20px;>" + "消耗监控" + "      " + taobaoAuthorizeUser.getTaobao_user_nick() + "</h1>";
        message += "<div align=center><table border=1 cellspacing=0 cellpadding=0 style=text-align:center;font-size:15px;>" +
                "<tr>" +
                "<td>计划名称</td>" +
                "<td>消耗类型</td>" +
                "</tr>";
		
        MailEntry mailEntry = new MailEntry();
        
        if (message1.length() != 0) {
        	String sendmessage = message + message1 + "</table></div>";
        	mailEntry.setText(sendmessage);
			mailEntry.setSubject("消耗监控");
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
        
        if (message2.length() != 0) {
        	String sendmessage = message + message2 + "</table></div>";
        	mailEntry.setText(sendmessage);
			mailEntry.setSubject("消耗监控");
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

        if (message3.length() != 0) {
        	String sendmessage = message + message3 + "</table></div>";
        	mailEntry.setText(sendmessage);
			mailEntry.setSubject("消耗监控");
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
	
	
	
	
	
	 //获取当日分时汇总数据
	public List<TaobaoZsAdvertiserCampRtrptsTotalEntry> getCampTotal(String call_people,String user_id,Long campaignModel,String sessionkey){
		
		List<TaobaoZsAdvertiserCampRtrptsTotalEntry> campRtrptsTotalLists = new ArrayList<TaobaoZsAdvertiserCampRtrptsTotalEntry>();
		
		ZuanshiAdvertiserCampaignRtrptsTotalGetRequest req = new ZuanshiAdvertiserCampaignRtrptsTotalGetRequest ();
		ZuanshiAdvertiserCampaignRtrptsTotalGetResponse rsp = null;
		req.setLogDate(DateUtils.dateToString(new Date(), "yyyy-MM-dd"));
		req.setCampaignModel(campaignModel);
		req.setOffset(0L);
		req.setPageSize(200L);
		
		try {
			rsp = taobaoClient.execute(req, sessionkey);
		} catch (ApiException e) {
			LogUtils.logException(e);
		}
		
		ApiLog apiLog = new ApiLog();
		apiLog.setApi_name("taobao.zuanshi.advertiser.campaign.rtrpts.total.get");
		apiLog.setCall_people(call_people);
		apiLog.setCreate_at(new Date());
		apiLogDao.insertApiLog(apiLog);
		
		if(rsp!=null && rsp.getBody()!=null){
			
			JSONObject obj0 = new JSONObject(rsp.getBody());
			if (obj0.has("zuanshi_advertiser_campaign_rtrpts_total_get_response")) {
				JSONObject obj00 = obj0.getJSONObject("zuanshi_advertiser_campaign_rtrpts_total_get_response");
				if (obj00.has("campaign_realtime_rpt_total_list")) {
					JSONObject obj = obj00.getJSONObject("campaign_realtime_rpt_total_list");
					if (obj.has("data")) {
						JSONArray obj4 = obj.getJSONArray("data");
						for (int i = 0; i < obj4.length(); i++) {
							TaobaoZsAdvertiserCampRtrptsTotalEntry campRtrptsList = new TaobaoZsAdvertiserCampRtrptsTotalEntry();
							JSONObject jsonObject = obj4.getJSONObject(i);
							//获取json中的字段
	                        if(jsonObject.has("ad_pv")){
	                            String ad_pv = jsonObject.getString("ad_pv");
	                            campRtrptsList.setAd_pv(ad_pv);
	                        }
	                        if(jsonObject.has("ecpm")){
	                            String ecpm = jsonObject.getString("ecpm");
	                            campRtrptsList.setEcpm(ecpm);
	                        }
	                        if(jsonObject.has("ctr")){
	                            String ctr = jsonObject.getString("ctr");
	                            campRtrptsList.setCtr(ctr);
	                        }
	                        if(jsonObject.has("ecpc")){
	                            String ecpc = jsonObject.getString("ecpc");
	                            campRtrptsList.setEcpc(ecpc);
	                        }
	                        String charge = jsonObject.getString("charge");
	                        String log_date = jsonObject.getString("log_date");
	                        String click = jsonObject.getString("click");
	                        String campaign_name = jsonObject.getString("campaign_name");
	                        String campaign_id = jsonObject.getString("campaign_id");
	                        //存储上述字段到pojo对象中
	                        campRtrptsList.setCharge(charge);
	                        campRtrptsList.setLog_date(log_date);
	                        campRtrptsList.setClick(click);
	                        campRtrptsList.setCampaign_name(campaign_name);
	                        campRtrptsList.setTaobao_user_id(user_id);
	                        campRtrptsList.setCampaign_id(campaign_id);
	                        campRtrptsList.setLast_update_time(new Date());
	                        campRtrptsTotalLists.add(campRtrptsList);
						}
					}
				}
			}
		}
		return campRtrptsTotalLists;
	}
	
	
	//获取当日分时数据，取最新一个小时的数据
	public TaobaoZsAdvertiserCampRtrptsEntry getCampHour(String call_people,String user_id,Long campaign_id,int hour,Long campaign_model,String sessionkey){
		
		List<TaobaoZsAdvertiserCampRtrptsEntry> campRtrptsLists = new ArrayList<TaobaoZsAdvertiserCampRtrptsEntry>();
		TaobaoZsAdvertiserCampRtrptsEntry hourCamp = new TaobaoZsAdvertiserCampRtrptsEntry();

		ZuanshiAdvertiserCampaignRtrptsGetRequest req = new ZuanshiAdvertiserCampaignRtrptsGetRequest();
		ZuanshiAdvertiserCampaignRtrptsGetResponse rsp = null;
		
		req.setLogDate(DateUtils.dateToString(new Date(),"yyyy-MM-dd"));
		req.setCampaignModel(campaign_model);
		req.setCampaignId(campaign_id);
		
		try {
			rsp = taobaoClient.execute(req, sessionkey);
		} catch (ApiException e) {
			LogUtils.logException(e);
		}
		
		ApiLog apiLog = new ApiLog();
		apiLog.setApi_name("taobao.zuanshi.advertiser.campaign.rtrpts.get");
		apiLog.setCall_people(call_people);
		apiLog.setCreate_at(new Date());
		apiLogDao.insertApiLog(apiLog);
		
		if(rsp!=null && rsp.getBody()!=null){
			
			JSONObject obj0 = new JSONObject(rsp.getBody());
			if (obj0.has("zuanshi_advertiser_campaign_rtrpts_get_response")) {
				JSONObject obj00 = obj0.getJSONObject("zuanshi_advertiser_campaign_rtrpts_get_response");
				if (obj00.has("campaign_realtime_rpt_list")) {
					JSONObject obj = obj00.getJSONObject("campaign_realtime_rpt_list");
					if (obj.has("data")) {
						 JSONArray obj4 = obj.getJSONArray("data");
						 for (int i = 0; i < obj4.length(); i++) {
							 TaobaoZsAdvertiserCampRtrptsEntry campList = new TaobaoZsAdvertiserCampRtrptsEntry();
		                     JSONObject jsonObject = obj4.getJSONObject(i);
		                     //获取json中的字段
		                     if(jsonObject.has("ad_pv")){
		                         String ad_pv = jsonObject.getString("ad_pv");
		                         campList.setAd_pv(ad_pv);
		                     }
		                     if(jsonObject.has("ecpm")){
		                         String ecpm = jsonObject.getString("ecpm");
		                         campList.setEcpm(ecpm);
		                     }
		                     if(jsonObject.has("ctr")){
		                         String ctr = jsonObject.getString("ctr");
		                         campList.setCtr(ctr);
		                     }
		                     if(jsonObject.has("ecpc")){
		                         String ecpc = jsonObject.getString("ecpc");
		                         campList.setEcpc(ecpc);
		                     }
		                     String charge = jsonObject.getString("charge");
		                     String log_date = jsonObject.getString("log_date");
		                     String click = jsonObject.getString("click");
		                     String campaign_id1 = jsonObject.getString("campaign_id");
		                     String hour_id = jsonObject.getString("hour_id");
		                     //存储上述字段到pojo对象中
		                     campList.setCharge(charge);
		                     campList.setLog_date(log_date);
		                     campList.setClick(click);
		                     campList.setTaobao_user_id(user_id);
		                     campList.setCampaign_id(campaign_id1);
		                     campList.setHour_id(hour_id);
		                     campRtrptsLists.add(campList);
						 }
					}
				}
			}
			
		}
		
		for (TaobaoZsAdvertiserCampRtrptsEntry camp : campRtrptsLists) {
	          if (camp.getHour_id().equals(String.valueOf(hour))) {
	                hourCamp = camp;
	          }
	    }
		
		return hourCamp;
	}

}
