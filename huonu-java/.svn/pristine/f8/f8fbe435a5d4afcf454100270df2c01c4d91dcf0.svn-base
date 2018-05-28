package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserCreativeDayEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserCreativeDayEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsAdvertiserCreativeDayEntryDao")
public class TaobaoZsAdvertiserCreativeDayEntryDaoImpl implements TaobaoZsAdvertiserCreativeDayEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_CREATIVEDAY_ENTRYLIST = "insertOrUpdateTaobaoZsAdvertiserCreativeDayEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsAdvertiserCreativeDayEntryList(
			List<TaobaoZsAdvertiserCreativeDayEntry> taobaoZsAdvertiserCreativeDayEntryList) {
		if(taobaoZsAdvertiserCreativeDayEntryList!=null&&taobaoZsAdvertiserCreativeDayEntryList.size()>0){
			
			List<List<TaobaoZsAdvertiserCreativeDayEntry>> tempList= ListUtils.createList(taobaoZsAdvertiserCreativeDayEntryList, 5000);
			for(List<TaobaoZsAdvertiserCreativeDayEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_CREATIVEDAY_ENTRYLIST, list);
			}
			
		}
	}

}
