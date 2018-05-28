package com.huonu.domain.dao.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZxhtDmpSyncInfoDao;
import com.huonu.domain.model.TaobaoZxhtDmpSyncInfo;
import com.huonu.domain.mybatis.MyBatisDAO;

@Repository("taobaoZxhtDmpSyncInfoDao")
public class TaobaoZxhtDmpSyncInfoDaoImpl implements TaobaoZxhtDmpSyncInfoDao{

	private static final String UPDATE_DMP_RUN_STATUS = "updateDmpRunStatus";
	
	@Autowired
	private MyBatisDAO myBatisDAO;

	public void updateDmpRunStatus(TaobaoZxhtDmpSyncInfo taobaoZxhtDmpSyncInfo) {
		myBatisDAO.update(UPDATE_DMP_RUN_STATUS, taobaoZxhtDmpSyncInfo);
	}

}
