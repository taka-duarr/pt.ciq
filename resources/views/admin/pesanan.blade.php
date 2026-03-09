<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --primary: #005f37;
    }
    @media print {
    /* Sembunyikan tombol navigasi atau elemen lain yang tidak perlu dicetak */
    .no-print, button, .back-button {
        display: none !important;
    }
    
    /* Atur agar margin kertas pas */
    body {
        background: white !important;
        margin: 0;
        padding: 0;
    }

    /* Pastikan bayangan (shadow) hilang saat dicetak agar bersih */
    .shadow-lg, .shadow-2xl {
        box-shadow: none !important;
        border: 1px solid #eee;
    }
}
    #mainContent {
      transition: margin-left 0.3s ease;
    }

    /* CSS Khusus Print agar Sidebar & Button tidak ikut terprint */
    @media print {

      #sidebarFrame,
      button,
      .no-print,
      h1,
      .dropdown-container {
        display: none !important;
      }

      #mainContent {
        margin-left: 0 !important;
        padding: 0 !important;
      }

      .bg-gray-100 {
        background-color: white !important;
      }

      .shadow-lg {
        shadow: none !important;
        border: 1px solid #ddd;
      }
    }

    /* Styling khusus untuk select agar terlihat seperti badge dengan icon */
    .badge-select {
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      padding-right: 1.5rem !important;
      /* Ruang untuk icon panah */
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 0.4rem center;
      background-size: 0.8rem;
      cursor: pointer;
    }

    @media print {
      .no-print {
        display: none !important;
      }

      /* ... style print lainnya ... */
    }
  </style>
  <title>Pesanan</title>
</head>

<body class="bg-gray-100 min-h-screen">

  <iframe id="sidebarFrame" src="{{ route('admin.sidebar') }}" class="fixed left-0 top-0 w-64 h-full border-none z-50"></iframe>

  <div id="mainContent" class="ml-64 p-8">
    <h1 class="text-2xl font-bold text-[var(--primary)] mb-6">Manajemen Pesanan</h1>

    <div class="bg-white shadow-lg rounded-xl p-6 overflow-x-auto">
      <table class="w-full text-sm">
        <thead>
          <tr class="border-b text-left text-gray-500">
            <th class="pb-3 px-2">Nama Pemesan</th>
            <th class="pb-3 px-2">Produk</th>
            <th class="pb-3 px-2 text-center">Qty</th>
            <th class="pb-3 px-2">Harga</th>
            <th class="pb-3 px-2 text-center">Detail Pemesan</th>
            <th class="pb-3 px-2">Status</th>
            <th class="pb-3 px-2 text-center">Aksi</th>
          </tr>
        </thead>

        <tbody class="divide-y">
          @forelse ($pesanans as $pesanan)
          <tr class="row-pesanan" data-id="{{ $pesanan->id }}">
            <td class="py-4 px-2 font-medium item-nama">{{ $pesanan->nama_pemesan }}</td>
            <td class="py-4 px-2 text-gray-600 item-produk">{{ $pesanan->produk->nama ?? '-' }}</td>
            <td class="py-4 px-2 text-center text-gray-600 item-qty">{{ $pesanan->qty }} ton</td>
            <td class="py-4 px-2 font-semibold item-harga">Rp {{ number_format($pesanan->harga_total, 0, ',', '.') }}</td>
            <td class="py-4 px-2 text-center">
              <button onclick="showDetail('{{ $pesanan->nama_pemesan }}', '{{ $pesanan->instansi ?? '-' }}', '{{ $pesanan->alamat }}', '{{ $pesanan->telp }}')"
                class="text-[var(--primary)] hover:underline font-medium no-print">
                Lihat Detail
              </button>
            </td>
            <td>
              <div class="relative inline-block">
                <select onchange="updateStatusColor(this, '{{ $pesanan->id }}')"
                  @class([
                      'badge-select px-3 py-1 rounded-full text-xs font-semibold border-none focus:ring-2 focus:ring-[var(--primary)] transition-all',
                      'bg-green-100 text-green-700' => $pesanan->status === 'Selesai' || $pesanan->status === 'Telah Sampai',
                      'bg-yellow-100 text-yellow-700' => $pesanan->status === 'Diproses',
                      'bg-blue-100 text-blue-700' => $pesanan->status === 'Dikirim',
                      'bg-red-100 text-red-700' => $pesanan->status === 'Dibatalkan',
                  ])>
                  <option value="Selesai" {{ $pesanan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                  <option value="Diproses" {{ $pesanan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                  <option value="Dikirim" {{ $pesanan->status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                  <option value="Telah Sampai" {{ $pesanan->status == 'Telah Sampai' ? 'selected' : '' }}>Telah Sampai</option>
                  <option value="Dibatalkan" {{ $pesanan->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
              </div>
            </td>
            <td class="text-center">
              <button onclick="printRow(this)" class="px-4 py-1.5 rounded-lg bg-[var(--primary)] text-white hover:bg-[#004c2c] text-xs transition no-print">
                Print
              </button>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="py-4 text-center text-gray-500">Belum ada pesanan.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div id="modalDetail" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[60] p-4">
    <div id="printableModal" class="bg-white rounded-2xl w-full max-w-md overflow-hidden shadow-2xl">
      <div class="bg-[var(--primary)] p-4 text-white flex justify-between items-center">
        <h3 class="text-lg font-bold">Detail Data Pemesan</h3>
        <button onclick="printModal()" class="no-print bg-white text-[var(--primary)] px-3 py-1 rounded-lg text-xs font-bold shadow hover:bg-gray-100">Cetak Detail</button>
      </div>
      <div class="p-6 space-y-4">
        <div>
          <label class="text-xs text-gray-400 uppercase tracking-wider">Nama Lengkap</label>
          <p id="det-nama" class="font-semibold text-gray-800 text-lg">-</p>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="text-xs text-gray-400 uppercase tracking-wider">Instansi</label>
            <p id="det-pt" class="text-gray-700">-</p>
          </div>
          <div>
            <label class="text-xs text-gray-400 uppercase tracking-wider">No. Telepon</label>
            <p id="det-telp" class="text-gray-700 font-mono">-</p>
          </div>
        </div>
        <div>
          <label class="text-xs text-gray-400 uppercase tracking-wider">Alamat Pengiriman</label>
          <p id="det-alamat" class="text-gray-700">-</p>
        </div>
        <button onclick="closeDetail()" class="w-full mt-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl font-medium transition no-print">
          Tutup
        </button>
      </div>
    </div>
  </div>

  <script>
    // 1. Update Warna Status Saat Dipilih
    function updateStatusColor(select, id) {
      const val = select.value;
      select.classList.remove('bg-green-100', 'text-green-700', 'bg-yellow-100', 'text-yellow-700', 'bg-blue-100', 'text-blue-700', 'bg-red-100', 'text-red-700');

      if (val === 'Selesai' || val === 'Telah Sampai') {
        select.classList.add('bg-green-100', 'text-green-700');
      } else if (val === 'Diproses') {
        select.classList.add('bg-yellow-100', 'text-yellow-700');
      } else if (val === 'Dikirim') {
        select.classList.add('bg-blue-100', 'text-blue-700');
      } else if (val === 'Dibatalkan') {
        select.classList.add('bg-red-100', 'text-red-700');
      }

      // Save to database via AJAX
      if (id) {
          fetch(`/admin/pesanan/${id}/status`, {
              method: 'PATCH',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify({ status: val })
          }).then(res => res.json()).then(data => {
              if(!data.success) {
                  alert('Gagal mengupdate status di database!');
              }
          }).catch(err => {
              console.error(err);
              alert('Terjadi kesalahan jaringan.');
          });
      }
    }

    // 2. Fungsi Print Baris Tabel (Invois Ringkas)
   function printRow(btn) {
    const row = btn.closest('.row-pesanan');
    const nama = row.querySelector('.item-nama').innerText;
    const produk = row.querySelector('.item-produk').innerText;
    const qty = row.querySelector('.item-qty').innerText;
    const harga = row.querySelector('.item-harga').innerText;

    // Susun parameter URL
    const params = new URLSearchParams({
        nama: nama,
        produk: produk,
        qty: qty,
        harga: harga,
        mode: 'autoprint' // Trigger khusus untuk cetak otomatis
    });

    // Buka invoice.blade.php di tab/jendela baru
    const printWindow = window.open("{{ route('admin.invoice.show') }}?" + params.toString(), "_blank");
}

    // 3. Fungsi Print dari Modal
    function printModal() {
      window.print();
    }

    function showDetail(nama, pt, alamat, telp) {
      document.getElementById('det-nama').innerText = nama;
      document.getElementById('det-pt').innerText = pt;
      document.getElementById('det-alamat').innerText = alamat;
      document.getElementById('det-telp').innerText = telp;
      document.getElementById('modalDetail').classList.remove('hidden');
    }

    function closeDetail() {
      document.getElementById('modalDetail').classList.add('hidden');
    }
  </script>
</body>

</html>