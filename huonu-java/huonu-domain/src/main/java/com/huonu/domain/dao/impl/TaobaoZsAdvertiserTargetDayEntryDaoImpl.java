package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserTargetDayEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetDayEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsAdvertiserTargetDayEntryDao")
public class TaobaoZsAdvertiserTargetDayEntryDaoImpl implements TaobaoZsAdvertiserTargetDayEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_TARGETDAY_ENTRYLIST = "insertOrUpdateTaobaoZsAdvertiserTargetDayEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsAdvertiserTargetDayEntryList(
			List<TaobaoZsAdvertiserTargetDayEntry> taobaoZsAdvertiserTargetDayEntryList) {
		
		if(taobaoZsAdvertiserTargetDayEntryList!=null&&taobaoZsAdvertiserTargetDayEntryList.size()>0){
			List<List<TaobaoZsAdvertiserTargetDayEntry>> tempList= ListUtils.createList(taobaoZsAdvertiserTargetDayEntryList, 5000);
			for(List<TaobaoZsAdvertiserTargetDayEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_TARGETDAY_ENTRYLIST, list);
			}
		}
	}

}
