package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserCampDayEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserCampDayEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsAdvertiserCampDayEntryDao")
public class TaobaoZsAdvertiserCampDayEntryDaoImpl implements TaobaoZsAdvertiserCampDayEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_CAMPDAY_ENTRYLIST = "insertOrUpdateTaobaoZsAdvertiserCampDayEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsAdvertiserCampDayEntryList(
			List<TaobaoZsAdvertiserCampDayEntry> taobaoZsAdvertiserCampDayEntryList) {
		if(taobaoZsAdvertiserCampDayEntryList!=null&&taobaoZsAdvertiserCampDayEntryList.size()>0){
			
			List<List<TaobaoZsAdvertiserCampDayEntry>> tempList= ListUtils.createList(taobaoZsAdvertiserCampDayEntryList, 5000);
			for(List<TaobaoZsAdvertiserCampDayEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_CAMPDAY_ENTRYLIST, list);
			}
		}
	}

}
