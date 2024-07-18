@extends('base')

@section('morecss')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"
            integrity="sha256-FZsW7H2V5X9TGinSjjwYJ419Xka27I8XPDmWryGlWtw=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"
          integrity="sha256-5uKiXEwbaQh9cgd2/5Vp6WmMnsUr3VZZw0a8rKnOKNU=" crossorigin="anonymous">
@endsection

@section('content')
    <div class="g-hero">
        <img src="{{ asset('images/local/hero-image.webp') }}"/>
    </div>

{{--    <div class="g-info">--}}
{{--        <div class="info container ">--}}
{{--            <span class="score tahun-pengalaman">0</span>--}}
{{--            <div class="d-flex flex-column ">--}}
{{--                <span class="definition">Tahun </span>--}}
{{--                <span class="definition">Pengalaman </span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="line"></div>--}}
{{--        <div class="info container ">--}}
{{--            <span class="score  titikstrategis">0</span>--}}
{{--            <div class="d-flex flex-column ">--}}
{{--                <span class="definition">Unit </span>--}}
{{--                <span class="definition">Tersewa </span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="line"></div>--}}
{{--        <div class="info container ">--}}
{{--            <span class="score happycustomer">0</span>--}}
{{--            <div class="d-flex flex-column ">--}}
{{--                <span class="definition">Happy</span>--}}
{{--                <span class="definition">Customer </span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="line"></div>--}}
{{--        <div class="info container ">--}}
{{--            <span class="score overalrating">0</span>--}}
{{--            <div class="d-flex flex-column ">--}}
{{--                <span class="definition">Overal</span>--}}
{{--                <span class="definition">Rating </span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="mb-5"></div>
    <div class="g-container-left">
        <div class="content">
            <p id="unitkami" class="title">Unit yang Tersedia</p>
        </div>
        <div class="d-flex gap-4">
            @foreach($categories as $category)
                <a class="card-unit" href="/sewaps">
                    <img
                        src="{{ asset($category->gambar) }}"/>
                    <div class="content">
                        <p class="mb-0 fw-bold">{{ $category->nama }}</p>
                        <p class="mb-0">Tersedia: {{ $category->count_product }} Unit</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>







    <div class="mb-5"></div>
    {{-- PORTFOLIO --}}



    {{-- ONE WEEK SERVICES --}}
    <div class="oneweek-services">
        <img src={{ asset('images/local/calendar.png') }} />
        <div>
            <p class="title">Sewa Lebih Lama Lebih Untung</p>
            <p class="text">Dapatkan diskon lebih banyak dengan menyewa Playstation kami dalam jangka waktu yang
                lama.</p>
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
    <script type="text/javascript">
        window.onload = function () {
            var itemWidth = window.innerWidth < 820 ? 110 : 210;

            var wookmark1 = new Wookmark("#wookmark1", {
                outerOffset: 10, // Optional, the distance to the containers border
                itemWidth: itemWidth, // Optional, the width of a grid item
            });
        };

        // Opsional: Mendengarkan perubahan ukuran jendela untuk mengatur ulang lebar item
        window.addEventListener('resize', function () {
            var newWidth = window.innerWidth < 820 ? 110 : 210;
            if (newWidth !== itemWidth) {
                itemWidth = newWidth;
                wookmark1.updateOptions({
                    itemWidth: itemWidth
                });
            }
        });
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
        document.addEventListener('DOMContentLoaded', (event) => {
            // Fungsi animateValue seperti sebelumnya
            function animateValue(obj, start, end, duration, suffix = '') {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    const value = Math.floor(progress * (end - start) + start);
                    obj.innerHTML = (value >= 1000 ? Math.floor(value / 1000) + 'K' : value) + (progress === 1 ?
                        suffix : ''); // Mengonversi nilai ke format K ketika lebih dari atau sama dengan 1000
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }

            // Fungsi observer untuk menjalankan animasi
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {

                        const tahunPengalamanElement = document.querySelector('.tahun-pengalaman');
                        if (tahunPengalamanElement) {
                            animateValue(tahunPengalamanElement, 0, 5, 1000); // Durasi 500ms
                        }

                        const titikstrategisElement = document.querySelector('.titikstrategis');
                        if (titikstrategisElement) {
                            animateValue(titikstrategisElement, 0, 2000,
                                1000, '+'); // Durasi 1000ms, dari 0 ke 2000
                        }

                        const happycustomerElement = document.querySelector('.happycustomer');
                        if (happycustomerElement) {
                            animateValue(happycustomerElement, 0, 8000, 1000, '+'); // Durasi 500ms
                        }

                        const overalratingElement = document.querySelector('.overalrating');
                        if (overalratingElement) {
                            animateValue(overalratingElement, 0, 4, 1000, ',6'); // Durasi 500ms
                        }

                        observer.unobserve(target); // Stop observing target after animation
                    }
                });
            }, {
                threshold: 0.1 // Trigger when 10% of the element is in the viewport
            });

            // Menambahkan elemen yang ingin di-observe
            document.querySelectorAll('.score').forEach((elem) => {
                observer.observe(elem);
            });
        });

        document.addEventListener("scroll", function () {
            var scrolledHeight = window.pageYOffset;
            var parallaxElement = document.querySelector('.oneweek-services'),
                limit = parallaxElement.offsetTop + parallaxElement.offsetHeight;
            if (scrolledHeight > parallaxElement.offsetTop && scrolledHeight <= limit) {
                parallaxElement.style.backgroundPositionY = (scrolledHeight - parallaxElement.offsetTop) / 2 + "px";
            } else {
                parallaxElement.style.backgroundPositionY = "0";
            }
        });
    </script>
@endsection
