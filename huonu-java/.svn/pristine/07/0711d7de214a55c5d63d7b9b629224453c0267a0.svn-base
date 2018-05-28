package com.huonu.mq.consumer;

import java.util.Date;

import org.springframework.amqp.core.Message;
import org.springframework.amqp.core.MessageListener;

import com.huonu.domain.dao.ApiLogDao;
import com.huonu.domain.dao.TaobaoZxhtSyncInfoDao;
import com.huonu.domain.model.ApiLog;
import com.huonu.domain.model.TaobaoZxhtSyncInfo;
import com.huonu.service.EntrieService;
import com.huonu.service.ProtionService;
import com.huonu.utils.date.DateUtils;
import com.huonu.utils.log.LogUtils;
import com.huonu.utils.spring.adapter.SpringUtil;

public class DailyIncrementSyncConsumer  implements MessageListener{
	
	public DailyIncrementSyncConsumer(){}
	
	public void onMessage(Message message) {
		String userMessage = "";
		String user_id = "";
		String call_people = "";
		try {  
			userMessage=new String(message.getBody(),"UTF-8");
			user_id=userMessage.split(":")[0];
			call_people = userMessage.split(":")[1];
		
		 
			LogUtils.logInfo("**************从队列dailyIncrementSyncQueue 消费消息:Message:【"+user_id+"】 开始*************");
			
			ApiLogDao apiLogDao = (ApiLogDao)SpringUtil.getBean("apiLogDao");
	    	ApiLog apiLog = new ApiLog();
	    	apiLog.setApi_name("com.huonu.mq.consumer.DailyIncrementSyncConsumer.onMessage");
	    	apiLog.setCall_people(call_people);
	    	apiLog.setCreate_at(new Date());
	    	apiLogDao.insertApiLog(apiLog);
			
			
			ProtionService protionService = (ProtionService)SpringUtil.getBean("protionService");
			EntrieService entrieService = (EntrieService)SpringUtil.getBean("entrieService");
			TaobaoZxhtSyncInfoDao taobaoZxhtSyncInfoDao = (TaobaoZxhtSyncInfoDao)SpringUtil.getBean("taobaoZxhtSyncInfoDao");
		
			TaobaoZxhtSyncInfo taobaoZxhtSyncInfo=new TaobaoZxhtSyncInfo();
			taobaoZxhtSyncInfo.setLog_date(DateUtils.dateToString(new Date(),"yyyy-MM-dd"));
			taobaoZxhtSyncInfo.setTaobao_user_id(user_id);
			taobaoZxhtSyncInfo.setRun_status(2L);
			taobaoZxhtSyncInfo.setLast_update_time(new Date());
			taobaoZxhtSyncInfoDao.updateRunStatusbyUserIdAndDate(taobaoZxhtSyncInfo);
			try{
				protionService.sync_protion(call_people,user_id,16);
				entrieService.sync_all(call_people,user_id, 16);
        	
				taobaoZxhtSyncInfo.setRun_status(4L);
				taobaoZxhtSyncInfo.setLast_update_time(new Date());
				taobaoZxhtSyncInfoDao.updateRunStatusbyUserIdAndDate(taobaoZxhtSyncInfo);
			}catch(Exception e){
				LogUtils.logException(e);
				taobaoZxhtSyncInfo.setRun_status(3L);
				taobaoZxhtSyncInfo.setLast_update_time(new Date());
				taobaoZxhtSyncInfoDao.updateRunStatusbyUserIdAndDate(taobaoZxhtSyncInfo);
			}
			LogUtils.logInfo("**************从队列 dailyIncrementSyncQueue 消费消息:Message:【"+user_id+"】 结束*************");
	
			} catch (Exception e) {  
				LogUtils.logException(e);
				return;
			}
		}

}
