@extends('layouts.company')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-primary fw-bold"><i class="bi bi-patch-question"></i> Vérification de l'entreprise</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="alert alert-info">
        📄 Merci de remplir les informations ci-dessous. Elles seront examinées par l'administrateur pour valider votre compte.
    </div>

    <form action="{{ route('company.verification.submit') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf

        <div class="mb-3">
            <label for="ninea" class="form-label fw-semibold">NINEA <span class="text-danger">*</span></label>
            <input type="text" name="ninea" id="ninea" class="form-control" value="{{ old('ninea', $company->ninea) }}" required>
        </div>

        <div class="mb-3">
            <label for="rccm" class="form-label fw-semibold">RCCM <span class="text-danger">*</span></label>
            <input type="text" name="rccm" id="rccm" class="form-control" value="{{ old('rccm', $company->rccm) }}" required>
        </div>

        <div class="mb-3">
            <label for="company_story" class="form-label fw-semibold">Histoire de l'entreprise <span class="text-danger">*</span></label>
            <textarea name="company_story" id="company_story" rows="5" class="form-control" required>{{ old('company_story', $company->company_story) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="document" class="form-label fw-semibold">Document justificatif (PDF ou image) <span class="text-danger">*</span></label>
            @if($company->document)
                <p class="mb-2">📎 Document déjà envoyé :
                    <a href="{{ asset('storage/' . $company->document) }}" target="_blank" class="btn btn-sm btn-outline-primary">Voir le fichier</a>
                </p>
            @endif
            <input type="file" name="document" id="document" class="form-control" accept=".pdf,.png,.jpg,.jpeg" {{ $company->document ? '' : 'required' }}>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Soumettre pour vérification</button>
        </div>
    </form>
</div>
@endsection
