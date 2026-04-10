<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
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

  @include('admin.sidebar')

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
              <button 
                onclick="showDetail(this)"
                data-nama="{{ $pesanan->nama_pemesan }}"
                data-tanggal="{{ $pesanan->created_at->format('d M Y') }}"
                data-produk="{{ $pesanan->produk->nama ?? '-' }}"
                data-qty="{{ $pesanan->qty }}"
                data-pt="{{ $pesanan->instansi ?? '-' }}"
                data-wilayah="{{ $pesanan->wilayah }}"
                data-alamat="{{ $pesanan->alamat }}"
                data-telp="{{ $pesanan->telp }}"
                class="text-[var(--primary)] hover:underline font-medium no-print"
              >
                Lihat Detail
              </button>
            </td>
            <td class="text-center">
              <button 
                onclick="printRow(this)" 
                data-nama="{{ $pesanan->nama_pemesan }}"
                data-tanggal="{{ $pesanan->created_at->format('d M Y') }}"
                data-produk="{{ $pesanan->produk->nama ?? '-' }}"
                data-qty="{{ $pesanan->qty }}"
                data-harga="{{ $pesanan->harga_total }}"
                data-telp="{{ $pesanan->telp }}"
                data-wilayah="{{ $pesanan->wilayah }}"
                data-alamat="{{ $pesanan->alamat }}"
                class="px-4 py-1.5 rounded-lg bg-[var(--primary)] text-white hover:bg-[#004c2c] text-xs transition no-print"
              >
                Print
              </button>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="py-4 text-center text-gray-500">Belum ada pesanan.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- PAGINATION UI -->
    <div class="mt-6 flex justify-between items-center no-print">
        <p class="text-sm text-gray-500">Menampilkan <span id="pageStart">0</span> - <span id="pageEnd">0</span> dari <span id="totalItems">0</span> data</p>
        <div class="flex gap-2">
            <button onclick="prevPage()" id="prevBtn" class="px-3 py-1 bg-white border rounded-lg text-sm disabled:opacity-50">Sebelumnya</button>
            <div id="pageNumbers" class="flex gap-1"></div>
            <button onclick="nextPage()" id="nextBtn" class="px-3 py-1 bg-white border rounded-lg text-sm disabled:opacity-50">Berikutnya</button>
        </div>
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
        <div class="col-span-12 md:col-span-6 bg-gray-50 p-4 rounded-xl border border-gray-100">
          <p class="text-xs text-gray-500 uppercase font-bold tracking-widest mb-1">Tanggal Pesan</p>
          <p id="det-tanggal" class="font-semibold text-gray-800 text-lg">-</p>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="text-xs text-gray-400 uppercase tracking-wider">Produk</label>
            <p id="det-produk" class="text-gray-700">-</p>
          </div>
          <div>
            <label class="text-xs text-gray-400 uppercase tracking-wider">Kuantitas</label>
            <p id="det-qty" class="text-gray-700">-</p>
          </div>
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
          <label class="text-xs text-gray-400 uppercase tracking-wider">Lokasi / Wilayah</label>
          <p id="det-wilayah" class="text-gray-700 whitespace-pre-line bg-gray-50 p-2 rounded-lg text-sm">-</p>
        </div>
        <div>
          <label class="text-xs text-gray-400 uppercase tracking-wider">Alamat Detail</label>
          <p id="det-alamat" class="text-gray-700">-</p>
        </div>
        <button onclick="closeDetail()" class="w-full mt-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl font-medium transition no-print">
          Tutup
        </button>
      </div>
    </div>
  </div>

  <script>
    // PAGINATION LOGIC
    let currentPage = 1;
    const itemsPerPage = 10;
    const rows = Array.from(document.querySelectorAll('.row-pesanan'));

    function renderTable() {
        const totalItems = rows.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        
        if (currentPage < 1) currentPage = 1;
        if (currentPage > totalPages) currentPage = totalPages;

        const start = (currentPage - 1) * itemsPerPage;
        const end = Math.min(start + itemsPerPage, totalItems);

        rows.forEach((row, index) => {
            row.style.display = (index >= start && index < end) ? '' : 'none';
        });

        document.getElementById('pageStart').innerText = totalItems > 0 ? start + 1 : 0;
        document.getElementById('pageEnd').innerText = end;
        document.getElementById('totalItems').innerText = totalItems;

        document.getElementById('prevBtn').disabled = currentPage === 1;
        document.getElementById('nextBtn').disabled = currentPage === totalPages || totalPages === 0;

        renderPageNumbers(totalPages);
    }

    function renderPageNumbers(totalPages) {
        const container = document.getElementById('pageNumbers');
        container.innerHTML = '';
        
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.innerText = i;
            btn.className = `px-3 py-1 rounded-lg text-sm ${i === currentPage ? 'bg-[var(--primary)] text-white' : 'bg-white border text-gray-600'}`;
            btn.onclick = () => { currentPage = i; renderTable(); };
            container.appendChild(btn);
        }
    }

    function prevPage() { if (currentPage > 1) { currentPage--; renderTable(); } }
    function nextPage() { if (currentPage * itemsPerPage < rows.length) { currentPage++; renderTable(); } }

    window.addEventListener('DOMContentLoaded', renderTable);

    // 2. Fungsi Print Baris Tabel (Invois Ringkas)
   function printRow(btn) {
    // Susun parameter URL
    const params = new URLSearchParams({
        tanggal: btn.dataset.tanggal,
        nama: btn.dataset.nama,
        produk: btn.dataset.produk,
        qty: btn.dataset.qty,
        harga: btn.dataset.harga,
        telp: btn.dataset.telp,
        wilayah: btn.dataset.wilayah,
        alamat: btn.dataset.alamat,
        mode: 'autoprint'
    });

    // Buka invoice.blade.php di tab/jendela baru
    window.open("{{ route('admin.invoice.show') }}?" + params.toString(), "_blank");
}

    // 3. Fungsi Print dari Modal
    function printModal() {
      window.print();
    }

    function showDetail(btn) {
      document.getElementById('det-nama').innerText = btn.dataset.nama;
      document.getElementById('det-tanggal').innerText = btn.dataset.tanggal;
      document.getElementById('det-produk').innerText = btn.dataset.produk;
      document.getElementById('det-qty').innerText = btn.dataset.qty + ' Ton';
      document.getElementById('det-pt').innerText = btn.dataset.pt;
      document.getElementById('det-wilayah').innerText = btn.dataset.wilayah;
      document.getElementById('det-alamat').innerText = btn.dataset.alamat;
      document.getElementById('det-telp').innerText = btn.dataset.telp;
      document.getElementById('modalDetail').classList.remove('hidden');
    }

    function closeDetail() {
      document.getElementById('modalDetail').classList.add('hidden');
    }
  </script>
</body>

</html>