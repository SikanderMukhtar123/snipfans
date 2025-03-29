@extends('frontend.layout')
@section('content')
    <h1 class="category_name font-weight-bold text-center px-md-4 mt-4">Downlaoding Tools</h1>

    <div class="container mt-5 mb-5">
        @foreach ($tools as $list)
            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 rounded-3 overflow-hidden ToolCard">
                        <div class="card-body bg-white text-center p-4">
                            <a href="{{ url($list->slug) }}" class="text-decoration-none text-dark">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSEbwisdH8C91HDPihwiAZEm9h2KkJX7NGN9w&s"
                                    alt="TikTok Image" class="img-fluid rounded mb-3 toolImage">

                                <h5 class="fw-bold">
                                    {{ $list->tool_name }}
                                </h5>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        @endforeach
    </div>


@endsection