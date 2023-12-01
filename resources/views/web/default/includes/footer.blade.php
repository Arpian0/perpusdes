@php

    $socials = getSocials();

    if (!empty($socials) and count($socials)) {

        $socials = collect($socials)->sortBy('order')->toArray();

    }



    $footerColumns = getFooterColumns();

@endphp



<footer class="footer bg-secondary position-relative user-select-none mt-40">

    <div class="container">

        <div class="row">

            <div class="col-12">

            </div>

        </div>

    </div>



    @php

        $columns = ['first_column','second_column','forth_column'];

    @endphp

    <!-- $columns = ['first_column','second_column','third_column','forth_column']; -->


    <div class="container mt-20">

        <div class="row">



            @foreach($columns as $column)

                <div class="col-12 col-md-4">

                    @if(!empty($footerColumns[$column]))

                        @if(!empty($footerColumns[$column]['title']))

                            <span class="header d-block text-white font-weight-bold">{{ $footerColumns[$column]['title'] }}</span>

                        @endif



                        @if(!empty($footerColumns[$column]['value']))

                            <div class="mt-20">

                                {!! $footerColumns[$column]['value'] !!}

                            </div>

                        @endif

                    @endif

                </div>

            @endforeach



        </div>

    </div>



    <div class="col-12 bg-white">



        <div class="container mt-40 py-25 d-flex align-items-center justify-content-between">

            <div class="footer-logo" style="width:200px;height:inherit;">

                <a href="/">

                    @if(!empty($generalSettings['footer_logo']))

                        <img src="{{ $generalSettings['footer_logo'] }}" class="img-cover" alt="footer logo">

                    @endif

                </a>

            </div>

            <div class="footer-social p-10 pl-25 rounded-pill" style="background: #043730">

                @if(!empty($socials) and count($socials))

                    @foreach($socials as $social)

                        <a href="{{ $social['link'] }}">

                            <img src="{{ $social['image'] }}" alt="{{ $social['title'] }}" class="mr-15">

                        </a>

                    @endforeach

                @endif

            </div>

        </div>

    </div>



    @if(getOthersPersonalizationSettings('platform_phone_and_email_position') == 'footer')

        <div class="footer-copyright-card">

            <div class="container d-flex align-items-center justify-content-between py-15">

                <div class="font-14 text-white">{{ trans('update.platform_copyright_hint') }}</div>



                <div class="d-flex align-items-center justify-content-center">

                    @if(!empty($generalSettings['site_phone']))

                        <div class="d-flex align-items-center text-white font-14">

                            <i data-feather="phone" width="20" height="20" class="mr-10"></i>

                            {{ $generalSettings['site_phone'] }}

                        </div>

                    @endif



                    @if(!empty($generalSettings['site_email']))

                        <div class="border-left mx-5 mx-lg-15 h-100"></div>



                        <div class="d-flex align-items-center text-white font-14">

                            <i data-feather="mail" width="20" height="20" class="mr-10"></i>

                            {{ $generalSettings['site_email'] }}

                        </div>

                    @endif

                </div>

            </div>

        </div>

    @endif



</footer>

