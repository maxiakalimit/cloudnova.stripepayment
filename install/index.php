<?php
IncludeModuleLangFile(__FILE__);

if(class_exists("cloudnova_stripepayment")) return;

Class cloudnova_stripepayment extends CModule
{
    var $MODULE_ID = "cloudnova.stripepayment";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_GROUP_RIGHTS = "Y";

    public function __construct()
    {
        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        $arModuleVersion = include($path."/version.php");
        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)){
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        } else {
            $this->MODULE_VERSION = '1.4.0';
            $this->MODULE_VERSION_DATE = '2023-08-02 00:00:01';
        }
        $this->MODULE_NAME = GetMessage("CLOUDNOVA_MODULE_NAME_STRIPE");
        $this->MODULE_DESCRIPTION = GetMessage("CLOUDNOVA_MODULE_DESCRIPTION_STRIPE");
        $this->PARTNER_NAME = "cloudnova";
        $this->PARTNER_URI = "https://cloudnova.ru/";
    }

    public function DoInstall()
    {
        global $APPLICATION;
        if(!check_bitrix_sessid()) return;
        $APPLICATION->IncludeAdminFile(GetMessage("STEP1"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/step1.php");
    }

    public function DoUninstall()
    {
        global $APPLICATION;
        if(!check_bitrix_sessid()) return;
        $APPLICATION->IncludeAdminFile(GetMessage("UNSTEP1"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/unstep1.php");
    }
}
