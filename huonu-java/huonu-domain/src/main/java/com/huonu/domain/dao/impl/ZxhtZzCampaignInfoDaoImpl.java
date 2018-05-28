package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.ZxhtZzCampaignInfoDao;
import com.huonu.domain.model.ZxhtZzCampaignInfo;
import com.huonu.domain.mybatis.MyBatisDAO;

@Repository("zxhtZzCampaignInfoDao")
@SuppressWarnings({ "unchecked" })
public class ZxhtZzCampaignInfoDaoImpl implements ZxhtZzCampaignInfoDao{
	
	private static final String GRT_CHANGE_STATUS_ADGROUP = "getChangeStatusAdgroup";
	private static final String GET_CREATEIVE_TEST_MONITOR_USERID = "getCreativetestMonitorUserId";
	private static final String UPDATE_TIME_EXPIRES_STATUS = "updateTimeExpiresStatus";
	private static final String GET_CTRMONITOR_INFO = "getCtrMonitorInfo";
	private static final String GET_CREATIVE_MONITORCTR_USERID = "getCreativeMonitorCtrUserId";
	private static final String GET_CROWD_MONITOR_COVERAGE_USERID = "getCrowdMonitorCoverageUserId";
	private static final String GET_CHARGE_MONITOR_USERID = "getChargeMonitorUserId";
	private static final String GET_CHARGE_MONITOR_INFO = "getChargeMonitorInfo";
	private static final String GET_PRICE_MONITOR_TRMPLATE_USERID = "getPriceMonitorTemplateUserId";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	
	public List<ZxhtZzCampaignInfo> getChangeStatusAdgroup(String taobao_user_id) {
		return myBatisDAO.findForList(GRT_CHANGE_STATUS_ADGROUP,taobao_user_id);
	}
	
	public List<ZxhtZzCampaignInfo> getCreativetestMonitorUserId() {
		return myBatisDAO.findForList(GET_CREATEIVE_TEST_MONITOR_USERID);
	}

	public List<ZxhtZzCampaignInfo> getCreativetestMonitorInfo(
			String taobao_user_id) {
		return null;
	}

	public void updateTimeExpiresStatus(ZxhtZzCampaignInfo campaignInfo) {
		myBatisDAO.update(UPDATE_TIME_EXPIRES_STATUS, campaignInfo);
	}

	public List<ZxhtZzCampaignInfo> getCtrMonitorInfo(String userId) {
		return myBatisDAO.findForList(GET_CTRMONITOR_INFO,userId);
	}

	public List<ZxhtZzCampaignInfo> getCreativeMonitorCtrUserId() {
		return myBatisDAO.findForList(GET_CREATIVE_MONITORCTR_USERID);
	}

	public List<ZxhtZzCampaignInfo> getCrowdMonitorCoverageUserId() {
		return myBatisDAO.findForList(GET_CROWD_MONITOR_COVERAGE_USERID);
	}

	public List<ZxhtZzCampaignInfo> getChargeMonitorUserId() {
		return myBatisDAO.findForList(GET_CHARGE_MONITOR_USERID);
	}

	public List<ZxhtZzCampaignInfo> getChargeMonitorInfo(String taobao_user_id) {
		return myBatisDAO.findForList(GET_CHARGE_MONITOR_INFO,taobao_user_id);
	}

	public List<ZxhtZzCampaignInfo> getPriceMonitorTemplateUserId() {
		return myBatisDAO.findForList(GET_PRICE_MONITOR_TRMPLATE_USERID);
	}

	

}
