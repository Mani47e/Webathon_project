<form method="GET">
    <input type="text" name="search" placeholder="Search products..." value="<?= $_GET['search'] ?? '' ?>">
    <button type="submit">Search</button>
</form>
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM products WHERE name LIKE '%$search%'";
