<?php

namespace Wallsandfloors\PM\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{
    protected $pageFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context ,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ){
        $this->pageFactory = $pageFactory;
        return parent :: __construct($context);
    }

    public function execute(){
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Wallsandfloors_PM::all_pm');
        $resultPage->addBreadcrumb(__('PromotionalMessages'), __('PromotionalMessages'));
        $resultPage->getConfig()->getTitle()->prepend(__('All Promotional Messages'));
        return $resultPage;
    }
}