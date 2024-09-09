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
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    @notifyCss

    <!-- Include Styles -->
    <!-- $isFront is used to append the front layout styles only on the front layout otherwise the variable will be blank -->
    @include('layouts/sections/styles' . $isFront)

    <!-- Include Scripts for customizer, helper, analytics, config -->
    <!-- $isFront is used to append the front layout scriptsIncludes only on the front layout otherwise the variable will be blank -->
    @include('layouts/sections/scriptsIncludes' . $isFront)

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
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

    <script>
      // ajax setup
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    </script>

    @notifyJs

</body>

</html>
