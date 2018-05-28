package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoCrowdMonitorCoverageEntryDao;
import com.huonu.domain.model.TaobaoCrowdMonitorCoverageEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetDayEntry;
import com.huonu.domain.mybatis.MyBatisDAO;

@Repository("taobaoCrowdMonitorCoverageEntryDao")
@SuppressWarnings({ "unchecked" })
public class TaobaoCrowdMonitorCoverageEntryDaoImpl implements TaobaoCrowdMonitorCoverageEntryDao{

	private static final String GET_CROWD_COVERAGE_INFO = "getCrowdCoverageInfo";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public List<TaobaoCrowdMonitorCoverageEntry> getCrowdCoverageInfo(
			TaobaoZsAdvertiserTargetDayEntry taobaoZsAdvertiserTargetDayEntry) {
		return myBatisDAO.findForList(GET_CROWD_COVERAGE_INFO, taobaoZsAdvertiserTargetDayEntry);
	}

}
