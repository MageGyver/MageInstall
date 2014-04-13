<?php
/**
 * MageGyver/MageInstall
 *
 * Fixes problems while installing Magento CE 1.7.0.2 on PHP 5.5 and MySql 5.6
 *
 * @category    Installer
 * @package     MageGyver
 * @copyright   Copyright (c) 2014 MageGyver. (http://www.magegyver.de)
 * @license     http://creativecommons.org/licenses/by-sa/3.0/  CC-by-sa 3.0
 */
class MageGyver_MageInstall_Model_Installer_Db_Mysql4 extends Mage_Install_Model_Installer_Db_Mysql4
{
    /**
     * Workaround to check supported storage engines is default InnoDB check fails
     *
     * @return boolean
     */
    public function supportEngine()
    {
        if (!($oldInnoDbSupported = parent::supportEngine())) {
            $variables = $this->_getConnection()->fetchPairs('SHOW ENGINES');
            return (isset($variables['InnoDB']) && 'NO' != $variables['InnoDB']);
        }

        return $oldInnoDbSupported;
    }
}
