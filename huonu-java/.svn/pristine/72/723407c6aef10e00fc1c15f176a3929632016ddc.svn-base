package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserAdgroupDayEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserAdgroupDayEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsAdvertiserAdgroupDayEntryDao")
public class TaobaoZsAdvertiserAdgroupDayEntryDaoImpl implements TaobaoZsAdvertiserAdgroupDayEntryDao {

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_ADGROUPDAY_ENTRYLIST = "insertOrUpdateTaobaoZsAdvertiserAdgroupDayEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsAdvertiserAdgroupDayEntryList(
			List<TaobaoZsAdvertiserAdgroupDayEntry> taobaoZsAdvertiserAdgroupDayEntryList) {
		if(taobaoZsAdvertiserAdgroupDayEntryList!=null&&taobaoZsAdvertiserAdgroupDayEntryList.size()>0){
			
			List<List<TaobaoZsAdvertiserAdgroupDayEntry>> tempList= ListUtils.createList(taobaoZsAdvertiserAdgroupDayEntryList, 5000);
			
			for(List<TaobaoZsAdvertiserAdgroupDayEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_ADGROUPDAY_ENTRYLIST, list);
			}
			
		}
	}

}
