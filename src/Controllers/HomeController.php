<?php
namespace App\Controllers;

class HomeController
{
    public function index(array $config, array $appointments): array
    {
        return [
            'title' => 'Mini Clinic Appointment Registration App',
            'app_name' => $config['app']['name'],
            'clinic_name' => $config['app']['clinic_name'],
            'app_env' => $config['app']['env'],
            'app_debug' => $config['app']['debug'] ? 'true' : 'false',
            'appointments' => $appointments
        ];
    }
}