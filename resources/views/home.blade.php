@extends('layouts.company')

@section('content')
<div class="hero-section text-white d-flex align-items-center justify-content-center"
     style="background: linear-gradient(to right, #0056b3, #66d9ff); height: 80vh; position: relative; overflow: hidden;">
    <div class="container text-center animate__animated animate__fadeInDown">
        <h1 class="display-4 fw-bold mb-4">🚀 Attirez les meilleurs talents</h1>
        <p class="lead mb-5">Publiez vos offres de stage ou d'emploi et trouvez le candidat idéal rapidement et efficacement.</p>
        <a href="{{ route('company.offers.create') }}" class="btn btn-lg btn-light shadow px-4 py-2 rounded-3 animate__animated animate__pulse animate__infinite"
           style="font-weight: 600;">🎯 Publier une Offre</a>
    </div>

    {{-- IMAGE DE FOND DÉCORATIVE --}}
    <img src="{{ asset('images/hero-business.png') }}"
         alt="Offres d'emploi"
         class="position-absolute end-0 bottom-0 d-none d-md-block"
         style="max-height: 100%; max-width: 45%; object-fit: cover; opacity: 0.15;">
</div>
@endsection
