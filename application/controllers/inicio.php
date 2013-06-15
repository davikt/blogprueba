<?php

class Inicio extends CI_Controller {
    function index() {
        
        /**
         * Cargamos las librerías de CodeIgniter necesarias.
         *      - Wurfl
         *      - Post
         */
        $this->load->library('wurfl');
        $this->load->library('post');
        
        /**
         * Cargamos los modelos de CodeIgniter necesarios.
         *      - PostsModel
         */
        $this->load->model('posts_model');
        
        /**
         * Alteramos el array de Posts devuelto para rellenar
         * las propiedades dia y mes con respecto a fecha.
         */
        $losPosts = $this->posts_model->obtenerPosts("5");
        
        foreach($losPosts as $elPost) {
            $elPost->setDia(date("j",strtotime($elPost->getFecha())));
            $elPost->setMes(strtoupper(date("M",strtotime($elPost->getFecha()))));
        }
        
        /**
         * Finalmente, enviamos la página al navegador.
         */
        $setUpPage=array(
            'titulo' => 'Inicio',
            'css' => array('inicio.css'),
            'scripts' => array('inicio.js'),
            'posts' => $losPosts
        );
        
        $this->load->view('pages/main_view', $setUpPage);
    }
}


?>
