package com.huonu.mq.producer;

import org.springframework.amqp.core.AmqpTemplate;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;

@Component
public class MessageDirectProducer {

	 @Autowired 
	 private AmqpTemplate amqpTemplate;  
	 
	 public void send(String queueName,Object message) {  
		 System.out.println(amqpTemplate);
		 amqpTemplate.convertAndSend(queueName, message);  
	}
}
