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
import com.huonu.domain.dao.TaobaoZsAdgroupEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserTargetRtrptsTotalEntryDao;
import com.huonu.domain.dao.TaobaoZsCampEntryDao;
import com.huonu.domain.dao.TaobaoZsTargetEntryDao;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZsAdgroupEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetRtrptsTotalEntry;
import com.huonu.domain.model.TaobaoZsCampEntry;
import com.huonu.domain.model.TaobaoZsTargetEntry;
import com.huonu.service.ApiCallService;
import com.huonu.service.CampRtrptsTotalService;
import com.huonu.service.CampService;
import com.huonu.service.CreativeService;
import com.huonu.service.GroupService;
import com.huonu.service.ZoneService;
import com.huonu.utils.date.DateUtils;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.request.ZuanshiAdvertiserTargetRtrptsTotalGetRequest;
import com.taobao.api.request.ZuanshiBannerCrowdFindRequest;
import com.taobao.api.response.ZuanshiAdvertiserTargetRtrptsTotalGetResponse;
import com.taobao.api.response.ZuanshiBannerCrowdFindResponse;

@Service("campRtrptsTotalService")
public class CampRtrptsTotalServiceImpl implements CampRtrptsTotalService{
	
	@Autowired
	private ApiCallService apiCallService;
	
	@Autowired
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	@Autowired
	private TaobaoZsCampEntryDao taobaoZsCampEntryDao;
	
	@Autowired
	private TaobaoZsAdgroupEntryDao taobaoZsAdgroupEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserTargetRtrptsTotalEntryDao taobaoZsAdvertiserTargetRtrptsTotalEntryDao;
	
	@Autowired
	private TaobaoZsTargetEntryDao taobaoZsTargetEntryDao;
	
	@Autowired
	private CampService campService;
	
	@Autowired
	private GroupService groupService;
	
	@Autowired
	private ZoneService zoneService;
	
	@Autowired
	private CreativeService creativeService;
	
	
	public void sync_rtrptstotal(String call_people,String user_id) {
		
		//获取用户token
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		if(taobaoAuthorizeUser!=null &&  taobaoAuthorizeUser.getAccess_token()!=null){
			String sessionkey = taobaoAuthorizeUser.getAccess_token();
			//同步指定用户的所有计划分时当日汇总数据,若不指定具体计划，则为所有
			campService.sync_CampaignRtrptsTotal(call_people,user_id,null,sessionkey);
			
			//同步指定用户的计划列表数据
			campService.sync_camplist(call_people, user_id, null, sessionkey);
			
			//同步指定用户的所有计划下所有单元分时当日汇总数据
			groupService.sync_AdgroupRtrptsTotal(call_people,user_id,null,null,sessionkey);
			
			//获取用户下的所有计划
			List<TaobaoZsCampEntry> taobaoZsCampEntryList = taobaoZsCampEntryDao.getTaobaoZsCampEntryListByUserId(user_id);
			if(taobaoZsCampEntryList!=null && taobaoZsCampEntryList.size()>0){
				for(TaobaoZsCampEntry taobaoZsCampEntry:taobaoZsCampEntryList){
					//同步指定用户的所有计划下所有单元列表数据
					groupService.sync_group(call_people, user_id, taobaoZsCampEntry.getId(), null, sessionkey);
				}
			}
			//同步指定用户的所有计划单元下的定向分时当日汇总数据
			sync_ZsAdvertiserTargetRtrptsTotal(call_people, user_id, null,null,null,sessionkey);
			
			//同步指定用户的所有定向列表,必传参数(计划id，单元id)
			List<TaobaoZsAdgroupEntry> taobaoZsAdgroupEntryList = taobaoZsAdgroupEntryDao.getTaobaoZsAdgroupEntryByUserId(user_id);
			for(TaobaoZsAdgroupEntry taobaoZsAdgroupEntry:taobaoZsAdgroupEntryList){
				sync_ZsTargetEntry(call_people, user_id,taobaoZsAdgroupEntry.getCampaign_id(),taobaoZsAdgroupEntry.getAdgroup_id(),sessionkey);
			}
			
			//同步指定用户的所有计划单元下的资源位分时当日汇总数据
			zoneService.sync_ZsAdvertiserAdzoneRtrptsTotal(call_people,user_id,null, null,null,sessionkey);
			
			//同步指定用户的所有计划单元下创意分时当日汇总数据
			creativeService.sync_ZsAdvertiserCreativeRtrptsTotal(call_people,user_id, null, null,null,sessionkey);
			
		}
	}
	
	
	//同步指定用户的所有计划单元下的定向分时当日汇总数据   或者指定用户下的指定计划同步
	//@LogAnnotation(module=Constants.MODULE_SYNC ,description="同步定向分时当日汇总数据")
	public void sync_ZsAdvertiserTargetRtrptsTotal(String call_people,String user_id,Long campaignId,Long adgroupId,Long targetId,String sessionkey){
		LogUtils.logInfo("**************同步定向分时当日汇总数据开始    【调用人:["+call_people+"] 用户id:["+user_id+"] 计划id:["+campaignId+"] 密钥:["+sessionkey+"]】*************");
		List<TaobaoZsAdvertiserTargetRtrptsTotalEntry> taobaoZsAdvertiserTargetRtrptsTotalEntryList = new ArrayList<TaobaoZsAdvertiserTargetRtrptsTotalEntry>();
        String today = DateUtils.dateToString(new Date(), "yyyy-MM-dd");
        List<Long> campaignModelList = new ArrayList<Long>();
        campaignModelList.add(1L);
        campaignModelList.add(4L);
        ZuanshiAdvertiserTargetRtrptsTotalGetRequest req = new ZuanshiAdvertiserTargetRtrptsTotalGetRequest();
        ZuanshiAdvertiserTargetRtrptsTotalGetResponse rsp = null;
        Gson gson = new Gson();
        req.setLogDate(today);
        req.setPageSize(200L);
        req.setCampaignId(campaignId);
        req.setAdgroupId(adgroupId);
        req.setTargetId(targetId);
        for (Long campaignModel : campaignModelList) {
        	req.setCampaignModel(campaignModel);
        	Boolean continue_flag = true;
        	int i=0;
        	while(continue_flag){
        		req.setOffset(200L*i);
        		rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.advertiser.target.rtrpts.total.get");
        		
        		if(rsp!=null){
        			//LogUtils.logInfo("同步定向分时当日汇总数据-ZuanshiAdvertiserTargetRtrptsTotalGetResponse请求返回数据: "+rsp.getBody());
        			JSONObject obj0 = new JSONObject(rsp.getBody());
        			if (obj0.has("zuanshi_advertiser_target_rtrpts_total_get_response")) {
        				JSONObject obj00 = obj0.getJSONObject("zuanshi_advertiser_target_rtrpts_total_get_response");
        				if (obj00.has("target_realtime_rpt_total_list")) {
        					JSONObject obj = obj00.getJSONObject("target_realtime_rpt_total_list");
        	                if (obj.has("data")) {
        	                	JSONArray obj4 = obj.getJSONArray("data");
        	                	int listNum=obj4.length();
        	                	if(listNum<200){
        	                		continue_flag=false;
        	                	}
        	                	for (int k = 0; k < obj4.length(); k++) {
        	                		TaobaoZsAdvertiserTargetRtrptsTotalEntry taobaoZsAdvertiserTargetRtrptsTotalEntry = new TaobaoZsAdvertiserTargetRtrptsTotalEntry();
        	                        JSONObject jsonObject = obj4.getJSONObject(k);
        	                        //获取json中的字段
        	                        if(jsonObject.has("ad_pv")){
        	                            String ad_pv = jsonObject.getString("ad_pv");
        	                            taobaoZsAdvertiserTargetRtrptsTotalEntry.setAd_pv(ad_pv);
        	                        }
        	                        if(jsonObject.has("ecpm")){
        	                            String ecpm = jsonObject.getString("ecpm");
        	                            taobaoZsAdvertiserTargetRtrptsTotalEntry.setEcpm(ecpm);
        	                        }
        	                        if(jsonObject.has("ctr")){
        	                            String ctr = jsonObject.getString("ctr");
        	                            taobaoZsAdvertiserTargetRtrptsTotalEntry.setCtr(ctr);
        	                        }
        	                        if(jsonObject.has("ecpc")){
        	                            String ecpc = jsonObject.getString("ecpc");
        	                            taobaoZsAdvertiserTargetRtrptsTotalEntry.setEcpc(ecpc);
        	                        }
        	                        String charge = jsonObject.getString("charge");
        	                        String log_date = jsonObject.getString("log_date");
        	                        String click = jsonObject.getString("click");
        	                        String campaign_name = jsonObject.getString("campaign_name");
        	                        String campaign_id = jsonObject.getString("campaign_id");
        	                        String adgroup_name = jsonObject.getString("adgroup_name");
        	                        String adgroup_id = jsonObject.getString("adgroup_id");
        	                        String target_id= jsonObject.getString("target_id");
        	                        String target_name= jsonObject.getString("target_name");
        	                        //存储上述字段到pojo对象中
        	                        taobaoZsAdvertiserTargetRtrptsTotalEntry.setCharge(charge);
        	                        taobaoZsAdvertiserTargetRtrptsTotalEntry.setLog_date(log_date);
        	                        taobaoZsAdvertiserTargetRtrptsTotalEntry.setClick(click);
        	                        taobaoZsAdvertiserTargetRtrptsTotalEntry.setCampaign_name(campaign_name);
        	                        taobaoZsAdvertiserTargetRtrptsTotalEntry.setTaobao_user_id(user_id);
        	                        taobaoZsAdvertiserTargetRtrptsTotalEntry.setCampaign_id(campaign_id);
        	                        taobaoZsAdvertiserTargetRtrptsTotalEntry.setLast_update_time(new Date());
        	                        taobaoZsAdvertiserTargetRtrptsTotalEntry.setAdgroup_id(adgroup_id);
        	                        taobaoZsAdvertiserTargetRtrptsTotalEntry.setAdgroup_name(adgroup_name);
        	                        taobaoZsAdvertiserTargetRtrptsTotalEntry.setTarget_id(target_id);
        	                        taobaoZsAdvertiserTargetRtrptsTotalEntry.setTarget_name(target_name);
        	                        taobaoZsAdvertiserTargetRtrptsTotalEntryList.add(taobaoZsAdvertiserTargetRtrptsTotalEntry);
        	                	}
        	                }else{
        	                	LogUtils.logInfo("返回异常数据(不存在data):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
        	                	continue_flag=false;
        	                }
        				}else{
        					LogUtils.logInfo("返回异常数据(不存在target_realtime_rpt_total_list):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
        					continue_flag=false;
        				}
        			}else{
        				LogUtils.logInfo("返回异常数据(不存在zuanshi_advertiser_target_rtrpts_total_get_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
        				continue_flag=false;
        			}
        		}else{
        			LogUtils.logInfo("taobao.zuanshi.advertiser.target.rtrpts.total.get返回数据为null"+"******"+"请求参数为:"+gson.toJson(req));
        			continue_flag=false;
        		}
        		i++;
        	}
        }
        
        taobaoZsAdvertiserTargetRtrptsTotalEntryDao.insertOrUpdateTaobaoZsAdvertiserTargetRtrptsTotalEntryList(taobaoZsAdvertiserTargetRtrptsTotalEntryList);
        LogUtils.logInfo("**************同步定向分时当日汇总数据结束   总记录条数为 "+taobaoZsAdvertiserTargetRtrptsTotalEntryList.size()+"*************");
	}
	
	
	//同步用户某个单元下的所有定向
	//@LogAnnotation(module=Constants.MODULE_SYNC ,description="同步指定用户的所有计划单元下的定向列表")
	public void sync_ZsTargetEntry(String call_people,String user_id,Long campaign_id,Long adgroup_id,String sessionkey){
		
		LogUtils.logInfo("**************同步指定用户的所有计划单元下的定向列表开始    【调用人:["+call_people+"] 用户id:["+user_id+"] 密钥:["+sessionkey+"]】*************");
		List<TaobaoZsTargetEntry> taobaoZsTargetEntryList = new ArrayList<TaobaoZsTargetEntry>();
		ZuanshiBannerCrowdFindRequest req = new ZuanshiBannerCrowdFindRequest();
		ZuanshiBannerCrowdFindResponse rsp = null;
		Gson gson = new Gson();
		long pageNum = 0L;
		req.setCampaignId(campaign_id);
		req.setAdgroupId(adgroup_id);
		req.setPageSize(1L);
		rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.banner.crowd.find");
				
		if(rsp!=null){
			//LogUtils.logInfo("同步指定用户的所有计划单元下的定向列表-ZuanshiBannerCrowdFindResponse请求返回数据 "+rsp.getBody());
			JSONObject obj0 = new JSONObject(rsp.getBody());
			if(obj0.has("zuanshi_banner_crowd_find_response")){
				JSONObject obj = obj0.getJSONObject("zuanshi_banner_crowd_find_response").getJSONObject("result");
				if(obj.has("total_count")) {
					long totalNum = obj.getLong("total_count");
				    if (totalNum != 0) {
				         if (totalNum <= 200 & totalNum > 0) {
				              pageNum = 1L;
				         } else {
				              pageNum = totalNum / 200 + 1;
				         }
				         for (int i = 0; i < pageNum; i++) {
				            req.setPageSize(200L);
				            req.setPageNum((long)(i+1));
				            rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.banner.crowd.find");
				            		 
				            if(rsp!=null){
				            	//LogUtils.logInfo("同步指定用户的所有计划单元下的定向列表-ZuanshiBannerCrowdFindResponse请求返回数据 "+rsp.getBody());
				            	JSONObject obj1 = new JSONObject(rsp.getBody());
				            			 
				            	if(obj1.has("zuanshi_banner_crowd_find_response")){
									JSONObject obj4 = obj1.getJSONObject("zuanshi_banner_crowd_find_response").getJSONObject("result").getJSONObject("crowds");
									JSONArray obj5 = obj4.getJSONArray("crowd_d_t_o");
					                for (int j = 0; j < obj5.length(); j++) {
					                     JSONObject jsonObject = obj5.getJSONObject(j);
					                     Long adgroup_id1 = jsonObject.getLong("adgroup_id");
					                     Long campaign_id1 = jsonObject.getLong("campaign_id");
					                     String crowd_name = jsonObject.getString("crowd_name");
					                     Long crowd_type = jsonObject.getLong("crowd_type");
					                     String crowd_value = jsonObject.getString("crowd_value");
					                     String gmt_create = jsonObject.getString("gmt_create");
					                     String gmt_modified = jsonObject.getString("gmt_modified");
					                     Long id = jsonObject.getLong("id");
					                     JSONObject matrixprices_obj = jsonObject.getJSONObject("matrix_prices");
					                     JSONArray matrix_price_d_t_oList = matrixprices_obj.getJSONArray("matrix_price_d_t_o");
					                     String matrix_price_d_t_o = matrix_price_d_t_oList.toString();
					                     String sub_crowd_d_t_o = "";
							             if(jsonObject.has("sub_crowds")){
							                  JSONObject subcrowds_obj = jsonObject.getJSONObject("sub_crowds");
							                  JSONArray sub_crowd_d_t_oList = subcrowds_obj.getJSONArray("sub_crowd_d_t_o");
							                  sub_crowd_d_t_o = sub_crowd_d_t_oList.toString();
							             }
					                     TaobaoZsTargetEntry taobaoZsTargetEntry = new TaobaoZsTargetEntry();
					                     taobaoZsTargetEntry.setTaobao_user_id(user_id);
					                     taobaoZsTargetEntry.setAdgroup_id(adgroup_id1);
					                     taobaoZsTargetEntry.setCampaign_id(campaign_id1);
					                     taobaoZsTargetEntry.setCrowd_name(crowd_name);
					                     taobaoZsTargetEntry.setCrowd_type(crowd_type);
					                     taobaoZsTargetEntry.setCrowd_value(crowd_value);
					                     taobaoZsTargetEntry.setGmt_create(gmt_create);
					                     taobaoZsTargetEntry.setGmt_modified(gmt_modified);
					                     taobaoZsTargetEntry.setId(id);
					                     taobaoZsTargetEntry.setMatrix_price_d_t_o(matrix_price_d_t_o);
					                     taobaoZsTargetEntry.setSub_crowd_d_t_o(sub_crowd_d_t_o);
					                     taobaoZsTargetEntry.setLast_update_time(new Date());
					                     taobaoZsTargetEntryList.add(taobaoZsTargetEntry);
					                     }
				            		}else{
				            			LogUtils.logInfo("返回异常数据(不存在zuanshi_banner_crowd_find_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
				            		}
				            	}else{
				            		LogUtils.logInfo("taobao.zuanshi.banner.crowd.find返回数据为null"+"******"+"请求参数为:"+gson.toJson(req));
				            	}
				          	}
				      	}
					}else{
						LogUtils.logInfo("返回异常数据(不存在total_count):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
					}
				}else{
					LogUtils.logInfo("返回异常数据(不存在zuanshi_banner_crowd_find_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
				}
			}else{
				LogUtils.logInfo("taobao.zuanshi.banner.crowd.find返回数据为null"+"******"+"请求参数为:"+gson.toJson(req));
			}
		
		taobaoZsTargetEntryDao.insertOrUpdateTaobaoZsTargetEntrylist(taobaoZsTargetEntryList);
		LogUtils.logInfo("**************同步指定用户的所有计划单元下的定向列表结束    总记录条数为"+taobaoZsTargetEntryList.size()+"*************");
	}
	
}
