package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserAdgroupRtrptsTotalEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserAdgroupRtrptsTotalEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsAdvertiserAdgroupRtrptsTotalEntryDao")
public class TaobaoZsAdvertiserAdgroupRtrptsTotalEntryDaoImpl implements TaobaoZsAdvertiserAdgroupRtrptsTotalEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_ADGROUPRTRPTS_TOTAL_ENTRYLIST = "insertOrUpdateTaobaoZsAdvertiserAdgroupRtrptsTotalEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsAdvertiserAdgroupRtrptsTotalEntryList(
			List<TaobaoZsAdvertiserAdgroupRtrptsTotalEntry> taobaoZsAdvertiserAdgroupRtrptsTotalEntryList) {
		if(taobaoZsAdvertiserAdgroupRtrptsTotalEntryList!=null&&taobaoZsAdvertiserAdgroupRtrptsTotalEntryList.size()>0){
			List<List<TaobaoZsAdvertiserAdgroupRtrptsTotalEntry>> tempList= ListUtils.createList(taobaoZsAdvertiserAdgroupRtrptsTotalEntryList, 5000);
			for(List<TaobaoZsAdvertiserAdgroupRtrptsTotalEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_ADGROUPRTRPTS_TOTAL_ENTRYLIST, list);
			}
		}
	}

}
