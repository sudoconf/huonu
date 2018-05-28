package com.huonu.domain.model;

import java.util.Date;

public class TaobaoZsTargetEntry {
	
	private String taobao_user_id;
	  private Long adgroup_id;
	  private String crowd_name;
	  private Long crowd_type;
	  private String crowd_value;
	  private String gmt_create;
	  private String gmt_modified;
	  private Long id;
	  private Long campaign_id;
	  private Date last_update_time;
	  private String matrix_price_d_t_o;
	  private String sub_crowd_d_t_o;

	  public String getTaobao_user_id() {
	    return taobao_user_id;
	  }

	  public void setTaobao_user_id(String taobao_user_id) {
	    this.taobao_user_id = taobao_user_id;
	  }

	  public Long getAdgroup_id() {
	    return adgroup_id;
	  }

	  public void setAdgroup_id(Long adgroup_id) {
	    this.adgroup_id = adgroup_id;
	  }

	  public String getCrowd_name() {
	    return crowd_name;
	  }

	  public void setCrowd_name(String crowd_name) {
	    this.crowd_name = crowd_name;
	  }

	  public Long getCrowd_type() {
	    return crowd_type;
	  }

	  public void setCrowd_type(Long crowd_type) {
	    this.crowd_type = crowd_type;
	  }

	  public String getCrowd_value() {
	    return crowd_value;
	  }

	  public void setCrowd_value(String crowd_value) {
	    this.crowd_value = crowd_value;
	  }

	  public String getGmt_create() {
	    return gmt_create;
	  }

	  public void setGmt_create(String gmt_create) {
	    this.gmt_create = gmt_create;
	  }

	  public String getGmt_modified() {
	    return gmt_modified;
	  }

	  public void setGmt_modified(String gmt_modified) {
	    this.gmt_modified = gmt_modified;
	  }

	  public Long getId() {
	    return id;
	  }

	  public void setId(Long id) {
	    this.id = id;
	  }

	  public Long getCampaign_id() {
	    return campaign_id;
	  }

	  public void setCampaign_id(Long campagin_id) {
	    this.campaign_id = campagin_id;
	  }

	  public Date getLast_update_time() {
	    return last_update_time;
	  }

	  public void setLast_update_time(Date last_update_time) {
	    this.last_update_time = last_update_time;
	  }

	  public String getMatrix_price_d_t_o() {
	    return matrix_price_d_t_o;
	  }

	  public void setMatrix_price_d_t_o(String matrix_price_d_t_o) {
	    this.matrix_price_d_t_o = matrix_price_d_t_o;
	  }

	  public String getSub_crowd_d_t_o() {
	    return sub_crowd_d_t_o;
	  }

	  public void setSub_crowd_d_t_o(String sub_crowd_d_t_o) {
	    this.sub_crowd_d_t_o = sub_crowd_d_t_o;
	  }

}
