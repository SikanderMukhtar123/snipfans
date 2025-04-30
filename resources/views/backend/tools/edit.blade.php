@extends('backend.layout')
@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Add New Tool</h5>
                <form action="{{ route('tool.update', $tool->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Tool Name</label>
                            <input type="text" class="form-control mb-3" name="tool_name"
                                value="{{ $tool->tool_name }}">
                            <label for="">Slug</label>
                            <input type="text" class="form-control mb-3" name="slug" value="{{ $tool->slug }}">
                            <label for="">Status</label>
                            <select name="status" class="form-control mb-3">
                                <option value="1" {{ $tool->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $tool->status == 0 ? 'selected' : '' }}>Inative</option>
                            </select>
                            <label for="">Montly Request Limit</label>
                            <input type="number" class="form-control mb-3" name="monthly_limit"
                                value="{{ $tool->monthly_limit}}" required>
                            <label for="">Order</label>
                            <input type="number" class="form-control" name="order" value="{{ $tool->order }}">
                            <label for="" class="mt-3">Tool IMG</label>
                            <input type="file" class="form-control mb-3" name="tool_img" required>

                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset('assets/dashboard_assets/images/tools/'.$tool->img) }}" alt="" width="100px" height="100px">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-sm mt-3">update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection