<?php
namespace PME\Testimonials\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

class FeaturedStatus extends AbstractSource implements SourceInterface, OptionSourceInterface
{
    const STATUS_UNFEATURED = 0;

    const STATUS_FEATURED = 1;

    public static function getOptionArray()
    {
        return [
            self::STATUS_FEATURED   => __('Yes'),
            self::STATUS_UNFEATURED => __('No')
        ];
    }

    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }

    public function getOptionText($optionId)
    {
        $options = self::getOptionArray();

        return isset($options[$optionId]) ? $options[$optionId] : null;
    }
}
