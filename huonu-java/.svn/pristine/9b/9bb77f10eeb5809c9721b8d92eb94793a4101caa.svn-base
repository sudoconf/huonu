package com.huonu.mail;

import javax.mail.MessagingException;
import javax.mail.internet.MimeMessage;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.mail.javamail.JavaMailSender;
import org.springframework.mail.javamail.MimeMessageHelper;
import org.springframework.stereotype.Service;
import org.apache.commons.lang3.ArrayUtils;

import com.huonu.utils.log.LogUtils;

@Service("iMailService")
public class MailServiceImpl implements IMailService{

	@Autowired
    private JavaMailSender javaMailSender;
	
	public void sendMail(MailEntry mailEntry) {
		
		MimeMessage message = javaMailSender.createMimeMessage();
        try {
            MimeMessageHelper helper = new MimeMessageHelper(message, true, "utf-8");
            helper.setFrom("734485178@qq.com");
            helper.setTo(mailEntry.getRecipients()); //收件人
            if(ArrayUtils.isNotEmpty(mailEntry.getCarbonCopy())){
                helper.setCc(mailEntry.getCarbonCopy()); //抄送人
            }
            helper.setSubject(mailEntry.getSubject());
            helper.setText(mailEntry.getText(),true);//设置为TRUE则可以使用Html标记
            javaMailSender.send(message);
            
        } catch (MessagingException e) {
        	LogUtils.logException(e);
        }
	}

}
