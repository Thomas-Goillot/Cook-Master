function checkRadio(e){
    //check the radio input (it's a child of the element clicked)
    $(e).find('input[type="radio"]').prop("checked", true);
}