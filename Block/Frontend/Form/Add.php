<?php

namespace PME\Testimonials\Block\Frontend\Form;

use Magento\Framework\View\Element\Template;
use PME\Testimonials\Helper\Data;

/**
 * Main Testimonial form block
 *
 * @api
 * @since 100.0.2
 */
class Add extends \Magento\Framework\View\Element\Template
{
    public $_allowImageUpload;
    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        Data $helper,
        array $data = []
    ) {

        parent::__construct($context, $data);
        $this->_helper = $helper;
    }

    public function getFormAction()
    {
        return $this->getUrl('testimonials/form/submit', ['_secure' => true]);
    }
    public function getHelper()
    {
        return $this->_helper;
    }

    public function secretKey()
    {
        return $this->_helper->setCaptchaKey();
    }
    public function EnableCaptcha()
    {
        return $this->_helper->setCaptch();
    }
}
