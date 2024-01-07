@extends('admin.layouts.app')
<title>Emsi | Create Sub Category</title>
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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Create Sub Category</h1>
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
                        <li class="breadcrumb-item text-muted">Create Sub Category</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::success button-->
                    <a href="{{ route('sub_categories.index')}}" class="btn btn-sm fw-bold btn-success">Back</a>
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
                                <form action="" class="form mb-15 text-center" method="post" id="sub_category_form">
                                    <h1 class="fw-bold text-dark mb-9">Create Sub Category</h1>
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Category</label>
                                                <select class="form-select form-control-solid" placeholder="" id="category" name="category">
                                                    <option value="">Select a category</option>
                                                    @if($categories->isNotEmpty())
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <p class="text-danger mt-2"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Name</label>
                                                <input class="form-control form-control-solid" type="text" placeholder="" name="name" id="name" />
                                                <p class="text-danger mt-2"></p>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Slug</label>
                                                <input class="form-control form-control-solid" type="text" placeholder="" name="slug" id="slug" readonly />
                                                <p class="text-danger mt-2"></p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Status</label>
                                                <select class="form-select form-control-solid" placeholder="" name="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Block</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <div class="d-flex flex-column fv-row">
                                                <label class="fs-5 fw-semibold mb-2 text-start">Show on Home</label>
                                                <select class="form-select form-control-solid" name="showHome" id="showHome" placeholder="" name="status">
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
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
    $("#sub_category_form").submit(function(event) {
        event.preventDefault();
        var element = $("#sub_category_form");
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("sub_categories.store") }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response["status"] == true) {
                    window.location.href = "{{ route('sub_categories.index')}}";
                    $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#slug').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#category').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                } else {
                    var errors = response['errors'];
                    if (errors['name']) {
                        $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                    } else {
                        $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    if (errors['slug']) {
                        $('#slug').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
                    } else {
                        $('#slug').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }

                    if (errors['category']) {
                        $('#category').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['category']);
                    } else {
                        $('#category').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                }
            },
            error: function(jqXHR, exception) {
                console.log('something went wrong')
            }
        })
    });


    $('#name').change(function() {
        element = $(this);
        $.ajax({
            url: '{{ route("getSlug") }}',
            type: 'get',
            data: {
                title: element.val()
            },
            dataType: 'json',
            success: function(response) {
                $("#slug").val(response.slug).trigger('input');
            }
        })
    });
</script>
@endsection