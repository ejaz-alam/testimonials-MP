<?php

namespace PME\Testimonials\Controller\Adminhtml\Index;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
     protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->getConfig()->getTitle()->prepend(__('Manage Testimonial'));
        return $resultPage;
    }
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('PME_Testimonials::testimonialsconfig')
             ->addBreadcrumb(__('Manage Post'), __('Manage Post'))
             ->addBreadcrumb(__('Manage Post'), __('Manage Post'));

        return $resultPage;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('PME_Testimonials::testimonialsconfig');
    }
}
