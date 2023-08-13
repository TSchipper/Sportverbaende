function isEmpty(value) {
  //https://www.altcademy.com/codedb/examples/check-if-a-value-is-an-empty-function-in-javascript
  return value === undefined || value === null || value === "";
}

function activateDeleteConfirmation($objectID, $DisplayName) {
  if (!isEmpty($objectID)) {
    $("#objectID").attr("value", $objectID);
  }
  $("#spanObjectName").html($DisplayName);
  $("#btnDelete").attr("width", "0");
  $("#btnDelete").removeClass("visible").addClass("invisible");
  $("#confirmationButtons").removeClass("invisible").addClass("visible");
}

function deactivateDeleteConfirmation() {
  $("#btnDelete").removeClass("invisible").addClass("visible");
  $("#confirmationButtons").removeClass("visible").addClass("invisible");
}
