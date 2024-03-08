<?php
    require_once 'router.php';

    class Practica {
        private $model;
        private $view;
        private $db;

        function __construct(){
            $this->$model = new Modelo();
            $this->$view = new View();
            $this->$db = new PDO("mysql:host" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8" . DB_USER . DB_PASS);
        }

        function getArtistas(){
            $query = $this->$db->prepare('SELECT * FROM artistas');
            $query->execute();
            $artistas = $query->fetchAll(PDO::FETCH_OBJ);

            return $artistas;
        }

        function addArtista($nombre, $edad){
            $query = $this->$db->prepare('INSERT INTO artistas (nombre_artista , edad) VALUES (?, ?)');
            $query->execute([$nombre, $edad]);

            return $this->$db->lastInsertID();
        }

        function deleteArtista($id){
            $query = $this->$db->prepare('DELETE FROM artistas WHERE id = ?');
            $query->execute([$id]);

        }

        function editArtista($id, $nombre, $edad){
            $query = $this->$db->prepare('UPDATE artistas SET nombre_artista = ? ,edad = ? WHERE id = ?');
            $editado = $query->execute([$id, $nombre, $edad]);

            return $realizado;

        }
    }