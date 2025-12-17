function onlyNumberKey(evt){
    let ASCIICode = (evt.which) ? evt.which : evt.keyCode;
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
        evt.preventDefault();
        return false;
    }
    return true;
}

function numbersAlphabets(evt){
    let ASCIICode = (evt.which) ? evt.which : evt.keyCode;
    if ((ASCIICode > 65 && ASCIICode < 90) || (ASCIICode > 97 && ASCIICode < 122) || (ASCIICode > 48 && ASCIICode < 57)) {
        return true;
    }else{
        evt.preventDefault();
        return false;
    }
    
}