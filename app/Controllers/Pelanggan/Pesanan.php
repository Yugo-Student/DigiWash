<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;

class Pesanan extends BaseController
{
    public function pilihLayanan()
    {
        return view('Pesanan/pilih_layanan');
    }

    public function buatPesanan()
    {
        $jenisLayanan = $this->request->getGet('layanan') ?? 'Reguler';

        // Jika POST (setelah ubah alamat), ambil layanan dari POST
        if ($this->request->getMethod() === 'post') {
            $jenisLayanan = $this->request->getPost('layanan') ?? $jenisLayanan;
        }

        // Tentukan harga & konfigurasi berdasarkan jenis layanan
        $hargaPerKg = 7000;
        if ($jenisLayanan === 'Express') {
            $hargaPerKg = 12000;
        } elseif ($jenisLayanan === 'BedCover') {
            $hargaPerKg = 7000;
        }

        $data = [
            'layanan'     => $jenisLayanan,
            'harga_per_kg' => $hargaPerKg,
            'alamat'      => 'Jl. Melati No. 12, RT 02/RW 01, Kec. Sukmajaya Depok',
            'tanggal'     => '5 Juni 2026',
        ];

        return view('Pesanan/buat_pesanan', $data);
    }

    public function ringkasan()
    {
        $data = [
            'id_pesanan'    => 'PSN-' . date('Ymd') . '-001',
            'layanan'       => $this->request->getPost('layanan'),
            'berat'         => $this->request->getPost('berat'),
            'total'         => $this->request->getPost('total_harga'),
            'alamat'        => $this->request->getPost('alamat'),
            'tanggal'       => $this->request->getPost('tanggal_penjemputan'),
            'catatan'       => $this->request->getPost('catatan'),
            'detail_satuan' => $this->request->getPost('detail_satuan'),
        ];

        return view('Pesanan/ringkasan', $data);
    }

    public function konfirmasiPesanan()
    {
        // Terima data dari form ringkasan, teruskan ke pembayaran via session
        $session = session();
        $session->set([
            'pesanan_id_pesanan'    => $this->request->getPost('id_pesanan'),
            'pesanan_layanan'       => $this->request->getPost('layanan'),
            'pesanan_berat'         => $this->request->getPost('berat'),
            'pesanan_total'         => $this->request->getPost('total'),
            'pesanan_alamat'        => $this->request->getPost('alamat'),
            'pesanan_tanggal'       => $this->request->getPost('tanggal'),
            'pesanan_catatan'       => $this->request->getPost('catatan'),
            'pesanan_detail_satuan' => $this->request->getPost('detail_satuan'),
        ]);

        return redirect()->to(base_url('pesanan/pembayaran'));
    }

    public function pembayaran()
    {
        $session = session();
        $data = [
            'id_pesanan' => $session->get('pesanan_id_pesanan') ?? ('PSN-' . date('Ymd') . '-001'),
            'total'      => $session->get('pesanan_total') ?? 0,
            'layanan'    => $session->get('pesanan_layanan') ?? '-',
        ];
        return view('Pesanan/pembayaran', $data);
    }

    public function prosesPembayaran()
    {
        $session = session();
        $metode  = $this->request->getPost('metode_bayar') ?? 'Transfer Bank';

        // Simpan metode ke session
        $session->set('pesanan_metode_bayar', $metode);

        return redirect()->to(base_url('pesanan/status-pembayaran'));
    }

    public function statusPembayaran()
    {
        $session = session();
        $data = [
            'id_pembayaran' => 'PAY-' . date('dmY') . '-001',
            'id_pesanan'    => $session->get('pesanan_id_pesanan') ?? ('PSN-' . date('Ymd') . '-001'),
            'metode'        => $session->get('pesanan_metode_bayar') ?? 'Transfer Bank',
            'total'         => $session->get('pesanan_total') ?? 0,
        ];
        return view('Pesanan/status_pembayaran', $data);
    }

    public function tracking()
    {
        $session = session();
        $data = [
            'id_pesanan' => $session->get('pesanan_id_pesanan') ?? ('PSN-' . date('Ymd') . '-001'),
            'layanan'    => $session->get('pesanan_layanan') ?? 'Reguler',
        ];
        return view('Pesanan/tracking', $data);
    }
}