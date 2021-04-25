@extends('layouts.nav')

@section('admin_css_script')

    <style>
        table thead tr th {
            width: 150px;
            max-width: 75px;
            min-width: 70px;
            height: 50px;
            border-right: 1px solid #eeeeee;
            text-align: center;
            word-break: keep-all;
            padding: 2px 10px;
            background: skyblue;
        }

        table tbody tr td {
            width: 200px;
            height: 50px;
            border-right: 1px solid #eeeeee;
            text-align: center;
            border-bottom: 1px solid #eeeeee;
            word-break: keep-all;
            padding: 2px 10px;
        }

        .btn-success {
            margin-bottom: 10px;

        }

        .modal-content {
            margin: auto;
            width: 420px;
        }

    </style>

@endsection

@section('admin_users')
    @include('errorsMessages')
    @include('successMessages')
    <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-sm">Add New</button>
    <form action="{{ url('/admin/users') }}">
        <input type="text" name="filters">
        <button type="submit" class="btn btn-primary">查詢</button>
    </form>
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="container">
                        <form action="{{ url('/user/create') }}">
                            @csrf
                            @method('get')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Kent">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role">
                                    <option value="user">user</option>
                                    <option value="admin">admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="123@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="datetime" class="form-control" id="password" name="password"
                                    placeholder="8 charactors at least">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">新增</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table_box_big">
        <div class="table_box">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Updated_at</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
            <div class="table_tbody_box">
                <table>
                    @foreach ($users as $user)
                        <tr>
                            <form action="{{ url('/user', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <th><input type="text" name="id" value="{{ $user->id }}" size="20"></th>
                                <td><input type="text" name="name" value="{{ $user->name }}" size="18"></td>
                                <td><input type="text" name="role" value="{{ $user->role }}" size="18"></td>
                                <td><input type="text" name="email" value="{{ $user->email }}" size="18"></td>
                                <td><input type="text" name="password" value="{{ $user->password }}" size="18"></td>
                                <td><input type="text" name="created_at" value="{{ $user->updated_at }}"
                                        disabled="disabled" size="17"></td>
                                <td><input type="text" name="created_at" value="{{ $user->updated_at }}"
                                        disabled="disabled" size="18"></td>
                                <td><button type="submit" class="btn btn-primary">更新</button></td>
                            </form>
                            <td>
                                <form action="{{ url('/user', ['id' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{ $user->id }}" size="13">
                                    <input type="hidden" name="name" value="{{ $user->name }}" size="13">
                                    <input type="hidden" name="role" value="{{ $user->role }}" size="13">
                                    <input type="hidden" name="email" value="{{ $user->email }}" size="13">
                                    <input type="hidden" name="password" value="{{ $user->password }}"
                                        disabled="disabled" size="13">
                                    <input type="hidden" name="created_at" value="{{ $user->updated_at }}"
                                        disabled="disabled" size="13">
                                    <input type="hidden" name="created_at" value="{{ $user->updated_at }}"
                                        disabled="disabled" size="13">
                                    <button type="submit" class="btn btn-danger">刪除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection
