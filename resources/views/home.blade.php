@extends('layouts.commonMaster')

@section('title', 'Welcome')

@section('layoutContent')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">

      <div class="card">
        <div class="card-body">

          <div class="app-brand justify-content-center">
            <a href="#" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <defs>
                    <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.3413418 C0.445452254,26.1747181 0.0884951797,28.9408235 1.56381646,31.3049678 C2.83770406,32.5776718 5.20850219,33.3098023 7.09180128,32.5758214 C8.347334,32.0553331 11.4559176,30.0014999 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z" id="path-1"></path>
                    <path d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z" id="path-3"></path>
                    <path d="M7.50063644,21.2294429 L12.2034064,11.2293937 C12.3500014,10.8065333 12.6725198,10.4643627 13.0937968,10.3050871 C13.5204542,10.1432314 13.9220491,10.2722044 14.245239,10.5958293 C17.8988336,15.2308285 17.8998163,16.0754093 16.4957812,16.0754093 C14.9961689,16.0754093 15.1580489,15.2308285 12.245239,10.5958293 C11.9220491,10.2722044 11.5204542,10.1432314 11.0937968,10.3050871 C10.6725198,10.4643627 10.3500014,10.8065333 10.2034064,11.2293937 L5.50063644,21.2294429 C5.16730714,22.0452319 4.55349873,22.4643627 3.90063644,22.4643627 C3.247774,22.4643627 2.63596559,22.0452319 2.30063644,21.2294429 L-2.40340636,11.2293937 C-2.55000136,10.8065333 -2.87251976,10.4643627 -3.2937968,10.3050871 C-3.72045416,10.1432314 -4.12204912,10.2722044 -4.445239,10.5958293 C-7.79883364,15.2308285 -7.79981636,16.0754093 -6.39578118,16.0754093 C-4.89616888,16.0754093 -5.05804888,15.2308285 -2.145239,10.5958293 C-1.82204912,10.2722044 -1.42045416,10.1432314 -0.9937968,10.3050871 C-0.57251976,10.4643627 -0.25000136,10.8065333 -0.10340636,11.2293937 L5.20063644,21.2294429 Z" id="path-4"></path>
                  </defs>
                  <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                      <g id="Icon" transform="translate(27.000000, 15.000000)">
                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                          <mask id="mask-2" fill="white">
                            <use xlink:href="#path-1"></use>
                          </mask>
                          <use fill="#696cff" xlink:href="#path-1"></use>
                          <g id="Path-3" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-3"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                          </g>
                          <g id="Path-4" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-4"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                          </g>
                        </g>
                        <g id="Triangle" transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                          <use fill="#696cff" xlink:href="#path-5"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </span>
              <span class="app-brand-text demo text-body fw-bolder">Encore Event</span>
            </a>
          </div>

          <h4 class="mb-2">Welcome to Encore Event! 🎉</h4>
          <p class="mb-4">Your premier event management platform for Kerala's most memorable celebrations</p>

          <div class="row mb-4">
            <div class="col-12">
              <div class="alert alert-primary" role="alert">
                <h6 class="alert-heading fw-bold mb-1">Event Management Made Easy!</h6>
                <p class="mb-0">From decorations to catering, we provide comprehensive event solutions across all districts of Kerala.</p>
              </div>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-4 mb-3">
              <div class="card text-center">
                <div class="card-body">
                  <i class="bx bx-palette fs-1 text-primary mb-2"></i>
                  <h6 class="card-title">Decorations</h6>
                  <p class="card-text small">Beautiful decorations for every occasion</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card text-center">
                <div class="card-body">
                  <i class="bx bx-food-menu fs-1 text-success mb-2"></i>
                  <h6 class="card-title">Catering</h6>
                  <p class="card-text small">Delicious food for all your guests</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card text-center">
                <div class="card-body">
                  <i class="bx bx-cog fs-1 text-warning mb-2"></i>
                  <h6 class="card-title">Services</h6>
                  <p class="card-text small">Professional event services</p>
                </div>
              </div>
            </div>
          </div>

          <div class="d-grid gap-2">
            <a href="{{ route('admin.login') }}" class="btn btn-primary btn-lg">
              <i class="bx bx-log-in me-2"></i>
              Admin Login
            </a>
            <a href="#" class="btn btn-outline-secondary">
              <i class="bx bx-phone me-2"></i>
              Contact Us
            </a>
          </div>

          <div class="text-center mt-4">
            <p class="text-muted">
              <small>© {{ date('Y') }} Encore Event. All rights reserved.</small>
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
