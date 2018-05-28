package com.huonu.utils.spring.adapter;

import java.io.Serializable;

import org.springframework.beans.BeansException;
import org.springframework.context.ApplicationContext;
import org.springframework.context.ApplicationContextAware;

/**
 * 应用程序上下文类
 *
 */
public class AppContext implements ApplicationContextAware , Serializable{
	
	private static final long serialVersionUID = 1L;
	private static ApplicationContext context = null;

	/**
	 * 实现ApplicationContextAware接口的context注入函数, 将其存入静态变量
	 */

	public void setApplicationContext(ApplicationContext context) throws BeansException {
		
		AppContext.setContext(context);
		
	}

	/**
	 * 取得存储在静态变量中的ApplicationContext.
	 */
	public static ApplicationContext getContext() {
		if (context == null)
			throw new IllegalStateException("applicaitonContext未注入,请在applicationContext.xml中定义AppContext");
		return context;
	}
	/**
	 * 存储静态变量中的ApplicationContext.
	 */
	public static void setContext(ApplicationContext context) {
		AppContext.context = context;
	}
	/**
	 * 从静态变量ApplicationContext中取得Bean, 自动转型为所赋值对象的类型
	 */
	@SuppressWarnings("unchecked")
	public static <T> T getBean(String name) {
		if (context == null)
			throw new IllegalStateException("applicaitonContext未注入,请在applicationContext.xml中定义AppContext");
		try {
			return (T) context.getBean(name);
		} catch (BeansException e) {
			e.printStackTrace();
		}
		return null;
	}
}