<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/catalog.css">
    <script src="/scripts/script.js"></script>
    <script src="/scripts/catalog.js"></script>
    <title>BooxCodex</title>
</head>

<body>
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php';

        $genres = [];
        if ($result = $mysqli->query("SELECT * FROM genres")) {
        while ($q = $result->fetch_assoc()) {
            $genres[] = $q;
        }
        $result->free();
        } else {
            $error = 'Select failed: ' . $mysqli->error;
        }
        
    ?>

    <div onclick="closeNav()" style="min-height: 100vh;">
        <section class="content" id="main" >
            <h1>
                Genres:
            </h1>
            <ul>
                <?php
                    $genre = isset($_GET['genre']) ? trim(urldecode(($_GET['genre']))) : '';
                    echo "<button style='background-color:gray; color:white; border-radius:5px; padding:5px; border: 1px solid black;'>$genre</button>";
                ?>
            </ul>

            <form action="/genres/" method="GET">
                <select name="genre">
                    <?php 
                        foreach ($genres as $g):
                            $genre = h($g['NAME']);
                            if (isset($_GET['genre']) and ($_GET['genre']) === $genre){
                                echo '<option selected value=' . urlencode($genre) . '>' . $genre . '</option>';
                            } else {
                                echo '<option value=' . urlencode($genre) . '>' . $genre . '</option>';
                            }
                        endforeach;
                    ?>
                </select>
                <input type="submit">
            </form>

            <br>
            <table>
            <thead>
                <tr>
                    <th>Book Cover</th><th>Book Title</th><th>Author</th><th>Publication Year</th> <th>Genre</th>
                </tr>
            </thead>

            <?php
                // ---------- Fetch records to display ----------
                $genre = isset($_GET['genre']) ? trim(($_GET['genre'])) : '';
                $genre = urldecode($genre);
                $genre = html_entity_decode($genre, ENT_QUOTES, 'UTF-8');

                $rows = [];

                $stmt = $mysqli->prepare("SELECT b.* FROM books b JOIN book_genres bg ON b.id = bg.book_id JOIN genres g ON bg.genre_id = g.id WHERE g.name = ?");
                $stmt->bind_param("s", $genre);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result) {
                    while ($r = $result->fetch_assoc()) {
                        $rows[] = $r;
                    }
                    $result->free();
                } else {
                    $error = 'Select failed: ' . $mysqli->error;
                }

                $i = 0;
                foreach ($rows as $book):
                    $id = h($book['id']);
                    $tags = [];
                    if ($result = $mysqli->query("SELECT g.name FROM genres g JOIN book_genres bg ON g.id = bg.genre_id WHERE bg.book_id = $id")) {
                    while ($q = $result->fetch_assoc()) {
                        $tags[] = $q;
                    }
                    $result->free();
                    } else {
                    $error = 'Select failed: ' . $mysqli->error;
                    }
                    $cover =  h($book['cover']);
                    $title =  h($book['title']);
                    $author =  h($book['author']);
                    $year =  h($book['year']);
                    $description =  h($book['description']);

                    echo "<tr>";
                    echo "<td class='cover' style='cursor: pointer;' onclick='openView($i)' onmouseleave='closeView($i)'><img src='/catalog/covers/$cover' alt='cover.jpg' height='168'>";
                    echo "<div class='caption'>";
                    echo "<p>$description</p>";
                    echo "</div>";
                    echo "</td>";
                    echo "<td>$title</td> <td>$author</td> <td>$year</td>";
                    echo "<td>";
                    echo "<ul>";
                    foreach ($tags as $tag):
                        $t = h($tag['name']);
                        
                        printf('<a href="/genres/?genre=%s">', urlencode($t));
                        echo "<li>$t</li>";
                        echo "</a>";
                    endforeach;
                    echo "</ul>";
                    echo "</td>";
                    echo "</tr>";
                    $i++;
                endforeach;
            ?>
        </table>
            <?php
                
            ?>
        </section>
    </div>

    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php';
    ?>
</body>