package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserAdzoneTotalEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserAdzoneTotalEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsAdvertiserAdzoneTotalEntryDao")
public class TaobaoZsAdvertiserAdzoneTotalEntryDaoImpl implements TaobaoZsAdvertiserAdzoneTotalEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_ADZONETOTAL_ENTRYLIST = "insertOrUpdateTaobaoZsAdvertiserAdzoneTotalEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsAdvertiserAdzoneTotalEntryList(
			List<TaobaoZsAdvertiserAdzoneTotalEntry> taobaoZsAdvertiserAdzoneTotalEntryList) {
		if(taobaoZsAdvertiserAdzoneTotalEntryList!=null&&taobaoZsAdvertiserAdzoneTotalEntryList.size()>0){
			
			List<List<TaobaoZsAdvertiserAdzoneTotalEntry>> tempList= ListUtils.createList(taobaoZsAdvertiserAdzoneTotalEntryList, 5000);
			for(List<TaobaoZsAdvertiserAdzoneTotalEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_ADZONETOTAL_ENTRYLIST, list);
			}
		}
	}

}
