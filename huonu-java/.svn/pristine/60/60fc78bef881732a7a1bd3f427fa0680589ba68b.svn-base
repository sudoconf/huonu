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
import com.huonu.domain.dao.TaobaoZsAdvertiserAdgroupDayEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserAdzoneTotalEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserCampDayEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserCreativeTotalEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserTargetTotalEntryDao;
import com.huonu.domain.dao.TaobaoZsTargetEntryDao;
import com.huonu.domain.model.TaobaoAsyncTaskEntry;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZsAdgroupEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserAdzoneTotalEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserCreativeTotalEntry;
import com.huonu.domain.model.TaobaoZsCampEntry;
import com.huonu.domain.model.TaobaoZsTargetEntry;
import com.huonu.service.ApiCallService;
import com.huonu.service.CampService;
import com.huonu.service.EntrieService;
import com.huonu.service.GroupService;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.request.ZuanshiAdvertiserAdzoneRptsTotalGetRequest;
import com.taobao.api.request.ZuanshiAdvertiserCreativeRptsTotalGetRequest;
import com.taobao.api.request.ZuanshiAdvertiserRptsDownloadDayGetRequest;
import com.taobao.api.request.ZuanshiBannerCrowdFindRequest;
import com.taobao.api.response.ZuanshiAdvertiserAdzoneRptsTotalGetResponse;
import com.taobao.api.response.ZuanshiAdvertiserCreativeRptsTotalGetResponse;
import com.taobao.api.response.ZuanshiAdvertiserRptsDownloadDayGetResponse;
import com.taobao.api.response.ZuanshiBannerCrowdFindResponse;

@Service("entrieService")
public class EntrieServiceImpl implements EntrieService{

	@Autowired
	private ApiCallService apiCallService;
	
	@Autowired
	private TaobaoZsTargetEntryDao taobaoZsTargetEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserTargetTotalEntryDao taobaoZsAdvertiserTargetTotalEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserCampDayEntryDao taobaoZsAdvertiserCampDayEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserAdgroupDayEntryDao taobaoZsAdvertiserAdgroupDayEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserCreativeTotalEntryDao taobaoZsAdvertiserCreativeTotalEntryDao;
	
	@Autowired
	private TaobaoZsAdvertiserAdzoneTotalEntryDao taobaoZsAdvertiserAdzoneTotalEntryDao;
	
	@Autowired
	private TaobaoAsyncTaskEntryDao taobaoAsyncTaskEntryDao;
	
	@Autowired
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	@Autowired
	private CampService campService;
	
	@Autowired
	private GroupService groupService;
	
	
	public void sync_all(String call_poeple,String user_id, int day) {
		
		//获取原来的用户信息
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		String sessionkey = taobaoAuthorizeUser.getAccess_token();
		
		//删除一个店铺下所有的计划
		campService.deleteZsCampByUserId(user_id);
		
		//同步一个店家的所有钻展计划
		campService.sync_camplist(call_poeple,user_id, null,sessionkey);
		
		//删除店铺所有的单元
		groupService.deleteAdgroupEntryByUserid(user_id);
		
		//获取一个店家下的所有计划id
		List<TaobaoZsCampEntry> taobaoZsCampEntryList =  campService.getTaobaoZsCampEntryListByUserId(user_id);
		for(TaobaoZsCampEntry taobaoZsCampEntry:taobaoZsCampEntryList){
			//同步计划id下的所有单元
			groupService.sync_group(call_poeple,user_id,taobaoZsCampEntry.getId(),null,sessionkey);
		}
		
		
		//删除店铺下所有的定向
		taobaoZsTargetEntryDao.deleteZsTargetByUserId(user_id);
		
		//获取一个店家下的所有单元
		List<TaobaoZsAdgroupEntry> taobaoZsAdgroupEntryList =  groupService.getTaobaoZsAdgroupEntryByUserId(user_id);
		for(TaobaoZsAdgroupEntry taobaoZsAdgroupEntry :taobaoZsAdgroupEntryList){
			//获取单元下的所有定向
			sync_target(call_poeple,user_id,taobaoZsAdgroupEntry,sessionkey);
		}
		
		
		//计划分日
		campService.sync_campbyday(call_poeple,user_id,day,sessionkey);
		//单元分日
		groupService.sync_adgroupbyday(call_poeple,user_id,day,sessionkey);
		//创意多日汇总
		//sync_creativetotal(call_poeple,user_id,sessionkey);
		//资源位多日汇总
		//sync_adzonetotal(call_poeple,user_id, sessionkey);
		//生成异步下载任务ID
		sync_rptsdownloadtask(call_poeple,user_id,day, sessionkey);
		
	}
	

	/*
	 * 获取一个单元下的所有定向
	 * (non-Javadoc)
	 * @see com.huonu.service.EntrieService#sync_target(java.lang.String)
	 */
	public void sync_target(String call_people,String user_id,TaobaoZsAdgroupEntry taobaoZsAdgroupEntry,String sessionkey) {
		LogUtils.logInfo("**************同步一个单元下的所有定向开始    【 用户id:["+user_id+"]  密钥:["+sessionkey+"]】*************");
		List<TaobaoZsTargetEntry> taobaoZsTargetEntryList = new ArrayList<TaobaoZsTargetEntry>();
		ZuanshiBannerCrowdFindRequest req = new ZuanshiBannerCrowdFindRequest();
		ZuanshiBannerCrowdFindResponse rsp = null;
		
		req.setCampaignId(taobaoZsAdgroupEntry.getCampaign_id());
		req.setAdgroupId(taobaoZsAdgroupEntry.getAdgroup_id());
		req.setPageSize(1L);
		
		
		rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.banner.crowd.find");
		
		if(rsp!=null){
			//LogUtils.logInfo("同步一个单元下的所有定向-ZuanshiBannerCrowdFindResponse请求返回数据: "+rsp.getBody());
			JSONObject obj0 = new JSONObject(rsp.getBody());
			if(obj0.has("zuanshi_banner_crowd_find_response")){
				JSONObject obj = obj0.getJSONObject("zuanshi_banner_crowd_find_response").getJSONObject("result");
				if(obj.has("total_count")) {
					long totalNum = obj.getLong("total_count");
					if (totalNum != 0) {
						long pageNum;
						if (totalNum <= 200 & totalNum > 0) {
		                    pageNum = 1L;
		                } else {
		                    pageNum = totalNum / 200 + 1;
		                }
						
						for (int i = 0; i < pageNum; i++) {
							req.setPageSize(200L);
							req.setPageNum(i + 1L);

							rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.banner.crowd.find");;
							if(rsp!=null){
								JSONObject obj1 = new JSONObject(rsp.getBody());
									
								if(obj1.has("zuanshi_banner_crowd_find_response")){
									JSONObject obj4 = obj1.getJSONObject("zuanshi_banner_crowd_find_response").getJSONObject("result").getJSONObject("crowds");
									//JSONObject obj3 = obj2.getJSONObject("result");
									//JSONObject obj4 = obj3.getJSONObject("crowds");
									JSONArray obj5 = obj4.getJSONArray("crowd_d_t_o");
									for (int j = 0; j < obj5.length(); j++) {
										JSONObject jsonObject = obj5.getJSONObject(j);
										Long adgroup_id = jsonObject.getLong("adgroup_id");
										Long campaign_id = jsonObject.getLong("campaign_id");
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
										taobaoZsTargetEntry.setAdgroup_id(adgroup_id);
										taobaoZsTargetEntry.setCampaign_id(campaign_id);
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
									LogUtils.logInfo("返回异常数据:"+rsp.getBody());
								}
							}else{
								LogUtils.logInfo("taobao.zuanshi.banner.crowd.find返回数据为null");
							}
							
						}
					}
				}
			}else{
				LogUtils.logInfo("返回异常数据:"+rsp.getBody());
			}
		}else{
			LogUtils.logInfo("taobao.zuanshi.banner.crowd.find返回数据为null");
		}
		
		taobaoZsTargetEntryDao.insertOrUpdateTaobaoZsTargetEntrylist(taobaoZsTargetEntryList);
		LogUtils.logInfo("**************同步一个单元下的所有定向结束   总记录条数为"+taobaoZsTargetEntryList.size()+"*************");
	}

	
	/*
	 * 同步创意多日汇总
	 * (non-Javadoc)
	 * @see com.huonu.service.EntrieService#sync_creativetotal(java.lang.String, java.lang.String)
	 */
	public void sync_creativetotal(String call_people,String user_id, String sessionkey) {
		LogUtils.logInfo("**************创意多日汇总同步开始    【 用户id:["+user_id+"] 密钥:["+sessionkey+"]】*************");
		List<TaobaoZsAdvertiserCreativeTotalEntry> taobaoZsAdvertiserCreativeTotalEntryList = new ArrayList<TaobaoZsAdvertiserCreativeTotalEntry>();
		List<Long> effect = new ArrayList<Long>();
	    effect.add(3L);
//	    effect.add(7L);
//	    effect.add(15L);
	    List<Long> campaign_model = new ArrayList<Long>();
	    campaign_model.add(1L);
	    campaign_model.add(4L);
	    List<String> effect_type = new ArrayList<String>();
	    effect_type.add("impression");
//	    effect_type.add("click");
	    Date dNow = new Date();
	    Calendar calendar = Calendar.getInstance();
	    calendar.setTime(dNow);
	    calendar.add(Calendar.DAY_OF_MONTH, -1);
	    Calendar calendar0 = Calendar.getInstance();
	    calendar0.setTime(dNow);
	    calendar0.add(Calendar.DAY_OF_MONTH, -81);
	    dNow = calendar.getTime();
	    Date dBefore = calendar0.getTime();
	    SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");
	    String start_time = sdf.format(dBefore);
	    String end_time = sdf.format(dNow);
	    ZuanshiAdvertiserCreativeRptsTotalGetRequest req = new ZuanshiAdvertiserCreativeRptsTotalGetRequest ();
		ZuanshiAdvertiserCreativeRptsTotalGetResponse rsp = null;
		req.setEndTime(end_time);
		req.setStartTime(start_time);
	    for (Long effect0 : effect) {
            for (Long campaign_model0 : campaign_model) {
            	 for (String effect_type0 : effect_type) {
            		 Boolean continue_flag = true;
            		 int i = 0;
            		 while(continue_flag && i <= 10){
	            		 
	            		 req.setEffect(effect0);
	            		 req.setEffectType(effect_type0);
	            		 req.setOffset(200L*i);
	            		 req.setPageSize(200L);
	            		 req.setCampaignModel(campaign_model0);
	            		 rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.advertiser.creative.rpts.total.get");
	            		 
	          			 if(rsp!=null){
	          				 //LogUtils.logInfo("创意多日汇总同步-ZuanshiAdvertiserCreativeRptsTotalGetResponse请求返回数据: "+rsp.getBody());
	          				 JSONObject obj1 = new JSONObject(rsp.getBody());
	          				 if(obj1.has("zuanshi_advertiser_creative_rpts_total_get_response")) {
	          					JSONObject obj2 = obj1.getJSONObject("zuanshi_advertiser_creative_rpts_total_get_response");
	          		            if (obj2.has("creative_offline_rpt_total_list")) {
	          		            	JSONObject obj3 = obj2.getJSONObject("creative_offline_rpt_total_list");
	          		                if (obj3.has("data")) {
	          		                	JSONArray obj4 = obj3.getJSONArray("data");
	          		                    int listNum=obj4.length();
	          		                    //若返回记录少于200条，说明调用完毕
	          		                    if(listNum<200){
	          		                    	continue_flag = false;
	          		                    }
	          		                    for (int k = 0; k <listNum; k++) {
	          		                    	TaobaoZsAdvertiserCreativeTotalEntry taobaoZsAdvertiserCreativeTotalEntry = new TaobaoZsAdvertiserCreativeTotalEntry();
	          		                        JSONObject jsonObject = obj4.getJSONObject(k);
	          		                        if (jsonObject.has("ctr")) {
	          		                        	String ctr = jsonObject.getString("ctr");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setCtr(ctr);
	          		                        }
	          		                        if (jsonObject.has("cvr")) {
	          		                        	String cvr = jsonObject.getString("cvr");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setCvr(cvr);
	          		                        }
	          		                        if (jsonObject.has("uv")) {
	          		                        	String uv = jsonObject.getString("uv");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setUv(uv);
	          		                        }
	          		                        if (jsonObject.has("avg_access_time")) {
	          		                        	String avg_access_time = jsonObject.getString("avg_access_time");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setAvg_access_time(avg_access_time);
	          		                        	}
	          		                        if (jsonObject.has("campaign_id")) {
	          		                        	String campaign_id = jsonObject.getString("campaign_id");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setCampaign_id(campaign_id);
	          		                        }
	          		                        if (jsonObject.has("campaign_name")) {
	          		                        	String campaign_name = jsonObject.getString("campaign_name");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setCampaign_name(campaign_name);
	          		                        }
	          		                        if (jsonObject.has("charge")) {
	          		                        	String charge = jsonObject.getString("charge");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setCharge(charge);
	          		                        }
	          		                        if (jsonObject.has("alipay_inshop_amt")) {
	          		                        	String alipay_inshop_amt = jsonObject.getString("alipay_inshop_amt");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setAlipay_inshop_amt(alipay_inshop_amt);
	          		                        }
	          		                        if (jsonObject.has("alipay_in_shop_num")) {
	          		                        	String alipay_in_shop_num = jsonObject.getString("alipay_in_shop_num");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setAlipay_in_shop_num(alipay_in_shop_num);
	          		                        }
	          		                        if (jsonObject.has("ad_pv")) {
	          		                        	String ad_pv = jsonObject.getString("ad_pv");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setAd_pv(ad_pv);
	          		                        }
	          		                        if (jsonObject.has("avg_access_page_num")) {
	          		                        	String avg_access_page_num = jsonObject.getString("avg_access_page_num");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setAvg_access_page_num(avg_access_page_num);
	          		                        }
	          		                        if (jsonObject.has("dir_shop_col_num")) {
	          		                        	String dir_shop_col_num = jsonObject.getString("dir_shop_col_num");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setDir_shop_col_num(dir_shop_col_num);
	          		                        }
	          		                        if (jsonObject.has("gmv_inshop_num")) {
	          		                        	String gmv_inshop_num = jsonObject.getString("gmv_inshop_num");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setGmv_inshop_num(gmv_inshop_num);
	          		                        }
	          		                        if (jsonObject.has("click")) {
	          		                        	String click = jsonObject.getString("click");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setClick(click);
	          		                        }
	          		                        if (jsonObject.has("roi")) {
	          		                        	String roi = jsonObject.getString("roi");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setRoi(roi);
	          		                        }
	          		                        if (jsonObject.has("gmv_inshop_amt")) {
	          		                        	String gmv_inshop_amt = jsonObject.getString("gmv_inshop_amt");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setGmv_inshop_amt(gmv_inshop_amt);
	          		                        }
	          		                        if (jsonObject.has("cart_num")) {
	          		                        	String cart_num = jsonObject.getString("cart_num");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setCart_num(cart_num);
	          		                        }
	          		                        if (jsonObject.has("deep_inshop_uv")) {
	          		                        	String deep_inshop_uv = jsonObject.getString("deep_inshop_uv");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setDeep_inshop_uv(deep_inshop_uv);
	          		                        }
	          		                        if (jsonObject.has("ecpm")) {
	          		                        	String ecpm = jsonObject.getString("ecpm");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setEcpm(ecpm);
	          		                        }
	          		                        if (jsonObject.has("inshop_item_col_num")) {
	          		                        	String inshop_item_col_num = jsonObject.getString("inshop_item_col_num");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setInshop_item_col_num(inshop_item_col_num);
	          		                        }
	          		                        if (jsonObject.has("ecpc")) {
	          		                        	String ecpc = jsonObject.getString("ecpc");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setEcpc(ecpc);
	          		                        }
	          		                        if(jsonObject.has("adgroup_id")) {
	          		                        	String adgroup_id = jsonObject.getString("adgroup_id");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setAdgroup_id(adgroup_id);
	          		                        }
	          		                        if(jsonObject.has("adgroup_name")) {
	          		                        	String adgroup_name = jsonObject.getString("adgroup_name");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setAdgroup_name(adgroup_name);
	          		                        }
	          		                        if(jsonObject.has("creative_id")) {
	          		                        	String creative_id = jsonObject.getString("creative_id");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setCreative_id(creative_id);
	          		                        }
	          		                        if(jsonObject.has("creative_name")) {
	          		                        	String creative_name = jsonObject.getString("creative_name");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setCreative_name(creative_name);
	          		                        }
	          		                        if(jsonObject.has("img_url")) {
	          		                        	String img_url = jsonObject.getString("img_url");
	          		                        	taobaoZsAdvertiserCreativeTotalEntry.setImg_url(img_url);
	          		                        }
	          		                        taobaoZsAdvertiserCreativeTotalEntry.setTaobao_user_id(user_id);
	          		                        taobaoZsAdvertiserCreativeTotalEntry.setEffect(effect0);
	          		                        taobaoZsAdvertiserCreativeTotalEntry.setEffect_type(effect_type0);
	          		                        taobaoZsAdvertiserCreativeTotalEntry.setCampaign_model(campaign_model0);
	          		                        taobaoZsAdvertiserCreativeTotalEntry.setLast_update_time(new Date());
	          		                        taobaoZsAdvertiserCreativeTotalEntryList.add(taobaoZsAdvertiserCreativeTotalEntry);
	          		                    }
          		                	}else{
          		                		continue_flag=false;
          		                	}
          		                }else{
          		                	continue_flag=false;
          		                }
          		            }else{
          		            	continue_flag=false;
          		            }
          				 }else{
          					continue_flag=false;
          				 }
	          			 i++;
          			 }
            	 }
            }
	    }
	    taobaoZsAdvertiserCreativeTotalEntryDao.insertOrUpdateTaobaoZsAdvertiserCreativeTotalEntryList(taobaoZsAdvertiserCreativeTotalEntryList);
	    LogUtils.logInfo("**************创意多日汇总同步结束     总记录条数为"+taobaoZsAdvertiserCreativeTotalEntryList.size()+"*************");
	}

	
	/*
	 * 资源位多日汇总
	 * (non-Javadoc)
	 * @see com.huonu.service.EntrieService#sync_adzonetotal(java.lang.String, java.lang.String)
	 */
	public void sync_adzonetotal(String call_people,String user_id, String sessionkey) {
		LogUtils.logInfo("**************资源位多日汇总开始    【 用户id:["+user_id+"] 密钥:["+sessionkey+"]】*************");
		List<TaobaoZsAdvertiserAdzoneTotalEntry> taobaoZsAdvertiserAdzoneTotalEntryList = new ArrayList<TaobaoZsAdvertiserAdzoneTotalEntry>();
	    List<Long> effect = new ArrayList<Long>();
	    effect.add(3L);
//	    effect.add(7L);
//	    effect.add(15L);
	    List<Long> campaign_model = new ArrayList<Long>();
	    campaign_model.add(1L);
	    campaign_model.add(4L);
	    List<String> effect_type = new ArrayList<String>();
	    effect_type.add("impression");
//	    effect_type.add("click");
	    Date dNow = new Date();
	    Calendar calendar = Calendar.getInstance();
	    calendar.setTime(dNow);
	    calendar.add(Calendar.DAY_OF_MONTH, -1);
	    Calendar calendar0 = Calendar.getInstance();
	    calendar0.setTime(dNow);
	    calendar0.add(Calendar.DAY_OF_MONTH, -90);
	    dNow = calendar.getTime();
	    Date dBefore = calendar0.getTime();
	    SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");
	    String start_time = sdf.format(dBefore);
	    String end_time = sdf.format(dNow);
	    ZuanshiAdvertiserAdzoneRptsTotalGetRequest req = new ZuanshiAdvertiserAdzoneRptsTotalGetRequest();
		ZuanshiAdvertiserAdzoneRptsTotalGetResponse rsp = null;
		req.setEndTime(end_time);
		req.setStartTime(start_time);
	    for (Long effect0 : effect) {
	    	req.setEffect(effect0);
	    	for (Long campaign_model0 : campaign_model) {
	    		req.setCampaignModel(campaign_model0);
	    		for (String effect_type0 : effect_type) {
	    			req.setEffectType(effect_type0);
	    			Boolean continue_flag = true;
            		int i = 0;
            		while(continue_flag && i <= 10){
            			req.setOffset(200L*i);
            			req.setPageSize(200L);
            			rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.advertiser.adzone.rpts.total.get");
            			
 	          			if(rsp!=null){
 	          				//LogUtils.logInfo("资源位多日汇总同步-ZuanshiAdvertiserAdzoneRptsTotalGetResponse请求返回数据: "+rsp.getBody());
 	          				JSONObject obj1 = new JSONObject(rsp.getBody());
 	          				if(obj1.has("zuanshi_advertiser_adzone_rpts_total_get_response")) {
 	          					JSONObject obj2 = obj1.getJSONObject("zuanshi_advertiser_adzone_rpts_total_get_response");
 	          					if (obj2.has("adzone_offline_rpt_total_list")) {
 	          		            	JSONObject obj3 = obj2.getJSONObject("adzone_offline_rpt_total_list");
 	          		                if (obj3.has("data")) {
	 	          		                JSONArray obj4 = obj3.getJSONArray("data");
	 	          		                int listNum=obj4.length();
	 	          		                if(listNum<200){
	 	          		                continue_flag = false;
	 	          		                }
	 	          		                for (int k = 0; k <listNum; k++) {
	 	          		                	TaobaoZsAdvertiserAdzoneTotalEntry taobaoZsAdvertiserAdzoneTotalEntry = new TaobaoZsAdvertiserAdzoneTotalEntry();
	 	          		                	JSONObject jsonObject = obj4.getJSONObject(k);
	 	          	                        if (jsonObject.has("ctr")) {
	 	          	                            String ctr = jsonObject.getString("ctr");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setCtr(ctr);
	 	          	                        }
	 	          	                        if (jsonObject.has("cvr")) {
	 	          	                            String cvr = jsonObject.getString("cvr");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setCvr(cvr);
	 	          	                        }
	 	          	                        if (jsonObject.has("uv")) {
	 	          	                            String uv = jsonObject.getString("uv");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setUv(uv);
	 	          	                        }
	 	          	                        if (jsonObject.has("avg_access_time")) {
	 	          	                            String avg_access_time = jsonObject.getString("avg_access_time");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setAvg_access_time(avg_access_time);
	 	          	                        }
	 	          	                        if (jsonObject.has("campaign_id")) {
	 	          	                            String campaign_id = jsonObject.getString("campaign_id");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setCampaign_id(campaign_id);
	 	          	                        }
	 	          	                        if (jsonObject.has("campaign_name")) {
	 	          	                            String campaign_name = jsonObject.getString("campaign_name");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setCampaign_name(campaign_name);
	 	          	                        }
	 	          	                        if (jsonObject.has("charge")) {
	 	          	                            String charge = jsonObject.getString("charge");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setCharge(charge);
	 	          	                        }
	 	          	                        if (jsonObject.has("alipay_inshop_amt")) {
	 	          	                            String alipay_inshop_amt = jsonObject.getString("alipay_inshop_amt");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setAlipay_inshop_amt(alipay_inshop_amt);
	 	          	                        }
	 	          	                        if (jsonObject.has("alipay_in_shop_num")) {
	 	          	                            String alipay_in_shop_num = jsonObject.getString("alipay_in_shop_num");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setAlipay_in_shop_num(alipay_in_shop_num);
	 	          	                        }
	 	          	                        if (jsonObject.has("ad_pv")) {
	 	          	                            String ad_pv = jsonObject.getString("ad_pv");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setAd_pv(ad_pv);
	 	          	                        }
	 	          	                        if (jsonObject.has("avg_access_page_num")) {
	 	          	                            String avg_access_page_num = jsonObject.getString("avg_access_page_num");
	 	          	                         	taobaoZsAdvertiserAdzoneTotalEntry.setAvg_access_page_num(avg_access_page_num);
	 	          	                        }
	 	          	                        if (jsonObject.has("dir_shop_col_num")) {
	 	          	                            String dir_shop_col_num = jsonObject.getString("dir_shop_col_num");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setDir_shop_col_num(dir_shop_col_num);
	 	          	                        }
	 	          	                        if (jsonObject.has("gmv_inshop_num")) {
	 	          	                            String gmv_inshop_num = jsonObject.getString("gmv_inshop_num");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setGmv_inshop_num(gmv_inshop_num);
	 	          	                        }
	 	          	                        if (jsonObject.has("click")) {
	 	          	                            String click = jsonObject.getString("click");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setClick(click);
	 	          	                        }
	 	          	                        if (jsonObject.has("roi")) {
	 	          	                            String roi = jsonObject.getString("roi");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setRoi(roi);
	 	          	                        }
	 	          	                        if (jsonObject.has("gmv_inshop_amt")) {
	 	          	                            String gmv_inshop_amt = jsonObject.getString("gmv_inshop_amt");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setGmv_inshop_amt(gmv_inshop_amt);
	 	          	                        }
	 	          	                        if (jsonObject.has("cart_num")) {
	 	          	                            String cart_num = jsonObject.getString("cart_num");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setCart_num(cart_num);
	 	          	                        }
	 	          	                        if (jsonObject.has("deep_inshop_uv")) {
	 	          	                            String deep_inshop_uv = jsonObject.getString("deep_inshop_uv");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setDeep_inshop_uv(deep_inshop_uv);
	 	          	                        }
	 	          	                        if (jsonObject.has("ecpm")) {
	 	          	                            String ecpm = jsonObject.getString("ecpm");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setEcpm(ecpm);
	 	          	                        }
	 	          	                        if (jsonObject.has("inshop_item_col_num")) {
	 	          	                            String inshop_item_col_num = jsonObject.getString("inshop_item_col_num");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setInshop_item_col_num(inshop_item_col_num);
	 	          	                        }
	 	          	                        if (jsonObject.has("ecpc")) {
	 	          	                            String ecpc = jsonObject.getString("ecpc");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setEcpc(ecpc);
	 	          	                        }
	 	          	                        if(jsonObject.has("adgroup_id")) {
	 	          	                            String adgroup_id = jsonObject.getString("adgroup_id");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setAdgroup_id(adgroup_id);
	 	          	                        }
	 	          	                        if(jsonObject.has("adgroup_name")) {
	 	          	                            String adgroup_name = jsonObject.getString("adgroup_name");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setAdgroup_name(adgroup_name);
	 	          	                        }
	 	          	                        if(jsonObject.has("adzone_id")) {
	 	          	                            String adzone_id = jsonObject.getString("adzone_id");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setAdzone_id(adzone_id);
	 	          	                        }
	 	          	                        if(jsonObject.has("adzone_name")) {
	 	          	                            String adzone_name = jsonObject.getString("adzone_name");
	 	          	                            taobaoZsAdvertiserAdzoneTotalEntry.setAdzone_name(adzone_name);
	 	          	                        }
	 	          	                        taobaoZsAdvertiserAdzoneTotalEntry.setTaobao_user_id(user_id);
	 	          	                        taobaoZsAdvertiserAdzoneTotalEntry.setEffect(effect0);
	 	          	                        taobaoZsAdvertiserAdzoneTotalEntry.setEffect_type(effect_type0);
	 	          	                        taobaoZsAdvertiserAdzoneTotalEntry.setCampaign_model(campaign_model0);
	 	          	                        taobaoZsAdvertiserAdzoneTotalEntry.setLast_update_time(new Date()); 	
	 	          	                        taobaoZsAdvertiserAdzoneTotalEntryList.add(taobaoZsAdvertiserAdzoneTotalEntry);
	 	          		                }
 	          		                }else{
 	          		                	continue_flag=false;
 	          		                }
 	          		            }else{
 	          		            	continue_flag=false;
 	          		            }
 	          				 }else{
 	          					continue_flag=false; 
 	          				 }
 	          			 }else{
 	          				continue_flag=false;
 	          			 }
 	          			 i++;
            		 }
            		 
	    		 }
	          }
	     }
	    taobaoZsAdvertiserAdzoneTotalEntryDao.insertOrUpdateTaobaoZsAdvertiserAdzoneTotalEntryList(taobaoZsAdvertiserAdzoneTotalEntryList);
	    LogUtils.logInfo("**************资源位多日汇总结束     总记录条数为"+taobaoZsAdvertiserAdzoneTotalEntryList.size()+"*************");
	}

	
	/*
	 * //生成异步下载任务ID
	 * (non-Javadoc)
	 * @see com.huonu.service.EntrieService#sync_task(int, java.lang.String)
	 */
	public void sync_rptsdownloadtask(String call_people,String user_id,int day, String sessionkey) {
		LogUtils.logInfo("**************生成异步下载任务ID开始    【 用户id:["+user_id+"] 密钥:["+sessionkey+"]】*************");
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
//      hierarchy.add("targetAdzone");
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
        Gson gson = new Gson();
    	ZuanshiAdvertiserRptsDownloadDayGetResponse rsp = null;
    	req.setEndTime(end_time);
    	req.setStartTime(start_time);
        for(String effect_type0:effect_type){
        	req.setEffectType(effect_type0);
            for(String hierarchy0:hierarchy){
            	req.setHierarchy(hierarchy0);
                for(Long campaign_model0:campaign_model){
                	TaobaoAsyncTaskEntry taobaoAsyncTask=new TaobaoAsyncTaskEntry();
                	req.setCampaignModel(campaign_model0);
                	rsp = apiCallService.call(req, sessionkey, call_people, "taobao.zuanshi.advertiser.rpts.download.day.get");
	          		if(rsp!=null){
	          			//LogUtils.logInfo("生成异步下载任务ID-ZuanshiAdvertiserRptsDownloadDayGetResponse请求返回数据: "+rsp.getBody());
	          			JSONObject obj1 = new JSONObject(rsp.getBody());
	          			if (obj1.has("zuanshi_advertiser_rpts_download_day_get_response")) {
	          				JSONObject obj2 = obj1.getJSONObject("zuanshi_advertiser_rpts_download_day_get_response");
	          	            if (obj2.has("result")) {
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
	          	            	LogUtils.logInfo("返回异常数据(不存在result):"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
	          	            }
	          			}else{
	          				LogUtils.logInfo("返回异常数据:"+rsp.getBody()+"******"+"请求参数为:"+gson.toJson(req));
	          			}
	          		}else{
	          			LogUtils.logInfo("taobao.zuanshi.advertiser.rpts.download.day.get返回数据为null"+"******"+"请求参数为:"+gson.toJson(req));
	          		}
                }
            }   
        }
        taobaoAsyncTaskEntryDao.insertOrUpdateTaobaoAsyncTaskEntryList(taobaoAsyncTaskEntryList);
        LogUtils.logInfo("**************生成异步下载任务ID结束     总记录条数为"+taobaoAsyncTaskEntryList.size()+"*************");
	}

}