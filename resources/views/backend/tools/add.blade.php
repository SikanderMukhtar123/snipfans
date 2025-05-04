@extends('backend.layout')

@section('content')
<!-- CKEditor 5 CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<div class="body-wrapper-inner">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Add New Tool</h5>
                <form action="{{ route('tool.save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Tool Name</label>
                            <input type="text" class="form-control mb-3" name="tool_name" required>

                            <label for="">Slug</label>
                            <input type="text" class="form-control mb-3" name="slug" required>

                            <label for="">Description</label>
                            <textarea name="description" id="description" class="form-control mb-3"></textarea>

                            <label for="" class="mt-3">Monthly Limit</label>
                            <input type="number" class="form-control mb-3" name="monthly_limit" required>

                            <label for="">Status</label>
                            <select name="status" class="form-control mb-3" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>

                            <label for="">Order</label>
                            <input type="number" class="form-control" name="order" required>

                            <label for="" class="mt-3">Tool IMG</label>
                            <input type="file" class="form-control mb-3" name="tool_img" required>

                            <button type="submit" class="btn btn-success btn-sm mt-3">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Initialize CKEditor with custom height -->
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            editor.ui.view.editable.element.style.height = '300px'; // increase to 300px or more
        })
        .catch(error => {
            console.error(error);
        });
</script>

@endsection
