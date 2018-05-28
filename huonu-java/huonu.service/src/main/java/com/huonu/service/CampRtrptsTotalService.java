package com.huonu.service;

public interface CampRtrptsTotalService {

	void sync_rtrptstotal(String call_people,String user_id);
	
	void sync_ZsAdvertiserTargetRtrptsTotal(String call_people,String user_id,Long campaignId,Long adgroupId,Long targetId,String sessionkey);
	
	void sync_ZsTargetEntry(String call_people,String user_id,Long campaign_id,Long adgroup_id,String sessionkey);
	
}