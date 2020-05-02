<?php

namespace Namespace\FeaturedProducts\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Catalog\Model\Layer\Resolver;
use Namespace\FeaturedProducts\Helper\Data;

/**
 * For Index Action
 */
class Index extends Action
{
    /**
     * @var ScopeConfigInterface
     */
    public $scopeConfig;

    /**
     * @var PageFactory
     */
    public $resultPageFactory;

    /**
     * @var Resolver
     */
    public $layerResolver;

    /**
     *
     * @param Context              $context
     * @param PageFactory          $resultPageFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param Resolver             $layerResolver
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ScopeConfigInterface $scopeConfig,
        Resolver $layerResolver
    ) {

        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;

        $this->scopeConfig = $scopeConfig;

        $this->layerResolver = $layerResolver;
    }

    public function execute()
    {

        $result = $this->resultPageFactory->create();

            /**
             * Prepare Layer and pass collection.
             */
            $this->layerResolver->create('search');

            $collection = $this->layerResolver->get()->getProductCollection();

            $collection->addAttributeToFilter(Data::FEATURED_PRODUCT, Data::FEATURED_PRODUCT_FLAG);

            $list = $result->getLayout()->getBlock('custom.products.list');

            $list->setProductCollection($collection);

            /**
             * Set Title and Meta description and keywords.
             */
            $result->getConfig()->getTitle()->set(
                __('Featured Products')
            );

            /**
             * @var \Magento\Theme\Block\Html\Breadcrumbs $breadcrumbsBlock
             */

        $breadcrumbsBlock = $result->getLayout()->getBlock('breadcrumbs');
        if ($breadcrumbsBlock) {
            $breadcrumbsBlock->addCrumb(
                'home',
                [
                    'label'    => __('Home'),
                    'link'     => $this->_url->getUrl('')
                ]
            );
            $breadcrumbsBlock->addCrumb(
                'brand',
                [
                    'label'    => __('Featured Products'),
                ]
            );
        }

        return $result;
    }
}// end class
