<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Pesanan - DigiWash</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            padding-bottom: 40px;
        }

        /* Header */
        .page-header {
            display: flex; align-items: center;
            padding: 54px 18px 20px; position: relative;
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

        /* Illustration */
        .illus-wrap { display: flex; justify-content: center; margin: 0 0 20px; }
        .illus-emoji { font-size: 80px; line-height: 1; }

        /* Detail card */
        .detail-card {
            background: #fff; border-radius: 10px;
            margin: 0 28px 24px; padding: 20px 22px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        .detail-row {
            display: flex; align-items: flex-start;
            justify-content: space-between; padding: 6px 0;
        }
        .detail-key {
            font-weight: 400; font-size: 12px; color: #000;
            min-width: 120px; flex-shrink: 0;
        }
        .detail-val {
            font-weight: 700; font-size: 14px;
            color: #000; text-align: right; flex: 1; word-break: break-word;
        }
        .divider { height: 1px; background: #000; margin: 8px 0; }
        .total-key { font-weight: 700; font-size: 14px; color: #000; }
        .total-val {
            font-weight: 700; font-size: 24px;
            line-height: 22px; color: #019D13;
        }

        /* Action buttons */
        .btn-row { display: flex; gap: 16px; margin: 0 28px; }
        .btn-batalkan {
            flex: 1; height: 41px; background: #F0EFEF;
            border: 1px solid #FF0000; border-radius: 10px;
            font-weight: 700; font-size: 14px; line-height: 22px;
            color: #FF0000; display: flex; align-items: center;
            justify-content: center; cursor: pointer;
            transition: background 0.2s;
        }
        .btn-batalkan:hover { background: #fff0f0; }
        .btn-konfirmasi {
            flex: 1; height: 41px; background: #033B59;
            border: 1px solid #D2CBCB; border-radius: 10px;
            font-weight: 700; font-size: 14px; line-height: 22px;
            color: #fff; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: background 0.2s;
        }
        .btn-konfirmasi:hover { background: #022c44; }

        /* Modal overrides */
        .modal-content { border-radius: 14px; border: none; }
        .modal-header { border-bottom: 1px solid #f0eeee; padding: 18px 22px 12px; }
        .modal-title { font-weight: 700; font-size: 16px; }
        .modal-body { padding: 16px 22px; font-size: 13px; color: #444; line-height: 1.6; }
        .modal-footer { border-top: 1px solid #f0eeee; padding: 12px 22px; gap: 10px; }
    </style>
</head>
<body>
<div class="mobile-wrap">

    <!-- Header -->
    <div class="page-header">
        <a href="<?= base_url('pesanan/buat-pesanan?layanan=' . $layanan) ?>" class="btn-back">&#8592;</a>
        <span class="page-title">Ringkasan Pesanan</span>
    </div>

    <!-- Illustration -->
    <div class="illus-wrap">
        <span class="illus-emoji">📋</span>
    </div>

    <!-- Detail Card -->
    <div class="detail-card">

        <div class="detail-row">
            <span class="detail-key">ID Pesanan</span>
            <span class="detail-val"><?= (string) $id_pesanan ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-key">Tanggal</span>
            <span class="detail-val"><?= date('d M Y') ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-key">Layanan</span>
            <span class="detail-val">Laundry <?= (string) $layanan ?></span>
        </div>

        <?php if ($layanan === 'Satuan' && !empty($detail_satuan)): ?>
            <?php
                $items = json_decode((string) $detail_satuan, true) ?? [];
                $namaItem = [
                    'jas'     => 'Jas Formal',
                    'jaket'   => 'Jaket',
                    'gaun'    => 'Gaun Pesta',
                    'sepatu'  => 'Sepatu',
                    'selimut' => 'Selimut',
                    'tas'     => 'Tas Ransel',
                    'kaos'    => 'Kaos Oblong',
                    'lainnya' => 'Lainnya',
                ];
            ?>
            <div class="detail-row">
                <span class="detail-key">Detail Item</span>
                <span class="detail-val">
                    <?php foreach ($items as $k => $v): if ($v > 0): ?>
                        <?= esc($namaItem[$k] ?? ucfirst($k)) ?> x<?= (int) $v ?><br>
                    <?php endif; endforeach; ?>
                </span>
            </div>
        <?php else: ?>
            <div class="detail-row">
                <span class="detail-key">Berat</span>
                <span class="detail-val"><?= (int) $berat ?> Kg</span>
            </div>
        <?php endif; ?>

        <div class="divider"></div>

        <div class="detail-row">
            <span class="detail-key">Alamat Penjemputan</span>
            <span class="detail-val"><?= esc((string) $alamat) ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-key">Tanggal Penjemputan</span>
            <span class="detail-val"><?= esc((string) $tanggal) ?></span>
        </div>
        <div class="detail-row">
            <span class="detail-key">Catatan</span>
            <span class="detail-val"><?= !empty($catatan) ? esc((string) $catatan) : '–' ?></span>
        </div>

        <div class="divider"></div>

        <div class="detail-row" style="align-items:center; margin-top:4px;">
            <span class="total-key">Total Biaya</span>
            <span class="total-val">Rp <?= number_format((int) $total, 0, ',', '.') ?></span>
        </div>

    </div><!-- /.detail-card -->

    <!-- Action Buttons -->
    <div class="btn-row">
        <button type="button" class="btn-batalkan"
            data-bs-toggle="modal" data-bs-target="#modalBatalkan">
            Batalkan
        </button>
        <button type="button" class="btn-konfirmasi"
            data-bs-toggle="modal" data-bs-target="#modalKonfirmasi">
            Konfirmasi Pesanan
        </button>
    </div>

</div><!-- /.mobile-wrap -->

<!-- ══ Modal Batalkan ══ -->
<div class="modal fade" id="modalBatalkan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">❌ Batalkan Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin <strong>membatalkan</strong> pesanan Anda?
                Data yang sudah diisi akan hilang.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary rounded-3"
                    data-bs-dismiss="modal" style="font-size:13px;">Tidak, Kembali</button>
                <a href="<?= base_url('pesanan/pilih-layanan') ?>"
                   class="btn btn-danger rounded-3 fw-bold" style="font-size:13px;">
                    Ya, Batalkan
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ══ Modal Konfirmasi Pesanan ══ -->
<div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:#033B59;">✅ Konfirmasi Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin <strong>mengkonfirmasi</strong> pesanan ini dan melanjutkan ke pembayaran?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary rounded-3"
                    data-bs-dismiss="modal" style="font-size:13px;">Cek Kembali</button>
                <!-- Form POST ke konfirmasi-pesanan -->
                <form action="<?= base_url('pesanan/konfirmasi-pesanan') ?>" method="post" style="margin:0;">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_pesanan"    value="<?= esc((string) $id_pesanan) ?>">
                    <input type="hidden" name="layanan"       value="<?= esc((string) $layanan) ?>">
                    <input type="hidden" name="berat"         value="<?= (int) $berat ?>">
                    <input type="hidden" name="total"         value="<?= (int) $total ?>">
                    <input type="hidden" name="alamat"        value="<?= esc((string) $alamat) ?>">
                    <input type="hidden" name="tanggal"       value="<?= esc((string) $tanggal) ?>">
                    <input type="hidden" name="catatan"       value="<?= esc((string) $catatan) ?>">
                    <input type="hidden" name="detail_satuan" value="<?= esc((string) $detail_satuan) ?>">
                    <button type="submit" class="btn fw-bold text-white rounded-3"
                        style="background:#033B59; font-size:13px;">
                        Ya, Konfirmasi →
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>