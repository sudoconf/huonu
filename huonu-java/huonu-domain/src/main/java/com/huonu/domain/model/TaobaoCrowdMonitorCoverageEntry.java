package com.huonu.domain.model;

public class TaobaoCrowdMonitorCoverageEntry {
	
	private String crowd_value;
	private String campaign_name;;
	private String ad_pv;
	private Long mail;
	
	public String getCrowd_value() {
		return crowd_value;
	}
	public void setCrowd_value(String crowd_value) {
		this.crowd_value = crowd_value;
	}
	public String getCampaign_name() {
		return campaign_name;
	}
	public void setCampaign_name(String campaign_name) {
		this.campaign_name = campaign_name;
	}
	public String getAd_pv() {
		return ad_pv;
	}
	public void setAd_pv(String ad_pv) {
		this.ad_pv = ad_pv;
	}
	public Long getMail() {
		return mail;
	}
	public void setMail(Long mail) {
		this.mail = mail;
	}

}
