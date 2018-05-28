package com.huonu.service.impl;

import java.util.Date;

import org.json.JSONObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.huonu.domain.dao.ApiLogDao;
import com.huonu.domain.model.ApiLog;
import com.huonu.service.ApiCallService;
import com.huonu.utils.log.LogUtils;
import com.taobao.api.ApiException;
import com.taobao.api.TaobaoClient;
import com.taobao.api.TaobaoRequest;
import com.taobao.api.TaobaoResponse;

@Service
public class ApiCallServiceImpl implements ApiCallService{

	@Autowired
	private TaobaoClient taobaoClient;
	
	@Autowired
	private ApiLogDao apiLogDao;
	
	public <T extends TaobaoResponse> T call(TaobaoRequest<T> req,
			String sessionkey, String call_people, String api_name) {
		
		T rsp = null;
		Boolean continue_flag = true;
		int fail_time = 0;
		while(continue_flag && fail_time<3){
			rsp = null;
			try {
				rsp = taobaoClient.execute(req, sessionkey);
			} catch (ApiException e) {
				LogUtils.logException(e);
			}
			ApiLog apiLog = new ApiLog();
		    apiLog.setApi_name(api_name);
		    apiLog.setCall_people(call_people);
		    apiLog.setCreate_at(new Date());
		    apiLogDao.insertApiLog(apiLog);
		    
		    if(rsp!=null && rsp.getBody()!=null){
		    	JSONObject obj1 = new JSONObject(rsp.getBody());
		    	continue_flag = false;
		    	if (obj1.has("error_response")){
		    		
		    		JSONObject obj2 = obj1.getJSONObject("error_response");
					int code = 0;
					if (obj2.has("code")) {
						  code = obj2.getInt("code");
					}
					
					if(code==7){
						continue_flag = true;
						try {
							LogUtils.logInfo("开始睡眠1秒钟");
							Thread.sleep(1000);
						} catch (InterruptedException e) {
							LogUtils.logException(e);
						}
						
					}else if(code==15){
						//如果返回的子错误码是isp开头的，可以通过重试解决；如果返回的子错误码是isv开头的，请填写正确的业务参数。
						if(obj2.has("sub_code")){
							String sub_code = obj2.getString("sub_code");
							if(sub_code.startsWith("isp")){
								continue_flag = true;
							}
						}
					}else{
						return rsp;
					}
		    		
		    	}else{
		    		return rsp;
		    	}
		    }else{
		    	return rsp;
		    }
		    fail_time++;
		}
		if(fail_time>1){
    		LogUtils.logInfo("循环执行次数 fail_time="+(fail_time-1));
    	}
		return rsp;
	}

	
	
}
