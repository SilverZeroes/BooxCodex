<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/catalog.css?v=20251120">
    <script src="/scripts/script.js"></script>
    <script src="/scripts/catalog.js"></script>
    <link rel="icon" type="favicon" href="favicon.ico">
    <title>BooxCodex | Catalog</title>
</head>

<body>
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php';
    ?>

    <section class="content" id="main" onclick="closeNav()">

        <form action="/catalog/" method="get" style="width:100%; margin-top: 20px; margin-bottom: 10px;">
            <input type="text" name="search" placeholder="Search..." style="width:90%;" required>
            <select name="search_by">
                <option value="title">
                    Title
                </option>
                <option value="author">
                    Author
                </option>
                <option value="year">
                    Year
                </option>
            </select>
            <button type="submit">🔍</button>
        </form>

        <?php
            $rows = [];
            $query = "SELECT * FROM books;";
            if (isset($_GET['search']) && isset($_GET['search_by'])){
                $search = $_GET['search'];
                $search_by = $_GET['search_by'];

                $allowed_columns = ['title', 'author', 'year'];

                if (!in_array($search_by, $allowed_columns)) {
                    die("Invalid column");
                }

                echo '<h2>Showing results for "' . h($search) . '": </h2>';
                $query = "SELECT * FROM books WHERE $search_by LIKE ? ORDER BY title ASC";
                $stmt = $mysqli->prepare($query);
                $like_value = "%$search%";
                $stmt->bind_param("s", $like_value);
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
                
            }
            else {
                echo "<h2>Here's the full catalog:</h2>";
                //$rows = [];
                if ($result = $mysqli->query($query)) {
                    while ($r = $result->fetch_assoc()) {
                        $rows[] = $r;
                    }
                    $result->free();
                } else {
                    $error = 'Select failed: ' . $mysqli->error;
                }
            }

            
        

            echo "<table>";
            echo "    <thead>";
            echo "        <tr>";
            echo "            <th>Book Cover</th><th>Book Title</th><th>Author</th><th>Publication Year</th> <th>Genre</th>";
            echo "        </tr>";
            echo "    </thead>";


                // ---------- Fetch records to display ----------
                

                $i = 0;
                foreach ($rows as $book):
                    $id = h($book['id'], ENT_QUOTES, 'UTF-8');
                    $tags = [];
                    if ($result = $mysqli->query("SELECT g.name FROM genres g JOIN book_genres bg ON g.id = bg.genre_id WHERE bg.book_id = $id;")) {
                    while ($q = $result->fetch_assoc()) {
                        $tags[] = $q;
                    }
                    $result->free();
                    } else {
                    $error = 'Select failed: ' . $mysqli->error;
                    }
                    $cover = h($book['cover']);
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
                        $t =  h($tag['name']);
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
    </section>

    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
    ?>

</body>