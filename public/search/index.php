<? require_once '../include/config.php';

/* This file contains instructions for three different states of the form:
 *   - Displaying the initial search form
 *   - Handling a form submission and ...
 *       - ... displaying the results if matches are found.
 *       - ... displaying a "no results found" message if necessary.
 */

// if a non-blank search term is specified in
// the query string, perform a search
$searchTerm = isset($_GET['s']) ? trim($_GET['s']) : '';
$products = '';
if ($searchTerm) {
    require_once ROOT_PATH . 'include/products.php';
    $products = getProductsSearch($searchTerm);
}

$pageTitle = 'Search';
$section = 'search';

include ROOT_PATH . 'include/header.php'; ?>

    <div class="section shirts search page">
        <div class="wrapper">
            <h1><?= $pageTitle ?></h1>

            <form method="get" action="">
                <input type="search" name="s" value="<?= $searchTerm ? htmlspecialchars($searchTerm) : '' ?>">
                <input type="submit" value="Go">
            </form>

            <? if ($searchTerm) {
                if ($products) {
                    include ROOT_PATH . 'include/partials/partial-list.html.php';
                } else { ?>
                    <p>No products were found</p>
                <? }
            } ?>

        </div>
    </div>

<? include ROOT_PATH . 'include/footer.php'; ?>