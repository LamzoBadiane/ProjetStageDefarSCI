@extends('admin.layouts.master')

@section('title', 'Tableau de bord')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-speedometer2"></i> Tableau de bord</h3>
        <span class="badge bg-success">Bienvenue {{ auth()->user()->first_name ?? 'Admin' }}</span>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-mortarboard-fill"></i> Étudiants</h5>
                    <p class="card-text fs-4">{{ $students ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-info shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-buildings"></i> Entreprises</h5>
                    <p class="card-text fs-4">{{ $companies ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-briefcase-fill"></i> Offres</h5>
                    <p class="card-text fs-4">{{ $offers ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
