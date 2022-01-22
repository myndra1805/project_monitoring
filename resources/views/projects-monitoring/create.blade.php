@extends('layouts.app')

@section('title', 'Create Project Monitoring')

@section('main')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3>Create Project Monitoring</h3>
                <hr>
                <form action="/project-monitoring/create" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="project_name" class="col-sm-2 col-form-label col-form-label-sm">Project
                                    Name</label>
                                <div class="col-sm-10">
                                    <input name="project_name" value="{{ old('project_name') }}"
                                        class="form-control @error('project_name') is-invalid @enderror" id="project_name">
                                    @error('project_name')
                                        <div id="project_name" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="client" class="col-sm-2 col-form-label col-form-label-sm">Client</label>
                                <div class="col-sm-10">
                                    <input name="client" value="{{ old('client') }}"
                                        class="form-control @error('client') is-invalid @enderror" id="client">
                                    @error('client')
                                        <div id="client" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="project_leader" class="col-sm-2 col-form-label col-form-label-sm">Project
                                    Leader</label>
                                <div class="col-sm-10">
                                    <select name="project_leader"
                                        class="form-control @error('project_leader') is-invalid @enderror"
                                        id="project_leader">
                                        <option></option>
                                        @foreach ($users as $i => $user)
                                            <option @if ($user->id == old('project_leader')) selected @endif value="{{ $user->id }}">
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('project_leader')
                                        <div id="project_leader" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="start_date" class="col-sm-2 col-form-label col-form-label-sm">Start
                                    Date</label>
                                <div class="col-sm-10">
                                    <input type="date" name="start_date" value="{{ old('start_date') }}"
                                        class="form-control @error('start_date') is-invalid @enderror" id="start_date">
                                    @error('start_date')
                                        <div id="start_date" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="end_date" class="col-sm-2 col-form-label col-form-label-sm">End Date</label>
                                <div class="col-sm-10">
                                    <input type="date" name="end_date" value="{{ old('end_date') }}"
                                        class="form-control @error('end_date') is-invalid @enderror" id="end_date">
                                    @error('end_date')
                                        <div id="end_date" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="progress" class="col-sm-2 col-form-label col-form-label-sm">Progress</label>
                                <div class="col-sm-10">
                                    <input type="number" max="100" min="0" name="progress" value="{{ old('progress') }}"
                                        class="form-control @error('progress') is-invalid @enderror" id="progress">
                                    @error('progress')
                                        <div id="progress" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary d-flex justify-content-between align-items-center">
                                <i class="fas fa-save mr-2"></i>
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
