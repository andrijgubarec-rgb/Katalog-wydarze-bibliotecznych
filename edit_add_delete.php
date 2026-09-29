<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja, dodawanie i usuwanie wydarzeń</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edycja, dodawanie i usuwanie wydarzeń</h1>
    <main>
        <header>
            <nav>
                <ul >
                    <li><a href="index.php">Strona główna</a></li>
                    <li><a href="search.php">Wyszukiwanie</a></li>
                    <li><a href="edit_add_delete.php">Edycja, dodawanie i usuwanie</a></li>
                </ul>
            </nav>
        </header>

        <section>
            <ul class="menu-rozwijane">
                <li>
                    <details>
                        <summary>Wydarzenia</summary>
                        <ul>
                            <li><a href="wydarzenia.php">Lista</a></li>
                            <li><a href="events/add.php">Dodawanie</a></li>
                            <li><a href="events/edit.php">Edycja</a></li>
                            <li><a href="events/delete.php">Usuwanie</a></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details>
                        <summary>Sale</summary>
                        <ul>
                            <li><a href="rooms/rooms.php">Lista</a></li>
                            <li><a href="rooms/add.php">Dodawanie</a></li>
                            <li><a href="rooms/edit.php">Edycja</a></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details>
                        <summary>Typy wydarzeń</summary>
                        <ul>
                            <li><a href="event_types/event_types.php">Lista</a></li>
                            <li><a href="event_types/add.php">Dodawanie</a></li>
                            <li><a href="event_types/edit.php">Edycja</a></li>
                        </ul>
                    </details>
                </li>
            </ul>
        </section>
        
    </main>
</body>
</html>