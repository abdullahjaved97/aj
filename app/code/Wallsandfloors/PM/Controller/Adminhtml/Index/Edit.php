<?php

namespace Wallsandfloors\PM\Controller\Adminhtml\Index;

/**
 * Edit PM action.
 */
class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    protected $_coreRegistry;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Edit PM
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        // echo $id;exit;
        $model = $this->_objectManager->create('\Wallsandfloors\PM\Model\PM');
        // print_r($model);exit;
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This PromotionalMessage no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('promotional_messages', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(
            'Wallsandfloors_PM::all_pm'
            )->addBreadcrumb(
            $id ? __('Edit PM') : __('New PM'),
            $id ? __('Edit PM') : __('New PM')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Promotional Messages'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getMessage() : __('New PM'));
        // die('here');
        return $resultPage;
        // print_r($resultPage);
    }
}