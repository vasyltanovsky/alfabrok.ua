<?php
	$EmailAdmin = 'info@alfabrok.ua';
	$EmailAdminMame = "www.Alfabrok.ua администратор";
	$EmailTitle = array("contactAs" 			=> "Сообщение с формы обратной связи сайта www.: ",
						"supportQuestion" 		=> "Сообщение с формы вопросы и ответы сайта www.: ",
						"supportAnsver" 		=> "Ответ админнистратора сайта нa вопрос www.: ",
						"reqistation_user"  	=> "Вы зарегестрировались нa сайте www.alfabrok.ua",
						"user_add_logo" 		=> "Добавлен новый логопит нa сайт",
						"send_im_for_friend" 	=> "Недвижимость от www.alfabrok.ua",
						"user_add_order" 		=> "Новая завка на (продажу, аренду) от пользователя."
						);
	
	function GetMailText($template, $data)
	{
			global $mail_template;
			$s = $mail_template[$template];
			foreach($data as $key => $value)
			{
				$s = str_replace("#".$key."#",$value,$s);
			}
			return $s;
	}

	$mail_template["contact_as_company"] = "Пользователь:  #name#. <br />
											Организация: #organization#.<br />
											Контактные данные:<br />
											1.Тел: #tel#<br />
											2.Е-mail: #email#<br /><br />
											Тема сообщения: #titlemsq#<br /><br />
											Текст сообщения: #textmsq#.<br /><br />";
											
	$mail_template["support_question_admin"] = "Пользователь:  #name#. <br />
												Организация: #organization#.<br />
												Контактные данные:<br />
												1.Е-mail: #email#<br /><br />
												Вопрос: #textmsq#.<br /><br />";	
	
	$mail_template["support_question_user"] = "Уважаемый:  #gb_user_name#. <br />
												Контактные данные:<br />
												1.Е-mail: #gb_user_mail#<br /><br />
												Вы задали вопрос: #gb_user_msg#<br /><br />
												Ответ на Ваш вопрос:#gb_answer#<br /><br />
												Спасибо.<br /><br />";		

	$mail_template["user_reqistration"] = "Уважаемый:  #user_name# #user_fio#. <br />
												Вы зарегестрировались на сайте <a href=\"http://www.alfabrok.ua\" alt=\"www.alfabrok.ua\">www.alfabrok.ua</a>
												<br />Ваши контактные данные:<br />
												1. Логин/Е-mail: #user_email#<br />
												2. Пароль: #user_password#<br />
												3. Номер телефона: #user_tel#<br />
												<b>Для активации учетной записи перейдите по <a href=\"http://#validate_link#\">ссылке</a></b><br />
												Спасибо.<br /><br />";	
	
	$mail_template["friend_mail"] =		"Здравствуйте, #name#. <br />
										Ваш друг, пожелал отправить данное предложение по недвижимости на этот e-mail. <br />
										Если письмо пришло по ошибке – приносим свои извинения. С уважением компания «Альфаброк».<br /><br />";	
										
	
	
	$mail_template["user_add_order"] = "Пользователь <b>#user_fio#</b>, ID - #user_id# . <br />
										Добавил заяву на (продажу, аренду) <br />
										Описание: #order_text#<br /><br />
										<br />Контактные данные:<br />
										1. Е-mail: #user_email#<br />
										2. Номер телефона: #user_phone_mobile#<br /><br />";													
?>