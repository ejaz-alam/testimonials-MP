<?php
namespace PME\Testimonials\Block\Frontend\Templates\Slider;

use Magento\Framework\View\Element\Template;
use PME\Testimonials\Helper\Data;

class Sidebar extends \Magento\Framework\View\Element\Template
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
        $this->setSliderTemplate();
    }
    public function SidebarLimit()
    {
       return $this->_helper->getsidebarLimit();
    }
   public function getFeaturedPosts()
   {
        $postCollection = $this->_testimonialsFactory->create()->addStoreFilter($this->_storeManager->getStore());
        $postCollection->addFieldToFilter('is_active',1)
                        ->addFieldToFilter('featured',1)->setOrder('testimonial_id','ASC')->setPageSize($this->SidebarLimit());
            return $postCollection;
    }
    public function resize($image, $width , $height )
    {
        return $this->_helper->resize($image, $width , $height );
    }
    public function showSidebar(){
        return $this->_helper->getSidebar();
    }
      public function getSliderPlaceholder ()
    {
        return $this->_repo->createAsset('PME_Testimonials::images/placeholder/preview.png')->getUrl();
    }
    public function sidebarText(){
        return $this->_helper->getSidebarText();
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
    public function setSliderTemplate()
    {
      if ($this->_helper->getSidebarTemplateDesign() == 1)
      {
          $this->setTemplate('PME_Testimonials::testimonials/slider/bottom_meta.phtml');
      }elseif($this->_helper->getSidebarTemplateDesign() == 2){
          $this->setTemplate('PME_Testimonials::testimonials/slider/side_left.phtml');
      }elseif($this->_helper->getSidebarTemplateDesign() == 3){
          $this->setTemplate('PME_Testimonials::testimonials/slider/no_image.phtml');
      }elseif ($this->_helper->getSidebarTemplateDesign() == 4) {
        $this->setTemplate('PME_Testimonials::testimonials/slider/image_down.phtml');
      }
    }
}
