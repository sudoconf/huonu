package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdgroupAdzoneEntryDao;
import com.huonu.domain.model.TaobaoZsAdgroupAdzoneEntry;
import com.huonu.domain.mybatis.MyBatisDAO;

@Repository("taobaoZsAdgroupAdzoneEntryDao")
public class TaobaoZsAdgroupAdzoneEntryDaoImpl implements TaobaoZsAdgroupAdzoneEntryDao{

	private static final String INSERT_OR_UPDATE_ADVERTISER_LIST = "insertOrUpdateAdvertiserList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateAdvertiserList(List<TaobaoZsAdgroupAdzoneEntry> advertiserlist) {
		if(advertiserlist!=null && advertiserlist.size()>0){
			myBatisDAO.insert(INSERT_OR_UPDATE_ADVERTISER_LIST, advertiserlist);
		}
	}

}
