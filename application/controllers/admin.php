<?php

class Admin extends CI_Controller {
    function index() {
        $this->load->view("helpers/script_redirection", array(
            'location' => '/'
        ));
    }
    
    /**
     * ====================================================================
     * Función que recoge y carga en la vista de la administración de los
     * posts la información de todos los artículos.
     * ====================================================================
     */
    function managePosts() {
        
        /**
         * Compruebo que se tenga privilegios. Si no se tiene lo devuelvo
         * al inicio del microBlog
         */
        if($this->session->userdata('administrador')=='no-autorizado') {
            $this->load->view("helpers/script_redirection", array(
                'location' => '/'
            ));
        }
        
        /**
         * Cargo la librería post, para manejar el modelo "posts_model".
         * Y ejecuto la función que me los recupera todos de la BD. 
         */
        $this->load->library('post');
        $this->load->model('posts_model');
        $losPosts=$this->posts_model->dameTodo();
        
        
        /**
         *  Cargo la vista con la información deseada.
         */
        $setUpPage=array(
            'titulo' => 'Administración',
            'css' => array('admin.css'),
            'scripts' => array('admin.js','jquery.dataTables.min.js'),
            'losPosts' => $losPosts
        );
        
        $this->load->view('pages/admin_view', $setUpPage);
        
    }
    
    
    /**
     * ====================================================================
     * Función que recoge y carga en la vista de administración de usuarios
     * la información de todos ellos.
     * ====================================================================
     */
    function manageUsers() {
        
        /**
         * Compruebo que se tenga privilegios de administrador, si no
         * lo devuelvo al inicio del microBlog.
         */
        if($this->session->userdata('administrador')=='no-autorizado') {
            $this->load->view("helpers/script_redirection", array(
                'location' => '/'
            ));
        }
        
        /**
         * Cargo el modelo de usuarios y los recupero todos de la BD.
         */
        $this->load->model('user_model');
        $losUsuarios=$this->user_model->obtenerTodos();
        
        /**
         * Cargo la vista con los datos de usuarios.
         */
        $setUpPage=array(
            'titulo' => 'Administración',
            'css' => array('admin.css'),
            'scripts' => array('admin.js','jquery.dataTables.min.js'),
            'losUsuarios' => $losUsuarios
        );
        
        $this->load->view('pages/admin_view', $setUpPage);
    }
}
?>
