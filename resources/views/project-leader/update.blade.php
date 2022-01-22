@extends('layouts.app')

@section('title', 'Update Project Leader')

@section('main')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3>Update Project Leader</h3>
                <hr>
                <form action="/project-leader/update" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Name</label>
                                <div class="col-sm-10">
                                    <input name="name" value="{{ $user->name }}"
                                        class="form-control @error('name') is-invalid @enderror" id="name">
                                    @error('name')
                                        <div id="name" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" value="{{ $user->email }}"
                                        class="form-control @error('email') is-invalid @enderror" id="email">
                                    @error('email')
                                        <div id="email" class="invalid-feedback">
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
