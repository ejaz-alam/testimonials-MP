<?php

namespace PME\Testimonials\Helper;

use \Magento\Catalog\Helper\Image;
use \Magento\Framework\App\Helper\Context;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_config;
    protected $_repo;
    protected $_filesystem;
    protected $_imageFactory;

    const TESTIMONIALS_LIST_ENABLE = 'testimonials/appearance/display';
    // listing page
    const LISTING_TEMPLATE         = 'testimonials/listing/listing_theme';
    const LISTING_PAGE_HEADER_TEXT = 'testimonials/listing/listing_header';
    const LISTING_ITEMS            = 'testimonials/listing/show_items';
    // homepage slider
    const ENABLE_HOMEPAGE_SLIDER      = 'testimonials/homepage_slider/enable';
    const HOMEPAGE_SLIDER_TEMPLATE    = 'testimonials/homepage_slider/homepage_template';
    const HOMEPAGE_SLIDER_HEADER_TEXT = 'testimonials/homepage_slider/homepage_header';
    const HOMEPAGE_SLIDER_ITEM        = 'testimonials/homepage_slider/no_item';
    // Sidebar Slider
    const ENABLE_SIDEBAR_SLIDER      = 'testimonials/sidebar_slider/sidebar';
    const SIDEBAR_SLIDER_TEMPLATE    = 'testimonials/sidebar_slider/sidebar_template';
    const SIDEBAR_SLIDER_HEADER_TEXT = 'testimonials/sidebar_slider/sidebar_header';
    const SIDEBAR_ITEMS              = 'testimonials/sidebar_slider/nos_item';
    // Category Slider
    const ENABLE_CAT_SIDEBAR_SLIDER      = 'testimonials/category_sidebar_slider/cat_sidebar';
    const SIDEBAR_CAT_SLIDER_TEMPLATE    = 'testimonials/category_sidebar_slider/cat_sidebar_template';
    const SIDEBAR_CAT_SLIDER_HEADER_TEXT = 'testimonials/category_sidebar_slider/cat_sidebar_header';
    const SIDEBAR_CAT_ITEMS              = 'testimonials/category_sidebar_slider/cat_nos_item';
    //Frontend
    const ENABLE_STARS         = 'testimonials/design/enable_stars';
    const ENABLE_SOCIAL_LINKS  = 'testimonials/design/enable_social';
    const ENABLE_POSITION      = 'testimonials/design/enable_position';
    // FORM
    const TESTIMONIALS_IMAGE_UPLOAD_ALLOW = 'testimonials/frontend/avatar_upload';
    const ENABLE_CAPTCHA                  = 'testimonials/frontend/enable_captcha';
    const RECAPTCHA_KEY                   = 'testimonials/frontend/reCaptcha';
    const XML_PATH_URL                    = 'testimonials/url_route/routing';

    public function __construct(
        Context $context,
        Image $productImageHelper,
        \Magento\Framework\View\Asset\Repository $repository,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Image\AdapterFactory $imageFactory
    ) {
        parent::__construct($context);
        $this->_config       = $this->scopeConfig;
        $this->_filesystem   = $filesystem;
        $this->_storeManager = $storeManager;
        $this->_imageFactory = $imageFactory;
        $this->_repo         = $repository;

    }
    public function moduleEnabled()
    {
        if ($this->isModuleOutputEnabled('PME_Testimonials') &&
            $this->_config->isSetFlag(
                self::TESTIMONIALS_LIST_ENABLE,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            )) {
            return true;
        }
    }
    public function getConfig($path)
    {
      return $this->_config->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function setStar()
    {
      return $this->getConfig(self::ENABLE_STARS);
    }
    public function setPosition()
    {
      return $this->getConfig(self::ENABLE_POSITION);
    }
    public function setSocial()
    {
      return $this->getConfig(self::ENABLE_SOCIAL_LINKS);
    }
    public function setCaptchaKey()
    {
      return $this->getConfig(self::RECAPTCHA_KEY);
    }
    public function setCaptch()
    {
      return $this->getConfig(self::ENABLE_CAPTCHA);
    }
    public function showItems()
    {
        return $this->getConfig(self::LISTING_ITEMS);
    }
    public function showAllowImage()
    {
        return $this->getConfig(self::TESTIMONIALS_IMAGE_UPLOAD_ALLOW);
    }
    public function showTemplateDesign()
    {
        return $this->getConfig(self::LISTING_TEMPLATE);
    }
    public function getConfigUrl($store = null, $path = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_URL,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }
    public function resize($image, $width = null, $height = null)
    {
        $absolutePath = $this->_filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath('testimonials/') . $image;
        $imageResized = $this->_filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath('resized/' . $width . '/') . $image;
        $imageResize  = $this->_imageFactory->create();
        $imageResize->open($absolutePath);
        $imageResize->constrainOnly(false);
        $imageResize->keepTransparency(true);
        $imageResize->keepFrame(true);
        $imageResize->keepAspectRatio(true);
        $imageResize->resize($width, $height);
        $destination = $imageResized;
        $imageResize->save($destination);
        $resizedURL = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'resized/' . $width . '/' . $image;
        return $resizedURL;
    }

    public function getPlaceHolderImage()
    {
        return $this->_repo->createAsset('PME_Testimonials::images/placeholder/preview.png')->getUrl();
    }
    public function getSidebar()
    {
        return $this->getConfig(self::ENABLE_SIDEBAR_SLIDER);
    }
    public function getsliderLimit()
    {
        return $this->getConfig(self::HOMEPAGE_SLIDER_ITEM);
    }
    public function getsidebarLimit()
    {
        return $this->getConfig(self::SIDEBAR_ITEMS);
    }
    public function getHomepage()
    {
        return $this->getConfig(self::ENABLE_HOMEPAGE_SLIDER);
    }

    public function getListingHeaderText()
    {
        return $this->getConfig(self::LISTING_PAGE_HEADER_TEXT);
    }

    public function getSidebarText()
    {
        return $this->getConfig(self::SIDEBAR_SLIDER_HEADER_TEXT);
    }

    public function getHomepageSliderText()
    {
        return $this->getConfig(self::HOMEPAGE_SLIDER_HEADER_TEXT);
    }
    public function getSidebarTemplateDesign()
    {
        return $this->getConfig(self::SIDEBAR_SLIDER_TEMPLATE);
    }
    public function getHomepageTemplateDesign()
    {
        return $this->getConfig(self::HOMEPAGE_SLIDER_TEMPLATE);
    }
    // Category
    public function getCatSidebarTemplateDesign()
    {
        return $this->getConfig(self::SIDEBAR_CAT_SLIDER_TEMPLATE);
    }
    public function getCatSidebarText()
    {
        return $this->getConfig(self::SIDEBAR_CAT_SLIDER_HEADER_TEXT);
    }
    public function getCatsidebarLimit()
    {
        return $this->getConfig(self::SIDEBAR_CAT_ITEMS);
    }
    public function getCatSidebar()
    {
        return $this->getConfig(self::ENABLE_CAT_SIDEBAR_SLIDER);
    }
}
