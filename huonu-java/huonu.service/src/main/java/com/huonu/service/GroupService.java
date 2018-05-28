package com.huonu.service;

import java.util.List;

import com.huonu.domain.model.TaobaoZsAdgroupEntry;
import com.huonu.domain.model.conidtion.GroupCondition;

public interface GroupService {
	
	String operate_status(String call_people, String user_id,Long campaign_id, String adgroup_id_list,Long status); 
	
	String add_group(String call_people, String user_id,GroupCondition groupCondition);
	
	String modify_group(String call_people, String user_id,GroupCondition groupCondition);
	
	String delete_group(String call_people, String user_id,Long campaign_id,String adgroup_id);
	
	void sync_group(String call_people,String user_id,Long campagin_id, String adgroupIdList,String sessionkey);
	 
	void deleteAdgroupEntryByUserid(String taobao_user_id);
	
	List<TaobaoZsAdgroupEntry> getTaobaoZsAdgroupEntryByUserId(String taobao_user_id);
	
	void sync_adgroupbyday(String call_people,String user_id,int day, String sessionkey);
	
	void sync_AdgroupRtrptsTotal(String call_people,String user_id,Long campaignId,Long adgroup_Id,String sessionkey);

}
