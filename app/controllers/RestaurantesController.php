<?php
// Path: app/controllers/RestaurantesController.php

require_once __DIR__ . '/../repositories/RestauranteRepository.php';

class RestaurantesController {
    private $restauranteRepository;

    public function __construct(RestauranteRepository $restauranteRepository) {
        $this->restauranteRepository = $restauranteRepository;
    }

    public function processRequest($requestMethod, $data) {
        // ...
        $action = $data['action'] ?? null;
        switch ($action) {
            case 'getAbiertos':
                $this->getRestaurantesAbiertos();
                break;
            case 'get':
                $id = $data['id_restaurante'] ?? null;
                $id ? $this->getRestaurante($id) : $this->unprocessableEntityResponse("No se pudo procesar la solicitud");
                break;
            }
    } 


    private function getRestaurante($id) {
        $restaurante = $this->restauranteRepository->getRestauranteById($id);
        if ($restaurante) {
            $this->okResponse($restaurante);
        } else {
            $this->okResponse($restaurante);
        }
    }

    private function getRestaurantes() {
        $restaurantes = $this->restauranteRepository->getRestaurantes();
        $this->okResponse($restaurantes);
    }

    private function getRestaurantesAbiertos() {
        // obtener restaurantes donde estaAbierto() == true
        $restaurantes = $this->restauranteRepository->getRestaurantes();
        $restaurantesAbiertos = [];
        foreach ($restaurantes as $restaurante) {
            if ($restaurante->estaAbierto()) {
                $restaurantesAbiertos[] = $restaurante;
            }
        }
        if ($restaurantesAbiertos) {
            $this->okResponse($restaurantesAbiertos);
        } else {
            $this->notFoundResponse("No hay restaurantes abiertos.");
        }
    }

// Métodos de respuesta
    private function response($status, $data) {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($status);
        echo json_encode(['status' => $status, 'data' => $data]);
    }

    private function okResponse($data) {
        $this->response(200, $data);
    }

    private function unprocessableEntityResponse($message) {
        $this->response(422, ['message' => $message]);
    }

    private function notFoundResponse($message) {
        $this->response(404, ['message' => $message]);
    }

    private function internalServerErrorResponse($message) {
        $this->response(500, ['message' => $message]);
    }


}