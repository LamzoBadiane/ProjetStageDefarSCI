@extends('layouts.sidebar')

@section('content')
<div class="container py-5">
    <h2 class="mb-4"><i class="bi bi-calendar-event"></i> Mes entretiens</h2>

    {{-- Résumé du prochain entretien --}}
    @if($nextInterview)
        @php
            $interviewDateTime = \Carbon\Carbon::parse($nextInterview->date . ' ' . $nextInterview->time);
            $diffInMinutes = now()->diffInMinutes($interviewDateTime, false);
        @endphp

        <div class="alert alert-primary shadow-sm">
            <h5>📌 Prochain entretien prévu :</h5>
            <p>
                <strong>{{ $nextInterview->company->name }}</strong><br>
                <i class="bi bi-calendar"></i> {{ $nextInterview->date }} à {{ $nextInterview->time }}<br>
                <i class="bi bi-briefcase"></i> Poste : {{ $nextInterview->offer->title ?? 'Non précisé' }}<br>
                <i class="bi bi-clock"></i> 
                @if ($diffInMinutes > 15)
                    Dans {{ $interviewDateTime->diffForHumans() }}
                @elseif ($diffInMinutes <= 15 && $diffInMinutes >= -30)
                    🔵 Entretien imminent
                @else
                    ⏱️ Expiré
                @endif
            </p>

            @if($nextInterview->mode === 'en ligne' && $diffInMinutes <= 15 && $diffInMinutes >= -30)
                <a href="{{ $nextInterview->location }}" class="btn btn-success" target="_blank">
                    <i class="bi bi-camera-video"></i> Rejoindre l’entretien
                </a>
            @endif
        </div>
    @endif

    {{-- Tableau des entretiens --}}
    <div class="table-responsive bg-white rounded shadow-sm">
        <table class="table table-bordered align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Entreprise</th>
                    <th>Poste</th>
                    <th>Statut</th>
                    <th>Visio</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($interviews as $interview)
                    <tr>
                        <td>{{ $interview->date }}</td>
                        <td>{{ $interview->time }}</td>
                        <td>{{ $interview->company->name }}</td>
                        <td>{{ $interview->offer->title ?? 'Non précisé' }}</td>
                        <td>
                            <span class="badge 
                                @if($interview->status === 'prévu') bg-primary
                                @elseif($interview->status === 'terminé') bg-success
                                @elseif($interview->status === 'annulé') bg-danger
                                @else bg-secondary @endif">
                                {{ ucfirst($interview->status) }}
                            </span>
                        </td>

                        <td>
                            @if($interview->mode === 'en ligne')
                                <a href="{{ $interview->location }}" target="_blank">
                                    📹 Lien
                                </a>
                            @else
                                Présentiel
                            @endif
                        </td>

                        <td>
                            @if(in_array($interview->status, ['terminé', 'annulé']))
                                <form action="{{ route('student.interviews.destroy', $interview->id) }}" method="POST" onsubmit="return confirm('Supprimer cet entretien ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            @else
                                <span class="text-muted">Non dispo</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Aucun entretien programmé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
