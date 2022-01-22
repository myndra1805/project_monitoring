<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectLeader;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProjectMonitoringController extends Controller
{
    public function read()
    {
        $project = DB::table('projects')->orderBy('id', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($project)
                ->addColumn('action', function ($row) {
                    return "
                    <div class='d-flex'>
                        <button data-id='" . $row->id . "' class='btn d-flex align-items-center btn-sm btn-danger d-flex align-items-center justify-content-center' onclick='destroy(event)'>
                            <i class='fas fa-trash-alt mr-1'></i>
                            Delete
                        </button>
                        <a href='/project-monitoring/update/" . $row->id . "' class='mx-1 btn btn-success d-flex align-items-center btn-sm'>
                            <i class='fas fa-edit mr-1'></i>
                            Update
                        </a>
                    </div>";
                })
                ->addColumn('progress', function ($row) {
                    if((int)$row->progress == 0){
                        return "
                        <div class='progress'>
                            <div class='progress-bar bg-danger' role='progressbar' style='width: " . $row->progress . "%;' aria-valuenow='" . $row->progress . "' aria-valuemin='0' aria-valuemax='100'>" . $row->progress . "%</div>
                        </div>";
                    } else if((int)$row->progress == 100){
                        return "
                        <div class='progress'>
                            <div class='progress-bar bg-success' role='progressbar' style='width: " . $row->progress . "%;' aria-valuenow='" . $row->progress . "' aria-valuemin='0' aria-valuemax='100'>" . $row->progress . "%</div>
                        </div>";
                    }
                    return "
                    <div class='progress'>
                        <div class='progress-bar' role='progressbar' style='width: " . $row->progress . "%;' aria-valuenow='" . $row->progress . "' aria-valuemin='0' aria-valuemax='100'>" . $row->progress . "%</div>
                    </div>";
                })
                ->addColumn('project_leader', function ($row) {
                    $user = DB::table('project_leaders')->where('id', $row->id_project_leader)->first();
                    if(!$user){
                        $user = [
                            'name' => '',
                            'email' => ''
                        ];
                    }
                    $name = $user->name;
                    str_replace($name, ' ', '+');
                    return "
                    <div class='d-flex align-items-center'>
                        <img class='rounded-circle' src='https://ui-avatars.com/api/?name=" .  $name . "' width='45px' height='45px' alt=''>
                        <div class='text-left ml-2'>
                            <p class='m-0 font-weight-bold'>" . $user->name . "</p>
                            <p class='m-0'>" . $user->email . "</p>
                        </div>
                    </div>";
                })
                ->rawColumns(['progress', 'action', "project_leader"])
                ->make(true);
        } else {
            return abort(404);
        }
    }

    public function showCreate()
    {
        $users = ProjectLeader::all();
        return view('projects-monitoring.create', [
            'users' => $users
        ]);
    }

    public function showUpdate($id)
    {
        $project = Project::where('id', $id)->first();
        if(!$project){
            return abort(404);
        }   
        $users = ProjectLeader::all();
        return view('projects-monitoring.update', [
            'users' => $users,
            'project' => $project
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'project_name' => ['required', 'string', 'max:255'],
            'client' => ['required', 'string', 'max:255'],
            'project_leader' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'string', 'max:255', 'date_format:Y-m-d'],
            'end_date' => ['required', 'string', 'max:255', 'date_format:Y-m-d'],
            'progress' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);
        Project::create([
            'project_name' => $request->project_name,
            'client' => $request->client,
            'id_project_leader' => $request->project_leader,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'progress' => $request->progress,
        ]);
        return redirect('/project-monitoring')->with('status', 'Data berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required', 'string', 'max:255'],
            'project_name' => ['required', 'string', 'max:255'],
            'client' => ['required', 'string', 'max:255'],
            'project_leader' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'string', 'max:255', 'date_format:Y-m-d'],
            'end_date' => ['required', 'string', 'max:255', 'date_format:Y-m-d'],
            'progress' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);
        $project = Project::where('id', $request->id)->first();
        if(!$project){
            return abort(404);
        }   
        $project->update([
            'project_name' => $request->project_name,
            'client' => $request->client,
            'id_project_leader' => $request->project_leader,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'progress' => $request->progress,
        ]);
        return redirect('/project-monitoring')->with('status', 'Data berhasil diubah');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'string', 'max:255'],
        ]);
        $project = Project::where('id', $request->id)->first();
        if(!$project){
            return abort(404);
        }   
        $project->delete();
        return redirect('/project-monitoring')->with('status', 'Data berhasil dihapus');
    }
}
