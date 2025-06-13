<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$iblockId = 10;
$sectionCode = $arResult["VARIABLES"]["SECTION_CODE"] ?? '';

$sectionId = 0;
if ($sectionCode) {
    $res = CIBlockSection::GetList([], [
        "IBLOCK_ID" => $iblockId,
        "CODE" => $sectionCode,
        "ACTIVE" => "Y"
    ], false, ["ID"]);
    if ($section = $res->Fetch()) {
        $sectionId = $section["ID"];
    }
}

global $arrFilter;
if ($sectionId > 0) {
    $arrFilter = [
        "SECTION_ID" => $sectionId,
        "INCLUDE_SUBSECTIONS" => "Y",
        "ACTIVE" => "Y"
    ];
} else {
    $arrFilter = ["ACTIVE" => "Y"];
}

// Подключаем список новостей в разделе с фильтром
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "",
    [
        "IBLOCK_ID" => $iblockId,
        "NEWS_COUNT" => 20,
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "FILTER_NAME" => "arrFilter",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => 360000,
        "INCLUDE_SUBSECTIONS" => "Y",
        "FIELD_CODE" => ["ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE"],
        "PROPERTY_CODE" => [],
        "DETAIL_URL" => "/news/#SECTION_CODE#/#ELEMENT_CODE#/",
        "SET_TITLE" => "Y",
    ]
);
?>
