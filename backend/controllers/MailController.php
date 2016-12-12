<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 05/12/2016
 * Time: 16:34
 */
require_once "../../resource/vendor/autoload.php";
require_once "../database/Config.php";

/*$mail = new PHPMailer;

//Enable SMTP debugging.
$mail->SMTPDebug = 3;
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;
//Provide username and password
$mail->Username = "noreplythanhle@gmail.com";
$mail->Password = "!@#noreply!@#";
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";
//Set TCP port to connect to
$mail->Port = 587;

$mail->From = "noreplythanhle@gmail.com";
$mail->FromName = "Ngo Duc Nhan";

$mail->addAddress($_POST["email"], "Recepient Name");

$mail->isHTML(true);

$mail->Subject = $_POST["subject"];
$mail->Body = $_POST["content"];
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send())
{
    echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
    echo "Message has been sent successfully";
}*/

class MailController
{
    public $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer;
        $this->mail->SMTPDebug = 0;
        $this->mail->isSMTP();
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPAuth = true;
        $this->mail->Username = MAIL-USERNAME;
        $this->mail->Password = MAIL-PASSWORD;
        $this->mail->SMTPSecure = "tls";
        $this->mail->Port = 587;
        $this->mail->From = MAIL-FROM;
        $this->mail->FromName = MAIL-NAME;
        $this->mail->isHTML(true);
        $this->mail->AltBody = "This is the plain text version of the email content";
    }

    public function initMail($email, $subject, $body)
    {
        $this->setEmailAddress($email);
        $this->setSubject($subject);
        $this->setBody($body);
    }

    public function setEmailAddress($email)
    {
        $this->mail->addAddress($email, "Recepient Name");
    }

    public function setSubject($subject)
    {
        $this->mail->Subject = $subject;
    }

    public function setBody($body)
    {
        $this->mail->Body = $body;
    }

    public function send()
    {
        return ($this->mail->send()) ? true : false;
    }

    public function mailBodyConfirm($username, $password, $link)
    {
        $hey = "HEY";
        $htmlContent = "<!Doctype html>
<html>
<head>
    <meta charset=\"utf-8\">
</head>
<body>
<div style=\"font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#eeeeee\">
    <table align=\"center\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#eeeeee\">
        <tbody>
        <tr>
            <td>
                <table align=\"center\" width=\"750px\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#eeeeee\"
                       style=\"width:750px!important\">
                    <tbody>
                    <tr>
                        <td colspan=\"3\" align=\"center\">
                            <table width=\"630\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                <tbody>
                                <tr>
                                    <td colspan=\"3\" height=\"60\"></td>
                                </tr>
                                <tr>
                                    <td width=\"25\"></td>
                                    <td align=\"center\">
                                        <h1 style=\"font-family:HelveticaNeue-Light,arial,sans-serif;font-size:48px;color:#404040;line-height:48px;font-weight:bold;margin:0;padding:0\">
                                            Chào mừng đến với thư viện Hiền Nhân</h1>
                                    </td>
                                    <td width=\"25\"></td>
                                </tr>
                                <tr>
                                    <td colspan=\"3\" height=\"40\"></td>
                                </tr>
                                <tr>
                                    <td colspan=\"5\" align=\"center\">
                                        <p style=\"color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0\">
                                            Tài khoản của bạn đã được đăng ký với username: ";
        $htmlContent .= "$username";
        $htmlContent .= " và password: ";
        $htmlContent .= (string) $password;
        $htmlContent .= "</p>
                                        <br>
                                        <p style=\"color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0\">
                                            Click vào link bên dưới để thay đổi password ban đầu bạn nhé.
                                            Chúc một ngày tốt lành.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=\"4\">
                                        <div style=\"width:100%;text-align:center;margin:30px 0\">
                                            <table align=\"center\" cellpadding=\"0\" cellspacing=\"0\"
                                                   style=\"font-family:HelveticaNeue-Light,Arial,sans-serif;margin:0 auto;padding:0\">
                                                <tbody>
                                                <tr>
                                                    <td align=\"center\" style=\"margin:0;text-align:center\"><a
                                                            href=\"$link\"
                                                            style=\"font-size:21px;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#0096d3;padding:14px 40px;display:block;letter-spacing:1.2px\"
                                                            target=\"_blank\">Thay đổi Mật khẩu</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=\"3\" height=\"30\"></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    </td>
    </tr>
    </tbody>
    </table>
</div>
</body>
</html>";
        return $htmlContent;
    }
}

?>