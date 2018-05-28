package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoAsyncTaskEntryDao;
import com.huonu.domain.model.TaobaoAsyncTaskEntry;
import com.huonu.domain.mybatis.MyBatisDAO;
import com.huonu.utils.ListUtils;

@Repository("taobaoAsyncTaskEntryDao")
@SuppressWarnings({ "unchecked" })
public class TaobaoAsyncTaskEntryDaoImpl implements TaobaoAsyncTaskEntryDao{

	private static final String INSERT_OR_UPDATE_TAOBAO_ASYNCTASK_ENTRYLIST = "insertOrUpdateTaobaoAsyncTaskEntryList";
	private static final String GET_TODAY_TAOBAO_ASYNCTASK_BY_USERID_AND_TASKSTATUS = "getTodayTaobaoAsyncTaskByUserIdAndTaskStatus";
	private static final String UPDATE_TAOBAO_ASYNC_TASKSTATUS = "updateTaobaoAsyncTaskStatus";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public void insertOrUpdateTaobaoAsyncTaskEntryList(List<TaobaoAsyncTaskEntry> taobaoAsyncTaskEntryList) {
		if(taobaoAsyncTaskEntryList!=null&&taobaoAsyncTaskEntryList.size()>0){
			List<List<TaobaoAsyncTaskEntry>> tempList= ListUtils.createList(taobaoAsyncTaskEntryList, 5000);
			for(List<TaobaoAsyncTaskEntry> list:tempList){
				myBatisDAO.insert(INSERT_OR_UPDATE_TAOBAO_ASYNCTASK_ENTRYLIST, list);
			}
		}
	}

	public List<TaobaoAsyncTaskEntry> getTodayTaobaoAsyncTaskByUserIdAndTaskStatus(
			TaobaoAsyncTaskEntry taobaoAsyncTaskEntry) {
		return myBatisDAO.findForList(GET_TODAY_TAOBAO_ASYNCTASK_BY_USERID_AND_TASKSTATUS,taobaoAsyncTaskEntry);
	}

	public void updateTaobaoAsyncTaskStatus(
			TaobaoAsyncTaskEntry taobaoAsyncTaskEntry) {
		myBatisDAO.update(UPDATE_TAOBAO_ASYNC_TASKSTATUS, taobaoAsyncTaskEntry);
	}

}
