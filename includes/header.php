<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Blog CMS</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
  <h1>Blog CMS</h1>
  <nav>
    <a href="/public/index.php">Home</a>
    <a href="/public/add.php">Add Post</a>
  </nav>
  <form action="/public/search.php" method="get" role="search">
    <label for="q">Search posts</label>
    <input id="q" name="q" type="search" placeholder="Keyword or author" autocomplete="off">
  </form>
</header>
<main>
