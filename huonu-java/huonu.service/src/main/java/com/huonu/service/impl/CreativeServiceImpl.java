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
import com.huonu.domain.dao.TaobaoZsAdvertiserCreativeRtrptsTotalEntryDao;
import com.huonu.domain.dao.TaobaoZsCreativeEntryDao;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZsAdvertiserCreativeRtrptsTotalEntry;
import com.huonu.domain.model.TaobaoZsCreativeEntry;
import com.huonu.domain.model.conidtion.CreativeCondition;
import com.huonu.service.ApiCallService;
import com.huonu.service.CreativeService;
import com.huonu.utils.date.DateUtils;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.FileItem;
import com.taobao.api.request.ZuanshiAdvertiserCreativeRtrptsTotalGetRequest;
import com.taobao.api.request.ZuanshiBannerCreativeBindRequest;
import com.taobao.api.request.ZuanshiBannerCreativeCreateRequest;
import com.taobao.api.request.ZuanshiBannerCreativeFindRequest;
import com.taobao.api.response.ZuanshiAdvertiserCreativeRtrptsTotalGetResponse;
import com.taobao.api.response.ZuanshiBannerCreativeBindResponse;
import com.taobao.api.response.ZuanshiBannerCreativeCreateResponse;
import com.taobao.api.response.ZuanshiBannerCreativeFindResponse;

@Service
public class CreativeServiceImpl implements CreativeService{
	
	@Autowired
	private ApiCallService apiCallService;
	
	@Autowired
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	@Autowired
	private TaobaoZsCreativeEntryDao taobaoZsCreativeEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserCreativeRtrptsTotalEntryDao taobaoZsAdvertiserCreativeRtrptsTotalEntryDao;
	
	/*
	 * 创意新建
	 */
	public String creative_add(String call_people, String user_id,CreativeCondition creativeCondition){
		String message = "";
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		if(taobaoAuthorizeUser!=null &&  taobaoAuthorizeUser.getAccess_token()!=null){
			ZuanshiBannerCreativeCreateRequest req = new ZuanshiBannerCreativeCreateRequest();
			Gson gson = new Gson();
			req.setName(creativeCondition.getName());
			req.setIsTransToWifi(creativeCondition.getIs_trans_to_wifi());
			req.setImage(new FileItem(creativeCondition.getImage()));
			req.setCatId(creativeCondition.getCat_id());
			req.setClickUrl(creativeCondition.getClick_url());
			ZuanshiBannerCreativeCreateResponse rsp = apiCallService.call(req, taobaoAuthorizeUser.getAccess_token(),call_people, "taobao.zuanshi.banner.creative.create");
			if(rsp!=null){
				JSONObject obj0 = new JSONObject(rsp.getBody());
				if (obj0.has("zuanshi_banner_creative_create_response")) {
					Boolean flag = obj0.getJSONObject("zuanshi_banner_creative_create_response").getJSONObject("result").getBoolean("success");
					if(flag==true){
						message = "成功";
						//同步创意列表?
					}else{
						message = obj0.getJSONObject("zuanshi_banner_creative_create_response").getJSONObject("result").getString("message");
					}
				}else{
					LogUtils.logInfo("返回异常数据(不存在zuanshi_banner_creative_create_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
					message = obj0.getJSONObject("error_response").getString("msg");
				}
			}else{
				LogUtils.logInfo("taobao.zuanshi.banner.creative.create返回为null******"+"请求参数为:"+gson.toJson(req));
				message = "返回结果为null";
			}
		}else{
			message = "用户token不存在";
		}
		return message;
	}
	
	
	/*
	 * 创意绑定
	 */
	public String creative_bind(String call_people, String user_id,CreativeCondition creativeCondition){
		
		String message = "";
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		if(taobaoAuthorizeUser!=null &&  taobaoAuthorizeUser.getAccess_token()!=null){
			ZuanshiBannerCreativeBindRequest req = new ZuanshiBannerCreativeBindRequest();
			Gson gson = new Gson();
			req.setCreativeIdList(creativeCondition.getCreativeIdList());
			req.setAdgroupId(creativeCondition.getAdgroupId());
			req.setCampaignId(creativeCondition.getCampaignId());
			ZuanshiBannerCreativeBindResponse rsp =apiCallService.call(req, taobaoAuthorizeUser.getAccess_token(), "test", "taobao.zuanshi.banner.creative.bind");
			if(rsp!=null){
				JSONObject obj0 = new JSONObject(rsp.getBody());
				if (obj0.has("zuanshi_banner_creative_bind_response")) {
					Boolean flag = obj0.getJSONObject("zuanshi_banner_creative_bind_response").getJSONObject("result").getBoolean("success");
					if(flag==true){
						message = "成功";
					}else{
						message = obj0.getJSONObject("zuanshi_banner_creative_bind_response").getJSONObject("result").getString("message");
					}
				}else{
					LogUtils.logInfo("返回异常数据(不存在zuanshi_banner_creative_bind_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
					message = obj0.getJSONObject("error_response").getString("msg");
				}
			}else{
				LogUtils.logInfo("taobao.zuanshi.banner.creative.bind返回为null******"+"请求参数为:"+gson.toJson(req));
				message = "返回结果为null";
			}
		}else{
			message = "用户token不存在";
		}
		return message;
	}
	
	
	//同步创意列表
	public void sync_creative(String call_people,String userid, Long campaign_id,Long adgroup_id,String sessionkey) {
		LogUtils.logInfo("**************同步创意开始    【调用人:["+call_people+"] 淘宝用户id:["+userid+"] 密钥:["+sessionkey+"]】*************");
		List<TaobaoZsCreativeEntry> taobaoZsCreativeEntryList = new ArrayList<TaobaoZsCreativeEntry>();
		ZuanshiBannerCreativeFindRequest req = new ZuanshiBannerCreativeFindRequest();
		Gson gson = new Gson();
		req.setPageSize(1L);
		req.setCampaignId(campaign_id);
		req.setAdgroupId(adgroup_id);
		ZuanshiBannerCreativeFindResponse rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.banner.creative.find");
		if(rsp!=null){
			JSONObject obj0 = new JSONObject(rsp.getBody());
			if(obj0.has("zuanshi_banner_creative_find_response")){
				JSONObject obj = obj0.getJSONObject("zuanshi_banner_creative_find_response").getJSONObject("result");
			    long totalNum = obj.getLong("total_count");
			    long pageNum;
			    if (totalNum < 200){
			        pageNum = 1L;
			     }else{
			        pageNum = totalNum/200+1;
			     }
			     for (int i = 0; i < pageNum; i++) {
			    	req.setPageSize(200L);
			        req.setPageNum((long)(i+1));
			        rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.banner.creative.find");
			        if(rsp!=null){
				        JSONObject obj1 = new JSONObject(rsp.getBody());
				        JSONObject obj2 = obj1.getJSONObject("zuanshi_banner_creative_find_response");
				        JSONObject obj3 = obj2.getJSONObject("result");
				        JSONObject obj4 = obj3.getJSONObject("creatives");
				        JSONArray obj5 = obj4.getJSONArray("creative");
				        for (int j = 0; j < obj5.length(); j++) {
				        	JSONObject jsonObject = obj5.getJSONObject(j);
				            String creative_id = Long.toString(jsonObject.getLong("id"));
				            String creative_name = jsonObject.getString("name");
				            Long audit_status = jsonObject.getLong("audit_status");
				            String audit_time = jsonObject.getString("audit_time");
				            Long cat_id = jsonObject.getLong("cat_id");
				            String cat_name = jsonObject.getString("cat_name");
				            String click_url = "0";
				            if(jsonObject.has("click_url")){
				               click_url = jsonObject.getString("click_url");
				            }
				            String create_time = jsonObject.getString("create_time");
				            String modified_time = jsonObject.getString("modified_time");
				            String expire_time= "0";
				            if(jsonObject.has("expire_time")){
				                expire_time = jsonObject.getString("expire_time");
				            }
				            Long creative_level = jsonObject.getLong("creative_level");
				            Long height = jsonObject.getJSONObject("creative_size").getLong("height");
				            Long width = jsonObject.getJSONObject("creative_size").getLong("width");
				            String creative_size = width.toString()+','+height.toString();
				            Long format = jsonObject.getLong("format");
				            String image_path = "0";
				            if(jsonObject.has("image_path")){
				                image_path = jsonObject.getString("image_path");
				            }
				            Long package_type = jsonObject.getLong("package_type");
				            Long online_status = jsonObject.getLong("online_status");
				            Long multi_material = jsonObject.getLong("multi_material");
				            TaobaoZsCreativeEntry taobaoZsCreativeEntry = new TaobaoZsCreativeEntry();
				            taobaoZsCreativeEntry.setTaobao_user_id(userid);
				            taobaoZsCreativeEntry.setCreative_id(creative_id);
				            taobaoZsCreativeEntry.setCreative_name(creative_name);
				            taobaoZsCreativeEntry.setAudit_status(audit_status);
				            taobaoZsCreativeEntry.setAudit_time(audit_time);
				            taobaoZsCreativeEntry.setCat_id(cat_id);
				            taobaoZsCreativeEntry.setCat_name(cat_name);
				            taobaoZsCreativeEntry.setClick_url(click_url);
				            taobaoZsCreativeEntry.setCreate_time(create_time);
				            taobaoZsCreativeEntry.setModified_time(modified_time);
				            taobaoZsCreativeEntry.setExprie_time(expire_time);
				            taobaoZsCreativeEntry.setCreative_level(creative_level);
				            taobaoZsCreativeEntry.setCreative_size(creative_size);
				            taobaoZsCreativeEntry.setFormat(format);
				            taobaoZsCreativeEntry.setImage_path(image_path);
				            taobaoZsCreativeEntry.setPackage_type(package_type);
				            taobaoZsCreativeEntry.setOnline_status(online_status);
				            taobaoZsCreativeEntry.setMulti_materials(multi_material);
				            taobaoZsCreativeEntry.setLast_update_time(new Date());
				            taobaoZsCreativeEntryList.add(taobaoZsCreativeEntry);
				        }
			        }else{
			        	LogUtils.logInfo("taobao.zuanshi.banner.creative.find返回为null******"+"请求参数为:"+gson.toJson(req));
			        }
			    }
			}else{
				LogUtils.logInfo("返回异常数据(不存在zuanshi_banner_creative_find_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
			}
		}else{
			LogUtils.logInfo("taobao.zuanshi.banner.creative.find返回为null******"+"请求参数为:"+gson.toJson(req));
		}
		taobaoZsCreativeEntryDao.insertOrUpdateTaobaoZsCreativeEntryList(taobaoZsCreativeEntryList);
		LogUtils.logInfo("**************同步创意开始    总记录条数为:"+taobaoZsCreativeEntryList.size()+"*************");
	}	
	
	
	
	public void sync_ZsAdvertiserCreativeRtrptsTotal(String call_people,String user_id,Long campaignId,Long adgroupId,Long creativeId,String sessionkey){
		
		LogUtils.logInfo("**************同步指定用户创意分时当日汇总数据开始   【调用人:["+call_people+"] 用户id:["+user_id+"] 计划id:["+campaignId+"] 密钥:["+sessionkey+"]】*************");
		List<TaobaoZsAdvertiserCreativeRtrptsTotalEntry> taobaoZsAdvertiserCreativeRtrptsTotalEntryList = new ArrayList<TaobaoZsAdvertiserCreativeRtrptsTotalEntry>();
		String today = DateUtils.dateToString(new Date(), "yyyy-MM-dd");
	    List<Long> campaignModelList = new ArrayList<Long>();
	    campaignModelList.add(1L);
	    campaignModelList.add(4L);
	    ZuanshiAdvertiserCreativeRtrptsTotalGetRequest req = new ZuanshiAdvertiserCreativeRtrptsTotalGetRequest();
    	ZuanshiAdvertiserCreativeRtrptsTotalGetResponse rsp = null;
    	Gson gson = new Gson();
	    req.setLogDate(today);
        req.setPageSize(200L);
        req.setCampaignId(campaignId);
        req.setAdgroupId(adgroupId);
        req.setCreativeId(creativeId);
	    for (Long campaignModel : campaignModelList) {
        	req.setCampaignModel(campaignModel);
        	Boolean continue_flag = true;
        	int i=0;
        	while(continue_flag){
        		req.setOffset(200L*i);
        		rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.advertiser.creative.rtrpts.total.get");
        		if(rsp!=null){
        			//LogUtils.logInfo("同步指定用户创意分时当日汇总数据-ZuanshiAdvertiserCreativeRtrptsTotalGetResponse请求返回数据 "+rsp.getBody());
        			JSONObject obj0 = new JSONObject(rsp.getBody());
        			if (obj0.has("zuanshi_advertiser_creative_rtrpts_total_get_response")) {
        	            JSONObject obj00 = obj0.getJSONObject("zuanshi_advertiser_creative_rtrpts_total_get_response");
        	            if (obj00.has("creative_realtime_rpt_total_list")) {
        	                JSONObject obj = obj00.getJSONObject("creative_realtime_rpt_total_list");
        	                if (obj.has("data")) {
        	                	JSONArray obj4 = obj.getJSONArray("data");
        	                	int listNum=obj4.length();
        	                	if(listNum<200){
        	                		continue_flag=false;
        	                	}
        	                	for (int k = 0; k < obj4.length(); k++) {
        	                		TaobaoZsAdvertiserCreativeRtrptsTotalEntry taobaoZsAdvertiserCreativeRtrptsTotalEntry = new TaobaoZsAdvertiserCreativeRtrptsTotalEntry();
        	                        JSONObject jsonObject = obj4.getJSONObject(k);
        	                        //获取json中的字段
        	                        if(jsonObject.has("ad_pv")){
        	                            String ad_pv = jsonObject.getString("ad_pv");
        	                            taobaoZsAdvertiserCreativeRtrptsTotalEntry.setAd_pv(ad_pv);
        	                        }
        	                        if(jsonObject.has("ecpm")){
        	                            String ecpm = jsonObject.getString("ecpm");
        	                            taobaoZsAdvertiserCreativeRtrptsTotalEntry.setEcpm(ecpm);
        	                        }
        	                        if(jsonObject.has("ctr")){
        	                            String ctr = jsonObject.getString("ctr");
        	                            taobaoZsAdvertiserCreativeRtrptsTotalEntry.setCtr(ctr);
        	                        }
        	                        if(jsonObject.has("img_url")){
        	                            String img_url = jsonObject.getString("img_url");
        	                            taobaoZsAdvertiserCreativeRtrptsTotalEntry.setImg_url(img_url);
        	                        }
        	                        if(jsonObject.has("ecpc")){
        	                            String ecpc = jsonObject.getString("ecpc");
        	                            taobaoZsAdvertiserCreativeRtrptsTotalEntry.setEcpc(ecpc);
        	                        }
        	                        String charge = jsonObject.getString("charge");
        	                        String log_date = jsonObject.getString("log_date");
        	                        String click = jsonObject.getString("click");
        	                        String campaign_name = jsonObject.getString("campaign_name");
        	                        String campaign_id = jsonObject.getString("campaign_id");
        	                        String adgroup_name = "";
        	                        if(jsonObject.has("adgroup_name")){
        	                         adgroup_name = jsonObject.getString("adgroup_name");
        	                        }
        	                        String adgroup_id = jsonObject.getString("adgroup_id");
        	                        String Creative_id= jsonObject.getString("creative_id");
        	                        String Creative_name= jsonObject.getString("creative_name");
        	                        //存储上述字段到pojo对象中
        	                        taobaoZsAdvertiserCreativeRtrptsTotalEntry.setCharge(charge);
        	                        taobaoZsAdvertiserCreativeRtrptsTotalEntry.setLog_date(log_date.substring(0,10));
        	                        taobaoZsAdvertiserCreativeRtrptsTotalEntry.setClick(click);
        	                        taobaoZsAdvertiserCreativeRtrptsTotalEntry.setCampaign_name(campaign_name);
        	                        taobaoZsAdvertiserCreativeRtrptsTotalEntry.setTaobao_user_id(user_id);
        	                        taobaoZsAdvertiserCreativeRtrptsTotalEntry.setCampaign_id(campaign_id);
        	                        taobaoZsAdvertiserCreativeRtrptsTotalEntry.setLast_update_time(new Date());
        	                        taobaoZsAdvertiserCreativeRtrptsTotalEntry.setAdgroup_id(adgroup_id);
        	                        taobaoZsAdvertiserCreativeRtrptsTotalEntry.setAdgroup_name(adgroup_name);
        	                        taobaoZsAdvertiserCreativeRtrptsTotalEntry.setCreative_id(Creative_id);
        	                        taobaoZsAdvertiserCreativeRtrptsTotalEntry.setCreative_name(Creative_name);
        	                        taobaoZsAdvertiserCreativeRtrptsTotalEntryList.add(taobaoZsAdvertiserCreativeRtrptsTotalEntry);
        	                	}
        	                }else{
        	                	LogUtils.logInfo("返回异常数据(不存在data):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
        	                	continue_flag=false;
        	                }
        				}else{
        					LogUtils.logInfo("返回异常数据(不存在creative_realtime_rpt_total_list):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
        					continue_flag=false;
        				}
        			}else{
        				LogUtils.logInfo("返回异常数据(不存在zuanshi_advertiser_creative_rtrpts_total_get_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
        				continue_flag=false;
        			}
        		}else{
        			LogUtils.logInfo("taobao.zuanshi.advertiser.creative.rtrpts.total.get返回数据为null"+"******"+"请求参数为:"+gson.toJson(req));
        			continue_flag=false;
        		}
        		i++;
        	}
	    }
	    
	    taobaoZsAdvertiserCreativeRtrptsTotalEntryDao.insertOrUpdateTaobaoZsAdvertiserCreativeRtrptsTotalEntryList(taobaoZsAdvertiserCreativeRtrptsTotalEntryList);
	    LogUtils.logInfo("**************同步指定用户创意分时当日汇总数据结束  总记录条数为 "+taobaoZsAdvertiserCreativeRtrptsTotalEntryList.size()+"*************");
	}
	
}
