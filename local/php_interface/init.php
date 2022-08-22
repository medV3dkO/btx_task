<?
AddEventHandler("iblock", "OnBeforeIBlockElementDelete", Array("MyClass", "OnBeforeIBlockElementDeleteHandler"));
class MyClass {
	function OnBeforeIBlockElementDeleteHandler(&$arFields) {
		if ($arFields["IBLOCK_ID"] == 22) {

			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

			$message = 'Элемент из инфоблока Tasks был удален.';
			mail('marv228@yandex.ru', 'Удаление элемента', $message, $headers);
		}
	}
}
?>