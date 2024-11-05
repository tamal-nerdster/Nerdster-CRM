@extends('layouts.user_type.auth')
@section('content')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Customers</h5>
                        </div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Customer</a>
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
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Phone
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
                                @foreach($customers as $user)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$loop->index + 1}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->contact_name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->email}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->phone}}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{$user->created_at->format('d/m/y')}}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="mx-3 editUserBtn" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <a href="#" class="mx-3 deleteUserBtn" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
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
                <h4 class="font-weight-bolder text-info text-gradient" id="exampleModalLabel">Add a new customer</h4>
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
                        <div class="col-md-6">
                            <label>Full Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Full name" name="contact_name" required>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>Company Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Company name" name="company_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email Id" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Phone</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="Phone number" name="phone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Street</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Street name" name="street" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>City</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="City name" name="city" required>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>State</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="State name" name="state" required>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>Zip code</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Zip code" name="zip_code" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Country</label>
                            <div class="input-group mb-3">
                                <select name="country" class="form-control" required>
                                    <option value="">Please Select</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country['Name']}}">{{$country['Name']}}</option>
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
                <h4 class="font-weight-bolder text-info text-gradient" id="exampleModalLabel">Edit customer</h4>
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
                        <div class="col-md-6">
                            <label>Full Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Full name" name="contact_name" required id="contact_name">
                                <input type="hidden" name="customer_id" id="customer_id">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>Company Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Company name" name="company_name" required id="company_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email Id" name="email" required id="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Phone</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="Phone number" name="phone" required id="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Street</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Street name" name="street" required id="street">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>City</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="City name" name="city" required id="city">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>State</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="State name" name="state" required id="state">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>Zip code</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Zip code" name="zip_code" required id="zip_code">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Country</label>
                            <div class="input-group mb-3">
                                <select name="country" class="form-control" required id="country">
                                    <option value="">Please Select</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country['Name']}}">{{$country['Name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-info btn-lg w-100 mt-4 mb-3">Update Customer</button>
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
            url: "{{ url('customer/store') }}",
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                console.log(response);
            if (response.success) {
                $('#addUserError').addClass('d-none').html('');
                let successMessage = '<div class="alert alert-success text-white">Customer added successfully! reloading..</div>';
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
            url: '/customer/' + userId + '/edit',
            method: 'GET',
            success: function(response) {
                $('#company_name').val(response.user.company_name);
                $('#contact_name').val(response.user.contact_name);
                $('#city').val(response.user.city);
                $('#country').val(response.user.country);
                $('#email').val(response.user.email);
                $('#phone').val(response.user.phone);
                $('#state').val(response.user.state);
                $('#street').val(response.user.street);
                $('#zip_code').val(response.user.zip_code);
                $('#customer_id').val(response.user.id);
            }
        });
    });

    // Edit User - Submit Changes
    $('#editUserForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ url('customer/update') }}",
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    $('#editUserError').addClass('d-none').html('');
                    let successMessage = '<div class="alert alert-success text-white">Customer updated successfully! reloading..</div>';
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
            url: "/delete/customer/" + userId,
            method: 'GET',
            data: {
                // _token: "{{ csrf_token() }}"
            },
            success: function(response) {
               if (response.success) {
                    let successMessage = '<div class="alert alert-success text-white">Customer deleted successfully! reloading..</div>';
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
