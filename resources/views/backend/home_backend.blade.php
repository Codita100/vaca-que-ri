@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- View sales -->
                <div class="col-xl-4 mb-4 col-lg-5 col-12">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-7">
                                <div class="card-body text-nowrap">
                                    <h5 class="card-title mb-0">Felicitari 🎉</h5>
                                    <p class="mb-2">Fermele tale sunt pe val</p>
{{--                                    <h4 class="text-primary mb-1">TBD Ron</h4>--}}
                                    <a href="" class="btn main_button">Vezi vouchere</a>
                                </div>
                            </div>
                            <div class="col-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img
                                        src="../../assets/img/illustrations/card-advance-sale.png"
                                        height="140"
                                        alt="view sales" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>

@endsection
