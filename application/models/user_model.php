<?php

class User_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    
    /**
     * =======================================================================
     * Función usada en el login. Busca en la tabla usuarios los activos y
     * comprueba si existe uno que coincida con el usuario y la contraseña
     * que se le han pasado. Si la evaluación es positiva devuelve "autorizado"
     * en caso contrario, "no-autorizado".
     * @param string $email
     * @param string $pass
     * @return string "autorizado" || "no-autorizado"
     * =======================================================================
     */
    function comprobarUsuario($email,$pass) {
        
        $query = $this->db->query("select * from usuarios 
                                    where email=\"".$email."\" and 
                                    pass=\"".$pass."\" and
                                    active='1';"
        );
        
        if ($query->num_rows() > 0) {
            return 'autorizado';
        } else {
            return 'no-autorizado';
        }
    }
     
    
    /**
     * =======================================================================
     * Recibe un usuario y una contraseña y los añade a la BD.
     * @param string $email
     * @param string $pass
     * =======================================================================
     */
     function anadirUsuario($email,$pass) {
         $query = $this->db->query(
                "insert into usuarios(email,pass) values (\"".$email."\",\"".$pass."\");");
     }
     
     /**
      * =======================================================================
      * Recibe un email de un usuario y lo elimina de la BD.
      * @param string $email
      * =======================================================================
      */
     function eliminarUsuario($email) {
         $this->db->query("delete from usuarios where email=\"".$email."\";");
     }
     
     /**
      * =======================================================================
      * Modifica el usuario (email) recibido cambiándole la contraseña (pass)
      * en la BD.
      * @param string $email
      * @param string $pass
      * =======================================================================
      */
     function cambiarPassword($email,$pass) {
         $this->db->query(
                "update usuarios set pass=\"".$pass."\" where email=\"".$email."\";"
         );
     }
     
     /**
      * =======================================================================
      * Activa/Desactiva un usuario, indicado por el $email.
      * @param string $email
      * @param 1 || 0 $active 
      * =======================================================================
      */
     function toggleUsuario($email,$active) {         
         $query = $this->db->query(
                "update usuarios set active=\"".$active."\" where email=\"".$email."\";"
         );
     }
     
     /**
      * =======================================================================
      * Recibe un email y devuelve el número de veces que ese email se encuentra
      * en la tabla usuarios.  
      * @param string $email
      * @return int 0 || 1 (si devuelve otra cosa, preocúpate)
      * =======================================================================
      */
     function existeUsuario($email) {
         $query=$this->db->query("select count(email) as existentes from usuarios where email=\"".$email."\"");
         
         $existe= $query->row()->existentes;
         
         return $existe;
     }
     
     /**
      * =======================================================================
      * Comprueba si el usuario es administrador.
      * @param string $email
      * @return int 0 || 1
      * =======================================================================
      */
     function esAdmin($email) {
         $query=$this->db->query("select admin from usuarios where email=\"".$email."\" and active='1';");
         
         if ($query->num_rows() > 0) {
            $esAdmin=$query->row()->admin;
         } else {
             $esAdmin='0';
         }
         
         return $esAdmin;
     }
     
     function obtenerTodos() {
         $query=$this->db->query("select active,email from usuarios");
         
         $arrayUsuarios=array();
         
         foreach($query->result() as $row) {
             $user=array(
                 'email' => $row->email,
                 'active' => $row->active
             );
             
             array_push($arrayUsuarios,$user);
         }
         
         return $arrayUsuarios;
     }
}

/* EOF de user_model.php */
