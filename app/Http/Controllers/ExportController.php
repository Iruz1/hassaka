<?php

namespace App\Http\Controllers;

use App\Exports\InsightsExport;
use App\Http\Requests\ExportRequest;
use App\Models\Insight;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function showExportForm()
    {
        return view('insights.export');
    }

    public function export(ExportRequest $request)
    {
        $filters = $request->validated();

        return Excel::download(
            new InsightsExport($filters),
            'insights_report_' . now()->format('Ymd_His') . '.xlsx'
        );
    }
}
