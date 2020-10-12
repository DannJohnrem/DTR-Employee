@extends('layouts.app')

@section('content')
    <div class="col-md-10 offset-md-1">
        @include('partials.admin.message')
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="align-items-center justify-content-between mb-4">
                            <div class="col-md-8 offset-md-4">
                                <h6 class="m-0 font-weight-bold text-primary">Daily Transcript Record</h6>
                            </div>
                            <br>
                            <div class="col-md-7 offset-md-8">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#importModal">
                                    <i class="fas fa-upload fa-sm text-white-50"></i> Import
                                </button>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#employeeModal">
                                    <i class="fas fa-plus fa-sm text-white-50"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->name }} <span class="float-right">
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal" data-id="{{ $employee->id }}" data-name="{{ $employee->name }}" data-date="{{ $employee->date }}" data-time="{{ $employee->time }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>

                                                    <form action="{{ route('employees.destroy', ['employee' => $employee->id]) }}" method="POST" style="display:inline-block">
                                                        @method('DELETE')
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm btn-delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </span></td>
                                            <td>{{ $employee->date }}</td>
                                            <td>{{ $employee->time }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

     <!-- Import Modal -->
     <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Log</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('employees.import') }}" method="post" id="form-import">
                        @csrf
                        <div class="form-group">
                            <label for="type">Logs</label>
                            <input type="file" class="form-control" id="employees" name="employees">
                            <div class="invalid-feedback" id="employees-feedback"></div>
                        </div>
                        <div class="float-right">
                            <button type="reset" class="btn btn-danger" id="btn-clear">Clear</button>
                            <button type="submit" class="btn btn-primary" id="btn-import">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection

{{-- @push('scripts')
    <script src="{{ asset('js/admin/employee.js') }}"></script>
@endpush --}}
