<footer class="main-footer">
    <div class="container">
        <div class="row">
            <!-- About -->
            <div class="col-lg-4 col-md-6 mb-5">
                <h4 class="footer-title">PANGSIT CHILI OIL</h4>
                <p class="mb-4">Pangsit crispy dengan chili oil autentik yang bikin nagih. Dibuat dengan bahan-bahan pilihan dan resep turun temurun untuk rasa yang tak terlupakan.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-5">
                <h5 class="footer-title">Menu</h5>
                <div class="footer-links">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('front.products') }}">Produk</a>
                    <a href="{{ route('about') }}">Tentang Kami</a>
                    <a href="{{ route('contact') }}">Kontak</a>
                </div>
            </div>
            
            <!-- Categories -->
            <div class="col-lg-2 col-md-6 mb-5">
                <h5 class="footer-title">Kategori</h5>
                <div class="footer-links">
                    @php
                        $categories = \App\Models\Kategori::all();
                    @endphp
                    @foreach($categories as $category)
                    <a href="{{ route('front.products.category', $category->slug ?? $category->id) }}">
                        {{ $category->nama_kategori }}
                    </a>
                    @endforeach
                </div>
            </div>
            
            <!-- Contact -->
            <div class="col-lg-4 col-md-6 mb-5">
                <h5 class="footer-title">Hubungi Kami</h5>
                <div class="contact-info">
                    <p class="mb-3">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        Jl. Raya Contoh No. 123, Jakarta Selatan
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-phone me-2"></i>
                        {{ config('services.whatsapp.number') }}
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-envelope me-2"></i>
                        order@pangsitchilioil.com
                    </p>
                    <p class="mb-0">
                        <i class="fas fa-clock me-2"></i>
                        Buka: 09:00 - 21:00 WIB
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="copyright">
            <p class="mb-0">&copy; {{ date('Y') }} Pangsit Chili Oil. All rights reserved.</p>
        </div>
    </div>
</footer>