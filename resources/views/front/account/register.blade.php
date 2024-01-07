@extends('front.layouts.app')
<link href="{{asset('admin-assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin-assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
@section('content')
<div class="d-flex justify-content-center align-items-center">
    <!--begin::Card-->
    <div class="card rounded-3 w-md-550px">
        <!--begin::Card body-->
        <div class="card-body d-flex flex-column p-10 p-lg-20 pb-lg-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
                <!--begin::Form-->
                <form class="form w-100" name="registrationForm" id="registrationForm" action="" method="post">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-dark fw-bolder mb-3">Sign Up</h1>
                        <!--end::Title-->
                        <!--begin::Subtitle-->
                        <div class="text-gray-500 fw-semibold fs-6">Your Account</div>
                        <!--end::Subtitle=-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Login options-->
                    <!-- <div class="row g-3 mb-9">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-success bg-state-light flex-center text-nowrap w-100">
                                <img alt="Logo" src="admin-assets/media/svg/brand-logos/google-icon.svg" class="h-15px me-3">Sign in with Google</a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-success bg-state-light flex-center text-nowrap w-100">
                                <img alt="Logo" src="admin-assets/media/svg/brand-logos/apple-black.svg" class="theme-light-show h-15px me-3">
                                <img alt="Logo" src="admin-assets/media/svg/brand-logos/apple-black-dark.svg" class="theme-dark-show h-15px me-3">Sign in with Apple</a>
                        </div>
                    </div>
                    <div class="separator separator-content my-14">
                        <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                    </div> -->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input type="text" placeholder="Name" name="name" id="name" autocomplete="off" class="form-control bg-transparent">
                        <p class="text-danger mt-2"></p>
                        <!--end::Email-->
                    </div>
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input type="text" placeholder="Email" name="email" id="email" autocomplete="off" class="form-control bg-transparent">
                        <p class="text-danger mt-2"></p>
                        <!--end::Email-->
                    </div>
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input type="text" placeholder="Phone" name="phone" id="phone" autocomplete="off" class="form-control bg-transparent">
                        <p class="text-danger mt-2"></p>

                        <!--end::Email-->
                    </div>
                    <!--begin::Input group-->
                    <div class="fv-row mb-8" data-kt-password-meter="true">
                        <!--begin::Wrapper-->
                        <div class="mb-1">
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input class="form-control bg-transparent" type="password" id="password" placeholder="Password" name="password" autocomplete="off">
                                <p class="text-danger mt-2"></p>
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                    <i class="bi bi-eye-slash fs-2"></i>
                                    <i class="bi bi-eye fs-2 d-none"></i>
                                </span>
                            </div>
                            <!--end::Input wrapper-->
                            <!--begin::Meter-->
                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                            <!--end::Meter-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Hint-->
                        <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp; symbols.</div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Input group=-->
                    <!--end::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Repeat Password-->
                        <input placeholder="Repeat Password" name="confirm-password" type="password" id="confirm-password" autocomplete="off" class="form-control bg-transparent">
                        <p class="text-danger mt-2"></p>
                        <!--end::Repeat Password-->
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Accept-->
                    <div class="fv-row mb-8">
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="toc" value="1">
                            <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">I Accept the
                                <a href="#" class="ms-1 link-success">Terms</a></span>
                        </label>
                    </div>
                    <!--end::Accept-->
                    <!--begin::Submit button-->
                    <div class="d-grid mb-10">
                        <button type="submit" class="btn btn-success" value="register">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">Sign up</span>
                        </button>
                    </div>
                    <!--end::Submit button-->
                    <!--begin::Sign up-->
                    <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
                        <a href="{{route('account.login')}}" class="link-success fw-semibold">Sign in</a>
                    </div>
                    <!--end::Sign up-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->

            <!--end::Footer-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<div class="mb-5"></div>

@endsection
@section('customJs')
<script src="{{asset('admin-assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('admin-assets/js/scripts.bundle.js')}}"></script>
<script src="{{asset('admin-assets/js/custom/authentication/sign-up/general.js')}}"></script>
<script type="text/javascript">
    $("#registrationForm").submit(function(event) {
        event.preventDefault(); // Empêche le rechargement de la page lors de la soumission du formulaire
        $.ajax({
            url: "{{route('account.processRegister')}}",
            type: 'post',
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response) {
                var errors = response.errors;
                if (Response.status == false) {
                    if (errors.name) {
                        $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
                    } else {
                        $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                    if (errors.email) {
                        $('#email').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email);
                    } else {
                        $('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                    if (errors.password) {
                        $('#password').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.password);
                    } else {
                        $('#password').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                } else {
                    $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $('#password').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    window.location.href = "{{route('account.login')}}"
                }
            },
            error: function(JQXHR, execption) {
                console.log("Something Went Wrong");
            }
        });
    });
</script>
@endsection