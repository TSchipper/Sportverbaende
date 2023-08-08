function isEmpty(value) {
  //https://www.altcademy.com/codedb/examples/check-if-a-value-is-an-empty-function-in-javascript
  return value === undefined || value === null || value === "";
}

function activateDeleteConfirmation($objectID) {
  /*
    $newControls =  '<button ID="confirmationText" type="submit" name="command" value="delete" class="btn btn-light">Soll dieses Objekt gelöscht werden?</button>';
    $newControls += '<button ID="confirmationYes" type="submit" name="command" value="delete" class="btn btn-danger">Ja</button>';
    $newControls += '<button ID="confirmationNo" type="button" name="command" value="delete" class="btn btn-secondary" onClick="deactivateDeleteConfirmation ()">Nein</button>';
    $($newControls).insertAfter("#btnDelete");
    */

  if (!isEmpty($objectID)) {
    $("#objectID").attr("value", $objectID);
  }

  $("#btnDelete").attr("width", "0");
  $("#btnDelete").removeClass("visible").addClass("invisible");
  $("#confirmationButtons").removeClass("invisible").addClass("visible");
}

function deactivateDeleteConfirmation() {
  /*
    $("#confirmationText").remove();
    $("#confirmationYes").remove();
    $("#confirmationNo").remove();
    */
  $("#btnDelete").removeClass("invisible").addClass("visible");
  $("#confirmationButtons").removeClass("visible").addClass("invisible");
}
