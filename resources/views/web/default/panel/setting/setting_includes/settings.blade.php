@push('styles_top')
    <!-- <link rel="stylesheet" href="/assets/vendors/leaflet/leaflet.css"> -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
@endpush

<section class="mt-30">
    <h2 class="section-title after-line">{{ trans('update.settings') }}</h2>

    <div class="row mt-20">
        <div class="col-12 col-lg-4">

            <div class="form-group mb-30 mt-30">
                <label class="input-label">{{ trans('update.gender') }}:</label>

                <div class="d-flex align-items-center">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="gender" value="man" {{ (!empty($user->gender) and $user->gender == 'man') ? 'checked="checked"' : ''}} id="man" class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="man">{{ trans('update.man') }}</label>
                    </div>

                    <div class="custom-control custom-radio ml-15">
                        <input type="radio" name="gender" value="woman" id="woman" {{ (!empty($user->gender) and $user->gender == 'woman') ? 'checked="checked"' : ''}} class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="woman">{{ trans('update.woman') }}</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-30">
                <label class="input-label">{{ trans('update.age') }}:</label>
                <input type="number" name="age" value="{{ !empty($user->age) ? $user->age : ''}}" class="form-control">
            </div>

            <div class="form-group mb-30">
                <label class="input-label">{{ trans('update.meeting_type') }}:</label>

                <div class="d-flex align-items-center">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="meeting_type" value="in_person" id="in_person" {{ (!empty($user->meeting_type) and $user->meeting_type == 'in_person') ? 'checked="checked"' : ''}} class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="in_person">{{ trans('update.in_person') }}</label>
                    </div>

                    <div class="custom-control custom-radio ml-10">
                        <input type="radio" name="meeting_type" value="online" id="online" {{ (!empty($user->meeting_type) and $user->meeting_type == 'online') ? 'checked="checked"' : ''}} class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="online">{{ trans('update.online') }}</label>
                    </div>

                    <div class="custom-control custom-radio ml-10">
                        <input type="radio" name="meeting_type" value="all" id="all" {{ (!empty($user->meeting_type) and $user->meeting_type == 'all') ? 'checked="checked"' : ''}} class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="all">{{ trans('public.all') }}</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-30">
                <label class="input-label">{{ trans('update.level_of_training') }}:</label>

                <div class="d-flex align-items-center">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="level_of_training[]" value="beginner" id="beginner" {{ (!empty($user->level_of_training) and is_array($user->level_of_training) and in_array('beginner',$user->level_of_training)) ? 'checked="checked"' : ''}} class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="beginner">{{ trans('update.beginner') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox ml-10">
                        <input type="checkbox" name="level_of_training[]" value="middle" id="middle" {{ (!empty($user->level_of_training) and is_array($user->level_of_training) and in_array('middle',$user->level_of_training)) ? 'checked="checked"' : ''}} class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="middle">{{ trans('update.middle') }}</label>
                    </div>

                    <div class="custom-control custom-checkbox ml-10">
                        <input type="checkbox" name="level_of_training[]" value="expert" id="expert" {{ (!empty($user->level_of_training) and is_array($user->level_of_training) and in_array('expert',$user->level_of_training)) ? 'checked="checked"' : ''}} class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="expert">{{ trans('update.expert') }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2 class="section-title after-line">{{ trans('update.region') }}</h2>

    <div class="row mt-30">
        <div class="col-12 col-lg-4">
            <div class="form-group ">
                <label class="input-label">{{ trans('update.country') }}:</label>

                <select name="country_id" class="form-control " {{ empty($countries) ? 'disabled' : '' }}>
                    <option value="">{{ trans('update.select_country') }}</option>

                    @if(!empty($countries))
                        @foreach($countries as $country)
                            @php
                                $country->geo_center = \Geo::get_geo_array($country->geo_center);
                            @endphp

                            <option value="{{ $country->id }}" data-center="{{ implode(',', $country->geo_center) }}" {{ (($user->country_id == $country->id) or old('country_id') == $country->id) ? 'selected' : '' }}>{{ $country->title }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group mt-30">
                <label class="input-label">{{ trans('update.province') }}:</label>

                <select name="province_id" class="form-control " {{ empty($provinces) ? 'disabled' : '' }}>
                    <option value="">{{ trans('update.select_province') }}</option>

                    @if(!empty($provinces))
                        @foreach($provinces as $province)
                            @php
                                $province->geo_center = \Geo::get_geo_array($province->geo_center);
                            @endphp

                            <option value="{{ $province->id }}" data-center="{{ implode(',', $province->geo_center) }}" {{ (($user->province_id == $province->id) or old('province_id') == $province->id) ? 'selected' : '' }}>{{ $province->title }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group mt-30">
                <label class="input-label">{{ trans('update.city') }}:</label>

                <select name="city_id" class="form-control " {{ empty($cities) ? 'disabled' : '' }}>
                    <option value="">{{ trans('update.select_city') }}</option>

                    @if(!empty($cities))
                        @foreach($cities as $city)
                            @php
                                $city->geo_center = \Geo::get_geo_array($city->geo_center);
                            @endphp

                            <option value="{{ $city->id }}" data-center="{{ implode(',', $city->geo_center) }}" {{ (($user->city_id == $city->id) or old('city_id') == $city->id) ? 'selected' : '' }}>{{ $city->title }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group mt-30">
                <label class="input-label">{{ trans('update.district') }}:</label>

                <select name="district_id" class="form-control " {{ empty($districts) ? 'disabled' : '' }}>
                    <option value="">{{ trans('update.select_district') }}</option>

                    @if(!empty($districts))
                        @foreach($districts as $district)
                            @php
                                $district->geo_center = \Geo::get_geo_array($district->geo_center);
                            @endphp

                            <option value="{{ $district->id }}" data-center="{{ implode(',', $district->geo_center) }}" {{ (($user->district_id == $district->id) or old('district_id') == $district->id) ? 'selected' : '' }}>{{ $district->title }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group mb-30">
                <label class="input-label">{{ trans('update.address') }}:</label>
                <input type="text" name="address" value="{{ !empty($user->address) ? $user->address : '' }}" class="form-control">
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="form-group">
                <input type="hidden" id="LocationLatitude" name="latitude" value="{{ (!empty($user->location)) ? $user->location[0] : '' }}">
                <input type="hidden" id="LocationLongitude" name="longitude" value="{{ (!empty($user->location)) ? $user->location[1] : '' }}">

                <div id="mapContainer" class="d-none">
                    <label class="input-label">{{ trans('update.select_location') }}</label>
                    <span class="d-block font-12 text-gray">{{ trans('update.select_location_hint') }}</span>

                    <div class="region-map mt-10" id="mapBox"
                         data-zoom="12"
                    >
                        <img src="/assets/default/img/location.png" class="marker">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!$user->isUser() and !empty(getFeaturesSettings('show_live_chat_widget')))
        <h2 class="section-title after-line">{{ trans('update.live_chat_widget') }}</h2>

        <div class="row mt-30">
            <div class="col-12 col-lg-4">

                <div class="form-group ">
                    <label class="input-label">{{ trans('update.java_script_code') }}:</label>
                    <textarea name="live_chat_js_code" class="form-control" rows="8">{{ $user->live_chat_js_code }}</textarea>
                </div>
            </div>
        </div>
    @endif

    {{--<h2 class="section-title after-line">{{ trans('panel.meeting_list') }}</h2>

    <div class="row mt-30">
        <div class="col-12">
            <a href="/panel/meetings/settings" class="text-primary">{{ trans('update.manage_meetings') }}</a>

            <div class="d-flex align-items-center mt-25">
                <div class="available-meetings">11:30 AM</div>
                <div class="available-meetings">11:30 AM</div>
            </div>
        </div>
    </div>--}}

    <!-- Leaflet.JS Map Start -->
    <!-- <section class="scroll-section" id="leafletJS">
        <h2 class="small-title">Leaflet.JS</h2>
        <div class="card mb-5 sh-50">
            <div class="card-body h-100">
            <div id="maps" style="width:100%; height: 400px;"></div>
            </div>
        </div>
    </section> -->
    <!-- Leaflet.JS Map End -->

</section>

@push('scripts_bottom')
    <!-- <script src="/assets/vendors/leaflet/leaflet.min.js"></script> -->
    
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <script>
        const map = L.map('mapBox').setView([-7.8184209,110.37603316], 13);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // const marker = L.marker([-7.8184209,110.37603316]).addTo(map);

        // const popup = L.popup()
        // .setLatLng([-7.8184209,110.37603316])
        // .setContent('I am a standalone popup.')
        // .openOn(map);

        function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent(`You clicked the map at ${e.latlng.toString()}`)
            .openOn(map);
        }

        map.on('click', onMapClick);
    </script>

    <script>
        var selectProvinceLang = '{{ trans('update.select_province') }}';
        var selectCityLang = '{{ trans('update.select_city') }}';
        var selectDistrictLang = '{{ trans('update.select_district') }}';
    </script>

    <script src="/assets/default/js/panel/user_settings_tab.min.js"></script>
@endpush
