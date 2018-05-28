package com.huonu.mq.consumer;

import java.util.Date;

import org.springframework.amqp.core.Message;
import org.springframework.amqp.core.MessageListener;

import com.huonu.domain.dao.ApiLogDao;
import com.huonu.domain.model.ApiLog;
import com.huonu.service.HandleTargetUpdateService;
import com.huonu.utils.log.LogUtils;
import com.huonu.utils.spring.adapter.SpringUtil;

public class TargetUpdateConsumer implements MessageListener{
	
	public TargetUpdateConsumer(){}

	public void onMessage(Message message) {
		LogUtils.logInfo("**************从队列 targetUpdateQueue 消费消息 开始*************");
		String userMessage = "";
		String user_id = "";
		String call_people = "";
		try {  
			userMessage=new String(message.getBody(),"UTF-8");
			user_id=userMessage.split(":")[0];
			call_people = userMessage.split(":")[1];
			
			ApiLogDao apiLogDao = (ApiLogDao)SpringUtil.getBean("apiLogDao");
	    	ApiLog apiLog = new ApiLog();
	    	apiLog.setApi_name("com.huonu.mq.consumer.TargetUpdateConsumer.onMessage");
	    	apiLog.setCall_people(call_people);
	    	apiLog.setCreate_at(new Date());
	    	apiLogDao.insertApiLog(apiLog);
			
			HandleTargetUpdateService handleTargetUpdateService = (HandleTargetUpdateService)SpringUtil.getBean("handleTargetUpdateService");
			handleTargetUpdateService.invoke(call_people,user_id);
			
			LogUtils.logInfo("**************从队列 targetUpdateQueue 消费消息:Message:【"+userMessage+"】 结束*************");
		
		} catch (Exception e) {  
			LogUtils.logException(e);
            return;
		}
		
	}

}
