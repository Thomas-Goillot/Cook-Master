document.addEventListener("DOMContentLoaded", function () {
  const courseTypeCheckbox = document.getElementById("course-type");
  const addressFields = document.getElementById("address-fields");

  courseTypeCheckbox.addEventListener("change", function () {
    if (courseTypeCheckbox.checked) {
      addressFields.style.display = "block";
    } else {
      addressFields.style.display = "none";
    }
  });
});
