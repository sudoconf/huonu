package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsCampEntryDao;
import com.huonu.domain.model.TaobaoZsCampEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsCampEntryDao")
@SuppressWarnings({ "unchecked" })
public class TaobaoZsCampEntryDaoImpl implements TaobaoZsCampEntryDao{
	private static final String INSET_OR_UPDATE_TAOBAO_ZSCAMP_ENTRYLIST = "insertOrUpdateTaobaoZsCampEntrylist";
	private static final String GET_TAOBAO_ZSCAMP_ENTRYLIST_BY_USERID =  "getTaobaoZsCampEntryListByUserId";
	private static final String UPDATE_TAOBAO_ZSCAMP_ENTRY_ONLINESTATUS = "updateTaobaoZsCampEntryOnlineStatus";
	private static final String DELETE_TAOBAO_ZSCAMP_ENTRY_BY_CONDITIONS  ="deleteTaobaoZsCampEntryByConditions";
	private static final String DELETE_TAOBAO_ZSCAMP_ENTRY_BY_USERID = "deleteTaobaoZsCampEntryByUserId";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsCampEntrylist(List<TaobaoZsCampEntry> taobaoZsCampEntrylist) {
		if(taobaoZsCampEntrylist!=null&&taobaoZsCampEntrylist.size()>0){
			List<List<TaobaoZsCampEntry>> tempList= ListUtils.createList(taobaoZsCampEntrylist, 5000);
			for(List<TaobaoZsCampEntry> list:tempList){
				myBatisDAO.insert(INSET_OR_UPDATE_TAOBAO_ZSCAMP_ENTRYLIST, list);
			}
		}
	}

	public List<TaobaoZsCampEntry> getTaobaoZsCampEntryListByUserId(String user_id) {
		return myBatisDAO.findForList(GET_TAOBAO_ZSCAMP_ENTRYLIST_BY_USERID, user_id);
	}

	public void updateTaobaoZsCampEntryOnlineStatus(TaobaoZsCampEntry taobaoZsCampEntry) {
		myBatisDAO.update(UPDATE_TAOBAO_ZSCAMP_ENTRY_ONLINESTATUS, taobaoZsCampEntry);
	}

	public void deleteTaobaoZsCampEntryByConditions(TaobaoZsCampEntry taobaoZsCampEntry) {
		myBatisDAO.delete(DELETE_TAOBAO_ZSCAMP_ENTRY_BY_CONDITIONS, taobaoZsCampEntry);
	}
	
	public void deleteTaobaoZsCampEntryByUserId(String user_id) {
		myBatisDAO.delete(DELETE_TAOBAO_ZSCAMP_ENTRY_BY_USERID, user_id);
	}

}
