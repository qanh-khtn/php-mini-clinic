<?php /** @var array $data */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['title']) ?></title>
    <link rel="stylesheet" href="/assets/home.css">
</head>
<body>
    <main class="page">
        <section class="hero">
            <h1><?= htmlspecialchars($data['title']) ?></h1>
            <p>Clinic dashboard for quick appointment lookup and registration API testing.</p>
            <ul class="meta-list">
                <li><strong>APP_NAME:</strong> <?= htmlspecialchars($data['app_name']) ?></li>
                <li><strong>CLINIC_NAME:</strong> <?= htmlspecialchars($data['clinic_name']) ?></li>
                <li><strong>APP_ENV:</strong> <?= htmlspecialchars($data['app_env']) ?></li>
                <li><strong>APP_DEBUG:</strong> <?= htmlspecialchars($data['app_debug']) ?></li>
            </ul>
        </section>

        <section>
            <h2 class="section-title">Danh sách lịch khám (Appointments)</h2>
            <div class="appointment-grid">
                <?php foreach ($data['appointments'] as $app): ?>
                    <?php
                    $isOpen = $app['seats_available'] > 0;
                    $statusLabel = $isOpen ? 'Open' : 'Full';
                    $statusClass = $isOpen ? 'status-open' : 'status-full';
                    ?>
                    <article class="appointment-card">
                        <h3><?= htmlspecialchars($app['title']) ?></h3>
                        <p class="info-row"><strong>Doctor:</strong> <?= htmlspecialchars($app['doctor']) ?></p>
                        <p class="info-row"><strong>Date:</strong> <?= htmlspecialchars($app['date']) ?></p>
                        <p class="info-row"><strong>Seats Total:</strong> <?= htmlspecialchars((string) $app['seats_total']) ?></p>
                        <p class="info-row"><strong>Seats Available:</strong> <?= htmlspecialchars((string) $app['seats_available']) ?></p>
                        <span class="status-badge <?= $statusClass ?>"><?= $statusLabel ?></span>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section>
            <h2 class="section-title">API Endpoints</h2>
            <ul class="endpoint-list">
                <li><span>GET</span> /appointments</li>
                <li><span>HEAD</span> /appointments</li>
                <li><span>POST</span> /registrations</li>
                <li><span>OPTIONS</span> /registrations</li>
                <li><span>GET</span> /health</li>
            </ul>
        </section>
    </main>
</body>
</html>