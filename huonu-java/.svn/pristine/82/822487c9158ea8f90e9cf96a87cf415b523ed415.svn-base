package com.huonu.service.impl;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import org.json.JSONArray;
import org.json.JSONObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.google.gson.Gson;
import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserAdzoneRtrptsTotalEntryDao;
import com.huonu.domain.dao.TaobaoZsAdzoneEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserAdzoneRtrptsTotalEntry;
import com.huonu.domain.model.TaobaoZsAdzoneEntry;
import com.huonu.service.ApiCallService;
import com.huonu.service.ZoneService;
import com.huonu.utils.date.DateUtils;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.request.ZuanshiAdvertiserAdzoneRtrptsTotalGetRequest;
import com.taobao.api.request.ZuanshiBannerAdzoneFindpageRequest;
import com.taobao.api.response.ZuanshiAdvertiserAdzoneRtrptsTotalGetResponse;
import com.taobao.api.response.ZuanshiBannerAdzoneFindpageResponse;

@Service
public class ZoneServiceImpl implements ZoneService{
	
	@Autowired
	private ApiCallService apiCallService;
	
	@Autowired 
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	@Autowired
	private TaobaoZsAdzoneEntryDao taobaoZsAdzoneEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserAdzoneRtrptsTotalEntryDao taobaoZsAdvertiserAdzoneRtrptsTotalEntryDao;
	
	//资源位置同步
	public void sync_zone(String call_people,String user_id , String sessionkey) {
		LogUtils.logInfo("**************资源位同步    【 用户id:["+user_id+"]  *************");
		List<TaobaoZsAdzoneEntry> taobaoZsAdzoneEntryList = new ArrayList<TaobaoZsAdzoneEntry>();
		ZuanshiBannerAdzoneFindpageRequest req = new ZuanshiBannerAdzoneFindpageRequest();
		Gson gson = new Gson();
		Long pageNum = 0L;
		req.setPageSize(1L);
		ZuanshiBannerAdzoneFindpageResponse rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.banner.adzone.findpage");
		
		if(rsp!=null){
			JSONObject obj0 = new JSONObject(rsp.getBody());
			if(obj0.has("zuanshi_banner_adzone_findpage_response")){
				Long totalNum = obj0.getJSONObject("zuanshi_banner_adzone_findpage_response").getJSONObject("result").getLong("total_count");
				if (totalNum <=50){
			        pageNum = 1L;
			    }else{
			        pageNum = totalNum/50+1;
			    }
				
				req.setPageSize(50L);
				for (int i = 0; i < pageNum; i++) {
					req.setPageNum(i+1L);
					rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.banner.adzone.findpage");
					if(rsp!=null){
						JSONObject obj1 = new JSONObject(rsp.getBody());
						if(obj1.has("zuanshi_banner_adzone_findpage_response")){
							
							JSONArray obj5 = obj1.getJSONObject("zuanshi_banner_adzone_findpage_response").getJSONObject("result").getJSONObject("adzones").getJSONArray("adzone_d_t_o");
				            for (int j = 0; j < obj5.length(); j++) {
				                JSONObject jsonObject = obj5.getJSONObject(j);
				                long allow_adv_type = jsonObject.getLong("allow_adv_type");
				                long adzone_id = jsonObject.getLong("adzone_id");
				                long adzone_level = jsonObject.getLong("adzone_level");
				                String adzone_name = jsonObject.getString("adzone_name");
				                long media_type = jsonObject.getLong("media_type");
				                List adzone_size_list =jsonObject.getJSONObject("adzone_size_list").getJSONArray("string").toList();
				                for(int k=0;k<adzone_size_list.size();k++){
				                    String adzone_size_list0="["+adzone_size_list.get(k)+"]";
				                    String allow_ad_format_list= jsonObject.getJSONObject("allow_ad_format_list").getJSONArray("number").toString();
				                    TaobaoZsAdzoneEntry taobaoZsAdzoneEntry = new TaobaoZsAdzoneEntry();
				                    taobaoZsAdzoneEntry.setAdzone_id(adzone_id);
				                    taobaoZsAdzoneEntry.setAdzone_level(adzone_level);
				                    taobaoZsAdzoneEntry.setAdzone_name(adzone_name);
				                    taobaoZsAdzoneEntry.setAdzone_size_list(adzone_size_list0);
				                    taobaoZsAdzoneEntry.setAllow_ad_format_list(allow_ad_format_list);
				                    taobaoZsAdzoneEntry.setAllow_adv_type(allow_adv_type);
				                    taobaoZsAdzoneEntry.setMedia_type(media_type);
				                    taobaoZsAdzoneEntry.setLast_update_time(new Date());
				                    taobaoZsAdzoneEntry.setTaobao_user_id(user_id);
				                    taobaoZsAdzoneEntryList.add(taobaoZsAdzoneEntry);
				                }
				            }
							
						}else{
							
						}
					}else{
						
					}
				}
			}else{
				
			}
			
		}else{
			
		}
		taobaoZsAdzoneEntryDao.insertOrUpdateTaobaoZsAdZoneEntrylist(taobaoZsAdzoneEntryList);
	    LogUtils.logInfo("**************资源位同步结束    总记录条数为"+taobaoZsAdzoneEntryList.size()+"*************");
	}
	
	
	
	public void sync_ZsAdvertiserAdzoneRtrptsTotal(String call_people,String user_id,Long campaignId,Long adgroupId,Long adzoneId,String sessionkey){
		
		LogUtils.logInfo("**************同步指定用户资源位分时当日汇总数据开始   【调用人:["+call_people+"] 用户id:["+user_id+"] 计划id:["+campaignId+"] 密钥:["+sessionkey+"]】*************");
		List<TaobaoZsAdvertiserAdzoneRtrptsTotalEntry> taobaoZsAdvertiserAdzoneRtrptsTotalEntryList = new ArrayList<TaobaoZsAdvertiserAdzoneRtrptsTotalEntry>();
		String today = DateUtils.dateToString(new Date(), "yyyy-MM-dd");
        List<Long> campaignModelList = new ArrayList<Long>();
        campaignModelList.add(1L);
        campaignModelList.add(4L);
        ZuanshiAdvertiserAdzoneRtrptsTotalGetRequest req = new ZuanshiAdvertiserAdzoneRtrptsTotalGetRequest();
        ZuanshiAdvertiserAdzoneRtrptsTotalGetResponse rsp = null;
        Gson gson = new Gson();
        req.setLogDate(today);
        req.setPageSize(200L);
        req.setCampaignId(campaignId);
        req.setAdgroupId(adgroupId);
        req.setAdzoneId(adzoneId);
        for (Long campaignModel : campaignModelList) {
        	req.setCampaignModel(campaignModel);
        	Boolean continue_flag = true;
        	int i=0;
        	while(continue_flag){
        		req.setOffset(200L*i);
        		rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.advertiser.adzone.rtrpts.total.get");
        		if(rsp!=null){
        			//LogUtils.logInfo("同步指定用户资源位分时当日汇总数据-ZuanshiAdvertiserAdzoneRtrptsTotalGetRequest请求返回数据 "+rsp.getBody());
        			JSONObject obj0 = new JSONObject(rsp.getBody());
        			if (obj0.has("zuanshi_advertiser_adzone_rtrpts_total_get_response")) {
        				JSONObject obj00 = obj0.getJSONObject("zuanshi_advertiser_adzone_rtrpts_total_get_response");
        	            if (obj00.has("adzone_realtime_rpt_total_list")) {
        	                JSONObject obj = obj00.getJSONObject("adzone_realtime_rpt_total_list");
        	                if (obj.has("data")) {
        	                	JSONArray obj4 = obj.getJSONArray("data");
        	                	int listNum=obj4.length();
        	                	if(listNum<200){
        	                		continue_flag=false;
        	                	}
        	                	for (int k = 0; k < obj4.length(); k++) {
        	                		TaobaoZsAdvertiserAdzoneRtrptsTotalEntry taobaoZsAdvertiserAdzoneRtrptsTotalEntry = new TaobaoZsAdvertiserAdzoneRtrptsTotalEntry();
        	                        JSONObject jsonObject = obj4.getJSONObject(k);
        	                        //获取json中的字段
        	                        if(jsonObject.has("ad_pv")){
        	                            String ad_pv = jsonObject.getString("ad_pv");
        	                            taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setAd_pv(ad_pv);
        	                        }
        	                        if(jsonObject.has("ecpm")){
        	                            String ecpm = jsonObject.getString("ecpm");
        	                            taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setEcpm(ecpm);
        	                        }
        	                        if(jsonObject.has("ctr")){
        	                            String ctr = jsonObject.getString("ctr");
        	                            taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setCtr(ctr);
        	                        }
        	                        if(jsonObject.has("ecpc")){
        	                            String ecpc = jsonObject.getString("ecpc");
        	                            taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setEcpc(ecpc);
        	                        }
        	                        String charge = jsonObject.getString("charge");
        	                        String log_date = jsonObject.getString("log_date");
        	                        String click = jsonObject.getString("click");
        	                        String campaign_name = jsonObject.getString("campaign_name");
        	                        String campaign_id = jsonObject.getString("campaign_id");
        	                        String adgroup_name = jsonObject.getString("adgroup_name");
        	                        String adgroup_id = jsonObject.getString("adgroup_id");
        	                        String adzone_id= jsonObject.getString("adzone_id");
        	                        String adzone_name= jsonObject.getString("adzone_name");
        	                        //存储上述字段到pojo对象中
        	                        taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setCharge(charge);
        	                        taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setLog_date(log_date.substring(0, 10));
        	                        taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setClick(click);
        	                        taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setCampaign_name(campaign_name);
        	                        taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setTaobao_user_id(user_id);
        	                        taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setCampaign_id(campaign_id);
        	                        taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setLast_update_time(new Date());
        	                        taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setAdgroup_id(adgroup_id);
        	                        taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setAdgroup_name(adgroup_name);
        	                        taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setAdzone_id(adzone_id);
        	                        taobaoZsAdvertiserAdzoneRtrptsTotalEntry.setAdzone_name(adzone_name);
        	                        taobaoZsAdvertiserAdzoneRtrptsTotalEntryList.add(taobaoZsAdvertiserAdzoneRtrptsTotalEntry);
        	                	}
        	                }else{
        	                	LogUtils.logInfo("返回异常数据(不存在data):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
        	                	continue_flag=false;
        	                }
        				}else{
        					LogUtils.logInfo("返回异常数据(不存在adzone_realtime_rpt_total_list):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
        					continue_flag=false;
        				}
        			}else{
        				LogUtils.logInfo("返回异常数据(不存在zuanshi_advertiser_adzone_rtrpts_total_get_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
        				continue_flag=false;
        			}
        		}else{
        			LogUtils.logInfo("taobao.zuanshi.advertiser.adzone.rtrpts.total.get返回数据为null"+"******"+"请求参数为:"+gson.toJson(req));
        			continue_flag=false;
        		}
        		i++;
        	}
        }
        taobaoZsAdvertiserAdzoneRtrptsTotalEntryDao.insertOrUpdateTaobaoZsAdvertiserAdzoneRtrptsTotalEntryList(taobaoZsAdvertiserAdzoneRtrptsTotalEntryList);
        LogUtils.logInfo("**************同步指定用户资源位分时当日汇总数据结束   总记录条数为"+taobaoZsAdvertiserAdzoneRtrptsTotalEntryList.size()+"*************");
	}
	
	
	
	
	//获取全店广告位查询条件
	/*public void sync_condition(String call_people,String user_id , String sessionkey) {
		LogUtils.logInfo("**************获取全店广告位查询条件开始    【 用户id:["+user_id+"]  *************");
		List<TaobaoZsAdzoneCondition> taobaoZsAdzoneConditionList = new ArrayList<TaobaoZsAdzoneCondition>();
		ZuanshiBannerAdzoneConditionRequest req = new ZuanshiBannerAdzoneConditionRequest();
		ZuanshiBannerAdzoneConditionResponse rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.banner.adzone.condition");
		if(rsp!=null){
			
			JSONObject obj1 = new JSONObject(rsp.getBody());
			if(obj1.has("zuanshi_banner_adzone_condition_response")){
				Boolean flag = obj1.getJSONObject("zuanshi_banner_adzone_condition_response").getBoolean("success");
				if(flag==true){
					
				}else{
					
				}
			}else{
				
			}
		}else{
			
		}
		LogUtils.logInfo("**************获取全店广告位查询条件结束    总记录条数为"+taobaoZsAdzoneConditionList.size()+"*************");
	}*/

	
	
}
