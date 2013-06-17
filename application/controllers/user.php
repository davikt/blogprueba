<?php

class User extends CI_Controller {
    
    /**
     * =======================================================================
     * Si alguien accediese a /login sería redireccionado a la raíz del sitio.
     * =======================================================================
     */
    function index() {
        $this->load->view("helpers/script_redirection", array(
            'location' => '/'
        ));
    }
    
    /**
     * =======================================================================
     * Carga el formulario para cambiar la contraseña.
     * =======================================================================
     */
    function editForm() {
        
        $setUpPage=array(
            'titulo' => 'Cambiar Contraseña',
            'css' => array('user.css')
        );        
        
        $this->load->view('pages/pass_form', $setUpPage);
    }
    
    /**
     * =======================================================================
     * Lleva a cabo la acción de cambiar la contraseña. Recibe los parámetros
     * por POST. Y comprueba si el usuario tiene permiso para cambiar la
     * contraseña. (Por si acaso se está intentando cambiar la contraseña de
     * otro usuario)
     * =======================================================================
     */
    function cambiarPassword() {
        $oldPass=$this->input->post('oldPassword');
        $newPass=$this->input->post('newPassword');
        $email=$this->session->userdata('usuario');
        
        $this->load->model('user_model');
        
        if($this->user_model->comprobarUsuario($email,$oldPass)=="no-autorizado") {
            echo "password-incorrect";
        } else {
            $this->user_model->cambiarPassword($email,$newPass);
            echo "password-changed";
        }
        
    }
    
    /**
     * =======================================================================
     * Registra a un usuario.
     * Genera una contraseña de 16 dígitos aleatoria.
     * Manda un email con la misma al correo que se acaba de registrar.
     * =======================================================================
     */
    function guardarRegistro() {
        $email=$this->input->post('email');
        $pass=substr(md5(rand()),0,16);
        
        $this->load->model('user_model');
        
        $existe=$this->user_model->existeUsuario($email);
        if($existe=='1') {
            echo "usuario-ya-registrado";
        } else {
            $this->user_model->anadirUsuario($email,sha1($pass));
            
            $this->load->library('mail');
            
            $text="¡Enhorabuena! Acabas de registrarte en el MicroBlog.\n\nAhora puedes iniciar sesión usando tu dirección de correo y la contraseña: ".$pass."\n\n¡Un saludo!";
            
            $this->mail->setEmail($email);
            $this->mail->setAsunto('Registro en el MicroBlog');
            $this->mail->setMensaje($text);
            
            $this->mail->send();
            
            echo "usuario-registrado";
        }
    }
    
    /**
     * =======================================================================
     * Activa / Desactiva un usuario.
     * 
     * En ambos casos notifica al mismo con un correo. Como se utiliza sólamente
     * en la administración. El motivo e la notificación es "bloqueado por 
     * un administrador".
     * =======================================================================
     */
    function toggleUser() {
        if($this->session->userdata('administrador')=='autorizado') {        
            
            $usuario=$this->input->post('usuario');
            $active=($this->input->post('active')=='on')?'1':'0';
            $mensajeBloq="Hola ".$usuario.",\n\nSu cuenta ha sido bloqueada por un administrador. Contacte con uno de los administradores para más información.\n\n-David (david@davidperalta.info)\n\n¡Un saludo!";
            $mensajeDesbloq="Hola ".$usuario.",\n\nSu cuenta ha sido desbloqueada por un administrador. Disfrute del mini-blog.";
            
            $this->load->model('user_model');
            $this->user_model->toggleUsuario($usuario,$active);
            
            $this->load->library('mail');
            $this->mail->setEmail($usuario);
            $this->mail->setAsunto('Estado de su cuenta en MiniBlog D4P3R');
            $this->mail->setMensaje(($active=='1')?$mensajeDesbloq:$mensajeBloq);
            $this->mail->send();
            
            echo ($active=='1')?"usuario-desbloqueado":"usuario-bloqueado";
            
        } else {
            $this->load->view('helpers/script_redirecion',array('location' => '/'));
        }
    }
    
    /**
     * =======================================================================
     * Restaura la contraseña de un usuario, generando una contraseña aleatoria
     * y notificando por correo al mismo.
     * =======================================================================
     */
    function resetPassword() {
        $email=$this->input->post('mail');
        
        if(($this->session->userdata('administrador')!="autorizado")) {
            $this->load->view("script_redirection", array("location" => "/"));
        } else {
            
            $newPass=substr(md5(rand()),0,16);
            $this->load->model('user_model');
            $this->user_model->cambiarPassword($email,$newPass);
            
            $this->load->library('mail');
            $this->mail->setEmail($email);
            $this->mail->setAsunto("Su nueva contraseña");
            $this->mail->setMensaje("¡Hola!\n\nSu contraseña ha sido reseteada por un administrador. La nueva contraseña es: ".$newPass.". Recuerde que puede cambiarla en cualquier momento haciendo click en el candado morado del menú de la web.\n\n¡Un saludo!");
            $this->mail->send();
            
            echo "password-reseteada";
        }
        
    }
}
?>