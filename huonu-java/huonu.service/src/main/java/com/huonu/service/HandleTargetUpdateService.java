package com.huonu.service;

public interface HandleTargetUpdateService {
	
	void invoke(String call_people,String userid);
	
	void sync_ZsDmp(String call_people,String userid, String sessionkey);
	
	void sync_ZsCat(String call_people,String userid, String sessionkey);
	
}
