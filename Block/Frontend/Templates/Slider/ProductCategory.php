<?php
namespace PME\Testimonials\Block\Frontend\Templates\Slider;

use Magento\Framework\View\Element\Template;
use PME\Testimonials\Helper\Data;

class ProductCategory extends \Magento\Framework\View\Element\Template
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
        $this->_repo = $context->getAssetRepository();
        $this->setCatSliderTemplate();
    }
    public function CatSidebarLimit()
    {
       return $this->_helper->getCatsidebarLimit();
    }
    public function isModuleEnabled()
    {
      if ($this->_helper->moduleEnabled() == true) {
        return true;
      }
    }
    public function getFeaturedPosts()
   {
        $postCollection = $this->_testimonialsFactory->create()->addStoreFilter($this->_storeManager->getStore());
        $postCollection->addFieldToFilter('is_active',1)
                        ->addFieldToFilter('featured',1)->setOrder('testimonial_id','ASC')->setPageSize($this->CatSidebarLimit());
            return $postCollection;
    }
    public function resize($image, $width , $height )
    {
        return $this->_helper->resize($image, $width , $height );
    }
    public function showCatSidebar(){
        return $this->_helper->getCatSidebar();
    }
      public function getSliderPlaceholder ()
    {
        return $this->_repo->createAsset('PME_Testimonials::images/placeholder/preview.png')->getUrl();
    }
    public function CatsidebarText(){
        return $this->_helper->getCatSidebarText();
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
    public function setCatSliderTemplate()
    {
      if ($this->_helper->getCatSidebarTemplateDesign() == 1){
        $this->setTemplate('PME_Testimonials::testimonials/categoryslider/bottom_meta.phtml');
      }elseif($this->_helper->getCatSidebarTemplateDesign() == 2){
        $this->setTemplate('PME_Testimonials::testimonials/categoryslider/side_left.phtml');
      }elseif($this->_helper->getCatSidebarTemplateDesign() == 3){
        $this->setTemplate('PME_Testimonials::testimonials/categoryslider/no_image.phtml');
      }elseif ($this->_helper->getCatSidebarTemplateDesign() == 4) {
        $this->setTemplate('PME_Testimonials::testimonials/categoryslider/image_down.phtml');
      }
    }
}
