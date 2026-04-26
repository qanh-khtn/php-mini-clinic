<?php
namespace App\Controllers;

use App\Support\Response;

class AppointmentController
{
    public function index(array $appointments): void
    {
        Response::json(200, [
            'message' => 'Danh sách lịch khám',
            'data' => $appointments
        ]);
    }

    public function head(): void
    {
        http_response_code(200);
        header('Content-Type: application/json; charset=UTF-8');
        exit;
    }
}