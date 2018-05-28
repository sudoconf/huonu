package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserAdzoneRtrptsTotalEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserAdzoneRtrptsTotalEntry;
import com.huonu.domain.mybatis.MyBatisDAO;

@Repository("taobaoZsAdvertiserAdzoneRtrptsTotalEntryDao")
public class TaobaoZsAdvertiserAdzoneRtrptsTotalEntryDaoImpl implements TaobaoZsAdvertiserAdzoneRtrptsTotalEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_ADZONERTRPTS_ENTRYLIST = "insertOrUpdateTaobaoZsAdvertiserAdzoneRtrptsTotalEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsAdvertiserAdzoneRtrptsTotalEntryList(
			List<TaobaoZsAdvertiserAdzoneRtrptsTotalEntry> taobaoZsAdvertiserAdzoneRtrptsTotalEntryList) {
		if(taobaoZsAdvertiserAdzoneRtrptsTotalEntryList!=null&&taobaoZsAdvertiserAdzoneRtrptsTotalEntryList.size()>0){
			myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_ADZONERTRPTS_ENTRYLIST, taobaoZsAdvertiserAdzoneRtrptsTotalEntryList);
		}
	}
}
