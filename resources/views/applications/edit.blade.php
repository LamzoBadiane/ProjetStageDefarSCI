@extends('layouts.sidebar')

@section('content')
<style>
    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-section {
        background-color: #f8f9fa;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 0 20px rgba(0, 123, 255, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .form-section:hover {
        transform: scale(1.01);
        box-shadow: 0 0 30px rgba(0, 123, 255, 0.2);
    }

    .form-label i {
        margin-right: 5px;
        color: #007bff;
    }

    .btn-group-custom {
        gap: 1rem;
    }

    .btn-outline-custom:hover {
        background-color: #007bff;
        color: #fff;
    }
</style>

<div class="container py-5 fade-in">
    <h2 class="text-primary mb-4">✏️ Modifier ma candidature</h2>

    <p class="text-muted">Vous pouvez un joindre un nouveau fichier.</p>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('applications.update', $application->id) }}" method="POST" enctype="multipart/form-data" class="form-section">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="motivation_file" class="form-label"><i class="bi bi-paperclip"></i> Fichier joint</label>
            @if($application->motivation_file)
                <p>
                    📎 <a href="{{ asset('storage/' . $application->motivation_file) }}" target="_blank" class="text-decoration-underline">Voir le fichier actuel</a>
                </p>
            @endif
            <input type="file" name="motivation_file" class="form-control">
            <small class="text-muted">Formats acceptés : PDF, DOC, DOCX. Taille max : 2 Mo.</small>
        </div>

        <div class="d-flex justify-content-between align-items-center btn-group-custom mt-4">
            <a href="{{ route('applications.show', $application->id) }}" class="btn btn-outline-secondary">
                🔙 Retour
            </a>

            <div>
                <button type="submit" class="btn btn-success">
                    💾 Enregistrer
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
