<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 3/5/18
 * Time: 7:17 PM
 */

class FreakMailer extends \PHPMailer\PHPMailer\PHPMailer
{
    var $priority = 3;
    var $to_name;
    var $to_email;
    var $From = null;
    var $FromName = null;
    var $Sender = null;
    var $config;

    public function __construct()
    {
        parent::__construct();
        $this->config = require_once './config.php';
        
    }
    function FreakMailer(){
        if($this->config['smtp_mode'] == 'enabled')
        {
            $this->Host = $this->config['smtp_host'];
            $this->Port = $this->config['smpt_port'];

            if($this->config['smtp_username']!=''){
                $this->SMTPAuth = true;
                $this->Username = $this->config['smtp_username'];
                $this->Password = $this->config['smtp_password'];
                $this->Mailer = 'smtp';
            }

        }

        if(!$this->From){
            $this->From = $this->config['from_email'];
        }
        if(!$this->FromName){
            $this->FromName = $this->config['from_name'];
        }

        $this->Priority = $this->priority;

        
    }
    
}

$mailer = new FreakMailer();
$mailer->Subject = 'Tема письма';
$mailer->Body = 'Текст ';

//Добавляем адрес в список получателей
$mailer->addAddress('user1@gmail.com','Name user');

if(!$mailer->send()){
    echo ' Не отправлено';
}else{
    echo 'Отправлено';
}

$html = '
<head>
    <title>Title</title>
        
</head>
<body>
    <p>Tag p</p>
    <h1>H1</h1>
    <script src="http://www.test.com/css/index.js"></script>
</body>
';
$mailer->Body = $html;
$mailer->isHTML(true);

$mailer->addAttachment('/var/www/test.com/files/file.zip','films.zip');
