package com.huonu.domain.model;

import java.util.Date;

public class TaobaoZxhtSyncInfo {
	  private String taobao_user_id;
	  private Long run_status;
	  private Date last_update_time;
	  private String log_date;

	  public String getTaobao_user_id() {
	    return taobao_user_id;
	  }

	  public void setTaobao_user_id(String taobao_user_id) {
	    this.taobao_user_id = taobao_user_id;
	  }

	  public Long getRun_status() {
	    return run_status;
	  }

	  public void setRun_status(Long run_status) {
	    this.run_status = run_status;
	  }

	  public Date getLast_update_time() {
	    return last_update_time;
	  }

	  public void setLast_update_time(Date last_update_time) {
	    this.last_update_time = last_update_time;
	  }

	  public void setLog_date(String log_date) {
	    this.log_date = log_date;
	  }

	  public String getLog_date() {
	    return log_date;
	  }
	}
