package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserTargetTotalEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetTotalEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoZsAdvertiserTargetTotalEntryDao")
@SuppressWarnings({ "unchecked" })
public class TaobaoZsAdvertiserTargetTotalEntryDaoImpl implements TaobaoZsAdvertiserTargetTotalEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_TARGETTOTAL_ENTRYLIST = "insertOrUpdateTaobaoZsAdvertiserTargetTotalEntryList";
	private static final String GET_TOTAL_CAMP_BY_USERID = "getTotalCampByUserID";
	private static final String GET_TOTAL_ADGROUP_BY_USERID = "getTotalAdgroupByUserID";
	private static final String GET_TOTAL_TARGET_BY_USERID = "getTotalTargetByUserID";
	private static final String DELETE_TARGET_TOTALENTRY_BY_USERID = "deleteTargetTotalEntryByUserId";

	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoZsAdvertiserTargetTotalEntryList(List<TaobaoZsAdvertiserTargetTotalEntry> taobaoZsAdvertiserTargetTotalEntryList) {
		if(taobaoZsAdvertiserTargetTotalEntryList!=null&&taobaoZsAdvertiserTargetTotalEntryList.size()>0){
			
			List<List<TaobaoZsAdvertiserTargetTotalEntry>> tempList= ListUtils.createList(taobaoZsAdvertiserTargetTotalEntryList, 5000);
			for(List<TaobaoZsAdvertiserTargetTotalEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ZSADVERTISER_TARGETTOTAL_ENTRYLIST, list);
			}
		}
	}
	
	public List<TaobaoZsAdvertiserTargetTotalEntry> getTotalCampByUserID(String taobao_user_id) {
		return myBatisDAO.findForList(GET_TOTAL_CAMP_BY_USERID,taobao_user_id);
	}

	public List<TaobaoZsAdvertiserTargetTotalEntry> getTotalAdgroupByUserID(String taobao_user_id) {
		return myBatisDAO.findForList(GET_TOTAL_ADGROUP_BY_USERID,taobao_user_id);
	}

	public List<TaobaoZsAdvertiserTargetTotalEntry> getTotalTargetByUserID(String taobao_user_id) {
		return myBatisDAO.findForList(GET_TOTAL_TARGET_BY_USERID,taobao_user_id);
	}

	public void deleteTargetTotalEntryByUserId(String user_id) {
		myBatisDAO.delete(DELETE_TARGET_TOTALENTRY_BY_USERID, user_id);
	}

	

}
