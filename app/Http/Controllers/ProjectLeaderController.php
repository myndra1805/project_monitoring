<?php

namespace App\Http\Controllers;

use App\Models\ProjectLeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectLeaderController extends Controller
{
    public function read()
    {
        $project_leader = DB::table('project_leaders')->orderBy('id', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($project_leader)
                ->addColumn('action', function ($row) {
                    return "
                    <div class='d-flex justify-content-center'>
                        <a href='/project-leader/update/" . $row->id . "' class='mx-1 btn btn-success d-flex align-items-center btn-sm'>
                            <i class='fas fa-edit mr-1'></i>
                            Update
                        </a>
                        <button data-id='" . $row->id . "' class='btn d-flex align-items-center btn-sm btn-danger d-flex align-items-center justify-content-center' onclick='destroy(event)'>
                            <i class='fas fa-trash-alt mr-1'></i>
                            Delete
                        </button>
                    </div>";
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return abort(404);
        }
    }

    public function showcCreate()
    {
        return view('project-leader.create');
    }

    public function showUpdate($id)
    {
        $user = ProjectLeader::where('id', $id)->first();
        if(!$user){
            return abort(404);
        }
        return view('project-leader.update', [
            'user' => $user
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:project_leaders']
        ]);

        ProjectLeader::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect('/project-leader')->with('status', 'Data berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email']
        ]);

        $project_leader = ProjectLeader::where('id', $request->id)->first();
        if(!$project_leader){
            return abort(404);
        }   
        if($request->email != $project_leader->email){
            request()->validate([
                'email' => ['unique:project_leaders']
            ]);
        }
        $project_leader->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect('/project-leader')->with('status', 'Data berhasil diubah');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'string', 'max:255'],
        ]);

        $project_leader = ProjectLeader::where('id', $request->id)->first();
        if(!$project_leader){
            return abort(404);
        }   

        $project_leader->delete();

        return redirect('/project-leader')->with('status', 'Data berhasil dihapus');
    }
}
