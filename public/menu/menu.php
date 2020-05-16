<?php $isParent = isset($category['childrens']) ?>
<li>
    <a href="category/<?= $category['alias'] ?>"><?= $category['title'] ?></a>
    <? if($isParent): ?>
        <ul>
            <?= $this->getMenuHtml($category['childrens']) ?>
        </ul>
    <? endif; ?>
</li>
