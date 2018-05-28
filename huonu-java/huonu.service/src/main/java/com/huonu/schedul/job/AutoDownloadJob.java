package com.huonu.schedul.job;

import java.util.List;

import org.springframework.amqp.core.AmqpTemplate;

import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.utils.Constants;
import com.huonu.utils.log.LogUtils;
import com.huonu.utils.spring.adapter.SpringUtil;

public class AutoDownloadJob implements CommonJob{

	public void invoke() {
		
		LogUtils.logInfo("**************定时任务AutoDownloadJob执行开始*************");
		
		AmqpTemplate amqpTemplate = (AmqpTemplate)SpringUtil.getBean("amqpTemplate");
		TaobaoAuthorizeUserDao taobaoAuthorizeUserDao = (TaobaoAuthorizeUserDao)SpringUtil.getBean("taobaoAuthorizeUserDao");
		List<TaobaoAuthorizeUser> allTaobaoAuthorizeUserList = taobaoAuthorizeUserDao.getAllUserInfos();
		
		for(TaobaoAuthorizeUser taobaoAuthorizeUser:allTaobaoAuthorizeUserList){
			String userMessage=taobaoAuthorizeUser.getTaobao_user_id()+":"+"系统调用";
			amqpTemplate.convertAndSend(Constants.DOWNLOAD_QUEUENAME,userMessage);
		}
		
		LogUtils.logInfo("**************定时任务AutoDownloadJob执行开始*************");
		
	}

}
