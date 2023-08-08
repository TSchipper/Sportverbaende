<div class="navigation">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a ID="navToWilkommen" class="nav-link" href="../home/index.php">Willkommen</a>
        </li>
        <li class="nav-item">
            <a ID="navToSportverbaende" class="nav-link navItemUnselected"
                href="../sportverband/index.php">Sportverbände</a>
        </li>
        <li class="nav-item">
            <a ID="navToLigen" class="nav-link navItemUnselected" href="../liga/index.php">Ligen</a>
        </li>
        <li class="nav-item">
            <a ID="navToVereine" class="nav-link navItemUnselected" href="../verein/index.php">Vereine
                [Mockup]</a>
        </li>
    </ul>

    <form action="../../controller/sportverband.php" method="post">
        <button type="submit" class="btn btn-danger" name="command" value="initDatabase">
            <img class="listIcon" src="./icon/Favorite.png" title="Datenbank zurücksezten">&nbsp;Datenbank zurücksezten
        </button>
    </form>
</div>