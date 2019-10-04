<?php
namespace PME\Testimonials\Block\Frontend\Templates\Slider;

use Magento\Framework\View\Element\Template;
use PME\Testimonials\Helper\Data;

class ContainerSidebar extends \Magento\Framework\View\Element\Template
{

    public $_templateSidebarDesign;


    public function __construct(
        Template\Context $context,
        \PME\Testimonials\Model\ResourceModel\Testimonials\CollectionFactory $testimonialsFactory,
        Data $design,
        array $data = []
    ) {

        parent::__construct($context, $data);
        $this->_testimonialsFactory = $testimonialsFactory;
        $this->_templateSidebarDesign = $design;
        $this->_isScopePrivate = true;
    }




}
