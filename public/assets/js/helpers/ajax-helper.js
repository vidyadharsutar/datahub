function sendAjaxRequest({
    url,
    method = 'POST',
    data = {},
    urltoshow,
    processData,
    contentType,
}) {
    $.ajax({
        url: url,
        method: method,
        data: data,
        processData: processData,
        contentType: contentType,

        beforeSend: function () {
            $('#loadingSpinner').removeClass('d-none');
            $('button, a').addClass('disabled').prop('disabled', true).css('pointer-events', 'none');
        },
        success: function (response) {
            if(response.status === 'success') {
                if (typeof successCallback === 'function') {
                    successCallback(response);
                } else {
                    $('.modal.modal-success .modal-body-desc').html(`<p>${response.message}</p>`);
                    if(urltoshow) {
                        $('.btn-route').attr('href', urltoshow);
                    }
                    $('.modal.modal-success').modal('show');
                }
                $('.form-control, .form-select').val('');
            }else{
                if (typeof errorCallback === 'function') {
                    errorCallback(response);
                } else {
                    $('.modal.modal-failed .modal-body-desc').html(`<p>${response.message}</p>`);
                    $('.modal.modal-failed').modal('show');
                }
            }
        },
        error: function (xhr) {
            const res = xhr.responseJSON || {};
            const status = res.status || 'error';
            const message = res.message || 'Something went wrong.';
            const desc = res.desc || '';
            const data = res.errors || {};

            if (typeof errorCallback === 'function') {
                errorCallback(res);
                return;
            }

            if (xhr.status === 422 && data) {

                const errorList = Object.values(data).flat();
                $('.modal.modal-failed .modal-body-desc').html(`<p class="m-0">${errorList.join('<br>')}</p>`);
            } else {
                $('.modal.modal-failed .modal-body-desc').html(`<p class="m-0">${message}</p>`);
                
            }
            $('.modal.modal-failed').modal('show');
        },
        complete: function () {
            $('#loadingSpinner').addClass('d-none');
            $('button, a').removeClass('disabled').prop('disabled', false).css('pointer-events', '');
        }
    });
}

// Export function if you're using modules (ES6 or bundling with Vite)
window.sendAjaxRequest = sendAjaxRequest;
