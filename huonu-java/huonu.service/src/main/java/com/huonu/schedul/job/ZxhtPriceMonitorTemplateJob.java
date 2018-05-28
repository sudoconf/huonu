package com.huonu.schedul.job;

import java.util.List;

import org.quartz.Job;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;
import org.springframework.amqp.core.AmqpTemplate;

import com.huonu.domain.dao.ZxhtZzCampaignInfoDao;
import com.huonu.domain.model.ZxhtZzCampaignInfo;
import com.huonu.utils.Constants;
import com.huonu.utils.spring.adapter.SpringUtil;

public class ZxhtPriceMonitorTemplateJob  implements Job{

	
	public void execute(JobExecutionContext context)
			throws JobExecutionException {

		AmqpTemplate amqpTemplate = (AmqpTemplate)SpringUtil.getBean("amqpTemplate");
		ZxhtZzCampaignInfoDao zxhtZzCampaignInfoDao =(ZxhtZzCampaignInfoDao)SpringUtil.getBean("zxhtZzCampaignInfoDao");
		
		List<ZxhtZzCampaignInfo> userIdList = zxhtZzCampaignInfoDao.getPriceMonitorTemplateUserId();
		
		if(userIdList.size()>0) {
			
			for(ZxhtZzCampaignInfo zxhtZzCampaignInfo : userIdList){
				String message = zxhtZzCampaignInfo.getTaobao_user_id()+":"+"定时任务";
				amqpTemplate.convertAndSend(Constants.PRICETEMPLATEMONITOR_QUEUENAME, message);
			}
			
		}else{
			//关闭自己
		}
		
	}

}
