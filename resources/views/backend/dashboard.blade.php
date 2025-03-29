@extends('backend.layout')
@section('content')
<div class="body-wrapper-inner">
  <div class="container-fluid">
    <!--  Row 1 -->


    <div class="row">
      <div class="col-lg-4">
        <div class="card bg-info-subtle shadow-none w-100">
          <div class="card-body">
            <div class="d-flex mb-10 pb-1 justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-6">
                <h4 class="mb-0 fw-bold text-muted">
                  Tools
                  </h6>
              </div>

            </div>
            <div class="row align-items-end justify-content-between">
              <div class="col-12">
                <h2 class="mb-6 fs-8">{{ $tools }}</h2>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card bg-info-subtle shadow-none w-100">
          <div class="card-body">
            <div class="d-flex mb-10 pb-1 justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-6">
                <h4 class="mb-0 fw-bold text-muted">
                  Tool Views
                  </h6>
              </div>

            </div>
            <div class="row align-items-end justify-content-between">
              <div class="col-12">
                <h2 class="mb-6 fs-8">{{ $toolsViews }}</h2>
              </div>

            </div>
          </div>
        </div>
      </div>
      {{-- <div class="col-lg-4">
        <div class="card bg-primary-subtle shadow-none w-100">
          <div class="card-body">
            <div class="d-flex mb-10 pb-1 justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-6">
                <div
                  class="rounded-circle-shape bg-primary px-3 py-2 rounded-pill d-inline-flex align-items-center justify-content-center">
                  <iconify-icon icon="fa6-brands:bitcoin" class="fs-7 text-white"></iconify-icon>
                </div>
                <h6 class="mb-0 fs-4 fw-medium text-muted">
                  Total Currencies
                </h6>
              </div>

            </div>
            <div class="row align-items-end justify-content-between">
              <div class="col-12">
                <h2 class="mb-6 fs-8">54</h2>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card bg-success-subtle shadow-none w-100">
          <div class="card-body">
            <div class="d-flex mb-10 pb-1 justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-6">
                <div
                  class="rounded-circle-shape bg-success px-3 py-2 rounded-pill d-inline-flex align-items-center justify-content-center">
                  <iconify-icon icon="solar:card-transfer-bold-duotone" class="fs-7 text-white"></iconify-icon>
                </div>
                <h6 class="mb-0 fs-4 fw-medium text-muted">
                  Total Coins
                </h6>
              </div>
            </div>
            <div class="row align-items-end justify-content-between">
              <div class="col-12">
                <h2 class="mb-6 fs-8">56</h2>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
    </div>

    
    <div class="py-6 px-6 text-center">
      <p class="mb-0 fs-4">Design and Developed by Rana Sikander</p>
    </div>
  </div>
</div>


@endsection