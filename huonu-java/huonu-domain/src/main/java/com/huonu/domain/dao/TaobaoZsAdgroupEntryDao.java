package com.huonu.domain.dao;

import java.util.List;

import com.huonu.domain.model.TaobaoZsAdgroupEntry;

public interface TaobaoZsAdgroupEntryDao {
	
	void insertOrUpdateTaobaoZsAdgroupEntrylist(List<TaobaoZsAdgroupEntry> taobaoZsAdgroupEntrylist);
	
	List<TaobaoZsAdgroupEntry> getTaobaoZsAdgroupEntryByUserId(String taobao_user_id);
	
	void deleteAdgroupEntryByUserid(String taobao_user_id);
	
	void deleteAdgroupEntryByConditions(TaobaoZsAdgroupEntry taobaoZsAdgroupEntry);
	
}
