<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function dashboard()
    {
        $reports = Report::all();
        return view('dashboard_admin', ['reports' => $reports]);
    }
    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'rejection_reason' => 'required_if:status,Rejected|string|max:255',
        ]);

        $report->update($validated);

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
    }
    public function statistikpelaporan()
    {
        $query = Report::query();

        $reportsByYear = $query->select(
            DB::raw('YEAR(distribution_date) as year'),
            DB::raw('COUNT(*) as count')
        )
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();


        $totalReports = $reportsByYear->sum('count');

        return view('statistik_total_laporan', [
            'reportsByYear' => $reportsByYear,
            'totalReports' => $totalReports,
        ]);
    }
    public function statistikpenyaluran()
    {

        $distributionByRegion = Report::select(
            'province',
            'district',
            DB::raw('COUNT(*) as total_distributions')
        )
            ->groupBy('province', 'district')
            ->orderBy('province')
            ->get();

        return view('statistik_total_penyaluran', [
            'distributionByRegion' => $distributionByRegion,
        ]);
    }
    public function statistikpenerima()
    {
        $reportsByProgramYear = Report::select(
            DB::raw('YEAR(distribution_date) as year'),
            'program_name',
            DB::raw('SUM(recipient_count) as total_recipients')
        )
            ->groupBy(DB::raw('YEAR(distribution_date)'), 'program_name')
            ->orderBy('program_name', 'asc')
            ->orderBy(DB::raw('YEAR(distribution_date)'), 'asc')
            ->get();

        $aggregatedData = [];
        foreach ($reportsByProgramYear as $report) {
            $year = (int) $report->year;
            $program = $report->program_name;
            $totalRecipients = (int) $report->total_recipients;

            if (!isset($aggregatedData[$year])) {
                $aggregatedData[$year] = [];
            }

            if (!isset($aggregatedData[$year][$program])) {
                $aggregatedData[$year][$program] = 0;
            }

            $aggregatedData[$year][$program] += $totalRecipients;
        }

        $chartData = [];
        foreach ($aggregatedData as $year => $programs) {
            foreach ($programs as $program => $totalRecipients) {
                if (!isset($chartData[$program])) {
                    $chartData[$program] = [
                        'name' => $program,
                        'data' => []
                    ];
                }

                $chartData[$program]['data'][] = [
                    'year' => $year,
                    'total_recipients' => $totalRecipients
                ];
            }
        }

        return view('statistik_total_penerima', [
            'chartData' => array_values($chartData)
        ]);
    }
}
