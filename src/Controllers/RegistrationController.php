<?php
namespace App\Controllers;

use App\Support\Response;

class RegistrationController
{
    public function store(array $appointments, array $config): void
    {
        $headers = function_exists('getallheaders') ? getallheaders() : [];
        $contentType = $headers['Content-Type'] ?? $headers['content-type'] ?? ($_SERVER['CONTENT_TYPE'] ?? '');

        if (!str_contains(strtolower($contentType), 'application/json')) {
            Response::json(415, [
                'error' => 'Unsupported Media Type',
                'message' => 'Content-Type must be application/json'
            ]);
        }

        $raw = file_get_contents('php://input');
        $payload = json_decode($raw, true);

        if (!is_array($payload)) {
            Response::json(400, [
                'error' => 'Bad Request',
                'message' => 'Invalid JSON body'
            ]);
        }

        $appointmentId = $payload['appointment_id'] ?? null;
        $patientName = trim($payload['patient_name'] ?? '');
        $email = trim($payload['email'] ?? '');
        $quantity = (int) ($payload['quantity'] ?? 0);

        if (!$appointmentId || $patientName === '' || $email === '' || $quantity <= 0) {
            Response::json(422, [
                'error' => 'Unprocessable Content',
                'message' => 'appointment_id, patient_name, email, quantity là bắt buộc và phải hợp lệ'
            ]);
        }

        if ($quantity > $config['app']['max_registrations_per_request']) {
            Response::json(422, [
                'error' => 'Unprocessable Content',
                'message' => 'Số lượng đăng ký vượt quá giới hạn cho phép trong một lần gửi'
            ]);
        }

        $selectedAppointment = null;
        foreach ($appointments as $app) {
            if ($app['id'] === (int) $appointmentId) {
                $selectedAppointment = $app;
                break;
            }
        }

        if (!$selectedAppointment) {
            Response::json(422, [
                'error' => 'Unprocessable Content',
                'message' => 'Lịch khám đã chọn không tồn tại'
            ]);
        }

        if ($selectedAppointment['seats_available'] < $quantity) {
            Response::json(422, [
                'error' => 'Unprocessable Content',
                'message' => 'Không đủ số lượng chỗ trống'
            ]);
        }

        $registrationId = time();

        Response::json(201, [
            'message' => 'Đăng ký lịch khám thành công',
            'data' => [
                'registration_id' => $registrationId,
                'patient_name' => $patientName,
                'email' => $email,
                'appointment_id' => (int) $appointmentId,
                'quantity' => $quantity
            ]
        ], [
            'Location' => '/registrations/' . $registrationId
        ]);
    }

    public function options(): void
    {
        http_response_code(204);
        header('Allow: POST, OPTIONS');
        exit;
    }
}