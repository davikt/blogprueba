<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Mail {
    
    private $mensaje;
    private $email;
    private $asunto;
    private $transport;
    private $mailer;
            
    function Mail() {
        require_once('./mailLib/swift_required.php');
        
        $this->transport = Swift_SmtpTransport::newInstance('smtp.gmail.com',
                                                        465,
                                                        'ssl')
                       ->setUsername('correopruebas03@gmail.com')
                       ->setPassword('9gU5mHoKdbE6CgSUJ6FE');

          //Creamos el mailer pasándole el transport con la configuración de gmail
          $this->mailer = Swift_Mailer::newInstance($this->transport);
    }
    
    function send() {
        if($this->asunto==null||$this->email==null||$this->mensaje==null) {
            return 'Error. Faltan Datos';
        }
        
          //Creamos el mensaje
          $message = Swift_Message::newInstance($this->asunto)
                      ->setFrom(array('correopruebas03@gmail.com' => 'Correo de Pruebas'))
                      ->setTo($this->email)
                      ->setBody($this->mensaje);

          //Enviamos
          $result = $this->mailer->send($message);
          return $result;        
    }
    
    
    /**
     * GETTERS y SETTERS para las 3 variables a alterar. 
     */
    
    function getMensaje() {
        return $this->mensaje;
    }
    
    function getEmail() {
        return $this->email;
    }
    
    function getAsunto() {
        return $this->asunto;
    }
    
    function setMensaje($mensaje) {
        $this->mensaje=$mensaje;
    }
    
    function setEmail($email) {
        $this->email=$email;
    }
    
    function setAsunto($asunto) {
        $this->asunto=$asunto;
    }
}

/* End of file mail.php */