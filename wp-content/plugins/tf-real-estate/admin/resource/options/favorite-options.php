<?php
return array(
    'title'  => esc_html__('Favorite Options', 'tf-real-estate'),
    'id'     => 'favorite-options',
    'desc'   => '',
    'icon'   => 'el el-star',
    'fields' => array(
        array(
            'id'      => 'enable_favorite',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Favorite Properties', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'y',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'    => 'item_per_page_my_favorite',
            'type'  => 'text',
            'title' => esc_html__('Item Per Page My Favorite', 'tf-real-estate'),
        ),
    )
);
?>