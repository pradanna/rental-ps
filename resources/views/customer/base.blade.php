<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Rental PS || Rental PSan</title>

@yield('header')


<!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <script src="https://unpkg.com/scrollreveal"></script>
    {{-- BOOTSTRAP --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- CSS --}}
    <link href="{{ asset('css/genosstyle.v.01.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet"/>

    {{-- FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Thambi+2:wght@400;500;700;800&display=swap"
          rel="stylesheet">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>


    {{-- DATA TABLES --}}
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css"/>


    {{-- ICON --}}


    {{-- SWEEET ALERT --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css"
          integrity="sha256-h2Gkn+H33lnKlQTNntQyLXMWq7/9XI2rlPCsLsVcUBs=" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <!-- Styles -->
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js') }}"></script>
    @yield('morecss')

</head>

<body>
<nav class="g-navbar container nav-website">
    <img src="{{ asset('images/local/logo.png') }}"/>
    <div class="g-nav-menu">
        <a class="menu {{ Request::is('/') ? 'active' : '' }}" href="/">Home<span
                class="indicator "></span></a>
        <a class="menu {{ Request::is('services*') ? 'active' : '' }}" href="#unitkami">Unit PS Kami<span
                class="indicator "></span></a>

        <a class="menu {{ Request::is('contact*') ? 'active' : '' }}" href="#footer">Contact<span
                class="indicator"></span></a>
    </div>
    <div class="g-nav-social">
        @auth()
            <a href="{{ route('customer.keranjang') }}">
                <span class="material-symbols-outlined" style="color: var(--dark); font-size: 0.8em;">
                    local_mall
                </span>
            </a>
            <a href="#">
                <span class="material-symbols-outlined" style="color: var(--dark); font-size: 0.8em;">
                    person
                </span>
            </a>
        @else
            <a href="{{ route('login') }}">
                <span class="material-symbols-outlined" style="color: var(--dark); font-size: 0.8em;">
                    person
                </span>
            </a>
        @endauth

        {{--            <a href="#" target="_blank">--}}
        {{--                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"--}}
        {{--                    stroke-width="1.5" width="20" height="20">--}}
        {{--                    <defs>--}}
        {{--                        <style>--}}
        {{--                            .cls-637b8512f95e86b59c57a11c-1 {--}}
        {{--                                fill: none;--}}
        {{--                                stroke: currentColor;--}}
        {{--                                stroke-miterlimit: 10;--}}
        {{--                            }--}}

        {{--                            .cls-637b8512f95e86b59c57a11c-2 {--}}
        {{--                                fill: currentColor;--}}
        {{--                            }--}}
        {{--                        </style>--}}
        {{--                    </defs>--}}
        {{--                    <rect class="cls-637b8512f95e86b59c57a11c-1" x="1.5" y="1.5" width="21" height="21"--}}
        {{--                        rx="3.82"></rect>--}}
        {{--                    <circle class="cls-637b8512f95e86b59c57a11c-1" cx="12" cy="12" r="4.77"></circle>--}}
        {{--                    <circle class="cls-637b8512f95e86b59c57a11c-2" cx="18.2" cy="5.8" r="1.43"></circle>--}}
        {{--                </svg>--}}
        {{--            </a>--}}
        {{--            <a href="#" target="_blank">--}}
        {{--                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"--}}
        {{--                    stroke-width="1.5" width="20" height="20">--}}
        {{--                    <defs>--}}
        {{--                        <style>--}}
        {{--                            .cls-637b8512f95e86b59c57a116-1 {--}}
        {{--                                fill: none;--}}
        {{--                                stroke: currentColor;--}}
        {{--                                stroke-miterlimit: 10;--}}
        {{--                            }--}}
        {{--                        </style>--}}
        {{--                    </defs>--}}
        {{--                    <path class="cls-637b8512f95e86b59c57a116-1"--}}
        {{--                        d="M17.73,6.27V1.5h-1A7.64,7.64,0,0,0,9.14,9.14v.95H6.27v3.82H9.14V22.5h4.77V13.91h2.86V10.09H13.91V9.14a2.86,2.86,0,0,1,2.86-2.87Z">--}}
        {{--                    </path>--}}
        {{--                </svg></a>--}}
        {{--            <a href="#" target="_blank">--}}
        {{--                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"--}}
        {{--                    stroke-width="1.5" width="20" height="20">--}}
        {{--                    <defs>--}}
        {{--                        <style>--}}
        {{--                            .cls-637b8512f95e86b59c57a137-1 {--}}
        {{--                                fill: none;--}}
        {{--                                stroke: currentColor;--}}
        {{--                                stroke-miterlimit: 10;--}}
        {{--                            }--}}
        {{--                        </style>--}}
        {{--                    </defs>--}}
        {{--                    <path class="cls-637b8512f95e86b59c57a137-1"--}}
        {{--                        d="M12.94,1.61V15.78a2.83,2.83,0,0,1-2.83,2.83h0a2.83,2.83,0,0,1-2.83-2.83h0a2.84,2.84,0,0,1,2.83-2.84h0V9.17h0A6.61,6.61,0,0,0,3.5,15.78h0a6.61,6.61,0,0,0,6.61,6.61h0a6.61,6.61,0,0,0,6.61-6.61V9.17l.2.1a8.08,8.08,0,0,0,3.58.84h0V6.33l-.11,0a4.84,4.84,0,0,1-3.67-4.7H12.94Z">--}}
        {{--                    </path>--}}
        {{--                </svg>--}}
        {{--            </a>--}}
    </div>

</nav>

<nav class="g-navbar  nav-mobile">
    <img src="{{ asset('images/local/logo.png') }}"/>

    <a class="" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <img class="iconmenu" src="{{ asset('images/local/icon/menu.svg') }}"/>
    </a>

    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

        <li><a class="dropdown-item menu {{ Request::is('/') ? 'active' : '' }}" href="/">Home<span
                    class="indicator "></span></a></li>
        <li><a class="dropdown-item menu {{ Request::is('services') ? 'active' : '' }}" href="#unitkami">Unit PS
                kami<span class="indicator "></span></a></li>


        <li><a class="dropdown-item menu {{ Request::is('contact') ? 'active' : '' }}" href="#footer">Contact<span
                    class="indicator"></span></a></li>
        <hr/>
        <li style="padding-left: 10px">
            <div class="g-nav-social">

                <a>
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" stroke-width="1.5" width="20" height="20">
                        <defs>
                            <style>
                                .cls-637b8512f95e86b59c57a11c-1 {
                                    fill: none;
                                    stroke: currentColor;
                                    stroke-miterlimit: 10;
                                }

                                .cls-637b8512f95e86b59c57a11c-2 {
                                    fill: currentColor;
                                }
                            </style>
                        </defs>
                        <rect class="cls-637b8512f95e86b59c57a11c-1" x="1.5" y="1.5" width="21"
                              height="21" rx="3.82"></rect>
                        <circle class="cls-637b8512f95e86b59c57a11c-1" cx="12" cy="12" r="4.77">
                        </circle>
                        <circle class="cls-637b8512f95e86b59c57a11c-2" cx="18.2" cy="5.8" r="1.43">
                        </circle>
                    </svg>
                </a>
                <a>
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" stroke-width="1.5" width="20" height="20">
                        <defs>
                            <style>
                                .cls-637b8512f95e86b59c57a116-1 {
                                    fill: none;
                                    stroke: currentColor;
                                    stroke-miterlimit: 10;
                                }
                            </style>
                        </defs>
                        <path class="cls-637b8512f95e86b59c57a116-1"
                              d="M17.73,6.27V1.5h-1A7.64,7.64,0,0,0,9.14,9.14v.95H6.27v3.82H9.14V22.5h4.77V13.91h2.86V10.09H13.91V9.14a2.86,2.86,0,0,1,2.86-2.87Z">
                        </path>
                    </svg>
                </a>
                <a>
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" stroke-width="1.5" width="20" height="20">
                        <defs>
                            <style>
                                .cls-637b8512f95e86b59c57a137-1 {
                                    fill: none;
                                    stroke: currentColor;
                                    stroke-miterlimit: 10;
                                }
                            </style>

                        </defs>
                        <path class="cls-637b8512f95e86b59c57a137-1"
                              d="M12.94,1.61V15.78a2.83,2.83,0,0,1-2.83,2.83h0a2.83,2.83,0,0,1-2.83-2.83h0a2.84,2.84,0,0,1,2.83-2.84h0V9.17h0A6.61,6.61,0,0,0,3.5,15.78h0a6.61,6.61,0,0,0,6.61,6.61h0a6.61,6.61,0,0,0,6.61-6.61V9.17l.2.1a8.08,8.08,0,0,0,3.58.84h0V6.33l-.11,0a4.84,4.84,0,0,1-3.67-4.7H12.94Z">
                        </path>
                    </svg>
                </a>
            </div>
        </li>
    </ul>
</nav>

@yield('content')


<footer class="footer" id="footer">
    <div class="row gx-3 ">
        <div class="col-lg-4 col-sm-12 ">
            <img class="footer-logo" src="{{ asset('images/local/logo.png') }}"/>

            <p class="footer-tag">Jasa sewa playsation di Solo</p>
        </div>
        <div class="col-lg-4 col-sm-12">
            <p class="header">Contact Us</p>
            <p class="text"><span><img class="icon-text"
                                       src="{{ asset('images/local/icon/home-address.png') }}"/></span> jl. jl men
            </p>
            <p class="text"><span><img class="icon-text"
                                       src="{{ asset('images/local/icon/phone.png') }}"/></span>089755874511</p>
            <p class="text"><span><img class="icon-text"
                                       src="{{ asset('images/local/icon/whatsapp.png') }}"/></span><a class="d-block"
                                                                                                      style="color: grey;"
                                                                                                      href="https://api.whatsapp.com/send?phone={{ preg_replace('/^0/', '62', '089755874511') }}&text=Halo%2C%20saya%20mau%20tanya%20tentang%20pasang%20billboard"
                                                                                                      target="_blank">
                    {{ preg_replace('/^0/', '62', '089755874511') }}</a>
            </p>
            <p class="text"><span><img class="icon-text"
                                       src="{{ asset('images/local/icon/email.png') }}"/></span> rental ps
            </p>
        </div>

        <div class="col-lg-4 col-sm-12">
            <p class="header">Social Media</p>
            <div class="g-nav-social d-flex ">
                <a href="#" target="_blank">
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" stroke-width="1.5" width="20" height="20">
                        <defs>
                            <style>
                                .cls-637b8512f95e86b59c57a11c-1 {
                                    fill: none;
                                    stroke: currentColor;
                                    stroke-miterlimit: 10;
                                }

                                .cls-637b8512f95e86b59c57a11c-2 {
                                    fill: currentColor;
                                }
                            </style>
                        </defs>
                        <rect class="cls-637b8512f95e86b59c57a11c-1" x="1.5" y="1.5" width="21"
                              height="21" rx="3.82"></rect>
                        <circle class="cls-637b8512f95e86b59c57a11c-1" cx="12" cy="12" r="4.77">
                        </circle>
                        <circle class="cls-637b8512f95e86b59c57a11c-2" cx="18.2" cy="5.8" r="1.43">
                        </circle>
                    </svg>
                </a>
                <a href="#" target="_blank">
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" stroke-width="1.5" width="20" height="20">
                        <defs>
                            <style>
                                .cls-637b8512f95e86b59c57a116-1 {
                                    fill: none;
                                    stroke: currentColor;
                                    stroke-miterlimit: 10;
                                }
                            </style>
                        </defs>
                        <path class="cls-637b8512f95e86b59c57a116-1"
                              d="M17.73,6.27V1.5h-1A7.64,7.64,0,0,0,9.14,9.14v.95H6.27v3.82H9.14V22.5h4.77V13.91h2.86V10.09H13.91V9.14a2.86,2.86,0,0,1,2.86-2.87Z">
                        </path>
                    </svg>
                </a>
                <a href="#" target="_blank">
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" stroke-width="1.5" width="20" height="20">
                        <defs>
                            <style>
                                .cls-637b8512f95e86b59c57a137-1 {
                                    fill: none;
                                    stroke: currentColor;
                                    stroke-miterlimit: 10;
                                }
                            </style>
                        </defs>
                        <path class="cls-637b8512f95e86b59c57a137-1"
                              d="M12.94,1.61V15.78a2.83,2.83,0,0,1-2.83,2.83h0a2.83,2.83,0,0,1-2.83-2.83h0a2.84,2.84,0,0,1,2.83-2.84h0V9.17h0A6.61,6.61,0,0,0,3.5,15.78h0a6.61,6.61,0,0,0,6.61,6.61h0a6.61,6.61,0,0,0,6.61-6.61V9.17l.2.1a8.08,8.08,0,0,0,3.58.84h0V6.33l-.11,0a4.84,4.84,0,0,1-3.67-4.7H12.94Z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>

    </div>
    <hr>
    <div class="d-flex justify-content-between  ">
        <p>
            © 2024 Rental PS, All Rights Reserved
        </p>


    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="{{ asset('js/wookmark.js') }}"></script>

<script>
    $(document).ready(function () {
        $('a[href^="#"]').on('click', function (event) {
            var target = $(this.getAttribute('href'));
            if (target.length) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top
                }, 100);
            }
        });
    });
</script>
@yield('morejs')
</body>

</html>
