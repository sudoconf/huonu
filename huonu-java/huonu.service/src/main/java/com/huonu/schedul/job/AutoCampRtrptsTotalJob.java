package com.huonu.schedul.job;

import java.util.List;

import org.springframework.amqp.core.AmqpTemplate;

import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.utils.Constants;
import com.huonu.utils.log.LogUtils;
import com.huonu.utils.spring.adapter.SpringUtil;

public class AutoCampRtrptsTotalJob  implements CommonJob{

	public void invoke() {
		
		LogUtils.logInfo("**************定时任务AutoCampRtrptsTotalJob执行开始*************");
		AmqpTemplate amqpTemplate = (AmqpTemplate)SpringUtil.getBean("amqpTemplate");
		TaobaoAuthorizeUserDao taobaoAuthorizeUserDao = (TaobaoAuthorizeUserDao)SpringUtil.getBean("taobaoAuthorizeUserDao");
		List<TaobaoAuthorizeUser> allTaobaoAuthorizeUserList = taobaoAuthorizeUserDao.getAllUserInfos();
		if(allTaobaoAuthorizeUserList!=null && allTaobaoAuthorizeUserList.size()>0){
			
			for(TaobaoAuthorizeUser taobaoAuthorizeUser:allTaobaoAuthorizeUserList){
				
				amqpTemplate.convertAndSend(Constants.CAMPRTRPTSTOTAL_QUEUENAME,taobaoAuthorizeUser.getTaobao_user_id());
				
				LogUtils.logInfo("**************向队列 campRtrptsTotalQueue 发送淘宝店铺id:【"+taobaoAuthorizeUser.getTaobao_user_id()+"】 *************");
			
			}
		}
		LogUtils.logInfo("**************定时任务AutoCampRtrptsTotalJob执行结束*************");
	}
}
