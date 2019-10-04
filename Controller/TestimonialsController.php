<?php
namespace PME\Testimonials\Controller;

use \PME\Testimonials\Helper\Data;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\Exception\NotFoundException;

abstract class TestimonialsController extends \Magento\Framework\App\Action\Action
{

	protected $_helper;

    public function __construct(
    	Context $context,
    	Data $helper)
    {
    	$this->_helper = $helper;
        parent::__construct($context);
    	if (!$this->_helper->moduleEnabled())
		{
    		throw new NotFoundException(__('Some Exception Message'));
		}
    }

	public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
