package com.huonu.domain.model.conidtion;

public class CreativeCondition {
	
	private String name; //创意名称
	private Boolean is_trans_to_wifi = false; //是否需要pc转无线链接，true：是，false：否
	private String image; //图片路径
	private Long cat_id; //类目ID
	private String click_url; //点击链接
	
	private Long adgroupId;
	private Long campaignId;
	private String creativeIdList;

	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public Boolean getIs_trans_to_wifi() {
		return is_trans_to_wifi;
	}
	public void setIs_trans_to_wifi(Boolean is_trans_to_wifi) {
		this.is_trans_to_wifi = is_trans_to_wifi;
	}
	public String getImage() {
		return image;
	}
	public void setImage(String image) {
		this.image = image;
	}
	public Long getCat_id() {
		return cat_id;
	}
	public void setCat_id(Long cat_id) {
		this.cat_id = cat_id;
	}
	public String getClick_url() {
		return click_url;
	}
	public void setClick_url(String click_url) {
		this.click_url = click_url;
	}
	public Long getAdgroupId() {
		return adgroupId;
	}
	public void setAdgroupId(Long adgroupId) {
		this.adgroupId = adgroupId;
	}
	public Long getCampaignId() {
		return campaignId;
	}
	public void setCampaignId(Long campaignId) {
		this.campaignId = campaignId;
	}
	public String getCreativeIdList() {
		return creativeIdList;
	}
	public void setCreativeIdList(String creativeIdList) {
		this.creativeIdList = creativeIdList;
	}
	
}
