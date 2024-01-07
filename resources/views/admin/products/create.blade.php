@extends('admin.layouts.app')
<title>Emsi | Create Product</title>
@section('content')
<!--begin::Main-->
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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Product Settings</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="../../demo1/dist/index.html" class="text-muted text-hover-success">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Products</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <!--begin::success button-->
                    <a href="#" class="btn btn-sm fw-bold btn-success" data-bs-toggle="modal">Back</a>
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
                <!--begin::Basic info-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Create Your Product</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <!--begin::Card body-->
                        <form method="post" id="productform" class="productform">
                            @csrf

                            <div class="card-body border-top p-9">
                                <!--begin::Input group-->
                                <!-- <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                                <div class="col-lg-8">
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/300-1.jpg)"></div>
                                        <label class="btn btn-icon btn-circle btn-active-color-success w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                            </label>
                                        <span class="btn btn-icon btn-circle btn-active-color-success w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <span class="btn btn-icon btn-circle btn-active-color-success w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                    </div>
                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                </div>
                            </div> -->
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Title & Slug</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-6 fv-row">
                                                <input type="text" id="title" name="title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Title" value="" />
                                                <p class="text-danger mt-2"></p>
                                            </div>

                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6 fv-row">
                                                <input type="text" readonly id="slug" name="slug" class="form-control form-control-lg form-control-solid" placeholder="Slug" value="" />
                                                <p class="text-danger mt-2"></p>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--end::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Short Description</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <textarea id="short_description" name="short_description" cols="30" rows="10" class="form-control form-control-lg form-control-solid" placeholder="" value=""></textarea>
                                    </div>

                                    <!--end::Col-->
                                </div>
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Description</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <textarea id="description" name="description" cols="30" rows="10" class="form-control form-control-lg form-control-solid" placeholder="" value=""></textarea>
                                    </div>

                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Shipping & Returns</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <textarea id="shipping_returns" name="shipping_returns" cols="30" rows="10" class="form-control form-control-lg form-control-solid" placeholder="" value=""></textarea>
                                    </div>

                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Media</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Media"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="hidden" id="media" name="media" value="" />
                                        <div id="image" class="dropzone dz-clickable">
                                            <div class="dz-message needsclick">
                                                <br>Drop files here or click to upload.<br><br>
                                            </div>
                                        </div> <br>
                                        <div class="row" id="product-gallery"></div>
                                    </div>

                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Pricing</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" id="price" name="price" class="form-control form-control-lg form-control-solid" placeholder="Pricing" value="" />
                                        <p class="text-danger mt-2"></p>

                                    </div>

                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Compare At Price</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" id="compare_price" name="compare_price" class="form-control form-control-lg form-control-solid" placeholder="Compare Price" value="" />
                                        <p class="text-danger mt-2"></p>

                                    </div>

                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">SKU(Stock Keeping Unit) & Barcode</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-6">
                                                <input type="text" id="sku" name="sku" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="SKU" value="" />
                                                <p class="text-danger mt-2"></p>

                                            </div>

                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-lg-6 fv-row">
                                                <input type="text" id="barcode" name="barcode" class="form-control form-control-lg form-control-solid" placeholder="Barcode" value="" />
                                                <p class="text-danger mt-2"></p>

                                            </div>

                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Track Quantity</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <!--begin::Options-->
                                        <div class="d-flex align-items-center mt-3">
                                            <!--begin::Option-->
                                            <label class="form-check form-check-custom form-check-inline form-check-solid me-5">
                                                <input type="hidden" name="track_qty" value="No">
                                                <input class="form-check-input" id="track_qty" name="track_qty" checked type="checkbox" value="Yes">
                                                <span class="fw-semibold ps-2 fs-6">Track</span>
                                            </label>
                                            <p class="text-danger mt-2"></p>

                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Quantity</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12">
                                                <input type="text" id="quantity" name="quantity" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Quantity" value="" />
                                                <p class="text-danger mt-2"></p>

                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Product Status</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12">
                                                <select class="form-select form-control-solid" placeholder="" name="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Block</option>
                                                </select>
                                                <p class="text-danger mt-2"></p>

                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--begin::Item-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Product Category</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12">
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
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Product Sub Category</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12">
                                                <select class="form-select form-control-solid" placeholder="" id="sub_category" name="sub_category">
                                                    <option value="">Select a Sub category</option>
                                                </select>
                                                <p class="text-danger mt-2"></p>

                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Item-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Product brand</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12">
                                                <select class="form-select form-control-solid" placeholder="" id="brand" name="brand">
                                                    <option value="">Select a brand</option>
                                                    @if($brands->isNotEmpty())
                                                    @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <p class="text-danger mt-2"></p>

                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--begin::Item-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Featured Product</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12">
                                                <select class="form-select form-control-solid" placeholder="" id="is_featured" name="is_featured">
                                                    <option value="No">No</option>
                                                    <option value="Yes">Yes</option>
                                                </select>
                                                <p class="text-danger mt-2"></p>

                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="mb-5">
                                    <button type="submit" class="btn btn-success me-3">
                                        <span class="indicator-label">Create</span>
                                    </button>
                                    <a href="{{ route('products.index')}}" class="btn btn-light">
                                        <span class="indicator-label">Cancel</span>
                                    </a>
                                </div>
                            </div>

                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <!-- <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset" class="btn btn-light btn-active-light-success me-2">Discard</button>
                                <button type="submit" class="btn btn-success" id="kt_account_profile_details_submit">Save Changes</button>
                            </div> -->
                            <!--end::Actions-->
                        </form>

                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Basic info-->
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
<!--end:::Main-->
@endsection
@section('customJs')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#description').summernote({
            height: 250,
        });
    });
    $(document).ready(function() {
        $('#short_description').summernote({
            height: 250,
        });
    });
    $(document).ready(function() {
        $('#shipping_returns').summernote({
            height: 250,
        });
    });
    $('#title').change(function() {
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

    $('#productform').submit(function(event) {
        event.preventDefault();
        var formArray = $(this).serializeArray();
        // $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{route("products.store")}}',
            type: 'post',
            data: formArray,
            dataType: 'json',
            success: function(response) {
                // $("button[type=submit]").prop('disabled', false);
                if (response["status"] == true) {
                    window.location.href = "{{ route('products.index')}}";
                    $(".error").removeClass('invalid-feedback').html('');
                    $("input[type='text'], select , input[type='number'] ").removeClass('is-invalid');
                } else {
                    var errors = response['errors'];
                    $(".error").removeClass('invalid-feedback').html('');
                    $("input[type='text'], select , input[type='number'] ").removeClass('is-invalid');
                    $.each(errors, function(key, value) {
                        $('#' + key).addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(value);
                    });

                }
            },
            error: function() {
                console.log("Something Went Wrong")
            }
        })
    });


    $('#category').change(function() {
        var category_id = $(this).val();
        $.ajax({
            url: '{{ route("product-subcategories.index") }}',
            type: 'GET',
            data: {
                category_id: category_id
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $("#sub_category").find('option').not(":first").remove();
                $.each(response.subCategories, function(key, item) {
                    $("#sub_category").append(`<option value="${item.id}">${item.name}</option>`);
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    Dropzone.autoDiscover = false;
    const dropzone = new Dropzone("#image", {
        url: "{{ route('temp-images.create') }}",
        maxFiles: 10,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file, response) {
            var html = '<div class="col-md-3 id="image-row-' + response.image_id + '"><div class="card"> <input type="hidden" name="image_array[]" value="' + response.image_id + '" ><img src="' + response.ImagePath + '" class="card-img-top" alt="" style="width: 100px;"><div class="card-body"><a href="javascript:void(0)" onclick="deleteImage(' + response.image_id + ')" class="btn btn-danger">delete</a></div></div></div>';
            $("#product-gallery").append(html);
        },
        complete: function(file) {
            this.removeFile(file);
        }

    });

    function deleteImage(id) {
        $("#image-row-" + id).remove();
    };
</script>
@endsection