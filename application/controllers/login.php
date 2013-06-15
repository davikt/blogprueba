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
            'css' => array('inicio.css'),
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
            'css' => array('login.css'),
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
    
    function doLogout() {
        
        $this->load->view("helpers/logout_msg");
        
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