<?php

include_once './app/models/cancionModel.php';
include_once './app/views/cancionView.php';
include_once './app/helpers/sesion.helper.php';
include_once './app/models/artistaModel.php';

class CancionController
{

    private $view;
    private $modelCanciones;
    private $modelArtistas;

    function __construct()
    {
        $this->view = new CancionView();
        $this->modelCanciones = new CancionModel();
        $this->modelArtistas = new ArtistaModel();
    }

    function listaCanciones()
    {
        $canciones = $this->modelCanciones->getCanciones();
        $artistas = $this->modelArtistas->getArtistas();
        $this->view->showCanciones($canciones, $artistas);
    }

    function infoCancion($id)
    {
        $cancion = $this->modelCanciones->getCancion($id);
        $artistas = $this->modelArtistas->getArtistas();
        $this->view->showCancion($cancion, $artistas);
    }

    function eliminarCancion($id)
    {
        SesionHelper::verify();
        $this->modelCanciones->deleteCancion($id);

        header("Location: " . CANCIONES);
    }

    function agregarCancion()
    {
        SesionHelper::verify();

        $nombre = $_POST['nombre_cancion'];
        $artista = $_POST['nombre_artista'];
        $album = $_POST['album'];
        $genero = $_POST['genero'];
        $duracion = $_POST['duracion'];
        $letra = $_POST['letra'];

        if (empty($nombre) || empty($artista) || empty($album) || empty($genero) || empty($duracion) || empty($letra)) {
            $this->view->showError("Debes completar todos los datos");
            return;
        }
        $id = $this->modelCanciones->addCancion($nombre, $artista, $album, $genero, $duracion, $letra);
        if ($id) {
        } else {
            $this->view->showError("Error al insertar la canción");
        }

        header("Location: " . CANCIONES);
    }

    function editCancion($id)
    {
        SesionHelper::verify();

        $nombre = $_POST['nombre_cancion'];
        $artista = $_POST['nombre_artista'];
        $album = $_POST['album'];
        $genero = $_POST['genero'];
        $duracion = $_POST['duracion'];
        $letra = $_POST['letra'];

        if (empty($nombre) || empty($artista) || empty($album) || empty($genero) || empty($duracion) || empty($letra)) {
            $this->view->showError("Debes completar todos los datos");
            return;
        }
        $realizado = $this->modelCanciones->editCancion($nombre, $artista, $album, $genero, $duracion, $letra, $id);
        if ($realizado) {
            header("Location: " . CANCIONES);
        } else {
            $this->view->showError("Error al insertar la canción");
        }
    }
}
