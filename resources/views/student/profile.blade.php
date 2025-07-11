@extends('layouts.sidebar')

@section('content')
<style>
    .form-section {
        background: white;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .form-section:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        transform: translateY(-2px);
    }

    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border: 1px solid #e0e6ed;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4a6cf7;
        box-shadow: 0 0 0 0.25rem rgba(74, 108, 247, 0.15);
    }

    .btn-primary {
        background-color: #4a6cf7;
        border: none;
        font-weight: 600;
        font-size: 1rem;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #3a5ce4;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(74, 108, 247, 0.25);
    }

    .profile-avatar {
        width: 180px;
        height: 180px;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .profile-avatar:hover {
        transform: scale(1.05);
    }

    .alert li {
        list-style-type: none;
        padding-left: 1.5rem;
        position: relative;
    }

    .alert li:before {
        content: "❗";
        position: absolute;
        left: 0;
    }

    .section-title {
        color: #2c3e50;
        font-weight: 700;
        position: relative;
        padding-bottom: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .section-title:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 4px;
        background: linear-gradient(90deg, #4a6cf7, #a855f7);
        border-radius: 2px;
    }

    .info-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
    }

    .file-upload {
        position: relative;
        overflow: hidden;
    }

    .file-upload-input {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-upload-label {
        display: block;
        padding: 1rem;
        border: 2px dashed #e0e6ed;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-upload-label:hover {
        border-color: #4a6cf7;
        background-color: rgba(74, 108, 247, 0.05);
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
</style>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="section-title">📝 Mon profil étudiant</h2>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger animate__animated animate__fadeInDown mb-4">
            <strong class="d-flex align-items-center"><i class="bi bi-exclamation-triangle-fill me-2"></i> Veuillez corriger les erreurs suivantes :</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success animate__animated animate__fadeInDown mb-4 d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="info-card text-center">
                <div class="mb-3 mx-auto">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                         alt="Avatar" class="img-fluid rounded-circle profile-avatar animate-float">
                </div>
                <h4 class="mb-1">{{ Auth::user()->first_name }} {{ Auth::user()->name }}</h4>
                <p class="text-muted mb-3">Étudiant</p>

                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#avatarModal">
                        <i class="bi bi-camera-fill me-2"></i>Changer la photo
                    </button>
                </div>
            </div>

            <div class="info-card">
                <h5 class="mb-3"><i class="bi bi-info-circle-fill text-primary me-2"></i>Informations de compte</h5>
                <div class="mb-2">
                    <small class="text-muted">Email</small>
                    <p class="mb-0">{{ Auth::user()->email }}</p>
                </div>
                <div>
                    <small class="text-muted">Date d'inscription</small>
                    <p class="mb-0">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data" class="form-section">
                @csrf

                <h5 class="mb-4"><i class="bi bi-person-lines-fill text-primary me-2"></i>Informations personnelles</h5>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">CIN *</label>
                        <input type="text" name="cin" class="form-control" value="{{ old('cin', $student->cin) }}" required pattern="[0-9]+" title="Chiffres uniquement">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Téléphone *</label>
                        <input type="tel" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Prénom *</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $student->first_name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nom *</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $student->last_name) }}" required>
                    </div>
                </div>

                <h5 class="mb-4"><i class="bi bi-book-half text-primary me-2"></i>Informations académiques</h5>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Université *</label>
                        <input type="text" name="university" class="form-control" value="{{ old('university', $student->university) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Niveau d'étude *</label>
                        <select name="level" class="form-select" required>
                            <option value="Licence 1" {{ old('level', $student->level) == 'Licence 1' ? 'selected' : '' }}>Licence 1</option>
                            <option value="Licence 2" {{ old('level', $student->level) == 'Licence 2' ? 'selected' : '' }}>Licence 2</option>
                            <option value="Licence 3" {{ old('level', $student->level) == 'Licence 3' ? 'selected' : '' }}>Licence 3</option>
                            <option value="Master 1" {{ old('level', $student->level) == 'Master 1' ? 'selected' : '' }}>Master 1</option>
                            <option value="Master 2" {{ old('level', $student->level) == 'Master 2' ? 'selected' : '' }}>Master 2</option>
                            <option value="Doctorat" {{ old('level', $student->level) == 'Doctorat' ? 'selected' : '' }}>Doctorat</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Domaine *</label>
                        <input type="text" name="domain" class="form-control" value="{{ old('domain', $student->domain) }}" required>
                    </div>
                </div>

                <h5 class="mb-4"><i class="bi bi-mortarboard-fill text-primary me-2"></i>Formation et compétences</h5>

                <div class="mb-4">
                    <label class="form-label">Éducation *</label>
                    <textarea name="education" class="form-control" rows="3" required>{{ old('education', $student->education) }}</textarea>
                    <small class="text-muted">Décrivez votre parcours académique</small>
                </div>

                <div class="mb-4">
                    <label class="form-label">Compétences *</label>
                    <textarea name="skills" class="form-control" rows="3" required>{{ old('skills', $student->skills) }}</textarea>
                    <small class="text-muted">Listez vos compétences techniques et professionnelles</small>
                </div>

                <h5 class="mb-4"><i class="bi bi-file-earmark-arrow-up-fill text-primary me-2"></i>Documents</h5>

                <div class="mb-4">
                    <label class="form-label">CV (PDF/DOC) (optionnel)</label>
                    @if($student->cv)
                        <div class="alert alert-light d-flex align-items-center mb-3">
                            <i class="bi bi-file-earmark-text-fill text-primary me-2"></i>
                            <div>
                                <p class="mb-0">CV actuellement téléchargé :</p>
                                <a href="{{ asset('storage/' . $student->cv) }}" target="_blank" class="text-decoration-none">
                                    <strong>Télécharger le fichier</strong>
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="file-upload">
                        <input type="file" name="cv" id="cv" accept=".pdf,.doc,.docx" class="file-upload-input">
                        <label for="cv" class="file-upload-label">
                            <i class="bi bi-cloud-arrow-up fs-1 text-muted mb-2 d-block"></i>
                            <span class="d-block">Glissez-déposez votre fichier ici ou cliquez pour sélectionner</span>
                            <small class="text-muted d-block">Taille maximale : 5 Mo (PDF, DOC, DOCX)</small>
                        </label>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save2-fill me-2"></i> Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Avatar Modal -->
<div class="modal fade" id="avatarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Changer la photo de profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form id="avatarForm" method="POST" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <img id="avatarPreview" src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                             class="img-fluid rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="file-upload">
                        <input type="file" name="avatar" id="avatarInput" accept="image/*" class="file-upload-input">
                        <label for="avatarInput" class="btn btn-outline-primary">
                            <i class="bi bi-image-fill me-2"></i>Choisir une image
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('avatarForm').submit()">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview avatar before upload
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('avatarPreview').src = event.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
@endsection
