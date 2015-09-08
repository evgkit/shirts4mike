<div class="pagination">
    <? for ($i = 1; $i <= $totalPages; $i++) { ?>
        <? if ($currentPage === $i) { ?>
            <span><?= $i ?></span>
        <? } else { ?>
            <a href="./?page=<?= $i ?>"><?= $i ?></a>
        <? } ?>
    <? } ?>
</div>