<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BalanceMutation;
use App\Models\OrganizationBalance;
use Illuminate\Http\Request;

class MutationController extends Controller
{
    public function index(Request $request)
    {
        $query = BalanceMutation::with(['admin', 'request.member'])->orderBy('created_at', 'desc');

        if ($request->filled('jenis')) {
            $query->where('jenis_mutasi', $request->jenis);
        }

        if ($request->filled('sumber')) {
            $query->where('sumber_saldo', $request->sumber);
        }

        $mutasi = $query->paginate(15);

        $saldoKas = OrganizationBalance::getSaldoKas();
        $saldoBank = OrganizationBalance::getSaldoBank();

        return view('admin.mutasi.index', compact('mutasi', 'saldoKas', 'saldoBank'));
    }
}