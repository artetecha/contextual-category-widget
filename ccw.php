<?php
/*
Plugin Name: Contextual Category Widget
Plugin URI: https://github.com/artetecha.com
Description: A WordPress widget showing the description of the first category in the single post currently being displayed.
Version: 0.1
Author: Vincenzo Russo
Author URI: https://artetecha.com
License: GPL2
*/

/*  Copyright 2019  Vincenzo Russo  (email : v@artetecha.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class Contextual_Category_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'contextual_category_widget', // Base ID
            'Contextual Category Widget', // Name
            array( 'description' => 'A widget showing the description of the first category in the single post currently being displayed.', ) // Args
        );
    }

    public function widget( $args, $instance ) {
        if ( !is_single() ) {
            return false;
        }
        $cats = get_the_category();
        extract( $args );
        echo $before_widget;
        $title = $cats[0]->name;
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
        echo $cats[0]->category_description;
        echo $after_widget;
    }
}

function contextual_category_widget_init(){
    register_widget('Contextual_Category_Widget');
}


add_action( 'widgets_init', 'contextual_category_widget_init');
