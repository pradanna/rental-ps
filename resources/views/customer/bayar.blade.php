@extends('customer.base')

@section('morecss')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"
        integrity="sha256-FZsW7H2V5X9TGinSjjwYJ419Xka27I8XPDmWryGlWtw=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"
        integrity="sha256-5uKiXEwbaQh9cgd2/5Vp6WmMnsUr3VZZw0a8rKnOKNU=" crossorigin="anonymous">
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="rekap-container p-4 mb-4">
                    <h5>Rekap Data</h5>
                    <p><strong>Nama:</strong> <span id="rekapNama"></span></p>
                    <p><strong>Alamat:</strong> <span id="rekapAlamat"></span></p>
                    <p><strong>Nomor Telepon:</strong> <span id="rekapNomorTelepon"></span></p>
                    <p><strong>Hari Sewa:</strong> <span id="rekapHariSewa"></span></p>
                    <p><strong>Total Harga:</strong> <span id="rekapTotalHarga"></span></p>
                    <div class="alert alert-danger mt-3" role="alert">
                        <strong>Pastikan untuk memeriksa kembali data Anda, jika sudah benar maka silahkan upload bukti
                            transfer dengan rekening di samping.</strong>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-container p-4 mb-4">
                    <h5>Data Bank dan Rekening</h5>
                    <p><strong>Bank BCA:</strong> 1234567890</p>
                    <p><strong>Bank BNI:</strong> 0987654321</p>
                    <p><strong>Bank BRI:</strong> 1122334455</p>
                    <form id="uploadForm">
                        <div class="mb-3">
                            <label for="uploadBukti" class="form-label">Upload Bukti Transfer</label>
                            <input type="file" class="form-control" id="uploadBukti" name="uploadBukti" required>
                        </div>
                        <button type="submit" class="btn btn-success">Upload Bukti Transfer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ONE WEEK SERVICES --}}
    <div class="oneweek-services">
        <img src={{ asset('images/local/calendar.png') }} />
        <div>
            <p class="title">Sewa Lebih Lama Lebih Untung</p>
            <p class="text">Dapatkan diskon lebih banyak dengan menyewa Playstation kami dalam jangka waktu yang lama.</p>
            <a class="btn-pasangiklan"
                href="https://api.whatsapp.com/send?phone={{ preg_replace('/^0/', '62', '01578978454') }}&text=Halo%2C%20saya%20mau%20konsultasi%20periklanan%20billboard"
                target="_blank">
                Sewa Sekarang
            </a>
        </div>
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
        document.addEventListener('DOMContentLoaded', function() {
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
        document.getElementById('sewaHari').addEventListener('input', function() {
            const hargaPerHari = 100000; // Contoh harga per hari
            const hari = this.value;
            const totalHarga = hargaPerHari * hari;
            document.getElementById('rincianHarga').textContent = `Rp ${totalHarga.toLocaleString()}`;
            document.getElementById('hari').textContent = hari;
        });
    </script>
@endsection
