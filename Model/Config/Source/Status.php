<?php
namespace PME\Testimonials\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

class Status extends AbstractSource implements SourceInterface, OptionSourceInterface
{
    const STATUS_UNPUBLISHED = 0;

    const STATUS_PUBLISHED = 1;


    public function getVisibleStatusIds()
    {
        return [self::STATUS_PUBLISHED];
    }

    public static function getOptionArray()
    {
        return [
            self::STATUS_UNPUBLISHED          => __('Un Published'),
            self::STATUS_PUBLISHED      => __('Published')
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
