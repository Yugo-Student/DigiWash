<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Pesanan - DigiWash</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #F0EFEF;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            min-height: 100vh;
        }
        .mobile-wrap {
            width: 100%;
            max-width: 402px;
            background: #F0EFEF;
            min-height: 100vh;
            padding-bottom: 130px;
            position: relative;
        }

        /* Header */
        .page-header {
            display: flex; align-items: center;
            padding: 54px 24px 16px; position: relative;
        }
        .btn-back {
            display: flex; align-items: center; justify-content: center;
            width: 32px; height: 32px; text-decoration: none;
            color: #000; font-size: 20px; font-weight: bold;
        }
        .page-title {
            position: absolute; left: 50%; transform: translateX(-50%);
            font-weight: 600; font-size: 20px; line-height: 22px;
            color: #000; white-space: nowrap;
        }

        /* Status card (top banner) */
        .status-card {
            background: #033B59; border-radius: 14px;
            margin: 0 24px 24px; padding: 20px 20px 18px;
            color: #fff; display: flex; align-items: center; gap: 16px;
        }
        .status-illus { font-size: 52px; flex-shrink: 0; line-height: 1; }
        .status-info-title {
            font-weight: 800; font-size: 16px; color: #fff;
            margin-bottom: 4px; line-height: 1.3;
        }
        .status-info-sub {
            font-weight: 300; font-size: 12px; color: rgba(255,255,255,0.8);
            line-height: 1.5;
        }

        /* Section title */
        .section-title {
            font-weight: 700; font-size: 14px; color: #333;
            margin: 0 24px 14px; display: block;
        }

        /* Timeline */
        .timeline { margin: 0 24px; }
        .tl-item {
            display: flex; gap: 16px;
            position: relative; padding-bottom: 0;
        }
        .tl-left {
            display: flex; flex-direction: column; align-items: center;
            width: 36px; flex-shrink: 0;
        }
        .tl-dot {
            width: 36px; height: 36px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; flex-shrink: 0; position: relative; z-index: 2;
        }
        .tl-dot.done    { background: #033B59; color: #fff; font-weight: 700; font-size: 16px; }
        .tl-dot.active  { background: #019D13; color: #fff; box-shadow: 0 0 0 5px rgba(1,157,19,0.18); }
        .tl-dot.pending { background: #fff; border: 2px solid #D2CBCB; color: #bbb; font-size: 13px; font-weight: 600; }
        .tl-line {
            width: 2px; min-height: 32px; flex: 1; margin: 2px 0;
        }
        .tl-line.done    { background: #033B59; }
        .tl-line.pending { background: #D2CBCB; }
        .tl-content { flex: 1; padding: 6px 0 28px; }
        .tl-stage {
            font-weight: 600; font-size: 13px; color: #000; line-height: 1.3;
        }
        .tl-stage.muted { color: #bbb; }
        .tl-time { font-weight: 400; font-size: 11px; color: #888; margin-top: 2px; }
        .tl-badge {
            display: inline-block; background: #e8f5e9; color: #019D13;
            font-size: 10px; font-weight: 700; border-radius: 20px;
            padding: 2px 10px; margin-top: 4px;
        }

        /* Floating kurir card */
        .kurir-card {
            position: fixed; bottom: 0;
            left: 50%; transform: translateX(-50%);
            width: 100%; max-width: 402px;
            background: #fff; border-radius: 20px 20px 0 0;
            box-shadow: 0px -2px 12px rgba(0,0,0,0.12);
            padding: 16px 24px 28px;
            display: flex; align-items: center;
            justify-content: space-between; gap: 14px; z-index: 100;
        }
        .kurir-avatar {
            width: 46px; height: 46px; border-radius: 50%;
            background: #e2e8f0; display: flex; align-items: center;
            justify-content: center; font-size: 22px; flex-shrink: 0;
        }
        .kurir-info { flex: 1; }
        .kurir-name { font-weight: 700; font-size: 14px; color: #000; }
        .kurir-plate { font-weight: 400; font-size: 12px; color: #666; margin-top: 2px; }
        .btn-chat {
            display: flex; align-items: center; gap: 6px;
            background: #033B59; color: #fff; border: none;
            border-radius: 8px; padding: 10px 16px;
            font-weight: 600; font-size: 13px;
            cursor: pointer; text-decoration: none; white-space: nowrap;
            transition: background 0.2s;
        }
        .btn-chat:hover { background: #022c44; color: #fff; }
    </style>
</head>
<body>
<div class="mobile-wrap">

    <!-- Header -->
    <div class="page-header">
        <a href="<?= base_url('pesanan/status-pembayaran') ?>" class="btn-back">&#8592;</a>
        <span class="page-title">Tracking Pesanan</span>
    </div>

    <!-- Status Banner -->
    <div class="status-card">
        <div class="status-illus">🚴</div>
        <div>
            <div class="status-info-title">Sedang Dalam Perjalanan</div>
            <div class="status-info-sub">
                Kurir sedang menjemput pakaian kamu<br>
                ID: <?= esc((string) $id_pesanan) ?> — Laundry <?= esc((string) $layanan) ?>
            </div>
        </div>
    </div>

    <!-- Timeline -->
    <span class="section-title">Status Laundry</span>
    <div class="timeline">

        <!-- 1. DONE -->
        <div class="tl-item">
            <div class="tl-left">
                <div class="tl-dot done">✓</div>
                <div class="tl-line done"></div>
            </div>
            <div class="tl-content">
                <div class="tl-stage">Pesanan Diterima</div>
                <div class="tl-time">Senin, 13 Okt 2026 · 10:00</div>
            </div>
        </div>

        <!-- 2. DONE -->
        <div class="tl-item">
            <div class="tl-left">
                <div class="tl-dot done">✓</div>
                <div class="tl-line done"></div>
            </div>
            <div class="tl-content">
                <div class="tl-stage">Pembayaran Dikonfirmasi</div>
                <div class="tl-time">Senin, 13 Okt 2026 · 10:15</div>
            </div>
        </div>

        <!-- 3. ACTIVE -->
        <div class="tl-item">
            <div class="tl-left">
                <div class="tl-dot active">🚴</div>
                <div class="tl-line pending"></div>
            </div>
            <div class="tl-content">
                <div class="tl-stage">Kurir Menjemput</div>
                <div class="tl-time">Senin, 13 Okt 2026 · 10:30</div>
                <span class="tl-badge">Sedang Berlangsung</span>
            </div>
        </div>

        <!-- 4. PENDING -->
        <div class="tl-item">
            <div class="tl-left">
                <div class="tl-dot pending">4</div>
                <div class="tl-line pending"></div>
            </div>
            <div class="tl-content">
                <div class="tl-stage muted">Laundry Diterima di Outlet</div>
                <div class="tl-time">–</div>
            </div>
        </div>

        <!-- 5. PENDING -->
        <div class="tl-item">
            <div class="tl-left">
                <div class="tl-dot pending">5</div>
                <div class="tl-line pending"></div>
            </div>
            <div class="tl-content">
                <div class="tl-stage muted">Proses Pencucian</div>
                <div class="tl-time">–</div>
            </div>
        </div>

        <!-- 6. PENDING -->
        <div class="tl-item">
            <div class="tl-left">
                <div class="tl-dot pending">6</div>
                <div class="tl-line pending"></div>
            </div>
            <div class="tl-content">
                <div class="tl-stage muted">Pengeringan & Setrika</div>
                <div class="tl-time">–</div>
            </div>
        </div>

        <!-- 7. PENDING -->
        <div class="tl-item">
            <div class="tl-left">
                <div class="tl-dot pending">7</div>
                <div class="tl-line pending"></div>
            </div>
            <div class="tl-content">
                <div class="tl-stage muted">Siap Diantar</div>
                <div class="tl-time">–</div>
            </div>
        </div>

        <!-- 8. PENDING (last, no line) -->
        <div class="tl-item">
            <div class="tl-left">
                <div class="tl-dot pending">8</div>
            </div>
            <div class="tl-content" style="padding-bottom:0;">
                <div class="tl-stage muted">Pesanan Selesai</div>
                <div class="tl-time">–</div>
            </div>
        </div>

    </div><!-- /.timeline -->
</div><!-- /.mobile-wrap -->

<!-- Floating Kurir Card -->
<div class="kurir-card">
    <div class="kurir-avatar">🧑‍🦱</div>
    <div class="kurir-info">
        <div class="kurir-name">Budi Santoso</div>
        <div class="kurir-plate">Motor · B 1234 XYZ</div>
    </div>
    <a href="https://wa.me/6281234567890" target="_blank" class="btn-chat">
        💬 Chat Kurir
    </a>
</div>

</body>
</html>
