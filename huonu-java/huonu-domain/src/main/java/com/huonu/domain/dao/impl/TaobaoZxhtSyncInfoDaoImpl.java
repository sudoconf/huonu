package com.huonu.domain.dao.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZxhtSyncInfoDao;
import com.huonu.domain.model.TaobaoZxhtSyncInfo;
import com.huonu.domain.mybatis.MyBatisDAO;

@Repository("taobaoZxhtSyncInfoDao")
public class TaobaoZxhtSyncInfoDaoImpl implements TaobaoZxhtSyncInfoDao{

	private static final String INSERT_TAOBAO_ZXHT_SYNC_INFO = "insertTaobaoZxhtSyncInfo";
	private static final String UPDATE_RUNSTATUS_BY_USERID_AND_DATE = "updateRunStatusbyUserIdAndDate";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertTaobaoZxhtSyncInfo(TaobaoZxhtSyncInfo taobaoZxhtSyncInfo) {
		myBatisDAO.insert(INSERT_TAOBAO_ZXHT_SYNC_INFO, taobaoZxhtSyncInfo);
	}

	public void updateRunStatusbyUserIdAndDate(TaobaoZxhtSyncInfo taobaoZxhtSyncInfo) {
		myBatisDAO.update(UPDATE_RUNSTATUS_BY_USERID_AND_DATE, taobaoZxhtSyncInfo);
	}

}
