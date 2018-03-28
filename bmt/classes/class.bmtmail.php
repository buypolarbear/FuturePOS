<?php
	/*
		
		SEND EXAMPLE WITH SMTP
		
		$mail=new sendMail();
		$mail->isSMTP();
		$mail->setTo('sebastiano@basementcms.com','Sebastiano@BMT');
		$mail->setObject('Hello world.');
		$mail->setText('Lorem ipsum dolor sit amet.');
		$mail->send();	
		
		SEND EXAMPLE WITHOUT SMTP
		
		$mail=new sendMail();
		$mail->isSMTP();
		$mail->setFrom('notifications@basementcms.com','Notifications@BMT');
		$mail->setTo('sebastiano@basementcms.com','Sebastiano@BMT');
		$mail->setObject('Hello world.');
		$mail->setText('Lorem ipsum dolor sit amet.');
		$mail->send();
		
	*/
	
	
	class sendMail{
	    private $from = array();
		private $to = array();
		private $object = array();
		private $text = array();
		private $mailConfigs=array();
		private $sendSMTP='NO';
		
		public function isSMTP(){
			$this->from['email']=$email;
			$this->sendSMTP='YES';
		}
		
		public function setFrom($email,$name){
			$this->from['email']=$email;
		}
		
		public function setTo($email,$name){
			$this->to['email']=$email;
			$this->to['name']=$name;
		}
		
		public function setObject($object){
			$this->object=$object;
		}
		
		public function setText($text){
			$this->text=$text;
		}
		
	    public function send() {
	        $mail= new PHPMailer();
			$mail->CharSet="UTF-8";
			$this->getMailConfigs();
			
			if(isset($this->mailConfigs['mail_host']) && strtoupper($this->sendSMTP)=='YES'){
				$mail->IsSMTP();
				//$mail->SMTPDebug  = 2;
				$mail->SMTPAuth   = true;
				$mail->Host       = $this->mailConfigs['mail_host'];
				$mail->Port       = $this->mailConfigs['mail_port'];     
				$mail->SMTPSecure = $this->mailConfigs['mail_secure'];     
				$mail->Username   = $this->mailConfigs['mail_username'];
				$mail->Password   = $this->mailConfigs['mail_password'];
				$mail->SetFrom($this->mailConfigs['mail_username'], $this->mailConfigs['mail_name']);
				$mail->AddReplyTo($this->mailConfigs['mail_username'], $this->mailConfigs['mail_name']);
			}else{
				$mail->SetFrom($this->from['email'], $this->from['name']);
				$mail->AddReplyTo($this->from['email'], $this->from['name']);
			}
			
			$mail->AddAddress($this->to['email'], $this->to['name']);
			$mail->Subject  = $this->object;
			$mail->MsgHTML($this->returnMailTextHTML($this->text, $this->object));
			$mail->Send();
			
	    }
	    private function getMailConfigs(){
		    $configs = returnDBObject("SELECT * FROM configs WHERE code LIKE 'mail_%'",array()); 
		    foreach($configs as $config){
			    $this->mailConfigs[$config['code']]=$config['value'];
		    }
	    }
	    private function returnMailTextHTML($testo,$titolo){
			$siteurl = returnDBObject("SELECT * FROM configs WHERE code=?",array('siteurl')); 
			$mailHTML='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						<html xmlns="http://www.w3.org/1999/xhtml">
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
						<title>'.$titolo.'</title>
						<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
						</head>
						<body style="margin: 0; padding: 0;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">	
								<tr>
									<td style="padding: 10px 0 30px 0;">
										<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
											<tr>
												<td align="center" style="">
													<img src="'.'http://'.$_SERVER['HTTP_HOST'].'/images/headerMail.png" width="100%" style="display: block;" />
												</td>
											</tr>
											<tr>
												<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
													<table border="0" cellpadding="0" cellspacing="0" width="100%">';
											
											if($titolo!=''){
											$mailHTML.='<tr>
															<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
																<b>'.$titolo.'</b>
															</td>
														</tr>';
														}
														
										$mailHTML.='		<tr>
															<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">'.$testo.'
															
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td bgcolor="#000" style="padding: 30px 30px 30px 30px;">
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
																Inviata il '.date('d/m/Y').' alle '.date('H:i:s').'<br/>
															</td>
															<td align="right" width="25%">
																<table border="0" cellpadding="0" cellspacing="0">
																	<tr>
																		<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</body>
			</html>';
		
		return $mailHTML;
		}
	}
?>