<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php foreach ($arResult["ITEMS"] as $arItem): ?>
    <div class="article-card">
        <div class="article-card__title"><?= $arItem["NAME"] ?></div>
        <div class="article-card__date"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></div>
        <div class="article-card__content">
            <?php if ($arItem["PREVIEW_PICTURE"]): ?>
                <div class="article-card__image sticky">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" />
                </div>
            <?php endif; ?>
            <div class="article-card__text">
                <div class="block-content" data-anim="anim-3">
                    <?= $arItem["PREVIEW_TEXT"] ?>
                </div>
                <a class="article-card__button" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">Подробнее</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
