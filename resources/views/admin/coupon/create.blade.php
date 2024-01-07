@extends('admin.layouts.app')
<title>Emsi | Create Coupon Code</title>
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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Create Coupon Code</h1>
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
                        <li class="breadcrumb-item text-muted">Create Coupon Code</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::success button-->
                    <a href="{{ route('coupons.index')}}" class="btn btn-sm fw-bold btn-success">Back</a>
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
                        <!--begin::Row-->
                        <div class="row mb-3">
                            <!--begin::Col-->
                            <div class="col-md-12 pe-lg-10">
                                <!--begin::Form-->
                                <form action="" class="form mb-15 text-center" method="post" id="discount_form">
                                    <h1 class="fw-bold text-dark mb-9">Create Coupon Code</h1>
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Code</label>
                                                <input class="form-control form-control-solid" type="text" placeholder="Coupon Code" name="code" id="code"/>
                                                <p class="text-danger mt-2"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Name</label>
                                                <input class="form-control form-control-solid" type="text" placeholder="Coupon Code Name" name="name" id="name"/>
                                                <p class="text-danger mt-2"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Status</label>
                                                <select class="form-select form-control-solid" placeholder="" name="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Block</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Type</label>
                                                <select class="form-select form-control-solid" placeholder="" name="type">
                                                    <option value="percent">Percent</option>
                                                    <option value="fixed">Fixed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Description</label>
                                                <textarea class="form-control form-control-solid" placeholder="Coupon Code Description" name="description" id="description" cols="30" rows="5"></textarea>
                                                <p class="text-danger mt-2"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Max Uses</label>
                                                <input class="form-control form-control-solid" type="text" placeholder="Max Uses" name="max_uses" id="max_uses"/>
                                                <p class="text-danger mt-2"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Max Uses User</label>
                                                <input class="form-control form-control-solid" type="text" placeholder="Max Uses User" name="max_uses_user" id="max_uses_user"/>
                                                <p class="text-danger mt-2"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Discount Amount</label>
                                                <input class="form-control form-control-solid" type="text" placeholder="Discount Amount" name="discount_amount" id="discount_amount"/>
                                                <p class="text-danger mt-2"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Min Amount</label>
                                                <input class="form-control form-control-solid" type="text" placeholder="Min Amount" name="min_amount" id="min_amount	"/>
                                                <p class="text-danger mt-2"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Starts At</label>
                                                <input autocomplete="off"  class="form-control form-control-solid" type="text" placeholder="Starts At" name="starts_at" id="starts_at"/>
                                                <p class="text-danger mt-2"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Expires At</label>
                                                <input autocomplete="off" class="form-control form-control-solid" type="text" placeholder="Expires At" name="expires_at" id="expires_at"/>
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
    $(document).ready(function(){
            $('#starts_at').datetimepicker({
                // options here
                format:'Y-m-d H:i:s',
            });
            $('#expires_at').datetimepicker({
                // options here
                format:'Y-m-d H:i:s',
            });
        });
    $("#discount_form").submit(function(event) {
        event.preventDefault();
        var element = $(this);
        $.ajax({
            url: '{{ route("coupons.store") }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response) {
                if (response["status"] == true) {
                    window.location.href = "{{ route('coupons.index')}}";
                    $('#code').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#discount_amount').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#starts_at').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#expires_at').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                } else {
                    var errors = response['errors'];
                    if (errors['code']) {
                        $('#code').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['code']);
                    } else {
                        $('#code').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    if (errors['discount_amount']) {
                        $('#discount_amount').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['discount_amount']);
                    } else {
                        $('#discount_amount').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    if (errors['starts_at']) {
                        $('#starts_at').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['starts_at']);
                    } else {
                        $('#starts_at').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    if (errors['expires_at']) {
                        $('#expires_at').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['expires_at']);
                    } else {
                        $('#expires_at').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                }
            },
            error: function(jqXHR, exception) {
                console.log('something went wrong')
            }
        })
    });
</script>
@endsection