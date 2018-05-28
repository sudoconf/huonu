package com.huonu.service.impl;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.json.JSONArray;
import org.json.JSONObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.google.gson.Gson;
import com.huonu.domain.dao.TaobaoAsyncTaskEntryDao;
import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserTargetDayEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserTargetDaySumEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserTargetTotalEntryDao;
import com.huonu.domain.model.TaobaoAsyncTaskEntry;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetDayEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetDaySumEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetTotalEntry;
import com.huonu.service.ApiCallService;
import com.huonu.service.ProtionService;
import com.huonu.utils.ListUtils;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.ApiException;
import com.taobao.api.BatchTaobaoClient;
import com.taobao.api.TaobaoBatchRequest;
import com.taobao.api.TaobaoBatchResponse;
import com.taobao.api.request.ZuanshiAdvertiserRptsDownloadDayGetRequest;
import com.taobao.api.request.ZuanshiAdvertiserTargetRptsDayGetRequest;
import com.taobao.api.request.ZuanshiAdvertiserTargetRptsTotalGetRequest;
import com.taobao.api.response.ZuanshiAdvertiserRptsDownloadDayGetResponse;
import com.taobao.api.response.ZuanshiAdvertiserTargetRptsDayGetResponse;
import com.taobao.api.response.ZuanshiAdvertiserTargetRptsTotalGetResponse;

@Service("protionService")
public class ProtionServiceImpl implements ProtionService{

	@Autowired
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	@Autowired
	private BatchTaobaoClient batchTaobaoClient;
	
	@Autowired
	private TaobaoZsAdvertiserTargetTotalEntryDao taobaoZsAdvertiserTargetTotalEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserTargetDayEntryDao taobaoZsAdvertiserTargetDayEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserTargetDaySumEntryDao taobaoZsAdvertiserTargetDaySumEntryDao;
	
	@Autowired
	private TaobaoAsyncTaskEntryDao taobaoAsyncTaskEntryDao;
	
	@Autowired
	private ApiCallService apiCallService;
	
	public void sync_protion(String call_people, String user_id, int day) {
		
		//获取原来的同步状态
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		System.out.println(taobaoAuthorizeUser);
		if(taobaoAuthorizeUser.getSync_status() == 0L){
			//更新同步状态
			taobaoAuthorizeUser.setSync_status(11L);
			taobaoAuthorizeUserDao.updateSyncStatusByTaoBaoUserId(taobaoAuthorizeUser);
			
			//同步定向分日汇总数据
			sync_targettotal(call_people,user_id,day,taobaoAuthorizeUser.getAccess_token());
			
			//更新同步状态
			taobaoAuthorizeUser.setSync_status(12L);
			taobaoAuthorizeUserDao.updateSyncStatusByTaoBaoUserId(taobaoAuthorizeUser);
			
			//同步定向分日数据
			sync_targetday(call_people,user_id,day,taobaoAuthorizeUser.getAccess_token());
			
			//更新同步状态
			taobaoAuthorizeUser.setSync_status(13L);
			taobaoAuthorizeUserDao.updateSyncStatusByTaoBaoUserId(taobaoAuthorizeUser);
			//处理定向分日数据
			sync_targetdaysum(call_people,user_id,day,taobaoAuthorizeUser.getAccess_token());
			//生成异步下载任务ID
			//sync_rptsdownloadtask(call_people,user_id,day,taobaoAuthorizeUser.getAccess_token());
			
			//更新同步状态
			taobaoAuthorizeUser.setSync_status(1L);
			taobaoAuthorizeUserDao.updateSyncStatusByTaoBaoUserId(taobaoAuthorizeUser);
			
		}else{
			//同步定向分日汇总数据
			sync_targettotal(call_people,user_id,day,taobaoAuthorizeUser.getAccess_token());
			//同步定向分日数据
			sync_targetday(call_people,user_id,day,taobaoAuthorizeUser.getAccess_token());
			//处理定向分日数据
			sync_targetdaysum(call_people,user_id,day,taobaoAuthorizeUser.getAccess_token());
		}
		
	}

	
	//同步定向分日汇总数据
	public void sync_targettotal(String call_people,String user_id, int day, String sessionkey) {
		
		 LogUtils.logInfo("**************同步定向分日汇总数据开始     用户id:["+user_id+"] day:["+day+"] 密钥:["+sessionkey+"]】*************");
		 List<TaobaoZsAdvertiserTargetTotalEntry> taobaoZsAdvertiserTargetTotalEntryList = new ArrayList<TaobaoZsAdvertiserTargetTotalEntry>();
	     List<Long> effect = new ArrayList<Long>();
	     effect.add(3L);
//	     effect.add(7L);
//	     effect.add(15L);
	     List<Long> campaign_model = new ArrayList<Long>();
	     campaign_model.add(1L);
	     campaign_model.add(4L);
	     List<String> effect_type = new ArrayList<String>();
	     effect_type.add("impression");
//	     effect_type.add("click");
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
	     ZuanshiAdvertiserTargetRptsTotalGetRequest req = new ZuanshiAdvertiserTargetRptsTotalGetRequest();
	     ZuanshiAdvertiserTargetRptsTotalGetResponse rsp = null;
	     Gson gson = new Gson();
	     req.setStartTime(start_time);
		 req.setEndTime(end_time);
		 req.setPageSize(200L);
	     for (Long effect0 : effect) {
	    	 for (Long campaign_model0 : campaign_model) {
	    		 for (String effect_type0 : effect_type) {
	    			 req.setEffect(effect0);
    				 req.setEffectType(effect_type0);
    				 req.setCampaignModel(campaign_model0);
	    			 Boolean cotinue_flag = true;
	    			 int i = 0;
	    			 while(cotinue_flag&&i<=10){
	    				req.setOffset(200L*i); 
	    				
	    				rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.advertiser.target.rpts.total.get");
	    				
	    				if(rsp!=null){
	    					//LogUtils.logInfo("同步定向分日汇总数据开始-ZuanshiAdvertiserTargetRptsTotalGetResponse请求返回数据: "+rsp.getBody());
	    					JSONObject obj1 = new JSONObject(rsp.getBody());
	    					if(obj1.has("zuanshi_advertiser_target_rpts_total_get_response")) {
	    						JSONObject obj2 = obj1.getJSONObject("zuanshi_advertiser_target_rpts_total_get_response");
	    			            if (obj2.has("target_offline_rpt_total_list")) {
	    			            	JSONObject obj3 = obj2.getJSONObject("target_offline_rpt_total_list");
	    			                if (obj3.has("data")) {
	    			                	JSONArray obj4 = obj3.getJSONArray("data");
	    			                    int listNum=obj4.length();
	    			                    if(listNum <200){
	    			                    	cotinue_flag=false;
	    			                    }
	    			                    for (int k = 0; k < obj4.length(); k++) {
	    			                    	TaobaoZsAdvertiserTargetTotalEntry taobaoZsAdvertiserTargetTotalEntry = new TaobaoZsAdvertiserTargetTotalEntry();
	    			                        JSONObject jsonObject = obj4.getJSONObject(k);
	    			                        if (jsonObject.has("ctr")) {
	    			                            String ctr = jsonObject.getString("ctr");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setCtr(ctr);
	    			                        }
	    			                        if (jsonObject.has("cvr")) {
	    			                            String cvr = jsonObject.getString("cvr");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setCvr(cvr);
	    			                        }
	    			                        if (jsonObject.has("uv")) {
	    			                            String uv = jsonObject.getString("uv");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setUv(uv);
	    			                        }
	    			                        if (jsonObject.has("avg_access_time")) {
	    			                            String avg_access_time = jsonObject.getString("avg_access_time");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setAvg_access_time(avg_access_time);
	    			                        }
	    			                        if (jsonObject.has("campaign_id")) {
	    			                            String campaign_id = jsonObject.getString("campaign_id");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setCampaign_id(campaign_id);
	    			                        }
	    			                        if (jsonObject.has("campaign_name")) {
	    			                            String campaign_name = jsonObject.getString("campaign_name");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setCampaign_name(campaign_name);
	    			                        }
	    			                        if (jsonObject.has("charge")) {
	    			                            String charge = jsonObject.getString("charge");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setCharge(charge);
	    			                        }
	    			                        if (jsonObject.has("alipay_inshop_amt")) {
	    			                            String alipay_inshop_amt = jsonObject.getString("alipay_inshop_amt");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setAlipay_inshop_amt(alipay_inshop_amt);
	    			                        }
	    			                        if (jsonObject.has("alipay_in_shop_num")) {
	    			                            String alipay_in_shop_num = jsonObject.getString("alipay_in_shop_num");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setAlipay_in_shop_num(alipay_in_shop_num);
	    			                        }
	    			                        if (jsonObject.has("ad_pv")) {
	    			                            String ad_pv = jsonObject.getString("ad_pv");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setAd_pv(ad_pv);
	    			                        }
	    			                        if (jsonObject.has("avg_access_page_num")) {
	    			                            String avg_access_page_num = jsonObject.getString("avg_access_page_num");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setAvg_access_page_num(avg_access_page_num);
	    			                        }
	    			                        if (jsonObject.has("dir_shop_col_num")) {
	    			                            String dir_shop_col_num = jsonObject.getString("dir_shop_col_num");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setDir_shop_col_num(dir_shop_col_num);
	    			                        }
	    			                        if (jsonObject.has("gmv_inshop_num")) {
	    			                            String gmv_inshop_num = jsonObject.getString("gmv_inshop_num");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setGmv_inshop_num(gmv_inshop_num);
	    			                        }
	    			                        if (jsonObject.has("click")) {
	    			                            String click = jsonObject.getString("click");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setClick(click);
	    			                        }

	    			                        if (jsonObject.has("roi")) {
	    			                            String roi = jsonObject.getString("roi");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setRoi(roi);
	    			                        }
	    			                        if (jsonObject.has("gmv_inshop_amt")) {
	    			                            String gmv_inshop_amt = jsonObject.getString("gmv_inshop_amt");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setGmv_inshop_amt(gmv_inshop_amt);
	    			                        }
	    			                        if (jsonObject.has("cart_num")) {
	    			                            String cart_num = jsonObject.getString("cart_num");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setCart_num(cart_num);
	    			                        }
	    			                        if (jsonObject.has("deep_inshop_uv")) {
	    			                            String deep_inshop_uv = jsonObject.getString("deep_inshop_uv");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setDeep_inshop_uv(deep_inshop_uv);
	    			                        }
	    			                        if (jsonObject.has("ecpm")) {
	    			                            String ecpm = jsonObject.getString("ecpm");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setEcpm(ecpm);
	    			                        }
	    			                        if (jsonObject.has("inshop_item_col_num")) {
	    			                            String inshop_item_col_num = jsonObject.getString("inshop_item_col_num");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setInshop_item_col_num(inshop_item_col_num);
	    			                        }
	    			                        if (jsonObject.has("ecpc")) {
	    			                            String ecpc = jsonObject.getString("ecpc");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setEcpc(ecpc);
	    			                        }
	    			                        if(jsonObject.has("adgroup_id")) {
	    			                            String adgroup_id = jsonObject.getString("adgroup_id");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setAdgroup_id(adgroup_id);
	    			                        }
	    			                        if(jsonObject.has("adgroup_name")) {
	    			                            String adgroup_name = jsonObject.getString("adgroup_name");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setAdgroup_name(adgroup_name);
	    			                        }
	    			                        if(jsonObject.has("target_name")) {
	    			                            String target_name = jsonObject.getString("target_name");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setTarget_name(target_name);
	    			                        }
	    			                        if(jsonObject.has("target_id")) {
	    			                            String target_id = jsonObject.getString("target_id");
	    			                            taobaoZsAdvertiserTargetTotalEntry.setTarget_id(target_id);
	    			                            if (target_id.equals ("-2")) {
	    			                            	taobaoZsAdvertiserTargetTotalEntry.setTarget_name("系统托管定向包");
	    			                            }
	    			                        }
	    			                        taobaoZsAdvertiserTargetTotalEntry.setTaobao_user_id(user_id);
	    			                        taobaoZsAdvertiserTargetTotalEntry.setEffect(effect0);
	    			                        taobaoZsAdvertiserTargetTotalEntry.setEffect_type(effect_type0);
	    			                        taobaoZsAdvertiserTargetTotalEntry.setCampaign_model(campaign_model0);
	    			                        taobaoZsAdvertiserTargetTotalEntry.setLast_update_time(new Date());
	    			                        taobaoZsAdvertiserTargetTotalEntryList.add(taobaoZsAdvertiserTargetTotalEntry);
	    			                    }
	    			                }else{
	    			                	LogUtils.logInfo("返回异常数据(不存在data):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
	    			                	cotinue_flag=false;
	    			                }
	    			            }else{
	    			            	LogUtils.logInfo("返回异常数据(不存在target_offline_rpt_total_list):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
	    			            	cotinue_flag=false;
	    			            }
	    					}else{
	    						LogUtils.logInfo("返回异常数据(不存在zuanshi_advertiser_target_rpts_total_get_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
	    						cotinue_flag=false;
	    					}
	    				}else{
	    					LogUtils.logInfo("taobao.zuanshi.advertiser.target.rpts.total.get返回数据为null"+"******"+"请求参数为:"+gson.toJson(req));
	    					cotinue_flag=false;
	    				}
	    				i++;
	    			 }
	             }
	    	}
	     }
	     //根据user_id删除原来的定向分日汇总数据
	     taobaoZsAdvertiserTargetTotalEntryDao.deleteTargetTotalEntryByUserId(user_id);
	     taobaoZsAdvertiserTargetTotalEntryDao.insertOrUpdateTaobaoZsAdvertiserTargetTotalEntryList(taobaoZsAdvertiserTargetTotalEntryList);
	     LogUtils.logInfo("**************同步定向分日汇总数据结束     总记录条数为"+taobaoZsAdvertiserTargetTotalEntryList.size()+"*************");
	}

	
	//同步定向分日数据
	public void sync_targetday(String call_people,String user_id, int day, String sessionkey) {
		
		LogUtils.logInfo("**************同步定向分日数据开始     用户id:["+user_id+"] day:["+day+"] 密钥:["+sessionkey+"]】*************");
		List<TaobaoZsAdvertiserTargetDayEntry> taobaoZsAdvertiserTargetDayEntryList = new ArrayList<TaobaoZsAdvertiserTargetDayEntry>();
		List<TaobaoZsAdvertiserTargetTotalEntry> taobaoZsAdvertiserTargetTotalEntryList = taobaoZsAdvertiserTargetTotalEntryDao.getTotalTargetByUserID(user_id);
		
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
        ZuanshiAdvertiserTargetRptsDayGetRequest req = new ZuanshiAdvertiserTargetRptsDayGetRequest ();
        ZuanshiAdvertiserTargetRptsDayGetResponse rsp = null;
        Gson gson = new Gson();
        req.setStartTime(start_time);
        req.setEndTime(end_time);
		for(TaobaoZsAdvertiserTargetTotalEntry taobaoZsAdvertiserTargetTotalEntry:taobaoZsAdvertiserTargetTotalEntryList){
			Long campaign_id = Long.parseLong(taobaoZsAdvertiserTargetTotalEntry.getCampaign_id());
	        Long adgroup_id = Long.parseLong(taobaoZsAdvertiserTargetTotalEntry.getAdgroup_id());
	        Long target_id = Long.parseLong(taobaoZsAdvertiserTargetTotalEntry.getTarget_id());
	        Long campaign_model = taobaoZsAdvertiserTargetTotalEntry.getCampaign_model();
	        req.setCampaignId(campaign_id);
	        req.setAdgroupId(adgroup_id);
	        req.setTargetId(target_id);
	        req.setCampaignModel(campaign_model);
	        for (Long effect0 : effect) {
	            for (String effect_type0 : effect_type) {
	                if ((effect_type0.equals("impression") && effect0 != 15l) || (effect_type0.equals("click") && effect0 != 7l)) {
	                	
	                	req.setEffect(effect0);
	                	req.setEffectType(effect_type0);
	                	
	                	rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.advertiser.target.rpts.day.get");
	                		
			    		if(rsp!=null){
			    			JSONObject obj1 = new JSONObject(rsp.getBody());
			    			if (obj1.has("zuanshi_advertiser_target_rpts_day_get_response")) {
			    				JSONObject obj2 = obj1.getJSONObject("zuanshi_advertiser_target_rpts_day_get_response");
			    			    if (obj2.has("target_offline_rpt_days_list")) {
			    			    	JSONObject obj3 = obj2.getJSONObject("target_offline_rpt_days_list");
			    			        if (obj3.has("data")) {
			    			        	JSONArray obj4 = obj3.getJSONArray("data");
			    			            for (int i = 0; i < obj4.length(); i++) {
			    			            	TaobaoZsAdvertiserTargetDayEntry taobaoZsAdvertiserTargetDayEntry = new TaobaoZsAdvertiserTargetDayEntry();
			    			                JSONObject jsonObject = obj4.getJSONObject(i);
			    			                if (jsonObject.has("ctr")) {
			    			                	String ctr = jsonObject.getString("ctr");
			    			                    taobaoZsAdvertiserTargetDayEntry.setCtr(ctr);
			    			                }
			    			                if (jsonObject.has("cvr")) {
			    			                    String cvr = jsonObject.getString("cvr");
			    			                    taobaoZsAdvertiserTargetDayEntry.setCvr(cvr);
			    			                }
			    			                if (jsonObject.has("uv")) {
			    			                    String uv = jsonObject.getString("uv");
			    			                    taobaoZsAdvertiserTargetDayEntry.setUv(uv);
			    			                }
			    			                if (jsonObject.has("avg_access_time")) {
			    			                    String avg_access_time = jsonObject.getString("avg_access_time");
			    			                    taobaoZsAdvertiserTargetDayEntry.setAvg_access_time(avg_access_time);
			    			                }
			    			                if (jsonObject.has("campaign_id")) {
			    			                    String campaign_id1 = jsonObject.getString("campaign_id");
			    			                    taobaoZsAdvertiserTargetDayEntry.setCampaign_id(campaign_id1);
			    			                }
			    			                if (jsonObject.has("campaign_name")) {
			    			                    String campaign_name = jsonObject.getString("campaign_name");
			    			                            taobaoZsAdvertiserTargetDayEntry.setCampaign_name(campaign_name);
			    			                }
			    			                if (jsonObject.has("charge")) {
			    			                    String charge = jsonObject.getString("charge");
			    			                    taobaoZsAdvertiserTargetDayEntry.setCharge(charge);
			    			                }
			    			                if (jsonObject.has("alipay_inshop_amt")) {
			    			                    String alipay_inshop_amt = jsonObject.getString("alipay_inshop_amt");
			    			                    taobaoZsAdvertiserTargetDayEntry.setAlipay_inshop_amt(alipay_inshop_amt);
			    			                }
			    			                if (jsonObject.has("alipay_in_shop_num")) {
			    			                    String alipay_in_shop_num = jsonObject.getString("alipay_in_shop_num");
			    			                    taobaoZsAdvertiserTargetDayEntry.setAlipay_in_shop_num(alipay_in_shop_num);
			    			                }
			    			                if (jsonObject.has("ad_pv")) {
			    			                    String ad_pv = jsonObject.getString("ad_pv");
			    			                    taobaoZsAdvertiserTargetDayEntry.setAd_pv(ad_pv);
			    			                }
			    			                if (jsonObject.has("avg_access_page_num")) {
			    			                    String avg_access_page_num = jsonObject.getString("avg_access_page_num");
			    			                    taobaoZsAdvertiserTargetDayEntry.setAvg_access_page_num(avg_access_page_num);
			    			                }
			    			                if (jsonObject.has("dir_shop_col_num")) {
			    			                    String dir_shop_col_num = jsonObject.getString("dir_shop_col_num");
			    			                    taobaoZsAdvertiserTargetDayEntry.setDir_shop_col_num(dir_shop_col_num);
			    			                }
			    			                if (jsonObject.has("gmv_inshop_num")) {
			    			                    String gmv_inshop_num = jsonObject.getString("gmv_inshop_num");
			    			                    taobaoZsAdvertiserTargetDayEntry.setGmv_inshop_num(gmv_inshop_num);
			    			                }
			    			                if (jsonObject.has("click")) {
			    			                    String click = jsonObject.getString("click");
			    			                    taobaoZsAdvertiserTargetDayEntry.setClick(click);
			    			                }
			    			                if (jsonObject.has("roi")) {
			    			                    String roi = jsonObject.getString("roi");
			    			                    taobaoZsAdvertiserTargetDayEntry.setRoi(roi);
			    			                }
			    			                if (jsonObject.has("gmv_inshop_amt")) {
			    			                    String gmv_inshop_amt = jsonObject.getString("gmv_inshop_amt");
			    			                    taobaoZsAdvertiserTargetDayEntry.setGmv_inshop_amt(gmv_inshop_amt);
			    			                }
			    			                if (jsonObject.has("cart_num")) {
			    			                	String cart_num = jsonObject.getString("cart_num");
			    			                    taobaoZsAdvertiserTargetDayEntry.setCart_num(cart_num);
			    			                }
			    			                if (jsonObject.has("deep_inshop_uv")) {
			    			                    String deep_inshop_uv = jsonObject.getString("deep_inshop_uv");
			    			                    taobaoZsAdvertiserTargetDayEntry.setDeep_inshop_uv(deep_inshop_uv);
			    			                }
			    			                if (jsonObject.has("ecpm")) {
			    			                    String ecpm = jsonObject.getString("ecpm");
			    			                    taobaoZsAdvertiserTargetDayEntry.setEcpm(ecpm);
			    			                }
			    			                if (jsonObject.has("log_date")) {
			    			                    String log_date = jsonObject.getString("log_date");
			    			                    taobaoZsAdvertiserTargetDayEntry.setLog_date(log_date.substring(0, 10));
			    			                }
			    			                if (jsonObject.has("inshop_item_col_num")) {
			    			                    String inshop_item_col_num = jsonObject.getString("inshop_item_col_num");
			    			                    taobaoZsAdvertiserTargetDayEntry.setInshop_item_col_num(inshop_item_col_num);
			    			                }
			    			                if (jsonObject.has("ecpc")) {
			    			                    String ecpc = jsonObject.getString("ecpc");
			    			                    taobaoZsAdvertiserTargetDayEntry.setEcpc(ecpc);
			    			                }
			    			                if (jsonObject.has("adgroup_id")) {
			    			                    String adgroup_id1 = jsonObject.getString("adgroup_id");
			    			                    taobaoZsAdvertiserTargetDayEntry.setAdgroup_id(adgroup_id1);
			    			                }
			    			                if (jsonObject.has("adgroup_name")) {
			    			                    String adgroup_name = jsonObject.getString("adgroup_name");
			    			                    taobaoZsAdvertiserTargetDayEntry.setAdgroup_name(adgroup_name);
			    			                }
			    			                
			    			                if (jsonObject.has("target_name")) {
			    			                    String target_name = jsonObject.getString("target_name");
			    			                    taobaoZsAdvertiserTargetDayEntry.setTarget_name(target_name);
			    			                }else{
			    			                	taobaoZsAdvertiserTargetDayEntry.setTarget_name("");
			    			                }
			    			                
			    			                if (jsonObject.has("target_id")) {
			    			                    String target_id1 = jsonObject.getString("target_id");
			    			                    taobaoZsAdvertiserTargetDayEntry.setTarget_id(target_id1);
			    			                    if (target_id1.equals("-2")) {
			    			                        taobaoZsAdvertiserTargetDayEntry.setTarget_name("系统托管定向包");
			    			                    }
			    			                }
			    			                taobaoZsAdvertiserTargetDayEntry.setTaobao_user_id(user_id);
			    			                taobaoZsAdvertiserTargetDayEntry.setEffect(effect0);
			    			                taobaoZsAdvertiserTargetDayEntry.setEffect_type(effect_type0);
			    			                taobaoZsAdvertiserTargetDayEntry.setCampaign_model(campaign_model);
			    			                taobaoZsAdvertiserTargetDayEntry.setLast_update_time(new Date());
			    			                taobaoZsAdvertiserTargetDayEntry.setLast_update_status("成功");
			    			                taobaoZsAdvertiserTargetDayEntryList.add(taobaoZsAdvertiserTargetDayEntry);
			    			             }
			    			        }else{
			    			             LogUtils.logInfo("返回异常数据(不存在data):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
			    			        }
			    			   }else{
			    			        LogUtils.logInfo("返回异常数据(不存在target_offline_rpt_days_list):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
			    			   }
			    			}else{
			    				LogUtils.logInfo("返回异常数据(不存在zuanshi_advertiser_target_rpts_day_get_response):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
			    			}
			    		}else{
			    			LogUtils.logInfo("taobao.zuanshi.advertiser.target.rpts.day.get返回数据为null"+"******"+"请求参数为:"+gson.toJson(req));
			    		}
	                }
	            }
			}
		}
		
		taobaoZsAdvertiserTargetDayEntryDao.insertOrUpdateTaobaoZsAdvertiserTargetDayEntryList(taobaoZsAdvertiserTargetDayEntryList);
		LogUtils.logInfo("**************同步定向分日数据结束     总记录条数为"+taobaoZsAdvertiserTargetDayEntryList.size()+"*************");
	}

	//批量同步定向分日数据
	public void sync_batchtargetday(String call_people,String user_id, int day, String sessionkey) {
	
		LogUtils.logInfo("**************批量同步定向分日数据开始     用户id:["+user_id+"] day:["+day+"] 密钥:["+sessionkey+"]】*************");
		List<TaobaoZsAdvertiserTargetTotalEntry> taobaoZsAdvertiserTargetTotalEntryList = taobaoZsAdvertiserTargetTotalEntryDao.getTotalTargetByUserID(user_id);
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
     	
     	List<ZuanshiAdvertiserTargetRptsDayGetRequest> requestlist = new ArrayList<ZuanshiAdvertiserTargetRptsDayGetRequest>();
     	for(TaobaoZsAdvertiserTargetTotalEntry taobaoZsAdvertiserTargetTotalEntry:taobaoZsAdvertiserTargetTotalEntryList){
     		Long campaign_id = Long.parseLong(taobaoZsAdvertiserTargetTotalEntry.getCampaign_id());
	        Long adgroup_id = Long.parseLong(taobaoZsAdvertiserTargetTotalEntry.getAdgroup_id());
	        Long target_id = Long.parseLong(taobaoZsAdvertiserTargetTotalEntry.getTarget_id());
	        Long campaign_model = taobaoZsAdvertiserTargetTotalEntry.getCampaign_model();
     		for (Long effect0 : effect) {
         		for (String effect_type0 : effect_type) {
         			ZuanshiAdvertiserTargetRptsDayGetRequest req = new ZuanshiAdvertiserTargetRptsDayGetRequest ();
         			req.setStartTime(start_time);
         		 	req.setEndTime(end_time);
         		 	req.setCampaignId(campaign_id);
        	        req.setAdgroupId(adgroup_id);
        	        req.setTargetId(target_id);
        	        req.setCampaignModel(campaign_model);
        	        req.setEffect(effect0);
                	req.setEffectType(effect_type0);
                	requestlist.add(req);
         		}
     		}
     	}
     	
     	
     	Long aa = 0L;
     	Long bb = 0L;
     	
     	List<List<ZuanshiAdvertiserTargetRptsDayGetRequest>> tempList= ListUtils.createList(requestlist, 20);
		for(List<ZuanshiAdvertiserTargetRptsDayGetRequest> list:tempList){
			
			TaobaoBatchRequest batchRequest = new TaobaoBatchRequest();
			for(ZuanshiAdvertiserTargetRptsDayGetRequest req:list){
				batchRequest.addRequest(req);
			}
			TaobaoBatchResponse response = null;
			aa = System.currentTimeMillis();
			System.out.println(aa-bb);
	     	try {
				 response = batchTaobaoClient.execute(batchRequest,sessionkey);
			} catch (ApiException e) {
				LogUtils.logException(e);
			}
	     	bb = System.currentTimeMillis();
	     	if (response.isSuccess()) {
	     		List<TaobaoZsAdvertiserTargetDayEntry> taobaoZsAdvertiserTargetDayEntryList = new ArrayList<TaobaoZsAdvertiserTargetDayEntry>();
	            for (int k = 0; k < response.getResponseList().size(); k++){
	            	JSONObject obj1 = new JSONObject(response.getResponseList().get(k).getBody());
    				if (obj1.has("zuanshi_advertiser_target_rpts_day_get_response")) {
    					JSONObject obj2 = obj1.getJSONObject("zuanshi_advertiser_target_rpts_day_get_response");
    			        if (obj2.has("target_offline_rpt_days_list")) {
    			            JSONObject obj3 = obj2.getJSONObject("target_offline_rpt_days_list");
    			            if (obj3.has("data")) {
    			               JSONArray obj4 = obj3.getJSONArray("data");
    			                	for (int i = 0; i < obj4.length(); i++) {
    			                    	TaobaoZsAdvertiserTargetDayEntry taobaoZsAdvertiserTargetDayEntry = new TaobaoZsAdvertiserTargetDayEntry();
    			                        JSONObject jsonObject = obj4.getJSONObject(i);
    			                        if (jsonObject.has("ctr")) {
    			                            String ctr = jsonObject.getString("ctr");
    			                            taobaoZsAdvertiserTargetDayEntry.setCtr(ctr);
    			                        }
    			                        if (jsonObject.has("cvr")) {
    			                            String cvr = jsonObject.getString("cvr");
    			                            taobaoZsAdvertiserTargetDayEntry.setCvr(cvr);
    			                        }
    			                        if (jsonObject.has("uv")) {
    			                            String uv = jsonObject.getString("uv");
    			                            taobaoZsAdvertiserTargetDayEntry.setUv(uv);
    			                        }
    			                        if (jsonObject.has("avg_access_time")) {
    			                            String avg_access_time = jsonObject.getString("avg_access_time");
    			                            taobaoZsAdvertiserTargetDayEntry.setAvg_access_time(avg_access_time);
    			                        }
    			                        if (jsonObject.has("campaign_id")) {
    			                            String campaign_id1 = jsonObject.getString("campaign_id");
    			                            taobaoZsAdvertiserTargetDayEntry.setCampaign_id(campaign_id1);
    			                        }
    			                        if (jsonObject.has("campaign_name")) {
    			                            String campaign_name = jsonObject.getString("campaign_name");
    			                            taobaoZsAdvertiserTargetDayEntry.setCampaign_name(campaign_name);
    			                        }
    			                        if (jsonObject.has("charge")) {
    			                            String charge = jsonObject.getString("charge");
    			                            taobaoZsAdvertiserTargetDayEntry.setCharge(charge);
    			                        }
    			                        if (jsonObject.has("alipay_inshop_amt")) {
    			                             String alipay_inshop_amt = jsonObject.getString("alipay_inshop_amt");
    			                             taobaoZsAdvertiserTargetDayEntry.setAlipay_inshop_amt(alipay_inshop_amt);
    			                        }
    			                        if (jsonObject.has("alipay_in_shop_num")) {
    			                             String alipay_in_shop_num = jsonObject.getString("alipay_in_shop_num");
    			                             taobaoZsAdvertiserTargetDayEntry.setAlipay_in_shop_num(alipay_in_shop_num);
    			                        }
    			                        if (jsonObject.has("ad_pv")) {
    			                             String ad_pv = jsonObject.getString("ad_pv");
    			                             taobaoZsAdvertiserTargetDayEntry.setAd_pv(ad_pv);
    			                        }
    			                        if (jsonObject.has("avg_access_page_num")) {
    			                             String avg_access_page_num = jsonObject.getString("avg_access_page_num");
    			                             taobaoZsAdvertiserTargetDayEntry.setAvg_access_page_num(avg_access_page_num);
    			                        }
    			                        if (jsonObject.has("dir_shop_col_num")) {
    			                             String dir_shop_col_num = jsonObject.getString("dir_shop_col_num");
    			                             taobaoZsAdvertiserTargetDayEntry.setDir_shop_col_num(dir_shop_col_num);
    			                        }
    			                        if (jsonObject.has("gmv_inshop_num")) {
    			                             String gmv_inshop_num = jsonObject.getString("gmv_inshop_num");
    			                             taobaoZsAdvertiserTargetDayEntry.setGmv_inshop_num(gmv_inshop_num);
    			                        }
    			                        if (jsonObject.has("click")) {
    			                             String click = jsonObject.getString("click");
    			                             taobaoZsAdvertiserTargetDayEntry.setClick(click);
    			                        }

    			                        if (jsonObject.has("roi")) {
    			                             String roi = jsonObject.getString("roi");
    			                             taobaoZsAdvertiserTargetDayEntry.setRoi(roi);
    			                        }
    			                        if (jsonObject.has("gmv_inshop_amt")) {
    			                             String gmv_inshop_amt = jsonObject.getString("gmv_inshop_amt");
    			                             taobaoZsAdvertiserTargetDayEntry.setGmv_inshop_amt(gmv_inshop_amt);
    			                        }
    			                        if (jsonObject.has("cart_num")) {
    			                             String cart_num = jsonObject.getString("cart_num");
    			                             taobaoZsAdvertiserTargetDayEntry.setCart_num(cart_num);
    			                        }
    			                        if (jsonObject.has("deep_inshop_uv")) {
    			                             String deep_inshop_uv = jsonObject.getString("deep_inshop_uv");
    			                             taobaoZsAdvertiserTargetDayEntry.setDeep_inshop_uv(deep_inshop_uv);
    			                        }
    			                        if (jsonObject.has("ecpm")) {
    			                             String ecpm = jsonObject.getString("ecpm");
    			                             taobaoZsAdvertiserTargetDayEntry.setEcpm(ecpm);
    			                        }
    			                        if (jsonObject.has("log_date")) {
    			                             String log_date = jsonObject.getString("log_date");
    			                             taobaoZsAdvertiserTargetDayEntry.setLog_date(log_date.substring(0, 10));
    			                        }
    			                        if (jsonObject.has("inshop_item_col_num")) {
    			                             String inshop_item_col_num = jsonObject.getString("inshop_item_col_num");
    			                             taobaoZsAdvertiserTargetDayEntry.setInshop_item_col_num(inshop_item_col_num);
    			                        }
    			                        if (jsonObject.has("ecpc")) {
    			                             String ecpc = jsonObject.getString("ecpc");
    			                             taobaoZsAdvertiserTargetDayEntry.setEcpc(ecpc);
    			                        }
    			                        if (jsonObject.has("adgroup_id")) {
    			                             String adgroup_id1 = jsonObject.getString("adgroup_id");
    			                             taobaoZsAdvertiserTargetDayEntry.setAdgroup_id(adgroup_id1);
    			                        }
    			                        if (jsonObject.has("adgroup_name")) {
    			                             String adgroup_name = jsonObject.getString("adgroup_name");
    			                             taobaoZsAdvertiserTargetDayEntry.setAdgroup_name(adgroup_name);
    			                        }
    			                        if (jsonObject.has("target_name")) {
    			                             String target_name = jsonObject.getString("target_name");
    			                             taobaoZsAdvertiserTargetDayEntry.setTarget_name(target_name);
    			                        }
    			                        if (jsonObject.has("target_id")) {
    			                             String target_id1 = jsonObject.getString("target_id");
    			                             taobaoZsAdvertiserTargetDayEntry.setTarget_id(target_id1);
    			                             if (target_id1.equals("-2")) {
    			                            	 taobaoZsAdvertiserTargetDayEntry.setTarget_name("系统托管定向包");
    			                             }
    			                        }
    			                        
    			                        taobaoZsAdvertiserTargetDayEntry.setTaobao_user_id(user_id);
    			                        taobaoZsAdvertiserTargetDayEntry.setEffect(list.get(k).getEffect());
    			                        taobaoZsAdvertiserTargetDayEntry.setEffect_type(list.get(k).getEffectType());
    			                        taobaoZsAdvertiserTargetDayEntry.setCampaign_model(list.get(k).getCampaignModel());
    			                        taobaoZsAdvertiserTargetDayEntry.setLast_update_time(new Date());
    			                        taobaoZsAdvertiserTargetDayEntry.setLast_update_status("成功");
    			                        taobaoZsAdvertiserTargetDayEntryList.add(taobaoZsAdvertiserTargetDayEntry);
    			                  }
    			             }
    			        }
    				}else{
    					LogUtils.logInfo("定向分日同步异常,返回数据为"+response.getResponseList().get(k).getBody());
    				}
	            }
	            taobaoZsAdvertiserTargetDayEntryDao.insertOrUpdateTaobaoZsAdvertiserTargetDayEntryList(taobaoZsAdvertiserTargetDayEntryList);
	     	
	     	}else{
	     		LogUtils.logInfo("定向分日批量同步同步异常"+response.getBody());
	     	}
	     	
		}
		
		LogUtils.logInfo("**************同步定向分日数据结束   *************");
	}
	
	
	//处理定向分日数据
	public void sync_targetdaysum(String call_poeple,String user_id, int day, String sessionkey) {
		LogUtils.logInfo("**************处理定向分日数据开始     用户id:["+user_id+"] day:["+day+"] 密钥:["+sessionkey+"]】*************");
        Date dNow = new Date();
        Calendar calendar = Calendar.getInstance();
        calendar.setTime(dNow);
        calendar.add(Calendar.DAY_OF_MONTH, -day);
        dNow=calendar.getTime();
        SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd 00:00:00");
        String start_time = sdf.format(dNow);
        TaobaoZsAdvertiserTargetDayEntry taobaoZsAdvertiserTargetDayEntry=new TaobaoZsAdvertiserTargetDayEntry();
        taobaoZsAdvertiserTargetDayEntry.setTaobao_user_id(user_id);
        taobaoZsAdvertiserTargetDayEntry.setLog_date(start_time);
        List<TaobaoZsAdvertiserTargetDaySumEntry> taobaoZsAdvertiserTargetDaySumEntryList = taobaoZsAdvertiserTargetDaySumEntryDao.getTargetDaySumEntryListByUseridAndDate(taobaoZsAdvertiserTargetDayEntry);
        taobaoZsAdvertiserTargetDaySumEntryDao.insertOrUpdateTaobaoZsAdvertiserTargetDaySumEntryList(taobaoZsAdvertiserTargetDaySumEntryList);
        LogUtils.logInfo("**************处理定向分日数据结束     用户id:["+user_id+"] day:["+day+"] 密钥:["+sessionkey+"]】*************");
	}


	/*
	 * //生成异步下载任务ID
	 * (non-Javadoc)
	 * @see com.huonu.service.EntrieService#sync_task(int, java.lang.String)
	 */
	public void sync_rptsdownloadtask(String call_people,String user_id,int day, String sessionkey) {
		
		LogUtils.logInfo("**************生成异步下载任务ID开始     用户id:["+user_id+"] day:["+day+"] 密钥:["+sessionkey+"]】*************");
		List<TaobaoAsyncTaskEntry> taobaoAsyncTaskEntryList=new ArrayList<TaobaoAsyncTaskEntry>();
        List<String> effect_type = new ArrayList<String>();
        effect_type.add("impression");
        effect_type.add("click");
        List<String> hierarchy = new ArrayList<String>();
        hierarchy.add("campaign");
        hierarchy.add("adgroup");
        hierarchy.add("creative");
        hierarchy.add("target");
        hierarchy.add("adzone");
//        hierarchy.add("targetAdzone");
        List<Long> campaign_model = new ArrayList<Long>();
        campaign_model.add(1L);
        campaign_model.add(4L);
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
        ZuanshiAdvertiserRptsDownloadDayGetRequest req = new ZuanshiAdvertiserRptsDownloadDayGetRequest();
    	ZuanshiAdvertiserRptsDownloadDayGetResponse rsp = null;
    	req.setEndTime(end_time);
    	req.setStartTime(start_time);
        for(String effect_type0:effect_type){
            for(String hierarchy0:hierarchy){
                for(Long campaign_model0:campaign_model){
                	req.setEffectType(effect_type0);
                	req.setCampaignModel(campaign_model0);
                	req.setHierarchy(hierarchy0);
                	rsp = apiCallService.call(req,sessionkey, call_people,"taobao.zuanshi.advertiser.rpts.download.day.get");
                	
	          		if(rsp!=null){
	          			JSONObject obj1 = new JSONObject(rsp.getBody());
	          			if (obj1.has("zuanshi_advertiser_rpts_download_day_get_response")) {
	          				JSONObject obj2 = obj1.getJSONObject("zuanshi_advertiser_rpts_download_day_get_response");
	          	            if (obj2.has("result")) {
	          	            	TaobaoAsyncTaskEntry taobaoAsyncTask=new TaobaoAsyncTaskEntry();
	          	            	JSONObject obj3 = obj2.getJSONObject("result");
	          	                Long task_id = obj3.getLong("task_id");
	          	                String created=obj3.getString("created");
	          	                String check_code=obj3.getString("check_code");
	          	                Pattern pattern = Pattern.compile("result:truenick:(.*?) msg");
	          	                Matcher matcher = pattern.matcher(check_code);
	          	                while (matcher.find()) {
	                              String userName=matcher.group(1);
	                              taobaoAsyncTask.setUserName(userName);
	          	                }
	          	                taobaoAsyncTask.setTaskId(task_id);
	          	                taobaoAsyncTask.setCreatTime(created);
	          	                taobaoAsyncTask.setTaobaoUserId(user_id);
	          	                taobaoAsyncTask.setStartDate(start_time);
	          	                taobaoAsyncTask.setEndDate(end_time);
	                          	taobaoAsyncTask.setCampModel(campaign_model0);
	                          	taobaoAsyncTask.setEffectType(effect_type0);
	                          	taobaoAsyncTask.setHierarchy(hierarchy0);
	                          	taobaoAsyncTask.setTaskStatus("new");
	                          	taobaoAsyncTaskEntryList.add(taobaoAsyncTask);
	          	            }else{
	          	            	LogUtils.logInfo("返回异常数据(不存在result):"+rsp.getBody());
	          	            }
	          			}else{
	          				LogUtils.logInfo("返回异常数据:"+rsp.getBody());
	          			}
	          		}else{
	          			LogUtils.logInfo("taobao.zuanshi.advertiser.rpts.download.day.get返回数据为null");
	          		}
                }
            }   
        }
        
        taobaoAsyncTaskEntryDao.insertOrUpdateTaobaoAsyncTaskEntryList(taobaoAsyncTaskEntryList);
        LogUtils.logInfo("**************生成异步下载任务ID结束    总记录条数为"+taobaoAsyncTaskEntryList.size()+"*************");
	}
	

}
