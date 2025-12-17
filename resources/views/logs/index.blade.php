@extends('layouts.app')
@section('title', 'Activity Logs')
@section('subtitle', 'Track all user actions, uploads, downloads, and system changes in real time.')

@section('content')
    <div class="card section-card">
        <div class="card-body p-0">
            <div class="p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="section-title">All Users</h5>
                        <p class="section-description">Manage and monitor user accounts</p>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">Add User</button>
                    </div>
                </div>
                <div class="users-filter-form mt-3">
                    <form action="#" method="GET">
                        <div class="row">
                            <div class="col-md-8  mt-md-0 mt-3">
                                <input type="text" class="form-control" placeholder="Search users, Email, or Department" aria-label="Search users">
                            </div>

                            <div class="col-md-2  mt-md-0 mt-3">
                                <select name="roles" id="roles" class="form-select">
                                    <option value="">All Roles</option>
                                    <option value="admin">Administrator</option>
                                    <option value="editor">Data Manager</option>
                                    <option value="viewer">Data Analyst</option>
                                </select>
                            </div>

                            <div class="col-md-2  mt-md-0 mt-3">
                                <select name="status" id="status" class="form-select">
                                    <option value="">All Statuses</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">Role</th>
                            <th scope="col">Department</th>
                            <th scope="col">Status</th>
                            <th scope="col">Last Login</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="table-users-col">
                                    <div class="user-avatar">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="user-details">
                                        Jane Doe<br><span class="email">jane.doe@example.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>Admin</td>
                            <td>IT</td>
                            <td>Active</td>
                            <td>2023-10-01 12:30:00</td>
                            <td>
                                <button class="transparent-btn btn-user-details">...</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/form-validations/form-validation.js') }}"></script>
<script src="{{ asset('assets/js/helpers/ajax-helper.js') }}"></script>
@endpush
