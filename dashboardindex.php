<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="favicon" href="/favicon.ico">
    <link rel="stylesheet" href="/css/index.css?v=20251120">
    <link rel="stylesheet" href="/css/catalog.css?v=20251120">
    <script src="/scripts/script.js"></script>
    <script src="/scripts/catalog.js"></script>
</head>

<body>

    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php';
    ?>

    <div onclick="closeNav()" style="min-height: 100vh;">
        <section class="content" id="main">
            <h1>Dashboard:</h1>

            <br>


            <?php

            if (isset($_GET['delete'])) {
                $del_id = (int) $_GET['delete'];
                if ($del_id >= 0) {
                    $stmt = $mysqli->prepare("DELETE FROM books WHERE id = ?");
                    if ($stmt) {
                        $stmt->bind_param('i', $del_id);
                        if ($stmt->execute()) {
                            $message = 'Book deleted successfully.';
                        } else {
                            $error = 'Delete failed: ' . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        $error = 'Prepare failed: ' . $mysqli->error;
                    }
                } else {
                    $error = 'Invalid id for deletion.';
                }
            }

            $rows = [];
            $query = "SELECT * FROM books;";

            $rows = [];
            if ($result = $mysqli->query($query)) {
                while ($r = $result->fetch_assoc()) {
                    $rows[] = $r;
                }
                $result->free();
            } else {
                $error = 'Select failed: ' . $mysqli->error;
            }

            $size = sizeof($rows);
            echo "<h2>Total Records: $size</h2>";
            echo "<a href='/dashboard/add'><button>Add Record</button></a>";

            echo "<table>";
            echo "    <thead>";
            echo "        <tr>";
            echo "            <th>ID</th><th>Book Cover</th><th>Book Title</th><th>Author</th><th>Publication Year</th> <th>Genre</th> <th>Action</th>";
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
                $title = h($book['title']);
                $author = h($book['author']);
                $year = h($book['year']);
                $description = h($book['description']);

                echo "<tr>";
                echo "<td>$id</td>";
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
                echo "<td> <a href='/dashboard/?delete=" . h($id) . "'><button>Delete</button></a>";
                echo "<a href='/dashboard/modify/?id=" . h($id) . "'><button>Modify</button></td></a>";


                echo "</tr>";
                $i++;
            endforeach;
            ?>
            </table>

        </section>
    </div>


    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
    ?>

</body>

</html>