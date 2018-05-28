package com.huonu.domain.dao;

import java.util.List;

import com.huonu.domain.model.ZxhtZzCampaignInfo;

public interface ZxhtZzCampaignInfoDao {
	
	List<ZxhtZzCampaignInfo> getChangeStatusAdgroup(String taobao_user_id);
	
	List<ZxhtZzCampaignInfo>  getCreativetestMonitorUserId();
	
	List<ZxhtZzCampaignInfo> getCreativetestMonitorInfo(String taobao_user_id);
	
	void updateTimeExpiresStatus(ZxhtZzCampaignInfo campaignInfo);
	
	List<ZxhtZzCampaignInfo> getCtrMonitorInfo(String userId);
	
	List<ZxhtZzCampaignInfo> getCreativeMonitorCtrUserId();
	
	List<ZxhtZzCampaignInfo> getCrowdMonitorCoverageUserId();
	
	List<ZxhtZzCampaignInfo> getChargeMonitorUserId();
	
	List<ZxhtZzCampaignInfo> getChargeMonitorInfo(String taobao_user_id);
	
	List<ZxhtZzCampaignInfo> getPriceMonitorTemplateUserId();
	
}
