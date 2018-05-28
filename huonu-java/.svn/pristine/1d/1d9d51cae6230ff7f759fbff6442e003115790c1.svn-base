package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.UserDao;
import com.huonu.domain.model.User;
import com.huonu.domain.mybatis.MyBatisDAO;

@Repository("userDao")
@SuppressWarnings({ "unchecked" })
public class UserDaoImpl implements UserDao{

	private static final String GET_NORMAL_MANNAGE_MAIL = "getNormalMannageMail";
	
	private static final String GET_ADVANCE_MANNAGE_MAIL = "getAdvancedMannageMail";
	
	@Autowired
	private MyBatisDAO myBatisDAO;

	public List<User> getNormalMannageMail(String user_id) {
		return myBatisDAO.findForList(GET_NORMAL_MANNAGE_MAIL, user_id);
	}

	public List<User> getAdvancedMannageMail(String user_id) {
		return myBatisDAO.findForList(GET_ADVANCE_MANNAGE_MAIL, user_id);
	}
}
