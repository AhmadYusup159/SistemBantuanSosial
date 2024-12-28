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
    public function dashboard()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $email = session('user_email');

        if (!$email) {
            return redirect()->route('login')->withErrors('You must be logged in to submit a report.');
        }

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

        $validated['email'] = $email;

        $filePath = $request->file('evidence')->store('evidences', 'public');

        $report = Report::create(array_merge($validated, ['evidence_path' => $filePath]));

        return redirect()->route('reports.show');
    }

    public function input()
    {
        $reports = Report::all();
        return view('input', ['reports' => $reports]);
    }
    public function showadmin(Request $request)
    {
        $query = Report::query();

        if ($request->filled('filter_region')) {
            $query->where('province', 'like', '%' . $request->filter_region . '%')
                ->orWhere('district', 'like', '%' . $request->filter_region . '%')
                ->orWhere('sub_district', 'like', '%' . $request->filter_region . '%');
        }

        if ($request->filled('filter_program')) {
            $query->where('program_name', 'like', '%' . $request->filter_program . '%');
        }

        $reports = $query->orderBy('distribution_date', 'desc')->get();

        return view('viewdata', [
            'reports' => $reports,
            'filter_region' => $request->filter_region,
            'filter_program' => $request->filter_program,
        ]);
    }
    public function show(Request $request)
    {
        $query = Report::query();

        $email = session('user_email');
        if ($email) {
            $query->where('email', $email);
        }

        if ($request->filled('filter_region')) {
            $query->where(function ($query) use ($request) {
                $query->where('province', 'like', '%' . $request->filter_region . '%')
                    ->orWhere('district', 'like', '%' . $request->filter_region . '%')
                    ->orWhere('sub_district', 'like', '%' . $request->filter_region . '%');
            });
        }

        if ($request->filled('filter_program')) {
            $query->where('program_name', 'like', '%' . $request->filter_program . '%');
        }

        $reports = $query->orderBy('distribution_date', 'desc')->get();

        return view('viewdata', [
            'reports' => $reports,
            'filter_region' => $request->filter_region,
            'filter_program' => $request->filter_program,
        ]);
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

        $validated['email'] = session('user_email');

        if ($request->hasFile('evidence')) {
            Storage::delete($report->evidence_path);

            $validated['evidence_path'] = $request->file('evidence')->store('evidences', 'public');
        }

        $report->update($validated);

        return redirect()->route('reports.show')->with('success', 'Report updated successfully.');
    }


    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        if ($report->status !== 'Pending') {
            return response()->json(['message' => 'Cannot delete verified report.'], 403);
        }

        $report->delete();

        return redirect()->route('reports.show')->with('success', 'Report deleted successfully.');
    }
}
