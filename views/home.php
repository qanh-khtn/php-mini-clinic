<?php /** @var array $data */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($data['title']) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($data['title']) ?></h1>
    <ul>
        <li>APP_NAME: <?= htmlspecialchars($data['app_name']) ?></li>
        <li>CLINIC_NAME: <?= htmlspecialchars($data['clinic_name']) ?></li>
        <li>APP_ENV: <?= htmlspecialchars($data['app_env']) ?></li>
        <li>APP_DEBUG: <?= htmlspecialchars($data['app_debug']) ?></li>
    </ul>

    <h2>Danh sách Lịch Khám (Appointments)</h2>
    <?php foreach ($data['appointments'] as $app): ?>
        <div style="margin-bottom: 16px; padding: 12px; border: 1px solid #ccc;">
            <p><strong>Title:</strong> <?= htmlspecialchars($app['title']) ?></p>
            <p><strong>Doctor:</strong> <?= htmlspecialchars($app['doctor']) ?></p>
            <p><strong>Date:</strong> <?= htmlspecialchars($app['date']) ?></p>
            <p><strong>Seats Total:</strong> <?= htmlspecialchars((string) $app['seats_total']) ?></p>
            <p><strong>Seats Available:</strong> <?= htmlspecialchars((string) $app['seats_available']) ?></p>
            <p><strong>Status:</strong> <?= $app['seats_available'] > 0 ? 'Open' : 'Full' ?></p>
        </div>
    <?php endforeach; ?>

    <h2>API Endpoints</h2>
    <ul>
        <li>GET /appointments</li>
        <li>HEAD /appointments</li>
        <li>POST /registrations</li>
        <li>OPTIONS /registrations</li>
    </ul>
</body>
</html>