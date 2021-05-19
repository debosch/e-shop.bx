<?php

namespace Team\models\blogic;

use Exception;

error_reporting(E_ALL);
ini_set('display_errors', true);
date_default_timezone_set('Europe/Moscow');

class Sendmessage
{
	public function sendMail($name, $receiver)
	{
		// Переменные, которые отправляет пользователь $name $email $text

		// Формирование самого письма
		$title = "Уведомление";

		$body = <<<MESSAGE
<table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> 
         <tbody><tr style="border-collapse:collapse"> 
          <td align="center" style="padding:0;Margin:0"> 
           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#9FC5E8;width:600px" cellspacing="0" cellpadding="0" bgcolor="#9fc5e8" align="center"> 
             <tbody><tr style="border-collapse:collapse"> 
              <td align="left" style="padding:0;Margin:0"> 
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                 <tbody><tr style="border-collapse:collapse"> 
                  <td class="es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:600px"> 
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                     <tbody><tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0;padding-top:5px;font-size:0"><a target="_blank" href="http://team-a-2020/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;font-size:14px;text-decoration:none;color:#F1C232"><img class="adapt-img" src="https://raw.githubusercontent.com/5ausage/dev.bx/default/images/ms1.png" alt="Your order is on its way" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" title="Your order is on its way" width="600"></a></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table></td> 
             </tr> 
             <tr style="border-collapse:collapse"> 
              <td style="padding:0;Margin:0;padding-left:20px;padding-right:20px;background-image:url(https://raw.githubusercontent.com/5ausage/dev.bx/default/images/ms2.png);background-repeat:no-repeat;background-position:center top" align="left" background="https://raw.githubusercontent.com/5ausage/dev.bx/default/images/ms2.png"> 
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                 <tbody><tr style="border-collapse:collapse"> 
                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px"> 
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                     <tbody><tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height:24px;color:#333333">$name, мы получили Ваш заказ и начали работу над ним.</p></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:15px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height:24px;color:#333333">В случае вопросов, обращайтесь к нашему менеджеру по номеру +79114967493.</p></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-left:10px;padding-right:10px"><span class="es-button-border" style="border-style:solid;border-color:transparent;background:#FFE599;border-width:0px;display:inline-block;border-radius:29px;width:auto"><a href="http://team-a-2020/" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'comic sans ms', 'marker felt-thin', arial, sans-serif;font-size:14px;color:#333333;border-style:solid;border-color:#FFE599;border-width:5px 15px 5px 15px;display:inline-block;background:#FFE599;border-radius:29px;font-weight:normal;font-style:normal;line-height:17px;width:auto;text-align:center">Ссылка на что то</a></span></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table></td> 
             </tr> 
             <tr style="border-collapse:collapse"> 
              <td align="left" style="padding:0;Margin:0"> 
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                 <tbody><tr style="border-collapse:collapse"> 
                  <td valign="top" align="center" style="padding:0;Margin:0;width:600px"> 
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                     <tbody><tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0;font-size:0"><img class="adapt-img" src="https://raw.githubusercontent.com/5ausage/dev.bx/default/images/ms3.png" alt="" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="600"></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table></td> 
             </tr> 
           </tbody></table></td> 
         </tr> 
       </tbody></table>
MESSAGE;

		$status = '';
		// Настройки PHPMailer
		$mail = new \Team\lib\PHPMailer\PHPMailer();
		try
		{
			$mail->isSMTP();
			$mail->CharSet = "UTF-8";
			$mail->SMTPAuth = true;
			//$mail->SMTPDebug = 2;
			$mail->Debugoutput = function($str, $level) {
				$GLOBALS['status'][] = $str;
			};

			// Настройки вашей почты
			$mail->Host = 'smtp.gmail.com'; // SMTP сервера вашей почты
			$mail->Username = 'teama2020smtp@gmail.com'; // Логин на почте
			$mail->Password = 'vansonrulit99'; // Пароль на почте
			$mail->SMTPSecure = 'ssl';
			$mail->Port = 465;
			$mail->setFrom('teama2020smtp@gmail.com', 'Магазин команды А'); // Адрес самой почты и имя отправителя

			// Получатель письма
			$mail->addAddress($receiver);

			// Отправка сообщения
			$mail->isHTML(true);
			$mail->Subject = $title;
			$mail->Body = $body;

			// Проверяем отравленность сообщения
			if ($mail->send())
			{
				$result = "Success";
				$status = "All is ok";
			}
			else
			{
				$result = "Error";
				$status = "The message was not sent. {$mail->ErrorInfo}";
			}
		}

		catch (Exception $e)
		{
			$result = "Error";
			$status = "The message was not sent. {$mail->ErrorInfo}";
		}

		// Отображение результата
		echo json_encode(["Result" => $result]);
		echo json_encode(["Status" => $status]);
	}
}