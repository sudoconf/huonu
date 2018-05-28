package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserCampRtrptsTotalEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserCampRtrptsTotalEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsAdvertiserCampRtrptsTotalEntryDao")
public class TaobaoZsAdvertiserCampRtrptsTotalEntryDaoImpl implements TaobaoZsAdvertiserCampRtrptsTotalEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_CAMPRTRPTS_TOTAL_ENTRYLIST = "insertOrUpdateTaobaoZsAdvertiserCampRtrptsTotalEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsAdvertiserCampRtrptsTotalEntryList(
			List<TaobaoZsAdvertiserCampRtrptsTotalEntry> taobaoZsAdvertiserCampRtrptsTotalEntryList) {
		
		if(taobaoZsAdvertiserCampRtrptsTotalEntryList!=null&&taobaoZsAdvertiserCampRtrptsTotalEntryList.size()>0){
			List<List<TaobaoZsAdvertiserCampRtrptsTotalEntry>> tempList= ListUtils.createList(taobaoZsAdvertiserCampRtrptsTotalEntryList, 5000);
			for(List<TaobaoZsAdvertiserCampRtrptsTotalEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_CAMPRTRPTS_TOTAL_ENTRYLIST, list);
			}
		}
	}

}
