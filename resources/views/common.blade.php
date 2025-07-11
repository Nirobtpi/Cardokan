@extends('layout.admin-app')
@section('title_text', 'Admin Profile')
@section('page_title', 'Admin Profile')
@section('content')

<div class="container">
    <div class="row">
        {{-- start change password form --}}
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Change Password</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" id="current_password">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
            </div> <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered" role="table">
                    <thead>
                        <tr>
                            <th style="width: 10px" scope="col">#</th>
                            <th scope="col">Task</th>
                            <th scope="col">Progress</th>
                            <th style="width: 40px" scope="col">Label</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle">
                            <td>1.</td>
                            <td>Update software</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                </div>
                            </td>
                            <td><span class="badge text-bg-danger">55%</span></td>
                        </tr>
                        <tr class="align-middle">
                            <td>2.</td>
                            <td>Clean database</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar text-bg-warning" style="width: 70%"></div>
                                </div>
                            </td>
                            <td> <span class="badge text-bg-warning">70%</span> </td>
                        </tr>
                        <tr class="align-middle">
                            <td>3.</td>
                            <td>Cron job running</td>
                            <td>
                                <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar text-bg-primary" style="width: 30%"></div>
                                </div>
                            </td>
                            <td> <span class="badge text-bg-primary">30%</span> </td>
                        </tr>
                        <tr class="align-middle">
                            <td>4.</td>
                            <td>Fix and squish bugs</td>
                            <td>
                                <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar text-bg-success" style="width: 90%"></div>
                                </div>
                            </td>
                            <td> <span class="badge text-bg-success">90%</span> </td>
                        </tr>
                    </tbody>
                </table>
            </div> <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-end">
                    <li class="page-item"> <a class="page-link" href="#">«</a> </li>
                    <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                    <li class="page-item"> <a class="page-link" href="#">2</a> </li>
                    <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                    <li class="page-item"> <a class="page-link" href="#">»</a> </li>
                </ul>
            </div>
        </div>
</div>

@endsection
@push('js')
<script>
    @foreach($errors -> all() as $error)
    toastr.error('{{ $error }}', 'Error');
    @endforeach

</script>
@endpush
