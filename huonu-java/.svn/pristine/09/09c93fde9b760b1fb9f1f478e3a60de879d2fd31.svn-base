package com.huonu.utils.date;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

public class DateUtils {
	
	public static final String DATA_FORMAT_yyyy_MM_dd = "yyyy-MM-dd";
	public static final String DATA_FORMAT_yyyy_MM_dd_HH_mm_ss = "yyyy-MM-dd HH:mm:ss";
	public static final String DATA_FORMAT_MM_dd_HH_mm_ss = "MM-dd HH:mm:ss";
	public static final String DATA_FORMAT_yyyy_MM_dd_HH_mm = "yyyy-MM-dd HH:mm";
	public static final String DATA_FORMAT_AMERICAN = "MMM dd, yyyy hh:mm:ss a";
	public static final String ISO_DATETIME_TIME_ZONE_FORMAT = "yyyy-MM-dd'T'HH:mm:ss.SSSZ";
	public static final String DATA_FORMAT_MMM_dd_yyyy_HH_mm_ss_aaa = "MMM dd,yyyy HH:mm:ss aaa";
	public static final String DATA_FORMAT_MM_dd = "MM-dd";
	public static final String DATA_FORMAT_YMDHMS = "yyyyMMddHHmmss";
	public static final String DATA_FORMAT_YMD="yyyyMMdd";
	
	
	
	/**
	 * 将日期转换为指定格式的字符串
	 *
	 * @param dateValue
	 * @param strFormat
	 * @return
	 */
	public static String dateToString(Date dateValue, String strFormat) {
		return new SimpleDateFormat(strFormat).format(dateValue);
	}
	
	/**
	 * 获取昨天的日期字符串 
	 * @return
	 */
	public static String getYesterdayString(){
		Calendar cal = Calendar.getInstance();
        cal.add(Calendar.DATE, -1);
        return new SimpleDateFormat("yyyy-MM-dd").format(cal.getTime());
	}
	
	
	/**
	 * 获取今天的开始时间,00:00:00
	 * @return
	 */
	public static Date getTodayStartTime() {
		Calendar calendar = Calendar.getInstance();
        calendar.setTime(new Date());
        calendar.set(Calendar.HOUR_OF_DAY, 0);
        calendar.set(Calendar.MINUTE, 0);
        calendar.set(Calendar.SECOND, 0);
        return calendar.getTime();
	}
	
	
	

}
