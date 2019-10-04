<?php
/**
 * PME Testimonials
    *
    * @category    PME
    * @package     PME_Testimonials
    * @author      PME
    * @Email       Support@progos.org
    *
 */
namespace PME\Testimonials\Block\Adminhtml\Testimonial\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class ResetButton
 */
class ResetButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Reset'),
            'class' => 'reset',
            'on_click' => 'location.reload();',
            'sort_order' => 30
        ];
    }
}
