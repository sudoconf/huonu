package com.huonu.service;

import java.util.List;

import com.huonu.domain.model.TaobaoZsCampEntry;
import com.huonu.domain.model.conidtion.CampCondition;


public interface CampService {
	
	String operate_status(String call_people,String user_id,String campaign_id,Long status);
	
	String add_camp(String call_people, String user_id,CampCondition campCondition);
	
	String modify_camp(String call_people, String user_id,CampCondition campCondition);
	
	String delete_camp(String call_people, String user_id,String campaign_id);
	
	void sync_camplist(String call_people,String user_id,String camp_id,String sessionkey);
	
	List<TaobaoZsCampEntry> getTaobaoZsCampEntryListByUserId(String user_id);
	
	void sync_campbyday(String call_people,String user_id,int day, String sessionkey);
	
	void deleteZsCampByUserId(String taobao_user_id);
	
	void sync_CampaignRtrptsTotal(String call_people,String user_id,Long campaignId,String sessionkey);
	
}
