<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 19/03/14
 * Time: 12:56 PM
 */
if (class_exists('WP_Customize_Control')) {

    /**
     * Class CZ_Customize_Control_Col
     */
    class CZ_Customize_Control_Col extends WP_Customize_Control
    {
        /**
         * @var string
         */
        public $type = 'textarea';
        /**
         * @var
         */
        public $side;

        /**
         *
         */
        public function render()
        {
            $id = 'customize-control-' . str_replace('[', '-', str_replace(']', '', $this->id));
            $class = !empty($this->side) ? 'customize-control customize-control-' . $this->type . ' '  . $this->type . '-col '  . $this->type . '-' . $this->side : 'customize-control customize-control-' . $this->type;

            ?>
            <li id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class); ?>">
            <?php $this->render_content(); ?>
            </li><?php
        }

    }

    /**
     * Class CZ_Customize_Textarea_Control
     */
    class CZ_Customize_Textarea_Control extends CZ_Customize_Control_Col
    {
        /**
         *
         */
        public function render_content()
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <textarea rows="5"
                          style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
            </label>
        <?php
        }
    }

    /**
     * Class CZ_Customize_Social
     */
    class CZ_Customize_Social extends CZ_Customize_Control_Col
    {
        /**
         *
         */
        /*public function render_content()
        {

        }*/
    }
}


