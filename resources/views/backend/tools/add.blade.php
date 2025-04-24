@extends('backend.layout')
@section('content')
    <div class="body-wrapper-inner">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Add New Tool</h5>
                    <form action="{{ route('tool.save') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Tool Name</label>
                                <input type="text" class="form-control mb-3" name="tool_name" required>
                                <label for="">Slug</label>
                                <input type="text" class="form-control mb-3" name="slug" required>
                                <label for="">Montly Request Limit</label> 
                                <input type="number" class="form-control mb-3" name="monthly_limit" required>
                                <label for="">Status</label>
                                <select name="status" class="form-control mb-3" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inative</option>
                                </select>
                                <label for="">Order</label>
                                <input type="number" class="form-control" name="order" required>

                                <button type="submit" class="btn btn-success btn-sm mt-3">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection