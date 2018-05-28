package com.huonu.web.controller;

import java.io.PrintWriter;

import javax.servlet.http.HttpServletResponse;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.serializer.SerializerFeature;

public abstract class BaseController {
	
	protected final Logger logger = LoggerFactory.getLogger(this.getClass());
	
	/**
     * description:send the ajax response back to the client side.
     * 
     * @param responseObj
     * @param response
     */
    protected void writeAjaxJSONResponse(Object responseObj,HttpServletResponse response){
        response.setCharacterEncoding("UTF-8");
        response.setHeader("Content-Type", "application/json");
        response.setHeader("Cache-Control", "no-cache, no-store, must-revalidate"); // HTTP 1.1
        response.setHeader("Pragma", "no-cache"); // HTTP 1.0
        response.setDateHeader("Expires", 0); // Proxies.
        
        PrintWriter writer = getWriter(response);
        writeAjaxJSONResponse(responseObj, writer);
    }
    
    /**
     * 
     * @param response
     * @return
     */
    protected PrintWriter getWriter(HttpServletResponse response){
        if(response==null)
            return null;
        
        PrintWriter writer = null;
        try{
            writer = response.getWriter();
        }catch(Exception e){
            logger.error("unknow exception",e);
        }
        
        return writer;
    }
    
    /**
     * description:send the ajax response back to the client side.
     * @param responseType
     * @param responseContent
     * @param writer
     */
    protected void writeAjaxJSONResponse(Object responseObj,PrintWriter writer){
        if(writer==null || responseObj==null){
            return;
        }            
        try {
            SerializerFeature[] serializerFeatures = {SerializerFeature.DisableCircularReferenceDetect};
            writer.write(JSON.toJSONString(responseObj, serializerFeatures)); 
        } finally{
            writer.flush();
            writer.close();
        }
    }
    

}
