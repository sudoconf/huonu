package com.huonu.mq.consumer;

import org.springframework.amqp.core.Message;
import org.springframework.amqp.core.MessageListener;
import org.springframework.stereotype.Service;

import com.huonu.utils.log.LogUtils;

@Service
public class MessageDirectConsumer2 implements MessageListener {  
  
    public MessageDirectConsumer2(){}  
    
    public void onMessage(Message message) {  
    	LogUtils.logInfo("**************从队列 queueTest 消费消息 开始*************");
    }  
}