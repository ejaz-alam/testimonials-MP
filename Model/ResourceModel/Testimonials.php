<?php

namespace PME\Testimonials\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Testimonials extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('pme_testimonials', 'testimonial_id');
    }
}
