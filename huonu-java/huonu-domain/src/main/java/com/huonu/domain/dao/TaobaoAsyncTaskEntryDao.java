package com.huonu.domain.dao;
import java.util.List;
import com.huonu.domain.model.TaobaoAsyncTaskEntry;

public interface TaobaoAsyncTaskEntryDao {
	
	void insertOrUpdateTaobaoAsyncTaskEntryList(List<TaobaoAsyncTaskEntry> taobaoAsyncTaskEntryList);
	
	List<TaobaoAsyncTaskEntry> getTodayTaobaoAsyncTaskByUserIdAndTaskStatus(TaobaoAsyncTaskEntry taobaoAsyncTaskEntry);
	
	void updateTaobaoAsyncTaskStatus(TaobaoAsyncTaskEntry taobaoAsyncTaskEntry);

}