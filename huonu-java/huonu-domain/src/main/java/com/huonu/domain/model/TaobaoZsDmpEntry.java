package com.huonu.domain.model;

import java.util.Date;

public class TaobaoZsDmpEntry {
	
	private String taobao_user_id;
    private Long coverage;
    private String enable_time;
    private String dmp_crowd_name;
    private Long dmp_crowd_id;
    private String update_time;
    private Date last_update_time;
    
    public void setCoverage(Long coverage) {
        this.coverage = coverage;
    }

    public Long getCoverage() {
        return coverage;
    }

    public void setDmp_crowd_id(Long dmp_crowd_id) {
        this.dmp_crowd_id = dmp_crowd_id;
    }

    public Long getDmp_crowd_id() {
        return dmp_crowd_id;
    }

    public void setDmp_crowd_name(String dmp_crowd_name) {
        this.dmp_crowd_name = dmp_crowd_name;
    }

    public String getDmp_crowd_name() {
        return dmp_crowd_name;
    }

    public void setEnable_time(String enable_time) {
        this.enable_time = enable_time;
    }

    public String getEnable_time() {
        return enable_time;
    }

    public void setUpdate_time(String update_time) {
        this.update_time = update_time;
    }

    public String getUpdate_time() {
        return update_time;
    }

    public void setTaobao_user_id(String taobao_user_id) {
        this.taobao_user_id = taobao_user_id;
    }

    public String getTaobao_user_id() {
        return taobao_user_id;
    }

    public Date getLast_update_time() {
        return last_update_time;
    }

    public void setLast_update_time(Date last_update_time) {
        this.last_update_time = last_update_time;
    }

}
