<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

class taxcom_core extends CModule
{
    public function __construct()
    {
        if (file_exists(__DIR__ . '/version.php')) {
            $arModuleVersion = [];

            include_once(__DIR__ . '/version.php');

            $this->MODULE_ID           = 'project.core';
            $this->MODULE_VERSION      = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
            $this->MODULE_NAME         = Loc::getMessage('WIZARD_TEST_NAME');
            $this->MODULE_DESCRIPTION  = Loc::getMessage('WIZARD_TEST_DESCRIPTION');
            $this->PARTNER_NAME        = Loc::getMessage('WIZARD_TEST_PARTNER_NAME');
            $this->PARTNER_URI         = Loc::getMessage('WIZARD_TEST_PARTNER_URI');
        }

        return false;
    }

    public function DoInstall()
    {
        global $APPLICATION;

        if (CheckVersion(ModuleManager::getVersion('main'), '14.00.00')) {
            $this->InstallFiles();
            $this->InstallDB();

            ModuleManager::registerModule($this->MODULE_ID);

            $this->InstallEvents();
        } else {
            $APPLICATION->ThrowException(
                Loc::getMessage('WIZARD_TEST_INSTALL_ERROR_VERSION')
            );
        }

        $APPLICATION->IncludeAdminFile(
            Loc::getMessage('WIZARD_TEST_INSTALL_TITLE') . ' "' . Loc::getMessage('WIZARD_TEST_NAME') . '"',
            __DIR__ . '/step.php'
        );

        return false;
    }

    public function InstallFiles()
    {
        return false;
    }

    public function InstallDB()
    {
        return false;
    }

    public function InstallEvents()
    {
        return false;
    }

    public function DoUninstall()
    {
        global $APPLICATION;

        $this->UnInstallFiles();
        $this->UnInstallDB();
        $this->UnInstallEvents();

        ModuleManager::unRegisterModule($this->MODULE_ID);

        $APPLICATION->IncludeAdminFile(
            Loc::getMessage('WIZARD_TEST_UNINSTALL_TITLE') . ' "' . Loc::getMessage('WIZARD_TEST_NAME') . '"',
            __DIR__ . '/unstep.php'
        );

        return false;
    }

    public function UnInstallFiles()
    {
        return false;
    }

    public function UnInstallDB()
    {
        Option::delete($this->MODULE_ID);

        return false;
    }

    public function UnInstallEvents()
    {
        return false;
    }
}
