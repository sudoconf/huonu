package com.huonu.service.impl;

import java.util.ArrayList;
import java.util.List;

import org.json.JSONArray;
import org.json.JSONObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.huonu.domain.dao.AreaEntryDao;
import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.model.AreaEntry;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.service.ApiCallService;
import com.huonu.service.AreaEntryService;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.request.ZuanshiBannerAreaCodeFindRequest;
import com.taobao.api.response.ZuanshiBannerAreaCodeFindResponse;

@Service
public class AreaEntryServiceImpl implements AreaEntryService{

	@Autowired
	private ApiCallService apiCallService;
	
	@Autowired
	private AreaEntryDao areaEntryDao;
	
	@Autowired
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	public void sync_area(String call_people, String user_id) {
		LogUtils.logInfo("**************同步地域列表开始    【调用人:["+call_people+"] 用户id:["+user_id+"] *************");
		List<AreaEntry> areaEntryList = new ArrayList<AreaEntry>();
		
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		if(taobaoAuthorizeUser!=null &&  taobaoAuthorizeUser.getAccess_token()!=null){
		
			ZuanshiBannerAreaCodeFindRequest req = new ZuanshiBannerAreaCodeFindRequest();
			ZuanshiBannerAreaCodeFindResponse rsp = apiCallService.call(req, taobaoAuthorizeUser.getAccess_token(), call_people, "taobao.zuanshi.banner.area.code.find");
			if(rsp!=null){
				JSONObject obj0 = new JSONObject(rsp.getBody());
		        if(obj0.has("zuanshi_banner_area_code_find_response")){
		        	JSONObject obj1 = obj0.getJSONObject("zuanshi_banner_area_code_find_response");
		        	Boolean flag = obj1.getJSONObject("result").getBoolean("success");
		        	if(flag==true){
		        		JSONArray areacodes = obj1.getJSONObject("result").getJSONObject("area_codes").getJSONArray("area_code");
		        		for (int i = 0; i < areacodes.length(); i++) {
		        			JSONObject jsonObject = areacodes.getJSONObject(i);
		        			AreaEntry areaEntry = new AreaEntry();
		        			String code = jsonObject.getString("code");
		        			String name = jsonObject.getString("name");
		        			areaEntry.setCode(code);
		        			areaEntry.setName(name);
		        			areaEntryList.add(areaEntry);
		        		}
		        	}else{
		        			LogUtils.logInfo("返回异常数据:"+rsp.getBody());
		        	}
		        }else{
		        		LogUtils.logInfo("返回异常数据(不存在zuanshi_banner_area_code_find_response):"+rsp.getBody());
		        }
			}else{
					LogUtils.logInfo("taobao.zuanshi.banner.area.code.find返回数据为null");
			}
		}else{
				LogUtils.logInfo("用户token不存在");
		}
			
		areaEntryDao.insertAreaEntry(areaEntryList);
		LogUtils.logInfo("**************同步用户计划分时当日汇总数据结束    总记录条数为:"+areaEntryList.size()+"*************");
		
	}
	

}
