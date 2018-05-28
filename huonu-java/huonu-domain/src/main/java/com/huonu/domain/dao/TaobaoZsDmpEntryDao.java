package com.huonu.domain.dao;

import java.util.List;

import com.huonu.domain.model.TaobaoZsDmpEntry;

public interface TaobaoZsDmpEntryDao {

	void deleteDmpByTime(TaobaoZsDmpEntry taobaoZsDmpEntry);
	
	void insertOrUpdateTaobaoZsDmpEntryList(List<TaobaoZsDmpEntry> taobaoZsDmpEntryList);
	
}
