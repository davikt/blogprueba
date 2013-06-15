<?php

class Posts extends CI_Controller {
    function index() {
    }
    
    function addForm() {
        
        $setUpPage=array(
            'titulo' => 'Escriba un Post',
            'css' => array('login.css'),
            'scripts' => Array('addpost_form.js')
        );        
        
        $this->load->view('pages/addpost_form', $setUpPage);
    }
    
    function editForm($id) {
        $this->load->library('post');
        $this->load->model('posts_model');
        $elPost=$this->posts_model->obtenerPostPorId($id);
        
        $setUpPage=array(
            'titulo' => 'Edite su Post',
            'css' => array('login.css'),
            'scripts' => Array('editpost_form.js'),
            'mensaje' => $elPost->getTexto(),
            'id' => $elPost->getId()
        );        
        
        $this->load->view('pages/editpost_form', $setUpPage);
    }
    
    function savePost() {
        $this->load->helper('security');
        $texto=urldecode($this->input->post("textoPost"));
        $texto=xss_clean($texto);
        $autor=$this->session->userdata('usuario');
        
        if($autor=="") {
            $this->load->view("output_msg",array(
                'msg','Error: No hay ninguna sesión iniciada.'
            ));
        } else {
            $this->load->library('wurfl');
            $disp=$this->wurfl->obtenerModelo()." (".$this->wurfl->obtenerMarca().")";

            $this->load->library('post');

            $this->post->setTexto(htmlentities($texto));
            $this->post->setAutor($autor);
            $this->post->setDispositivo($disp);

            $this->load->model('posts_model');
            $this->posts_model->addPost($this->post);
            
            echo "guardado";
        }        
    }
    
    function editPost($id) {
        $this->load->helper('security');
        $texto=urldecode($this->input->post("textoPost"));
        $texto=xss_clean($texto);
        $autor=$this->session->userdata('usuario');
        
        $this->load->model('posts_model');
        $elPostOriginal=$this->posts_model->obtenerPostPorId($id);
        
        if($autor=="") {
            $this->load->view("output_msg",array(
                'msg','Error: No hay ninguna sesión iniciada.'
            ));
        } elseif ($autor!=$elPostOriginal->getAutor()) {
            $this->load->view("output_msg",array(
                'msg','Error: Usted no es el propietario del post.'
            ));
        } elseif ($autor==$elPostOriginal->getAutor()) {
            $this->load->library('wurfl');
            $disp=$this->wurfl->obtenerModelo()." (".$this->wurfl->obtenerMarca().")";

            $this->load->library('post');
            
            $this->post->setId($id);
            $this->post->setTexto(htmlentities($texto));
            $this->post->setDispositivo($disp);

            $this->load->model('posts_model');
            $this->posts_model->editarPost($this->post);
            
            echo "guardado";
        } 
    }
    
    function cargarHtmlPosts($inicio,$cantidad) {
        $this->load->model('posts_model');
        $this->load->library('post');
        $losPosts=$this->posts_model->obtenerPosts($cantidad,$inicio);
        
        foreach($losPosts as $elPost) {
            $elPost->setDia(date("j",strtotime($elPost->getFecha())));
            $elPost->setMes(strtoupper(date("M",strtotime($elPost->getFecha()))));
        }
        
        foreach($losPosts as $post) {
            $setUpPosts = array(
                'elPost' => $post
            );
            $this->load->view('un_post', $setUpPosts);
        }
    }
    
    function eliminarPost($id) {
        $this->load->model('posts_model');
        $elPostOriginal=$this->posts_model->obtenerPostPorId($id);
        
        $emailUsuario=$this->session->userdata('usuario');
        $emailPost=$elPostOriginal->getAutor();
        
        if($emailUsuario!=$emailPost) {
            echo "no-autorizado";
        } else {
            $this->posts_model->eliminarPost($id);
            echo "borrado-correcto";
        }
    }
}
?>