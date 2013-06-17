<?php

class Posts extends CI_Controller {
    
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
     * Carga el formulario para añadir un post.
     * =======================================================================
     */
    function addForm() {
        
        $setUpPage=array(
            'titulo' => 'Escriba un Post',
            'css' => array('login.css'),
            'scripts' => Array('addpost_form.js')
        );        
        
        $this->load->view('pages/addpost_form', $setUpPage);
    }
    
    /**
     * =======================================================================
     * Carga el formulario para editar un post. Recuperando la información
     * del mismo de la BD.
     * @param int $id
     * =======================================================================
     */
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
    
    /**
     * =======================================================================
     * Función que se utiliza a la hora de crear un post. Lo recibe mediante
     * el parámetro POST codificado para URL. Lo decodifica. Le pasa un 
     * xss_clean y lo guarda en la base de datos. Junto con el nombre de usuario
     * y el dispositivo, que obtiene de la librería wurfl.
     * =======================================================================
     */
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
    
    /**
     * =======================================================================
     * Función utilizada por el editForm para guardar la información que el
     * usuario ha modificado.
     * 
     * Realiza comprobaciones de seguridad y guarda la información.
     * @param ind $id
     * =======================================================================
     */
    function editPost($id) {
        $this->load->helper('security');
        $texto=urldecode($this->input->post("textoPost"));
        $texto=xss_clean($texto);
        $autor=$this->session->userdata('usuario');
        
        $this->load->model('posts_model');
        $elPostOriginal=$this->posts_model->obtenerPostPorId($id);
        
        if($autor=="") {
            $this->load->view("helpers/output_msg",array(
                'msg' => 'Error: No hay ninguna sesión iniciada.'
            ));
        } elseif (($autor==$elPostOriginal->getAutor())||
                ($this->session->userdata('administrador')=="autorizado")) {
            $this->load->library('wurfl');
            $disp=$this->wurfl->obtenerModelo()." (".$this->wurfl->obtenerMarca().")";

            $this->load->library('post');
            
            $this->post->setId($id);
            $this->post->setTexto(htmlentities($texto));
            $this->post->setDispositivo($disp);

            $this->load->model('posts_model');
            $this->posts_model->editarPost($this->post);
            
            echo "guardado";
        } elseif ($autor!=$elPostOriginal->getAutor()) {
            $this->load->view("helpers/output_msg",array(
                'msg' => 'Error: Usted no es el propietario del post.'
            )); 
        } 
    }
    
    
    /**
     * =======================================================================
     * Función utilizada en el inicio de la página para cargar los posts.
     * Es llamada dinámicamente para ir cargando los posts de 5 en 5.
     * Se le indica una posición desde la cual entregar posts y el número
     * de posts que se entregarán.
     * @param int $inicio
     * @param int $cantidad
     * =======================================================================
     */
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
    
    /**
     * =======================================================================
     * Desactiva un post por ID.
     * @param int $id
     * =======================================================================
     */
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
    
    /**
     * =======================================================================
     * Activa o desactiva un post según el parámetro mode que se 
     * le pase por post
     * @param int $id 
     * @param string $mode
     * =======================================================================
     */
    function switchPost() {
        if($this->session->userdata('administrador')=="no-autorizado") {
            echo "no-autorizado";
        } else {
        
            $this->load->model('posts_model');
            $idPost=$this->input->post('id');
            $mode=($this->input->post('mode')=="on")?"1":"0";
            
            $this->posts_model->switchPost($idPost,$mode);
            
            echo "modificacion-correcta";
        
        }        
    }
}
?>