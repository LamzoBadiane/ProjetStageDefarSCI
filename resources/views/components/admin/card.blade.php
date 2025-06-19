@props(['title', 'value', 'icon' => 'bi-info-circle', 'color' => 'primary'])

<div class="col-lg-3 col-md-4 col-sm-6 d-flex">
    <div class="card shadow-sm w-100 h-100 border-0 animate__animated animate__zoomIn hvr-float">
        <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
            <div class="text-{{ $color }} mb-3" style="font-size: 2.8rem;">
                <i class="bi {{ $icon }}"></i>
            </div>
            <h6 class="card-title text-muted mb-1">{{ $title }}</h6>
            <h3 class="text-dark fw-bold counter mb-0" data-target="{{ $value }}">0</h3>
        </div>
    </div>
</div>
