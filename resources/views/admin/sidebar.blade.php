<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    :root {
        --primary: #005f37;
    }
    body {
        overflow: hidden;
    }
    .active-menu {
        background-color: var(--primary) !important;
        color: white !important;
    }
    .active-menu svg {
        color: white !important;
        stroke: white !important;
    }
    body {
    overflow: hidden;
  }
  </style>
</head>

<body class="bg-white text-gray-700">

<!-- SIDEBAR -->
<div id="sidebar"
     class="min-h-screen w-64 transition-all duration-300 flex flex-col p-5 border-r">

  <!-- HEADER -->
  <div class="flex items-center justify-between mb-8">
      <img src="{{ asset('img/logo.png') }}" class="h-8 w-auto" id="logo-full">

      <button onclick="toggleSidebar()"
              class="text-gray-500 hover:bg-gray-200 p-2 rounded-lg">
          <svg xmlns="http://www.w3.org/2000/svg"
               class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h7" />
          </svg>
      </button>
  </div>

  <!-- LABEL -->
  <p id="menu-label" class="text-xs tracking-widest text-gray-400 mb-3 sidebar-text">
      MENU
  </p>

  <!-- NAV -->
  <nav class="flex flex-col space-y-2">

      <!-- DASHBOARD -->
      <a href="{{ route('admin.dashboard.index') }}" data-page="dashboard" target="_parent"
   class="menu-item flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[var(--primary)] hover:text-white transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 12l2-2m0 0l7-7m7 7l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0H6a1 1 0 01-1-1V10m7-7v18"/>
          </svg>
          <span class="sidebar-text">Dashboard</span>
      </a>

      <!-- PRODUK BATU -->
      <a href="{{ route('admin.produk.index') }}" data-page="produk" target="_parent"
   class="menu-item flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[var(--primary)] hover:text-white transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <span class="sidebar-text">Produk Batu</span>
      </a>

      <!-- PESANAN -->
      <a href="{{ route('admin.pesanan.index') }}" data-page="pesanan" target="_parent"
   class="menu-item flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[var(--primary)] hover:text-white transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M20 13V6a2 2 0 00-2-2h-3l-2-2H9L7 4H4a2 2 0 00-2 2v7"/>
          </svg>
          <span class="sidebar-text">Pesanan</span>
      </a>

      <!-- LAPORAN KEUANGAN -->
      <a href="{{ route('admin.financial.index') }}" data-page="financial" target="_parent"
   class="menu-item flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[var(--primary)] hover:text-white transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
          </svg>
          <span class="sidebar-text">Laporan Keuangan</span>
      </a>

  </nav>

  <!-- LOGOUT -->
  <div class="mt-auto pt-6">
      <button
        class="w-full flex items-center gap-3 px-3 py-2 rounded-xl
               bg-gray-100 hover:bg-gray-200 text-gray-600 transition">

        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
        </svg>

        <span class="sidebar-text font-medium">Logout</span>
      </button>
  </div>

</div>

<!-- TOGGLE SCRIPT -->
<script>
function toggleSidebar() {
    let sidebar = document.getElementById("sidebar");
    let texts = document.querySelectorAll(".sidebar-text");
    let label = document.getElementById("menu-label");
    let logo = document.getElementById("logo-full");

    sidebar.classList.toggle("w-64");
    sidebar.classList.toggle("w-20");

    texts.forEach(t => t.classList.toggle("hidden"));
    label.classList.toggle("hidden");
    logo.classList.toggle("hidden");

    if (window.parent !== window) {
      let frame = window.parent.document.getElementById("sidebarFrame");
      let main = window.parent.document.getElementById("mainContent");

      if (sidebar.classList.contains("w-20")) {
          frame.style.width = "80px";
          main.style.marginLeft = "80px";
          document.body.style.width = "80px";
      } else {
          frame.style.width = "256px";
          main.style.marginLeft = "256px";
          document.body.style.width = "256px";
      }
    }
}
document.addEventListener("DOMContentLoaded", function () {
    const currentPage = parent.location.pathname
        .split("/")
        .pop()
        .replace(".php", "");

    document.querySelectorAll(".menu-item").forEach(item => {
        if (item.dataset.page === currentPage) {
            item.classList.add("active-menu");
        }
    });
});
</script>

</body>
</html>