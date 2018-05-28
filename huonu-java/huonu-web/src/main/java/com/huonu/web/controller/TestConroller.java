package com.huonu.web.controller;

import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.InputStream;
import java.net.URLEncoder;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import javax.mail.internet.AddressException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.json.JSONArray;
import org.json.JSONObject;
import org.springframework.amqp.core.AmqpTemplate;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import com.google.gson.Gson;
import com.huonu.domain.dao.AreaEntryDao;
import com.huonu.domain.dao.TaobaoAsyncTaskEntryDao;
import com.huonu.domain.dao.TaobaoAuthorizeUserDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserCampRtrptsTotalEntryDao;
import com.huonu.domain.dao.TaobaoZsAdvertiserTargetDayEntryDao;
import com.huonu.domain.dao.TaobaoZsTargetEntryDao;
import com.huonu.domain.dao.TaobaoZxhtSyncInfoDao;
import com.huonu.domain.dao.ZxhtZzCampaignInfoDao;
import com.huonu.domain.model.TaobaoAsyncTaskEntry;
import com.huonu.domain.model.TaobaoAuthorizeUser;
import com.huonu.domain.model.TaobaoZsAdgroupEntry;
import com.huonu.domain.model.TaobaoZsAdvertiserCampRtrptsTotalEntry;
import com.huonu.domain.model.TaobaoZsCampEntry;
import com.huonu.domain.model.TaobaoZxhtSyncInfo;
import com.huonu.domain.model.conidtion.CampCondition;
import com.huonu.domain.model.conidtion.CreativeCondition;
import com.huonu.domain.model.conidtion.GroupCondition;
import com.huonu.mail.IMailService;
import com.huonu.mail.MailEntry;
import com.huonu.schedul.QuartzManager;
import com.huonu.service.AreaEntryService;
import com.huonu.service.CampRtrptsTotalService;
import com.huonu.service.CampService;
import com.huonu.service.CreativeService;
import com.huonu.service.DownloadService;
import com.huonu.service.EntrieService;
import com.huonu.service.GroupService;
import com.huonu.service.HandleCreativeSyncService;
import com.huonu.service.HandleTargetUpdateService;
import com.huonu.service.ProtionService;
import com.huonu.service.ZoneService;
import com.huonu.utils.Constants;
import com.huonu.utils.ResultMessageBuilder;
import com.huonu.utils.date.DateUtils;
import com.huonu.utils.excel.ExcelModel;
import com.huonu.utils.excel.ExcelUtils;
import com.huonu.utils.log.LogUtils;
import com.huonu.utils.spring.adapter.SpringUtil;
import com.taobao.api.ApiException;
import com.taobao.api.BatchTaobaoClient;
import com.taobao.api.TaobaoClient;
import com.taobao.api.request.ZuanshiAdvertiserRptsDownloadDayGetRequest;
import com.taobao.api.request.ZuanshiBannerAdgroupCreateRequest.AdzoneBid;
import com.taobao.api.request.ZuanshiBannerAdgroupCreateRequest.Crowd;
import com.taobao.api.request.ZuanshiBannerAdgroupCreateRequest.MatrixPrice;
import com.taobao.api.request.ZuanshiBannerAdgroupCreateRequest.SubCrowd;
import com.taobao.api.request.ZuanshiBannerAdgroupFindRequest;
import com.taobao.api.response.ZuanshiAdvertiserRptsDownloadDayGetResponse;
@Controller
@RequestMapping(value = "/test")
public class TestConroller extends BaseController{
	
	@Autowired
	private QuartzManager quartzManager;
	
	@Autowired
	private AreaEntryService areaEntryService;
	
	@Autowired
	private ProtionService protionService;
	
	@Autowired
	private EntrieService entrieService;
	
	@Autowired
	private AmqpTemplate amqpTemplate;
	
	@Autowired
	private TaobaoZsAdvertiserCampRtrptsTotalEntryDao taobaoZsAdvertiserCampRtrptsTotalEntryDao;
	
	@Autowired
	private IMailService iMailService;
	
	@Autowired
	private CampRtrptsTotalService campRtrptsTotalService;
	
	@Autowired
	private HandleTargetUpdateService handleTargetUpdateService;
	
	@Autowired
	private HandleCreativeSyncService handleCreativeSyncService;

	@Autowired
	private ZxhtZzCampaignInfoDao zxhtZzCampaignInfoDao;
	
	@Autowired
	private TaobaoClient taobaoClient;
	
	@Autowired
	private BatchTaobaoClient batchTaobaoClient;
	
	@Autowired
	private TaobaoAsyncTaskEntryDao taobaoAsyncTaskEntryDao;
	
	@Autowired
	private TaobaoAuthorizeUserDao taobaoAuthorizeUserDao;
	
	@Autowired
	private DownloadService downloadService;
	
	@Autowired
	private TaobaoZsAdvertiserTargetDayEntryDao taobaoZsAdvertiserTargetDayEntryDao;
	
	@Autowired
	private CampService campService;
	
	@Autowired
	private AreaEntryDao areaEntryDao;
	
	@Autowired
	private GroupService groupService;
	
	@Autowired
	private CreativeService creativeService;
	
	@Autowired
	private TaobaoZsTargetEntryDao taobaoZsTargetEntryDao;
	
	@Autowired
	private ZoneService zoneService;
	
	@RequestMapping(value = "/zone", method = RequestMethod.GET)
	public void bi31231211d(HttpServletRequest request, HttpServletResponse response){
		zoneService.sync_zone("test", "429413615", "6201826184f96415e48346ba84dd41f24cegc196ec42642429413615");
	
	}
	
	
	//单个店铺的计划单元定向同步
	//同步区域
	@RequestMapping(value = "/sync_", method = RequestMethod.GET)
	public void bi31211d(HttpServletRequest request, HttpServletResponse response){
		String user_id = "429413615";
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		String sessionkey = taobaoAuthorizeUser.getAccess_token();
		
		//删除一个店铺下所有的计划
		campService.deleteZsCampByUserId(user_id);
		
		//同步一个店家的所有钻展计划
		campService.sync_camplist("test",user_id, null,sessionkey);
		
		//删除店铺所有的单元
		groupService.deleteAdgroupEntryByUserid(user_id);
		
		//获取一个店家下的所有计划id
		List<TaobaoZsCampEntry> taobaoZsCampEntryList =  campService.getTaobaoZsCampEntryListByUserId(user_id);
		for(TaobaoZsCampEntry taobaoZsCampEntry:taobaoZsCampEntryList){
			//同步计划id下的所有单元
			groupService.sync_group("test",user_id,taobaoZsCampEntry.getId(),null,sessionkey);
		}
		
		//删除店铺下所有的定向
		taobaoZsTargetEntryDao.deleteZsTargetByUserId(user_id);
				
		//获取一个店家下的所有单元
		List<TaobaoZsAdgroupEntry> taobaoZsAdgroupEntryList =  groupService.getTaobaoZsAdgroupEntryByUserId(user_id);
		for(TaobaoZsAdgroupEntry taobaoZsAdgroupEntry :taobaoZsAdgroupEntryList){
			//获取单元下的所有定向
			entrieService.sync_target("test",user_id,taobaoZsAdgroupEntry,sessionkey);
		}
		
	}
	
	
	//同步区域
	@RequestMapping(value = "/area", method = RequestMethod.GET)
	public void bi3121n3eq1d(HttpServletRequest request, HttpServletResponse response){
		areaEntryService.sync_area("test","429413615");
	}
	
	//同步兴趣点
	@RequestMapping(value = "/cat", method = RequestMethod.GET)
	public void bi3121n31d(HttpServletRequest request, HttpServletResponse response){
		handleTargetUpdateService.sync_ZsCat("test","429413615", "6201826184f96415e48346ba84dd41f24cegc196ec42642429413615");
	}
	
	
	//同步用户创意
	@RequestMapping(value = "/creativelist", method = RequestMethod.GET)
	public void bi1n31d(HttpServletRequest request, HttpServletResponse response){
		creativeService.sync_creative("test","429413615",null,null,"6201826184f96415e48346ba84dd41f24cegc196ec42642429413615");
	}
	
	
	//新建创意
	@RequestMapping(value = "/creative", method = RequestMethod.GET)
	public void bi1nd(HttpServletRequest request, HttpServletResponse response){
		CreativeCondition creativeCondition = new CreativeCondition();
		creativeCondition.setCat_id(14L);
		creativeCondition.setClick_url("https://hisensetv.tmall.com/shop/view_shop.htm");
		creativeCondition.setImage("F:\\test.jpg");
		creativeCondition.setIs_trans_to_wifi(false);
		creativeCondition.setName("火奴_测试创意");
		creativeService.creative_add("test", "429413615", creativeCondition);
	}
	
	//建立绑定关系
	@RequestMapping(value = "/bind", method = RequestMethod.GET)
	public void bind(HttpServletRequest request, HttpServletResponse response){
		CreativeCondition creativeCondition = new CreativeCondition();
		creativeCondition.setCreativeIdList("1145905640001");
		creativeCondition.setAdgroupId(328283684L);
		creativeCondition.setCampaignId(327463492L);
		creativeService.creative_bind("test", "429413615", creativeCondition);
	}
	
	//修改计划状态
	@RequestMapping(value = "/camp_chan", method = RequestMethod.GET)
	public void sdy1a3123(HttpServletRequest request, HttpServletResponse response) throws Exception {
		campService.operate_status("test", "429413615","328115814", 0L);
	}
	
	//删除计划
	@RequestMapping(value = "/camp_delete", method = RequestMethod.GET)
	public void sdy1a33123(HttpServletRequest request, HttpServletResponse response) throws Exception {
		campService.delete_camp("test", "429413615","328115814");
	}
	
	//修改单元状态
	@RequestMapping(value = "/group_status", method = RequestMethod.GET)
	public void sdy1a(HttpServletRequest request, HttpServletResponse response) throws Exception {
		groupService.operate_status("test", "429413615", 327463492l, "328283684", 0L);
		
	}
	
	//删除单元
	@RequestMapping(value = "/delete_group", method = RequestMethod.GET)
	public void sy1a(HttpServletRequest request, HttpServletResponse response) throws Exception {
		groupService.delete_group("test", "429413615", 327463492L, "327493424");
	}
	
	
	//新增单元
	@RequestMapping(value = "/add_group", method = RequestMethod.GET)
	public void sya(HttpServletRequest request, HttpServletResponse response) throws Exception {
		
		GroupCondition groupCondition = new GroupCondition();
		
		groupCondition.setCampaign_id(327463492L);
		groupCondition.setIntelligent_bid(0L);
		groupCondition.setName("火奴_测试单元名称");
		
		List<Crowd> list2 = new ArrayList<Crowd>();
		Crowd obj3 = new Crowd();
		list2.add(obj3);
		obj3.setCrowdType(128L);
		obj3.setCrowdValue("1876778");
		obj3.setCrowdName("HUONUDB_渠道沉淀_S1X_电商部20180523160354_test");
		
		List<SubCrowd> list6 = new ArrayList<SubCrowd>();
		SubCrowd obj7 = new SubCrowd();
		list6.add(obj7);
		obj7.setSubCrowdName("HUONUDB_渠道沉淀_S1X_电商部20180523160354_test");
		obj7.setSubCrowdValue("1876778");
		obj3.setSubCrowds(list6);
		
		List<MatrixPrice> list10 = new ArrayList<MatrixPrice>();
		MatrixPrice obj11 = new MatrixPrice();
		list10.add(obj11);
		obj11.setAdzoneId(34492608l);
		obj11.setPrice(1L);
		obj3.setMatrixPrice(list10);
		
		groupCondition.setCrowds(list2);
		
		
		List<AdzoneBid> list13 = new ArrayList<AdzoneBid>();
		//AdzoneBid obj14 = new AdzoneBid();
		AdzoneBid obj15 = new AdzoneBid();
		//AdzoneBid obj16 = new AdzoneBid();
		//list13.add(obj14);
		list13.add(obj15);
		//list13.add(obj16);
		//obj14.setAdzoneId(34186526l);
		obj15.setAdzoneId(34492608l);
		//obj16.setAdzoneId(34502344l);
		groupCondition.setAdzone_bid_list(list13);
		groupService.add_group("test", "429413615", groupCondition);
	}
	
	
	
	
	//单个用户全量同步
	@RequestMapping(value = "/SY", method = RequestMethod.GET)
	public void sy(HttpServletRequest request, HttpServletResponse response) throws Exception {
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId("429413615");
		String sessionkey = taobaoAuthorizeUser.getAccess_token();
		campService.sync_camplist("test","429413615", null,sessionkey);
	}
		
	
	
	@RequestMapping(value = "/delete", method = RequestMethod.GET)
	public void delete(HttpServletRequest request, HttpServletResponse response) throws Exception {
		List<String>  aa  = new ArrayList<String>();
		aa.add("253959655");
		aa.add("254126150");
		aa.add("254367500");
		aa.add("254451051");
		aa.add("254455011");
		aa.add("254463003");
		aa.add("254463005");
		aa.add("254463011");
		aa.add("259683605");
		aa.add("259864986");
		aa.add("259900850");
		aa.add("259926932");
		aa.add("259940737");
		aa.add("260087259");
		aa.add("260121112");
		for(String bb:aa){
			campService.delete_camp("test", "429413615", bb);
		}
	}
	
	//新增计划
	@RequestMapping(value = "/add", method = RequestMethod.GET)
	public void create(HttpServletRequest request, HttpServletResponse response) throws Exception {
		CampCondition campCondition= new CampCondition();
		
		campCondition.setWorkday("true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true");
		campCondition.setWeekend("true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true");
		campCondition.setType(8L);
		campCondition.setName("火奴_测试计划2018_05_25");
		campCondition.setArea_id_list("1,19");
		campCondition.setSpeed_type(1L);
		campCondition.setDay_budget(30000L);
		campCondition.setStart_time("2018-05-28 00:00:00");
		campCondition.setEnd_time("2018-05-29 00:00:00");
		
		String message = campService.add_camp("test","429413615",campCondition);
		System.out.println(message);
	}
	
	
	//单个用户全量同步
	@RequestMapping(value = "/sync_all", method = RequestMethod.GET)
	public void sync_11(HttpServletRequest request, HttpServletResponse response) throws Exception {
		
		String user_id = "430490406";
		String call_people = "手动测试";
		//protionService.sync_targetdaysum(call_people,user_id,91,"11");
		entrieService.sync_all(call_people,user_id, 91);
		//更新用户状态
		TaobaoAuthorizeUser taobaoAuthorizeUser=new TaobaoAuthorizeUser();
		taobaoAuthorizeUser.setSync_status(2L);
		taobaoAuthorizeUser.setTaobao_user_id(user_id);
		taobaoAuthorizeUserDao.updateSyncStatusByTaoBaoUserId(taobaoAuthorizeUser);
	
	}
	
	
	//获取下载报表
	@RequestMapping(value = "/getdown", method = RequestMethod.GET)
	public void getdown(HttpServletRequest request, HttpServletResponse response) throws Exception {
		String user_id = "430490406";
		String call_people = "手动测试";
		downloadService.setDatabyId(call_people,user_id);
	
	}
	
	
	
	@RequestMapping(value = "/down",method = RequestMethod.GET)
	 public void myTest333(HttpServletResponse response){
	
//		  String tempPath = request.getSession().getServletContext().getRealPath("/") + "template/" + "order.xlsx";
//	      String path = request.getSession().getServletContext().getRealPath("/") + "template/";
		
		String tempPath= "F:\\test.xlsx";
		String path = "F:\\temp";
		ExcelModel a = new ExcelModel();
	    a.setA("a");
	    a.setB("2018-03-21");
	    a.setC("");
	    
	    a.setD("888");
	    a.setE("42");
	    a.setF("54.99");
	    a.setG("0");
	    a.setH("1");
	    a.setI("1");
	    a.setJ("0");
	    List<ExcelModel> list = new ArrayList<ExcelModel>();
	    list.add(a);
	    ExcelUtils ex = new ExcelUtils();
	    ex.exportExcel(tempPath, path, response, list);

	}
	
	//异步数据获取
	@RequestMapping(value = "/hahahaha", method = RequestMethod.GET)
	public void downloadPersons312312(String id,HttpServletRequest request, HttpServletResponse response) throws Exception {
		downloadService.setDatabyId("",id);
	}
	
	//异步下载数据
	@RequestMapping(value = "/hahaha", method = RequestMethod.GET)
	public void downloadPersons312(String user_id,String type,String calc,Long model,HttpServletRequest request, HttpServletResponse response) throws Exception {
	
		TaobaoAuthorizeUser taobaoAuthorizeUser = taobaoAuthorizeUserDao.getUserInfoByTaoBaoUserId(user_id);
		String sessionkey = taobaoAuthorizeUser.getAccess_token();
		List<TaobaoAsyncTaskEntry> taobaoAsyncTaskEntryList=new ArrayList<TaobaoAsyncTaskEntry>();
        List<String> effect_type = new ArrayList<String>();
        effect_type.add(type);
        List<String> hierarchy = new ArrayList<String>();
        hierarchy.add(calc);
//      hierarchy.add("targetAdzone");
        List<Long> campaign_model = new ArrayList<Long>();
        campaign_model.add(model);
        Date dNow = new Date();
        Calendar calendar = Calendar.getInstance();
        calendar.setTime(dNow);
        calendar.add(Calendar.DAY_OF_MONTH, -1);
        Calendar calendar0 = Calendar.getInstance();
        calendar0.setTime(dNow);
        calendar0.add(Calendar.DAY_OF_MONTH, -91);
        dNow = calendar.getTime();
        Date dBefore = calendar0.getTime();
        SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");
        String start_time = sdf.format(dBefore);
        String end_time = sdf.format(dNow);
        ZuanshiAdvertiserRptsDownloadDayGetRequest req = new ZuanshiAdvertiserRptsDownloadDayGetRequest();
    	ZuanshiAdvertiserRptsDownloadDayGetResponse rsp = null;
    	Gson gson = new Gson();
    	req.setEndTime(end_time);
    	req.setStartTime(start_time);
        for(String effect_type0:effect_type){
        	req.setEffectType(effect_type0);
            for(String hierarchy0:hierarchy){
            	req.setHierarchy(hierarchy0);
                for(Long campaign_model0:campaign_model){
                	TaobaoAsyncTaskEntry taobaoAsyncTask=new TaobaoAsyncTaskEntry();
                	req.setCampaignModel(campaign_model0);
                	rsp = null;
                	//LogUtils.logInfo("生成异步下载任务ID-ZuanshiAdvertiserRptsDownloadDayGetRequest请求数据 "+gson.toJson(req));
                	try {
                		rsp = taobaoClient.execute(req, sessionkey);
                	} catch (ApiException e) {
                		LogUtils.logException(e);
	          		}
                	
                	
	          		if(rsp!=null && rsp.getBody()!=null){
	          			//LogUtils.logInfo("生成异步下载任务ID-ZuanshiAdvertiserRptsDownloadDayGetResponse请求返回数据: "+rsp.getBody());
	          			JSONObject obj1 = new JSONObject(rsp.getBody());
	          			if (obj1.has("zuanshi_advertiser_rpts_download_day_get_response")) {
	          				JSONObject obj2 = obj1.getJSONObject("zuanshi_advertiser_rpts_download_day_get_response");
	          	            if (obj2.has("result")) {
	          	            	JSONObject obj3 = obj2.getJSONObject("result");
	          	                Long task_id = obj3.getLong("task_id");
	          	                String created=obj3.getString("created");
	          	                String check_code=obj3.getString("check_code");
	          	                Pattern pattern = Pattern.compile("result:truenick:(.*?) msg");
	          	                Matcher matcher = pattern.matcher(check_code);
	          	                while (matcher.find()) {
	                              String userName=matcher.group(1);
	                              taobaoAsyncTask.setUserName(userName);
	          	                }
	          	                taobaoAsyncTask.setTaskId(task_id);
	          	                taobaoAsyncTask.setCreatTime(created);
	          	                taobaoAsyncTask.setTaobaoUserId(user_id);
	          	                taobaoAsyncTask.setStartDate(start_time);
	          	                taobaoAsyncTask.setEndDate(end_time);
	                          	taobaoAsyncTask.setCampModel(campaign_model0);
	                          	taobaoAsyncTask.setEffectType(effect_type0);
	                          	taobaoAsyncTask.setHierarchy(hierarchy0);
	                          	taobaoAsyncTask.setTaskStatus("new");
	                          	taobaoAsyncTaskEntryList.add(taobaoAsyncTask);
	          	            }
	          			}
	          		}
                }
            }   
        }
        taobaoAsyncTaskEntryDao.insertOrUpdateTaobaoAsyncTaskEntryList(taobaoAsyncTaskEntryList);
	}
	
	
	 @RequestMapping(value = "/download", method = RequestMethod.GET)
	 public void downloadPersons( HttpServletRequest request, HttpServletResponse response) throws Exception {
		 
		 //获取文件的路径
         String excelPath = request.getSession().getServletContext().getRealPath("11.xlsx");
         // 读到流中
         InputStream inStream=null;
		try {
			inStream = new FileInputStream(excelPath);
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}//文件的存放路径
         // 设置输出的格式
         response.reset();
         response.setContentType("bin");
         response.addHeader("Content-Disposition",
                 "attachment;filename=" + URLEncoder.encode("112.xlsx", "UTF-8"));
         // 循环取出流中的数据
         byte[] b = new byte[200];
         int len;

         while ((len = inStream.read(b)) > 0){
             response.getOutputStream().write(b, 0, len);
         }
         inStream.close();
	     
	 }
	 
	 
	//同步单个店铺
	@RequestMapping(value = "/abc",method = RequestMethod.GET)
	public void test66(HttpServletResponse response){
	 
	}
	 
	//接口调用测试
	@RequestMapping(value = "/bb",method = RequestMethod.GET)
	public void test55(HttpServletResponse response){
			
		AmqpTemplate amqpTemplate = (AmqpTemplate)SpringUtil.getBean("amqpTemplate");
		TaobaoAuthorizeUserDao taobaoAuthorizeUserDao = (TaobaoAuthorizeUserDao)SpringUtil.getBean("taobaoAuthorizeUserDao");
		TaobaoZxhtSyncInfoDao taobaoZxhtSyncInfoDao = (TaobaoZxhtSyncInfoDao)SpringUtil.getBean("taobaoZxhtSyncInfoDao");
				
		List<TaobaoAuthorizeUser> dailyIncrementUserIdList = taobaoAuthorizeUserDao.getUserInfosBySyncStatusId(2L);
		List<TaobaoAuthorizeUser> firstEntrieUserIdList = taobaoAuthorizeUserDao.getUserInfosBySyncStatusId(1L);
		
		if(dailyIncrementUserIdList!=null&&dailyIncrementUserIdList.size()>0){
			 for(TaobaoAuthorizeUser taobaoAuthorizeUser:dailyIncrementUserIdList) {
				 String userMessage=taobaoAuthorizeUser.getTaobao_user_id()+":"+"系统调用";
				 amqpTemplate.convertAndSend(Constants.DAILYINCREMENTSYNC_QUEUENAME,userMessage);
				 LogUtils.logInfo("**************向队列 dailyIncrementSyncQueue 发送淘宝店铺id:【"+taobaoAuthorizeUser.getTaobao_user_id()+"】 *************");
				 TaobaoZxhtSyncInfo taobaoZxhtSyncInfo=new TaobaoZxhtSyncInfo();
				 taobaoZxhtSyncInfo.setLog_date(DateUtils.dateToString(new Date(), "yyyy-MM-dd"));
	             taobaoZxhtSyncInfo.setTaobao_user_id(taobaoAuthorizeUser.getTaobao_user_id());
	             taobaoZxhtSyncInfo.setRun_status(1L);
	             taobaoZxhtSyncInfo.setLast_update_time(new Date());
	             taobaoZxhtSyncInfoDao.insertTaobaoZxhtSyncInfo(taobaoZxhtSyncInfo);
	             
			 }
		}
		
		
		if(firstEntrieUserIdList!=null&&firstEntrieUserIdList.size()>0){
			 for(TaobaoAuthorizeUser taobaoAuthorizeUser:firstEntrieUserIdList) {
				 String userMessage=taobaoAuthorizeUser.getTaobao_user_id()+":"+"系统调用";
				 amqpTemplate.convertAndSend(Constants.FIRSTENTRIESYNC_QUEUENAME,userMessage);
				 LogUtils.logInfo("**************向队列 firstEntrieSyncQueue 发送淘宝店铺id:【"+taobaoAuthorizeUser.getTaobao_user_id()+"】 *************");
				 TaobaoZxhtSyncInfo taobaoZxhtSyncInfo=new TaobaoZxhtSyncInfo();
				 taobaoZxhtSyncInfo.setLog_date(DateUtils.dateToString(new Date(), "yyyy-MM-dd"));
	             taobaoZxhtSyncInfo.setTaobao_user_id(taobaoAuthorizeUser.getTaobao_user_id());
	             taobaoZxhtSyncInfo.setRun_status(1L);
	             taobaoZxhtSyncInfo.setLast_update_time(new Date());
	             taobaoZxhtSyncInfoDao.insertTaobaoZxhtSyncInfo(taobaoZxhtSyncInfo);
	             
			 }
		}
		
	}
	 
	
	//接口调用测试
	@RequestMapping(value = "/aa",method = RequestMethod.GET)
	public void test(HttpServletResponse response){
		
		String aa = "31312321:31312312";
		amqpTemplate.convertAndSend(Constants.DAILYINCREMENTSYNC_QUEUENAME, aa);
	
	}
	
	//发送邮件测试
	@RequestMapping(value = "/22",method = RequestMethod.GET)
    public void mailTest(HttpServletResponse response){
		
		MailEntry mailEntry = new MailEntry();
		
		mailEntry.setText("内容");
		mailEntry.setSubject("主题");
		
		String[] recipeople = {"2544374219@qq.com"};
		try {
			mailEntry.setRecipients(recipeople);
		} catch (AddressException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		iMailService.sendMail(mailEntry);
		LogUtils.logInfo("发送成功");
		writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","ok"), response);
	}
	
	
	
	//启动成功测试
	@RequestMapping(value = "/cod")
    public void myTest1(String id,HttpServletResponse response){
		LogUtils.logInfo(id);
		writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","ok"), response);
	}
	
	//启动成功测试
	@RequestMapping(value = "/{id}")
	public void myTest5(@PathVariable("id")String id,HttpServletResponse response){
		LogUtils.logInfo(id);
		writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","ok"), response);
	}
	
	//json解析测试
	@RequestMapping(value = "/hah")
    public void myTest2(HttpServletResponse response){
		List<TaobaoZsAdvertiserCampRtrptsTotalEntry> taobaoZsAdvertiserCampRtrptsTotalEntryList = new ArrayList<TaobaoZsAdvertiserCampRtrptsTotalEntry>() ;
		
		String aa = "{\"zuanshi_advertiser_campaign_rtrpts_total_get_response\":{campaign_realtime_rpt_total_list:"+
				"{\"data\":[{\"ad_pv\":\"1160\",\"campaign_id\":\"318066131\",\"campaign_name\":\"宝贝人群V2239\",\"charge\":\"188.00\",\"click\":\"159\",\"ctr\":\"0.13"+
				"71\",\"ecpc\":\"1.18\",\"ecpm\":\"162.07\",\"log_date\":\"2018-05-03 00:00:00\"},{\"ad_pv\":\"1267\",\"campaign_id\":\"319300630\",\"campaign_name\":\"老客"+
				"人群V2239\",\"charge\":\"250.76\",\"click\":\"194\",\"ctr\":\"0.1531\",\"ecpc\":\"1.29\",\"ecpm\":\"197.92\",\"log_date\":\"2018-05-03 00:00:00\"}]},\"request"+
				"_id\":\"46hblsref851\"}}";
		JSONObject obj0 = new JSONObject(aa);
		if (obj0.has("zuanshi_advertiser_campaign_rtrpts_total_get_response")) {
			JSONObject obj00 = obj0.getJSONObject("zuanshi_advertiser_campaign_rtrpts_total_get_response");
			JSONObject obj = obj00.getJSONObject("campaign_realtime_rpt_total_list");
            if (obj.has("data")) {
            	JSONArray obj4 = obj.getJSONArray("data");
                int listNum=obj4.length();
                for (int k = 0; k < obj4.length(); k++) {
                	TaobaoZsAdvertiserCampRtrptsTotalEntry taobaoZsAdvertiserCampRtrptsTotalEntry = new TaobaoZsAdvertiserCampRtrptsTotalEntry();
                    JSONObject jsonObject = obj4.getJSONObject(k);
                    //获取json中的字段
                    if(jsonObject.has("ad_pv")){
                        String ad_pv = jsonObject.getString("ad_pv");
                        taobaoZsAdvertiserCampRtrptsTotalEntry.setAd_pv(ad_pv);
                    }
                    if(jsonObject.has("ecpm")){
                        String ecpm = jsonObject.getString("ecpm");
                        taobaoZsAdvertiserCampRtrptsTotalEntry.setEcpm(ecpm);
                    }
                    if(jsonObject.has("ctr")){
                        String ctr = jsonObject.getString("ctr");
                        taobaoZsAdvertiserCampRtrptsTotalEntry.setCtr(ctr);
                    }
                    if(jsonObject.has("ecpc")){
                        String ecpc = jsonObject.getString("ecpc");
                        taobaoZsAdvertiserCampRtrptsTotalEntry.setEcpc(ecpc);
                    }
                    String charge = jsonObject.getString("charge");
                    String log_date = jsonObject.getString("log_date");
                    String click = jsonObject.getString("click");
                    String campaign_name = jsonObject.getString("campaign_name");
                    String campaign_id = jsonObject.getString("campaign_id");
                    //存储上述字段到pojo对象中
                    taobaoZsAdvertiserCampRtrptsTotalEntry.setCharge(charge);
                    taobaoZsAdvertiserCampRtrptsTotalEntry.setLog_date(log_date);
                    taobaoZsAdvertiserCampRtrptsTotalEntry.setClick(click);
                    taobaoZsAdvertiserCampRtrptsTotalEntry.setCampaign_name(campaign_name);
                    taobaoZsAdvertiserCampRtrptsTotalEntry.setTaobao_user_id("2424338511");
                    taobaoZsAdvertiserCampRtrptsTotalEntry.setCampaign_id(campaign_id);
                    taobaoZsAdvertiserCampRtrptsTotalEntry.setLast_update_time(new Date());
                    taobaoZsAdvertiserCampRtrptsTotalEntryList.add(taobaoZsAdvertiserCampRtrptsTotalEntry);
                }
            }
		}
		taobaoZsAdvertiserCampRtrptsTotalEntryDao.insertOrUpdateTaobaoZsAdvertiserCampRtrptsTotalEntryList(taobaoZsAdvertiserCampRtrptsTotalEntryList);
		writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","ok"), response);
	}
	
	
	//手动启动定时任务测试
	@RequestMapping(value = "/test/{message}",method = RequestMethod.GET)
    public void myTest(@PathVariable("message") String message,HttpServletResponse response){
		
		try {  
            System.out.println("【系统启动】开始(每1秒输出一次 job2)...");    

//            Thread.sleep(5000); 
//            System.out.println("【增加job1启动】开始(每1秒输出一次)...");  
//            quartzManager.addJob("test", "test", "test", "test", Myjob2.class, "0/1 * * * * ?");    
//
//            Thread.sleep(5000);    
//            System.out.println("【修改job1时间】开始(每2秒输出一次)...");    
//            quartzManager.modifyJobTime("test", "test", "test", "test", "0/2 * * * * ?");    

            Thread.sleep(10000);    
            System.out.println("【移除job1定时】开始...");    
            quartzManager.removeJob("test", "test", "test", "test");    

            // 关掉任务调度容器
            // quartzManager.shutdownJobs();
        } catch (Exception e) {  
            e.printStackTrace();  
        }  
		writeAjaxJSONResponse(ResultMessageBuilder.build(true, "success!","11"), response);
	}
	
	public static void main(String[] args){
		ZuanshiBannerAdgroupFindRequest req = new ZuanshiBannerAdgroupFindRequest();
		System.out.println(req.getAdgroupIdList());
	}
	
}
