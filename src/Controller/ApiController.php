<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{
    protected $statusCode = 200;

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    protected function setStatusCode(int $statusCode): ApiController
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function response(array $data, $headers = []): JsonResponse
    {
        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    public function responseWithErrors(string $errors, $headers = []): JsonResponse
    {
        $data = [
            'status' => $this->getStatusCode(),
            'errors' => $errors
        ];

        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    public function responseWithSuccess(string $success, $headers = []): JsonResponse
    {
        $data = [
            'status' => $this->getStatusCode(),
            'success' => $success
        ];

        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    public function respondUnauthorized($message = 'Not authorized!'): JsonResponse
    {
        return $this->setStatusCode(401)->responseWithErrors($message);
    }

    public function respondValidationError($message = 'Validation errors'): JsonResponse
    {
        return $this->setStatusCode(422)->responseWithErrors($message);
    }

    public function respondNotFound($message = 'Not Found!'): JsonResponse
    {
        return $this->setStatusCode(404)->responseWithErrors($message);
    }

    public function responseCreated($data = []): JsonResponse
    {
        return $this->setStatusCode(201)->response($data);
    }

    protected function transformJsonBody(Request $request): Request
    {
        $data = json_decode($request->getContent(), true);

        if(!$data){
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }
}