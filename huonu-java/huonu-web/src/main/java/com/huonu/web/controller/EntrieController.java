package com.huonu.web.controller;

import javax.servlet.http.HttpServletResponse;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import com.huonu.service.HandleFirstEntrieSyncService;
import com.huonu.utils.ResultMessageBuilder;
import com.huonu.utils.log.LogUtils;

@Controller
@RequestMapping(value = "/zxht/sync")
public class EntrieController extends BaseController{
	
	@Autowired
	private HandleFirstEntrieSyncService handleFirstEntrieSyncService;
	
	/*
	 * 手动首次全量同步
	 */
	@RequestMapping(value = "/entrie", method = RequestMethod.GET)
	public void printH(String user_id,String call_people,HttpServletResponse response) throws Exception {
		try{
			handleFirstEntrieSyncService.handle_sync(user_id,call_people);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","ok"), response);
		}catch(Exception e){
			LogUtils.logException(e);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "fail!","失败"), response);
		}
		
	}

}
