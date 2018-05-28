package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntryDao;
import com.huonu.domain.model.TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry;
import com.huonu.domain.mybatis.MyBatisDAO;

@Repository("taobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntryDao")
@SuppressWarnings({ "unchecked" })
public class TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntryDaoImpl implements TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntryDao{

	private static final String GET_UNBIND_DATA = "getUnbindData";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	
	public List<TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry> getUnbindData(
			TaobaoZsAdvertiserCreativeMonitorTestRtrptsTotalEntry creativeRtrptsTotal) {
		return myBatisDAO.findForList(GET_UNBIND_DATA, creativeRtrptsTotal);
	}

}
