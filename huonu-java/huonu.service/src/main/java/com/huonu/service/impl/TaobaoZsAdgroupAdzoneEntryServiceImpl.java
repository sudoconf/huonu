package com.huonu.service.impl;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Map;

import org.json.JSONArray;
import org.json.JSONObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.dao.TaobaoZsAdgroupAdzoneEntryDao;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZsAdgroupAdzoneEntry;
import com.huonu.service.TaobaoZsAdgroupAdzoneEntryService;
import com.taobao.api.ApiException;
import com.taobao.api.TaobaoClient;
import com.taobao.api.request.ZuanshiBannerAdgroupAdzoneFindpageRequest;
import com.taobao.api.response.ZuanshiBannerAdgroupAdzoneFindpageResponse;

@Service("taobaoZsAdgroupAdzoneEntryService")
public class TaobaoZsAdgroupAdzoneEntryServiceImpl implements TaobaoZsAdgroupAdzoneEntryService{

	@Autowired 
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	@Autowired 
	private TaobaoZsAdgroupAdzoneEntryDao taobaoZsAdgroupAdzoneEntryDao;
	
	@Autowired
	private TaobaoClient taobaoClient;
	
	/*
	 * 同步更新单个淘宝店家的数据
	 * @see com.huonu.service.TaobaoZsAdgroupAdzoneEntryService#syncUpdateDataOne(java.util.Map)
	 */
	public void syncUpdateDataOne(Map<String, Object> conditions) {
		
		ZuanshiBannerAdgroupAdzoneFindpageRequest req = new ZuanshiBannerAdgroupAdzoneFindpageRequest();
		ZuanshiBannerAdgroupAdzoneFindpageResponse rsp = null;
		
		req.setCampaignId((Long)conditions.get("campagin_id"));
		req.setPageSize(1L);
		req.setAdgroupId((Long)conditions.get("adgroup_id"));
		
		//第一步根据条件获取数据 
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId((String)conditions.get("user_id"));
		String sessionKey = taobaoAuthorizeUser.getAccess_token();
		if(sessionKey==null||"".equals(sessionKey)){
			//这里抛出异常
			return;
		}
		
		try {
			rsp = taobaoClient.execute(req, sessionKey);
		} catch (ApiException e) {
			//写入日志文件
			e.printStackTrace();
		}
		
		JSONObject obj0 = new JSONObject(rsp.getBody());
		JSONObject obj = obj0.getJSONObject("zuanshi_banner_adgroup_adzone_findpage_response").getJSONObject("result");
	    if (!obj.has("message")){
	    	
	    	long totalNum = obj.getLong("total_count");
	        long pageNum;
	        if (totalNum <= 50) {
	           pageNum = 1L;
	        } else {
	           pageNum = totalNum / 50 + 1;
	        }
	        List<TaobaoZsAdgroupAdzoneEntry> advertiserlist = new ArrayList<TaobaoZsAdgroupAdzoneEntry>();
	        req.setPageSize(50L);
	    	
	        for (int i = 0; i < pageNum; i++) {
	        	
	        	req.setPageNum((long) (i + 1));
	        	try {
	    			rsp = taobaoClient.execute(req, sessionKey);
	    		} catch (ApiException e) {
	    			//写入日志文件
	    			e.printStackTrace();
	    		}
	        	JSONObject obj1 = new JSONObject(rsp.getBody());
                JSONObject obj2 = obj1.getJSONObject("zuanshi_banner_adgroup_adzone_findpage_response");
                JSONObject obj3 = obj2.getJSONObject("result");
                JSONObject obj4 = obj3.getJSONObject("adzones");
                if (obj4.has("adzone_bid_d_t_o")) {
                    JSONArray obj5 = obj4.getJSONArray("adzone_bid_d_t_o");
                    for (int k = 0; k < obj5.length(); k++) {
                        JSONObject jsonObject = obj5.getJSONObject(k);
                        long adzone_id = jsonObject.getLong("adzone_id");
                        long adzone_level = jsonObject.getLong("adzone_level");
                        String adzone_name = jsonObject.getString("adzone_name");
                        JSONObject adzone_size_list_Obj = jsonObject.getJSONObject("adzone_size_list");
                        JSONArray adzone_size_list_Array = adzone_size_list_Obj.getJSONArray("string");
                        String adzone_size_list = adzone_size_list_Array.toString();
                        JSONObject allow_ad_format_list_Obj = jsonObject.getJSONObject("allow_ad_format_list");
                        JSONArray allow_ad_format_list_Array = allow_ad_format_list_Obj.getJSONArray("number");
                        String allow_ad_format_list = allow_ad_format_list_Array.toString();
                        long allow_adv_type = jsonObject.getLong("allow_adv_type");
                        long media_type = jsonObject.getLong("media_type");
                        JSONObject matrix_price_list_Obj = jsonObject.getJSONObject("matrix_price_list");
                        JSONArray matrix_price_list_Array = matrix_price_list_Obj.getJSONArray("matrix_price_d_t_o");
                        for (int o = 0; o < matrix_price_list_Array.length(); o++) {
                            JSONObject jsonObject1 = matrix_price_list_Array.getJSONObject(o);
                            long crowd_id = jsonObject1.getLong("crowd_id");
                            long crowd_type = jsonObject1.getLong("crowd_type");
                            Double price = jsonObject1.getDouble("price");
                            TaobaoZsAdgroupAdzoneEntry taobaoZsAdgroupAdzoneEntry = new TaobaoZsAdgroupAdzoneEntry();
                            taobaoZsAdgroupAdzoneEntry.setTaobao_user_id((String)conditions.get("user_id"));
                            taobaoZsAdgroupAdzoneEntry.setCampaign_id((Long)conditions.get("campagin_id"));
                            taobaoZsAdgroupAdzoneEntry.setAdgroup_id((Long)conditions.get("adgroup_id"));
                            taobaoZsAdgroupAdzoneEntry.setAdzone_id(adzone_id);
                            taobaoZsAdgroupAdzoneEntry.setAdzone_level(adzone_level);
                            taobaoZsAdgroupAdzoneEntry.setAdzone_name(adzone_name);
                            taobaoZsAdgroupAdzoneEntry.setAdzone_size_list(adzone_size_list);
                            taobaoZsAdgroupAdzoneEntry.setAllow_ad_format_list(allow_ad_format_list);
                            taobaoZsAdgroupAdzoneEntry.setAllow_adv_type(allow_adv_type);
                            taobaoZsAdgroupAdzoneEntry.setCrowd_id(crowd_id);
                            taobaoZsAdgroupAdzoneEntry.setCrowd_type(crowd_type);
                            taobaoZsAdgroupAdzoneEntry.setPrice(price);
                            taobaoZsAdgroupAdzoneEntry.setMedia_type(media_type);
                            taobaoZsAdgroupAdzoneEntry.setLast_update_time(new Date());
                            advertiserlist.add(taobaoZsAdgroupAdzoneEntry);
                        }
                    }
                    taobaoZsAdgroupAdzoneEntryDao.insertOrUpdateAdvertiserList(advertiserlist);
                }
                
            }
	    	
	    	
	    }
		
		
		
	}

}
