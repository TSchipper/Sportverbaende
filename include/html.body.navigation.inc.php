<div class="navigation">
    <ul class="nav flex-column">
        <li class="nav-item">
            <form action="./home.controller.php" method="post">
                <button ID="navToHome" type="submit" class="navItemUnselected" name="command" value="list">
                    Home
                </button>
            </form>
        </li>
        <li class="nav-item">
            <form action="./Sportverband.controller.php" method="post">
                <button ID="navToSportverband" type="submit" class="navItemUnselected" name="command" value="list">
                    Sportverbände
                </button>
            </form>
        </li>
        <li class="nav-item">
            <form action="./liga.controller.php" method="post">
                <button ID="navToLiga" type="submit" class="navItemUnselected" name="command" value="list">
                    Ligen
                </button>
            </form>
        </li>
        <li class="nav-item">
            <form action="./verein.controller.php" method="post">
                <button ID="navToVerein" type="submit" class="navItemUnselected" name="command" value="list">
                    Vereine [Mockup]
                </button>
            </form>
        </li>
        <li class="nav-item">
            <form action="./setup.controller.php" method="post">
                <button ID="navToSetup" type="submit" class="navItemUnselected" name="command" value="list">
                    Setup
                </button>
            </form>
        </li>
    </ul>
</div>