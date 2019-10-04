<?php

namespace PME\Testimonials\Block\Frontend\Templates\Listing;

use Magento\Framework\View\Element\Template;
use PME\Testimonials\Helper\Data;

class ContainerListing extends \Magento\Framework\View\Element\Template
{
   public $_templateDesign;


   public function __construct(
        Template\Context $context,
        \PME\Testimonials\Model\ResourceModel\Testimonials\CollectionFactory $testimonialsFactory,
        Data $design,
        array $data = []
    ) {

        parent::__construct($context, $data);
        $this->_testimonialsFactory = $testimonialsFactory;
        $this->_templateDesign = $design;
        $this->_isScopePrivate = true;
    }
}
