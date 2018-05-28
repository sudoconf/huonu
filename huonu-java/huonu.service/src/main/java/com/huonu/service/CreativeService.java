package com.huonu.service;

import com.huonu.domain.model.conidtion.CreativeCondition;

public interface CreativeService {
	
	String creative_add(String call_people, String user_id,CreativeCondition creativeCondition);
	
	String creative_bind(String call_people, String user_id,CreativeCondition creativeCondition);
	
	void sync_creative(String call_people,String userid, Long campaign_id,Long adgroup_id,String sessionkey);
	
	void sync_ZsAdvertiserCreativeRtrptsTotal(String call_people,String user_id,Long campaignId,Long adgroupId,Long creativeId,String sessionkey);

}
