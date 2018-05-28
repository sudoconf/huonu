package com.huonu.domain.dao.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZxhtCreativeSyncInfoDao;
import com.huonu.domain.model.TaobaoZxhtCreativeSyncInfo;
import com.huonu.domain.mybatis.MyBatisDAO;


@Repository("taobaoZxhtCreativeSyncInfoDao")
public class TaobaoZxhtCreativeSyncInfoImpl implements TaobaoZxhtCreativeSyncInfoDao{

	private static final String UPDATE_CREATIVESYN_RUNSTATUS_BY_USERID_AND_DATE = "updateCreativeSynRunStatusByUserIdAndDate";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void updateCreativeSynRunStatusByUserIdAndDate(
			TaobaoZxhtCreativeSyncInfo taobaoZxhtCreativeSyncInfo) {
		myBatisDAO.update(UPDATE_CREATIVESYN_RUNSTATUS_BY_USERID_AND_DATE, taobaoZxhtCreativeSyncInfo);
	}

}
