<?php

$movie_id = $_POST["movie_id"];
$ratings = $_POST["ratings"];

$conn = mysqli_connect("localhost","root","","tut");

mysqli_query($conn, "INSERT INTO ratings (movie_id, ratings) VALUES ('$movie_id','$ratings')");

echo "Saved";