package com.huonu.service.impl;

import java.util.Date;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.huonu.domain.dao.TaobaoZxhtSyncInfoDao;
import com.huonu.domain.model.TaobaoZxhtSyncInfo;
import com.huonu.mq.producer.MessageDirectProducer;
import com.huonu.service.HandleFirstEntrieSyncService;
import com.huonu.utils.Constants;
import com.huonu.utils.date.DateUtils;

@Service("handleFirstEntrieSyncService")
public class HandleFirstEntrieSyncServiceImpl implements HandleFirstEntrieSyncService{

	@Autowired
	private MessageDirectProducer messageDirectProducer;
	
	@Autowired
	private TaobaoZxhtSyncInfoDao taobaoZxhtSyncInfoDao;

	public void handle_sync(String user_id,String call_people) {
		
		TaobaoZxhtSyncInfo taobaoZxhtSyncInfo=new TaobaoZxhtSyncInfo();
        taobaoZxhtSyncInfo.setLog_date(DateUtils.dateToString(new Date(), "yyyy-MM-dd"));
        taobaoZxhtSyncInfo.setTaobao_user_id(user_id);
        taobaoZxhtSyncInfo.setRun_status(1L);
        taobaoZxhtSyncInfo.setLast_update_time(new Date());
        taobaoZxhtSyncInfoDao.insertTaobaoZxhtSyncInfo(taobaoZxhtSyncInfo);
        String userMessage=user_id+":"+call_people;
        messageDirectProducer.send(Constants.FIRSTENTRIESYNC_QUEUENAME,userMessage);
        
	}
	
}
