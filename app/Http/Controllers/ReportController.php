<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        return response()->json(Report::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_name' => 'required|string',
            'recipient_count' => 'required|integer',
            'province' => 'required|string',
            'district' => 'required|string',
            'sub_district' => 'required|string',
            'distribution_date' => 'required|date',
            'evidence' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'notes' => 'nullable|string',
        ]);

        $filePath = $request->file('evidence')->store('evidences');

        $report = Report::create([
            ...$validated,
            'evidence_path' => $filePath,
        ]);

        return response()->json($report, 201);
    }
    public function input()
    {
        $reports = Report::all();
        return view('input', ['reports' => $reports]);
    }
    public function show()
    {
        $reports = Report::all();
        return view('viewdata', ['reports' => $reports]);
    }
    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'rejection_reason' => 'required_if:status,Rejected|string',
        ]);

        $report->update($validated);

        return response()->json(['message' => 'Report updated successfully.']);
    }
    public function edit($id)
    {
        $report = Report::findOrFail($id);

        if ($report->status !== 'Pending') {
            return redirect()->back()->with('error', 'Only pending reports can be edited.');
        }

        return view('edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        if ($report->status !== 'Pending') {
            return redirect()->back()->with('error', 'Only pending reports can be edited.');
        }

        $validated = $request->validate([
            'program_name' => 'required|string',
            'recipient_count' => 'required|integer',
            'province' => 'required|string',
            'district' => 'required|string',
            'sub_district' => 'required|string',
            'distribution_date' => 'required|date',
            'evidence' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'notes' => 'nullable|string',
        ]);

        if ($request->hasFile('evidence')) {

            Storage::delete($report->evidence_path);

            $validated['evidence_path'] = $request->file('evidence')->store('evidences');
        }

        $report->update($validated);

        return redirect()->route('show')->with('success', 'Report updated successfully.');
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        if ($report->status !== 'Pending') {
            return response()->json(['message' => 'Cannot delete verified report.'], 403);
        }

        $report->delete();

        return response()->json(['message' => 'Report deleted successfully.']);
    }
}
