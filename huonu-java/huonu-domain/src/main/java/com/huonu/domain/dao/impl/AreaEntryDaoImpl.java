package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.AreaEntryDao;
import com.huonu.domain.model.AreaEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("areaEntryDao")
public class AreaEntryDaoImpl implements AreaEntryDao{
	
	private static final String INSERT_AREAENTRY = "insertAreaEntry";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertAreaEntry(List<AreaEntry> areaList) {
		if(areaList!=null&&areaList.size()>0){
			List<List<AreaEntry>> tempList= ListUtils.createList(areaList, 5000);
			for(List<AreaEntry> list:tempList){
				myBatisDAO.insert(INSERT_AREAENTRY, list);
			}
		}
	}
}
