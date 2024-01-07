@extends('admin.layouts.app')
<title>Emsi | Category List</title>
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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Category Report</h1>
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
                        <li class="breadcrumb-item text-muted">Category</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::success button-->
                    <a href="{{ route('categories.create')}}" class="btn btn-sm fw-bold btn-success">Create Category</a>
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
                <!--begin::Products-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <form action="" method="get">

                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <a href="{{ route('categories.index') }}" class="btn btn-primary btn-md">Reset</a>
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <input value="{{ Request::get('keyword')}}" type="text" name="keyword" id="keyword" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid ps-14" placeholder="Search Category" style="margin-left: 20px;" />
                                </div>

                                <!--end::Search-->
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->

                            <!--end::Card toolbar-->
                        </div>
                    </form>

                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        @if(session('success'))
                        <div class="alert alert-success" id="successMessage">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_report_customer_orders_table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-center text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px">ID</th>
                                    <th class="min-w-100px">Name</th>
                                    <th class="min-w-100px">Slug</th>
                                    <th class="min-w-100px">Status</th>
                                    <th class="min-w-75px">Action</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-semibold text-gray-600 text-center">
                                @if ($categories->isNotEmpty())
                                @foreach ( $categories as $categorie )
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Customer name=-->
                                    <td class="text-dark text-hover-success">
                                        {{ $categorie->id }}
                                    </td>
                                    <!--end::Customer name=-->
                                    <!--begin::Email=-->
                                    <td class="text-dark text-hover-success">
                                        {{ $categorie->name }}
                                    </td>
                                    <!--end::Email=-->
                                    <!--begin::Status=-->
                                    <td class="text-dark text-hover-success">
                                        {{ $categorie->slug }}
                                    </td>
                                    <!--begin::Status=-->
                                    <!--begin::Status=-->
                                    <td>
                                        @if($categorie->status == 1)
                                        <div class="badge badge-light-success">Active</div>
                                        @else
                                        <div class="badge badge-light-danger">Block</div>
                                        @endif
                                    </td>
                                    <!--begin::Status=-->
                                    <!--begin::actions=-->
                                    <td class="text-dark">
                                        <!-- Modify Button -->
                                        <a href="{{route('categories.edit',$categorie->id)}}" class="btn btn-default btn-sm">
                                            <i class="bi bi-pencil text-primary"></i> <!-- Bootstrap icon for modify -->
                                        </a>
                                        <!-- Delete Button -->
                                        <a href="#" onclick="deleteCategory('{{$categorie->id}}')" class="btn btn-default btn-sm">
                                            <i class="bi bi-trash text-danger"></i> <!-- Bootstrap icon for delete -->
                                        </a>

                                    </td>
                                    <!--end::actions=-->
                                </tr>
                                <!--end::Table row-->
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-dark text-hover-success" colspan="5"> Records Not Found</td>
                                </tr>
                                @endif
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                    <div class="card-footer clearfix">
                        {{ $categories->links() }}
                    </div>
                </div>
                <!--end::Products-->
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
    <!--end:::Main-->
    @endsection
    @section('customJs')
    <script>
        function deleteCategory(id) {
            var url = '{{ route("categories.delete","ID")}}';
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
                            window.location.href = "{{ route('categories.index')}}";
                        }
                    }
                });
            }
        }
    </script>
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 5000);
    </script>
    @endsection