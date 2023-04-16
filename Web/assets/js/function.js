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