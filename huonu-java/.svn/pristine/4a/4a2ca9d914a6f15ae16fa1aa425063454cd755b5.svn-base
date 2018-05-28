package com.huonu.web.controller;

import javax.servlet.http.HttpServletResponse;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import com.huonu.domain.model.conidtion.CampCondition;
import com.huonu.service.CampService;
import com.huonu.utils.ResultMessageBuilder;
import com.huonu.utils.log.LogUtils;
import com.huonu.web.vo.CampVo;

@Controller
@RequestMapping(value = "/zxht/operate")
public class CampOperateController extends BaseController{
	
	@Autowired
	private CampService campService;
	
	//新增计划
	@RequestMapping(value = "/camp/add", method = RequestMethod.GET)
	public void add_camp(@RequestBody CampVo vo,HttpServletResponse response){
		try{
			CampCondition campCondition=vo.convertToCampCondition();
			String user_id = campCondition.getUser_id();
			String call_people = campCondition.getCall_people();
			String message = campService.add_camp(call_people,user_id,campCondition);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!",message), response);
		}catch(Exception e){
			LogUtils.logException(e);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "fail!","失败"), response);
		}
		
	}
	
	//删除计划
	@RequestMapping(value = "/camp/delete", method = RequestMethod.GET)
	public void delete_camp(String user_id,String call_people,String campaign_id,HttpServletResponse response){
		try{
			String message = campService.delete_camp(call_people, user_id, campaign_id);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!",message), response);
		}catch(Exception e){
			LogUtils.logException(e);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "fail!","失败"), response);
		}
	}
	
	//修改计划
	@RequestMapping(value = "/camp/modify", method = RequestMethod.GET)
	public void modify_camp(@RequestBody CampVo vo,HttpServletResponse response){
		try{
			CampCondition campCondition=vo.convertToCampCondition();
			String user_id = campCondition.getUser_id();
			String call_people = campCondition.getCall_people();
			String message = campService.modify_camp(call_people,user_id,campCondition);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!",message), response);
		}catch(Exception e){
			LogUtils.logException(e);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "fail!","失败"), response);
		}
		
	}
	
	//修改计划状态
	@RequestMapping(value = "/camp/changestatus", method = RequestMethod.GET)
	public void  operate_camp_status(String user_id,String call_people,String campaign_id,Long status,HttpServletResponse response){
		try{
			String message = campService.operate_status(call_people, user_id, campaign_id, status);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!",message), response);
		}catch(Exception e){
			LogUtils.logException(e);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "fail!","失败"), response);
		}
	}
	

}
