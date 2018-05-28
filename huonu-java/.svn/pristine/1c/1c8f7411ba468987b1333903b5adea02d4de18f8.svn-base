package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserTargetRtrptsTotalEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetRtrptsTotalEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsAdvertiserTargetRtrptsTotalEntryDao")
public class TaobaoZsAdvertiserTargetRtrptsTotalEntryDaoImpl implements TaobaoZsAdvertiserTargetRtrptsTotalEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_TARGETRTRPTS_TOTAL_ENTRYLIST = "insertOrUpdateTaobaoZsAdvertiserTargetRtrptsTotalEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsAdvertiserTargetRtrptsTotalEntryList(
			List<TaobaoZsAdvertiserTargetRtrptsTotalEntry> taobaoZsAdvertiserTargetRtrptsTotalEntryList) {
		if(taobaoZsAdvertiserTargetRtrptsTotalEntryList!=null&&taobaoZsAdvertiserTargetRtrptsTotalEntryList.size()>0){
			
			List<List<TaobaoZsAdvertiserTargetRtrptsTotalEntry>> tempList= ListUtils.createList(taobaoZsAdvertiserTargetRtrptsTotalEntryList, 5000);
			for(List<TaobaoZsAdvertiserTargetRtrptsTotalEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_TARGETRTRPTS_TOTAL_ENTRYLIST, list);
			}
			
		}
	}

}
