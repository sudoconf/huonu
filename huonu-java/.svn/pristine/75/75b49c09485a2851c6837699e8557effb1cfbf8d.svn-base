package com.huonu.mq.consumer;

import java.util.Date;

import org.springframework.amqp.core.Message;
import org.springframework.amqp.core.MessageListener;

import com.huonu.domain.dao.ApiLogDao;
import com.huonu.domain.model.ApiLog;
import com.huonu.service.CampRtrptsTotalService;
import com.huonu.utils.Constants;
import com.huonu.utils.log.LogUtils;
import com.huonu.utils.spring.adapter.SpringUtil;

public class CampRtrptsTotalConsumer implements MessageListener{

	public CampRtrptsTotalConsumer(){}
	
	public void onMessage(Message message) {
		LogUtils.logInfo("**************从队列 campRtrptsTotalQueue 消费消息 开始*************");
		String user_id = "";
		try {
            user_id =new String(message.getBody(),Constants.ENCODING);
            
            ApiLogDao apiLogDao = (ApiLogDao)SpringUtil.getBean("apiLogDao");
    		ApiLog apiLog = new ApiLog();
    		apiLog.setApi_name("com.huonu.mq.consumer.CampRtrptsTotalConsumer.onMessage");
    		apiLog.setCall_people("系统调用");
    		apiLog.setCreate_at(new Date());
    		apiLogDao.insertApiLog(apiLog);
            
            CampRtrptsTotalService campRtrptsTotalService = (CampRtrptsTotalService)SpringUtil.getBean("campRtrptsTotalService");
            campRtrptsTotalService.sync_rtrptstotal("系统调用",user_id);
            LogUtils.logInfo("**************从队列 campRtrptsTotalQueue 消费消息:Message:【"+user_id+"】 结束*************");
		} catch (Exception e) {
        	LogUtils.logException(e);
            return;
        } 
	}

}
