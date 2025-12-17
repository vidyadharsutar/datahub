@extends('layouts.app')
@section('title', 'Users Management')
@section('subtitle', 'Manage your personal information, preferences, and access settings.')

@section('content')
<div class="card section-card mt-5">
    <div class="card-body p-0">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="true">Profile Setting</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">Security</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="notification-tab" data-bs-toggle="tab" data-bs-target="#notification" type="button" role="tab" aria-controls="notification" aria-selected="false">Notification</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="preferences-tab" data-bs-toggle="tab" data-bs-target="#preferences" type="button" role="tab" aria-controls="preferences" aria-selected="false">Preferences</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <div class="p-5">
                    <h3>Profile Information</h3>
                    <form action="{{ route('profile.settings') }}" method="post">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstname" value="{{ $user->firstname ?? 'Sarah' }}">
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastname" value="{{ $user->lastname ?? 'Johnson' }}">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email ?? 'Sarah@gmail.com' }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone ?? '+91 98765432' }}" >
                            </div>
                            <div class="col-md-6">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" class="form-control" id="department" name="department" value="{{ $user->department ?? 'HR' }}">
                            </div>
                            <div class="col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-select">
                                    <option value="admin" {{ isset($user->role) && $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                                    <option value="data_manager" {{ isset($user->role) && $user->role == 'data_manager' ? 'selected' : '' }}>Data Manager</option>
                                    <option value="data_analyst" {{ isset($user->role) && $user->role == 'data_analyst' ? 'selected' : '' }}>Data Analyst</option>

                                </select>
                            </div>
                        </div>
                        <hr class="my-5">
                        <h3>Profile Picture</h3>
                        <div class="setting-profile-picture">
                            <div class="user-avatar">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="upload-photo">
                                <div class="upload-btn-wrapper">
                                    <label for="upload" class="btn btn-upload-photo">Upload Photo</label>
                                    <input type="file" id="upload" name="upload" accept="image/*" style="display: none;">
                                    <button type="button" class="btn btn-outline-secondary btn-remove-photo" style="display: none;">Remove</button>
                                </div>
                                <p class="img-upload-info">JPG, GIF or PNG. 1MB max.</p>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div class="d-flex justify-content-end gap-3">
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                <div class="p-5">
                    <h3>Security Settings</h3>
                    <form action="{{ route('profile.security') }}" method="post">
                        @csrf
                        <div class="card mb-3">
                            <div class="setting-justify-card p-3">
                                <div>
                                    <h4 class="m-0">Two-Factor Authentication</h4>
                                    <p class="m-0">Add an extra layer of security to your account</p>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="two_factor_auth" {{ isset($user->two_factor_auth) && $user->two_factor_auth == 1 ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="card p-3 mb-3">
                            <div class="form-group">
                                <label for="session_timeout" class="form-label">Session Timeout</label>
                                <select name="session_timeout" id="session_timeout" class="form-select">
                                    <option value="30" {{ isset($user->session_timeout) && $user->session_timeout == 30 ? 'selected' : '' }}>30 minutes</option>
                                    <option value="10" {{ isset($user->session_timeout) && $user->session_timeout == 10 ? 'selected' : '' }}>10 minutes</option>
                                    <option value="5" {{ isset($user->session_timeout) && $user->session_timeout == 5 ? 'selected' : '' }}>5 minutes</option>
                                </select>
                            </div>
                        </div>

                        <div class="card p-3">
                            <div class="form-group">
                                <label class="form-label">Change Password</label>
                                <input type="password" name="currentpassword" id="currentpassword" class="form-control mb-3" placeholder="Current Password">
                                <input type="password" name="newpassword" id="newpassword" class="form-control mb-3" placeholder="New Password">
                                <input type="password" name="newpassword_confirmation" id="newpassword_confirmation" class="form-control" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-3 mt-5">
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                 <div class="p-5">
                    <h3>Notification Preferences</h3>
                    <form action="profile-settings.html" method="post">
                        <div class="card mb-3">
                            <div class="setting-justify-card p-3">
                                <div>
                                    <h4 class="m-0">Email Notifications</h4>
                                    <p class="m-0">Receive notifications via email</p>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" {{ isset($user->email_notification) && $user->email_notification == 1 ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="setting-justify-card p-3">
                                <div>
                                    <h4 class="m-0">Push Notifications</h4>
                                    <p class="m-0">Receive browser push notifications</p>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" {{ isset($user->push_notification) && $user->push_notification == 1 ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="setting-justify-card p-3">
                                <div>
                                    <h4 class="m-0">SMS Notifications</h4>
                                    <p class="m-0">Receive notifications via SMS</p>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" {{ isset($user->sms_notification) && $user->sms_notification == 1 ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>  
            </div>
            <div class="tab-pane fade" id="preferences" role="tabpanel" aria-labelledby="preferences-tab">
                <div class="p-5">
                    <h3>Profile Information</h3>
                    <form action="profile-settings.html" method="post">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="timezone" class="form-label">Timezone</label>
                                <select name="timezone" id="timezone" class="form-select">
                                    <option value="UTC" {{ isset($user->timezone) && $user->timezone == 'UTC' ? 'selected' : '' }}>UTC</option>
                                    <option value="GMT" {{ isset($user->timezone) && $user->timezone == 'GMT' ? 'selected' : '' }}>GMT</option>
                                    <option value="CST" {{ isset($user->timezone) && $user->timezone == 'CST' ? 'selected' : '' }}>CST</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="language" class="form-label">Language</label>
                                <input type="text" class="form-control" id="language" name="language" value="{{ $user->language ?? 'English' }}">
                            </div>
                        </div>
                    
                        <div class="d-flex justify-content-end gap-3 mt-5">
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/form-validations/form-validation.js') }}"></script>
<script src="{{ asset('assets/js/helpers/ajax-helper.js') }}"></script>
<script>
    $(document).ready(function() {
        $('form').on('submit', function (e) {
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
    });
</script>
@endpush