package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserAdzoneDayEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserAdzoneDayEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;


@Repository("taobaoZsAdvertiserAdzoneDayEntryDao")
public class TaobaoZsAdvertiserAdzoneDayEntryDaoImpl implements TaobaoZsAdvertiserAdzoneDayEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_ADZONEDAY_ENTRYLIST = "insertOrUpdateTaobaoZsAdvertiserAdzoneDayEntryList";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsAdvertiserAdzoneDayEntryList(
			List<TaobaoZsAdvertiserAdzoneDayEntry> taobaoZsAdvertiserAdzoneDayEntryList) {
		if(taobaoZsAdvertiserAdzoneDayEntryList!=null&&taobaoZsAdvertiserAdzoneDayEntryList.size()>0){
			
			List<List<TaobaoZsAdvertiserAdzoneDayEntry>> tempList= ListUtils.createList(taobaoZsAdvertiserAdzoneDayEntryList, 5000);
			for(List<TaobaoZsAdvertiserAdzoneDayEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_ADZONEDAY_ENTRYLIST, list);
			}
		}
	}

}
