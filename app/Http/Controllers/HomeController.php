<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function addResult()
    {
        $pollingUnitName = DB::table('polling_unit')
            ->select('polling_unit_name', 'polling_unit_id')
            ->get();

        return view('add-result', ['pollingUnitName' => $pollingUnitName]);
    }

    public function storeResult(Request $request)
    {
        $request->validate([
            'polling_unit_uniqueid' => 'required|integer',
            'party_abbreviation' => 'required|string',
            'party_score' => 'required|integer|min:0',
        ]);

        DB::table('announced_pu_results')->insert([
            'polling_unit_uniqueid' => $request->polling_unit_uniqueid,
            'party_abbreviation' => $request->party_abbreviation,
            'party_score' => $request->party_score,
            'entered_by_user' => 1,
            'date_entered' => now(),
            'user_ip_address' => $request->ip(),
        ]);

        return back()->with('message', 'Result uploaded successfully!');
    }

    public function lga()
    {
        $lgas = DB::table('lga')
            ->select('lga_name', 'uniqueid')
            ->get();

        return view('lga', ['lgas' => $lgas]);
    }

    public function lgaResults(Request $request)
    {
        $lgaId = $request->lga_id;

        $lgas = DB::table('lga')
            ->select('lga_name', 'uniqueid')
            ->get();

        $results = DB::table('announced_lga_results')
            ->where('result_id', $lgaId)
            ->select('party_abbreviation', 'party_score')
            ->get();

        return view('lga', [
            'lgas' => $lgas,
            'results' => $results,
            'selectedLGA' => $lgaId
        ]);
    }

    public function home()
    {
        $pollingUnitName = DB::table('polling_unit')
            ->select('polling_unit_name', 'polling_unit_id')
            ->distinct()
            ->get();

        return view('home', ['pollingUnitName' => $pollingUnitName]);
    }

    public function showResults(Request $request)
    {
        $request->validate([
            'polling_unit_id' => 'required|integer',
        ]);

        $pollingUnitId = $request->input('polling_unit_id');

        $results = DB::table('announced_pu_results')
            ->where('polling_unit_uniqueid', $pollingUnitId)
            ->select('party_abbreviation', 'party_score')
            ->get();

        $pu = DB::table('polling_unit')
            ->where('polling_unit_id', $pollingUnitId)
            ->select('polling_unit_name')
            ->first();

        $puName = $pu->polling_unit_name ?? 'Polling Unit';

        $total = $results->sum(function($r) {
            return is_numeric($r->party_score) ? (int)$r->party_score : 0;
        });

        return view('home', [
            'pollingUnitName' => DB::table('polling_unit')->select('polling_unit_name', 'polling_unit_id')->distinct()->get(),
            'results' => $results,
            'selectedPU' => $pollingUnitId,
            'puName' => $puName,
            'total' => $total,
        ]);
    }
}
