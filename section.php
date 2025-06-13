<?php


if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$iblockId = 10; // Замените на свой ID инфоблока

// Получаем SECTION_CODE из URL, например "business"
$sectionCode = $APPLICATION->GetCurDir(); // вернет /news/business/
$sectionCode = trim($sectionCode, "/"); // "news/business"
$parts = explode("/", $sectionCode); // ["news", "business"]
$sectionCode = $parts[1] ?? ""; // "business"

// Получаем ID раздела по коду
$sectionId = 0;
if ($sectionCode) {
    $res = CIBlockSection::GetList(
        [],
        [
            'IBLOCK_ID' => $iblockId,
            'CODE' => $sectionCode,
            'ACTIVE' => 'Y',
        ],
        false,
        ['ID']
    );
    if ($section = $res->Fetch()) {
        $sectionId = $section['ID'];
    }
}

// Создаем глобальный фильтр
global $arrFilter;

if ($sectionId > 0) {
    $arrFilter = [
        'SECTION_ID' => $sectionId,
        'INCLUDE_SUBSECTIONS' => 'Y',
        'ACTIVE' => 'Y',
    ];
} else {
    $arrFilter = ['ACTIVE' => 'Y'];
}

// Подключаем компонент с фильтром по разделу
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "",
    [
        "IBLOCK_ID" => $iblockId,
        "NEWS_COUNT" => "20",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "FILTER_NAME" => "arrFilter",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "360000",
        "INCLUDE_SUBSECTIONS" => "Y",
        "FIELD_CODE" => ["ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE"],
        "PROPERTY_CODE" => [],
        "DETAIL_URL" => "/news/#SECTION_CODE#/#ELEMENT_CODE#/",
        "SET_TITLE" => "Y",
    ]
);
?>
