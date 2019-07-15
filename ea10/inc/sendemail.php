<?php


    function SendMail($from,$to,$subject,$uzi) {
        require_once 'Mail.php';
        //----- SMTP
        $host="ssl://smtp.gmail.com";
        $port="465";
        $username="phptanf";
        $password="Jel12345";
        // ---------
        $headers=array(
               'From' => $from,
                 'To' => $to,
            'Subject' => $subject);
        $par=array(
          'host'      => $host,
            'port'    => $port,
            'auth'    => true,
            'username'=> $username,
            'password'=> $password
        );
        $smtp=Mail::factory('smtp',$par);
        $mail=$smtp->send($to,$headers,$uzi);
        if(PEAR::isError($mail)) {
            return create_uzi($mail->getMessage(),"error");
        } else {
            return create_uzi("A level sikeresen elkuldodott","accept");
        }
    }




?>
