package com.huonu.mq.consumer;

import java.util.Date;

import org.springframework.amqp.core.Message;
import org.springframework.amqp.core.MessageListener;

import com.huonu.domain.dao.ApiLogDao;
import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.model.ApiLog;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.service.ProtionService;
import com.huonu.utils.spring.adapter.SpringUtil;

public class FirstProtionSyncConsumer implements MessageListener{

	public FirstProtionSyncConsumer(){};
	
	public void onMessage(Message message) {
		String userMessage = "";
		String user_id = "";
		String call_people = "";
		try {  
			userMessage=new String(message.getBody(),"UTF-8");
			user_id=userMessage.split(":")[0];
			call_people = userMessage.split(":")[1];
		
			ApiLogDao apiLogDao = (ApiLogDao)SpringUtil.getBean("apiLogDao");
	    	ApiLog apiLog = new ApiLog();
	    	apiLog.setApi_name("com.huonu.mq.consumer.FirstProtionSyncConsumer.onMessage");
	    	apiLog.setCall_people(call_people);
	    	apiLog.setCreate_at(new Date());
	    	apiLogDao.insertApiLog(apiLog);
			
			ProtionService protionService = (ProtionService)SpringUtil.getBean("protionService");
			TaobaoAuthorizeUserDao taobaoAuthorizeUserDao = (TaobaoAuthorizeUserDao)SpringUtil.getBean("taobaoAuthorizeUserDao");
		
			try{
				protionService.sync_protion(call_people,user_id, 91);
			}catch(Exception e){
				TaobaoAuthorizeUser taobaoAuthorizeUser=new TaobaoAuthorizeUser();
				taobaoAuthorizeUser.setTaobao_user_id(user_id);
				taobaoAuthorizeUser.setSync_status(0L);
				taobaoAuthorizeUserDao.updateSyncStatusByTaoBaoUserId(taobaoAuthorizeUser);
			}
		
		} catch (Exception e) { 
			e.printStackTrace();  
			return;
		}
	
	}

}
