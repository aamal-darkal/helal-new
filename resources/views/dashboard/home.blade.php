@extends('dashboard.layouts.app')
@section('title', 'إدارة')
@section('content')
    <div class="card-wrapper container-fluid">

        <div class="row g-3">

            <!-- news count -->
            <div class="col-xl-3 col-md-6">
                <div class="card border border-5  border-top-0 border-bottom-0 shadow p-3 pb-0">
                    <div class="row align-items-center h6">
                        <div class="col-9 text-uppercase">
                            <div class="text-secondary"> عدد الصفحات </div>
                            <div class="h3">{{ $sectionsCount }}</div>
                        </div>
                        <div class="col-3">
                            <i class="align-middle text-danger" data-feather="clipboard"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border border-5  border-top-0 border-bottom-0 shadow p-3 pb-0">
                    <div class="row align-items-center h6">
                        <div class="col-9 text-uppercase">
                            <div class="text-secondary"> عدد الأخبار </div>
                            <div class="h3">{{ $newsCount }}</div>
                        </div>
                        <div class="col-3 text-info">
                            <i class="align-middle" data-feather="file-text"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border border-5  border-top-0 border-bottom-0 shadow p-3 pb-0">
                    <div class="row align-items-center h6">
                        <div class="col-9 text-uppercase">
                            <div class="text-secondary"> عدد القصص </div>
                            <div class="h3">{{ $storiesCount }}</div>
                        </div>
                        <div class="col-3 text-success">
                            <i class="align-middle" data-feather="heart"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border border-5  border-top-0 border-bottom-0 shadow p-3 pb-0">
                    <div class="row align-items-center h6">
                        <div class="col-9 text-uppercase">
                            <div class="text-secondary"> عدد الحملات </div>
                            <div class="h3">{{ $campaignCount }}</div>
                        </div>
                        <div class="col-3 text-warning">
                            <i class="align-middle" data-feather="navigation"></i>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="text-center">
            <img src="{{ asset('assets/images/logo/logo-cover.png') }}" alt="">
        </div>


    </div>
@endsection
