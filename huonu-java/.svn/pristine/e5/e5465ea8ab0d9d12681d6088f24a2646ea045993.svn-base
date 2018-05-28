package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsCreativeEntryDao;
import com.huonu.domain.model.TaobaoZsCreativeEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsCreativeEntryDao")
public class TaobaoZsCreativeEntryDaoImpl implements TaobaoZsCreativeEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSCREATIVE_ENTRYLIST = "insertOrUpdateTaobaoZsCreativeEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsCreativeEntryList(List<TaobaoZsCreativeEntry> taobaoZsCreativeEntryList) {
		if(taobaoZsCreativeEntryList!=null&&taobaoZsCreativeEntryList.size()>0){
			
			List<List<TaobaoZsCreativeEntry>> tempList= ListUtils.createList(taobaoZsCreativeEntryList, 5000);
			for(List<TaobaoZsCreativeEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSCREATIVE_ENTRYLIST, list);
			}
		}
	}

}
