<?php

/**
 * Class Silex_GoogleAds_Block_Tag
 *
 * Block adding Google Ads tag in checkout success page
 *
 * @method array getOrderIds
 * @method Silex_GoogleAds_Block_Conversion setOrderIds(array $orderIds)
 */
class Silex_GoogleAds_Block_Conversion extends Mage_Core_Block_Template
{
    /**
     * Returns Google Ads snippet ID
     *
     * @return string
     */
    public function getSnippetId()
    {
        return Mage::getStoreConfig('google/googleads/snippet_id');
    }

    /**
     * Get count of orders IDs passed when creating the order
     *
     * @return int
     */
    protected function getOrdersCount()
    {
        return is_array($this->getOrderIds()) ? count($this->getOrderIds()) : 0;
    }

    /**
     * Returns the conversion snippet
     *
     * @param int $orderId
     *
     * @return string
     */
    protected function getConversionEventSnippet($orderId)
    {
        $order = $this->getOrder($orderId);

        return 'gtag(
            \'event\',
            \'conversion\',
            {
                \'send_to\': \'' . Mage::helper('silex_googleads')->getAccountNumber()
                    . '/' . $this->getSnippetId() . '\',
                \'value\': ' . $order->getGrandTotal() . ',
                \'currency\': \'' . $order->getOrderCurrency()->getCurrencyCode() . '\',
                \'transaction_id\': \'' . $order->getIncrementId() . '\'
            }
        );';
    }

    /**
     * Get order
     *
     * @param int $orderId
     *
     * @return Mage_Sales_Model_Order
     */
    public function getOrder($orderId)
    {
        return Mage::getModel('sales/order')->load($orderId);
    }
}
