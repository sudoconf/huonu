package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsCatEntryDao;
import com.huonu.domain.model.TaobaoZsCatEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsCatEntryDao")
public class TaobaoZsCatEntryDaoImpl implements TaobaoZsCatEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSCAT_ENTRYLIST = "insertOrUpdateTaobaoZsCatEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsCatEntryList(List<TaobaoZsCatEntry> taobaoZsCatEntryList) {
		
		if(taobaoZsCatEntryList!=null&&taobaoZsCatEntryList.size()>0){
			
			List<List<TaobaoZsCatEntry>> tempList= ListUtils.createList(taobaoZsCatEntryList, 5000);
			for(List<TaobaoZsCatEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSCAT_ENTRYLIST, list);
			}
		}
	}

}
