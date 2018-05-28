package com.huonu.service.impl;

import java.text.SimpleDateFormat;
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
import com.huonu.domain.dao.TaobaoCrowdMonitorCoverageEntryDao;
import com.huonu.domain.dao.UserDao;
import com.huonu.domain.dao.ZxhtZzCampaignInfoDao;
import com.huonu.domain.model.ApiLog;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoCrowdMonitorCoverageEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetDayEntry;
import com.huonu.domain.model.TaobaoZsDmpEntry;
import com.huonu.domain.model.User;
import com.huonu.mail.IMailService;
import com.huonu.mail.MailEntry;
import com.huonu.service.CrowdMonitorCoverageService;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.ApiException;
import com.taobao.api.TaobaoClient;
import com.taobao.api.request.ZuanshiBannerDmpFindRequest;
import com.taobao.api.response.ZuanshiBannerDmpFindResponse;

@Service("crowdMonitorCoverageService")
public class CrowdMonitorCoverageServiceImpl implements CrowdMonitorCoverageService{

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
	private TaobaoCrowdMonitorCoverageEntryDao taobaoCrowdMonitorCoverageEntryDao;
	
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
		List<TaobaoZsDmpEntry> taobaoZsDmpEntryList =new ArrayList<TaobaoZsDmpEntry>();
		ZuanshiBannerDmpFindRequest req = new ZuanshiBannerDmpFindRequest();
		ZuanshiBannerDmpFindResponse rsp = null;
		try {
 			rsp = taobaoClient.execute(req, taobaoAuthorizeUser.getAccess_token());
 		} catch (ApiException e) {
 			LogUtils.logException(e);
 		}
		
        ApiLog apiLog = new ApiLog();
 		apiLog.setApi_name("taobao.zuanshi.banner.dmp.find");
 		apiLog.setCall_people(call_people);
 		apiLog.setCreate_at(new Date());
 		apiLogDao.insertApiLog(apiLog);
 		
 		if(rsp!=null && rsp.getBody()!=null){
 			JSONObject obj1 = new JSONObject(rsp.getBody());
 			if(obj1.has("zuanshi_banner_dmp_find_response")){
 				JSONObject obj2 = obj1.getJSONObject("zuanshi_banner_dmp_find_response");
 				if(obj2.has("result")){
 					JSONObject obj3 = obj2.getJSONObject("result");
 					if(obj3.has("crowds")){
 						JSONObject obj4 =  obj3.getJSONObject("crowds");
 						if(obj4.has("dmp_crowd_d_t_o")){
 							JSONArray obj5 = obj4.getJSONArray("dmp_crowd_d_t_o");
 							for (int j = 0; j < obj5.length(); j++) {
 								JSONObject jsonObject = obj5.getJSONObject(j);
 								Long coverage = jsonObject.getLong("coverage");
 				                String enable_time = jsonObject.getString("enable_time");
 				                String dmp_crowd_name = jsonObject.getString("dmp_crowd_name");
 				                String update_time = jsonObject.getString("update_time");
 				                Long dmp_crowd_id = jsonObject.getLong("dmp_crowd_id");
 				                TaobaoZsDmpEntry taobaoZsDmpEntry = new TaobaoZsDmpEntry();
 				                taobaoZsDmpEntry.setCoverage(coverage);
 				                taobaoZsDmpEntry.setDmp_crowd_id(dmp_crowd_id);
 				                taobaoZsDmpEntry.setDmp_crowd_name(dmp_crowd_name);
 				                taobaoZsDmpEntry.setEnable_time(enable_time);
 				                taobaoZsDmpEntry.setUpdate_time(update_time);
 				                taobaoZsDmpEntry.setLast_update_time(new Date());
 				                taobaoZsDmpEntry.setTaobao_user_id(user_id);
 				                taobaoZsDmpEntryList.add(taobaoZsDmpEntry);
 							}
 						}
 					}
 				}
 			}
 		}
 		
 		
 		TaobaoZsAdvertiserTargetDayEntry condition = new TaobaoZsAdvertiserTargetDayEntry();
 		condition.setTaobao_user_id(user_id);
 		Date dNow = new Date();
        Calendar calendar = Calendar.getInstance();
        calendar.setTime(dNow);
        calendar.add(Calendar.DAY_OF_MONTH, -1);
        dNow = calendar.getTime();
        SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");
        String date = sdf.format(dNow);
        condition.setLog_date(date);
 		
        List<TaobaoCrowdMonitorCoverageEntry> crowdCoverageList = taobaoCrowdMonitorCoverageEntryDao.getCrowdCoverageInfo(condition);
 		
        for (TaobaoCrowdMonitorCoverageEntry crowd : crowdCoverageList){
        	for (TaobaoZsDmpEntry dmp : taobaoZsDmpEntryList) {
        		 if (Long.parseLong(crowd.getCrowd_value()) == dmp.getDmp_crowd_id()) {
        			 Long ad_pv = Long.parseLong(crowd.getAd_pv());
                     Long coverage = dmp.getCoverage();
                     if (ad_pv != null) {
        	
                    	 if (ad_pv / coverage < 0.1) {
                             String message="<tr>";
                             message +="<td>"+crowd.getCampaign_name()+"</td>"+
                                     "<td>"+dmp.getDmp_crowd_name()+"</td>"+
                                     "<td>"+"覆盖率低"+"</td>"+"<tr>";
                             if(crowd.getMail()==1){
                                message1+=message;
                             }else if(crowd.getMail()==2){
                                 message1+=message;
                                 message2+=message;
                             }else if(crowd.getMail()==3){
                                 message1+=message;
                                 message3+=message;
                             }else if(crowd.getMail()==4){
                                 message1+=message;
                                 message2+=message;
                                 message3+=message;
                             }
                    	 }
                    	 
                    	 
                    	 if (ad_pv / coverage > 0.5) {
                             String message="<tr>";
                             message +="<td>"+crowd.getCampaign_name()+"</td>"+
                                     "<td>"+dmp.getDmp_crowd_name()+"</td>"+
                                     "<td>"+"覆盖率高"+"</td>"+"<tr>";
                             if(crowd.getMail()==1){
                                 message1+=message;
                             }
                             else if(crowd.getMail()==2){
                                 message1+=message;
                                 message2+=message;
                             }
                             else if(crowd.getMail()==3){
                                 message1+=message;
                                 message3+=message;
                             }
                             else if(crowd.getMail()==4){
                                 message1+=message;
                                 message2+=message;
                                 message3+=message;
                             }
                         }
                    	 
                    	 
                     }
        		 }
        	}
        }
        
        String startmessage = "<h1 style=text-align:center;font-size:20px;>" + "人群覆盖率监控" + "      " + taobaoAuthorizeUser.getTaobao_user_nick() + "</h1>";
        startmessage += "<div align=center><table border=1 cellspacing=0 cellpadding=0 style=text-align:center;font-size:15px;>" +
                "<tr>" +
                "<td>计划名称</td>" +
                "<td>人群名称</td>" +
                "<td>人群id</td>" +
                "<td>覆盖率高/低</td>" +
                "</tr>";
        
        MailEntry mailEntry = new MailEntry();
        if(message1.length()!=0) {
        	String finalmessage = startmessage + message1 + "</table></div>";
            mailEntry.setText(finalmessage);
            mailEntry.setSubject("Ctr监控");
            List<String> reclist = new ArrayList<String>();
            for (User email : userNormal) {
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
        if(message2.length()!=0) {
        	String finalmessage = startmessage + message2 + "</table></div>";
            mailEntry.setText(finalmessage);
            mailEntry.setSubject("Ctr监控");
            List<String> reclist = new ArrayList<String>();
            for (User email : userAdvanced) {
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
        if(message3.length()!=0) {
        	String finalmessage = startmessage + message3 + "</table></div>";
            mailEntry.setText(finalmessage);
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
