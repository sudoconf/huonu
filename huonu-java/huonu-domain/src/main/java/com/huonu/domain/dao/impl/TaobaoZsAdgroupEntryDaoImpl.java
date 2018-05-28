package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdgroupEntryDao;
import com.huonu.domain.model.TaobaoZsAdgroupEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsAdgroupEntryDao")
@SuppressWarnings({ "unchecked" })
public class TaobaoZsAdgroupEntryDaoImpl implements TaobaoZsAdgroupEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADGROUP_ENTRYLIST = "insertOrUpdateTaobaoZsAdgroupEntrylist";
	private static final String GET_TAOBAO_ZSADGROUP_ENTRY_BY_USERID = "getTaobaoZsAdgroupEntryByUserId";
	private static final String DELETE_ADGROUP_ENTRY_BY_USERID = "deleteAdgroupEntryByUserid";
	private static final String DELETE_ADGROUP_ENTRY_BY_CONDITIONS = "deleteAdgroupEntryByConditions";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsAdgroupEntrylist(List<TaobaoZsAdgroupEntry> taobaoZsAdgroupEntrylist) {
		if(taobaoZsAdgroupEntrylist!=null&&taobaoZsAdgroupEntrylist.size()>0){
			List<List<TaobaoZsAdgroupEntry>> tempList= ListUtils.createList(taobaoZsAdgroupEntrylist, 5000);
			for(List<TaobaoZsAdgroupEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADGROUP_ENTRYLIST, list);
			}
			
		}
	}

	public void deleteAdgroupEntryByUserid(String taobao_user_id){
		myBatisDAO.delete(DELETE_ADGROUP_ENTRY_BY_USERID, taobao_user_id);
	}
	
	public void deleteAdgroupEntryByConditions(TaobaoZsAdgroupEntry taobaoZsAdgroupEntry){
		myBatisDAO.delete(DELETE_ADGROUP_ENTRY_BY_CONDITIONS, taobaoZsAdgroupEntry);
	}
	
	public List<TaobaoZsAdgroupEntry> getTaobaoZsAdgroupEntryByUserId(
			String taobao_user_id) {
		return myBatisDAO.findForList(GET_TAOBAO_ZSADGROUP_ENTRY_BY_USERID,taobao_user_id);
	}

}
