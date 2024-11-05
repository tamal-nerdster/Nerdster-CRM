@extends('layouts.user_type.auth')
@section('content')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Quotes</h5>
                        </div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Quote</a>
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
                                        Customer Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Product Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Monthly Price
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
                                @foreach($quotes as $quote)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$loop->index + 1}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$quote->customer->contact_name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$quote->product->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-sm bg-gradient-info">{{$quote->status}}</span>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$quote->monthly_price}}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{$quote->created_at->format('d/m/y')}}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="mx-3 editUserBtn" data-id="{{$quote->id }}" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <a href="#" class="mx-3 deleteUserBtn" data-id="{{$quote->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <span>
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </span>
                                        </a>
                                        <a href="#">
                                            <i class="fas fa-file-pdf text-lg me-1" aria-hidden="true"></i>
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
                <h4 class="font-weight-bolder text-info text-gradient" id="exampleModalLabel">Add a quote</h4>
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
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="col-md-6">
                            <label>Select Customer</label>
                            <div class="input-group mb-3">
                                <select class="form-control customer_id" name="customer_id" required>
                                    <option value="">Please select</option>
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->contact_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Select Product</label>
                            <div class="input-group mb-3">
                                <select class="form-control" name="product_id" required>
                                    <option value="">Please select</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Select Site</label>
                            <div class="input-group mb-3">
                                <select class="form-control site_id" name="site_id" required>
                                     <option value="">Please select</option>
                                    @foreach($sites as $site)
                                        <option value="{{$site->id}}">{{$site->site_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Term Months</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control set_term" placeholder="Term Months" name="term_months" required>
                            </div>
                        </div>
{{--                          <div class="col-md-6">
                            <label>Monthly price</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="Monthly price" name="monthly_price" required step="0.2" readonly>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>Installation fee</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="Installation fee" name="installation_fee" required step="0.2" readonly>
                            </div>
                        </div> --}}
                         <div class="col-md-6">
                            <label>Status</label>
                            <div class="input-group mb-3">
                                <select class="form-control" required name="status">
                                    <option value="">Please select</option>
                                    <option value="new">New</option>
                                    <option value="sent">Sent</option>
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
                <h4 class="font-weight-bolder text-info text-gradient" id="exampleModalLabel">Edit Quote</h4>
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
                        <input type="hidden" name="quote_id" id="quote_id">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="col-md-6">
                            <label>Select Customer</label>
                            <div class="input-group mb-3">
                                <select class="form-control customer_id" name="customer_id" required id="customer_id">
                                    <option value="">Please select</option>
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->contact_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Select Product</label>
                            <div class="input-group mb-3">
                                <select class="form-control" name="product_id" required id="product_id">
                                    <option value="">Please select</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}" data-price="{{$product->base_price}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Select Site</label>
                            <div class="input-group mb-3">
                                <select class="form-control site_id" name="site_id" required id="site_id">
                                    <option value="">Please select</option>
                                    @foreach($sites as $site)
                                        <option value="{{$site->id}}">{{$site->site_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Term Months</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control set_term" placeholder="Term Months" name="term_months" required id="term_months">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>Monthly price</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="Monthly price" name="monthly_price" required step="0.2" id="monthly_price" readonly>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>Installation fee</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="Installation fee" name="installation_fee" required step="0.2" id="installation_fee" readonly>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label>Status</label>
                            <div class="input-group mb-3">
                                <select class="form-control" required name="status" id="status">
                                    <option value="">Please select</option>
                                    <option value="new">New</option>
                                    <option value="sent">Sent</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-info btn-lg w-100 mt-4 mb-3">Update Quote</button>
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
$('.user_id').on('change',function(){
    $('.customer_id').empty();
    $('.site_id').empty();
    let id = $(this).val();
        $.ajax({
            url: `get/user/details/${id}`,
            method: 'GET',
            success: function(response) {
                $.each(response.customers,function(i,customer){
                    $('.customer_id').append(`<option value="${customer.id}">${customer.contact_name}</option>`);
                });
                $.each(response.sites,function(i,site){
                    $('.site_id').append(`<option value="${site.id}">${site.site_name}</option>`);
                })
        },
    });
})
// Add User
$('#addUserForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ url('quote/store') }}",
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
            if (response.success) {
                $('#addUserError').addClass('d-none').html('');
                let successMessage = '<div class="alert alert-success text-white">Quote added successfully! reloading..</div>';
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
            url: '/quote/' + userId + '/edit',
            method: 'GET',
            success: function(response) {
                $('#quote_id').val(response.quote.id);
                $('#user_id').val(response.quote.user_id).trigger('change');
                $('#customer_id').val(response.quote.customer_id);
                $('#product_id').val(response.quote.product_id);
                $('#site_id').val(response.quote.site_id);
                $('#term_months').val(response.quote.term_months);
                $('#monthly_price').val(response.quote.monthly_price);
                $('#installation_fee').val(response.quote.installation_fee);
                $('#status').val(response.quote.status);
            }
        });
    });

    // Edit User - Submit Changes
    $('#editUserForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ url('quote/update') }}",
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    $('#editUserError').addClass('d-none').html('');
                    let successMessage = '<div class="alert alert-success text-white">Quote updated successfully! reloading..</div>';
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
        var qid = $(this).data('id');
        $('#deleteUserConfirmBtn').data('id', qid);
    });

    // Delete User - Execute
    $('#deleteUserConfirmBtn').on('click', function() {
        var qid = $(this).data('id');
        $('#deleteUserError').addClass('d-none').html('');
        $.ajax({
            url: "/delete/quote/" + qid,
            method: 'GET',
            data: {
                // _token: "{{ csrf_token() }}"
            },
            success: function(response) {
               if (response.success) {
                    let successMessage = '<div class="alert alert-success text-white">Quote deleted successfully! reloading..</div>';
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
