<?php
namespace PME\Testimonials\Controller\Form;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use PME\Testimonials\Model\Testimonials;
use PME\Testimonials\Helper\Data;

class Submit extends \Magento\Framework\App\Action\Action
{
    protected $_objectManager;
    protected $_storeManager;
    protected $_filesystem;
    protected $_fileUploaderFactory;
    protected $_testimonials;
    protected $_Image;
    /**
    * Save Form Data
    *
    * @return array
    */

    public function __construct(
    \Magento\Framework\App\Action\Context $context,
    StoreManagerInterface $storeManager,
    \Magento\Framework\Filesystem $filesystem,
    \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
    Testimonials $testimonials
    )
    {
        $this->_storeManager = $storeManager;
        $this->_filesystem = $filesystem;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_testimonials = $testimonials;
        parent::__construct($context);
    }

   public function execute()
    {
        //get post data and set it to $data

        $data = $this->getRequest()->getPostValue();
        if (empty($data)) {
             $this->_redirect('testimonials/form');
             $this->messageManager->addError(__('Failed to Save your data. Please try again'));
        }else{
            $pathurl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'testimonials/';
        $mediaDir = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
        $mediapath = $this->_mediaBaseDirectory = rtrim($mediaDir, '/');
        $files = $this->getRequest()->getFiles();
        $_Submit = true;
        if (isset($files['avatar']) && !empty($files['avatar']["name"])){
            try {
            $uploader = $this->_fileUploaderFactory->create(['fileId' => 'avatar']);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(true);
            $path = $mediapath . '/testimonials/';
            $data['avatar'] = $files['avatar']['name'];
                $result = $uploader->save($path);
                $_Submit = true;
            } catch (\Exception $e) {
                $_Submit = false;
                $this->messageManager->addError(__($e->getMessage()));
            }
         }
        if ($_Submit === true) {
            $message = "";   $id = 0;
            $id = $this->_testimonials->setData($data)
            ->save()->getId();
            if (!isset($id)) {
                $this->messageManager->addError(__("Failed to Save your data. Please try again"));
            } else{
                $this->messageManager->addSuccess(__("Thanks for your valuable feedback."));
            }
        }
        $this->_redirect('testimonials/');
        }
    }
}
