<?php

namespace App\Http\Controllers;

use App\Models\Decision;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DecisionController extends Controller
{
    public function downloadPdf(Decision $decision)
    {
        // Authorization check logic - assuming basic auth check for user ownership
        if ($decision->user_id !== auth()->id()) {
            abort(403);
        }

        $parsedResponse = json_decode($decision->ai_response, true);
        
        // Handle fallback if JSON is invalid
        if (json_last_error() !== JSON_ERROR_NONE) {
            $parsedResponse = ['summary' => $decision->ai_response];
        }

        $pdf = Pdf::loadView('pdf.decision-pdf', [
            'decision' => $decision,
            'parsedResponse' => $parsedResponse
        ]);

        return $pdf->download(str()->slug($decision->main_purpose) . '-report.pdf');
    }
}
