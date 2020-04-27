<?php

namespace Wallsandfloors\PM\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Wallsandfloors\PM\Model\PM;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;

class Save extends \Magento\Backend\App\Action
{
        /**
         * @var DataPersistorInterface
         */
        protected $dataPersistor;
        /**
         * @param Context $context
         * @param Registry $coreRegistry
         * @param DataPersistorInterface $dataPersistor
         */
        public function __construct(
            Context $context,
            Registry $coreRegistry,
            DataPersistorInterface $dataPersistor
        ) {
            $this->dataPersistor = $dataPersistor;
            parent::__construct($context);
        }
    
        /**
         * Save action
         *
         * @SuppressWarnings(PHPMD.CyclomaticComplexity)
         * @return \Magento\Framework\Controller\ResultInterface
         */
        // public function execute()
        // {
        //     /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        //     $resultRedirect = $this->resultRedirectFactory->create();
        //     $data = $this->getRequest()->getPostValue();
        //     if ($data) {
        //         if (isset($data['status']) && $data['status'] === 'true') {
        //             $data['status'] = PM::STATUS_ENABLED;
        //         }
        //         if (empty($data['id'])) {
        //             $data['id'] = null;
        //         }
    
        //         $id = $this->getRequest()->getParam('id');
        //         if ($id) {
        //             try {
        //                 $model = $this->_objectManager->create('\Wallsandfloors\PM\Model\PM');
        //                 $model->load($id);
        //             } catch (LocalizedException $e) {
        //                 $this->messageManager->addErrorMessage(__('This message no longer exists.'));
        //                 return $resultRedirect->setPath('*/*/');
        //             }
        //         }
        //         $model = $this->_objectManager->create('\Wallsandfloors\PM\Model\PM');
        //         $model->setData($data);
    
        //         try {
        //             $model->save();
        //             $this->messageManager->addSuccessMessage(__('You saved the message.'));
        //             $this->dataPersistor->clear('promotional_messages');
        //             return $this->processBlockReturn($model, $data, $resultRedirect);
        //         } catch (LocalizedException $e) {
        //             $this->messageManager->addErrorMessage($e->getMessage());
        //         } catch (\Exception $e) {
        //             $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the message.'));
        //         }
    
        //         $this->dataPersistor->set('promotional_messages', $data);
        //         return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        //     }
        //     return $resultRedirect->setPath('*/*/');
        // }
        // private function processBlockReturn($model, $data, $resultRedirect)
        // {
        //     echo 'model:'.$model.'data:'.$data.'resultRedirect'.$resultRedirect; exit;
        //      $redirect = $data['back'] ?? 'close';
    
        //     if ($redirect ==='continue') {
        //         $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
        //     } else if ($redirect === 'close') {
        //         $resultRedirect->setPath('*/*/');
        //     }   
        //     return $resultRedirect;
        // }
        public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['status']) && $data['status'] === 'true') {
                $data['status'] = PM::STATUS_ENABLED;
            }
            if (empty($data['id'])) {
                $data['id'] = null;
            }
            
            /** @var \Magento\Cms\Model\Block $model */
            $model = $this->_objectManager->create('\Wallsandfloors\PM\Model\PM');

            $id = $this->getRequest()->getParam('id');
           
            if ($id) {
                // echo 'here';
                // exit;
                try {
                    $model->load($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This message no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the message.'));
                $this->dataPersistor->clear('promotional_messages');
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the message.'));
            }
        }
        
    }
}
    