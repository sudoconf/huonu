package com.huonu.service.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.huonu.schedul.QuartzManager;
import com.huonu.schedul.job.ZxhtChargeMonitorJob;
import com.huonu.schedul.job.ZxhtCreativeMonitorCtrJob;
import com.huonu.schedul.job.ZxhtCrowdMonitorCoverageJob;
import com.huonu.schedul.job.ZxhtPriceMonitorTemplateJob;
import com.huonu.service.ZxhtMonitorSchedulerService;

@Service("zxhtMonitorSchedulerService")
public class ZxhtMonitorSchedulerServiceImpl implements ZxhtMonitorSchedulerService{

	@Autowired
	private QuartzManager quartzManager;
	
	public void sceduler_invoke(String type) {
		
		 if(type.equals("creativetest")){
		 
		 }
		 
		 if(type.equals("creativectr")){
			 quartzManager.addJob("creativectr", "creativectr", "creativectr", "creativectr",
					 ZxhtCreativeMonitorCtrJob.class, "0 0 10 * * ? *");
		 }

		 if(type.equals("crowdcoverage")){
			 quartzManager.addJob("crowdcoverage", "crowdcoverage", "crowdcoverage", "crowdcoverage",
					 ZxhtCrowdMonitorCoverageJob.class, "0 0 2,10 * * ? *");
		 }

		 if(type.equals("charge")){
			 quartzManager.addJob("charge", "charge", "charge", "charge",
					 ZxhtChargeMonitorJob.class, "0 0 * * * ? *");
		 }

		 if(type.equals("pricetemplate")){
			 quartzManager.addJob("pricetemplate", "pricetemplate", "pricetemplate", "pricetemplate",
					 ZxhtPriceMonitorTemplateJob.class, "0 0 * * * ? *");
		 }
		
	}

}
