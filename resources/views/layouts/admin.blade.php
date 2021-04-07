<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }} {{ Metronic::printClasses('html') }}>
    <head>
        <meta charset="utf-8"/>

        {{-- Title Section --}}
        <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

        {{-- Meta Data --}}
        <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />

        {{-- Fonts --}}
        {{ Metronic::getGoogleFontsInclude() }}

        {{-- Global Theme Styles (used by all pages) --}}
        @foreach(config('layout.resources.css') as $style)
            <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach

        {{-- Layout Themes (used by all pages) --}}
        @foreach (Metronic::initThemes() as $theme)
            <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css"/>
        @endforeach

        {{-- Includable CSS --}}
        @yield('styles')
    </head>

    <body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>

        @if (config('layout.page-loader.type') != '')
            @include('admin.layouts.partials._page-loader')
        @endif

        @include('admin.layouts.base._layout')

        {{-- <script>var HOST_URL = "{{ route('quick-search') }}";</script> --}}

        {{-- Global Config (global config for global JS scripts) --}}
        <script>
            var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
        </script>

        {{-- Global Theme JS Bundle (used by all pages)  --}}
        @foreach(config('layout.resources.js') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        {{-- Includable JS --}}
        @yield('scripts')
        <script type="text/javascript" src="{{asset('js/pages/index.js')}}"></script>
        <script>
            document.getElementById('btnLogout').addEventListener('click', function(){
                document.getElementById('logout-form').submit()
            });
            $(document).ready(function(){
                $('.general_parameter').find('form').each(function(index,element){
                    $(element).find('button[type="submit"]').on('click',function(event){
                        if(!$(this).closest('form').attr('enctype')){
                            event.preventDefault();
                            let url = $(this).closest('form').attr('action');
                            let form = $(this).closest('form');
                            $.ajax({
                                data: form.serialize(),
                                url: url,
                                type: 'POST',
                                success: function(response){
                                    console.log('data',response)
                                },
                                error: function(er,mess){
                                    console.log('errro',er)
                                }
                            })
                        }
                    })
                })
            })
        </script>

    </body>
</html>