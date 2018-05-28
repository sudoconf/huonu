package com.huonu.utils;

import java.io.Serializable;
import java.util.Date;

/**
 * 持久对象基础属性
 */
public class BaseEntity implements Serializable {

    private static final long serialVersionUID = 1L;

    private Long id;
    private Date createTime; 
    private String createBy;
    private Date updateTime;
    private String updateBy;
    private String creatorName;
    private String updaterName;

    public BaseEntity(){}


    public Long getId() {
		return id;
	}


	public void setId(Long id) {
		this.id = id;
	}


	public Date getCreateTime() {
        return createTime;
    }

    public void setCreateTime(Date createTime) {
        this.createTime = createTime;
    }

    public String getCreateBy() {
        return createBy;
    }

    public void setCreateBy(String createBy) {
        this.createBy = createBy;
    }

    public Date getUpdateTime() {
        return updateTime;
    }

    public void setUpdateTime(Date updateTime) {
        this.updateTime = updateTime;
    }

    public String getUpdateBy() {
        return updateBy;
    }

    public void setUpdateBy(String updateBy) {
        this.updateBy = updateBy;
    }

	public String getCreatorName() {
		return creatorName;
	}


	public void setCreatorName(String creatorName) {
		this.creatorName = creatorName;
	}


	public String getUpdaterName() {
		return updaterName;
	}


	public void setUpdaterName(String updaterName) {
		this.updaterName = updaterName;
	}

}
