<?php

/* This file displays a list of links to pages of shirts. It needs to
 * receive the total number of pages ($total_pages) and the current
 * page number ($current_page). It will display all the numbers between
 * 1 and $total_pages, and it will make all but $current_page a link.
 */

?>

<div class="pagination">
    <? for ($i = 1; $i <= $totalPages; $i++) { ?>
        <? if ($currentPage === $i) { ?>
            <span><?= $i ?></span>
        <? } else { ?>
            <a href="./?page=<?= $i ?>"><?= $i ?></a>
        <? } ?>
    <? } ?>
</div>