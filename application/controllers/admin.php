<?php

class Admin extends CI_Controller {
    function index() {
        $this->load->view("helpers/script_redirection", array(
            'location' => '/'
        ));
    }
    
    function managePosts() {
        
        if($this->session->userdata('administrador')=='no-autorizado') {
            $this->load->view("helpers/script_redirection", array(
                'location' => '/'
            ));
        }
        
        $this->load->library('post');
        $this->load->model('posts_model');
        $losPosts=$this->posts_model->dameTodo();
        
        $setUpPage=array(
            'titulo' => 'Administración',
            'css' => array('admin.css'),
            'scripts' => array('admin.js','jquery.dataTables.min.js'),
            'losPosts' => $losPosts
        );
        
        $this->load->view('pages/admin_view', $setUpPage);
        
    }
    
    function manageUsers() {
        
        if($this->session->userdata('administrador')=='no-autorizado') {
            $this->load->view("helpers/script_redirection", array(
                'location' => '/'
            ));
        }
        
        $setUpPage=array(
            'titulo' => 'Administración',
            'css' => array('admin.css'),
            'scripts' => array('admin.js','jquery.dataTables.min.js')
        );
        
        $this->load->view('pages/admin_view', $setUpPage);
    }
}
?>
