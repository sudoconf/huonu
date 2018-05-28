package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdzoneEntryDao;
import com.huonu.domain.model.TaobaoZsAdzoneEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsAdzoneEntryDao")
public class TaobaoZsAdzoneEntryDaoImpl implements TaobaoZsAdzoneEntryDao{
	
	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADZONE_ENTRYLIST = "insertOrUpdateTaobaoZsAdZoneEntrylist";

	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsAdZoneEntrylist(List<TaobaoZsAdzoneEntry> taobaoZsAdzoneEntryList) {
		if(taobaoZsAdzoneEntryList!=null&&taobaoZsAdzoneEntryList.size()>0){
			
			List<List<TaobaoZsAdzoneEntry>> tempList= ListUtils.createList(taobaoZsAdzoneEntryList, 5000);
			for(List<TaobaoZsAdzoneEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADZONE_ENTRYLIST, list);
			}
		}
	}
	

}
