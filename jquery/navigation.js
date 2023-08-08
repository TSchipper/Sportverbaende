function hilightNavItem(navItemSelected) {
  //alert (navItemSelected);
  $("#navToWilkommen")
    .removeClass("navItemSelected")
    .addClass("navItemUnselected");
  $("#navToSportverbaende")
    .removeClass("navItemSelected")
    .addClass("navItemUnselected");
  $("#navToLigen").removeClass("navItemSelected").addClass("navItemUnselected");
  $("#navToVereine")
    .removeClass("navItemSelected")
    .addClass("navItemUnselected");

  if (navItemSelected == "navToWilkommen") {
    $("#navToWilkommen")
      .removeClass("navItemUnselected")
      .addClass("navItemSelected");
  } else if (navItemSelected == "navToSportverbaende") {
    $("#navToSportverbaende")
      .removeClass("navItemUnselected")
      .addClass("navItemSelected");
  } else if (navItemSelected == "navToLigen") {
    $("#navToLigen")
      .removeClass("navItemUnselected")
      .addClass("navItemSelected");
  } else if (navItemSelected == "navToVereine") {
    $("#navToVereine")
      .removeClass("navItemUnselected")
      .addClass("navItemSelected");
  }
}
