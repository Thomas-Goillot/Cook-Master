$(".location").click(function () {
  var idLocation = $(this).data("idlocation");

  const request = new XMLHttpRequest();
  const params = {
    idLocation: idLocation,
  };

  request.open("POST", "../location/getlocationWithView");

  request.onreadystatechange = function () {
    if (request.readyState === 4) {
      document.getElementById("locationCol").innerHTML = request.responseText;
    }
  };

  request.send(JSON.stringify(params));
});



$("#replicate").click(function () {
  const mondayMorningOpening = document.getElementById("opening_hours_morning_Monday").value;
  const mondayMorningClosing = document.getElementById("closing_hours_morning_Monday").value;
  const mondayAfternoonOpening = document.getElementById("opening_hours_afternoon_Monday").value;
  const mondayAfternoonClosing = document.getElementById("closing_hours_afternoon_Monday").value;

  const arrayDays = ["Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

  for (let i = 0; i < arrayDays.length; i++) {
    document.getElementById("opening_hours_morning_" + arrayDays[i]).value = mondayMorningOpening;
    document.getElementById("closing_hours_morning_" + arrayDays[i]).value = mondayMorningClosing;
    document.getElementById("opening_hours_afternoon_" + arrayDays[i]).value = mondayAfternoonOpening;
    document.getElementById("closing_hours_afternoon_" + arrayDays[i]).value = mondayAfternoonClosing;
  }
});