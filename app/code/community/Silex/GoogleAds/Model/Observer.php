<?php

/**
 * Class Silex_GoogleAds_Model_Observer
 *
 * Default observer
 */
class Silex_GoogleAds_Model_Observer
{
    /**
     * Add order information into Google Ads block to render on checkout success pages
     *
     * @param Varien_Event_Observer $observer
     *
     * @return void
     */
    public function setGoogleAdsOnOrderSuccessPageView(Varien_Event_Observer $observer)
    {
        $orderIds = $observer->getEvent()->getOrderIds();
        if (empty($orderIds) || !is_array($orderIds)) {
            return;
        }

        /** @var Silex_GoogleAds_Block_Conversion $block */
        $block = Mage::app()->getFrontController()->getAction()->getLayout()->getBlock('googleads.conversion');
        if ($block) {
            $block->setOrderIds($orderIds);
        }
    }
}