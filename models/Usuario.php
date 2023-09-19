<?php

namespace Model;

class Usuario extends ActiveRecord {

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    //Validar el Login de Usuarios
    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'User Email is required';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) { //valida que haya el correo real 
            self::$alertas['error'][] = 'Email no validate';
        }   
        if(!$this->password) {
            self::$alertas['error'][] = 'Password cannot be empty';
        }
        return self::$alertas;
    }


    // Validación para cuentas nuevas
    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'User Name is required';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'User Email is required';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'Password cannot be empty';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'Password must contain at least 6 characters';
        }
        if($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Passwords are different';
        }
        return self::$alertas;
    }

    //Validar un EMAIL
    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'Email is required';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) { //valida que haya el correo real 
            self::$alertas['error'][] = 'Email no validate';
        }
        return self::$alertas;
    }

    //Valida el password 
    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'Password cannot be empty';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'Password must contain at least 6 characters';
        }
        return self::$alertas;
    }

    public function validar_perfil() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'Name is required';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'Email is required';
        }
        return self::$alertas;
    }


    // Hashea el PASSWORD
    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    //generar un Token 
    public function crearToken() {
        $this->token = uniqid();
    }
}