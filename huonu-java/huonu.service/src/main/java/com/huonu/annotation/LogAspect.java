package com.huonu.annotation;

import java.lang.reflect.Method;

import org.apache.commons.lang.StringUtils;
import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.aspectj.lang.ProceedingJoinPoint;
import org.aspectj.lang.reflect.MethodSignature;


public class LogAspect {
	
	//@Autowired
	//private LogService logService;

	private Log logger = LogFactory.getLog(LogAspect.class);

	public Object doSystemLog(ProceedingJoinPoint point) throws Throwable {
		String methodName = point.getSignature().getName();
		
		if(StringUtils.isEmpty(methodName))
			return point.proceed();

		MethodSignature signature = (MethodSignature)point.getSignature();
		Class<? extends Object> targetClass = point.getTarget().getClass();
		Method method = targetClass.getMethod(methodName, signature.getMethod().getParameterTypes());
		if(method == null)
			return point.proceed();

		boolean hasAnnotation = method.isAnnotationPresent(LogAnnotation.class);
		if(!hasAnnotation)
			return point.proceed();
		
		LogAnnotation annotation = method.getAnnotation(LogAnnotation.class);
		
		Object object = point.getArgs()[0];
		
		System.out.println(annotation);
		System.out.println(object);
		
		return point.proceed();
	}
	
}
