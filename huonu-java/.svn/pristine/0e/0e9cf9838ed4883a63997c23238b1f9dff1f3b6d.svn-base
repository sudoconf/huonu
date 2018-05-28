package com.huonu.schedul;

import java.util.Date;

import org.quartz.JobDetail;
import org.quartz.JobKey;
import org.quartz.Scheduler;
import org.quartz.SchedulerException;
import org.quartz.SchedulerFactory;
import org.quartz.Trigger;
import org.quartz.TriggerKey;
import org.quartz.impl.StdSchedulerFactory;

public class QuartzManagerTest {

	private static Scheduler scheduler = getScheduler();
	private static SchedulerFactory sf = null;

	private static synchronized Scheduler getScheduler() {
		if (sf == null) {
			sf = new StdSchedulerFactory();
		}
		Scheduler scheduler = null;
		try {
			scheduler = sf.getScheduler();
		} catch (SchedulerException e) {
			e.printStackTrace();
		}
		return scheduler;
	}

	public static Scheduler getInstanceScheduler() {
		return scheduler;
	}
	
	/** 
     * 启动一个调度对象 
     * @throws SchedulerException 
     */  
    public  void start() throws SchedulerException  
    {   
        scheduler.start();  
    }  
    
    
    /** 
     * 关闭调度信息 
     * @throws SchedulerException 
     */  
    public  void shutdown() throws SchedulerException   {  
        scheduler.shutdown();  
    }  
    
    /** 
     * 添加调度的job信息 
     * @param jobdetail 
     * @param trigger 
     * @return 
     * @throws SchedulerException 
     */  
    public  Date scheduleJob(JobDetail jobdetail, Trigger trigger)  
            throws SchedulerException{  
                return scheduler.scheduleJob(jobdetail, trigger);   
    }  
    
    /** 
     * 添加相关的触发器 
     * @param trigger 
     * @return 
     * @throws SchedulerException 
     */  
    public  Date scheduleJob(Trigger trigger) throws SchedulerException{  
        return scheduler.scheduleJob(trigger);  
    }  
    
    /** 
     * 停止调度Job任务 
     * @param triggerkey 
     * @return 
     * @throws SchedulerException 
     */  
    public  boolean unscheduleJob(TriggerKey triggerkey)  
            throws SchedulerException{  
        return scheduler.unscheduleJob(triggerkey);  
    } 
    
    /** 
     * 重新恢复触发器相关的job任务  
     * @param triggerkey 
     * @param trigger 
     * @return 
     * @throws SchedulerException 
     */  
    public  Date rescheduleJob(TriggerKey triggerkey, Trigger trigger)  
    throws SchedulerException{  
        return scheduler.rescheduleJob(triggerkey, trigger);  
    }  
    
    /** 
     * 添加相关的job任务 
     * @param jobdetail 
     * @param flag 
     * @throws SchedulerException 
     */  
    public  void addJob(JobDetail jobdetail, boolean flag)  
            throws SchedulerException   {  
        scheduler.addJob(jobdetail, flag);  
    }  
  
    /** 
     * 删除相关的job任务 
     * @param jobkey 
     * @return 
     * @throws SchedulerException 
     */  
    public  boolean deleteJob(JobKey jobkey) throws SchedulerException{  
        return scheduler.deleteJob(jobkey);  
    }  
}
