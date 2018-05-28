package com.huonu.schedul.job;

import java.sql.Timestamp;
import java.util.Date;
import java.util.List;

import org.quartz.Job;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;

import com.huonu.domain.dao.ZxhtZzCampaignInfoDao;
import com.huonu.domain.model.ZxhtZzCampaignInfo;
import com.huonu.utils.spring.adapter.SpringUtil;

public class ZxhtCreativeMonitorTestJob  implements Job {

	public void execute(JobExecutionContext context)
			throws JobExecutionException {
		
		ZxhtZzCampaignInfoDao zxhtZzCampaignInfoDao = (ZxhtZzCampaignInfoDao)SpringUtil.getBean("zxhtZzCampaignInfoDao");
		List<ZxhtZzCampaignInfo> zxhtZzCampaignInfoList = zxhtZzCampaignInfoDao.getCreativetestMonitorUserId();
		
		if(zxhtZzCampaignInfoList!=null&&zxhtZzCampaignInfoList.size()>0){
			for(ZxhtZzCampaignInfo zxhtZzCampaignInfo:zxhtZzCampaignInfoList){
				//这里开始发送邮件
				Date start_time= zxhtZzCampaignInfo.getCreative_start_time();
                String user_id=zxhtZzCampaignInfo.getTaobao_user_id();
                Timestamp ts = new Timestamp(System.currentTimeMillis());
                double time=((double) ts.getTime()-start_time.getTime())/3600000;
                //若相差时间大于一小时
                if(time>1){ 
                	
                	
                	
                	
                }
			}
		}else{
			//移除当前的定时任务
			
		}
		
		
	}

}
