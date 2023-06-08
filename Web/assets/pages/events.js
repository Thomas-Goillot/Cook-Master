/*
Template Name: Opatix - Admin & Dashboard Template
Author: Myra Studio
File: Calendar
*/

!(function ($) {
  "use strict";

  var CalendarPage = function () {};

  (CalendarPage.prototype.init = function () {
    if ($.isFunction($.fn.fullCalendar)) {

      $("#calendar").fullCalendar({
        header: {
          left: "prev,next today",
          center: "title",
          right: "month,basicWeek,basicDay",
        },
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        droppable: true, // this allows things to be dropped onto the calendar !!!
        events: dateEvents,
      });
    } else {
      alert("Calendar plugin is not installed");
    }
  }),
    //init
    ($.CalendarPage = new CalendarPage()),
    ($.CalendarPage.Constructor = CalendarPage);
})(window.jQuery),
  //initializing
  (function ($) {
    "use strict";
    $.CalendarPage.init();
  })(window.jQuery);



//ajax request
$(document).ready(function () {
  $("#EventTemplateId").on("change", function () {
    var templateId = $(this).val();
    const name = $("#EventName");
    const description = $("#EventDescription");
    const price = $("#EventEntryPrice");
    const place = $("#EventPlace");
    $.ajax({
      type: "POST",
      url: "../EventsTemplate/getEventTemplateById",
      data: {
        id_event_template: templateId,
      },
      success: function (msg) {
        var data = JSON.parse(msg);
        name.val(data.name);
        description.val(data.description);
        price.val(data.price);
        place.val(data.place);
      },
    });
  });
});
