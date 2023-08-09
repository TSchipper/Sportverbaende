<div class="navigation">
    <ul class="nav flex-column">
        <li>
            <form action="../../controller/home.php/" method="post">
                <button type="submit" class="btn btn-secondary">
                    Home
                </button>
            </form>
        </li>
        <li>
            <form action="../../controller/sportverband.php/" method="post">
                <button type="submit" class="btn btn-secondary">
                    Sportverbände
                </button>
            </form>
        </li>
        <li>
            <form action="../../controller/liga.php/" method="post">
                <button type="submit" class="btn btn-secondary">
                    Ligen
                </button>
            </form>
        </li>
        <li>
            <form action="../../controller/verein.php/" method="post">
                <button type="submit" class="btn btn-secondary">
                    Vereine
                </button>
            </form>
        </li>
    </ul>

    <form action="../controller/sportverband.php" method="post">
        <button type="submit" class="btn btn-danger" name="command" value="initDatabase">
            <img class="listIcon" src="./icon/Favorite.png" title="Datenbank zurücksezten">&nbsp;Datenbank zurücksezten
        </button>
    </form>
</div>