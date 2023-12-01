@php
    if (!empty($itemValue) and !is_array($itemValue)) {
        $itemValue = json_decode($itemValue, true);
    }
@endphp

<div class="tab-pane mt-3 fade" id="general_options" role="tabpanel" aria-labelledby="general_options-tab">
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="{{ getAdminPanelUrl() }}/settings/general_options" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="page" value="general">
                <input type="hidden" name="general_options" value="general_options">

                <div class="mb-5">
                    <h5>{{ trans('update.direct_publication_options') }}</h5>

                    @php
                        $directPublicationOptions = ['direct_publication_of_courses', 'direct_publication_of_comments', 'direct_publication_of_reviews', 'direct_publication_of_blog'];
                    @endphp

                    @foreach($directPublicationOptions as $directPublicationOption)
                        <div class="form-group mt-3 custom-switches-stacked">
                            <label class="custom-switch pl-0">
                                <input type="hidden" name="value[{{ $directPublicationOption }}]" value="0">
                                <input type="checkbox" name="value[{{ $directPublicationOption }}]" id="{{ $directPublicationOption }}Switch" value="1" {{ (!empty($itemValue) and !empty($itemValue[$directPublicationOption]) and $itemValue[$directPublicationOption]) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                                <span class="custom-switch-indicator"></span>
                                <label class="custom-switch-description mb-0 cursor-pointer" for="{{ $directPublicationOption }}Switch">{{ trans("update.{$directPublicationOption}") }}</label>
                            </label>
                            <p class="font-12 text-gray mb-0">{{ trans("update.{$directPublicationOption}_hint") }}</p>
                        </div>
                    @endforeach

                </div>


                <button type="submit" class="btn btn-primary">{{ trans('admin/main.save_change') }}</button>
            </form>
        </div>
    </div>
</div>
