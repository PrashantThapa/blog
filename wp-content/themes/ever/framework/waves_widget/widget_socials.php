<?php
/* ------Widget Social ------ */
class ever_Socialswidget extends WP_Widget {

    public function __construct() {
        $widget_ops = array('classname' => 'sociallinkswidget', 'description' => esc_html__('Displays your social profile.', 'ever'));

        parent::__construct(false, 'Ever: Socials', $widget_ops);
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo ($before_widget);
            if ($title){echo balanceTags($before_title . $title . $after_title);}
            $class = 'social-silver';
            if(isset($instance['color'])){
                if($instance['color'] == 'dark'){
                    $class = ' social-dark';
                }elseif($instance['color'] == 'light'){   
                    $class = ' social-light';
                }
            }
            echo '<div class="tw-social-icon '.esc_attr($class).' clearfix">';
                if(!empty($instance['social'])){
                    $social_links=explode("\n",$instance['social']);
                    foreach($social_links as $social_link){ 
                        $link=explode("|",$social_link);
                        echo ever_social_link(esc_url($link[0]));
                    }
                }
            echo '</div>';
        echo ($after_widget);
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance = $new_instance;
        /* Strip tags (if needed) and update the widget settings. */
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['color'] = strip_tags($new_instance['color']);
        return $instance;
    }

    public function form($instance) {
        extract(shortcode_atts(array(
            'title' => '',
            'color' => 'light'
                ), $instance));
        ?>
    
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'ever'); ?>:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo isset($instance['title']) ? $instance['title'] : ''; ?>"  />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('color')); ?>"><?php esc_html_e('Select Style', 'ever'); ?>:</label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('color')); ?>" name="<?php echo esc_attr($this->get_field_name('color')); ?>">
                <option value="silver"<?php if(!empty($instance['color'])&&$instance['color']==='silver'){echo ' selected="selected"';} ?>><?php esc_html_e('Silver', 'ever'); ?></option>
                <option value="light"<?php if(!empty($instance['color'])&&$instance['color']==='light'){echo ' selected="selected"';} ?>><?php esc_html_e('Light', 'ever'); ?></option>
                <option value="dark"<?php if(!empty($instance['color'])&&$instance['color']==='dark'){echo ' selected="selected"';} ?>><?php esc_html_e('Dark', 'ever'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('social')); ?>"><?php esc_html_e('Enter social links. Example: facebook.com/themewaves. NOTE: Divide value sets with linebreak "Enter"', 'ever'); ?>:</label>
            <textarea class="widefat" rows="20" id="<?php echo esc_attr($this->get_field_id('social')); ?>" name="<?php echo esc_attr($this->get_field_name('social')); ?>"><?php echo isset($instance['social']) ? $instance['social'] : ''; ?></textarea>
        </p><?php
    }
}

add_action('widgets_init', create_function('', 'return register_widget("ever_Socialswidget");'));