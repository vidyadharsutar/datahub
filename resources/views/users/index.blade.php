@extends('layouts.app')
@section('title', 'Users Management')

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
                    <form action="{{ route('users.index') }}" method="get" id="form-filter">
                        @csrf
                        <div class="row">
                            <div class="col-md-8  mt-md-0 mt-3">
                                <input value="{{ request('search') }}" type="text" name="search" id="search" class="form-control" placeholder="Search users, Email, or Department" aria-label="Search users">
                            </div>

                            <div class="col-md-2  mt-md-0 mt-3">
                                <select name="roles" id="roles" class="form-select">
                                    <option value="">All Roles</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ request('roles') == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2  mt-md-0 mt-3">
                                <select name="status" id="status" class="form-select">
                                    <option value="">All Statuses</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                        @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="table-users-col">
                                    <div class="avatar">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="user-details">
                                        {{ $user->firstname }} {{ $user->lastname }}<br><span class="email">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->role->name }}</td>
                            <td>{{ $user->department }}</td>
                            <td>Active</td>
                            <td>2023-10-01 12:30:00</td>
                            <td>
                                <button class="transparent-btn btn-user-details">...</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formstoreuser" method="POST" action="{{ route('users.store') }}">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="form-group form-validation-group col-md-6">
                        <label for="firstname" class="col-form-label">First Name:</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="John" data-val="alphabets" title="First Name">
                        <label class="form-label label-error-message form-error"><span class="text-danger d-none"><i class="bi bi-exclamation-circle-fill"></i></span></label>
                    </div>
                    <div class="form-group form-validation-group col-md-6">
                        <label for="lastname" class="col-form-label">Last Name:</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Doe" data-val="alphabets" title="Last Name">
                        <label class="form-label label-error-message form-error"><span class="text-danger d-none"><i class="bi bi-exclamation-circle-fill"></i></span></label>
                    </div>
                </div>
                <div class="form-group form-validation-group">
                    <label for="email" class="col-form-label">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="john.doe@example.com" data-val="email" title="Email">
                    <label class="form-label label-error-message form-error"><span class="text-danger d-none"><i class="bi bi-exclamation-circle-fill"></i></span></label>
                </div>
                <div class="row">
                    <div class="form-group form-validation-group col-md-6">
                        <label for="role_id" class="col-form-label">Role:</label>
                        <select name="role_id" id="role_id" class="form-select" data-val="notempty" title="Role">
                            <option value="">Select</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                        <label class="form-label label-error-message form-error"><span class="text-danger d-none"><i class="bi bi-exclamation-circle-fill"></i></span></label>
                    </div>
                    <div class="mb-3 form-group form-validation-group col-md-6">
                        <label for="department" class="col-form-label">Department:</label>
                        <input type="text" class="form-control" name="department" id="department" placeholder="IT Operations" data-val="alpha_char" title="Department">
                        <label class="form-label label-error-message form-error"><span class="text-danger d-none"><i class="bi bi-exclamation-circle-fill"></i></span></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create User</button>
            </div>
            </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/form-validations/form-validation.js') }}"></script>
<script src="{{ asset('assets/js/helpers/ajax-helper.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#formstoreuser').on('submit', function (e) {
            let isValid = true;
            
            $(this).find("[data-val]").each(function () {
                if (!validateField($(this))) {
                    isValid = false;
                }
            });

            if (!isValid) {
                return false;
            }

            e.preventDefault();

            const formData = new FormData(this)
            sendAjaxRequest({
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
            });
        });

        $('#search').on('keyup blur', function () {
            $('#form-filter').submit();
        });
        $('#roles, #status').on('change', function () {
            $('#form-filter').submit();
        });

    });
</script>
@endpush
