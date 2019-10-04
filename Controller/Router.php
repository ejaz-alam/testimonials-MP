<?php

namespace PME\Testimonials\Controller;class Router implements \Magento\Framework\App\RouterInterface
{

   protected $actionFactory;
   protected $_eventManager;
   protected $_storeManager;
   protected $_appState;
   protected $_url;
   protected $_response;
   protected $_helper;

   public function __construct(
       \Magento\Framework\App\ActionFactory $actionFactory,
       \Magento\Framework\Event\ManagerInterface $eventManager,
       \Magento\Framework\UrlInterface $url,
       \PME\Testimonials\Helper\Data $helper,
       \Magento\Store\Model\StoreManagerInterface $storeManager,
       \Magento\Framework\App\ResponseInterface $response
   ) {
       $this->actionFactory = $actionFactory;
       $this->_eventManager = $eventManager;
       $this->_url = $url;
       $this->_helper = $helper;
       $this->_storeManager = $storeManager;
       $this->_response = $response;
   }    /**
    * Validate and Match Faqs main-page, detail page and modify request
    *
    * @param \Magento\Framework\App\RequestInterface $request
    * @return bool
    */
   public function match(\Magento\Framework\App\RequestInterface $request)
   {
       $blogHelperUrl = $this->_helper->getConfigUrl();

       $identifier = trim($request->getPathInfo(), '/');
       $oldIdentifier=$identifier;

       $condition = new \Magento\Framework\DataObject(['identifier' => $identifier, 'continue' => true]);
       $this->_eventManager->dispatch(
           'pme_testimonials_controller_router_match_before',
           ['router' => $this, 'condition' => $condition]
       );
       $identifier = $condition->getIdentifier();

       if ($condition->getRedirectUrl()) {
           $this->_response->setRedirect($condition->getRedirectUrl());
           $request->setDispatched(true);
           return $this->actionFactory->create('Magento\Framework\App\Action\Redirect');
       }        if (!$condition->getContinue()) {
           return null;
       }

        $mainIdentifier = $blogHelperUrl;

       if ($mainIdentifier == $identifier) {
           $request->setModuleName('testimonials')->setControllerName('index')->setActionName('index');
           $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $oldIdentifier);
           return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
       }
   }
}
