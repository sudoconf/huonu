package com.huonu.mq.consumer;

import java.util.Date;

import org.springframework.amqp.core.Message;
import org.springframework.amqp.core.MessageListener;

import com.huonu.domain.dao.ApiLogDao;
import com.huonu.domain.model.ApiLog;
import com.huonu.service.DownloadService;
import com.huonu.utils.log.LogUtils;
import com.huonu.utils.spring.adapter.SpringUtil;

public class DownloadConsumer  implements MessageListener{

	public DownloadConsumer(){}
	
	public void onMessage(Message message) {
		
		String userMessage = "";
		String user_id = "";
		String call_people = "";
		try { 
			LogUtils.logInfo("**************从队列downloadQueue消费消息 开始*************");
			userMessage=new String(message.getBody(),"UTF-8");
			user_id=userMessage.split(":")[0];
			call_people = userMessage.split(":")[1];  
            
            ApiLogDao apiLogDao = (ApiLogDao)SpringUtil.getBean("apiLogDao");
	    	ApiLog apiLog = new ApiLog();
	    	apiLog.setApi_name("com.huonu.mq.consumer.DownloadConsumer.onMessage");
	    	apiLog.setCall_people("系统调用");
	    	apiLog.setCreate_at(new Date());
	    	apiLogDao.insertApiLog(apiLog);
            
            DownloadService downloadService = (DownloadService)SpringUtil.getBean("downloadService");
            downloadService.setDatabyId(call_people,user_id);
            LogUtils.logInfo("**************从队列 downloadQueue消费消息 结束:Message:【"+message+"】*************");
		} catch (Exception e) {  
            LogUtils.logException(e); 
        }
		
	}

}
