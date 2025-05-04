@extends('frontend.layout')
@section('content')
<h1 class="category_name font-weight-bold text-center px-md-4 mt-4">Downlaoding Tools</h1>

<div class="container mt-5 mb-5">
    <div class="row">
        @foreach ($tools as $list)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0 rounded-3 overflow-hidden ToolCard">
                <div class="card-body bg-white text-center p-4">
                    <a href="{{ url($list->slug) }}" class="text-decoration-none text-dark">
                        <img src="{{ asset('assets/dashboard_assets/images/tools/'.$list->img) }}" alt="TikTok Image"
                            class="img-fluid rounded mb-3 toolImage">

                        <h5 class="fw-bold">
                            {{ $list->tool_name }}
                        </h5>

                        <div class="des flex-grow-1 text-muted" style="margin-top: 20px;">
                            {!! $list->description !!}
                        </div>

                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection