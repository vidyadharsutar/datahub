@extends('layouts.app')
@section('title', 'Complete Data')
@section('subtitle', 'Manage and download your complete data records.')

@php
$actionbutton = "
<button class='btn btn-primary' type='button' id='requestdownload'>
    <i class='bi bi-download'></i> Request Download
</button>
";
@endphp

@section('content')
<div class="card section-card mt-5">
    <div class="card-body p-0">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <form action="{{ route('complete.data.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="container-fluid py-4">
                <div class="">
                    <h3>Upload New Data</h3>
                    <div data-filename="" class="input-file">
                        <input id="complete_data_file" name="complete_data_file" type="file"
                            accept=".xlsx, .pdf, .csv">
                        <label for="complete_data_file">
                            <div>
                                <i class="bi bi-cloud-upload upload-icon"></i>
                                <h4 class="mb-0 mt-3 title">Drag & drop files <a>here</a></h4>
                                <p class="m-0 description">or click to browse files</p>
                                <button class="btn btn-primary mx-auto my-4" type="button">
                                    Choose file
                                </button>
                                <p class="m-0 description">
                                <p class="m-0 description">Supported formats: CSV, Excel, JSON (Max 10MB)</p>
                                </p>
                            </div>
                        </label>
                    </div>

                    <div class="text-end my-3">
                        <button class='btn btn-primary' type='submit'>
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card section-card mt-5">
    <div class="card-body p-0">
        <div class="container-fluid py-4">
            <div class="">
                <h3>Recent Uploads</h3>
                <p>Manage and download your complete data records.</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Data Name</th>
                            <th scope="col">TYPE</th>
                            <th scope="col">SIZE</th>
                            <th scope="col">DATE</th>
                            <th scope="col">Data Count</th>
                            <th scope="col">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>customer_data_01.xlsx</td>
                            <td>Excel</td>
                            <td>2.5 MB</td>
                            <td>2024-06-15</td>
                            <td>1500</td>
                            <td><span class="badge bg-success">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/form-validations/form-validation.js') }}"></script>
<script src="{{ asset('assets/js/helpers/ajax-helper.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script>
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            let isValid = true;

            $(this).find("[data-val]").each(function() {
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