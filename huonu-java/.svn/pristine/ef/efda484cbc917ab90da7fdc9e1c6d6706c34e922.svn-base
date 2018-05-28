package com.huonu.domain.dao.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.ZxhtZzAdgroupCreativeBindInfoDao;
import com.huonu.domain.model.ZxhtZzAdgroupCreativeBindInfo;
import com.huonu.domain.mybatis.MyBatisDAO;

@Repository("zxhtZzAdgroupCreativeBindInfoDao")
public class ZxhtZzAdgroupCreativeBindInfoDaoImpl implements ZxhtZzAdgroupCreativeBindInfoDao{

	private static final String UPDATE_RUNSTATUS_BY_USERID_AND_CAMPAIGNID = "updateStatusByUerIdAndCampaignId";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void updateStatusByUerIdAndCampaignId(ZxhtZzAdgroupCreativeBindInfo zxhtZzAdgroupCreativeBindInfo) {
		myBatisDAO.update(UPDATE_RUNSTATUS_BY_USERID_AND_CAMPAIGNID, zxhtZzAdgroupCreativeBindInfo);
	}

}
