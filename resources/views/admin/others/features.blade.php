@php
    if (!empty($itemValue) and !is_array($itemValue)) {
        $itemValue = json_decode($itemValue, true);
    }
@endphp

<div class="tab-pane mt-3 fade" id="features" role="tabpanel" aria-labelledby="features-tab">
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="{{ getAdminPanelUrl() }}/settings/features" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="page" value="general">
                <input type="hidden" name="features" value="features">

                <div class="mb-5">
                    <h5>{{ trans('update.agora') }} {{ trans('admin/main.settings') }}</h5>

                    <div class="form-group">
                        <label>{{ trans('update.agora') }} {{ trans('update.resolution') }}</label>

                        <select class="form-control" name="value[agora_resolution]">
                            <option value="">{{ trans('admin/main.select') }} {{ trans('update.resolution') }}</option>

                            @foreach(getAgoraResolutions() as $resolution)
                                <option value="{{ $resolution }}" {{ ((!empty($itemValue) and !empty($itemValue['agora_resolution']) and $itemValue['agora_resolution'] == $resolution) or old('value[agora_resolution]') == $resolution) ? 'selected' : '' }}>{{ str_replace('_',' x ', $resolution) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('update.max_bitrate') }}</label>
                        <input type="text" name="value[agora_max_bitrate]" value="{{ (!empty($itemValue) and !empty($itemValue['agora_max_bitrate'])) ? $itemValue['agora_max_bitrate'] : old('agora_max_bitrate') }}" class="form-control "/>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('update.min_bitrate') }}</label>
                        <input type="text" name="value[agora_min_bitrate]" value="{{ (!empty($itemValue) and !empty($itemValue['agora_min_bitrate'])) ? $itemValue['agora_min_bitrate'] : old('agora_min_bitrate') }}" class="form-control "/>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('update.frame_rate') }}</label>
                        <input type="text" name="value[agora_frame_rate]" value="{{ (!empty($itemValue) and !empty($itemValue['agora_frame_rate'])) ? $itemValue['agora_frame_rate'] : old('agora_frame_rate') }}" class="form-control "/>
                    </div>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[agora_live_streaming]" value="0">
                            <input type="checkbox" name="value[agora_live_streaming]" id="agoraStreamSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['agora_live_streaming']) and $itemValue['agora_live_streaming']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="agoraStreamSwitch">{{ trans('update.agora_live_streaming') }}</label>
                        </label>
                    </div>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[agora_chat]" value="0">
                            <input type="checkbox" name="value[agora_chat]" id="agoraChatSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['agora_chat']) and $itemValue['agora_chat']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="agoraChatSwitch">{{ trans('update.agora_chat') }}</label>
                        </label>
                    </div>
                    {{--
                                        <div class="form-group custom-switches-stacked">
                                            <label class="custom-switch pl-0">
                                                <input type="hidden" name="value[agora_cloud_rec]" value="0">
                                                <input type="checkbox" name="value[agora_cloud_rec]" id="agoraRecordingSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['agora_cloud_rec']) and $itemValue['agora_cloud_rec']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                                                <span class="custom-switch-indicator"></span>
                                                <label class="custom-switch-description mb-0 cursor-pointer" for="agoraRecordingSwitch">{{ trans('update.agora_recording') }}</label>
                                            </label>
                                        </div>
                    --}}

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[agora_in_free_courses]" value="0">
                            <input type="checkbox" name="value[agora_in_free_courses]" id="agoraInFreeCoursesSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['agora_in_free_courses']) and $itemValue['agora_in_free_courses']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="agoraInFreeCoursesSwitch">{{ trans('update.agora_in_free_courses') }}</label>
                        </label>
                    </div>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[agora_for_meeting]" value="0">
                            <input type="checkbox" name="value[agora_for_meeting]" id="agoraForMeetingSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['agora_for_meeting']) and $itemValue['agora_for_meeting']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="agoraForMeetingSwitch">{{ trans('update.agora_for_meeting') }}</label>
                        </label>
                        <div class="text-muted text-small mt-1">{{ trans('update.agora_meeting_hint') }}</div>
                    </div>

                    <div class="form-group">
                        <label class="input-label">{{ trans('update.meeting_live_stream_type') }}</label>
                        <select name="value[meeting_live_stream_type]" class="form-control">
                            <option value="single" {{ (!empty($itemValue) and !empty($itemValue['meeting_live_stream_type']) and $itemValue['meeting_live_stream_type'] == 'single') ? 'selected="selected"' : '' }}>{{ trans('update.meeting_single') }}</option>
                            <option value="multiple" {{ (!empty($itemValue) and !empty($itemValue['meeting_live_stream_type']) and $itemValue['meeting_live_stream_type'] == 'multiple') ? 'selected="selected"' : '' }}>{{ trans('update.meeting_multiple') }}</option>
                        </select><label class="label"></label>
                    </div>

                    <div class="form-group">
                        <label class="input-label">{{ trans('update.course_live_stream_type') }}</label>
                        <select name="value[course_live_stream_type]" class="form-control">
                            <option value="single" {{ (!empty($itemValue) and !empty($itemValue['course_live_stream_type']) and $itemValue['course_live_stream_type'] == 'single') ? 'selected="selected"' : '' }}>{{ trans('update.meeting_single') }}</option>
                            <option value="multiple" {{ (!empty($itemValue) and !empty($itemValue['course_live_stream_type']) and $itemValue['course_live_stream_type'] == 'multiple') ? 'selected="selected"' : '' }}>{{ trans('update.meeting_multiple') }}</option>
                        </select><label class="label"></label>
                    </div>
                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.new_interactive_file') }} {{ trans('admin/main.settings') }}</h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[new_interactive_file]" value="0">
                            <input type="checkbox" name="value[new_interactive_file]" id="newInteractiveFileSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['new_interactive_file']) and $itemValue['new_interactive_file']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="newInteractiveFileSwitch">{{ trans('update.interactive_feature_toggle') }}</label>
                        </label>
                    </div>
                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.timezone') }} {{ trans('admin/main.settings') }}</h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[timezone_in_register]" value="0">
                            <input type="checkbox" name="value[timezone_in_register]" id="timezoneInRegisterSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['timezone_in_register']) and $itemValue['timezone_in_register']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="timezoneInRegisterSwitch">{{ trans('update.timezone_in_register') }}</label>
                        </label>
                    </div>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[timezone_in_create_webinar]" value="0">
                            <input type="checkbox" name="value[timezone_in_create_webinar]" id="timezoneInCreateWebinarSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['timezone_in_create_webinar']) and $itemValue['timezone_in_create_webinar']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="timezoneInCreateWebinarSwitch">{{ trans('update.timezone_in_create_webinar') }}</label>
                        </label>
                    </div>
                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.sequence_content_settings') }}</h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[sequence_content_status]" value="0">
                            <input type="checkbox" name="value[sequence_content_status]" id="sequenceContentSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['sequence_content_status']) and $itemValue['sequence_content_status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="sequenceContentSwitch">{{ trans('admin/main.active') }}</label>
                        </label>
                    </div>
                </div>


                <div class="mb-5">
                    <h5>{{ trans('update.assignment_settings') }}</h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[webinar_assignment_status]" value="0">
                            <input type="checkbox" name="value[webinar_assignment_status]" id="webinarAssignmentSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['webinar_assignment_status']) and $itemValue['webinar_assignment_status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="webinarAssignmentSwitch">{{ trans('admin/main.active') }}</label>
                        </label>
                    </div>
                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.private_content_settings') }}</h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[webinar_private_content_status]" value="0">
                            <input type="checkbox" name="value[webinar_private_content_status]" id="webinarPrivateContentSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['webinar_private_content_status']) and $itemValue['webinar_private_content_status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="webinarPrivateContentSwitch">{{ trans('admin/main.active') }}</label>
                        </label>

                        <p class="font-12 text-gray mb-0">{{ trans('update.private_content_settings_hint') }}</p>
                    </div>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[disable_view_content_after_user_register]" value="0">
                            <input type="checkbox" name="value[disable_view_content_after_user_register]" id="disableViewContentAfterUserRegisterSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['disable_view_content_after_user_register']) and $itemValue['disable_view_content_after_user_register']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="disableViewContentAfterUserRegisterSwitch">{{ trans('update.disable_view_content_after_user_register') }}</label>
                        </label>

                        <p class="font-12 text-gray mb-0">{{ trans('update.disable_view_content_after_user_register_hint') }}</p>
                    </div>
                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.course_forum_settings') }}</h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[course_forum_status]" value="0">
                            <input type="checkbox" name="value[course_forum_status]" id="courseForumSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['course_forum_status']) and $itemValue['course_forum_status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="courseForumSwitch">{{ trans('admin/main.active') }}</label>
                        </label>

                        <p class="font-12 text-gray mb-0">{{ trans('update.course_forum_settings_status_hint') }}</p>
                    </div>
                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.forum_settings') }}</h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[forums_status]" value="0">
                            <input type="checkbox" name="value[forums_status]" id="forumStatusSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['forums_status']) and $itemValue['forums_status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="forumStatusSwitch">{{ trans('admin/main.active') }}</label>
                        </label>

                        <p class="font-12 text-gray mb-0">{{ trans('update.forum_settings_status_hint') }}</p>
                    </div>
                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.direct_classes_payment_button_settings') }}</h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[direct_classes_payment_button_status]" value="0">
                            <input type="checkbox" name="value[direct_classes_payment_button_status]" id="directClassesPaymentButtonStatusSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['direct_classes_payment_button_status']) and $itemValue['direct_classes_payment_button_status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="directClassesPaymentButtonStatusSwitch">{{ trans('admin/main.classes') }}</label>
                        </label>

                        <p class="font-12 text-gray mb-0">{{ trans('update.direct_classes_payment_button_status_hint') }}</p>
                    </div>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[direct_bundles_payment_button_status]" value="0">
                            <input type="checkbox" name="value[direct_bundles_payment_button_status]" id="directBundlesPaymentButtonStatusSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['direct_bundles_payment_button_status']) and $itemValue['direct_bundles_payment_button_status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="directBundlesPaymentButtonStatusSwitch">{{ trans('update.bundles') }}</label>
                        </label>

                        <p class="font-12 text-gray mb-0">{{ trans('update.direct_bundles_payment_button_status_hint') }}</p>
                    </div>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[direct_products_payment_button_status]" value="0">
                            <input type="checkbox" name="value[direct_products_payment_button_status]" id="directProductsPaymentButtonStatusSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['direct_products_payment_button_status']) and $itemValue['direct_products_payment_button_status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="directProductsPaymentButtonStatusSwitch">{{ trans('update.products') }}</label>
                        </label>

                        <p class="font-12 text-gray mb-0">{{ trans('update.direct_products_payment_button_status_hint') }}</p>
                    </div>

                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.cookie_settings_status') }}</h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[cookie_settings_status]" value="0">
                            <input type="checkbox" name="value[cookie_settings_status]" id="cookieSettingsSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['cookie_settings_status']) and $itemValue['cookie_settings_status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="cookieSettingsSwitch">{{ trans('admin/main.active') }}</label>
                        </label>
                    </div>
                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.mobile_app_status') }}</h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[mobile_app_status]" value="0">
                            <input type="checkbox" name="value[mobile_app_status]" id="mobileAppSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['mobile_app_status']) and $itemValue['mobile_app_status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="mobileAppSwitch">{{ trans('admin/main.active') }}</label>
                        </label>
                        <p class="font-12 text-gray mb-0">{{ trans('update.mobile_app_only_hint') }}</p>
                    </div>
                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.maintenance_status') }}</h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[maintenance_status]" value="0">
                            <input type="checkbox" name="value[maintenance_status]" id="maintenance_statusSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['maintenance_status']) and $itemValue['maintenance_status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="maintenance_statusSwitch">{{ trans('admin/main.active') }}</label>
                        </label>
                        <p class="font-12 text-gray mb-0">{{ trans('update.maintenance_status_hint') }}</p>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('update.maintenance_access_key') }}</label>
                        <input type="text" name="value[maintenance_access_key]" value="{{ (!empty($itemValue) and !empty($itemValue['maintenance_access_key'])) ? $itemValue['maintenance_access_key'] : old('maintenance_access_key') }}" class="form-control "/>
                        <p class="text-muted font-12 mt-1">{{ trans('update.maintenance_access_key_hint') }}</p>
                    </div>
                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.extra_time_to_join') }}</h5>

                    <div class="form-group mt-3 mb-0 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[extra_time_to_join_status]" value="0">
                            <input type="checkbox" name="value[extra_time_to_join_status]" id="extraTimeToJoinSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['extra_time_to_join_status']) and $itemValue['extra_time_to_join_status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="extraTimeToJoinSwitch">{{ trans('admin/main.active') }}</label>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="input-label" for="">{{ trans('update.default_time') }}</label>
                        <input type="text" name="value[extra_time_to_join_default_value]" value="{{ (!empty($itemValue) and !empty($itemValue['extra_time_to_join_default_value'])) ? $itemValue['extra_time_to_join_default_value'] : '' }}" class="form-control"/>
                        <p class="text-muted font-12 mt-1">{{ trans('update.extra_time_hint') }}</p>
                    </div>
                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.registration_form_options') }}</h5>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[show_other_register_method]" value="0">
                            <input type="checkbox" name="value[show_other_register_method]" id="showOtherRegisterMethodSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['show_other_register_method']) and $itemValue['show_other_register_method']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="showOtherRegisterMethodSwitch">{{ trans('update.show_other_register_method') }}</label>
                        </label>
                        <p class="font-14">{{ trans('update.show_other_register_method_hint') }}</p>
                    </div>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[show_certificate_additional_in_register]" value="0">
                            <input type="checkbox" name="value[show_certificate_additional_in_register]" id="showCertificateAdditionalInRegister" value="1" {{ (!empty($itemValue) and !empty($itemValue['show_certificate_additional_in_register']) and $itemValue['show_certificate_additional_in_register']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="showCertificateAdditionalInRegister">{{ trans('update.show_certificate_additional_in_register') }}</label>
                        </label>
                        <p class="font-14">{{ trans('update.show_certificate_additional_in_register_hint') }}</p>
                    </div>
                </div>


                <div class="mb-5">
                    <h5>{{ trans('update.social_login_settings') }}</h5>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[show_google_login_button]" value="0">
                            <input type="checkbox" name="value[show_google_login_button]" id="showGoogleLoginButtonSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['show_google_login_button']) and $itemValue['show_google_login_button']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="showGoogleLoginButtonSwitch">{{ trans('update.show_google_login_button') }}</label>
                        </label>
                        <p class="font-14">{{ trans('update.show_google_login_button_hint') }}</p>
                    </div>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[show_facebook_login_button]" value="0">
                            <input type="checkbox" name="value[show_facebook_login_button]" id="showFacebookLoginButton" value="1" {{ (!empty($itemValue) and !empty($itemValue['show_facebook_login_button']) and $itemValue['show_facebook_login_button']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="showFacebookLoginButton">{{ trans('update.show_facebook_login_button') }}</label>
                        </label>
                        <p class="font-14">{{ trans('update.show_facebook_login_button_hint') }}</p>
                    </div>
                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.live_chat_widget') }}</h5>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[show_live_chat_widget]" value="0">
                            <input type="checkbox" name="value[show_live_chat_widget]" id="show_live_chat_widgetSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['show_live_chat_widget']) and $itemValue['show_live_chat_widget']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="show_live_chat_widgetSwitch">{{ trans('update.show_live_chat_widget') }}</label>
                        </label>
                        <p class="font-14">{{ trans('update.show_live_chat_widget_hint') }}</p>
                    </div>
                </div>


                <div class="mb-5">
                    <h5>{{ trans('update.cashback') }}</h5>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[cashback_active]" value="0">
                            <input type="checkbox" name="value[cashback_active]" id="cashback_activeSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['cashback_active']) and $itemValue['cashback_active']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="cashback_activeSwitch">{{ trans('update.cashback_active') }}</label>
                        </label>
                        <p class="font-14">{{ trans('update.cashback_active_hint') }}</p>
                    </div>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[display_cashback_notice_in_the_product_page]" value="0">
                            <input type="checkbox" name="value[display_cashback_notice_in_the_product_page]" id="display_cashback_notice_in_the_product_pageSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['display_cashback_notice_in_the_product_page']) and $itemValue['display_cashback_notice_in_the_product_page']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="display_cashback_notice_in_the_product_pageSwitch">{{ trans('update.display_cashback_notice_in_the_product_page') }}</label>
                        </label>
                        <p class="font-14">{{ trans('update.display_cashback_notice_in_the_product_page_hint') }}</p>
                    </div>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[display_minimum_amount_cashback_notices]" value="0">
                            <input type="checkbox" name="value[display_minimum_amount_cashback_notices]" id="display_minimum_amount_cashback_noticesSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['display_minimum_amount_cashback_notices']) and $itemValue['display_minimum_amount_cashback_notices']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="display_minimum_amount_cashback_noticesSwitch">{{ trans('update.display_minimum_amount_cashback_notices') }}</label>
                        </label>
                        <p class="font-14">{{ trans('update.display_minimum_amount_cashback_notices_hint') }}</p>
                    </div>
                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.session_api') }}</h5>

                    @php
                        $selectedApi = (!empty($itemValue) and !empty($itemValue['available_session_apis']) and is_array($itemValue['available_session_apis'])) ? $itemValue['available_session_apis'] : [];
                    @endphp
                    <div class="form-group">
                        <label class="input-label">{{ trans('update.available_session_apis') }}</label>
                        <select name="value[available_session_apis][]" class="form-control select2" multiple>
                            @foreach(\App\Models\Session::$sessionApis as $sessionApi)
                                <option value="{{ $sessionApi }}" @if(in_array($sessionApi, $selectedApi)) selected @endif>{{ trans('update.session_api_'.$sessionApi) }}</option>
                            @endforeach
                        </select>
                        <p class="text-muted font-12 mt-1">{{ trans('update.session_api_hint') }}</p>
                    </div>
                </div>


                <div class="mb-5">
                    <h5>{{ trans('update.upload_sources') }}</h5>

                    @php
                        $selectedSources = (!empty($itemValue) and !empty($itemValue['available_sources']) and is_array($itemValue['available_sources'])) ? $itemValue['available_sources'] : [];
                    @endphp
                    <div class="form-group">
                        <label class="input-label">{{ trans('public.source') }}</label>
                        <select name="value[available_sources][]" class="form-control select2" multiple>
                            @foreach(\App\Models\File::$fileSources as $source)
                                <option value="{{ $source }}" @if(in_array($source, $selectedSources)) selected @endif>{{ trans('update.file_source_'.$source) }}</option>
                            @endforeach
                        </select>
                        <p class="text-muted font-12 mt-1">{{ trans('update.upload_sources_hint') }}</p>
                    </div>
                </div>


                <div class="mb-5">
                    <h5>{{ trans('update.bunny_stream_settings') }} ({{ trans('update.secure_host') }})</h5>

                    @php
                        $bunnyConfs = ['library_id', 'hostname', 'access_key', 'token_authentication_key'];
                    @endphp

                    @foreach($bunnyConfs as $bunnyConf)
                        <div class="form-group">
                            <label class="input-label">{{ trans('update.'.$bunnyConf) }}</label>
                            <input name="value[bunny_configs][{{ $bunnyConf }}]" class="form-control" value="{{ (!empty($itemValue) and !empty($itemValue['bunny_configs']) and !empty($itemValue['bunny_configs'][$bunnyConf])) ? $itemValue['bunny_configs'][$bunnyConf] : null }}">
                        </div>
                    @endforeach
                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.select_the_role_during_registration') }}</h5>

                    @php
                        $roleItems = [\App\Models\Role::$teacher, \App\Models\Role::$organization];
                        $selectedRoleItems = (!empty($itemValue) and !empty($itemValue['select_the_role_during_registration']) and is_array($itemValue['select_the_role_during_registration'])) ? $itemValue['select_the_role_during_registration'] : [];
                    @endphp

                    <div class="form-group">
                        <label class="">{{ trans('update.select_roles') }}</label>
                        <select name="value[select_the_role_during_registration][]" class="form-control select2" multiple>
                            @foreach($roleItems as $roleItem)
                                <option value="{{ $roleItem }}" @if(in_array($roleItem, $selectedRoleItems)) selected @endif>{{ trans('update.role_'.$roleItem) }}</option>
                            @endforeach
                        </select>
                        <p class="text-muted font-12 mt-1">{{ trans('update.select_rules_hint') }}</p>
                    </div>

                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.enable_waitlist') }}</h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[waitlist_status]" value="0">
                            <input type="checkbox" name="value[waitlist_status]" id="waitlist_statusSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['waitlist_status']) and $itemValue['waitlist_status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="waitlist_statusSwitch">{{ trans('admin/main.active') }}</label>
                        </label>
                        <p class="font-12 text-gray mb-0">{{ trans('update.waitlist_status_hint') }}</p>
                    </div>

                </div>

                <div class="mb-5">
                    <h5>{{ trans('update.enable_upcoming_courses') }}</h5>

                    <div class="form-group mt-3 custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="value[upcoming_courses_status]" value="0">
                            <input type="checkbox" name="value[upcoming_courses_status]" id="upcoming_courses_statusSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['upcoming_courses_status']) and $itemValue['upcoming_courses_status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer" for="upcoming_courses_statusSwitch">{{ trans('admin/main.active') }}</label>
                        </label>
                        <p class="font-12 text-gray mb-0">{{ trans('update.upcoming_courses_status_hint') }}</p>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">{{ trans('admin/main.save_change') }}</button>
            </form>
        </div>
    </div>
</div>
