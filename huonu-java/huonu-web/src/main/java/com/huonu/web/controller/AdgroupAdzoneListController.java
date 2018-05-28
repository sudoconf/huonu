package com.huonu.web.controller;

import java.util.HashMap;
import java.util.Map;

import javax.servlet.http.HttpServletResponse;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import com.huonu.service.TaobaoZsAdgroupAdzoneEntryService;
import com.huonu.utils.ResultMessageBuilder;

@Controller
@RequestMapping(value = "/zxht/sync")
public class AdgroupAdzoneListController extends BaseController{
	
	@Autowired
	private TaobaoZsAdgroupAdzoneEntryService taobaoZsAdgroupAdzoneEntryService;
	
	/*
	 * taobao.zuanshi.banner.adgroup.adzone.findpage (获取钻石展位全店推广单元的广告位绑定列表) 通过淘宝店铺id 计划id  单元id 
	 */
	@RequestMapping(value = "/adgroup/adzone", method = RequestMethod.GET, produces = "application/json;charset=utf8")
    public void syncAdgroupAdzoneList( String user_id, Long camp_id, Long adgroup_id, String call_people,HttpServletResponse response) throws Exception {

		Map<String,Object> conditions = new HashMap<String,Object>();
		conditions.put("user_id", user_id);
		conditions.put("camp_id", camp_id);
		conditions.put("adgroup_id", adgroup_id);
		taobaoZsAdgroupAdzoneEntryService.syncUpdateDataOne(conditions);
//        TaobaoZsAdgroupAdzoneListHandler taobaoZsAdgroupAdzoneListHandler=new TaobaoZsAdgroupAdzoneListHandler();
//        taobaoZsAdgroupAdzoneListHandler.setUserId(user_id);
//        taobaoZsAdgroupAdzoneListHandler.setCall_people(call_people);
//        taobaoZsAdgroupAdzoneListHandler.setUserAdgroupAdzoneData(camp_id,adgroup_id);
//        System.out.println(taobaoZsAdgroupAdzoneListHandler.syncUpdateDataOne());
//        taobaoZsAdgroupAdzoneListHandler.closeSession();
		writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","ok"), response);
    }

}
