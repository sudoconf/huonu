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
import com.huonu.domain.dao.TaobaoZsAdvertiserCampDayEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserCampRtrptsTotalEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserTargetTotalEntryDao;
import com.huonu.domain.dao.TaobaoZsCampEntryDao;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZsAdvertiserCampDayEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserCampRtrptsTotalEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetTotalEntry;
import com.huonu.domain.model.TaobaoZsCampEntry;
import com.huonu.domain.model.conidtion.CampCondition;
import com.huonu.service.ApiCallService;
import com.huonu.service.CampService;
import com.huonu.utils.date.DateUtils;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.internal.util.StringUtils;
import com.taobao.api.request.ZuanshiAdvertiserCampaignRptsDayGetRequest;
import com.taobao.api.request.ZuanshiAdvertiserCampaignRtrptsTotalGetRequest;
import com.taobao.api.request.ZuanshiBannerCampaignCreateRequest;
import com.taobao.api.request.ZuanshiBannerCampaignDeleteRequest;
import com.taobao.api.request.ZuanshiBannerCampaignFindRequest;
import com.taobao.api.request.ZuanshiBannerCampaignModifyRequest;
import com.taobao.api.request.ZuanshiBannerCampaignStatusRequest;
import com.taobao.api.response.ZuanshiAdvertiserCampaignRptsDayGetResponse;
import com.taobao.api.response.ZuanshiAdvertiserCampaignRtrptsTotalGetResponse;
import com.taobao.api.response.ZuanshiBannerCampaignCreateResponse;
import com.taobao.api.response.ZuanshiBannerCampaignDeleteResponse;
import com.taobao.api.response.ZuanshiBannerCampaignFindResponse;
import com.taobao.api.response.ZuanshiBannerCampaignModifyResponse;
import com.taobao.api.response.ZuanshiBannerCampaignStatusResponse;

@Service
public class CampServiceImpl implements CampService{

	@Autowired
	private ApiCallService apiCallService;
	
	@Autowired
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	@Autowired
	private TaobaoZsCampEntryDao taobaoZsCampEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserTargetTotalEntryDao taobaoZsAdvertiserTargetTotalEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserCampDayEntryDao taobaoZsAdvertiserCampDayEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserCampRtrptsTotalEntryDao taobaoZsAdvertiserCampRtrptsTotalEntryDao;

	/*
	 * 修改计划投放状态
	 */
	public String operate_status(String call_people, String user_id,
			String campaign_id, Long status) {
		String message = "";
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		if(taobaoAuthorizeUser!=null &&  taobaoAuthorizeUser.getAccess_token()!=null){
			ZuanshiBannerCampaignStatusRequest req = new ZuanshiBannerCampaignStatusRequest();
			Gson gson = new Gson();
			req.setCampaignIdList(campaign_id);
			req.setStatus(status);
			ZuanshiBannerCampaignStatusResponse rsp = apiCallService.call(req, taobaoAuthorizeUser.getAccess_token(), call_people, "taobao.zuanshi.banner.campaign.status");
			if(rsp!=null){
				JSONObject obj0 = new JSONObject(rsp.getBody());
				if (obj0.has("zuanshi_banner_campaign_status_response")) {
					Boolean flag = obj0.getJSONObject("zuanshi_banner_campaign_status_response").getJSONObject("result").getBoolean("success");
					//若成功则改变数据库状态
					if(flag==true){
						message = "成功";
						sync_camplist(call_people,user_id,campaign_id.toString(),taobaoAuthorizeUser.getAccess_token());
					}else{
						message =obj0.getJSONObject("zuanshi_banner_campaign_status_response").getJSONObject("result").getString("message");
					}
				}else{
					LogUtils.logInfo("返回异常数据(不存在zuanshi_banner_campaign_status_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
					message = obj0.getJSONObject("error_response").getString("sub_msg");
				}
			}else{
				LogUtils.logInfo("taobao.zuanshi.banner.campaign.status返回为null******"+"请求参数为:"+gson.toJson(req));
				message = "返回结果为null";
			}
		}else{
			message = "用户token不存在";
		}
		return message;
	}
	
	
	//同步新建计划
	public String add_camp(String call_people, String user_id,CampCondition campCondition){
		String message = "";
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		if(taobaoAuthorizeUser!=null &&  taobaoAuthorizeUser.getAccess_token()!=null){
			
			ZuanshiBannerCampaignCreateRequest req = new ZuanshiBannerCampaignCreateRequest();
			Gson gson = new Gson();
			req.setWeekend(campCondition.getWeekend());
			req.setWorkday(campCondition.getWorkday());
			req.setType(campCondition.getType());
			req.setName(campCondition.getName());
			req.setAreaIdList(campCondition.getArea_id_list());
			req.setSpeedType(campCondition.getSpeed_type());
			req.setDayBudget(campCondition.getDay_budget());
			req.setStartTime(StringUtils.parseDateTime(campCondition.getStart_time()));
			req.setEndTime(StringUtils.parseDateTime(campCondition.getEnd_time()));
			ZuanshiBannerCampaignCreateResponse rsp = apiCallService.call(req, taobaoAuthorizeUser.getAccess_token(), call_people, "taobao.zuanshi.banner.campaign.create");
			if(rsp!=null){
				JSONObject obj0 = new JSONObject(rsp.getBody());
				if (obj0.has("zuanshi_banner_campaign_create_response")) {
					Boolean flag = obj0.getJSONObject("zuanshi_banner_campaign_create_response").getJSONObject("result").getBoolean("success");
					if(flag==true){
						//更新本地数据库,根据返回的id重新调接口去查询一下
						message = "成功";
						Long camp_id = obj0.getJSONObject("zuanshi_banner_campaign_create_response").getJSONObject("result").getLong("id");
						sync_camplist(call_people,user_id,camp_id.toString(),taobaoAuthorizeUser.getAccess_token());
					}else{
						message = obj0.getJSONObject("zuanshi_banner_campaign_create_response").getJSONObject("result").getString("message");
					}
				}else{
					LogUtils.logInfo("返回异常数据(不存在zuanshi_banner_campaign_create_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
					message = obj0.getJSONObject("error_response").getString("sub_msg");
				}
			}else{
				LogUtils.logInfo("taobao.zuanshi.banner.campaign.create返回为null******"+"请求参数为:"+gson.toJson(req));
				message = "返回结果为null";
			}
			
		}else{
			message = "用户token不存在";
		}
		
		return message;
	}
	
	
	//同步修改计划
	public String modify_camp(String call_people, String user_id,CampCondition campCondition){
		String message = "";	
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		if(taobaoAuthorizeUser!=null &&  taobaoAuthorizeUser.getAccess_token()!=null){
			
			ZuanshiBannerCampaignModifyRequest req = new ZuanshiBannerCampaignModifyRequest();
			Gson gson = new Gson();
			req.setId(Long.parseLong(campCondition.getCampid()));
			req.setWorkday(campCondition.getWorkday());
			req.setWorkday(campCondition.getWorkday());
			req.setType(campCondition.getType());
			req.setName(campCondition.getName());
			req.setAreaIdList(campCondition.getArea_id_list());
			req.setSpeedType(campCondition.getSpeed_type());
			req.setDayBudget(campCondition.getDay_budget());
			req.setStartTime(StringUtils.parseDateTime(campCondition.getStart_time()));
			req.setEndTime(StringUtils.parseDateTime(campCondition.getEnd_time()));
			
			ZuanshiBannerCampaignModifyResponse rsp = apiCallService.call(req, taobaoAuthorizeUser.getAccess_token(), call_people, "taobao.zuanshi.banner.campaign.modify");
			if(rsp!=null){
				JSONObject obj0 = new JSONObject(rsp.getBody());
				if (obj0.has("zuanshi_banner_campaign_modify_response")) {
					Boolean flag = obj0.getJSONObject("zuanshi_banner_campaign_modify_response").getJSONObject("result").getBoolean("success");
					if(flag==true){
						message = "成功";
						//将Id重新查询一下，跟新数据
						sync_camplist(call_people,user_id,campCondition.getCampid().toString(),taobaoAuthorizeUser.getAccess_token());
					}else{
						message = obj0.getJSONObject("zuanshi_banner_campaign_modify_response").getJSONObject("result").getString("message");
					}
				}else{
					LogUtils.logInfo("返回异常数据(不存在zuanshi_banner_campaign_modify_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
					message = obj0.getJSONObject("error_response").getString("sub_msg");
				}
			}else{
				LogUtils.logInfo("taobao.zuanshi.banner.campaign.modify返回为null******"+"请求参数为:"+gson.toJson(req));
				message = "返回结果为null";
			}
			
		}else{
			message = "用户token不存在";
		}
		
		return message;
	
	}
	
	
	//同步删除计划
	public String delete_camp(String call_people, String user_id,String campaign_id){
		String message = "";	
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		if(taobaoAuthorizeUser!=null &&  taobaoAuthorizeUser.getAccess_token()!=null){
			ZuanshiBannerCampaignDeleteRequest req = new ZuanshiBannerCampaignDeleteRequest();
			Gson gson = new Gson();
			req.setCampaignIdList(campaign_id);
			ZuanshiBannerCampaignDeleteResponse rsp = apiCallService.call(req, taobaoAuthorizeUser.getAccess_token(), call_people, "taobao.zuanshi.banner.campaign.delete");
			if(rsp!=null){
				JSONObject obj0 = new JSONObject(rsp.getBody());
				if (obj0.has("zuanshi_banner_campaign_delete_response")) {
					Boolean flag  = obj0.getJSONObject("zuanshi_banner_campaign_delete_response").getJSONObject("result").getBoolean("success");
					//若成功则改变数据库状态
					if(flag==true){
						message = "成功";
						TaobaoZsCampEntry taobaoZsCampEntry=new TaobaoZsCampEntry();
			            taobaoZsCampEntry.setId(Long.parseLong(campaign_id));
			            taobaoZsCampEntry.setTaobao_user_id(user_id);
			            taobaoZsCampEntryDao.deleteTaobaoZsCampEntryByConditions(taobaoZsCampEntry);
					}else{
						message = obj0.getJSONObject("zuanshi_banner_campaign_delete_response").getJSONObject("result").getString("message");
					}
				}else{
					LogUtils.logInfo("返回异常数据(不存在zuanshi_banner_campaign_delete_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
					message = obj0.getJSONObject("error_response").getString("sub_msg");
				}
				
			}else{
				LogUtils.logInfo("taobao.zuanshi.banner.campaign.delete返回为null******"+"请求参数为:"+gson.toJson(req));
				message = "返回结果为null";
			}
		}else{
			message = "用户token不存在";
		}
		return message;
	}
	
	/*
	 * 同步计划列表，若没有id，则同步所有计划    若有id，同步某个计划
	 * 获取一个店家的所有钻展计划  或者 获取一个店家下某个具体的钻展计划信息
	 */
	public void sync_camplist(String call_people,String user_id,String camp_id,String sessionkey) {
		
		LogUtils.logInfo("**************同步用户计划列表数据开始    【 用户id:["+user_id+"] 计划id:["+camp_id+"] 密钥:["+sessionkey+"]】*************");
		List<TaobaoZsCampEntry> taobaoZsCampEntryList = new ArrayList<TaobaoZsCampEntry>();
		ZuanshiBannerCampaignFindRequest req = new ZuanshiBannerCampaignFindRequest();
		ZuanshiBannerCampaignFindResponse rsp = null;
		Long pageNum = 0L;
		req.setPageSize(1L);
		if(camp_id!=null){
			req.setCampaignIdList(camp_id);
		}
		
		rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.banner.campaign.find"); 
        
        if(rsp!=null){
        	
        	JSONObject obj0 = new JSONObject(rsp.getBody());
        	if(obj0.has("zuanshi_banner_campaign_find_response")){
        		JSONObject obj = obj0.getJSONObject("zuanshi_banner_campaign_find_response").getJSONObject("result");
        		long totalNum= obj.getLong("total_count");
	            if (totalNum < 200){
	                pageNum = 1L;
	            }else{
                pageNum = totalNum/200+1;
	            }
	            for (int i = 0; i < pageNum; i++) {
	            	req.setPageSize(200L);
	            	req.setPageNum(i+1L);
	            	rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.banner.campaign.find"); 
	            	
	            	if(rsp!=null){
	            		JSONObject obj1 = new JSONObject(rsp.getBody());
	            		JSONObject obj2 = obj1.getJSONObject("zuanshi_banner_campaign_find_response");
	                    JSONObject obj3 = obj2.getJSONObject("result");
	                    JSONObject obj4 = obj3.getJSONObject("campaigns");
	                    JSONArray obj5 = obj4.getJSONArray("campaign");
	                    for (int j = 0; j < obj5.length(); j++) {
	                        Long marketingdemand=0l;
	                        JSONObject jsonObject = obj5.getJSONObject(j);
	                        JSONObject banner_time = jsonObject.getJSONObject("banner_time");
	                        JSONObject workdayshour = banner_time.getJSONObject("workdays");
	                        JSONArray workdayshourlist = workdayshour.getJSONArray("boolean");
	                        JSONObject week_endshour = banner_time.getJSONObject("week_ends");
	                        JSONArray week_endshourlist = week_endshour.getJSONArray("boolean");
	                        String workdays = workdayshourlist.toString();
	                        String week_ends = week_endshourlist.toString();
	                        Long online_status = jsonObject.getLong("online_status");
	                        Long speed_type = jsonObject.getLong("speed_type");
	                        String start_time = jsonObject.getString("start_time");
	                        String name = jsonObject.getString("name");
	                        Long type = jsonObject.getLong("type");
	                        Long id = jsonObject.getLong("id");
	                        String end_time = jsonObject.getString("end_time");
	                        Long day_budget = jsonObject.getLong("day_budget");
	                        JSONObject properties = jsonObject.getJSONObject("properties");
	                        if(properties.has("marketingdemand")) {
	                            marketingdemand = properties.getLong("marketingdemand");
	                        }
	                        String life_cycle = jsonObject.getString("life_cycle");
	                        TaobaoZsCampEntry taobaoZsCampEntry = new TaobaoZsCampEntry();
	                        taobaoZsCampEntry.setTaobao_user_id(user_id);
	                        taobaoZsCampEntry.setWeek_ends(week_ends);
	                        taobaoZsCampEntry.setWorkdays(workdays);
	                        taobaoZsCampEntry.setOnline_status(online_status);
	                        taobaoZsCampEntry.setSpeed_type(speed_type);
	                        taobaoZsCampEntry.setStart_time(start_time);
	                        taobaoZsCampEntry.setName(name);
	                        taobaoZsCampEntry.setType(type);
	                        taobaoZsCampEntry.setId(id);
	                        taobaoZsCampEntry.setEnd_time(end_time);
	                        taobaoZsCampEntry.setDay_budget(day_budget);
	                        taobaoZsCampEntry.setMarketingdemand(marketingdemand);
	                        taobaoZsCampEntry.setLife_cycle(life_cycle);
	                        taobaoZsCampEntry.setLast_update_time(new Date());
	                        taobaoZsCampEntryList.add(taobaoZsCampEntry);
	                    }
	            	}
	            }
        	}
        }
        taobaoZsCampEntryDao.insertOrUpdateTaobaoZsCampEntrylist(taobaoZsCampEntryList);
        LogUtils.logInfo("**************同步用户计划列表数据结束    总记录条数为"+taobaoZsCampEntryList.size()+"*************");
	}
	
	/*
	 *获取一个店家下的所有计划列表
	 */
	public List<TaobaoZsCampEntry> getTaobaoZsCampEntryListByUserId(String user_id){
		return  taobaoZsCampEntryDao.getTaobaoZsCampEntryListByUserId(user_id);
	}
	
	
	/*
	 * 店铺计划分日同步
	 */
	public void sync_campbyday(String call_people,String user_id,int day, String sessionkey) {
		
		LogUtils.logInfo("**************店铺计划分日同步开始    【 用户id:["+user_id+"]  day:"+day+"+密钥:["+sessionkey+"]】*************");
		List<TaobaoZsAdvertiserCampDayEntry> taobaoZsAdvertiserCampDayEntryList = new ArrayList<TaobaoZsAdvertiserCampDayEntry>();
		//获取total计划
		List<TaobaoZsAdvertiserTargetTotalEntry> taobaoZsAdvertiserTargetTotalEntryList = taobaoZsAdvertiserTargetTotalEntryDao.getTotalCampByUserID(user_id);
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
        dNow=calendar.getTime();
        Date dBefore = calendar0.getTime();
        SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");
        String start_time = sdf.format(dBefore);
        String end_time = sdf.format(dNow);
        ZuanshiAdvertiserCampaignRptsDayGetRequest req = new ZuanshiAdvertiserCampaignRptsDayGetRequest();
		ZuanshiAdvertiserCampaignRptsDayGetResponse rsp = null;
		req.setStartTime(start_time);
		req.setEndTime(end_time);
        	
        	for(TaobaoZsAdvertiserTargetTotalEntry taobaoZsAdvertiserTargetTotalEntry:taobaoZsAdvertiserTargetTotalEntryList){
        		Long campaign_id = Long.valueOf(taobaoZsAdvertiserTargetTotalEntry.getCampaign_id());
                Long campaign_model=taobaoZsAdvertiserTargetTotalEntry.getCampaign_model();
                req.setCampaignId(campaign_id);
    			req.setCampaignModel(campaign_model);
                 for (Long effect0 : effect) {
                	 for (String effect_type0 : effect_type) {
                		 if ((effect_type0.equals("impression") && effect0 != 15l) || (effect_type0.equals("click") && effect0 != 7l)) {
                			
                			req.setEffect(effect0);
                			req.setEffectType(effect_type0);
                			rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.advertiser.campaign.rpts.day.get");
                			if(rsp!=null){
                				//LogUtils.logInfo("店铺计划分日同步-ZuanshiAdvertiserCampaignRptsDayGetResponse请求返回数据: "+rsp.getBody());
                				JSONObject obj1 = new JSONObject(rsp.getBody());
                				if(obj1.has("zuanshi_advertiser_campaign_rpts_day_get_response")) {
                					JSONObject obj2 = obj1.getJSONObject("zuanshi_advertiser_campaign_rpts_day_get_response");
                		            if (obj2.has("campaign_offline_rpt_days_list")) {
                		            	JSONObject obj3 = obj2.getJSONObject("campaign_offline_rpt_days_list");
                		                if (obj3.has("data")) {
                		                	 JSONArray obj4 = obj3.getJSONArray("data");
                		                     for (int i = 0; i < obj4.length(); i++) {
                		                    	 TaobaoZsAdvertiserCampDayEntry taobaoZsAdvertiserCampDayEntry = new TaobaoZsAdvertiserCampDayEntry();
                		                    	 JSONObject jsonObject = obj4.getJSONObject(i);
                		                         if (jsonObject.has("ctr")) {
                		                             String ctr = jsonObject.getString("ctr");
                		                             taobaoZsAdvertiserCampDayEntry.setCtr(ctr);
                		                         }
                		                         if (jsonObject.has("cvr")) {
                		                             String cvr = jsonObject.getString("cvr");
                		                             taobaoZsAdvertiserCampDayEntry.setCvr(cvr);
                		                         }
                		                         if (jsonObject.has("uv")) {
                		                             String uv = jsonObject.getString("uv");
                		                             taobaoZsAdvertiserCampDayEntry.setUv(uv);
                		                         }
                		                         if (jsonObject.has("avg_access_time")) {
                		                             String avg_access_time = jsonObject.getString("avg_access_time");
                		                             taobaoZsAdvertiserCampDayEntry.setAvg_access_time(avg_access_time);
                		                         }
                		                         if (jsonObject.has("campaign_id")) {
                		                             String campaign_id1 = jsonObject.getString("campaign_id");
                		                             taobaoZsAdvertiserCampDayEntry.setCampaign_id(campaign_id1);
                		                         }
                		                         if (jsonObject.has("campaign_name")) {
                		                             String campaign_name = jsonObject.getString("campaign_name");
                		                             taobaoZsAdvertiserCampDayEntry.setCampaign_name(campaign_name);
                		                         }
                		                         if (jsonObject.has("charge")) {
                		                             String charge = jsonObject.getString("charge");
                		                             taobaoZsAdvertiserCampDayEntry.setCharge(charge);
                		                         }
                		                         if (jsonObject.has("alipay_inshop_amt")) {
                		                             String alipay_inshop_amt = jsonObject.getString("alipay_inshop_amt");
                		                             taobaoZsAdvertiserCampDayEntry.setAlipay_inshop_amt(alipay_inshop_amt);
                		                         }
                		                         if (jsonObject.has("alipay_in_shop_num")) {
                		                             String alipay_in_shop_num = jsonObject.getString("alipay_in_shop_num");
                		                             taobaoZsAdvertiserCampDayEntry.setAlipay_in_shop_num(alipay_in_shop_num);
                		                         }
                		                         if (jsonObject.has("ad_pv")) {
                		                             String ad_pv = jsonObject.getString("ad_pv");
                		                             taobaoZsAdvertiserCampDayEntry.setAd_pv(ad_pv);
                		                         }
                		                         if (jsonObject.has("avg_access_page_num")) {
                		                             String avg_access_page_num = jsonObject.getString("avg_access_page_num");
                		                             taobaoZsAdvertiserCampDayEntry.setAvg_access_page_num(avg_access_page_num);
                		                         }
                		                         if (jsonObject.has("dir_shop_col_num")) {
                		                             String dir_shop_col_num = jsonObject.getString("dir_shop_col_num");
                		                             taobaoZsAdvertiserCampDayEntry.setDir_shop_col_num(dir_shop_col_num);
                		                         }
                		                         if (jsonObject.has("gmv_inshop_num")) {
                		                             String gmv_inshop_num = jsonObject.getString("gmv_inshop_num");
                		                             taobaoZsAdvertiserCampDayEntry.setGmv_inshop_num(gmv_inshop_num);
                		                         }
                		                         if (jsonObject.has("click")) {
                		                             String click = jsonObject.getString("click");
                		                             taobaoZsAdvertiserCampDayEntry.setClick(click);
                		                         }

                		                         if (jsonObject.has("roi")) {
                		                             String roi = jsonObject.getString("roi");
                		                             taobaoZsAdvertiserCampDayEntry.setRoi(roi);
                		                         }
                		                         if (jsonObject.has("gmv_inshop_amt")) {
                		                             String gmv_inshop_amt = jsonObject.getString("gmv_inshop_amt");
                		                             taobaoZsAdvertiserCampDayEntry.setGmv_inshop_amt(gmv_inshop_amt);
                		                         }
                		                         if (jsonObject.has("cart_num")) {
                		                             String cart_num = jsonObject.getString("cart_num");
                		                             taobaoZsAdvertiserCampDayEntry.setCart_num(cart_num);
                		                         }
                		                         if (jsonObject.has("deep_inshop_uv")) {
                		                             String deep_inshop_uv = jsonObject.getString("deep_inshop_uv");
                		                             taobaoZsAdvertiserCampDayEntry.setDeep_inshop_uv(deep_inshop_uv);
                		                         }
                		                         if (jsonObject.has("ecpm")) {
                		                             String ecpm = jsonObject.getString("ecpm");
                		                             taobaoZsAdvertiserCampDayEntry.setEcpm(ecpm);
                		                         }
                		                         if (jsonObject.has("log_date")) {
                		                             String log_date = jsonObject.getString("log_date");
                		                             taobaoZsAdvertiserCampDayEntry.setLog_date(log_date.substring(0,10));
                		                         }
                		                         if (jsonObject.has("inshop_item_col_num")) {
                		                             String inshop_item_col_num = jsonObject.getString("inshop_item_col_num");
                		                             taobaoZsAdvertiserCampDayEntry.setInshop_item_col_num(inshop_item_col_num);
                		                         }
                		                         if (jsonObject.has("ecpc")) {
                		                             String ecpc = jsonObject.getString("ecpc");
                		                             taobaoZsAdvertiserCampDayEntry.setEcpc(ecpc);
                		                         }
                		                         taobaoZsAdvertiserCampDayEntry.setTaobao_user_id(user_id);
                		                         taobaoZsAdvertiserCampDayEntry.setEffect(effect0);
                		                         taobaoZsAdvertiserCampDayEntry.setEffect_type(effect_type0);
                		                         taobaoZsAdvertiserCampDayEntry.setCampaign_model(campaign_model);
                		                         taobaoZsAdvertiserCampDayEntry.setLast_update_time(new Date());
                		                         taobaoZsAdvertiserCampDayEntry.setLast_update_status("成功");
                		                         taobaoZsAdvertiserCampDayEntryList.add(taobaoZsAdvertiserCampDayEntry);
                		                     }
                		                }else{
  		                 		    	  LogUtils.logInfo("返回异常数据(不存在data):"+rsp.getBody());
 		                 		       }
 		                 		    }else{
 		                 		    	LogUtils.logInfo("返回异常数据(不存在campaign_offline_rpt_days_list):"+rsp.getBody());
 		                 		    }
 		                 		}else{
 		                 			LogUtils.logInfo("返回异常数据:"+rsp.getBody());
 		                 		}
 		                 	}else{
 				    			LogUtils.logInfo("taobao.zuanshi.advertiser.campaign.rpts.day.get返回数据为null");
 				    		}
                			 
                		 }
                	 }
                 }
        	}
        	//入库
        	taobaoZsAdvertiserCampDayEntryDao.insertOrUpdateTaobaoZsAdvertiserCampDayEntryList(taobaoZsAdvertiserCampDayEntryList);
        	LogUtils.logInfo("**************店铺计划分日同步结束   总记录条数为"+taobaoZsAdvertiserCampDayEntryList.size()+"*************");
	}
	
	
	
	
	//同步指定用户的所有计划分时当日汇总数据 或者  同步某个计划分时当日汇总数据
	//@LogAnnotation(module=Constants.MODULE_SYNC ,description="同步用户计划分时当日汇总数据")
	public void sync_CampaignRtrptsTotal(String call_people,String user_id,Long campaignId,String sessionkey){
		
		LogUtils.logInfo("**************同步用户计划分时当日汇总数据开始    【调用人:["+call_people+"] 用户id:["+user_id+"] 计划id:["+campaignId+"] 密钥:["+sessionkey+"]】*************");
		List<TaobaoZsAdvertiserCampRtrptsTotalEntry> taobaoZsAdvertiserCampRtrptsTotalEntryList = new ArrayList<TaobaoZsAdvertiserCampRtrptsTotalEntry>() ;
		String today = DateUtils.dateToString(new Date(),"yyyy-MM-dd");
		List<Long> campaignModelList = new ArrayList<Long>();
        campaignModelList.add(1L);
        campaignModelList.add(4L);
        ZuanshiAdvertiserCampaignRtrptsTotalGetRequest req = new ZuanshiAdvertiserCampaignRtrptsTotalGetRequest ();
        ZuanshiAdvertiserCampaignRtrptsTotalGetResponse rsp = null;
        Gson gson = new Gson();
        req.setLogDate(today);
        req.setPageSize(200L);
        if(campaignId!=null){
        	req.setCampaignId(campaignId);
        }
        for (Long campaignModel : campaignModelList) {
        	req.setCampaignModel(campaignModel);
        	Boolean continue_flag = true;
        	int i=0;
        	while(continue_flag){
        		req.setOffset(200L*i);
        		rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.advertiser.campaign.rtrpts.total.get");
        		
        		if(rsp!=null){
        			JSONObject obj0 = new JSONObject(rsp.getBody());
        			if (obj0.has("zuanshi_advertiser_campaign_rtrpts_total_get_response")) {
        				JSONObject obj00 = obj0.getJSONObject("zuanshi_advertiser_campaign_rtrpts_total_get_response");
        				if(obj00.has("campaign_realtime_rpt_total_list")){
        					JSONObject obj = obj00.getJSONObject("campaign_realtime_rpt_total_list");
	                        if (obj.has("data")) {
	                        	JSONArray obj4 = obj.getJSONArray("data");
	                            int listNum=obj4.length();
	                            if(listNum<200){
	                            	continue_flag = false;
	                            }
	                            for (int k = 0; k < obj4.length(); k++) {
	                            	TaobaoZsAdvertiserCampRtrptsTotalEntry taobaoZsAdvertiserCampRtrptsTotalEntry = new TaobaoZsAdvertiserCampRtrptsTotalEntry();
	                                JSONObject jsonObject = obj4.getJSONObject(k);
	                                //获取json中的字段
	                                if(jsonObject.has("ad_pv")){
	                                    String ad_pv = jsonObject.getString("ad_pv");
	                                    taobaoZsAdvertiserCampRtrptsTotalEntry.setAd_pv(ad_pv);
	                                }
	                                if(jsonObject.has("ecpm")){
	                                    String ecpm = jsonObject.getString("ecpm");
	                                    taobaoZsAdvertiserCampRtrptsTotalEntry.setEcpm(ecpm);
	                                }
	                                if(jsonObject.has("ctr")){
	                                    String ctr = jsonObject.getString("ctr");
	                                    taobaoZsAdvertiserCampRtrptsTotalEntry.setCtr(ctr);
	                                }
	                                if(jsonObject.has("ecpc")){
	                                    String ecpc = jsonObject.getString("ecpc");
	                                    taobaoZsAdvertiserCampRtrptsTotalEntry.setEcpc(ecpc);
	                                }
	                                String charge = jsonObject.getString("charge");
	                                String log_date = jsonObject.getString("log_date");
	                                String click = jsonObject.getString("click");
	                                String campaign_name = jsonObject.getString("campaign_name");
	                                String campaign_id = jsonObject.getString("campaign_id");
	                                //存储上述字段到pojo对象中
	                                taobaoZsAdvertiserCampRtrptsTotalEntry.setCharge(charge);
	                                taobaoZsAdvertiserCampRtrptsTotalEntry.setLog_date(log_date);
	                                taobaoZsAdvertiserCampRtrptsTotalEntry.setClick(click);
	                                taobaoZsAdvertiserCampRtrptsTotalEntry.setCampaign_name(campaign_name);
	                                taobaoZsAdvertiserCampRtrptsTotalEntry.setTaobao_user_id(user_id);
	                                taobaoZsAdvertiserCampRtrptsTotalEntry.setCampaign_id(campaign_id);
	                                taobaoZsAdvertiserCampRtrptsTotalEntry.setLast_update_time(new Date());
	                                taobaoZsAdvertiserCampRtrptsTotalEntryList.add(taobaoZsAdvertiserCampRtrptsTotalEntry);
	                            }
	                        }else{
	                        	LogUtils.logInfo("返回异常数据(不存在data):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
	                        	continue_flag = false;
	                        }
        				}else{
        					LogUtils.logInfo("返回异常数据(不存在campaign_realtime_rpt_total_list):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
        					continue_flag = false;
        				}
        			}else{
        				LogUtils.logInfo("返回异常数据:"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
        				continue_flag = false;
        			}
        		}else{
        			LogUtils.logInfo("taobao.zuanshi.advertiser.campaign.rtrpts.total.get返回数据为null"+"******"+"请求参数为:"+gson.toJson(req));
        			continue_flag = false;
        		}
        		i++;
        	}
        }
        taobaoZsAdvertiserCampRtrptsTotalEntryDao.insertOrUpdateTaobaoZsAdvertiserCampRtrptsTotalEntryList(taobaoZsAdvertiserCampRtrptsTotalEntryList);
        LogUtils.logInfo("**************同步用户计划分时当日汇总数据结束    总记录条数为:"+taobaoZsAdvertiserCampRtrptsTotalEntryList.size()+"*************");
	}
	
	
	
	
	//删除店铺所有的计划
	public void deleteZsCampByUserId(String taobao_user_id) {
		taobaoZsCampEntryDao.deleteTaobaoZsCampEntryByUserId(taobao_user_id);
	}
	
}
