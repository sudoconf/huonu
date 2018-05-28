package com.huonu.domain.model.conidtion;

import java.util.List;

import com.taobao.api.request.ZuanshiBannerAdgroupCreateRequest.AdzoneBid;
import com.taobao.api.request.ZuanshiBannerAdgroupCreateRequest.Crowd;

public class GroupCondition {
	
	private Long id; //单元ID
	private Long campaign_id; //计划ID
	private Long intelligent_bid; //智能出价，0：不使用,1：优化进店，2：优化成交，cpc不能选择2优化成交
	private Long adboard_filter; //创意优选，1：开启，0关闭，其他值默认开启，cpc不能修改这个字段
	private String name;//单元名称
	private List<Crowd> crowds;//绑定定向
	private List<AdzoneBid> adzone_bid_list;//资源位列表
	
	public Long getId() {
		return id;
	}
	public void setId(Long id) {
		this.id = id;
	}
	public Long getCampaign_id() {
		return campaign_id;
	}
	public void setCampaign_id(Long campaign_id) {
		this.campaign_id = campaign_id;
	}
	public Long getIntelligent_bid() {
		return intelligent_bid;
	}
	public void setIntelligent_bid(Long intelligent_bid) {
		this.intelligent_bid = intelligent_bid;
	}
	public Long getAdboard_filter() {
		return adboard_filter;
	}
	public void setAdboard_filter(Long adboard_filter) {
		this.adboard_filter = adboard_filter;
	}
	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public List<Crowd> getCrowds() {
		return crowds;
	}
	public void setCrowds(List<Crowd> crowds) {
		this.crowds = crowds;
	}
	public List<AdzoneBid> getAdzone_bid_list() {
		return adzone_bid_list;
	}
	public void setAdzone_bid_list(List<AdzoneBid> adzone_bid_list) {
		this.adzone_bid_list = adzone_bid_list;
	}
	
}
