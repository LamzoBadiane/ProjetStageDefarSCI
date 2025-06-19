@extends('layouts.sidebar')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
<style>
    .profile-card {
        background: linear-gradient(135deg, #4e54c8, #8f94fb);
        color: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        transition: transform 0.4s ease;
    }

    .profile-card:hover {
        transform: translateY(-6px);
    }

    .profile-logo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .info-section {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.05);
        transition: 0.3s ease;
    }

    .info-section:hover {
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }

    .info-title {
        font-size: 1.2rem;
        color: #4e54c8;
        font-weight: bold;
    }

    .info-content {
        font-size: 1rem;
        color: #555;
    }
</style>

<div class="container py-5 animate__animated animate__fadeIn">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10 text-center">
            <div class="profile-card">
                @if($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" class="profile-logo mb-3" alt="Logo">
                @else
                    <img src="https://via.placeholder.com/120" class="profile-logo mb-3" alt="Logo par défaut">
                @endif

                <h2 class="mb-1">{{ $company->name }}</h2>
                <p class="mb-0">{{ $company->sector }}</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="info-section">
                <div class="info-title">📍 Adresse</div>
                <div class="info-content mt-2">
                    {{ $company->address }}<br>
                    {{ $company->city }}, {{ $company->postal_code }}<br>
                    {{ $company->country }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-section">
                <div class="info-title">📧 Contact RH</div>
                <div class="info-content mt-2">
                    <strong>{{ $company->contact_name }}</strong><br>
                    {{ $company->contact_email }}<br>
                    {{ $company->contact_phone }}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="info-section">
                <div class="info-title">🏢 À propos de l’entreprise</div>
                <div class="info-content mt-2">
                    {!! nl2br(e($company->description ?? 'Aucune description disponible.')) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>
</div>
@endsection
