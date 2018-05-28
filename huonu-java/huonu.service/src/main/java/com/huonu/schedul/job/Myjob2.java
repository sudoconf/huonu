package com.huonu.schedul.job;

import java.util.Date;

import org.quartz.Job;
import org.quartz.JobExecutionContext;
import org.quartz.JobExecutionException;

import com.huonu.domain.dao.PersonDao;
import com.huonu.utils.spring.adapter.SpringUtil;

public class Myjob2 implements Job{
	
	 public void execute(JobExecutionContext jobExecutionContext) throws JobExecutionException {
		PersonDao personDao = (PersonDao)SpringUtil.getBean("personDao");
    	System.out.println(personDao);
        System.out.println(new Date() + ": job 2 doing something...");
    }

}
