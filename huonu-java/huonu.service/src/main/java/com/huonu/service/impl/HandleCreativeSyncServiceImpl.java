package com.huonu.service.impl;

import java.util.Date;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.dao.TaobaoZxhtCreativeSyncInfoDao;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZxhtCreativeSyncInfo;
import com.huonu.service.CreativeService;
import com.huonu.service.HandleCreativeSyncService;
import com.huonu.utils.date.DateUtils;

@Service("handleCreativeSyncService")
public class HandleCreativeSyncServiceImpl implements HandleCreativeSyncService{

	@Autowired
	private TaobaoZxhtCreativeSyncInfoDao taobaoZxhtCreativeSyncInfoDao;
	
	@Autowired
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	@Autowired
	private CreativeService creativeService;
	
	public void invoke(String call_people,String userid) {
		
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(userid);
		String sessionkey = taobaoAuthorizeUser.getAccess_token();
		
		TaobaoZxhtCreativeSyncInfo taobaoZxhtCreativeSyncInfo=new TaobaoZxhtCreativeSyncInfo();
        taobaoZxhtCreativeSyncInfo.setTaobao_user_id(userid);
        taobaoZxhtCreativeSyncInfo.setLast_update_time(new Date());
        taobaoZxhtCreativeSyncInfo.setRun_status(2L);
        taobaoZxhtCreativeSyncInfo.setLog_date(DateUtils.dateToString(new Date(), "yyyy-MM-dd"));
        taobaoZxhtCreativeSyncInfoDao.updateCreativeSynRunStatusByUserIdAndDate(taobaoZxhtCreativeSyncInfo);

        creativeService.sync_creative(call_people,userid,null,null,sessionkey);
 
        taobaoZxhtCreativeSyncInfo.setLast_update_time(new Date());
        taobaoZxhtCreativeSyncInfo.setRun_status(4L);
        taobaoZxhtCreativeSyncInfo.setLog_date(DateUtils.dateToString(new Date(), "yyyy-MM-dd"));
        taobaoZxhtCreativeSyncInfoDao.updateCreativeSynRunStatusByUserIdAndDate(taobaoZxhtCreativeSyncInfo);
	
	}
	

}
