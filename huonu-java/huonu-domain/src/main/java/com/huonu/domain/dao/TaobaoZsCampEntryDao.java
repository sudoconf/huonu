package com.huonu.domain.dao;

import java.util.List;

import com.huonu.domain.model.TaobaoZsCampEntry;

public interface TaobaoZsCampEntryDao {
	
	void insertOrUpdateTaobaoZsCampEntrylist(List<TaobaoZsCampEntry> taobaoZsCampEntrylist);

	List<TaobaoZsCampEntry> getTaobaoZsCampEntryListByUserId(String user_id);
	
	void updateTaobaoZsCampEntryOnlineStatus(TaobaoZsCampEntry taobaoZsCampEntry);
	
	void deleteTaobaoZsCampEntryByConditions(TaobaoZsCampEntry taobaoZsCampEntry);
	
	void deleteTaobaoZsCampEntryByUserId(String user_id);
}