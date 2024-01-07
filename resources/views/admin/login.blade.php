<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emsi | Sign In</title>
    <link rel="shortcut icon" href="{{ asset('admin-assets/media/logos/emsilogo.png')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('admin-assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('admin-assets/media/auth/bg10.jpeg');
            }

            [data-bs-theme="dark"] body {
                background-image: url('admin-assets/media/auth/bg10-dark.jpeg');
            }
        </style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <!--begin::Aside-->
                <div class="d-flex flex-lg-row-fluid">
                    <!--begin::Content-->
                    <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                        <!--begin::Image-->
                        <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset ('admin-assets/media/logos/logoemsi.png')}}" alt="" />
                        <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset ('admin-assets/media/logos/logoemsi.png')}}" alt="" />
                        <!--end::Image-->
                        <!--begin::Title-->
                        <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">École Marocaine des Sciences de l'Ingénieur</h1>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="text-gray-600 fs-base text-center fw-semibold">un établissement
                            <a href="#" class="opacity-75-hover text-success me-1">d'enseignement supérieur</a>au Maroc spécialisé dans les domaines de l'ingénierie et des sciences,<br />
                            offrant des programmes académiques axés sur l'innovation et l'excellence technologique.
                        </div>
                        <!--end::Text-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--begin::Aside-->
                <!--begin::Body-->
                <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                    <!--begin::Wrapper-->
                    <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                        <!--begin::Content-->
                        <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
                                <!--begin::Form-->
                                <form class="form w-100" id="kt_sign_in_form" action="{{ route('admin.authenticate') }}" method="post">
                                    @csrf
                                    <!--begin::Heading-->
                                    <div class="text-center mb-11">
                                        <!--begin::Title-->
                                        <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                                        <!--end::Title-->
                                        <!--begin::Subtitle-->
                                        <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div>
                                        <!--end::Subtitle=-->
                                    </div>
                                    <!--begin::Heading-->
                                    <!--begin::Login options-->
                                    <div class="row g-3 mb-9">
                                        <!--begin::Col-->
                                        <div class="col-md-6">
                                            <!--begin::Google link=-->
                                            <a href="/connect/google" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-success bg-state-light flex-center text-nowrap w-100">
                                                <img alt="Logo" src="{{ asset('admin-assets/media/svg/brand-logos/google-icon.svg') }}" class="h-15px me-3" />Sign in with Google</a>
                                            <!--end::Google link=-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6">
                                            <!--begin::Google link=-->
                                            <a href="/connect/facebook" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-success bg-state-light flex-center text-nowrap w-100">
                                                <img alt="Logo" src="{{ asset('admin-assets/media/svg/brand-logos/facebook-4.svg') }}" class="theme-light-show h-15px me-3" />
                                                <img alt="Logo" src="{{ asset('admin-assets/media/svg/brand-logos/facebook-4.svg') }}" class="theme-dark-show h-15px me-3" />Sign in with Facebook</a>
                                            <!--end::Google link=-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Login options-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-content my-14">
                                        <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                                    </div>
                                    <!--end::Separator-->
                                    <!--begin::Input group=-->
                                    <div class="fv-row mb-8">
                                        <!--begin::Email-->
                                        <input type="text" value="{{ old('email') }}" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent @error('email') is-invalide @enderror" />
                                        <!--end::Email-->
                                        @error('email')
                                        <div class="text-danger invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Input group=-->
                                    <div class="fv-row mb-3">
                                        <!--begin::Password-->
                                        <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent @error('password') is-invalide @enderror" />
                                        <!--end::Password-->
                                        @error('password')
                                        <div class="text-danger invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--end::Input group=-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                        <div></div>
                                        <!--begin::Link-->
                                        <a href="" class="link-success">Forgot Password ?</a>
                                        <!--end::Link-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Submit button-->
                                    <div class="d-grid mb-10">
                                        <button type="submit" id="kt_sign_in_submit" class="btn btn-success">
                                            <!--begin::Indicator label-->
                                            <span class="indicator-label">Sign In</span>
                                            <!--end::Indicator label-->
                                            <!--begin::Indicator progress-->
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            <!--end::Indicator progress-->
                                        </button>
                                    </div>
                                    <!--end::Submit button-->
                                    <!--begin::Sign up-->
                                    <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
                                        <a href="" class="link-success">Sign up</a>
                                    </div>
                                    <!--end::Sign up-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Footer-->
                            <div class="d-flex flex-stack">
                                <!--begin::Languages-->
                                <!--end::Languages-->
                                <!--begin::Links-->
                                <div class="d-flex fw-semibold text-success fs-base gap-5">
                                    <a href="#" class="text-success">Terms</a>
                                    <a href="#" class="text-success">Plans</a>
                                    <a href="#" class="text-success">Contact Us</a>
                                </div>
                                <!--end::Links-->
                            </div>
                            <!--end::Footer-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Body-->
            </div>
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Authentication - Sign-in-->
    <script>
        let defaultThemeMode = "light";
        let themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <script>
        let hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('admin-assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('admin-assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        $(function() {
            $('.login-mm').on('click', function() {
                getAccount();
            });

            async function getAccount() {
                const accounts = await ethereum.request({
                    method: 'eth_requestAccounts'
                });
                const account = accounts[0];
                console.log(accounts);
            }
        })
    </script>
</body>

</html>