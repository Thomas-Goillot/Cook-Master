$(".location").click(function () {
  var idLocation = $(this).data("idlocation");

  console.log(idLocation);

  const params = {
    idLocation: idLocation,
  };

  request.open("POST", "../location/getlocation");

  request.onreadystatechange = function () {
    if (request.readyState === 4) {
      //get data in json format
      var data = JSON.parse(request.responseText);
      console.log(data);
    }
  };

  request.setRequestHeader("Content-Type", "application/json");
  request.send(JSON.stringify(params));
});
