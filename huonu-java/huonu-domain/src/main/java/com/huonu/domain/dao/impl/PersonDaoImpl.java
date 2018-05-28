package com.huonu.domain.dao.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.huonu.domain.dao.PersonDao;
import com.huonu.domain.model.Person;
import com.huonu.domain.mybatis.MyBatisDAO;


@Repository("personDao")
@SuppressWarnings({ "unchecked" })
public class PersonDaoImpl implements PersonDao {

	private static final String GET_PERSON_BY_SEX = "getPersonsBySex";
	
	@Autowired
	private MyBatisDAO myBatisDAO;

	public List<Person> getPersonsBySex(String name) {
		return myBatisDAO.findForList(GET_PERSON_BY_SEX, name);
	}
	
}