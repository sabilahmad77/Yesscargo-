<?php

namespace App\Exports;

use App\Models\Branch;
use App\Models\BranchClients; 
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class BranchClientsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return BranchClients::all();
    // }

    public function view(): View
    {
        $branches = Branch::where('users_id',Auth::user()->id)->first();
        $data['branchClients'] = BranchClients::where(['branches_id'=> $branches->id, 'status' => 1 ])->get();

        return view('branch.clients.export_excel')->with($data);
    }
}
