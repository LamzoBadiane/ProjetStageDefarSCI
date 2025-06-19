<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class InterviewController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $now = Carbon::now();

        // Récupère tous les entretiens de l'étudiant
        $interviews = Interview::with(['company', 'offer'])
            ->where('user_id', $userId)
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        // Prochain entretien à venir
        $nextInterview = $interviews->first(function ($i) use ($now) {
            $datetime = Carbon::parse("{$i->date} {$i->time}");
            return $i->status === 'prévu' && $datetime->isFuture();
        });

        return view('student.interviews.index', compact('interviews', 'nextInterview', 'now'));
    }
        public function destroy($id)
    {
        $interview = Interview::findOrFail($id);

        if ($interview->user_id !== Auth::id()) {
            abort(403);
        }

        if (!in_array($interview->status, ['terminé', 'annulé'])) {
            return back()->with('error', '❌ Seuls les entretiens terminés ou annulés peuvent être supprimés.');
        }

        $interview->delete();

        return back()->with('success', '🗑️ Entretien supprimé avec succès.');
    }
}
