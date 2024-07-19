@extends('customer.base')

@section('morecss')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"
            integrity="sha256-FZsW7H2V5X9TGinSjjwYJ419Xka27I8XPDmWryGlWtw=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"
          integrity="sha256-5uKiXEwbaQh9cgd2/5Vp6WmMnsUr3VZZw0a8rKnOKNU=" crossorigin="anonymous">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.member.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="sewaps">
        <div class="p-4">
            <p style="color: var(--dark); font-size: 1.5em; font-weight: bold">Pilihan Unit {{ $category->nama }}</p>
            <div class="product-container mb-3">
                @foreach($products as $product)
                    <div class="card-product" data-id="{{ $product->id }}">
                        <div class="image-container">
                            <img src="{{ $category->gambar }}" alt="img-product">
                        </div>
                        <div class="product-info w-100">
                            <p class="product-name"
                               style="height: fit-content; margin-bottom: 0; color: var(--dark-tint); line-height: 1">{{ $product->nama }}</p>
                            <p class="product-name"
                               style="margin-bottom: 0; height: fit-content; font-size: 1em; line-height: 1">{{ $category->nama }}</p>
                            <p class="product-name"
                               style="margin-bottom: 0; height: fit-content; font-size: 0.8em; font-weight: 500; color: var(--dark-tint); line-height: 1">{{ $product->deskripsi }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="product-price" style="font-size: 1.25em;">
                                    Rp.{{ number_format($product->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="product-action">
                            <a href="{{ route('customer.product.detail', ['id' => $category->id, 'product_id' => $product->id]) }}" class="btn-shop" data-id="{{ $product->id }}">
                                <span class="material-symbols-outlined" style="font-size: 0.8em;">
                                    arrow_forward
                                </span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-4">--}}
{{--                <img--}}
{{--                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1c/PS2-Versions.jpg/1200px-PS2-Versions.jpg"--}}
{{--                    class="img-fluid" alt="Gambar" style="width: 100%;">--}}
{{--            </div>--}}
{{--            <div class="col-md-4">--}}
{{--                <div class="form-container p-4">--}}
{{--                    <div class="mb-3">--}}
{{--                        <label for="nomorseri" class="form-label">Nomor Seri</label>--}}
{{--                        <input type="text" class="form-control" readonly id="nomorseri" name="nomorseri" required>--}}
{{--                    </div>--}}
{{--                    <div class="mb-3">--}}
{{--                        <label for="keterangan" class="form-label">Keterangan</label>--}}
{{--                        <input type="text" class="form-control" readonly id="keterangan" name="keterangan" required>--}}
{{--                    </div>--}}

{{--                    <h2 class="mb-2">Tolong Isi data dengan benar</h2>--}}
{{--                    <form id="sewaForm">--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="nama" class="form-label">Nama</label>--}}
{{--                            <input type="text" class="form-control" id="nama" name="nama" required>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="alamat" class="form-label">Alamat</label>--}}
{{--                            <input type="text" class="form-control" id="alamat" name="alamat" required>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="nomorTelepon" class="form-label">Nomor Telepon</label>--}}
{{--                            <input type="tel" class="form-control" id="nomorTelepon" name="nomorTelepon" required>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="sewaHari" class="form-label">Sewa (Berapa Hari)</label>--}}
{{--                            <div class="d-flex align-items-end gap-2">--}}
{{--                                <input type="number" class="form-control" id="sewaHari" name="sewaHari" required>--}}
{{--                                <a class="fw-bold ml-2">Hari</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <hr>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="rincianHarga" class="form-label">Rincian Harga Sewa</label>--}}
{{--                            <p>Sewa ps 2 perhari 100.000 x <span id="hari"></span> hari</p>--}}
{{--                            <p id="rincianHarga">Rp 0</p>--}}
{{--                        </div>--}}
{{--                        <a href="/bayar" style="width: 250px" class="d-flex btn btn-primary p-4">Sewa Sekarang</a>--}}

{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}



    <div class="mb-5"></div>
    {{-- PORTFOLIO --}}



    {{-- ONE WEEK SERVICES --}}
{{--    <div class="oneweek-services">--}}
{{--        <img src={{ asset('images/local/calendar.png') }} />--}}
{{--        <div>--}}
{{--            <p class="title">Sewa Lebih Lama Lebih Untung</p>--}}
{{--            <p class="text">Dapatkan diskon lebih banyak dengan menyewa Playstation kami dalam jangka waktu yang--}}
{{--                lama.</p>--}}
{{--            <a class="btn-pasangiklan"--}}
{{--               href="https://api.whatsapp.com/send?phone={{ preg_replace('/^0/', '62', '01578978454') }}&text=Halo%2C%20saya%20mau%20konsultasi%20periklanan%20billboard"--}}
{{--               target="_blank">--}}
{{--                Sewa Sekarang--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
    </div>
@endsection

@section('morejs')
    <script>
        var splide = new Splide('.splide', {
            classes: {
                arrows: 'splide__arrows your-class-arrows',
                arrow: 'splide__arrow your-class-arrow',
                prev: 'splide__arrow--prev your-class-prev',
                next: 'splide__arrow--next your-class-next',
            },
            breakpoints: {
                1366: {
                    perPage: 3,

                },
                1024: {
                    perPage: 2,

                },
                767: {
                    perPage: 1,

                },

            },
            type: 'loop',
            perPage: 4,
            perMove: 1,
            prevArrow: $('#prev'),
            nextArrow: $('#next'),
            pagination: false,
        });

        splide.mount();
    </script>


    <script>
        var slideUp = {
            distance: '50%',
            origin: 'bottom',
            delay: 300,
        };
        document.addEventListener('DOMContentLoaded', function () {
            ScrollReveal().reveal('.g-hero', slideUp);
            ScrollReveal().reveal('.g-info', slideUp);
            ScrollReveal().reveal('.g-container-left', slideUp);
            ScrollReveal().reveal('.g-container-clients', slideUp);
            ScrollReveal().reveal('.g-container-testimoni', slideUp);
            ScrollReveal().reveal('.g-portfolio', slideUp);
            ScrollReveal().reveal('.oneweek-services', slideUp);
            // Tambahkan lebih banyak elemen sesuai kebutuhan
        });
    </script>

    <script>
        document.getElementById('sewaHari').addEventListener('input', function () {
            const hargaPerHari = 100000; // Contoh harga per hari
            const hari = this.value;
            const totalHarga = hargaPerHari * hari;
            document.getElementById('rincianHarga').textContent = `Rp ${totalHarga.toLocaleString()}`;
            document.getElementById('hari').textContent = hari;
        });
    </script>
@endsection
