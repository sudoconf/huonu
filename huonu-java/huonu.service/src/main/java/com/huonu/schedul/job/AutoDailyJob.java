package com.huonu.schedul.job;

import java.util.Date;
import java.util.List;

import org.springframework.amqp.core.AmqpTemplate;

import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.dao.TaobaoZxhtSyncInfoDao;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZxhtSyncInfo;
import com.huonu.utils.Constants;
import com.huonu.utils.date.DateUtils;
import com.huonu.utils.log.LogUtils;
import com.huonu.utils.spring.adapter.SpringUtil;

public class AutoDailyJob implements CommonJob{
	

	public void invoke() {
		
		LogUtils.logInfo("**************定时任务AutoDailyJob执行开始*************");
		AmqpTemplate amqpTemplate = (AmqpTemplate)SpringUtil.getBean("amqpTemplate");
		TaobaoAuthorizeUserDao taobaoAuthorizeUserDao = (TaobaoAuthorizeUserDao)SpringUtil.getBean("taobaoAuthorizeUserDao");
		TaobaoZxhtSyncInfoDao taobaoZxhtSyncInfoDao = (TaobaoZxhtSyncInfoDao)SpringUtil.getBean("taobaoZxhtSyncInfoDao");
				
		List<TaobaoAuthorizeUser> dailyIncrementUserIdList = taobaoAuthorizeUserDao.getUserInfosBySyncStatusId(2L);
		List<TaobaoAuthorizeUser> firstEntrieUserIdList = taobaoAuthorizeUserDao.getUserInfosBySyncStatusId(0L);
		
		if(dailyIncrementUserIdList!=null&&dailyIncrementUserIdList.size()>0){
			 for(TaobaoAuthorizeUser taobaoAuthorizeUser:dailyIncrementUserIdList) {
				 String userMessage=taobaoAuthorizeUser.getTaobao_user_id()+":"+"系统调用";
				 amqpTemplate.convertAndSend(Constants.DAILYINCREMENTSYNC_QUEUENAME,userMessage);
				 LogUtils.logInfo("**************向队列 dailyIncrementSyncQueue 发送淘宝店铺id:【"+taobaoAuthorizeUser.getTaobao_user_id()+"】 *************");
				 TaobaoZxhtSyncInfo taobaoZxhtSyncInfo=new TaobaoZxhtSyncInfo();
				 taobaoZxhtSyncInfo.setLog_date(DateUtils.dateToString(new Date(), "yyyy-MM-dd"));
	             taobaoZxhtSyncInfo.setTaobao_user_id(taobaoAuthorizeUser.getTaobao_user_id());
	             taobaoZxhtSyncInfo.setRun_status(1L);
	             taobaoZxhtSyncInfo.setLast_update_time(new Date());
	             taobaoZxhtSyncInfoDao.insertTaobaoZxhtSyncInfo(taobaoZxhtSyncInfo);
	             
			 }
		}
		
		
		if(firstEntrieUserIdList!=null&&firstEntrieUserIdList.size()>0){
			 for(TaobaoAuthorizeUser taobaoAuthorizeUser:firstEntrieUserIdList) {
				 String userMessage=taobaoAuthorizeUser.getTaobao_user_id()+":"+"系统调用";
				 amqpTemplate.convertAndSend(Constants.FIRSTENTRIESYNC_QUEUENAME,userMessage);
				 LogUtils.logInfo("**************向队列 firstEntrieSyncQueue 发送淘宝店铺id:【"+taobaoAuthorizeUser.getTaobao_user_id()+"】 *************");
				 TaobaoZxhtSyncInfo taobaoZxhtSyncInfo=new TaobaoZxhtSyncInfo();
				 taobaoZxhtSyncInfo.setLog_date(DateUtils.dateToString(new Date(), "yyyy-MM-dd"));
	             taobaoZxhtSyncInfo.setTaobao_user_id(taobaoAuthorizeUser.getTaobao_user_id());
	             taobaoZxhtSyncInfo.setRun_status(1L);
	             taobaoZxhtSyncInfo.setLast_update_time(new Date());
	             taobaoZxhtSyncInfoDao.insertTaobaoZxhtSyncInfo(taobaoZxhtSyncInfo);
	             
			 }
		}
		LogUtils.logInfo("**************定时任务AutoDailyJob执行结束*************");
	}

}
