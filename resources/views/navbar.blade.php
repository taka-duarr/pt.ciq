<nav class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur-md shadow-md">
    <div class="flex items-center justify-between px-6 md:px-8 py-4">
        
        <!-- Logo -->
        <div class="flex items-center gap-1">
            <img src="{{ asset('img/logo1.png') }}" class="h-8 w-auto" alt="Logo Perusahaan">
        </div>

        <!-- Menu Desktop -->
        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-700">
            <a href="{{ route('home') }}"
                class="relative hover:text-black transition
                after:content-[''] after:absolute after:left-0 after:-bottom-1
                after:h-[2px] after:w-full after:bg-[#005f37] after:rounded-full
                after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300">
                Beranda
            </a>

            <a href="{{ route('tentangKami') }}"
                class="relative hover:text-black transition
                after:content-[''] after:absolute after:left-0 after:-bottom-1
                after:h-[2px] after:w-full after:bg-[#005f37] after:rounded-full
                after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300">
                Tentang Kami
            </a>

            <a href="{{ route('katalogProduk') }}"
                class="relative hover:text-black transition
                after:content-[''] after:absolute after:left-0 after:-bottom-1
                after:h-[2px] after:w-full after:bg-[#005f37] after:rounded-full
                after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300">
                Produk
            </a>

            <a href="{{ route('csr') }}"
                class="relative hover:text-black transition
                after:content-[''] after:absolute after:left-0 after:-bottom-1
                after:h-[2px] after:w-full after:bg-[#005f37] after:rounded-full
                after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300">
                Program
            </a>

            <a href="{{ route('kontak') }}"
                class="relative hover:text-black transition
                after:content-[''] after:absolute after:left-0 after:-bottom-1
                after:h-[2px] after:w-full after:bg-[#005f37] after:rounded-full
                after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300">
                Kontak
            </a>
        </div>

        <!-- Burger Button Mobile -->
        <button id="menu-btn" class="md:hidden flex items-center justify-center w-10 h-10 rounded-lg hover:bg-gray-100 transition">
            <svg id="menu-icon" class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
        class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out md:hidden bg-white/95 backdrop-blur-md border-t border-gray-100">
        <div class="flex flex-col px-6 py-4 space-y-4 text-sm font-medium text-gray-700">
            <a href="{{ route('home') }}" class="hover:text-[var(--primary)] transition">Beranda</a>
            <a href="{{ route('tentangKami') }}" class="hover:text-[var(--primary)] transition">Tentang Kami</a>
            <a href="{{ route('katalogProduk') }}" class="hover:text-[var(--primary)] transition">Produk</a>
            <a href="{{ route('csr') }}" class="hover:text-[var(--primary)] transition">Program</a>
            <a href="{{ route('kontak') }}" class="hover:text-[var(--primary)] transition">Kontak</a>
        </div>
    </div>
</nav>
<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');

    let isOpen = false;

    menuBtn.addEventListener('click', () => {
        isOpen = !isOpen;

        if (isOpen) {
            mobileMenu.classList.remove('max-h-0');
            mobileMenu.classList.add('max-h-[500px]');
            menuIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            `;
        } else {
            mobileMenu.classList.remove('max-h-[500px]');
            mobileMenu.classList.add('max-h-0');
            menuIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            `;
        }
    });
</script>