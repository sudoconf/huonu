package com.huonu.web.controller;

import java.util.List;

import javax.servlet.http.HttpServletResponse;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZsAdgroupEntry;
import com.huonu.service.CampRtrptsTotalService;
import com.huonu.service.CampService;
import com.huonu.service.CreativeService;
import com.huonu.service.GroupService;
import com.huonu.service.ZoneService;
import com.huonu.utils.ResultMessageBuilder;
import com.huonu.utils.log.LogUtils;

@Controller
@RequestMapping(value = "/zxht/sync")
public class SyncDataContoller extends BaseController{
	
	@Autowired
	private CampRtrptsTotalService campRtrptsTotalService;
	
	@Autowired
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	@Autowired
	private CampService campService;
	
	@Autowired
	private GroupService groupService;
	
	@Autowired
	private ZoneService zoneService;
	
	@Autowired
	private CreativeService creativeService;
	
	/*
	 * 同步某个用户所有计划列表的当日实时汇总数据以及状态
	 */
	@RequestMapping(value = "/camp/list", method = RequestMethod.GET)
	public void  sync_camplist(String user_id,String call_people,HttpServletResponse response){
		try{
			TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
			campService.sync_CampaignRtrptsTotal(call_people,user_id,null,taobaoAuthorizeUser.getAccess_token());
			campService.sync_camplist(call_people,user_id,null,taobaoAuthorizeUser.getAccess_token());
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","ok"), response);
		}catch(Exception e){
			LogUtils.logException(e);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "fail!","失败"), response);
		}
	}
	
	/*
	 * 计划同步:同步某个计划的当日实时汇总数据以及状态
	 */
	@RequestMapping(value = "/camp/rtrpts", method = RequestMethod.GET)
    public void sync_camp(String user_id,Long camp_id,String call_people,HttpServletResponse response){
		try{
			TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
			//跟新计划状态
			campService.sync_camplist(call_people,user_id, camp_id+"", taobaoAuthorizeUser.getAccess_token());
			//同步该计划分时当日汇总数据
			campService.sync_CampaignRtrptsTotal(call_people,user_id, camp_id, taobaoAuthorizeUser.getAccess_token());
			
			//更新计划下单元状态
			groupService.sync_group(call_people, user_id, camp_id, null, taobaoAuthorizeUser.getAccess_token());
			
			//同步该计划下所有单元分时数据
			groupService.sync_group(call_people, user_id, camp_id, null, taobaoAuthorizeUser.getAccess_token());
			
			List<TaobaoZsAdgroupEntry> taobaoZsAdgroupEntryList = groupService.getTaobaoZsAdgroupEntryByUserId(user_id);
			for(TaobaoZsAdgroupEntry taobaoZsAdgroupEntry:taobaoZsAdgroupEntryList){
				campRtrptsTotalService.sync_ZsTargetEntry(call_people, user_id,taobaoZsAdgroupEntry.getCampaign_id(),taobaoZsAdgroupEntry.getAdgroup_id(),taobaoAuthorizeUser.getAccess_token());
			}
			
			//同步计划下所有的定向分时数据
			campRtrptsTotalService.sync_ZsAdvertiserTargetRtrptsTotal(call_people,user_id, camp_id, null,null,taobaoAuthorizeUser.getAccess_token());
			//同步资源位分时数据
			zoneService.sync_ZsAdvertiserAdzoneRtrptsTotal(call_people,user_id, camp_id,null,null, taobaoAuthorizeUser.getAccess_token());
			//同步创意分时数据
			creativeService.sync_ZsAdvertiserCreativeRtrptsTotal(call_people,user_id, camp_id,null,null,taobaoAuthorizeUser.getAccess_token());
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","ok"), response);
		}catch(Exception e){
			LogUtils.logException(e);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "fail!","失败"), response);
		}
	}
	
	/*
	 * 单元同步:同步某个计划的  所有单元的当日实时汇总数据以及状态
	 */
	@RequestMapping(value = "/adgroup/rtrpts", method = RequestMethod.GET)
    public void sync_adgroup(String user_id, Long camp_id, Long group_id,String call_people,HttpServletResponse response){
		
		try{
			TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
			groupService.sync_AdgroupRtrptsTotal(call_people,user_id, camp_id,null, taobaoAuthorizeUser.getAccess_token());
			groupService.sync_group(call_people, user_id, camp_id, String.valueOf(group_id), taobaoAuthorizeUser.getAccess_token());
			
			
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","ok"), response);
		}catch(Exception e){
			LogUtils.logException(e);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "fail!","失败"), response);
		}
	}
	
	/*
	 * 定向同步:同步计划下所有定向的实时汇总数据以及状态
	 */
	@RequestMapping(value = "/target/rtrpts", method = RequestMethod.GET)
    public void sync_target(String user_id, String call_people,Long camp_id,HttpServletResponse response){
		try{
			TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
			campRtrptsTotalService.sync_ZsAdvertiserTargetRtrptsTotal(call_people,user_id, camp_id, null,null,taobaoAuthorizeUser.getAccess_token());
			
			List<TaobaoZsAdgroupEntry> taobaoZsAdgroupEntryList = groupService.getTaobaoZsAdgroupEntryByUserId(user_id);
			for(TaobaoZsAdgroupEntry taobaoZsAdgroupEntry:taobaoZsAdgroupEntryList){
				campRtrptsTotalService.sync_ZsTargetEntry(call_people, user_id,taobaoZsAdgroupEntry.getCampaign_id(),taobaoZsAdgroupEntry.getAdgroup_id(),taobaoAuthorizeUser.getAccess_token());
			}
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","ok"), response);
		}catch(Exception e){
			LogUtils.logException(e);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "fail!","失败"), response);
		}
	
	}
	
	@RequestMapping(value = "/adzone/rtrpts", method = RequestMethod.GET)
    public void campRtrptsTotal(String user_id,String call_people,Long camp_id,Long adgroup_id,Long adzone_id,HttpServletResponse response){
		try{
			TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
			zoneService.sync_ZsAdvertiserAdzoneRtrptsTotal(call_people,user_id, camp_id,adgroup_id,adzone_id, taobaoAuthorizeUser.getAccess_token());
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","ok"), response);
		}catch(Exception e){
			LogUtils.logException(e);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "fail!","失败"), response);
		}
	}
	
	@RequestMapping(value = "/creative/rtrpts", method = RequestMethod.GET)
    public void campRtrptsTotal(String user_id,String call_people,Long camp_id,HttpServletResponse response){
		try{
			TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
			creativeService.sync_ZsAdvertiserCreativeRtrptsTotal(call_people,user_id, camp_id,null,null,taobaoAuthorizeUser.getAccess_token());
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","ok"), response);
		}catch(Exception e){
			LogUtils.logException(e);
			writeAjaxJSONResponse(ResultMessageBuilder.build(true, "fail!","失败"), response);
		}
	}
	
	
	
	
}
