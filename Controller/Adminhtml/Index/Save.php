<?php

namespace PME\Testimonials\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use PME\Testimonials\Model\Testimonials;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataProcessor;
    protected $dataPersistor;
    protected $imageUploader;
    protected $model;
    protected $date;

    public function __construct(
        Action\Context $context,
        PostDataProcessor $dataProcessor,
        Testimonials $model,
        DataPersistorInterface $dataPersistor,
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        $this->dataProcessor = $dataProcessor;
        $this->dataPersistor = $dataPersistor;
        $this->model = $model;
        $this->date = $date;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (isset($data['avatar'][0]['name']) && isset($data['avatar'][0]['tmp_name'])) {
                $data['avatar'] =$data['avatar'][0]['name'];
                $this->imageUploader = \Magento\Framework\App\ObjectManager::getInstance()->get(
                    'PME\Testimonials\TestimonialsImageUpload'
                );
                $this->imageUploader->moveFileFromTmp($data['avatar']);
            } elseif (isset($data['avatar'][0]['image']) && !isset($data['avatar'][0]['tmp_name'])) {
                $data['avatar'] = $data['avatar'][0]['image'];
            } else {
                $data['avatar'] = '';
            }
            $data['store']  = implode(',',$data['store']);
            $data = $this->dataProcessor->filter($data);
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $this->model->load($id);
            }


            $this->model->setData($data);
            // For Update Date & Time
           $this->model['update_time']= $this->date->gmtDate();

            $this->_eventManager->dispatch(
                'testimonials_prepare_save',
                ['testimonials' => $this->model, 'request' => $this->getRequest()]
            );

            if (!$this->dataProcessor->validate($data)) {
                return $resultRedirect->setPath('*/*/edit', ['id' => $this->model->getId(), '_current' => true]);
            }

            try {
                $this->model->save();
                $this->messageManager->addSuccess(__('You saved the Post.'));
                $this->dataPersistor->clear('testimonials');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath(
                        '*/*/edit',
                        ['id' => $this->model->getId(),
                         '_current' => true]
                    );
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Post.'));
            }

            $this->dataPersistor->set('testimonials', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
