<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Wyszukiwanie wydarzeń</h1>
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

        <form method="get" class="search-form">
            <label for="title">Nazwa wydarzenia:</label>
            <input type="text" id="title" name="title">

            <label for="date">Data wydarzenia:</label>
            <input type="date" id="date" name="date">

            <label for="room">Sala:</label>
            <input type="text" id="room" name="room">

            <button type="submit">Szukaj</button>
        </form>

    </main>
</body>
</html>