<?php

namespace PME\Testimonials\Block\Frontend\Templates\Listing;

use Magento\Framework\View\Element\Template;
use PME\Testimonials\Helper\Data;

class SimpleTemplateDesign extends \Magento\Framework\View\Element\Template
{
    protected $_testimonialsFactory;
    protected $_helper;
    protected $_repo;

    public function __construct(
        Template\Context $context,
        \PME\Testimonials\Model\ResourceModel\Testimonials\CollectionFactory $testimonialsFactory,
        Data $items,
        array $data = []
    ) {

        parent::__construct($context, $data);
        $this->_testimonialsFactory = $testimonialsFactory;
        $this->_helper = $items;
        $this->_isScopePrivate = true;
        $this->_repo = $context->getAssetRepository();
    }

    protected function _prepareLayout()
    {
            parent::_prepareLayout();
            $limit = $this->_helper->showItems();
            $limArray= array();
            for ($i=1; $i < 4; $i++) {
                $currLimit = $limit*$i;
                $limArray[$currLimit]= $currLimit;
            }
             if ($this->getPosts()) {
            $pager = $this->getLayout()->createBlock( 'Magento\Theme\Block\Html\Pager', 'pme.SimpleTemplateDesign' )->setAvailableLimit($limArray)->setShowPerPage(true)->setCollection( $this->getPosts() );
                $this->setChild('pager', $pager);
                $this->getPosts()->load();
            }
            return $this;
    }

   public function getPosts()
   {
        $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : $this->_helper->showItems();
        $postCollection = $this->_testimonialsFactory->create()->addStoreFilter($this->_storeManager->getStore());
        $postCollection->addFieldToFilter('is_active',1);
        $postCollection->setPageSize($pageSize);
        $postCollection->setCurPage($page);
        $postCollection->setOrder('testimonial_id','ASC');
            return $postCollection;
    }
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    public function resize($image, $width , $height )
    {
        return $this->_helper->resize($image, $width , $height );
    }
    public function getPlaceHolderImage ()
    {
        return $this->_repo->createAsset('PME_Testimonials::images/placeholder/preview.png')->getUrl();
    }
    public function headTextforListing()
    {
        return $this->_helper->getListingHeaderText();
    }
    public function enableStar()
    {
        return $this->_helper->setStar();
    }
    public function enablePosition()
    {
        return $this->_helper->setPosition();
    }
    public function enableSocial()
    {
        return $this->_helper->setSocial();
    }
    
}
