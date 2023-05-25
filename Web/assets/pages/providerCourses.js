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
