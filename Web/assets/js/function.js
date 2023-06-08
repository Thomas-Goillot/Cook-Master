function sendAlert(title, message, type) {
    Swal.fire({
      position: "top-end",
      title: title,
      text: message,
      type: type,
      timer: 4000,
      confirmButtonClass: "btn btn-confirm mt-2",
    });
}

function copyToClipboard(string) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(string).select();
    document.execCommand("copy");
    $temp.remove();
}