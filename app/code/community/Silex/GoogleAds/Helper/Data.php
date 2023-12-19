<?php

/**
 * Class Silex_GoogleAds_Helper_Data
 *
 * Translation and default helper
 */
class Silex_GoogleAds_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_ACTIVE = 'google/googleads/active';
    const XML_PATH_ACCOUNT = 'google/googleads/account_number';
    const XML_PATH_DEBUG = 'google/googleads/debug_mode';

    /**
     * Check if Google Ads is enabled
     *
     * @param mixed $store
     *
     * @return bool
     */
    public function isEnabled($store = null)
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ACTIVE, $store);
    }

    /**
     * Returns Google Ads account number
     *
     * @param mixed $store
     *
     * @return string
     */
    public function getAccountNumber($store = null)
    {
        return Mage::getStoreConfig(self::XML_PATH_ACCOUNT, $store);
    }

    /**
     * Check if debug mode is enabled
     *
     * @param mixed $store
     *
     * @return bool
     */
    public function isDebugMode($store = null)
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_DEBUG, $store);
    }

    /**
     * Checks if Google Ads is ready to use
     *
     * @param mixed $store
     *
     * @return bool
     */
    public function isGoogleAdsAvailable($store = null)
    {
        return $this->isEnabled($store) && $this->getAccountNumber($store);
    }
}
