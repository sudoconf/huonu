package com.huonu.service;

public interface ProtionService {
	
	 void sync_protion(String call_people,String user_id,int day);
	 
	 void sync_targettotal(String call_people,String user_id,int day,String sessionkey);
	 
	 void sync_targetday(String call_people,String user_id,int day,String sessionkey);
	 
	 void sync_batchtargetday(String call_people,String user_id,int day,String sessionkey);
	 
	 void sync_targetdaysum(String call_people,String user_id,int day,String sessionkey);
	 
	 void sync_rptsdownloadtask(String call_people,String user_id,int day,String sessionkey);
	 
}
