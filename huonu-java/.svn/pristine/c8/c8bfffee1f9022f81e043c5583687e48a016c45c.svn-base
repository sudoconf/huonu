package com.huonu.service.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.huonu.domain.dao.PersonDao;
import com.huonu.domain.model.Person;
import com.huonu.service.PersonService;


@Service("personService")
public class PersonServiceImpl implements PersonService {
	
	@Autowired 
	private PersonDao personDao;

	public List<Person> getPersonsBySex(String name) {
		return personDao.getPersonsBySex(name);
	}
	
	public void addbean(){
		
	}
	
}
