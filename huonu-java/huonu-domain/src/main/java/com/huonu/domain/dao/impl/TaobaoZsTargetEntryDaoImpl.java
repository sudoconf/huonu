package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsTargetEntryDao;
import com.huonu.domain.model.TaobaoZsTargetEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsTargetEntryDao")
public class TaobaoZsTargetEntryDaoImpl implements TaobaoZsTargetEntryDao{
	
	private static final String INSERT_OR_UPDATE_TAOBAO_ZSTARGET_ENTRYLIST = "insertOrUpdateTaobaoZsTargetEntrylist";
	private static final String DELETE_ZSTARGET_BY_TIME = "deleteZsTargetByTime";
	private static final String DELETE_ZSTARGET_BY_USERID = "deleteZsTargetByUserId";
	
	@Autowired
	private MyBatisDAO myBatisDAO;

	public void insertOrUpdateTaobaoZsTargetEntrylist(List<TaobaoZsTargetEntry> taobaoZsTargetEntrylist) {
		if(taobaoZsTargetEntrylist!=null&&taobaoZsTargetEntrylist.size()>0){
			
			List<List<TaobaoZsTargetEntry>> tempList= ListUtils.createList(taobaoZsTargetEntrylist, 5000);
			for(List<TaobaoZsTargetEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSTARGET_ENTRYLIST, list);
			}
		
		}
	}

	public void deleteZsTargetByTime(TaobaoZsTargetEntry taobaoZsTargetEntry) {
		myBatisDAO.delete(DELETE_ZSTARGET_BY_TIME,taobaoZsTargetEntry);
	}
	
	public void deleteZsTargetByUserId(String taobao_user_id) {
		myBatisDAO.delete(DELETE_ZSTARGET_BY_USERID,taobao_user_id);
	}

}
