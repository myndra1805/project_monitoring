@extends('layouts.app')

@section('title', 'Project Leader')

@section('main')
    <div class="container-fluid my-5">
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
                            <h4 class="mb-0">Tabel Manajemen Projek</h4>
                            <a href="/project-leader/create" class="btn btn-primary">Tambah Project Leader</a>
                        </div>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <table style="width: 100%;" id="table_id" class="display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Name</th>
                                    <th>Email</th>
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
    <form action="/project-leader/delete" method="post" id="form-delete">
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
                    ajax: "{{ Url('/project-leader/read') }}",
                    columns: [{
                            "data": null,
                            "sortable": false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1
                            },
                            className: 'text-center font-weight-bold'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            className: 'text-center',
                            orderable: false
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
