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
        
        $this->load->view("helpers/script_redirection", array(
            'location' => '/'
        ));
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
        
        if($this->user_model->esAdmin($email)==='1') {
            $esAdmin='autorizado';
        } else {
            $esAdmin='no-autorizado';
        }
        
        $esCorrecto=$this->user_model->comprobarUsuario($email,$pass);
        
        if($esCorrecto=="autorizado") {
            $this->session->set_userdata(array(
                'autorizacion' => 'autorizado',
                'administrador' => $esAdmin,
                'usuario' => $email        
            ));
        }
        
        echo $esCorrecto;
        
    }
    
    function doLogout() {
        
        $this->load->view("helpers/logout_msg");
        
        $this->session->set_userdata(array(
            'autorizacion' => 'no-autorizado',
            'administrador' => 'no-autorizado',
            'usuario' => ''
        ));
        
        $this->load->view("helpers/script_redirection", array(
            'location' => '/'
        ));
    }
}
?>