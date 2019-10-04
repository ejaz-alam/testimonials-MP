<?php
/**
 * PME Testimonials
    *
    * @category    PME
    * @package     User Testimonials
    * @author      PME
    * @Email       Support@progos.org
    *
 */
namespace PME\Testimonials\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;


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
        $this->initPage($resultPage)->getConfig()->getTitle()->prepend(__('Manage Testimonials'));
        return $resultPage;
    }
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('PME_Testimonials::testimonialsconfig')
             ->addBreadcrumb(__('PME'), __('Testimonials'));

        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('PME_Testimonials::testimonialsconfig');
    }
}
