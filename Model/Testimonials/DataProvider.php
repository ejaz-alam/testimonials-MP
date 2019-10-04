<?php

namespace PME\Testimonials\Model\Testimonials;

use PME\Testimonials\Model\ResourceModel\Testimonials\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Magento\Cms\Model\ResourceModel\Block\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */

    public $_storeManager;
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $blockCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $testimonialsCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $testimonialsCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->_storeManager=$storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        $baseurl =  $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $block) {
            $temp = $block->getData();
            if ($temp['avatar']) :
                $img = [];
            $img[0]['image'] = $temp['avatar'];
            $img[0]['url'] = $baseurl.'testimonials/'.$temp['avatar'];
            $temp['avatar'] = $img;
            endif;
            $this->loadedData[$block->getId()] = $block->getData();
        }

        $data = $this->dataPersistor->get('testimonials');
        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);
            $this->loadedData[$block->getId()] = $block->getData();
            $this->dataPersistor->clear('testimonials');
        } else {
            if ($items) :
                if ($block->getData('avatar') != null) {
                    $t2[$block->getId()] = $temp;
                 
                    return $t2;
                } else {
                    return $this->loadedData;
                }
            endif;
        }

        return $this->loadedData;
    }
}
