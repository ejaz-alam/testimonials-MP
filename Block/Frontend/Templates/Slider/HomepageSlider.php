<?php

namespace PME\Testimonials\Block\Frontend\Templates\Slider;

use Magento\Framework\View\Element\Template;
use PME\Testimonials\Helper\Data;

class HomepageSlider extends \Magento\Framework\View\Element\Template
{
    protected $_testimonialsFactory;
    protected $_helper;
    protected $_repo;

    public function __construct(
        Template\Context $context,
        \PME\Testimonials\Model\ResourceModel\Testimonials\CollectionFactory $testimonialsFactory,
        Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_testimonialsFactory = $testimonialsFactory;
        $this->_helper = $helper;
        $this->_repo = $context->getAssetRepository();
        $this->setHomeSliderTemplate();
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
    }
    public function isModuleEnabled()
    {
      if ($this->_helper->moduleEnabled() == true) {
        return true;
      }
    }
    public function enableHomepage()
    {
        return $this->_helper->getHomepage();
    }
    public function homepageSliderLimit()
    {
       return $this->_helper->getsliderLimit();
    }
    public function getFeaturedPosts()
    {
        $postCollection = $this->_testimonialsFactory->create()->addStoreFilter($this->_storeManager->getStore());
        $postCollection->addFieldToFilter('is_active',1)->addFieldToFilter('featured',1)->setOrder('testimonial_id','ASC')->setPageSize($this->homepageSliderLimit());
            return $postCollection;
    }
    public function homepageSliderText()
    {
        return $this->_helper->getHomepageSliderText();
    }
    public function resize($image, $width , $height )
    {
        return $this->_helper->resize($image, $width , $height );
    }
    public function getPlaceHolderImage ()
    {
        return $this->_repo->createAsset('PME_Testimonials::images/placeholder/preview.png')->getUrl();
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
    public function setHomeSliderTemplate()
    {
      if ($this->_helper->getHomepageTemplateDesign() == 1){
          $this->setTemplate('PME_Testimonials::testimonials/homeslider/meta_bottom.phtml');
      }elseif($this->_helper->getHomepageTemplateDesign() == 2){
          $this->setTemplate('PME_Testimonials::testimonials/homeslider/side_left.phtml');
      }elseif($this->_helper->getHomepageTemplateDesign() == 3){
          $this->setTemplate('PME_Testimonials::testimonials/homeslider/no_image.phtml');
      }elseif ($this->_helper->getHomepageTemplateDesign() == 4) {
        $this->setTemplate('PME_Testimonials::testimonials/homeslider/image_down.phtml');
      }
    }
}
