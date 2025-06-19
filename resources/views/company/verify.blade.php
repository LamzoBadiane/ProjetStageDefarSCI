@extends('layouts.company')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary mb-4"><i class="bi bi-shield-lock"></i> Vérification de votre entreprise</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body">
            <form action="{{ route('company.verification.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">NINEA *</label>
                        <input type="text" name="ninea" class="form-control" value="{{ old('ninea', $company->ninea) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">RCCM *</label>
                        <input type="text" name="rccm" class="form-control" value="{{ old('rccm', $company->rccm) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Adresse *</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $company->address) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Téléphone *</label>
                        <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $company->contact_phone) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email de contact *</label>
                        <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $company->contact_email) }}" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Histoire de l’entreprise *</label>
                        <textarea name="company_story" class="form-control" rows="4" required>{{ old('company_story', $company->company_story) }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Document justificatif (PDF, JPG, PNG) *</label>
                        <input type="file" name="document" class="form-control" required>
                        @if($company->document)
                            <small class="text-muted d-block mt-1">
                                Document actuel :
                                <a href="{{ asset('storage/' . $company->document) }}" target="_blank">📄 Voir</a>
                            </small>
                        @endif
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Soumettre</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
