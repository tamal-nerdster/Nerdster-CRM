@extends('layouts.user_type.auth')
@section('content')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Products</h5>
                        </div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New product</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="basicExample">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                     <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Supplier
                                    </th>
                                     <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Price
                                    </th>
                                     <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Bandwidth
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$loop->index + 1}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$product->name}}</p>
                                    </td>
                                     <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$product->supplier->name}}</p>
                                    </td>
                                     <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$product->base_price}}</p>
                                    </td>
                                     <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$product->bandwidth}}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{$product->created_at->format('d/m/y')}}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="mx-3 editUserBtn" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <a href="#" class="mx-3 deleteUserBtn" data-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <span>
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="font-weight-bolder text-info text-gradient" id="exampleModalLabel">Add a new product</h4>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" method="post" id="addUserForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div id="addUserError" class="alert alert-danger d-none mb-3 text-white"></div>
                        </div>
                        <div class="col-md-12">
                            <label>Product Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Product name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Bandwidth </label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Bandwidth" name="bandwidth" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Base price </label>
                            <div class="input-group mb-3">
                               <input type="number" name="base_price" class="form-control" step="0.1" required placeholder="Base price">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Supplier</label>
                            <div class="input-group mb-3">
                               <select class="form-control" name="supplier_id" required>
                                   <option value="">Please select</option>
                                   @foreach($suppliers as $sup)
                                    <option value="{{$sup->id}}">{{$sup->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-info btn-lg w-100 mt-4 mb-3">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="font-weight-bolder text-danger text-gradient">Your attention is required</h6>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                            <div id="deleteUserError" class="alert alert-danger d-none mb-3 text-white"></div>
                        </div>
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="text-gradient text-danger mt-4">Are you sure want to delete this ?</h4>
                    <p>Deleting this user will permanently remove all associated data, account information, and history.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="deleteUserConfirmBtn">Ok, Delete it</button>
                <button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="font-weight-bolder text-info text-gradient" id="exampleModalLabel">Edit product</h4>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form text-left" id="editUserForm">
                     @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div id="editUserError" class="alert alert-danger d-none mb-3 text-white"></div>
                        </div>
                        <input type="hidden" class="form-control" name="product_id"  id="product_id">
                        <div class="col-md-12">
                            <label>Product Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Product name" name="name" required id="name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Bandwidth </label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Bandwidth" name="bandwidth" required id="bandwidth">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Base price </label>
                            <div class="input-group mb-3">
                               <input type="number" name="base_price" class="form-control" step="0.1" required placeholder="Base price" id="base_price">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Supplier</label>
                            <div class="input-group mb-3">
                               <select class="form-control" name="supplier_id" required id="supplier_id">
                                   <option value="">Please select</option>
                                   @foreach($suppliers as $sup)
                                    <option value="{{$sup->id}}">{{$sup->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-info btn-lg w-100 mt-4 mb-3">Update product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<link rel="stylesheet" href="{{asset('assets/vendor/datatables/dataTables.bs5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/datatables/dataTables.bs5-custom.css')}}" />
@endpush
@push('script')
<script src="{{asset('assets/vendor/datatables/dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/custom/custom-datatables.js')}}"></script>
<script>
// Add User
$('#addUserForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ url('product/store') }}",
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
            if (response.success) {
                $('#addUserError').addClass('d-none').html('');
                let successMessage = '<div class="alert alert-success text-white">Product added successfully! reloading..</div>';
                $('#exampleModal .modal-body').prepend(successMessage);
                setTimeout(function() {
                    location.reload();
                }, 2000);
            } else {
                $('#addUserError').removeClass('d-none').html(response.message);
            }
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            let errorHtml = '<ul class="list-unstyled">';
            $.each(errors, function(key, value) {
                errorHtml += '<li>' + value[0] + '</li>';
            });
            errorHtml += '</ul>';
            $('#addUserError').removeClass('d-none').html(errorHtml);
        }
    });
});

    // Edit User - Load User Data
    $(document).on('click', '.editUserBtn', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: '/product/' + userId + '/edit',
            method: 'GET',
            success: function(response) {
                $('#name').val(response.product.name);
                $('#product_id').val(response.product.id);
                $('#supplier_id').val(response.product.supplier_id);
                $('#bandwidth').val(response.product.bandwidth);
                $('#base_price').val(response.product.base_price);
                $('#api_key').val(response.product.api_key);
            }
        });
    });

    // Edit User - Submit Changes
    $('#editUserForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ url('product/update') }}",
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    $('#editUserError').addClass('d-none').html('');
                    let successMessage = '<div class="alert alert-success text-white">Product updated successfully! reloading..</div>';
                    $('#editModal .modal-body').prepend(successMessage);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    $('#editUserError').removeClass('d-none').html(response.message);
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorHtml = '<ul class="list-unstyled">';
                $.each(errors, function(key, value) {
                    errorHtml += '<li>' + value[0] + '</li>';
                });
                errorHtml += '</ul>';
                $('#editUserError').removeClass('d-none').html(errorHtml);
            }
        });
    });

    // Delete User - Confirm
    $(document).on('click', '.deleteUserBtn', function() {
        var userId = $(this).data('id');
        $('#deleteUserConfirmBtn').data('id', userId);
    });

    // Delete User - Execute
    $('#deleteUserConfirmBtn').on('click', function() {
        var userId = $(this).data('id');
        $('#deleteUserError').addClass('d-none').html('');
        $.ajax({
            url: "/delete/product/" + userId,
            method: 'GET',
            data: {
                // _token: "{{ csrf_token() }}"
            },
            success: function(response) {
               if (response.success) {
                    let successMessage = '<div class="alert alert-success text-white">Product deleted successfully! reloading..</div>';
                    $('#deleteModal .modal-body').prepend(successMessage);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            },
            error: function(response) {
                $('#deleteUserError').removeClass('d-none').html('Record not found');
            }
        });
    });
</script>
@endpush
