package com.huonu.domain.dao.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.ApiLogDao;
import com.huonu.domain.model.ApiLog;
import com.huonu.domain.mybatis.MyBatisDAO;

@Repository("apiLogDao")
public class ApiLogDaoImpl implements ApiLogDao{
	
	private static final String INSERT_API_LOG = "insertApiLog";
	
	@Autowired
	private MyBatisDAO myBatisDAO;

	public void insertApiLog(ApiLog apiLog) {
		myBatisDAO.insert(INSERT_API_LOG, apiLog);
	}

}
