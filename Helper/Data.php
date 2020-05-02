<?php

namespace NameSpace\FeaturedProducts\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * For Helper Data
 */
class Data extends AbstractHelper
{
    const XML_PATH_MODULE_ENABLED = 'namespace_featuredproducts/general/enabled';

   

    const FEATURED_PRODUCT = 'is_featured';

    const FEATURED_PRODUCT_FLAG = 1;

    const FEATURED_PRODUCT_POSITION = 'featured_position';

    const FEATURED_PRODUCT_POSITION_DIR = 'ASC';

    /**
     * Get config value
     * @param $configPath
     * @param null $store
     * @return mixed
     */
    public function getConfigValue($configPath, $store = null)
    {
        return $this->scopeConfig->getValue(
            $configPath,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * @return mixed
     */
    public function isModuleEnabled()
    {
        return $this->getConfigValue(self::XML_PATH_MODULE_ENABLED);
    }

    
}//end class
