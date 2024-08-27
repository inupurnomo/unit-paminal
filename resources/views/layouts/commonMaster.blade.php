<!DOCTYPE html>
@php
    $menuFixed = $configData['layout'] === 'vertical' ? $menuFixed ?? '' : ($configData['layout'] === 'front' ? '' : $configData['headerType']);
    $navbarType = $configData['layout'] === 'vertical' ? $configData['navbarType'] : ($configData['layout'] === 'front' ? 'layout-navbar-fixed' : '');
    $isFront = ($isFront ?? '') == true ? 'Front' : '';
    $contentLayout = isset($container) ? ($container === 'container-xxl' ? 'layout-compact' : 'layout-wide') : '';
@endphp

<html lang="{{ session()->get('locale') ?? app()->getLocale() }}"
    class="{{ $configData['style'] }}-style {{ $contentLayout ?? '' }} {{ $navbarType ?? '' }} {{ $menuFixed ?? '' }} {{ $menuCollapsed ?? '' }} {{ $menuFlipped ?? '' }} {{ $menuOffcanvas ?? '' }} {{ $footerFixed ?? '' }} {{ $customizerHidden ?? '' }}"
    dir="{{ $configData['textDirection'] }}" data-theme="{{ $configData['theme'] }}"
    data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{ url('/') }}" data-framework="laravel"
    data-template="{{ $configData['layout'] . '-menu-' . $configData['theme'] . '-' . $configData['style'] }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <meta name="description"
        content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
    <meta name="keywords"
        content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Canonical SEO -->
    <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    @notifyCss
    <style type="text/css"> .notify{ z-index: 1000000; margin-top: 45px; } </style>
    <style>
        .div_loader {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            z-index: 9000;
            background-color: rgba(109, 115, 119, 0.308);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hourglassBackground {
            position: relative;
            background-color: rgb(175, 94, 7);
            height: 130px;
            width: 130px;
            border-radius: 50%;
            margin: 30px auto;
        }

        .hourglassContainer {
            position: absolute;
            top: 30px;
            left: 40px;
            width: 50px;
            height: 70px;
            -webkit-animation: hourglassRotate 2s ease-in 0s infinite;
            animation: hourglassRotate 2s ease-in 0s infinite;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .hourglassContainer div,
        .hourglassContainer div:before,
        .hourglassContainer div:after {
            transform-style: preserve-3d;
        }

        @-webkit-keyframes hourglassRotate {
            0% {
                transform: rotateX(0deg);
            }

            50% {
                transform: rotateX(180deg);
            }

            100% {
                transform: rotateX(180deg);
            }
        }

        @keyframes hourglassRotate {
            0% {
                transform: rotateX(0deg);
            }

            50% {
                transform: rotateX(180deg);
            }

            100% {
                transform: rotateX(180deg);
            }
        }

        .hourglassCapTop {
            top: 0;
        }

        .hourglassCapTop:before {
            top: -25px;
        }

        .hourglassCapTop:after {
            top: -20px;
        }

        .hourglassCapBottom {
            bottom: 0;
        }

        .hourglassCapBottom:before {
            bottom: -25px;
        }

        .hourglassCapBottom:after {
            bottom: -20px;
        }

        .hourglassGlassTop {
            transform: rotateX(90deg);
            position: absolute;
            top: -16px;
            left: 3px;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            background-color: #999999;
        }

        .hourglassGlass {
            perspective: 100px;
            position: absolute;
            top: 32px;
            left: 20px;
            width: 10px;
            height: 6px;
            background-color: #999999;
            opacity: 0.5;
        }

        .hourglassGlass:before,
        .hourglassGlass:after {
            content: '';
            display: block;
            position: absolute;
            background-color: #999999;
            left: -17px;
            width: 44px;
            height: 28px;
        }

        .hourglassGlass:before {
            top: -27px;
            border-radius: 0 0 25px 25px;
        }

        .hourglassGlass:after {
            bottom: -27px;
            border-radius: 25px 25px 0 0;
        }

        .hourglassCurves:before,
        .hourglassCurves:after {
            content: '';
            display: block;
            position: absolute;
            top: 32px;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: #333;
            animation: hideCurves 2s ease-in 0s infinite;
        }

        .hourglassCurves:before {
            left: 15px;
        }

        .hourglassCurves:after {
            left: 29px;
        }

        @-webkit-keyframes hideCurves {
            0% {
                opacity: 1;
            }

            25% {
                opacity: 0;
            }

            30% {
                opacity: 0;
            }

            40% {
                opacity: 1;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes hideCurves {
            0% {
                opacity: 1;
            }

            25% {
                opacity: 0;
            }

            30% {
                opacity: 0;
            }

            40% {
                opacity: 1;
            }

            100% {
                opacity: 1;
            }
        }

        .hourglassSandStream:before {
            content: '';
            display: block;
            position: absolute;
            left: 24px;
            width: 3px;
            background-color: white;
            -webkit-animation: sandStream1 2s ease-in 0s infinite;
            animation: sandStream1 2s ease-in 0s infinite;
        }

        .hourglassSandStream:after {
            content: '';
            display: block;
            position: absolute;
            top: 36px;
            left: 19px;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 6px solid #fff;
            animation: sandStream2 2s ease-in 0s infinite;
        }

        @-webkit-keyframes sandStream1 {
            0% {
                height: 0;
                top: 35px;
            }

            50% {
                height: 0;
                top: 45px;
            }

            60% {
                height: 35px;
                top: 8px;
            }

            85% {
                height: 35px;
                top: 8px;
            }

            100% {
                height: 0;
                top: 8px;
            }
        }

        @keyframes sandStream1 {
            0% {
                height: 0;
                top: 35px;
            }

            50% {
                height: 0;
                top: 45px;
            }

            60% {
                height: 35px;
                top: 8px;
            }

            85% {
                height: 35px;
                top: 8px;
            }

            100% {
                height: 0;
                top: 8px;
            }
        }

        @-webkit-keyframes sandStream2 {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 0;
            }

            51% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            91% {
                opacity: 0;
            }

            100% {
                opacity: 0;
            }
        }

        @keyframes sandStream2 {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 0;
            }

            51% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            91% {
                opacity: 0;
            }

            100% {
                opacity: 0;
            }
        }

        .hourglassSand:before,
        .hourglassSand:after {
            content: '';
            display: block;
            position: absolute;
            left: 6px;
            background-color: white;
            perspective: 500px;
        }

        .hourglassSand:before {
            top: 8px;
            width: 39px;
            border-radius: 3px 3px 30px 30px;
            animation: sandFillup 2s ease-in 0s infinite;
        }

        .hourglassSand:after {
            border-radius: 30px 30px 3px 3px;
            animation: sandDeplete 2s ease-in 0s infinite;
        }

        @-webkit-keyframes sandFillup {
            0% {
                opacity: 0;
                height: 0;
            }

            60% {
                opacity: 1;
                height: 0;
            }

            100% {
                opacity: 1;
                height: 17px;
            }
        }

        @keyframes sandFillup {
            0% {
                opacity: 0;
                height: 0;
            }

            60% {
                opacity: 1;
                height: 0;
            }

            100% {
                opacity: 1;
                height: 17px;
            }
        }

        @-webkit-keyframes sandDeplete {
            0% {
                opacity: 0;
                top: 45px;
                height: 17px;
                width: 38px;
                left: 6px;
            }

            1% {
                opacity: 1;
                top: 45px;
                height: 17px;
                width: 38px;
                left: 6px;
            }

            24% {
                opacity: 1;
                top: 45px;
                height: 17px;
                width: 38px;
                left: 6px;
            }

            25% {
                opacity: 1;
                top: 41px;
                height: 17px;
                width: 38px;
                left: 6px;
            }

            50% {
                opacity: 1;
                top: 41px;
                height: 17px;
                width: 38px;
                left: 6px;
            }

            90% {
                opacity: 1;
                top: 41px;
                height: 0;
                width: 10px;
                left: 20px;
            }
        }

        @keyframes sandDeplete {
            0% {
                opacity: 0;
                top: 45px;
                height: 17px;
                width: 38px;
                left: 6px;
            }

            1% {
                opacity: 1;
                top: 45px;
                height: 17px;
                width: 38px;
                left: 6px;
            }

            24% {
                opacity: 1;
                top: 45px;
                height: 17px;
                width: 38px;
                left: 6px;
            }

            25% {
                opacity: 1;
                top: 41px;
                height: 17px;
                width: 38px;
                left: 6px;
            }

            50% {
                opacity: 1;
                top: 41px;
                height: 17px;
                width: 38px;
                left: 6px;
            }

            90% {
                opacity: 1;
                top: 41px;
                height: 0;
                width: 10px;
                left: 20px;
            }
        }
    </style>

    <!-- Include Styles -->
    <!-- $isFront is used to append the front layout styles only on the front layout otherwise the variable will be blank -->
    @include('layouts/sections/styles' . $isFront)

    <!-- Include Scripts for customizer, helper, analytics, config -->
    <!-- $isFront is used to append the front layout scriptsIncludes only on the front layout otherwise the variable will be blank -->
    @include('layouts/sections/scriptsIncludes' . $isFront)
</head>

<body>

    <div class="div_loader">
        <div class="hourglassBackground">
            <div class="hourglassContainer">
                <div class="hourglassCurves"></div>
                <div class="hourglassCapTop"></div>
                <div class="hourglassGlassTop"></div>
                <div class="hourglassSand"></div>
                <div class="hourglassSandStream"></div>
                <div class="hourglassCapBottom"></div>
                <div class="hourglassGlass"></div>
            </div>
        </div>
    </div>

    @include('notify::components.notify')

    <!-- Layout Content -->
    @yield('layoutContent')
    <!--/ Layout Content -->


    <div class="modal fade" id="modal_dokumen" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h4 class="modal-title" id="exampleModalLabel4">Modal title</h4> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="body_dokumen">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Include Scripts -->
    <!-- $isFront is used to append the front layout scripts only on the front layout otherwise the variable will be blank -->
    @include('layouts/sections/scripts' . $isFront)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
    <script src="{{ asset('assets/js/pdfviewer.jquery.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".div_loader").hide()
        })

        function open_modal_dokumen(url) {
            console.log(url)
            $('#body_dokumen').empty()
            $('#body_dokumen').pdfViewer(url);
            $('#modal_dokumen').modal('show');
        }
    </script>

    @notifyJs

</body>

</html>
