<?php

namespace App\Controllers;

class Contact extends BaseController
{
    /**
     * Menampilkan halaman formulir kontak.
     */
    public function index()
    {
        $data = [
            'title' => 'Hubungi Kami'
        ];
        return view('contact_view', $data); // Pastikan nama file view Anda adalah contact_view.php
    }

    /**
     * Menerima dan memproses data dari form, lalu mengirim email.
     */
    public function send()
    {
        // 1. Aturan Validasi: Pastikan semua field diisi dengan benar.
        $rules = [
            'name'    => 'required|min_length[3]',
            'email'   => 'required|valid_email',
            'subject' => 'required|min_length[5]',
            'message' => 'required|min_length[10]',
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan ke halaman kontak dengan pesan error.
            return redirect()->to('/contact')->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Ambil data dari form jika validasi berhasil.
        $name    = $this->request->getPost('name');
        $emailFrom = $this->request->getPost('email');
        $subject = $this->request->getPost('subject');
        $message = $this->request->getPost('message');

        // 3. Inisialisasi service email.
        $email = \Config\Services::email();

        // 4. Konfigurasi email yang akan dikirim.
        $email->setTo('emailbisnisanda@gmail.com');      // GANTI DENGAN EMAIL TUJUAN ANDA
        $email->setFrom('emailanda@gmail.com', 'Website RB Teknik'); // HARUS SAMA DENGAN `SMTPUser` di .env
        $email->setReplyTo($emailFrom, $name); // Agar saat dibalas, emailnya terkirim ke pengunjung.
        $email->setSubject("Pesan dari Website: " . $subject);

        // 5. Buat isi pesan email dengan format yang rapi.
        $emailBody = "Anda menerima pesan baru dari formulir kontak website:<br><br>" .
            "<b>Nama:</b> " . esc($name) . "<br>" .
            "<b>Email:</b> " . esc($emailFrom) . "<br>" .
            "<b>Subjek:</b> " . esc($subject) . "<br><br>" .
            "<b>Pesan:</b><br>" . nl2br(esc($message));

        $email->setMessage($emailBody);

        // 6. Kirim email dan beri feedback ke pengguna.
        if ($email->send()) {
            session()->setFlashdata('success', 'Pesan Anda telah berhasil terkirim. Kami akan segera menghubungi Anda.');
        } else {
            // Jika gagal, tampilkan pesan error (dan debug jika perlu).
            // $debug = $email->printDebugger(['headers']); print_r($debug);
            session()->setFlashdata('error', 'Maaf, terjadi kesalahan saat mengirim pesan. Silakan coba lagi nanti.');
        }

        return redirect()->to('/contact');
    }
}
