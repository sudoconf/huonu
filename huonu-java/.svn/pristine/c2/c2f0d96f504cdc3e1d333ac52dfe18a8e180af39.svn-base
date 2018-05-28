package com.huonu.service.impl;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.apache.http.HttpEntity;
import org.apache.http.client.methods.CloseableHttpResponse;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.CloseableHttpClient;
import org.apache.http.impl.client.HttpClients;
import org.apache.http.util.EntityUtils;
import org.json.JSONObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.google.gson.Gson;
import com.huonu.domain.dao.TaobaoAsyncTaskEntryDao;
import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserAdgroupDayEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserAdzoneDayEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserCampDayEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserCreativeDayEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserTargetDayEntryDao;
import com.huonu.domain.model.TaobaoAsyncTaskEntry;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZsAdvertiserAdgroupDayEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserAdzoneDayEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserCampDayEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserCreativeDayEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetDayEntry;
import com.huonu.service.ApiCallService;
import com.huonu.service.DownloadService;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.request.TopatsResultGetRequest;
import com.taobao.api.response.TopatsResultGetResponse;

@Service("downloadService")
public class DownloadServiceImpl implements DownloadService{
	
	@Autowired
	private ApiCallService apiCallService;
	
	@Autowired
	private TaobaoAsyncTaskEntryDao taobaoAsyncTaskEntryDao;
	
	@Autowired
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao ;
	
	@Autowired
	private TaobaoZsAdvertiserCampDayEntryDao taobaoZsAdvertiserCampDayEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserAdgroupDayEntryDao taobaoZsAdvertiserAdgroupDayEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserTargetDayEntryDao taobaoZsAdvertiserTargetDayEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserCreativeDayEntryDao taobaoZsAdvertiserCreativeDayEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserAdzoneDayEntryDao taobaoZsAdvertiserAdzoneDayEntryDao;
	
		
	public void setDatabyId(String call_people,String userId) {
		
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(userId);
		String sessionkey = taobaoAuthorizeUser.getAccess_token();
		Date dNow = new Date();
        Calendar calendar = Calendar.getInstance();
        calendar.setTime(dNow);
        calendar.add(Calendar.DAY_OF_MONTH, -1);
        dNow = calendar.getTime();
        SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");
        String end_time = sdf.format(dNow);
        TaobaoAsyncTaskEntry taobaoAsyncTaskEntry=new TaobaoAsyncTaskEntry();
        taobaoAsyncTaskEntry.setTaobaoUserId(userId);
        taobaoAsyncTaskEntry.setEndDate(end_time);
        taobaoAsyncTaskEntry.setTaskStatus("new");
        List<TaobaoAsyncTaskEntry> taobaoAsyncTaskEntryList = taobaoAsyncTaskEntryDao.getTodayTaobaoAsyncTaskByUserIdAndTaskStatus(taobaoAsyncTaskEntry);
        	
        for(TaobaoAsyncTaskEntry taskentry:taobaoAsyncTaskEntryList){
        	
	        long taskId = taskentry.getTaskId();
	        String download_url = "";
	        TopatsResultGetRequest req = new TopatsResultGetRequest ();
	        TopatsResultGetResponse rsp = null;
	        Gson gson = new Gson();
	        req.setTaskId(taskId);
	        rsp = apiCallService.call(req, sessionkey, call_people, "taobao.topats.result.get");
	       	if(rsp!=null){
	       		JSONObject obj1 = new JSONObject(rsp.getBody());
	       		if (obj1.has("topats_result_get_response")) {
	       			JSONObject obj2 = obj1.getJSONObject("topats_result_get_response");
	       			if (obj2.has("task")) {
	       				JSONObject obj3 = obj2.getJSONObject("task");
	       	            String status = obj3.getString("status");
	       	            if(status.equals("done")){
	       	            	download_url = obj3.getString("download_url");
	       	            	setData(taskentry,download_url,userId);
	       		       		taskentry.setTaskStatus("done");
	       		       		taobaoAsyncTaskEntryDao.updateTaobaoAsyncTaskStatus(taskentry);
	       	         	}	
	       			}
	       		}else{
	       			LogUtils.logInfo("异步获取错误信息为"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
	       			if (obj1.has("error_response")){
	       				JSONObject obj2 = obj1.getJSONObject("error_response");
	       				if(obj2.has("sub_msg")) {
	       					String sub_msg = obj2.getString("sub_msg");
	       					if("异步任务结果为空".equals(sub_msg)){
	       						taskentry.setTaskStatus("done");
	       						taskentry.setError_Msg("异步任务结果为空");
		       		       		taobaoAsyncTaskEntryDao.updateTaobaoAsyncTaskStatus(taskentry);
	       					}
	       				}
	       			}
	       		}
	       	}
	    }
	}  
        
        
	
	 //根据指定taskid来存储数据
    public void setData(TaobaoAsyncTaskEntry task,String url,String userId){
        try {
            CloseableHttpClient httpclient = HttpClients.createDefault();
            HttpGet httpGet = new HttpGet(url);
            CloseableHttpResponse resp = httpclient.execute(httpGet);
           
            if (resp.getStatusLine().toString().equals("HTTP/1.1 200 OK")){
                HttpEntity entity = resp.getEntity();
                String content = new String(EntityUtils.toString(entity).getBytes("iso-8859-1"),"utf8");
                
                if(task.getHierarchy().equals("target")){
                	long campModel = task.getCampModel();
                    String effectType = task.getEffectType();
                	List<TaobaoZsAdvertiserTargetDayEntry> taobaoZsAdvertiserTargetDayEntryList = new ArrayList<TaobaoZsAdvertiserTargetDayEntry>();
                	String[] contentArray = null;
                    contentArray = content.split("\n");
                     	
                    for(int i = 1;i<contentArray.length;i++){
                    	TaobaoZsAdvertiserTargetDayEntry taobaoZsAdvertiserTargetDayEntry = new TaobaoZsAdvertiserTargetDayEntry();
                    	int index = 0;
                    	String linestr = contentArray[i];
                    	
                    	index  = linestr.indexOf(",");
                    	String nick = linestr.substring(0, index);
                    	
                    	linestr = linestr.substring(index+1, linestr.length());
                    	index  = linestr.indexOf(",");
                    	String campaignName = linestr.substring(0, index);
                    	taobaoZsAdvertiserTargetDayEntry.setCampaign_name(campaignName);
                    	
                    	linestr = linestr.substring(index+1, linestr.length());
                    	index  = linestr.indexOf(",");
                    	String campaignId = linestr.substring(0, index);
                    	taobaoZsAdvertiserTargetDayEntry.setCampaign_id(campaignId);
                    	
                    	linestr = linestr.substring(index+1, linestr.length());
                    	index  = linestr.indexOf(",");
                    	String adgroupName = linestr.substring(0, index);
                    	taobaoZsAdvertiserTargetDayEntry.setAdgroup_name(adgroupName);
                    	
                    	linestr = linestr.substring(index+1, linestr.length());
                    	index  = linestr.indexOf(",");
                    	String adgroupId = linestr.substring(0, index);
                    	taobaoZsAdvertiserTargetDayEntry.setAdgroup_id(adgroupId);
                    	
                    	linestr = linestr.substring(index+1, linestr.length());
                    	index = linestr.lastIndexOf(",");
                    	String roi = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setRoi(roi);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String cvr = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setCvr(cvr);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String alipayInshopAmt = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setAlipay_inshop_amt(alipayInshopAmt);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String alipayInShopNum = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setAlipay_in_shop_num(alipayInShopNum);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String gmvInshopAmt = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setGmv_inshop_amt(gmvInshopAmt);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String gmvInshopNum = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setGmv_inshop_num(gmvInshopNum);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String cartNum = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setCart_num(cartNum);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String dirShopColNum = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setDir_shop_col_num(dirShopColNum);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String inshopItemColNum = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setInshop_item_col_num(inshopItemColNum);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String avgAccessPageNum = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setAvg_access_page_num(avgAccessPageNum);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String avgAccessTime = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setAvg_access_time(avgAccessTime);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String deepInshopUv = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setDeep_inshop_uv(deepInshopUv);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String uv = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setUv(uv);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String ecpm = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setEcpm(ecpm);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String ecpc = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setEcpc(ecpc);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String ctr = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setCtr(ctr);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String charge = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setCharge(charge);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String click = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setClick(click);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String adPv = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setAd_pv(adPv);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String logDate = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setLog_date(logDate);
                    	
                    	linestr = linestr.substring(0, index);
                    	index = linestr.lastIndexOf(",");
                    	String targetId = linestr.substring(index+1, linestr.length());
                    	taobaoZsAdvertiserTargetDayEntry.setTarget_id(targetId);
                    	
                    	linestr = linestr.substring(0, index);
                    	taobaoZsAdvertiserTargetDayEntry.setTarget_name(linestr);
                    	
                    	 if (targetId.equals ("-2")) {
                    		 taobaoZsAdvertiserTargetDayEntry.setTarget_name("系统托管定向包");
                         }
                    	
                    	if (effectType.equals("click")){
                    		taobaoZsAdvertiserTargetDayEntry.setEffect(7l);
                        }else{
                        	taobaoZsAdvertiserTargetDayEntry.setEffect(15l);
                        }
                    	taobaoZsAdvertiserTargetDayEntry.setTaobao_user_id(userId);
                    	taobaoZsAdvertiserTargetDayEntry.setEffect_type(effectType);
                    	taobaoZsAdvertiserTargetDayEntry.setCampaign_model(campModel);
                        taobaoZsAdvertiserTargetDayEntry.setLast_update_time(new Date());
                    	
                    	taobaoZsAdvertiserTargetDayEntryList.add(taobaoZsAdvertiserTargetDayEntry);
                    	
                    }
                     	
                    taobaoZsAdvertiserTargetDayEntryDao.insertOrUpdateTaobaoZsAdvertiserTargetDayEntryList(taobaoZsAdvertiserTargetDayEntryList);
                         
                }else{
                
                	 char regex = content.charAt(0);
                     String replace="";
                     Pattern p = Pattern.compile(Character.toString(regex));
                     Matcher m = p.matcher(content);
                     content = m.replaceFirst(replace);
                     content = content.replace("\n",",");
                     String[] contentArray = null;
                     contentArray = content.split(",");
                     int len = contentArray.length;
                     long campModel = task.getCampModel();
                     String effectType = task.getEffectType();
                     
                     if (task.getHierarchy().equals("campaign")) {
                     	
                     	List<TaobaoZsAdvertiserCampDayEntry> taobaoZsAdvertiserCampDayEntryList = new ArrayList<TaobaoZsAdvertiserCampDayEntry>();
                         
                     	for(int i = 0 ;i <= len/23 -2 ;i++){
                             TaobaoZsAdvertiserCampDayEntry taobaoZsAdvertiserCampDayEntry = new TaobaoZsAdvertiserCampDayEntry();
                             taobaoZsAdvertiserCampDayEntry.setCampaign_name(contentArray[(i+1)*23+1]);
                             taobaoZsAdvertiserCampDayEntry.setCampaign_id(contentArray[(i+1)*23+2]);
                             taobaoZsAdvertiserCampDayEntry.setLog_date(contentArray[(i+1)*23+3]);
                             taobaoZsAdvertiserCampDayEntry.setAd_pv(contentArray[(i+1)*23+4]);
                             taobaoZsAdvertiserCampDayEntry.setClick(contentArray[(i+1)*23+5]);
                             taobaoZsAdvertiserCampDayEntry.setCharge(contentArray[(i+1)*23+6]);
                             taobaoZsAdvertiserCampDayEntry.setCtr(contentArray[(i+1)*23+7]);
                             taobaoZsAdvertiserCampDayEntry.setEcpc(contentArray[(i+1)*23+8]);
                             taobaoZsAdvertiserCampDayEntry.setEcpm(contentArray[(i+1)*23+9]);
                             taobaoZsAdvertiserCampDayEntry.setUv(contentArray[(i+1)*23+10]);
                             taobaoZsAdvertiserCampDayEntry.setDeep_inshop_uv(contentArray[(i+1)*23+11]);
                             taobaoZsAdvertiserCampDayEntry.setAvg_access_time(contentArray[(i+1)*23+12]);
                             taobaoZsAdvertiserCampDayEntry.setAvg_access_page_num(contentArray[(i+1)*23+13]);
                             taobaoZsAdvertiserCampDayEntry.setInshop_item_col_num(contentArray[(i+1)*23+14]);
                             taobaoZsAdvertiserCampDayEntry.setDir_shop_col_num(contentArray[(i+1)*23+15]);
                             taobaoZsAdvertiserCampDayEntry.setCart_num(contentArray[(i+1)*23+16]);
                             taobaoZsAdvertiserCampDayEntry.setGmv_inshop_num(contentArray[(i+1)*23+17]);
                             taobaoZsAdvertiserCampDayEntry.setGmv_inshop_amt(contentArray[(i+1)*23+18]);
                             taobaoZsAdvertiserCampDayEntry.setAlipay_in_shop_num(contentArray[(i+1)*23+19]);
                             taobaoZsAdvertiserCampDayEntry.setAlipay_inshop_amt(contentArray[(i+1)*23+20]);
                             taobaoZsAdvertiserCampDayEntry.setCvr(contentArray[(i+1)*23+21]);
                             taobaoZsAdvertiserCampDayEntry.setRoi(contentArray[(i+1)*23+22]);
                             if (effectType.equals("click")){
                             	taobaoZsAdvertiserCampDayEntry.setEffect(7l);
                             }else{
                             	taobaoZsAdvertiserCampDayEntry.setEffect(15l);
                             }
                             taobaoZsAdvertiserCampDayEntry.setTaobao_user_id(userId);
                             taobaoZsAdvertiserCampDayEntry.setCampaign_model(campModel);
                             taobaoZsAdvertiserCampDayEntry.setEffect_type(effectType);
                             taobaoZsAdvertiserCampDayEntry.setLast_update_time(new Date());
                             taobaoZsAdvertiserCampDayEntryList.add(taobaoZsAdvertiserCampDayEntry);
                         }
                     	taobaoZsAdvertiserCampDayEntryDao.insertOrUpdateTaobaoZsAdvertiserCampDayEntryList(taobaoZsAdvertiserCampDayEntryList);
                         
                     } else if (task.getHierarchy().equals("adgroup")) {
                     	
                     	List<TaobaoZsAdvertiserAdgroupDayEntry> taobaoZsAdvertiserAdgroupDayEntryList = new ArrayList<TaobaoZsAdvertiserAdgroupDayEntry>();
                     	
                         for(int i = 0 ;i <= len/25 -2 ;i++) {
                             TaobaoZsAdvertiserAdgroupDayEntry taobaoZsAdvertiserAdgroupDayEntry = new TaobaoZsAdvertiserAdgroupDayEntry();
                             taobaoZsAdvertiserAdgroupDayEntry.setCampaign_name(contentArray[(i + 1) * 25 + 1]);
                             taobaoZsAdvertiserAdgroupDayEntry.setCampaign_id(contentArray[(i + 1) * 25 + 2]);
                             taobaoZsAdvertiserAdgroupDayEntry.setAdgroup_name(contentArray[(i + 1) * 25 + 3]);
                             taobaoZsAdvertiserAdgroupDayEntry.setAdgroup_id(contentArray[(i + 1) * 25 + 4]);
                             taobaoZsAdvertiserAdgroupDayEntry.setLog_date(contentArray[(i + 1) * 25 + 5]);
                             taobaoZsAdvertiserAdgroupDayEntry.setAd_pv(contentArray[(i + 1) * 25 + 6]);
                             taobaoZsAdvertiserAdgroupDayEntry.setClick(contentArray[(i + 1) * 25 + 7]);
                             taobaoZsAdvertiserAdgroupDayEntry.setCharge(contentArray[(i + 1) * 25 + 8]);
                             taobaoZsAdvertiserAdgroupDayEntry.setCtr(contentArray[(i + 1) * 25 + 9]);
                             taobaoZsAdvertiserAdgroupDayEntry.setEcpc(contentArray[(i + 1) * 25 + 10]);
                             taobaoZsAdvertiserAdgroupDayEntry.setEcpm(contentArray[(i + 1) * 25 +11]);
                             taobaoZsAdvertiserAdgroupDayEntry.setUv(contentArray[(i + 1) * 25 + 12]);
                             taobaoZsAdvertiserAdgroupDayEntry.setDeep_inshop_uv(contentArray[(i + 1) * 25 + 13]);
                             taobaoZsAdvertiserAdgroupDayEntry.setAvg_access_time(contentArray[(i + 1) * 25 + 14]);
                             taobaoZsAdvertiserAdgroupDayEntry.setAvg_access_page_num(contentArray[(i + 1) * 25 + 15]);
                             taobaoZsAdvertiserAdgroupDayEntry.setInshop_item_col_num(contentArray[(i + 1) * 25 + 16]);
                             taobaoZsAdvertiserAdgroupDayEntry.setDir_shop_col_num(contentArray[(i + 1) * 25 + 17]);
                             taobaoZsAdvertiserAdgroupDayEntry.setCart_num(contentArray[(i + 1) * 25 + 18]);
                             taobaoZsAdvertiserAdgroupDayEntry.setGmv_inshop_num(contentArray[(i + 1) * 25+ 19]);
                             taobaoZsAdvertiserAdgroupDayEntry.setGmv_inshop_amt(contentArray[(i + 1) * 25 + 20]);
                             taobaoZsAdvertiserAdgroupDayEntry.setAlipay_in_shop_num(contentArray[(i + 1) * 25 + 21]);
                             taobaoZsAdvertiserAdgroupDayEntry.setAlipay_inshop_amt(contentArray[(i + 1) * 25 + 22]);
                             taobaoZsAdvertiserAdgroupDayEntry.setCvr(contentArray[(i + 1) * 25 + 23]);
                             taobaoZsAdvertiserAdgroupDayEntry.setRoi(contentArray[(i + 1) * 25 + 24]);
                             if (effectType.equals("click")) {
                             	taobaoZsAdvertiserAdgroupDayEntry.setEffect(7l);
                             } else {
                             	taobaoZsAdvertiserAdgroupDayEntry.setEffect(15l);
                             }
                             taobaoZsAdvertiserAdgroupDayEntry.setTaobao_user_id(userId);
                             taobaoZsAdvertiserAdgroupDayEntry.setEffect_type(effectType);
                             taobaoZsAdvertiserAdgroupDayEntry.setCampaign_model(campModel);
                             taobaoZsAdvertiserAdgroupDayEntry.setLast_update_time(new Date());
                             taobaoZsAdvertiserAdgroupDayEntryList.add(taobaoZsAdvertiserAdgroupDayEntry);
                         }
                         taobaoZsAdvertiserAdgroupDayEntryDao.insertOrUpdateTaobaoZsAdvertiserAdgroupDayEntryList(taobaoZsAdvertiserAdgroupDayEntryList);
                         
                     }  else if (task.getHierarchy().equals("adzone")) {
                     	
                     	List<TaobaoZsAdvertiserAdzoneDayEntry> taobaoZsAdvertiserAdzoneDayEntryList = new ArrayList<TaobaoZsAdvertiserAdzoneDayEntry>();
                     	
                         for(int i = 0 ;i <= len/27 -2 ;i++) {
                             TaobaoZsAdvertiserAdzoneDayEntry taobaoZsAdvertiserAdzoneDayEntry = new TaobaoZsAdvertiserAdzoneDayEntry();
                             taobaoZsAdvertiserAdzoneDayEntry.setCampaign_name(contentArray[(i + 1) * 27 + 1]);
                             taobaoZsAdvertiserAdzoneDayEntry.setCampaign_id(contentArray[(i + 1) * 27 + 2]);
                             taobaoZsAdvertiserAdzoneDayEntry.setAdgroup_name(contentArray[(i + 1) * 27 + 3]);
                             taobaoZsAdvertiserAdzoneDayEntry.setAdgroup_id(contentArray[(i + 1) * 27+ 4]);
                             taobaoZsAdvertiserAdzoneDayEntry.setAdzone_name(contentArray[(i + 1) * 27 + 5]);
                             taobaoZsAdvertiserAdzoneDayEntry.setAdzone_id(contentArray[(i + 1) * 27 + 6]);
                             taobaoZsAdvertiserAdzoneDayEntry.setLog_date(contentArray[(i + 1) * 27 + 7]);
                             taobaoZsAdvertiserAdzoneDayEntry.setAd_pv(contentArray[(i + 1) * 27 + 8]);
                             taobaoZsAdvertiserAdzoneDayEntry.setClick(contentArray[(i + 1) * 27 + 9]);
                             taobaoZsAdvertiserAdzoneDayEntry.setCharge(contentArray[(i + 1) * 27 + 10]);
                             taobaoZsAdvertiserAdzoneDayEntry.setCtr(contentArray[(i + 1) * 27 + 11]);
                             taobaoZsAdvertiserAdzoneDayEntry.setEcpc(contentArray[(i + 1) * 27 + 12]);
                             taobaoZsAdvertiserAdzoneDayEntry.setEcpm(contentArray[(i + 1) * 27 +13]);
                             taobaoZsAdvertiserAdzoneDayEntry.setUv(contentArray[(i + 1) * 27 + 14]);
                             taobaoZsAdvertiserAdzoneDayEntry.setDeep_inshop_uv(contentArray[(i + 1) * 27 + 15]);
                             taobaoZsAdvertiserAdzoneDayEntry.setAvg_access_time(contentArray[(i + 1) * 27 + 16]);
                             taobaoZsAdvertiserAdzoneDayEntry.setAvg_access_page_num(contentArray[(i + 1) * 27 + 17]);
                             taobaoZsAdvertiserAdzoneDayEntry.setInshop_item_col_num(contentArray[(i + 1) * 27 + 18]);
                             taobaoZsAdvertiserAdzoneDayEntry.setDir_shop_col_num(contentArray[(i + 1) * 27 + 19]);
                             taobaoZsAdvertiserAdzoneDayEntry.setCart_num(contentArray[(i + 1) * 27 + 20]);
                             taobaoZsAdvertiserAdzoneDayEntry.setGmv_inshop_num(contentArray[(i + 1) * 27 + 21]);
                             taobaoZsAdvertiserAdzoneDayEntry.setGmv_inshop_amt(contentArray[(i + 1) * 27 + 22]);
                             taobaoZsAdvertiserAdzoneDayEntry.setAlipay_in_shop_num(contentArray[(i + 1) * 27 + 23]);
                             taobaoZsAdvertiserAdzoneDayEntry.setAlipay_inshop_amt(contentArray[(i + 1) * 27 + 24]);
                             taobaoZsAdvertiserAdzoneDayEntry.setCvr(contentArray[(i + 1) * 27 + 25]);
                             taobaoZsAdvertiserAdzoneDayEntry.setRoi(contentArray[(i + 1) * 27 + 26]);
                             if (effectType.equals("click")) {
                             	taobaoZsAdvertiserAdzoneDayEntry.setEffect(7l);
                             } else {
                             	taobaoZsAdvertiserAdzoneDayEntry.setEffect(15l);
                             }
                             taobaoZsAdvertiserAdzoneDayEntry.setTaobao_user_id(userId);
                             taobaoZsAdvertiserAdzoneDayEntry.setEffect_type(effectType);
                             taobaoZsAdvertiserAdzoneDayEntry.setCampaign_model(campModel);
                             taobaoZsAdvertiserAdzoneDayEntry.setLast_update_time(new Date());
                             taobaoZsAdvertiserAdzoneDayEntryList.add(taobaoZsAdvertiserAdzoneDayEntry);
                         }
                         
                         taobaoZsAdvertiserAdzoneDayEntryDao.insertOrUpdateTaobaoZsAdvertiserAdzoneDayEntryList(taobaoZsAdvertiserAdzoneDayEntryList);
                         
                     } else if (task.getHierarchy().equals("creative")) {
                     	
                     	List<TaobaoZsAdvertiserCreativeDayEntry> taobaoZsAdvertiserCreativeDayEntryList = new ArrayList<TaobaoZsAdvertiserCreativeDayEntry>();
                     	
                         for(int i = 0 ;i <= len/27 -2 ;i++) {
                             TaobaoZsAdvertiserCreativeDayEntry taobaoZsAdvertiserCreativeDayEntry = new TaobaoZsAdvertiserCreativeDayEntry();
                             taobaoZsAdvertiserCreativeDayEntry.setCampaign_name(contentArray[(i + 1) * 27 + 1]);
                             taobaoZsAdvertiserCreativeDayEntry.setCampaign_id(contentArray[(i + 1) * 27 + 2]);
                             taobaoZsAdvertiserCreativeDayEntry.setAdgroup_name(contentArray[(i + 1) * 27 + 3]);
                             taobaoZsAdvertiserCreativeDayEntry.setAdgroup_id(contentArray[(i + 1) * 27 + 4]);
                             taobaoZsAdvertiserCreativeDayEntry.setCreative_name(contentArray[(i + 1) * 27 + 5]);
                             taobaoZsAdvertiserCreativeDayEntry.setCreative_id(contentArray[(i + 1) * 27 + 6]);
                             taobaoZsAdvertiserCreativeDayEntry.setLog_date(contentArray[(i + 1) * 27 + 7]);
                             taobaoZsAdvertiserCreativeDayEntry.setAd_pv(contentArray[(i + 1) * 27 + 8]);
                             taobaoZsAdvertiserCreativeDayEntry.setClick(contentArray[(i + 1) * 27 + 9]);
                             taobaoZsAdvertiserCreativeDayEntry.setCharge(contentArray[(i + 1) * 27 + 10]);
                             taobaoZsAdvertiserCreativeDayEntry.setCtr(contentArray[(i + 1) * 27 + 11]);
                             taobaoZsAdvertiserCreativeDayEntry.setEcpc(contentArray[(i + 1) * 27 + 12]);
                             taobaoZsAdvertiserCreativeDayEntry.setEcpm(contentArray[(i + 1) * 27 +13]);
                             taobaoZsAdvertiserCreativeDayEntry.setUv(contentArray[(i + 1) * 27 + 14]);
                             taobaoZsAdvertiserCreativeDayEntry.setDeep_inshop_uv(contentArray[(i + 1) * 27 + 15]);
                             taobaoZsAdvertiserCreativeDayEntry.setAvg_access_time(contentArray[(i + 1) * 27+ 16]);
                             taobaoZsAdvertiserCreativeDayEntry.setAvg_access_page_num(contentArray[(i + 1) * 27 + 17]);
                             taobaoZsAdvertiserCreativeDayEntry.setInshop_item_col_num(contentArray[(i + 1) * 27 + 18]);
                             taobaoZsAdvertiserCreativeDayEntry.setDir_shop_col_num(contentArray[(i + 1) * 27 + 19]);
                             taobaoZsAdvertiserCreativeDayEntry.setCart_num(contentArray[(i + 1) * 27 + 20]);
                             taobaoZsAdvertiserCreativeDayEntry.setGmv_inshop_num(contentArray[(i + 1) * 27 + 21]);
                             taobaoZsAdvertiserCreativeDayEntry.setGmv_inshop_amt(contentArray[(i + 1) * 27 + 22]);
                             taobaoZsAdvertiserCreativeDayEntry.setAlipay_in_shop_num(contentArray[(i + 1) * 27 + 23]);
                             taobaoZsAdvertiserCreativeDayEntry.setAlipay_inshop_amt(contentArray[(i + 1) * 27 + 24]);
                             taobaoZsAdvertiserCreativeDayEntry.setCvr(contentArray[(i + 1) * 27 + 25]);
                             taobaoZsAdvertiserCreativeDayEntry.setRoi(contentArray[(i + 1) * 27 + 26]);
                             if (effectType.equals("click")) {
                             	taobaoZsAdvertiserCreativeDayEntry.setEffect(7l);
                             } else {
                             	taobaoZsAdvertiserCreativeDayEntry.setEffect(15l);
                             }
                             taobaoZsAdvertiserCreativeDayEntry.setTaobao_user_id(userId);
                             taobaoZsAdvertiserCreativeDayEntry.setEffect_type(effectType);
                             taobaoZsAdvertiserCreativeDayEntry.setCampaign_model(campModel);
                             taobaoZsAdvertiserCreativeDayEntry.setLast_update_time(new Date());
                             taobaoZsAdvertiserCreativeDayEntryList.add(taobaoZsAdvertiserCreativeDayEntry);
                         }
                         taobaoZsAdvertiserCreativeDayEntryDao.insertOrUpdateTaobaoZsAdvertiserCreativeDayEntryList(taobaoZsAdvertiserCreativeDayEntryList);
                     }
                
                }
               
            }
        }catch(Exception e){
            LogUtils.logException(e);
        }
    }

}
