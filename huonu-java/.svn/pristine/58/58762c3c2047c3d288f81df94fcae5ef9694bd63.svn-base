package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsDmpEntryDao;
import com.huonu.domain.model.TaobaoAsyncTaskEntry;
import com.huonu.domain.model.TaobaoZsDmpEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsDmpEntryDao")
public class TaobaoZsDmpEntryDaoImpl implements TaobaoZsDmpEntryDao{

	private static final String DELETE_DMP_BY_TIME = "deleteDmpByTime";
	private static final String INSERT_OR_UPDATE_TAOBAO_ZSDMP_ENTRYLIST = "insertOrUpdateTaobaoZsDmpEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void deleteDmpByTime(TaobaoZsDmpEntry taobaoZsDmpEntry) {
		myBatisDAO.delete(DELETE_DMP_BY_TIME, taobaoZsDmpEntry);
	}

	public void insertOrUpdateTaobaoZsDmpEntryList(List<TaobaoZsDmpEntry> taobaoZsDmpEntryList) {
		
		if(taobaoZsDmpEntryList!=null&&taobaoZsDmpEntryList.size()>0){
			List<List<TaobaoZsDmpEntry>> tempList= ListUtils.createList(taobaoZsDmpEntryList, 5000);
			for(List<TaobaoZsDmpEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSDMP_ENTRYLIST, list);
			}
		}
		
	}

}
