@extends('layout.layout')
@section('content')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Product Types</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Category</li>
                    </ul>


                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary" style="display: flex" type="button" data-toggle="modal" data-target="#addCategoryModal">
                        Add New
                    </button>
                </div>

            </div>
        </div>

        {{-- Display session message --}}
        <div class="container-fluid">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        </div>

        {{-- Display saved categories --}}
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="save-stage">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->category_name }}</td>
                            <td>
                                <button type="button" class="btn btn-primary edit-category" data-id="{{ $row->id }}" data-category_name="{{ $row->category_name }}">
                                    Edit
                                </button>

                                <button class="btn btn-danger delete-category" data-id="{{ $row->id }}" title="Delete" data-toggle="modal" data-target="#confirmationModal">
                                    Delete <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Add Category Modal --}}
        <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addCategoryForm" action="{{ route('category.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <input type="text" name="category_name" id="category_name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>

        {{-- Update Category Modal --}}
        <div class="modal fade" id="updateCategoryModal" tabindex="-1" role="dialog" aria-labelledby="updateCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateCategoryModalLabel">Update Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="updateCategoryForm" action="{{ route('category.update',['id' => $data->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" id="update_product_type_id" name="id" value="{{ $productType->id }}">
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <input type="text" name="category_name" id="category_name" value="{{ $data->category_name }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>


    </div>
</section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#addCategoryForm').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action')
                , type: $(this).attr('method')
                , data: formData
                , success: function(response) {
                    $('#addCategoryModal').modal('hide');
                    location.reload();
                }
                , error: function(xhr, status, error) {
                    alert('An error occurred while saving the category');
                    console.error(xhr.responseText);
                }
            });
        });
    });

</script>
