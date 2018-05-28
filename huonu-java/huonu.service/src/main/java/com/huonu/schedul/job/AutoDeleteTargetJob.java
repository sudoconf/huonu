package com.huonu.schedul.job;

import java.util.Date;

import com.huonu.domain.dao.TaobaoZsDmpEntryDao;
import com.huonu.domain.dao.TaobaoZsTargetEntryDao;
import com.huonu.domain.model.TaobaoZsDmpEntry;
import com.huonu.domain.model.TaobaoZsTargetEntry;
import com.huonu.utils.log.LogUtils;
import com.huonu.utils.spring.adapter.SpringUtil;

public class AutoDeleteTargetJob implements CommonJob{

	public void invoke() {
		LogUtils.logInfo("**************定时任务AutoDeleteTargetJob执行开始*************");
		TaobaoZsTargetEntryDao taobaoZsTargetEntryDao = (TaobaoZsTargetEntryDao)SpringUtil.getBean("taobaoZsTargetEntryDao");
		TaobaoZsDmpEntryDao taobaoZsDmpEntryDao = (TaobaoZsDmpEntryDao)SpringUtil.getBean("taobaoZsDmpEntryDao");
		Date date=new Date(System.currentTimeMillis() - 118800000);
		
		TaobaoZsTargetEntry taobaoZsTargetEntry = new TaobaoZsTargetEntry();
		taobaoZsTargetEntry.setLast_update_time(date);
		taobaoZsTargetEntryDao.deleteZsTargetByTime(taobaoZsTargetEntry);
		
		TaobaoZsDmpEntry taobaoZsDmpEntry=new TaobaoZsDmpEntry();
		taobaoZsDmpEntry.setLast_update_time(date);
		taobaoZsDmpEntryDao.deleteDmpByTime(taobaoZsDmpEntry);
		LogUtils.logInfo("**************定时任务AutoDeleteTargetJob执行结束*************");
	}

}
