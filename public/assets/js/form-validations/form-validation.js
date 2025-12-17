var clientid = false;
var campaignidentifier = false;
var clientidvalue = ''; var campaignidentifiervalue = '';

// Global field validator
function validateField($field) {
    const inputType = $field.attr("type");
    const rule = $field.data("val");
    const title = $field.attr("title") || $field.attr("name");

    let value = $field.val() ? $field.val().trim() : "";
    let isValid = true;
    let message = "";

    // Special handling for radios
    if (inputType === "radio" && rule === "radio_required") {
        const groupName = $field.attr("name");
        const selected = $(`input[name="${groupName}"]:checked`).val();

        if (!selected) {
            isValid = false;
            message = `${title} is required!`;
        }
    } 
    else {
        // Regular input validation
        if(rule === 'notempty'){
            if(value === ''){
                isValid = false;
                message = `${title} can't be empty!`;
            }
        }
        
        if (rule === "allow_numbers") {
            if (value === "") {
                isValid = false;
                message = `${title} can't be empty!`;
            } else if (!/^[0-9]+$/.test(value)) {
                isValid = false;
                message = `Please enter a valid ${title}`;
            }
        }

        if (rule === "alpha_space_number") {
            if (value === "") {
                isValid = false;
                message = `${title} can't be empty!`;
            } else if (!/^[A-Za-z0-9][A-Za-z0-9 ,]*$/.test(value)) {
                isValid = false;
                message = `Please enter a valid ${title}`;
            }
        }

        if (rule === "campaign_length") {
            if (value === "") {
                isValid = false;
                message = `${title} can't be empty!`;
            } else if (!/^[0-9]+\s*(year|years|month|months|week|weeks|day|days)$/.test(value)) {
                isValid = false;
                message = `Please enter a valid ${title} (e.g. "3 days", "1 month")`;
            }
        }

        if(rule === 'user_name'){
            if(value === ""){
                isValid = false;
                message = `${title} can't be empty!`;
            }else if (!value.match(/^[a-zA-Z0-9_]+$/)){
                isValid = false;
                message = `Please enter a valid ${title}`;
            }
        }

        if(rule === 'alphabets'){
            if(value === ""){
                isValid = false;
                message = `${title} can't be empty!`;
            }else if (!value.match(/^[a-zA-Z][a-zA-Z\s]*$/)){
                isValid = false;
                message = `Please enter a valid ${title}`;
            }
        }

        if(rule === 'email'){
            if(value === ''){
                isValid = false;
                message = `${title} can't be empty!`;
            }else if (!value.match(/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/)){
                isValid = false;
                message = `Please enter a valid ${title}`;
            }
        }

        if(rule === 'checkMobile'){
            if(value === ''){
                isValid = false;
                message = `${title} can't be empty!`;
            }else if (!value.match(/^[6-9]\d{9}$/)){
                isValid = false;
                message = `Please enter a valid ${title}`;
            }
        }

        if(rule === 'alpha_char'){
            if(value === ''){
                isValid = false;
                message = `${title} can't be empty!`;
            }else if (!value.match(/^(?! )[a-zA-Z0-9_-]+(?: [a-zA-Z0-9_-]+)*(?<! )$/)) {
                isValid = false;
                message = `Please enter a valid ${title}`;
            }
        }

        if (rule === 'allow_numbers') { 
            if (value === '') {
                isValid = false;
                message = `${title} can't be empty!`;
            } else if (!/^[0-9]+$/.test(value)) {
                isValid = false;
                message = `Please enter a valid ${title}`;
            }
        }

        if (rule === 'campaign_length') { 
            if (value === '') {
                isValid = false;
                message = `${title} can't be empty!`;
            } else if (!/^[0-9]+\s*(year|years|month|months|week|weeks|day|days)$/.test(value.trim())) {
                isValid = false;
                message = `Please enter a valid ${title}`;
            }
        }

        if (rule === 'alpha_space_number') {
            if (value === '') {
                isValid = false;
                message = `${title} can't be empty!`;
            } else if (!/^[A-Za-z0-9][A-Za-z0-9 ]*$/.test(value)) {
                isValid = false;
                message = `Please enter a valid ${title}`;
            }
        }

        if (rule === 'multiple_alpha_space_number') {
            if (value === '') {
                isValid = false;
                message = `${title} can't be empty!`;
            } else if (!/^[A-Za-z0-9][A-Za-z0-9 ,]*$/.test(value)) {
                isValid = false;
                message = `Please enter a valid ${title}`;
            }
        }

        if(rule === 'cap_alpha'){
            if(value === ''){
                isValid = false;
                validUniqueIdentifier(clientid,campaignidentifier, clientidvalue = value, campaignidentifiervalue);
                message = `${title} can't be empty!`;
            }else if (!value.match(/^[A-Z]{3}$/)){
                clientid = false;
                validUniqueIdentifier(clientid,campaignidentifier, clientidvalue = value, campaignidentifiervalue);
                isValid = false;
                message = `Please enter a valid ${title}`;
            }else{
                clientid = true;
                validUniqueIdentifier(clientid,campaignidentifier, clientidvalue = value, campaignidentifiervalue);
            }
        }

        if(rule === 'campaign_identifiers'){
            if(value === ''){
                campaignidentifier = false;
                validUniqueIdentifier(clientid,campaignidentifier, clientidvalue, campaignidentifiervalue = value);
                isValid = false;
                message = `${title} can't be empty!`;
            }else if (!value.match(/^VM\d{4,5}FY\d{2}$/)) {
                campaignidentifier = false;
                validUniqueIdentifier(clientid,campaignidentifier, clientidvalue, campaignidentifiervalue = value);
                isValid = false;
                message = `Please enter a valid ${title}`;
            }else{
                campaignidentifier = true;
                validUniqueIdentifier(clientid,campaignidentifier, clientidvalue, campaignidentifiervalue = value);
            }
        }

        // --- Show / hide error ---
        const $errorLabel = $field.closest('.form-validation-group').find('.label-error-message span');
        const $label = $field.closest('.form-validation-group').find('.form-labels');

        if (!isValid) {
            $errorLabel.removeClass('d-none').html(`<i class="bi bi-exclamation-circle-fill"></i> ${message}`);
            $label.addClass('vd-err-color');
            $field.addClass('form-error');
            return false;
        } else {
            $errorLabel.addClass('d-none').text("");
            $label.removeClass('vd-err-color');
            $field.removeClass('form-error');
            return true;
        }

    }

    // --- Show / hide error ---
    const $errorLabel = $field.closest('.form-validation-group').find('.label-error-message span');
    const $label = $field.closest('.form-validation-group').find('.form-labels');

    if (!isValid) {
        $errorLabel.removeClass('d-none').html(`<i class="bi bi-exclamation-circle-fill"></i> ${message}`);
        $label.addClass('vd-err-color');
        $field.addClass('form-error');
        return false;
    } else {
        $errorLabel.addClass('d-none').text("");
        $label.removeClass('vd-err-color');
        $field.removeClass('form-error');
        return true;
    }
}

// Trigger validation on blur/change
$(document).on("blur change", "[data-val]", function () {
    validateField($(this));
});

function validUniqueIdentifier(clientid,campaignidentifier, clientidvalue, campaignidentifiervalue){
    var  uniquidentifier = clientidvalue + '-' + campaignidentifiervalue;
    if(clientid && campaignidentifier){
        $("#gi_unique_identifier").val(uniquidentifier);
    }else{
        $("#gi_unique_identifier").val('');
    }
}




