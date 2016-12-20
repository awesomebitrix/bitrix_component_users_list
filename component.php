<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


$active = $arParams['USER_ACTIVE'];
if (!$active) {
    $active = 'Y';
}

$userGroup = [];
if (is_array($arParams['USER_GROUPS'])) {
    $userGroup = $arParams['USER_GROUPS'];
}

$arrProperty = [];
foreach ($arParams['PROPERTY_CODE'] as $val) {
    if (trim($val)) {
        $arrProperty[] = $val;
    }
}

$sortBy1 = 'ID';
if ($arParams['SORT_BY1']) {
    $sortBy1 = $arParams['SORT_BY1'];
}
$sortOrder1 = 'DESC';
if ($arParams['SORT_ORDER1']) {
    $sortOrder1 = $arParams['SORT_ORDER1'];
}
$sortBy2 = 'ID';
if ($arParams['SORT_BY2']) {
    $sortBy2 = $arParams['SORT_BY2'];
}
$sortOrder2 = 'DESC';
if ($arParams['SORT_ORDER2']) {
    $sortOrder2 = $arParams['SORT_ORDER2'];
}
$arrSort = [
    $sortBy1 => $sortOrder1,
    $sortBy2 => $sortOrder2,
];

$arrFilterUser = [
    "ACTIVE"    => $active,
    "GROUPS_ID" => $userGroup
];

$arrParameters = [
    'SELECT' => $arrProperty
];


$arResult['list'] = [];
$objUsers = CUser::GetList($arrSort, $order, $arrFilterUser, $arrParameters);
while ($arr = $objUsers->Fetch()) {
    $arResult['list'][] = $arr;
}
$this->IncludeComponentTemplate();
