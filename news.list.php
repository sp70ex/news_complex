<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>


<?php
use Bitrix\Main\Loader;
use Bitrix\Iblock\SectionTable;

if (!empty($arResult["ITEMS"])) {
    $sectionIds = [];

    foreach ($arResult["ITEMS"] as $item) {
        if (!empty($item["IBLOCK_SECTION_ID"])) {
            $sectionIds[] = $item["IBLOCK_SECTION_ID"];
        }
    }

    $sectionIds = array_unique($sectionIds);

    $arResult["SECTIONS"] = [];

    if (!empty($sectionIds)) {
        $res = CIBlockSection::GetList(
            [],
            [
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                'ID' => $sectionIds
            ],
            false,
            ['ID', 'NAME', 'SECTION_PAGE_URL']
        );

        while ($section = $res->GetNext()) {
            $arResult["SECTIONS"][] = $section;
        }
    }
}
?>




