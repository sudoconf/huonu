package com.huonu.domain.dao;

import java.util.List;

import com.huonu.domain.model.TaobaoCrowdMonitorCoverageEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserTargetDayEntry;

public interface TaobaoCrowdMonitorCoverageEntryDao {

	List<TaobaoCrowdMonitorCoverageEntry> getCrowdCoverageInfo(TaobaoZsAdvertiserTargetDayEntry taobaoZsAdvertiserTargetDayEntry);

}