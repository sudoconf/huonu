package com.huonu.service.impl;

import java.util.Date;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.huonu.domain.dao.TaobaoZxhtSyncInfoDao;
import com.huonu.domain.model.TaobaoZxhtSyncInfo;
import com.huonu.mq.producer.MessageDirectProducer;
import com.huonu.service.HandleFirstProtionSyncService;
import com.huonu.utils.Constants;
import com.huonu.utils.date.DateUtils;

@Service
public class HandleFirstProtionSyncServiceImpl implements HandleFirstProtionSyncService{

	@Autowired
	private MessageDirectProducer messageDirectProducer;
	
	@Autowired
	private TaobaoZxhtSyncInfoDao taobaoZxhtSyncInfoDao;


	public void handle_sync(String user_id,String call_people) {
		
		//接受请求后，修改用户同步表中同步状态为等待运行（1）
        TaobaoZxhtSyncInfo taobaoZxhtSyncInfo=new TaobaoZxhtSyncInfo();
        taobaoZxhtSyncInfo.setLog_date(DateUtils.dateToString(new Date(), "yyyy-MM-dd"));
        taobaoZxhtSyncInfo.setTaobao_user_id(user_id);
        taobaoZxhtSyncInfo.setRun_status(1L);
        taobaoZxhtSyncInfo.setLast_update_time(new Date());
        taobaoZxhtSyncInfoDao.updateRunStatusbyUserIdAndDate(taobaoZxhtSyncInfo);		
        String userMessage=user_id+":"+call_people;
        messageDirectProducer.send(Constants.FIRSTPROTIONSYNC_QUEUENAME,userMessage);
	}

}
