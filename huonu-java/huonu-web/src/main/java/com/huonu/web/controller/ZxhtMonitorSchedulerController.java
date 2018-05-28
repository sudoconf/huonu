package com.huonu.web.controller;

import javax.servlet.http.HttpServletResponse;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import com.huonu.service.ZxhtMonitorSchedulerService;
import com.huonu.utils.ResultMessageBuilder;
import com.huonu.utils.log.LogUtils;

@Controller
@RequestMapping(value = "/zxht")
public class ZxhtMonitorSchedulerController extends BaseController{
	
	@Autowired
	private ZxhtMonitorSchedulerService zxhtMonitorSchedulerService;
	
	@RequestMapping(value = "/monitor", method = RequestMethod.GET)
    public void  SchedulerMonitor(String type,HttpServletResponse response){
		
		try{
			zxhtMonitorSchedulerService.sceduler_invoke(type);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","ok"), response);
		}catch(Exception e){
			LogUtils.logException(e);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "fail!","失败"), response);
		}

	}

}
