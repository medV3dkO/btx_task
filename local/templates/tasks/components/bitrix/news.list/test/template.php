<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss($this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');
?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<?
$renderImage = CFile::ResizeImageGet(
     $arItem["PREVIEW_PICTURE"],
     Array("width" => 80, "height" => 80),
     BX_RESIZE_IMAGE_EXACT, false
);
?>
<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<main class="cards" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
<div class="card">
				<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img alt="<?=$arItem["NAME"].'" src="'.$renderImage["src"]?>" /></a>
				<?else:?>
                    <?echo '<img alt="'.$arItem["NAME"].'" src="'.$renderImage["src"].'" />';?> 
				<?endif;?>
<div class="text">
<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<h3><?echo $arItem["NAME"]?></h3>
				<?endif;?>
				<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<p><?echo $arItem["PREVIEW_TEXT"];?></p>
		<?endif;?>
	
<div class="votes">Голосов:<?=$arItem['PROPERTIES']['VOTES']['VALUE']?></div>
</div>
</div>
<?endforeach;?>
</main>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>