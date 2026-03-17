<nav class="flex items-center justify-between px-8 py-4 bg-white">
        <div class="flex items-center gap-1">
            <img src="{{ asset('img/logo1.png') }}" class="h-8 w-auto" alt="Logo Perusahaan">
        </div>
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
        <div class="flex items-center gap-4">
            
        </div>
    </nav>