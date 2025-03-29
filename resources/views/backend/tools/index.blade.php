@extends('backend.layout')
@section('content')
    <div class="body-wrapper-inner">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Tools List</h5>
                    <a href="{{ route('tool.add') }}" class="btn btn-sm btn-success">Add New</a>
                    <div class="table-responsive">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tool Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Views</th>
                                    <th>Order </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tools as $list)
                                    <tr>
                                        <td>{{ $list->id }}</td>
                                        <td>{{ $list->tool_name }}</td>
                                        <td>{{ $list->slug }}</td>
                                        <td>{{ $list->status == 1 ? 'Active' : 'inactive' }}</td>
                                        <td>{{ $list->view ?? '0' }}</td>
                                        <td>{{ $list->order }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                                    id="dropdownMenuButton{{ $list->id }}" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $list->id }}">
                                                    <li>
                                                        <a href="{{ route('tool.edit', $list->id) }}" class="dropdown-item">
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('tool.edit', $list->id) }}" class="dropdown-item">
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center">
                                            No Tools Found !
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection