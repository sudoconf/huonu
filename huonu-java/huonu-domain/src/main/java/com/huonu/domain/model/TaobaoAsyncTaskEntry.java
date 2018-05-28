package com.huonu.domain.model;

public class TaobaoAsyncTaskEntry {
	  private String taobaoUserId;
	  private String userName;
	  private Long taskId;
	  private String startDate;
	  private String endDate;
	  private Long campModel;
	  private String taskStatus;
	  private String hierarchy;
	  private String effectType;
	  private String creatTime;
	  private String error_Msg;

	  public String getTaobaoUserId() {
	    return taobaoUserId;
	  }

	  public void setTaobaoUserId(String userid) {
	    this.taobaoUserId = userid;
	  }

	  public String getUserName() {
	    return userName;
	  }

	  public void setUserName(String userName) {
	    this.userName = userName;
	  }

	  public Long getTaskId() {
	    return taskId;
	  }

	  public void setTaskId(Long taskId) {
	    this.taskId = taskId;
	  }
	  
	  public String getStartDate() {
			return startDate;
	  }

	  public void setStartDate(String startDate) {
	    this.startDate = startDate;
	  }

	  public String getEndDate() {
	    return endDate;
	  }

	  public void setEndDate(String endDate) {
	    this.endDate = endDate;
	  }

	  public Long getCampModel() {
	    return campModel;
	  }

	  public void setCampModel(Long campModel) {
	    this.campModel = campModel;
	  }

	  public String getTaskStatus() {
	    return taskStatus;
	  }

	  public void setTaskStatus(String taskStatus) {
	    this.taskStatus = taskStatus;
	  }

	  public String getHierarchy() {
	    return hierarchy;
	  }

	  public void setHierarchy(String hierarchy) {
	    this.hierarchy = hierarchy;
	  }

	  public String getEffectType() {
	    return effectType;
	  }

	  public void setEffectType(String effectType) {
	    this.effectType = effectType;
	  }

	  public String getCreatTime() {
	    return creatTime;
	  }

	  public void setCreatTime(String creatTime) {
	    this.creatTime = creatTime;
	  }

	  public String getError_Msg() {
		return error_Msg;
	  }

	  public void setError_Msg(String error_Msg) {
		this.error_Msg = error_Msg;
	  }

	
	  
	}
