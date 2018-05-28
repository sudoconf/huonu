package com.huonu.service;

public interface ZoneService {
	
	void sync_zone(String call_people,String user_id , String sessionkey);
	
	void sync_ZsAdvertiserAdzoneRtrptsTotal(String call_people,String user_id,Long campaignId,Long adgroupId,Long adzoneId,String sessionkey);

}
