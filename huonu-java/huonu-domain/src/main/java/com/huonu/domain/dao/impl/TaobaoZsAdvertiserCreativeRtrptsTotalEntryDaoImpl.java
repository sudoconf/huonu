package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserCreativeRtrptsTotalEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserCreativeRtrptsTotalEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsAdvertiserCreativeRtrptsTotalEntryDao")
public class TaobaoZsAdvertiserCreativeRtrptsTotalEntryDaoImpl implements TaobaoZsAdvertiserCreativeRtrptsTotalEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_CREATIVERTRPTS_TOTAL_ENTRYLIST = "insertOrUpdateTaobaoZsAdvertiserCreativeRtrptsTotalEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;	
	
	public void insertOrUpdateTaobaoZsAdvertiserCreativeRtrptsTotalEntryList(
			List<TaobaoZsAdvertiserCreativeRtrptsTotalEntry> taobaoZsAdvertiserCreativeRtrptsTotalEntryList) {
		if(taobaoZsAdvertiserCreativeRtrptsTotalEntryList!=null&&taobaoZsAdvertiserCreativeRtrptsTotalEntryList.size()>0){
			List<List<TaobaoZsAdvertiserCreativeRtrptsTotalEntry>> tempList= ListUtils.createList(taobaoZsAdvertiserCreativeRtrptsTotalEntryList, 5000);
			for(List<TaobaoZsAdvertiserCreativeRtrptsTotalEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_CREATIVERTRPTS_TOTAL_ENTRYLIST, list);
			}
		}
	}

}
