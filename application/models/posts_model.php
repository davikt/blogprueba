<?php

class Posts_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    /**
     * =======================================================================
     * Función a la que se le pasa un rango de posts, lo
     * consulta en la BD y devuelve un array de objetos 
     * Post sólo con los que se le ha pedido.
     * 
     * @param int $cantidad
     * @param int $inicio Si no se recive toma el valor 0
     * @return array(Post) Devuelve un array de objetos Post
     * =======================================================================
     */
    
    function obtenerPosts($cantidad,$inicio=0) {
        
        $losPosts=array();
        
        $query = $this->db->query("select * 
                                from posts 
                                where active=1 
                                order by fecha desc
                                limit ".$inicio.",".$cantidad.";"
        );
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $elPost= new Post();
                    $elPost->setId($row->id);
                    $elPost->setFecha($row->fecha);
                    $elPost->setTexto(html_entity_decode($row->texto));
                    $elPost->setAutor($row->autor);
                    $elPost->setDispositivo($row->dispositivo);
                    $elPost->setActive($row->active);
              
                array_push($losPosts,$elPost);
            }
        }
        
        return $losPosts;
    }
    
    /**
     * =======================================================================
     * Devuelve el post(objeto) correspondiente al id pasado como parámetro.
     * @param int $id
     * @return \Post
     * =======================================================================
     */
    function obtenerPostPorId($id) {
        $this->load->library('post');
        $elPost=new Post();
        
        $query=$this->db->query("select * from posts where id=\"".$id."\"");
        
        $row=$query->result();
        $row=$row[0];
        $elPost->setId($row->id);
        $elPost->setFecha($row->fecha);
        $elPost->setTexto(html_entity_decode($row->texto));
        $elPost->setAutor($row->autor);
        $elPost->setDispositivo($row->dispositivo);
        $elPost->setActive($row->active);
        
        return $elPost;
    }
    
    /**
     * =======================================================================
     * Añade un objeto Post a la BD.
     * @param Post $elPost
     * =======================================================================
     */
    function addPost($elPost) {
        $this->db->query("insert into 
            posts(texto,autor,dispositivo) values(
                \"".$elPost->getTexto()."\",
                \"".$elPost->getAutor()."\",
                \"".$elPost->getDispositivo()."\"
            )");
    }
    
    /**
     * =======================================================================
     * Por ahora sólo edita el contenido, esta función debe ser revisada para
     * que sea pobile la edición de propietario y active.
     * @param Post $elPost
     * =======================================================================
     */
    function editarPost($elPost) {
        $this->load->library('post');
        
        $this->db->query("update posts 
                            set texto=\"".$elPost->getTexto()."\"
                            where id=\"".$elPost->getId()."\"");
    }
    
    /**
     * =======================================================================
     * Desactiva el post que se le pase por id
     * @param int $id
     * =======================================================================
     */
    function eliminarPost($id) {
        $this->db->query("update posts set active='0' where id=\"".$id."\"");
    }
    
    /**
     * =======================================================================
     * Activa o desactiva un post.
     * @param int $id
     * @param 0 || 1 $mode
     * =======================================================================
     */
    function switchPost($id,$mode) {
        $this->db->query("update posts set active='".$mode."' where id=\"".$id."\"");
    }
    
    /**
     * =======================================================================
     * Obtiene todos los posts de la BD y los devuelve como un array de Posts.
     * @return array(Post)
     * =======================================================================
     */
    function dameTodo() {
        $losPosts=array();
        
        $query = $this->db->query("select * from posts order by fecha desc;"
        );
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $elPost= new Post();
                    $elPost->setId($row->id);
                    $elPost->setFecha($row->fecha);
                    $elPost->setTexto(html_entity_decode($row->texto));
                    $elPost->setAutor($row->autor);
                    $elPost->setDispositivo($row->dispositivo);
                    $elPost->setActive($row->active);
              
                array_push($losPosts,$elPost);
            }
        }
        
        return $losPosts;
    }

}
