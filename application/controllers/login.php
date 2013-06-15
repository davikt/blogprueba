<?php

/**
 * ========================================================================
 * El flujo de llamadas con la capa de presentación de esta clase se 
 * ha delegado casi por completo en JQuery y se encuentran en el archivo 
 * "/js/login_form.js"
 * ========================================================================
 */

class Login extends CI_Controller {
    function index() {
        
        /**
         * Se diseña y envía un diálogo de login al usuario.
         */
        
        $setUpPage=array(
            'titulo' => 'Login',
            'css' => 'inicio.css',
            'scripts' => Array('login_form.js','login.js')
        );
        
        $this->load->view('pages/blank', $setUpPage);
        
    }
    
    function loginForm() {
        
        /**
         * Se envía al usuario la vista del formulario y se le adjunta
         * el script de las funciones del mismo (login_form.js).
         */
        
        $setUpPage=array(
            'titulo' => 'LoginForm',
            'css' => 'login.css',
            'scripts' => Array('login_form.js')
        );        
        
        $this->load->view('pages/login_form', $setUpPage);
    }
    
    function doLogin() {
        
        $email=$this->input->post('email');
        $pass=$this->input->post('pass');
        
        $this->load->model('user_model');
        
        /**
         * Escribir los datos de sesión
         */
        $this->session->set_userdata(array(
            'autorizacion' => 'autorizado',
            'usuario' => $email        
        ));
        
        echo $this->user_model->comprobarUsuario($email,$pass);
        
    }
    
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
            $text="
                ¡Enhorabuena! Acabas de registrarte en el MicroBlog.\n
                
                Ahora puedes iniciar sesión usando tu dirección de correo
                y la contraseña: ".$pass."\n
                
                ¡Un saludo!
            ";
            $this->mail->setEmail($email);
            $this->mail->setAsunto('Registro en el MicroBlog');
            $this->mail->setMensaje($text);
            
            $this->mail->send();
            
            echo "usuario-registrado";
        }
    }
    
    function doLogout() {
        
        $this->session->set_userdata(array(
            'autorizacion' => 'no-autorizado',
            'usuario' => ''
        ));
        
        $this->load->view("helpers/script_redirection", array(
            'location' => '/'
        ));
    }
}
?>