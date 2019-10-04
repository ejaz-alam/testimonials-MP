<?php
namespace PME\Testimonials\Model\ResourceModel\Testimonials;

use PME\Testimonials\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'testimonial_id';

    /**
     * Load data for preview flag
     *
     * @var bool
     */
    protected $_previewFlag;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('PME\Testimonials\Model\Testimonials', 'PME\Testimonials\Model\ResourceModel\Testimonials');
    }

    public function setFirstStoreFlag($flag = false)
    {
        $this->_previewFlag = $flag;
        return $this;
    }

    public function addStoreFilter($store, $withAdmin = true)
   {
       if (!$this->getFlag('store_filter_added')) {
           $this->performAddStoreFilter($store, $withAdmin);
       }
       return $this;
   }
    /**
     * Perform operations after collection load
     *
     * @return $this
     */
    protected function _afterLoad()
    {
        return parent::_afterLoad();
    }

    /**
     * Perform operations before rendering filters
     *
     * @return void
     */
    protected function _renderFiltersBefore()
    {
        return parent::_renderFiltersBefore();
    }
}
