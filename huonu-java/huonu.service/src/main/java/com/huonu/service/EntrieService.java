package com.huonu.service;

import com.huonu.domain.model.TaobaoZsAdgroupEntry;

public interface EntrieService {

	void sync_all(String call_people,String user_id,int day);
	
	void sync_target(String call_people,String user_id,TaobaoZsAdgroupEntry taobaoZsAdgroupEntry,String sessionkey);
	
	void sync_creativetotal(String call_people,String user_id,String sessionkey);
	
	void sync_adzonetotal(String call_people,String user_id,String sessionkey);
	
	void sync_rptsdownloadtask(String call_people,String user_id,int day,String sessionkey);
	
}
