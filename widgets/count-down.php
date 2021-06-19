<?php
namespace Elementor;

class Count_Down_Widgets extends Widget_Base {

    public function get_name() {
        return  'final_count_down';
    }

    public function get_title() {
        return esc_html__( 'MMI Count Down', 'majharul_islam' );
    }

    public function get_script_depends() {
        return [
            'myew-script'
        ];
    }

    public function get_icon() {
        return 'eicon-countdown';
    }

    public function get_categories() {
        return [ 'my_catagory' ];
    }


    public function _register_controls() {

        $this->start_controls_section(
            'the_count_section',
            [
                'label' => __( 'Content', 'MMI Addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'counter_date',
            [
                'label' => __( 'Counter Date', 'majharul_islam' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '2021/07/10', 'majharul_islam' ),
                'description' => __('Type Date Format: 2021/07/10'),
                'placeholder' => __( 'Type your counter date', 'majharul_islam' ),
            ]
        );

        $this->end_controls_section();


        // Style Tab
        $this->style_tab();
    }

    private function style_tab() {

        $this->start_controls_section(
            'coundown_style_sec',
            [
                'label' => __( 'Countdown Option', 'majharul_islam' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // countdown align
        $this->add_control(
            'countdown_align',
            [
                'label' => __( 'Countdown Alignment', 'majharul_islam' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'majharul_islam' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'majharul_islam' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'majharul_islam' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );

        // countdown margin
        $this->add_control(
            'countdown_margin',
            [
                'label' => __( 'Margin', 'majharul_islam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .count_down_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // single counter typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'counter_typography',
                'label' => __( 'Counter Typography', 'majharul_islam' ),
                'selector' => '{{WRAPPER}} .single_timer',
            ]
        );

        // single counter color
        $this->add_control(
            'counter_counter_color',
            [
                'label' => __( 'Counter Color', 'majharul_islam' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single_timer' => 'color: {{VALUE}}',
                ],
            ]
        );
        // single counter margin
        $this->add_control(
            'counter_margin',
            [
                'label' => __( 'Margin', 'majharul_islam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .single_timer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // single counter text typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'counter_text_typography',
                'label' => __( 'Counter Text Typography', 'majharul_islam' ),
                'selector' => '{{WRAPPER}} .single_timer span',
            ]
        );

        // single counter text color
        $this->add_control(
            'counter_text_color',
            [
                'label' => __( 'Counter Text Color', 'majharul_islam' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single_timer span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

            $this->add_render_attribute(
                'count_down_options',
                [
                    'id'    => 'mmiclock',
                    'data-counter_date' => $settings['counter_date'],
                ]
            );
        ?>


        <div class="count_down_wrapper" style="text-align:<?php echo $settings['countdown_align'];?>" <?php echo $this->get_render_attribute_string( 'count_down_options' ); ?>>
            <div id="mmiclock"></div>
        </div>

        <?php
    }


}
Plugin::instance()->widgets_manager->register_widget_type( new Count_Down_Widgets() );