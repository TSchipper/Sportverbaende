<div class="navigation">
    <ul class="nav flex-column">
        <li>
            <form action="home.controller.php" method="post">
                <button id="navToHome" type="submit" class="btn btn-secondary">
                    Home
                </button>
            </form>
        </li>
        <li>
            <form action="sportverband.controller.php" method="post">
                <button id="navToSportverband" type="submit" class="btn btn-secondary" name="command" value="list">
                    Sportverbände
                </button>
            </form>
        </li>
        <li>
            <form action="liga.controller.php" method="post">
                <button id="navToLiga" type="submit" class="btn btn-secondary" name="command" value="list">
                    Ligen
                </button>
            </form>
        </li>
        <li>
            <form action="verein.controller.php" method="post">
                <button id="navToVerein" type="submit" class="btn btn-secondary" name="command" value="list">
                    Vereine [Mockup]
                </button>
            </form>
        </li>
    </ul>

    <form action="sportverband.php" method="post">
        <button type="submit" class="btn btn-danger" name="command" value="initDatabase">
            <img class="listIcon" src="./icon/Favorite.png" title="Datenbank zurücksezten">&nbsp;Datenbank zurücksezten
        </button>
    </form>
</div>