package com.huonu.domain.dao;

import java.util.List;

import com.huonu.domain.model.TaobaoZsAdvertiserTargetTotalEntry;

public interface TaobaoZsAdvertiserTargetTotalEntryDao {
	
	void insertOrUpdateTaobaoZsAdvertiserTargetTotalEntryList(List<TaobaoZsAdvertiserTargetTotalEntry> taobaoZsAdvertiserTargetTotalEntryList);
	List<TaobaoZsAdvertiserTargetTotalEntry> getTotalCampByUserID(String taobao_user_id);
	List<TaobaoZsAdvertiserTargetTotalEntry> getTotalAdgroupByUserID(String taobao_user_id);
	List<TaobaoZsAdvertiserTargetTotalEntry> getTotalTargetByUserID(String taobao_user_id);
	void deleteTargetTotalEntryByUserId(String user_id);
		

}
