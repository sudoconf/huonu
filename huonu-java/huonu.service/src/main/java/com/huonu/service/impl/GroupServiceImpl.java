package com.huonu.service.impl;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

import org.json.JSONArray;
import org.json.JSONObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.google.gson.Gson;
import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.dao.TaobaoZsAdgroupEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserAdgroupDayEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserAdgroupRtrptsTotalEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserTargetTotalEntryDao;
import com.huonu.domain.dao.TaobaoZsCampEntryDao;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZsAdgroupEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserAdgroupDayEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserAdgroupRtrptsTotalEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetTotalEntry;
import com.huonu.domain.model.TaobaoZsCampEntry;
import com.huonu.domain.model.conidtion.GroupCondition;
import com.huonu.service.ApiCallService;
import com.huonu.service.GroupService;
import com.huonu.utils.date.DateUtils;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.request.ZuanshiAdvertiserAdgroupRptsDayGetRequest;
import com.taobao.api.request.ZuanshiAdvertiserAdgroupRtrptsTotalGetRequest;
import com.taobao.api.request.ZuanshiBannerAdgroupCreateRequest;
import com.taobao.api.request.ZuanshiBannerAdgroupDeleteRequest;
import com.taobao.api.request.ZuanshiBannerAdgroupFindRequest;
import com.taobao.api.request.ZuanshiBannerAdgroupModifyRequest;
import com.taobao.api.request.ZuanshiBannerAdgroupStatusRequest;
import com.taobao.api.response.ZuanshiAdvertiserAdgroupRptsDayGetResponse;
import com.taobao.api.response.ZuanshiAdvertiserAdgroupRtrptsTotalGetResponse;
import com.taobao.api.response.ZuanshiBannerAdgroupCreateResponse;
import com.taobao.api.response.ZuanshiBannerAdgroupDeleteResponse;
import com.taobao.api.response.ZuanshiBannerAdgroupFindResponse;
import com.taobao.api.response.ZuanshiBannerAdgroupModifyResponse;
import com.taobao.api.response.ZuanshiBannerAdgroupStatusResponse;

@Service
public class GroupServiceImpl implements GroupService{
	
	@Autowired
	private ApiCallService apiCallService;
	
	@Autowired
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	@Autowired
	private TaobaoZsAdgroupEntryDao taobaoZsAdgroupEntryDao;
	
	@Autowired
	private TaobaoZsCampEntryDao taobaoZsCampEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserTargetTotalEntryDao taobaoZsAdvertiserTargetTotalEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserAdgroupDayEntryDao taobaoZsAdvertiserAdgroupDayEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserAdgroupRtrptsTotalEntryDao taobaoZsAdvertiserAdgroupRtrptsTotalEntryDao;
	
	
	//修改单元状态
	public String operate_status(String call_people, String user_id,
			Long campaign_id, String adgroup_id_list,Long status) {
		
		String message = "";
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		if(taobaoAuthorizeUser!=null &&  taobaoAuthorizeUser.getAccess_token()!=null){
			ZuanshiBannerAdgroupStatusRequest req = new ZuanshiBannerAdgroupStatusRequest();
			Gson gson = new Gson();
			req.setAdgroupIdList(adgroup_id_list);
			req.setStatus(status);
			req.setCampaignId(campaign_id);
			ZuanshiBannerAdgroupStatusResponse rsp = apiCallService.call(req, taobaoAuthorizeUser.getAccess_token(), call_people, "taobao.zuanshi.banner.adgroup.status");
			if(rsp!=null){
				JSONObject obj0 = new JSONObject(rsp.getBody());
				if (obj0.has("zuanshi_banner_adgroup_status_response")) {
					Boolean flag = obj0.getJSONObject("zuanshi_banner_adgroup_status_response").getJSONObject("result").getBoolean("success");
					if(flag==true){
						message = "成功";
						//重新同步单元
						sync_group( call_people, user_id, campaign_id,  adgroup_id_list,taobaoAuthorizeUser.getAccess_token());
					}else{
						message =obj0.getJSONObject("zuanshi_banner_adgroup_status_response").getJSONObject("result").getString("message");
					}
				}else{
					LogUtils.logInfo("返回异常数据(不存在zuanshi_banner_adgroup_status_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
					message = obj0.getJSONObject("error_response").getString("sub_msg");
				}
			}else{
				LogUtils.logInfo("taobao.zuanshi.banner.adgroup.status返回为null******"+"请求参数为:"+gson.toJson(req));
				message = "返回结果为null";				
			}
		}else{
			message = "用户token不存在";
		}
		return message;
	}
	
	
	/*
	 * 同步新增单元
	 */
	public String add_group(String call_people, String user_id,GroupCondition groupCondition){
		String message = "";
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		if(taobaoAuthorizeUser!=null &&  taobaoAuthorizeUser.getAccess_token()!=null){
			ZuanshiBannerAdgroupCreateRequest req = new ZuanshiBannerAdgroupCreateRequest();
			Gson gson = new Gson();
			req.setCampaignId(groupCondition.getCampaign_id());
			req.setName(groupCondition.getName());
			req.setIntelligentBid(groupCondition.getIntelligent_bid());
			req.setCrowds(groupCondition.getCrowds());
			req.setAdzoneBidList(groupCondition.getAdzone_bid_list());
			ZuanshiBannerAdgroupCreateResponse rsp = apiCallService.call(req, taobaoAuthorizeUser.getAccess_token(), call_people, "taobao.zuanshi.banner.adgroup.create"); 
			if(rsp!=null){
				JSONObject obj0 = new JSONObject(rsp.getBody());
				if (obj0.has("zuanshi_banner_adgroup_create_response")) {
					Boolean flag = obj0.getJSONObject("zuanshi_banner_adgroup_create_response").getJSONObject("result").getBoolean("success");
					if(flag==true){
						//更新本地数据库,根据返回的id重新调接口去查询一下
						message = "成功";
						String group_id = String.valueOf(obj0.getJSONObject("zuanshi_banner_adgroup_create_response").getJSONObject("result").getLong("id"));
						sync_group(call_people, user_id, groupCondition.getCampaign_id(),group_id,taobaoAuthorizeUser.getAccess_token());
					}else{
						message = obj0.getJSONObject("zuanshi_banner_adgroup_create_response").getJSONObject("result").getString("message");
					}
				}else{
					LogUtils.logInfo("返回异常数据(不存在zuanshi_banner_adgroup_create_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
					if(obj0.getJSONObject("error_response").has("sub_msg")){
						message = obj0.getJSONObject("error_response").getString("sub_msg");
					}else{
						message = obj0.getJSONObject("error_response").getString("msg");
					}
				}
			}else{
				LogUtils.logInfo("taobao.zuanshi.banner.adgroup.create返回为null******"+"请求参数为:"+gson.toJson(req));
				message = "返回结果为null";
			}
		}else{
			message = "用户token不存在";
		}
		return message;	
	}
	
	//同步修改单元
	public String modify_group(String call_people, String user_id,GroupCondition groupCondition){
		String message = "";
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		if(taobaoAuthorizeUser!=null &&  taobaoAuthorizeUser.getAccess_token()!=null){
			ZuanshiBannerAdgroupModifyRequest req = new ZuanshiBannerAdgroupModifyRequest();
			Gson gson = new Gson();
			req.setId(groupCondition.getId());
			req.setCampaignId(groupCondition.getCampaign_id());
			req.setAdboardFilter(groupCondition.getAdboard_filter());
			req.setName(groupCondition.getName());
			req.setIntelligentBid(groupCondition.getIntelligent_bid());
			ZuanshiBannerAdgroupModifyResponse rsp = apiCallService.call(req, taobaoAuthorizeUser.getAccess_token(), call_people, "taobao.zuanshi.banner.adgroup.modify"); 
			if(rsp!=null){
				JSONObject obj0 = new JSONObject(rsp.getBody());
				if (obj0.has("zuanshi_banner_adgroup_modify_response")) {
					Boolean flag = obj0.getJSONObject("zuanshi_banner_adgroup_modify_response").getJSONObject("result").getBoolean("success");
					if(flag==true){
						//更新本地数据库,根据返回的id重新调接口去查询一下
						message = "成功";
						//重新下载一下单元记录
						sync_group(call_people, user_id, groupCondition.getCampaign_id(),String.valueOf(groupCondition.getId()),taobaoAuthorizeUser.getAccess_token());
					}else{
						message = obj0.getJSONObject("zuanshi_banner_adgroup_modify_response").getJSONObject("result").getString("message");
					}
				}else{
					LogUtils.logInfo("返回异常数据(不存在zuanshi_banner_adgroup_modify_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
					message = obj0.getJSONObject("error_response").getString("sub_msg");
				}
			}else{
				LogUtils.logInfo("taobao.zuanshi.banner.adgroup.modify返回为null******"+"请求参数为:"+gson.toJson(req));
				message = "返回结果为null";
			}
		}else{
			message = "用户token不存在";
		}
		return message;	
	}
	
	
	//同步删除单元
	public String delete_group(String call_people, String user_id,Long campaign_id,String adgroup_id){
		String message = "";	
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		if(taobaoAuthorizeUser!=null &&  taobaoAuthorizeUser.getAccess_token()!=null){
			ZuanshiBannerAdgroupDeleteRequest req = new ZuanshiBannerAdgroupDeleteRequest();
			Gson gson = new Gson();
			req.setAdgroupIdList(adgroup_id);
			req.setCampaignId(campaign_id);
			ZuanshiBannerAdgroupDeleteResponse rsp = apiCallService.call(req, taobaoAuthorizeUser.getAccess_token(), call_people, "taobao.zuanshi.banner.adgroup.delete");
			if(rsp!=null){
				JSONObject obj0 = new JSONObject(rsp.getBody());
				if (obj0.has("zuanshi_banner_adgroup_delete_response")) {
					Boolean flag  = obj0.getJSONObject("zuanshi_banner_adgroup_delete_response").getJSONObject("result").getBoolean("success");
					//若成功则改变数据库状态
					if(flag==true){
						message = "成功";
						//根据店铺id  计划id  和单元id 删除本地数据库单元记录
						TaobaoZsAdgroupEntry taobaoZsAdgroupEntry = new TaobaoZsAdgroupEntry();
						taobaoZsAdgroupEntry.setAdgroup_id(Long.valueOf(adgroup_id));
						taobaoZsAdgroupEntry.setCampaign_id(campaign_id);
						taobaoZsAdgroupEntry.setTaobao_user_id(user_id);
						taobaoZsAdgroupEntryDao.deleteAdgroupEntryByConditions(taobaoZsAdgroupEntry);
					}else{
						message = obj0.getJSONObject("zuanshi_banner_adgroup_delete_response").getJSONObject("result").getString("message");
					}
				}else{
					LogUtils.logInfo("返回异常数据(不存在zuanshi_banner_adgroup_delete_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
					message = obj0.getJSONObject("error_response").getString("sub_msg");
				}
			}else{
				LogUtils.logInfo("taobao.zuanshi.banner.adgroup.delete返回为null******"+"请求参数为:"+gson.toJson(req));
				message = "返回结果为null";
			}
		}else{
			message = "用户token不存在";
		}
		return message;
	}
	
	/*
	 * 清除数据库的单元列表
	 */
	public void deleteAdgroupEntryByUserid(String taobao_user_id){
		taobaoZsAdgroupEntryDao.deleteAdgroupEntryByUserid(taobao_user_id);
	}
	
	/*
	 * 获取一个店家下的所有单元
	 */
	public List<TaobaoZsAdgroupEntry> getTaobaoZsAdgroupEntryByUserId(String taobao_user_id){
		return taobaoZsAdgroupEntryDao.getTaobaoZsAdgroupEntryByUserId(taobao_user_id);
	}
	
	
	/*
	 * 同步一个计划下所有单元,或者同步一个计划下的某个单元
	 */
	public void sync_group(String call_people,String user_id,Long campagin_id, String adgroupIdList,String sessionkey) {
		LogUtils.logInfo("**************同步一个计划下所有单元开始   【 用户id:["+user_id+"] 计划id:["+campagin_id+"] 密钥:["+sessionkey+"]】*************");
		List<TaobaoZsAdgroupEntry> taobaoZsAdgroupEntryList = new ArrayList<TaobaoZsAdgroupEntry>();
		ZuanshiBannerAdgroupFindRequest req = new ZuanshiBannerAdgroupFindRequest();
		ZuanshiBannerAdgroupFindResponse rsp = null;
		req.setCampaignId(campagin_id);
		req.setAdgroupIdList(adgroupIdList);
		req.setPageSize(1L);
		
		rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.banner.adgroup.find"); 
		
		if(rsp!=null){
			//LogUtils.logInfo("同步一个计划下所有单元-ZuanshiBannerAdgroupFindResponse请求返回数据: "+rsp.getBody());
			
			JSONObject obj0 = new JSONObject(rsp.getBody());
			long totalNum;
	        long pageNum=0;
	        if(obj0.has("zuanshi_banner_adgroup_find_response")){
	        	JSONObject obj = obj0.getJSONObject("zuanshi_banner_adgroup_find_response").getJSONObject("result");
		        if(obj.has("total_count")){
		        	 totalNum = obj.getLong("total_count");
			            if (totalNum < 200){
			                pageNum = 1L;
			            }else{
			                pageNum = totalNum/200+1;
			            }
		        }else{
		        	LogUtils.logInfo("返回参数为:"+rsp.getBody());
		            if (obj.getString("message").equals("计划不存在")){
		            	LogUtils.logInfo("计划"+campagin_id+"-不存在");
		                TaobaoZsCampEntry taobaoZsCampEntry=new TaobaoZsCampEntry();
		                taobaoZsCampEntry.setId(campagin_id);
		                taobaoZsCampEntry.setTaobao_user_id(user_id);
		                taobaoZsCampEntry.setOnline_status(9L);
		                taobaoZsCampEntry.setLast_update_time(new Date());
		                taobaoZsCampEntryDao.updateTaobaoZsCampEntryOnlineStatus(taobaoZsCampEntry);
		            }
		            return;
		        }
	        	
		        for (int i = 0; i < pageNum; i++) {
		        	req.setPageSize(200L);
		        	req.setPageNum(i+1L);
		        	rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.banner.adgroup.find");
		        	
		        	if(rsp!=null){
		        		 JSONObject obj1 = new JSONObject(rsp.getBody());
		        		 JSONObject obj2 = obj1.getJSONObject("zuanshi_banner_adgroup_find_response");
		                 JSONObject obj3 = obj2.getJSONObject("result");
		                 JSONObject obj4 = obj3.getJSONObject("adgroups");
		                 if (obj4.has("adgroup")) {
		                	 JSONArray obj5 = obj4.getJSONArray("adgroup");
		                	 for (int k = 0; k < obj5.length(); k++) {
		                         JSONObject jsonObject = obj5.getJSONObject(k);
		                         long campaign_id = jsonObject.getLong("campaign_id");
		                         long online_status = jsonObject.getLong("online_status");
		                         long adgroup_id = jsonObject.getLong("adgroup_id");
		                         String adgroup_name = jsonObject.getString("adgroup_name");
		                         TaobaoZsAdgroupEntry taobaoZsAdgroupEntry = new TaobaoZsAdgroupEntry();
		                         taobaoZsAdgroupEntry.setTaobao_user_id(user_id);
		                         taobaoZsAdgroupEntry.setOnline_status(online_status);
		                         taobaoZsAdgroupEntry.setCampaign_id(campaign_id);
		                         taobaoZsAdgroupEntry.setAdgroup_id(adgroup_id);
		                         taobaoZsAdgroupEntry.setTaobao_user_id(user_id);
		                         taobaoZsAdgroupEntry.setAdgroup_name(adgroup_name);
		                         taobaoZsAdgroupEntry.setLast_update_time(new Date());
		                         taobaoZsAdgroupEntryList.add(taobaoZsAdgroupEntry);
		                     }
		                 }
		        	}
		        }
	        }
		}
		taobaoZsAdgroupEntryDao.insertOrUpdateTaobaoZsAdgroupEntrylist(taobaoZsAdgroupEntryList);
	    LogUtils.logInfo("**************同步一个计划下所有单元结束   总记录条数为"+taobaoZsAdgroupEntryList.size()+"*************");
	}
	
	//单元分日数据
	public void sync_adgroupbyday(String call_people,String user_id,int day, String sessionkey) {
		LogUtils.logInfo("**************单元分日同步开始    【 用户id:["+user_id+"]  day:"+day+"+密钥:["+sessionkey+"]】*************");
		List<TaobaoZsAdvertiserAdgroupDayEntry> taobaoZsAdvertiserAdgroupDayEntryList = new ArrayList<TaobaoZsAdvertiserAdgroupDayEntry>();
		List<TaobaoZsAdvertiserTargetTotalEntry> taobaoZsAdvertiserTargetTotalEntryList = taobaoZsAdvertiserTargetTotalEntryDao.getTotalAdgroupByUserID(user_id);
		List<Long> effect = new ArrayList<Long>();
	    effect.add(3L);
	    effect.add(7L);
	    effect.add(15L);
	    List<String> effect_type = new ArrayList<String>();
	    effect_type.add("impression");
	    effect_type.add("click");
	    Date dNow = new Date();
	    Calendar calendar = Calendar.getInstance();
	    calendar.setTime(dNow);
	    calendar.add(Calendar.DAY_OF_MONTH, -1);
	    Calendar calendar0 = Calendar.getInstance();
	    calendar0.setTime(dNow);
	    calendar0.add(Calendar.DAY_OF_MONTH, -day);
	    dNow = calendar.getTime();
	    Date dBefore = calendar0.getTime();
	    SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");
	    String start_time = sdf.format(dBefore);
	    String end_time = sdf.format(dNow);
	    ZuanshiAdvertiserAdgroupRptsDayGetRequest req = new ZuanshiAdvertiserAdgroupRptsDayGetRequest();
		ZuanshiAdvertiserAdgroupRptsDayGetResponse rsp = null;
		Gson gson = new Gson();
		req.setEndTime(end_time);
    	req.setStartTime(start_time);
	
	        for(TaobaoZsAdvertiserTargetTotalEntry taobaoZsAdvertiserTargetTotalEntry:taobaoZsAdvertiserTargetTotalEntryList){
	        	Long campaign_id = Long.valueOf(taobaoZsAdvertiserTargetTotalEntry.getCampaign_id());
	            Long adgroup_id = Long.valueOf(taobaoZsAdvertiserTargetTotalEntry.getAdgroup_id());
	            Long campaign_model=taobaoZsAdvertiserTargetTotalEntry.getCampaign_model();
	            req.setCampaignId(campaign_id);
            	req.setAdgroupId(adgroup_id);
            	req.setCampaignModel(campaign_model);
	            for (Long effect0 : effect) {
	            	for (String effect_type0 : effect_type) {
	            		if ((effect_type0.equals("impression") && effect0 != 15l) || (effect_type0.equals("click") && effect0 != 7l)) {
	            			req.setEffect(effect0);
	            			req.setEffectType(effect_type0);
	            			
		                	rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.advertiser.adgroup.rpts.day.get");
	                    	
		                 	if(rsp!=null){
		                 		//LogUtils.logInfo("单元分日同步-ZuanshiAdvertiserAdgroupRptsDayGetResponse请求返回数据: "+rsp.getBody());
		                 		JSONObject obj1 = new JSONObject(rsp.getBody());
		                 		if(obj1.has("zuanshi_advertiser_adgroup_rpts_day_get_response")) {
		                 			
		                 			JSONObject obj2 = obj1.getJSONObject("zuanshi_advertiser_adgroup_rpts_day_get_response");
		                 		    if (obj2.has("adgroup_offline_rpt_days_list")) {
		                 		        JSONObject obj3 = obj2.getJSONObject("adgroup_offline_rpt_days_list");
		                 		        if (obj3.has("data")) {
		                 		            JSONArray obj4 = obj3.getJSONArray("data");
		                 		            for (int i = 0; i < obj4.length(); i++) {
		                 		                TaobaoZsAdvertiserAdgroupDayEntry taobaoZsAdvertiserAdgroupDayEntry = new TaobaoZsAdvertiserAdgroupDayEntry();
		                 		                JSONObject jsonObject = obj4.getJSONObject(i);
		                 		                if (jsonObject.has("ctr")) {
		                 		                   String ctr = jsonObject.getString("ctr");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setCtr(ctr);
		                 		                }
		                 		                if (jsonObject.has("cvr")) {
		                 		                   String cvr = jsonObject.getString("cvr");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setCvr(cvr);
		                 		                }
		                 		                if (jsonObject.has("uv")) {
		                 		                   String uv = jsonObject.getString("uv");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setUv(uv);
		                 		                }
		                 		                if (jsonObject.has("avg_access_time")) {
		                 		                   String avg_access_time = jsonObject.getString("avg_access_time");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setAvg_access_time(avg_access_time);
		                 		                }
		                 		                if (jsonObject.has("campaign_id")) {
		                 		                   String campaign_id1 = jsonObject.getString("campaign_id");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setCampaign_id(campaign_id1);
		                 		                }
		                 		                if (jsonObject.has("campaign_name")) {
		                 		                   String campaign_name = jsonObject.getString("campaign_name");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setCampaign_name(campaign_name);
		                 		                }
		                 		                if (jsonObject.has("charge")) {
		                 		                   String charge = jsonObject.getString("charge");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setCharge(charge);
		                 		                }
		                 		                if (jsonObject.has("alipay_inshop_amt")) {
		                 		                   String alipay_inshop_amt = jsonObject.getString("alipay_inshop_amt");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setAlipay_inshop_amt(alipay_inshop_amt);
		                 		                }
		                 		                if (jsonObject.has("alipay_in_shop_num")) {
		                 		                   String alipay_in_shop_num = jsonObject.getString("alipay_in_shop_num");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setAlipay_in_shop_num(alipay_in_shop_num);
		                 		                }
		                 		                if (jsonObject.has("ad_pv")) {
		                 		                   String ad_pv = jsonObject.getString("ad_pv");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setAd_pv(ad_pv);
		                 		                }
		                 		                if (jsonObject.has("avg_access_page_num")) {
		                 		                   String avg_access_page_num = jsonObject.getString("avg_access_page_num");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setAvg_access_page_num(avg_access_page_num);
		                 		                }
		                 		                if (jsonObject.has("dir_shop_col_num")) {
		                 		                   String dir_shop_col_num = jsonObject.getString("dir_shop_col_num");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setDir_shop_col_num(dir_shop_col_num);
		                 		                }
		                 		                if (jsonObject.has("gmv_inshop_num")) {
		                 		                   String gmv_inshop_num = jsonObject.getString("gmv_inshop_num");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setGmv_inshop_num(gmv_inshop_num);
		                 		                }
		                 		                if (jsonObject.has("click")) {
		                 		                	String click = jsonObject.getString("click");
		                 		                	taobaoZsAdvertiserAdgroupDayEntry.setClick(click);
		                 		                }
		                 		                if (jsonObject.has("roi")) {
		                 		                    String roi = jsonObject.getString("roi");
		                 		                    taobaoZsAdvertiserAdgroupDayEntry.setRoi(roi);
		                 		                }
		                 		                if (jsonObject.has("gmv_inshop_amt")) {
		                 		                    String gmv_inshop_amt = jsonObject.getString("gmv_inshop_amt");
		                 		                    taobaoZsAdvertiserAdgroupDayEntry.setGmv_inshop_amt(gmv_inshop_amt);
		                 		                }
		                 		                if (jsonObject.has("cart_num")) {
		                 		                    String cart_num = jsonObject.getString("cart_num");
		                 		                    taobaoZsAdvertiserAdgroupDayEntry.setCart_num(cart_num);
		                 		                }
		                 		                if (jsonObject.has("deep_inshop_uv")) {
		                 		                    String deep_inshop_uv = jsonObject.getString("deep_inshop_uv");
		                 		                    taobaoZsAdvertiserAdgroupDayEntry.setDeep_inshop_uv(deep_inshop_uv);
		                 		                }
		                 		                if (jsonObject.has("ecpm")) {
		                 		                   String ecpm = jsonObject.getString("ecpm");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setEcpm(ecpm);
		                 		                }
		                 		                if (jsonObject.has("log_date")) {
		                 		                   String log_date = jsonObject.getString("log_date");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setLog_date(log_date.substring(0, 10));
		                 		                }
		                 		                if (jsonObject.has("inshop_item_col_num")) {
		                 		                   String inshop_item_col_num = jsonObject.getString("inshop_item_col_num");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setInshop_item_col_num(inshop_item_col_num);
		                 		                }
		                 		                if (jsonObject.has("ecpc")) {
		                 		                   String ecpc = jsonObject.getString("ecpc");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setEcpc(ecpc);
		                 		                }
		                 		                if(jsonObject.has("adgroup_id")) {
		                 		                   String adgroup_id1 = jsonObject.getString("adgroup_id");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setAdgroup_id(adgroup_id1);
		                 		                }
		                 		                if(jsonObject.has("adgroup_name")) {
		                 		                   String adgroup_name = jsonObject.getString("adgroup_name");
		                 		                   taobaoZsAdvertiserAdgroupDayEntry.setAdgroup_name(adgroup_name);
		                 		                }
		                 		                taobaoZsAdvertiserAdgroupDayEntry.setTaobao_user_id(user_id);
		                 		                taobaoZsAdvertiserAdgroupDayEntry.setEffect(effect0);
		                 		                taobaoZsAdvertiserAdgroupDayEntry.setEffect_type(effect_type0);
		                 		                taobaoZsAdvertiserAdgroupDayEntry.setCampaign_model(campaign_model);
		                 		                taobaoZsAdvertiserAdgroupDayEntry.setLast_update_time(new Date());
		                 		                taobaoZsAdvertiserAdgroupDayEntry.setLast_update_status("成功");
		                 		                taobaoZsAdvertiserAdgroupDayEntryList.add(taobaoZsAdvertiserAdgroupDayEntry);
		                 		           }
		                 		       }else{
		                 		    	  LogUtils.logInfo("返回异常数据(不存在data):"+rsp.getBody());
		                 		       }
		                 		    }else{
		                 		    	LogUtils.logInfo("返回异常数据(不存在adgroup_offline_rpt_days_list):"+rsp.getBody());
		                 		    }
		                 		}else{
		                 			LogUtils.logInfo("返回异常数据:"+rsp.getBody());
		                 		}
		                 	}else{
				    			LogUtils.logInfo("taobao.zuanshi.advertiser.adgroup.rpts.day.get返回数据为null");
				    		}
	                    }
	                }
	            }
	        }
	        //入库
	        taobaoZsAdvertiserAdgroupDayEntryDao.insertOrUpdateTaobaoZsAdvertiserAdgroupDayEntryList(taobaoZsAdvertiserAdgroupDayEntryList);
	        LogUtils.logInfo("**************单元分日同步结束     总记录条数为"+taobaoZsAdvertiserAdgroupDayEntryList.size()+"*************");
	}
	
	/*
	 * 单元分时同步
	 */
	public void sync_AdgroupRtrptsTotal(String call_people,String user_id,Long campaignId,Long adgroup_Id,String sessionkey){
		
		LogUtils.logInfo("**************同步单元分时当日汇总数据开始    【调用人:["+call_people+"] 用户id:["+user_id+"] 计划id:["+campaignId+"] 密钥:["+sessionkey+"]】*************");
		List<TaobaoZsAdvertiserAdgroupRtrptsTotalEntry> taobaoZsAdvertiserAdgroupRtrptsTotalEntryList = new ArrayList<TaobaoZsAdvertiserAdgroupRtrptsTotalEntry>();
        String today = DateUtils.dateToString(new Date(),"yyyy-MM-dd");
        List<Long> campaignModelList = new ArrayList<Long>();
        campaignModelList.add(1L);
        campaignModelList.add(4L);
        ZuanshiAdvertiserAdgroupRtrptsTotalGetRequest req = new ZuanshiAdvertiserAdgroupRtrptsTotalGetRequest ();
        ZuanshiAdvertiserAdgroupRtrptsTotalGetResponse rsp = null;
        Gson gson = new Gson();
        req.setLogDate(today);
        req.setPageSize(200L);
        req.setCampaignId(campaignId);
        req.setAdgroupId(adgroup_Id);
        for (Long campaignModel : campaignModelList) {
        	req.setCampaignModel(campaignModel);
        	Boolean continue_flag = true;
        	int i=0;
        	while(continue_flag){
        		req.setOffset(200L*i);
        		rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.advertiser.adgroup.rtrpts.total.get");
        		
        		if(rsp!=null){
        			//LogUtils.logInfo("同步单元分时当日汇总数据-ZuanshiAdvertiserAdgroupRtrptsTotalGetResponse请求返回数据: "+rsp.getBody());
        			JSONObject obj0 = new JSONObject(rsp.getBody());
        			if (obj0.has("zuanshi_advertiser_adgroup_rtrpts_total_get_response")) {
        	            JSONObject obj00 = obj0.getJSONObject("zuanshi_advertiser_adgroup_rtrpts_total_get_response");        			
        	            if (obj00.has("adgroup_realtime_rpt_total_list")) {
        	            	JSONObject obj = obj00.getJSONObject("adgroup_realtime_rpt_total_list");
        	                if (obj.has("data")) {
        	                	JSONArray obj4 = obj.getJSONArray("data");
        	                    int listNum=obj4.length();
        	                    if(listNum<200){
        	                    	continue_flag = false;
        	                    }
        	                    for (int k = 0; k < obj4.length(); k++) {
        	                    	TaobaoZsAdvertiserAdgroupRtrptsTotalEntry taobaoZsAdvertiserAdgroupRtrptsTotalEntry = new TaobaoZsAdvertiserAdgroupRtrptsTotalEntry();
        	                    	JSONObject jsonObject = obj4.getJSONObject(k);
        	                        //获取json中的字段
        	                        if(jsonObject.has("ad_pv")){
        	                            String ad_pv = jsonObject.getString("ad_pv");
        	                            taobaoZsAdvertiserAdgroupRtrptsTotalEntry.setAd_pv(ad_pv);
        	                        }
        	                        if(jsonObject.has("ecpm")){
        	                            String ecpm = jsonObject.getString("ecpm");
        	                            taobaoZsAdvertiserAdgroupRtrptsTotalEntry.setEcpm(ecpm);
        	                        }
        	                        if(jsonObject.has("ctr")){
        	                            String ctr = jsonObject.getString("ctr");
        	                            taobaoZsAdvertiserAdgroupRtrptsTotalEntry.setCtr(ctr);
        	                        }
        	                        if(jsonObject.has("ecpc")){
        	                            String ecpc = jsonObject.getString("ecpc");
        	                            taobaoZsAdvertiserAdgroupRtrptsTotalEntry.setEcpc(ecpc);
        	                        }
        	                        String charge = jsonObject.getString("charge");
        	                        String log_date = jsonObject.getString("log_date");
        	                        String click = jsonObject.getString("click");
        	                        String adgroup_name = jsonObject.getString("adgroup_name");
        	                        String campaign_name = jsonObject.getString("campaign_name");
        	                        String adgroup_id = jsonObject.getString("adgroup_id");
        	                        String campaign_id = jsonObject.getString("campaign_id");
        	                        //存储上述字段到pojo对象中
        	                        taobaoZsAdvertiserAdgroupRtrptsTotalEntry.setCharge(charge);
        	                        taobaoZsAdvertiserAdgroupRtrptsTotalEntry.setLog_date(log_date);
        	                        taobaoZsAdvertiserAdgroupRtrptsTotalEntry.setClick(click);
        	                        taobaoZsAdvertiserAdgroupRtrptsTotalEntry.setAdgroup_name(adgroup_name);
        	                        taobaoZsAdvertiserAdgroupRtrptsTotalEntry.setCampaign_name(campaign_name);
        	                        taobaoZsAdvertiserAdgroupRtrptsTotalEntry.setTaobao_user_id(user_id);
        	                        taobaoZsAdvertiserAdgroupRtrptsTotalEntry.setAdgroup_id(adgroup_id);
        	                        taobaoZsAdvertiserAdgroupRtrptsTotalEntry.setCampaign_id(campaign_id);
        	                        taobaoZsAdvertiserAdgroupRtrptsTotalEntry.setLast_update_time(new Date());
        	                        taobaoZsAdvertiserAdgroupRtrptsTotalEntryList.add(taobaoZsAdvertiserAdgroupRtrptsTotalEntry);
        	                    }
        	                }else{
        	                	LogUtils.logInfo("返回异常数据(不存在data):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
        	                	continue_flag = false;
        	                }
        	            }else{
        	            	LogUtils.logInfo("返回异常数据(不存在adgroup_realtime_rpt_total_list):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
        	            	continue_flag = false;
        	            }
        			}else{
        				LogUtils.logInfo("返回异常数据(不存在zuanshi_advertiser_adgroup_rtrpts_total_get_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
        				continue_flag = false;
        			}
        		}else{
        			LogUtils.logInfo("taobao.zuanshi.advertiser.adgroup.rtrpts.total.get返回数据为null"+"******"+"请求参数为:"+gson.toJson(req));
        			continue_flag = false;
        		}
        		i++;
        	}
        }
        
        taobaoZsAdvertiserAdgroupRtrptsTotalEntryDao.insertOrUpdateTaobaoZsAdvertiserAdgroupRtrptsTotalEntryList(taobaoZsAdvertiserAdgroupRtrptsTotalEntryList);
        LogUtils.logInfo("**************同步单元分时当日汇总数据结束    总记录条数为"+taobaoZsAdvertiserAdgroupRtrptsTotalEntryList.size()+"*************");
	}
	
}
