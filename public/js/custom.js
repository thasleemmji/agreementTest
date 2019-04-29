var errColor = '#ef190e';//error color
var succColor = '#dadada';//success color
var customMsg = 'Something went wrong';

function notify(msg,type='error') {
    $.toast({text: msg,position: 'bottom-right',icon: type,hideAfter: 3000,stack: 1});
    return true;
}

function ajaxAlert(type,msg) {
    $("#Msg"+type).text(msg);
    $("#Alert"+type).slideDown().delay(3000).slideUp();
    return true;
}

function nullValidate(value,field,msg=customMsg) {
    if(value=='') {
        $("#"+field).css('borderColor',errColor);$("#"+field).focus();
        notify(msg);return false;
    }else {
        $("#"+field).css('borderColor',succColor);return true;
    }  
}