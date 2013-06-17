<?php

class User extends CI_Controller {
    function index() {
        $this->load->view("helpers/script_redirection", array(
            'location' => '/'
        ));
    }
    
    function editForm() {
        
        $setUpPage=array(
            'titulo' => 'Cambiar Contraseña',
            'css' => array('user.css')
        );        
        
        $this->load->view('pages/pass_form', $setUpPage);
    }
    
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
}
?>