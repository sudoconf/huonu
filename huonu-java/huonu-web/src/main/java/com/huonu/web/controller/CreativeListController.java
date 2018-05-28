package com.huonu.web.controller;

import javax.servlet.http.HttpServletResponse;

import org.springframework.amqp.core.AmqpTemplate;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import com.huonu.utils.Constants;
import com.huonu.utils.ResultMessageBuilder;
import com.huonu.utils.log.LogUtils;

@Controller
@RequestMapping(value = "/zxht/sync")
public class CreativeListController extends BaseController{
	
	@Autowired 
	private AmqpTemplate amqpTemplate; 
	
	@RequestMapping(value = "/creative", method = RequestMethod.GET)
    public void creativeSync(String user_id,String call_people,HttpServletResponse response){
		try{
			String userMessage=user_id+":"+call_people;
			amqpTemplate.convertAndSend(Constants.CREATIVELIST_QUEUENAME, userMessage);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","ok"), response);
		}catch(Exception e){
			LogUtils.logException(e);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "fail!","失败"), response);
		}
	}
}
