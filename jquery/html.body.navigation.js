function hilightNavItem(navItemSelected) {
  $("#navToHome").removeClass("navItemSelected").addClass("navItemUnselected");
  $("#navToSportverband")
    .removeClass("navItemSelected")
    .addClass("navItemUnselected");
  $("#navToLiga").removeClass("navItemSelected").addClass("navItemUnselected");
  $("#navToVerein")
    .removeClass("navItemSelected")
    .addClass("navItemUnselected");

  if (navItemSelected == "navToHome") {
    $("#navToHome")
      .removeClass("navItemUnselected")
      .addClass("navItemSelected");
  }
  if (navItemSelected == "navToSportverband") {
    $("#navToSportverband")
      .removeClass("navItemUnselected")
      .addClass("navItemSelected");
  }
  if (navItemSelected == "navToLiga") {
    $("#navToLiga")
      .removeClass("navItemUnselected")
      .addClass("navItemSelected");
  }
  if (navItemSelected == "navToVerein") {
    $("#navToVerein")
      .removeClass("navItemUnselected")
      .addClass("navItemSelected");
  }
  if (navItemSelected == "navToAdministration") {
    $("#navToAdministration")
      .removeClass("navItemUnselected")
      .addClass("navItemSelected");
  }
}
