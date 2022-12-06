<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],
    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],
    '/usuarios/sucesso' => [
        'GET' => '\Controlador\UsuarioControlador#sucesso',
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
    '/home' => [
        'GET' => '\Controlador\HomeControlador#index',
    ],
    '/usuarios/sucesso' => [
        'GET' => '\Controlador\UsuarioControlador#sucesso',
    ],
    '/home' => [
        'GET' => '\Controlador\HomeControlador#index',
        'POST' => '\Controlador\HomeControlador#armazenar',
    ],
    '/perfil' => [
        'GET' => '\Controlador\PerfilControlador#index',
        'POST' => '\Controlador\PerfilControlador#armazenar',
    ],
    '/perfil/?' => [
        'DELETE' => '\Controlador\PerfilControlador#destruir',
    ],
    '/perfil/usuarios' => [
        'GET' => '\Controlador\PerfilControlador#perfilUsers',
    ],
];
