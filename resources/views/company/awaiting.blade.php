@extends('layouts.company')

@section('content')
<div class="container py-5 text-center">
    <h2 class="text-warning mb-4"><i class="bi bi-clock-history"></i> Compte en attente</h2>
    <p class="lead">⏳ Votre compte est actuellement en cours de vérification.</p>
    <p>Un administrateur examine vos informations. Vous serez notifié une fois que votre profil sera validé.</p>
    <p class="text-muted mt-3">Si vous pensez qu’il s’agit d’une erreur, contactez-nous à <strong>support@jobplatform.sn</strong>.</p>
    <a href="{{ route('company.logout') }}" class="btn btn-outline-secondary mt-4"><i class="bi bi-box-arrow-right"></i> Se déconnecter</a>
</div>
@endsection
