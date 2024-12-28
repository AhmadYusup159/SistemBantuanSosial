<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;


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
}
