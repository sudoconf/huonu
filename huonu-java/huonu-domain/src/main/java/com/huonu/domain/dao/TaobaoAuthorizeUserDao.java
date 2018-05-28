package com.huonu.domain.dao;

import java.util.List;

import com.huonu.domain.model.TaobaoAuthorizeUser;


/*
 * 淘宝店家信息
 * token
 */
public interface TaobaoAuthorizeUserDao {

	TaobaoAuthorizeUser getUserInfoByTaoBaoUserId(String userid);
	
	List<TaobaoAuthorizeUser> getUserInfosBySyncStatusId(Long sync_statusid);
	
	List<TaobaoAuthorizeUser> getAllUserInfos();
	
	void updateSyncStatusByTaoBaoUserId(TaobaoAuthorizeUser taobaoAuthorizeUser);
	
}
