
@extends('admin.layouts.app')

@push('libraries_top')

@endpush


@section('content')
    <section class="section">
    <div class="section-header">
            <h1>Please activate your license!</h1>
           
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">



                            <div class="empty-state mx-auto d-block"  data-width="900" >
                                <img class="img-fluid col-md-6" src="/assets/default/img/lic.svg" alt="image">
                                <h3 class="mt-3">Please activate your plugin bundle license!</h3>
                                <h5 class="lead">
                                You can activate your license by <strong><a href="mailto:rocketsoftsolutions@gmail.com">contacting support</a></strong> or checking <strong><a href="https://crm.rocket-soft.org/index.php/tickets">CRM</a></strong>  </h5>      
                              </div>


                            
                        </div>

                      

                    </div>
                </div>
            </div>
        </div>
    </section>





@endsection

@push('scripts_bottom')

@endpush
