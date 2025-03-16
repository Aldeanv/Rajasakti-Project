<x-mail::message>
# Konfirmasi Pendaftaran: {{ $participant->program_title }}

Yth. **{{ $participant->nama }}**,

Dengan ini kami mengonfirmasi bahwa Anda telah berhasil terdaftar dalam program **{{ $participant->program_title }}**.  
Kami sangat mengapresiasi partisipasi Anda dan berharap acara ini dapat memberikan manfaat yang besar bagi Anda.

---

## 📅 Detail Acara
- **Tanggal:** {{ \Carbon\Carbon::parse($participant->program->date)->locale('id')->translatedFormat('l, d F Y') }}
- **Waktu:** {{ \Carbon\Carbon::parse($participant->program->time)->format('H:i') }} WIB
- **Lokasi:** [{{ $participant->program->location }}]({{ $participant->program->maps }})

---

## 📌 QR Code Pendaftaran Anda:
Silakan tunjukkan QR Code ini saat acara untuk melakukan registrasi.

<img src="{{ asset('storage/' . $participant->qrcode_path) }}" alt="QR Code" style="max-width: 200px; display: block; margin: auto;">

> Cetak atau simpan QR Code ini di perangkat Anda. QR Code ini akan digunakan sebagai bukti pendaftaran dan akses masuk ke dalam acara.

---

## ℹ️ Petunjuk dan Informasi Tambahan:
- Pastikan hadir tepat waktu sesuai dengan jadwal yang telah ditentukan.
- Gunakan pakaian yang sopan dan nyaman sesuai dengan ketentuan acara.
- Harap membawa peralatan yang diperlukan untuk mendukung partisipasi Anda dalam acara.
- Jika mengalami kendala atau memiliki pertanyaan lebih lanjut, silakan hubungi panitia.

Kami sangat menantikan kehadiran Anda di acara ini.  
Jika ada pertanyaan, jangan ragu untuk menghubungi kami.

**Sampai jumpa dan semoga acara ini memberikan manfaat yang besar bagi Anda! 🎉**

Salam,  
**Panitia {{ $participant->program_title }}**
</x-mail::message>
