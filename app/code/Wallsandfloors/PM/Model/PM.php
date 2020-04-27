<?php

namespace Wallsandfloors\PM\Model;

class PM extends \Magento\Framework\Model\AbstractModel {
        /**
     * PM cache tag
     */
    const CACHE_TAG = 'promotional_messages';

    /**#@+
     * PM statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**#@-*/

    /**#@-*/
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'promotional_messages';

    /**
     * Construct.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Wallsandfloors\PM\Model\ResourceModel\PM::class);
    }
        /**
     * Prepare block's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}