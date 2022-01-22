@extends('layouts.app')

@section('title', 'Project Monitoring')

@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Tabel Monitoring Projek</h4>
                            <a href="/project-monitoring/create" class="btn btn-primary">Tambah Project</a>
                        </div>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <table style="width: 100%;" id="table_id" class="display responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Client</th>
                                    <th>Project Leader</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Progress</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form delete -->
    <form action="/project-monitoring/delete" method="post" id="form-delete">
        @csrf
        @method('delete')
        <input type="hidden" name="id" id="id-delete">
    </form>
    <!-- /.Form delete -->
@endsection

@section('scripts')
    <script>
        window.addEventListener("DOMContentLoaded", event => {
            $(document).ready(function() {
                const table = $('#table_id').DataTable({
                    responsive: true,
                    processing: true,
                    serverside: true,
                    ajax: "{{ Url('/project-monitoring/read') }}",
                    columns: [{
                            data: 'project_name',
                            name: 'project_name',
                        },
                        {
                            data: 'client',
                            name: 'client',
                        },
                        {
                            data: 'project_leader',
                            name: 'project_leader',
                        },
                        {
                            data: 'start_date',
                            name: 'start_date',
                        },
                        {
                            data: 'end_date',
                            name: 'end_date',
                        },
                        {
                            data: 'progress',
                            name: 'progress',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            className: 'text-center'
                        },
                    ]
                });
            });
        })

        function destroy(event) {
            Swal.fire({
                title: 'Confirm',
                text: 'Kamu ingin menghapus data ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then(response => {
                if (response.isConfirmed) {
                    document.querySelector("#id-delete").value = event.target.dataset.id
                    document.querySelector("#form-delete").submit()
                }
            })
        }
    </script>
@endsection
