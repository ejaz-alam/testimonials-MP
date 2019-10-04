<?php

namespace PME\Testimonials\Model\Config\Source;

class Selecttheme
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $result = [
            [
                'label' => __('Grid'),
                'value' => 1,
            ],
            [
                'label' => 'Bottom Meta',
                'value' => 2
            ],
            [
                'label' => 'Without Image',
                'value' => 3
            ]
        ];

        return $result;
    }

    /**
     * @return array
     */
    public function getAllOptions()
    {
        return $this->toOptionArray();
    }
}
