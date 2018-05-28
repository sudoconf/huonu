package com.huonu.web.vo;

import java.util.List;

import org.springframework.beans.BeanUtils;

import com.huonu.utils.log.LogUtils;


public class BaseConvert {
	
	/**
	 * 转换PO(Persistent Object5)到VO(Value Object),以便于只传输需要的数据到界面端
	 * @param poObj
	 */
	public static void convertPOToVO(Object poObj, Object voObj) {
		BeanUtils.copyProperties(poObj, voObj);
	}
	
	/**
	 * 转换VO(Value Object)到PO(Persistent Object5),以便于只传输需要的数据到界面端
	 * @param poObj
	 */
	public static void convertVOToPO(Object voObj, Object poObj) {
		BeanUtils.copyProperties(voObj, poObj);
	}
	
	/**
	 * 转换VO(Value Object)列表到PO(Persistent Object5)列表,以便于只传输需要的数据到界面端
	 * @param poObj
	 */
	@SuppressWarnings({ "rawtypes", "unchecked" })
	public static void listVOToPO(List voList,List poList,Class poType){
		if(voList==null || poList==null){
			return;
		}
		
		for(Object obj : voList){
			try {
				Object po = poType.newInstance();
				convertVOToPO(obj,po);
				poList.add(po);
			} catch (InstantiationException e) {
				LogUtils.logException(e);
			} catch (IllegalAccessException e) {
				LogUtils.logException(e);
			}
			
		}
	}
	
	/**
	 * 转换PO(Persistent Object5)列表到VO(Value Object)列表,以便于只传输需要的数据到界面端
	 * @param poObj
	 */
	@SuppressWarnings({ "rawtypes", "unchecked" })
	public static void listPOToVO(List poList,List voList,Class voType){
		if(poList==null || voList==null){
			return;
		}
		
		for(Object obj : poList){
			try {
				Object vo = voType.newInstance();
				convertPOToVO(obj,vo);
				voList.add(vo);
			} catch (InstantiationException e) {
				LogUtils.logException(e);
			} catch (IllegalAccessException e) {
				LogUtils.logException(e);
			}
			
		}
	}

}
