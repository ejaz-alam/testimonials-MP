<?php

namespace PME\Testimonials\Model\Config\Source;

class SliderTheme
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $result = [
            [
                'label' => __('Bottom Meta'),
                'value' => 1,
            ],
            [
                'label' => 'Image Left',
                'value' => 2
            ],
            [
                'label' => 'Without Image',
                'value' => 3
            ],
            [
                'label' => 'Grid',
                'value' => 4
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
