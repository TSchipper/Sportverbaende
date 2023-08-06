<ul class="nav flex-column">
    <li class="nav-item">
        <a ID="navToWilkommen" class="nav-link" href="./index.php">Willkommen</a>
    </li>
    <li class="nav-item">
    <a ID="navToSportverbaende" class="nav-link navItemUnselected" href="./sportverbaende_index.php">Sportverbände</a>
    </li>
    <li class="nav-item">
        <a ID="navToLigen" class="nav-link navItemUnselected" href="./ligen_index.php">Ligen</a>
    </li>
    <li class="nav-item">
    <a ID="navToVereine" class="nav-link navItemUnselected" href="./vereine_index.php">Vereine [Mockup]</a>
    </li>
</ul>

<form action="./sportverbaende_controller.php" method="post">
    <button type="submit" class="btn btn-danger" name="command" value="initDatabase">
        <img class="listIcon" src="./icon/Favorite.png" title="Datenbank zurücksezten">&nbsp;Datenbank zurücksezten
    </button>
</form>