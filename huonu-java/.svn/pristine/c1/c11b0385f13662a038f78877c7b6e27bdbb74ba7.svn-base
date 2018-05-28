package com.huonu.service.impl;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import org.json.JSONArray;
import org.json.JSONObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.google.gson.Gson;
import com.huonu.domain.dao.ApiLogDao;
import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.dao.TaobaoZsCatEntryDao;
import com.huonu.domain.dao.TaobaoZsDmpEntryDao;
import com.huonu.domain.dao.TaobaoZxhtDmpSyncInfoDao;
import com.huonu.domain.model.ApiLog;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZsCatEntry;
import com.huonu.domain.model.TaobaoZsDmpEntry;
import com.huonu.domain.model.TaobaoZxhtDmpSyncInfo;
import com.huonu.service.HandleTargetUpdateService;
import com.huonu.utils.date.DateUtils;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.ApiException;
import com.taobao.api.TaobaoClient;
import com.taobao.api.request.ZuanshiBannerCatFindRequest;
import com.taobao.api.request.ZuanshiBannerDmpFindRequest;
import com.taobao.api.response.ZuanshiBannerCatFindResponse;
import com.taobao.api.response.ZuanshiBannerDmpFindResponse;

@Service("handleTargetUpdateService")
public class HandleTargetUpdateServiceImpl implements HandleTargetUpdateService{

	@Autowired
	TaobaoZxhtDmpSyncInfoDao taobaoZxhtDmpSyncInfo;
	
	@Autowired
	private TaobaoClient taobaoClient;
	
	@Autowired
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	@Autowired
	private TaobaoZsDmpEntryDao taobaoZsDmpEntryDao;
	
	@Autowired
	private TaobaoZsCatEntryDao taobaoZsCatEntryDao;
	
	@Autowired
	private ApiLogDao apiLogDao;
	
	public void invoke(String call_people,String userid) {
		
		//获取原来的用户信息
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(userid);
		String sessionkey = taobaoAuthorizeUser.getAccess_token();
		
		//更新dmp同步状态
		TaobaoZxhtDmpSyncInfo dmpSyncInfo = new TaobaoZxhtDmpSyncInfo();
		dmpSyncInfo.setTaobao_user_id(userid);
        dmpSyncInfo.setLast_update_time(new Date());
        dmpSyncInfo.setRun_status(2L);
        dmpSyncInfo.setLog_date(DateUtils.dateToString(new Date(), "yyyy-MM-dd"));
        taobaoZxhtDmpSyncInfo.updateDmpRunStatus(dmpSyncInfo);
        
        sync_ZsDmp(call_people,userid,sessionkey);
        
        sync_ZsCat(call_people,userid,sessionkey);
        
        //更新dmp定向信息同步表中同步状态为运行成功
        dmpSyncInfo.setLast_update_time(new Date());
        dmpSyncInfo.setRun_status(4L);
        dmpSyncInfo.setLog_date(DateUtils.dateToString(new Date(), "yyyy-MM-dd"));;
        taobaoZxhtDmpSyncInfo.updateDmpRunStatus(dmpSyncInfo);
	}

	
	//同步用户dmp定向信息
	public void sync_ZsDmp(String call_people,String userid, String sessionkey) {
		
		LogUtils.logInfo("**************同步用户dmp定向信息开始    【调用人:["+call_people+"]  密钥:["+sessionkey+"]】*************");
		List<TaobaoZsDmpEntry> taobaoZsDmpEntryList =new ArrayList<TaobaoZsDmpEntry>();
		ZuanshiBannerDmpFindRequest req = new ZuanshiBannerDmpFindRequest();
		ZuanshiBannerDmpFindResponse rsp = null;
		Gson gson = new Gson();
		//LogUtils.logInfo("同步用户dmp定向信息-taobao.zuanshi.banner.dmp.find(获取DMP定向可用人群列表)请求参数: "+gson.toJson(req));
		try {
			rsp = taobaoClient.execute(req, sessionkey);
  		} catch (ApiException e) {
  			LogUtils.logException(e);
  		}
		
		ApiLog apiLog = new ApiLog();
		apiLog.setApi_name("taobao.zuanshi.banner.dmp.find");
		apiLog.setCall_people(call_people);
		apiLog.setCreate_at(new Date());
		apiLogDao.insertApiLog(apiLog);
		
		if(rsp!=null && rsp.getBody()!=null){
			//LogUtils.logInfo("同步用户dmp定向信息-taobao.zuanshi.banner.dmp.find(获取DMP定向可用人群列表)请求返回数据: "+rsp.getBody());
			JSONObject obj1 = new JSONObject(rsp.getBody());
			if(obj1.has("zuanshi_banner_dmp_find_response")){
				JSONObject obj2 = obj1.getJSONObject("zuanshi_banner_dmp_find_response").getJSONObject("result").getJSONObject("crowds");
				if(obj2.has("dmp_crowd_d_t_o")){
					JSONArray obj3 = obj2.getJSONArray("dmp_crowd_d_t_o");
		            for (int j = 0; j < obj3.length(); j++) {
		            	JSONObject jsonObject = obj3.getJSONObject(j);
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
		                taobaoZsDmpEntry.setTaobao_user_id(userid);
		                taobaoZsDmpEntryList.add(taobaoZsDmpEntry);
		            }
				}
			}
		}
		taobaoZsDmpEntryDao.insertOrUpdateTaobaoZsDmpEntryList(taobaoZsDmpEntryList);
		LogUtils.logInfo("**************同步用户dmp定向信息结束    总记录条数为:"+taobaoZsDmpEntryList.size()+"*************");
	}
	
	
	//同步用户高级兴趣点类目信息
	public void sync_ZsCat(String call_people,String userid, String sessionkey) {
		
		LogUtils.logInfo("**************同步用户高级兴趣点类目信息开始    【调用人:["+call_people+"]  密钥:["+sessionkey+"]】*************");
		List<TaobaoZsCatEntry> taobaoZsCatEntryList = new ArrayList<TaobaoZsCatEntry>();
		List<Long> campaignType = new ArrayList<Long>();
        campaignType.add(2L);
        campaignType.add(8L);
        ZuanshiBannerCatFindRequest req = new ZuanshiBannerCatFindRequest();
    	ZuanshiBannerCatFindResponse rsp = null;
    	Gson gson = new Gson();
        for (Long campaigntype : campaignType) {
        	req.setCampaignType(campaigntype);
        	rsp = null;
        	//LogUtils.logInfo("同步用户高级兴趣点类目信息开始-taobao.zuanshi.banner.cat.find(高级兴趣点-类目查询)请求参数: "+gson.toJson(req));
        	try {
    			rsp = taobaoClient.execute(req, sessionkey);
      		} catch (ApiException e) {
      			LogUtils.logException(e);
      		}
        	
        	ApiLog apiLog = new ApiLog();
    		apiLog.setApi_name("taobao.zuanshi.banner.cat.find");
    		apiLog.setCall_people(call_people);
    		apiLog.setCreate_at(new Date());
    		apiLogDao.insertApiLog(apiLog);
    		
    		if(rsp!=null && rsp.getBody()!=null){
    			//LogUtils.logInfo("同步用户高级兴趣点类目信息开始-taobao.zuanshi.banner.cat.find(高级兴趣点-类目查询)请求返回数据: "+rsp.getBody());
    			JSONObject obj1 = new JSONObject(rsp.getBody());
    			JSONObject obj2 = obj1.getJSONObject("zuanshi_banner_cat_find_response");
    		    JSONObject obj3 = obj2.getJSONObject("result");
    		    JSONObject obj4 = obj3.getJSONObject("interests");
    		    JSONArray obj5 = obj4.getJSONArray("senior_interest_dto");
    		    for (int j = 0; j < obj5.length(); j++) {
    		    	JSONObject jsonObject = obj5.getJSONObject(j);
    	            Long cat_id = jsonObject.getLong("cat_id");
    	            String cat_name = jsonObject.getString("cat_name");
    	            String option_name = jsonObject.getString("option_name");
    	            String option_value = jsonObject.getString("option_value");
    	            TaobaoZsCatEntry taobaoZsCatEntry = new TaobaoZsCatEntry();
    	            taobaoZsCatEntry.setTaobao_user_id(userid);
    	            taobaoZsCatEntry.setCat_id(cat_id);
    	            taobaoZsCatEntry.setCampaign_type(campaigntype);
    	            taobaoZsCatEntry.setCat_name(cat_name);
    	            taobaoZsCatEntry.setOption_name(option_name);
    	            taobaoZsCatEntry.setOption_value(option_value);
    	            taobaoZsCatEntry.setLast_update_time(new Date());
    	            taobaoZsCatEntryList.add(taobaoZsCatEntry);
    		    }
    		}
        }
        taobaoZsCatEntryDao.insertOrUpdateTaobaoZsCatEntryList(taobaoZsCatEntryList);
        LogUtils.logInfo("**************同步用户高级兴趣点类目信息结束    总记录条数为:"+taobaoZsCatEntryList.size()+"*************");
	}

	
}
