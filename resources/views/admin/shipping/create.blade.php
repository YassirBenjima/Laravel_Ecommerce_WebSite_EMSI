@extends('admin.layouts.app')
<title>Emsi | Shipping Management</title>
@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Shipping Management</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted text-hover-success">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Shipping Management</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::success button-->
                    <a href="{{ route('shipping.create')}}" class="btn btn-sm fw-bold btn-success">Back</a>
                    <!--end::success button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Contact-->
                <div class="card">
                    <!--begin::Body-->
                    <div class="card-body p-lg-17">
                        @if(session('success'))
                        <div class="alert alert-success" id="successMessage">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger" id="dangerMessage">
                            {{ session('error') }}
                        </div>
                        @endif
                        <!--begin::Row-->
                        <div class="row mb-3">
                            <!--begin::Col-->
                            <div class="col-md-12 pe-lg-10">
                                <!--begin::Form-->
                                <form action="" class="form mb-15 text-center" method="post" id="shippingform" name="shippingform">
                                    <h1 class="fw-bold text-dark mb-9">Shipping Management</h1>
                                        <div class="row mb-5">
                                            <div class="col-md-6">
                                                <div class="d-flex flex-column fv-row">
                                                    <label for="" class="fs-5 fw-semibold mb-2 text-start">Name</label>
                                                    <select name="country" id="country" class="form-control"> 
                                                        <option value=""> --- Please Select --- </option>
                                                        @if ($countries->isNotEmpty())
                                                            @foreach($countries as $country)
                                                            <option value="{{ $country->id}}">{{ $country->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <p class="text-danger mt-2"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex flex-column fv-row">
                                                    <label for="" class="fs-5 fw-semibold mb-2 text-start">Amount</label>
                                                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount"/>
                                                    <p class="text-danger mt-2"></p>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="mb-5">
                                        <button type="submit" class="btn btn-success me-3">
                                            <span class="indicator-label">Create</span>
                                        </button>
                                        <a href="{{ route('admin.dashboard')}}" class="btn btn-light">
                                            <span class="indicator-label">Cancel</span>
                                        </a>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Contact-->
                <div class="card">
                    <!--begin::Body-->
                    <div class="card-body p-lg-17">
                        <!--begin::Row-->
                        <div class="row mb-3">
                            <!--begin::Col-->
                            <div class="col-md-12 pe-lg-10">
                                <!--begin::Form-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_report_customer_orders_table">
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr class="text-center text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-100px">ID</th>
                                            <th class="min-w-100px">Name</th>
                                            <th class="min-w-100px">Amount</th>
                                            <th class="min-w-75px">Action</th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-semibold text-gray-600 text-center">
                                        @if ($shippingCharges->isNotEmpty())
                                        @foreach ( $shippingCharges as $shippingCharge )
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Customer name=-->
                                            <td class="text-dark ">
                                                {{ $shippingCharge->id }}
                                            </td>
                                            <!--end::Customer name=-->
                                            <!--begin::Email=-->
                                            <td class="text-dark ">
                                                {{ $shippingCharge->name }}
                                            </td>
                                            <!--end::Email=-->
                                            <!--begin::Status=-->
                                            <td class="text-dark ">
                                                ${{ $shippingCharge->amount }}
                                            </td>
                                            <!--begin::Status=-->
                                            <!--begin::actions=-->
                                            <td class="text-dark">
                                                <!-- Modify Button -->
                                                <a href="{{route('shipping.edit',$shippingCharge->id)}}" class="btn btn-default btn-sm">
                                                    <i class="bi bi-pencil text-primary"></i>
                                                </a>
                                                <!-- Delete Button -->
                                                <a href="#" onclick="deleteShipping('{{$shippingCharge->id}}')" class="btn btn-default btn-sm">
                                                    <i class="bi bi-trash text-danger"></i> 
                                                </a>
                                            </td>
                                            <!--end::actions=-->
                                        </tr>
                                        <!--end::Table row-->
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-dark " colspan="5"> Records Not Found</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Form-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->
    <div id="kt_app_footer" class="app-footer">
        <!--begin::Footer container-->
        <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
                <span class="text-muted fw-semibold me-1">2023&copy;</span>
                <a href="#" target="_blank" class="text-gray-800 text-hover-success">YassirOussama</a>
            </div>
            <!--end::Copyright-->
            <!--begin::Menu-->
            <ul class="menu menu-gray-600 menu-hover-success fw-semibold order-1">
                <li class="menu-item">
                    <a href="#" target="_blank" class="menu-link px-2">About</a>
                </li>
                <li class="menu-item">
                    <a href="#" target="_blank" class="menu-link px-2">Support</a>
                </li>
                <li class="menu-item">
                    <a href="#" target="_blank" class="menu-link px-2">Purchase</a>
                </li>
            </ul>
            <!--end::Menu-->
        </div>
        <!--end::Footer container-->
    </div>
    <!--end::Footer-->
</div>
@endsection
@section('customJs')
<script>
    $("#shippingform").submit(function(event) {
        event.preventDefault();
        var element = $(this);
        $.ajax({
            url: '{{ route("shipping.store") }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response) {
                if (response["status"] == true) {
                    window.location.href = "{{ route('shipping.create')}}";
                } else {
                    var errors = response['errors'];
                    if (errors['country']) {
                        $('#country').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['country']);
                    } else {
                        $('#country').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    if (errors['amount']) {
                        $('#amount').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['amount']);
                    } else {
                        $('#amount').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                }
            },
            error: function(jqXHR, exception) {
                console.log('something went wrong')
            }
        })
    });
    function deleteShipping(id) {
            var url = '{{ route("shipping.delete","ID")}}';
            var newUrl = url.replace("ID", id);
            if (confirm("Are you sure you want to delete")) {
                $.ajax({
                    url: newUrl,
                    type: 'delete',
                    data: {},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response["status"]) {
                            window.location.href = "{{ route('shipping.create')}}";
                        }
                    }
                });
            }
        }
</script>
@endsection
