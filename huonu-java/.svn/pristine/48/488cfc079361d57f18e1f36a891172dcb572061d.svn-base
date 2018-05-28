package com.huonu.mq.consumer;

import java.util.Date;

import org.springframework.amqp.core.Message;
import org.springframework.amqp.core.MessageListener;

import com.huonu.domain.dao.ApiLogDao;
import com.huonu.domain.model.ApiLog;
import com.huonu.service.CrowdMonitorCoverageService;
import com.huonu.utils.log.LogUtils;
import com.huonu.utils.spring.adapter.SpringUtil;

public class CrowdMonitorCoverageConsumer implements MessageListener{

	public CrowdMonitorCoverageConsumer(){};
	
	public void onMessage(Message message) {
		LogUtils.logInfo("**************从队列 crowdMonitorCoverageQueue 消费消息 开始*************");
		String userMessage = "";
		String user_id = "";
		String call_people = "";
		try {
			
			userMessage=new String(message.getBody(),"UTF-8");
			user_id=userMessage.split(":")[0];
			call_people =userMessage.split(":")[1];
			
			ApiLogDao apiLogDao = (ApiLogDao)SpringUtil.getBean("apiLogDao");
	    	ApiLog apiLog = new ApiLog();
	    	apiLog.setApi_name("com.huonu.mq.consumer.CrowdMonitorCoverageConsumer.onMessage");
	    	apiLog.setCall_people(call_people);
	    	apiLog.setCreate_at(new Date());
	    	apiLogDao.insertApiLog(apiLog);
			
	    	CrowdMonitorCoverageService crowdMonitorCoverageService = (CrowdMonitorCoverageService)SpringUtil.getBean("crowdMonitorCoverageService");
	    	crowdMonitorCoverageService.coustomer(user_id, call_people);
			
			LogUtils.logInfo("**************从队列 crowdMonitorCoverageQueue 消费消息:Message:【"+message+"】 结束*************");
		}catch (Exception e) { 
			e.printStackTrace(); 
			LogUtils.logInfo("**************从队列 crowdMonitorCoverageQueue 消费消息:Message:【"+message+"】 异常*************");
			return;
		}
	}

}
