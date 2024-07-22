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
    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Ooops", '{{ \Illuminate\Support\Facades\Session::get('failed') }}', "error")
        </script>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                title: 'Success',
                text: '{{ \Illuminate\Support\Facades\Session::get('success') }}',
                icon: 'success',
                timer: 700
            }).then(() => {
                window.location.href = '{{ route('customer.keranjang') }}';
            })
        </script>
    @endif
    <div class="sewaps">
        <div class="p-4">
            <p style="color: var(--dark); font-size: 1.5em; font-weight: bold">{{ $product->kategori->nama }}
                Unit {{ $product->nama }}</p>
            <div class="product-detail-container">
                <div class="product-detail-image-container">
                    <div class="image-container">
                        <img src="{{ $product->kategori->gambar }}" alt="product-image">
                    </div>
                </div>
                <div class="product-detail-info-container">
                    <p class="product-name">{{ $product->nama }}</p>
                    <div class="d-flex align-items-center selling-info mb-3">
                        <span class="me-2" style="font-size: 1.5em;">{{ $product->kategori->nama }}</span>
                    </div>
                    <p class="product-price mb-3">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                    <p style="color: var(--bg-primary); font-weight: bold; font-size: 1em;">Deskripsi</p>
                    <div class="description-wrapper">{!! $product->deskripsi !!}</div>
                </div>
                <div class="product-detail-action-container">
                    <p style="font-weight: bold; color: var(--dark); margin-bottom: 5px;">Ringkasan Sewa</p>
                    <hr class="custom-divider"/>
                    <form id="form-data" method="POST">
                        @csrf
                    </form>
                    @auth()
                        <button class="btn-cart" id="btn-cart" data-id="{{ $product->id }}"
                           style="height: fit-content; font-size: 1em;">Keranjang</button>
                    @else
                        <a href="{{ route('login') }}" class="btn-cart" style="height: fit-content; font-size: 1em;">Keranjang</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        function eventSave() {
            $('#btn-cart').on('click', function (e) {
                e.preventDefault();
                AlertConfirm('Konfirmasi!', 'Apakah anda yakin ingin menambah keranjang?', function () {
                    $('#form-data').submit();
                })
            });
        }

        $(document).ready(function () {
            eventSave();
        });
    </script>
@endsection
