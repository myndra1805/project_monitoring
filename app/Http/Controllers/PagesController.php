<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index()
    {
        $total_projek = DB::table('projects')->get();
        $projek_belum_dikerjakan = DB::table('projects')->where('progress', '0')->get();
        $projek_selesai = DB::table('projects')->where('progress', '100')->get();
        $projek_sedang_dikerjakan = DB::table('projects')->where([
            ['progress', '<>' ,'100'],
            ['progress', '<>' ,'0'],
        ])->get();
        return view('index',[
            'total_projek' => count($total_projek),
            'projek_belum_dikerjakan' => count($projek_belum_dikerjakan),
            'projek_selesai' => count($projek_selesai),
            'projek_sedang_dikerjakan' => count($projek_sedang_dikerjakan),
        ]);
    }

    public function project()
    {
        return view('project-monitoring');
    }

    public function project_leader()
    {
        return view('project-leader');
    }
}
