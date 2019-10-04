<?php

namespace PME\Testimonials\Model;

class Testimonials extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('PME\Testimonials\Model\ResourceModel\Testimonials');
    }
}
