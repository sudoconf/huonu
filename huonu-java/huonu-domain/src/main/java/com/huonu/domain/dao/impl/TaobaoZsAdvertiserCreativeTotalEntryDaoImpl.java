package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserCreativeTotalEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserCreativeTotalEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsAdvertiserCreativeTotalEntryDao")
public class TaobaoZsAdvertiserCreativeTotalEntryDaoImpl implements TaobaoZsAdvertiserCreativeTotalEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_CREATIVE_TOTAL_ENTRYLIST = "insertOrUpdateTaobaoZsAdvertiserCreativeTotalEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsAdvertiserCreativeTotalEntryList(List<TaobaoZsAdvertiserCreativeTotalEntry> taobaoZsAdvertiserCreativeTotalEntryList) {
		if(taobaoZsAdvertiserCreativeTotalEntryList!=null&&taobaoZsAdvertiserCreativeTotalEntryList.size()>0){
			
			List<List<TaobaoZsAdvertiserCreativeTotalEntry>> tempList= ListUtils.createList(taobaoZsAdvertiserCreativeTotalEntryList, 5000);
			for(List<TaobaoZsAdvertiserCreativeTotalEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_CREATIVE_TOTAL_ENTRYLIST, list);
			}
		}
	}

}
