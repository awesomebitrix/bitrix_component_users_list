<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
/** @var array $arCurrentValues */

if (!CModule::IncludeModule('main'))
    return;

/*Список групп*/
$arrGroup = [];
$objGroups = CGroup::GetList($by = 'ID', $order = 'ASC');

while ($arr = $objGroups->Fetch()) {
    $arrGroup[$arr['ID']] = $arr['NAME'];
}

/*сортировка*/
$arSorts = [
    'ASC'  => GetMessage('CP_USERS_LIST_SF__ASC'),
    'DESC' => GetMessage('CP_USERS_LIST_SF__DESC')];
$arSortFields = [
    'ID'          => GetMessage('CP_USERS_LIST_SF__ID'),
    'NAME'        => GetMessage('CP_USERS_LIST_SF__NAME'),
    'LAST_NAME'   => GetMessage('CP_USERS_LIST_SF__LAST_NAME'),
    'ACTIVE_FROM' => GetMessage('CP_USERS_LIST_SF__ACTIVE_FROM'),
    'SORT'        => GetMessage('CP_USERS_LIST_SF__SORT'),
    'TIMESTAMP_X' => GetMessage('CP_USERS_LIST_SF__TIMESTAMP_X')
];

/*Список свойств пользователя*/
$arrUserProperty = [];
$objUserProperty = CUserTypeEntity::GetList(['ID' => 'ASC'], ['ENTITY_ID' => 'USER']);
while ($arr = $objUserProperty->Fetch()) {
    $arrUserProperty[$arr['FIELD_NAME']] = $arr['FIELD_NAME'];
}

$arComponentParameters = [
    'PARAMETERS' => [
        'AJAX_MODE'     => [],
        "USER_ACTIVE"   => [
            "PARENT"  => "BASE",
            "NAME"    => GetMessage("CP_USERS_LIST_USER_ACTIVE_NAME"),
            "TYPE"    => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
        'USER_GROUPS'   => [
            'PARENT'   => 'BASE',
            'NAME'     => GetMessage('CP_USERS_LIST_USER_GROUPS_NAME'),
            'TYPE'     => 'LIST',
            'MULTIPLE' => 'Y',
            'VALUES'   => $arrGroup
        ],
        'SORT_BY1'      => [
            'PARENT'            => 'BASE',
            'NAME'              => GetMessage('CP_USERS_LIST_SORT_BY1_NAME'),
            'TYPE'              => 'LIST',
            'DEFAULT'           => 'ACTIVE_FROM',
            'VALUES'            => $arSortFields,
            'ADDITIONAL_VALUES' => 'Y',
        ],
        'SORT_ORDER1'   => [
            'PARENT'            => 'BASE',
            'NAME'              => GetMessage('CP_USERS_LIST_SORT_ORDER1_NAME'),
            'TYPE'              => 'LIST',
            'DEFAULT'           => 'DESC',
            'VALUES'            => $arSorts,
            'ADDITIONAL_VALUES' => 'Y',
        ],
        'SORT_BY2'      => [
            'PARENT'            => 'BASE',
            'NAME'              => GetMessage('CP_USERS_LIST_SORT_BY2_NAME'),
            'TYPE'              => 'LIST',
            'DEFAULT'           => 'SORT',
            'VALUES'            => $arSortFields,
            'ADDITIONAL_VALUES' => 'Y',
        ],
        'SORT_ORDER2'   => [
            'PARENT'            => 'BASE',
            'NAME'              => GetMessage('CP_USERS_LIST_SORT_ORDER2_NAME'),
            'TYPE'              => 'LIST',
            'DEFAULT'           => 'ASC',
            'VALUES'            => $arSorts,
            'ADDITIONAL_VALUES' => 'Y',
        ],
        'PROPERTY_CODE' => [
            'PARENT'            => 'BASE',
            'NAME'              => GetMessage('CP_USERS_LIST_PROPERTY_CODE_NAME'),
            'TYPE'              => 'LIST',
            'MULTIPLE'          => 'Y',
            'VALUES'            => $arrUserProperty,
            'ADDITIONAL_VALUES' => 'Y',
        ],
        'CACHE_TIME'    => ['DEFAULT' => 36000000],
    ],
];