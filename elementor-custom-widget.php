<?php

namespace Frame\Lesson;

class ElementorPostWidget extends \Elementor\Widget_Base {

  public function get_name() {
    return 'Lesson Posts';
  }

  public function get_title() {
    return 'Lesson Posts';
  }

  public function get_icon() {
    return 'fa fa-th';
  }

  public function get_categories() {
    return [ 'general' ];
  }

  protected function _register_controls() {

    $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'widget_title',
			[
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'plugin-domain' ),
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);

		$this->end_controls_section();

  }

  protected function render() {

    $settings = $this->get_settings_for_display();

    $lessons = get_posts(
      [
        'numberposts'	=> -1,
        'post_type' => 'lesson',
        'meta_query'	=> array(
      		'relation'		=> 'AND',
      		array(
      			'key'	 	    => 'course',
      			'value'	  	=> array(3),
      			'compare' 	=> 'IN',
      		)
      	),
      ]
    );

    $template = new \Frame\Template();
    $template->path = 'components/lesson/templates/';
    $template->name = 'lesson-filters';
    print $template->get();

    $template->name = 'lesson-list-item';
    foreach( $lessons as $lesson ) {
      $template->data = [
        'lesson' => $lesson,
        'settings' => $settings
      ];
      print $template->get();
    }

  }

  protected function content_template() {}

}
