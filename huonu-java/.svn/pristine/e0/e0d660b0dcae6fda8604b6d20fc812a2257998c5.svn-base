package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.mybatis.MyBatisDAO;

@Repository("taobaoAuthorizeUserDao")
@SuppressWarnings({ "unchecked" })
public class TaobaoAuthorizeUserDaoImpl implements TaobaoAuthorizeUserDao{

	private static final String GET_USERINFO_BY_TAOBAO_USERID = "getUserInfoByTaoBaoUserId";
	private static final String GET_USERINFOS_BY_SYNC_STATUS_ID = "getUserInfosBySyncStatusId";
	private static final String UPDATE_SYNCSTATUS_BY_TAOBAO_USERID = "updateSyncStatusByTaoBaoUserId";
	private static final String GET_ALL_USERINFOS = "getAllUserInfos";
	
	@Autowired
	private MyBatisDAO myBatisDAO;
	
	public TaobaoAuthorizeUser getUserInfoByTaoBaoUserId(String userid) {
		return (TaobaoAuthorizeUser)myBatisDAO.findForObject(GET_USERINFO_BY_TAOBAO_USERID, userid);
	}

	public List<TaobaoAuthorizeUser> getUserInfosBySyncStatusId(Long sync_statusid) {
		return myBatisDAO.findForList(GET_USERINFOS_BY_SYNC_STATUS_ID, sync_statusid);
	}

	public void updateSyncStatusByTaoBaoUserId(TaobaoAuthorizeUser taobaoAuthorizeUser) {
		myBatisDAO.update(UPDATE_SYNCSTATUS_BY_TAOBAO_USERID, taobaoAuthorizeUser);
	}

	public List<TaobaoAuthorizeUser> getAllUserInfos() {
		return myBatisDAO.findForList(GET_ALL_USERINFOS);
	}

}
