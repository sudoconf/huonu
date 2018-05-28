package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserTargetDaySumEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetDayEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetDaySumEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsAdvertiserTargetDaySumEntryDao")
@SuppressWarnings({ "unchecked" })
public class TaobaoZsAdvertiserTargetDaySumEntryDaoImpl implements TaobaoZsAdvertiserTargetDaySumEntryDao{

	private static final String GET_TARGET_DAYSUM_ENTRYLIST_BY_USERID_AND_DATE = "getTargetDaySumEntryListByUseridAndDate";
	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_TARGETDAYSUM_ENTRYLIST = "insertOrUpdateTaobaoZsAdvertiserTargetDaySumEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public List<TaobaoZsAdvertiserTargetDaySumEntry> getTargetDaySumEntryListByUseridAndDate(
			TaobaoZsAdvertiserTargetDayEntry taobaoZsAdvertiserTargetDayEntry) {
		return myBatisDAO.findForList(GET_TARGET_DAYSUM_ENTRYLIST_BY_USERID_AND_DATE, taobaoZsAdvertiserTargetDayEntry);
	}

	public void insertOrUpdateTaobaoZsAdvertiserTargetDaySumEntryList(
			List<TaobaoZsAdvertiserTargetDaySumEntry> taobaoZsAdvertiserTargetDaySumEntryList) {
		
		if(taobaoZsAdvertiserTargetDaySumEntryList!=null&&taobaoZsAdvertiserTargetDaySumEntryList.size()>0){
			List<List<TaobaoZsAdvertiserTargetDaySumEntry>> tempList= ListUtils.createList(taobaoZsAdvertiserTargetDaySumEntryList, 5000);
			for(List<TaobaoZsAdvertiserTargetDaySumEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_TARGETDAYSUM_ENTRYLIST, list);
			}
		}
	}

}
