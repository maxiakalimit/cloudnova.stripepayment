<?php
if(!check_bitrix_sessid()) return;
IncludeModuleLangFile(__FILE__);

CModule::IncludeModule("main");
CModule::AddAutoloadClasses(
	'',
	array(
        "cloudnova_stripepayment" => '/bitrix/modules/cloudnova.stripepayment/install/index.php',
	)
);
$cloudnova_model = new cloudnova_stripepayment();

COption::RemoveOption($cloudnova_model->MODULE_ID);
$arDir = array(
    '/bitrix/php_interface/include/sale_payment/stripe',
    '/local/php_interface/include/sale_payment/stripe'
);
foreach ($arDir as $dir) {
    if(is_dir($_SERVER['DOCUMENT_ROOT'].$dir)){
        DeleteDirFilesEx($dir);
    }
}

UnRegisterModule($cloudnova_model->MODULE_ID);

echo CAdminMessage::ShowNote(GetMessage("UNINSTALL_SUCCESS"));