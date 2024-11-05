<?php
return array(
    'id'     => 'archive-agent-options',
    'title'  => esc_html__('Archive Agent', 'tf-real-estate'),
    'icon'   => 'el el-folder-close',
    'fields' => array(
        array(
            'id'       => 'item_per_page_archive_agent',
            'type'     => 'text',
            'title'    => esc_html__('Item Agent Per Page', 'tf-real-estate'),
            'subtitle' => esc_html__('Set number of item per page archive agent.', 'tf-real-estate'),
            'default'  => esc_html__('10', 'tf-real-estate')
        ),
        array(
            'id'       => 'item_properties_per_page_single_agent',
            'type'     => 'text',
            'title'    => esc_html__('Item Properties Per Page Agent Single', 'tf-real-estate'),
            'subtitle' => esc_html__('Set number of properties item per page single agent.', 'tf-real-estate'),
            'default'  => esc_html__('4', 'tf-real-estate')
        ),
        array(
            'id'       => 'archive_agent_sidebar',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar', 'tf-real-estate'),
            'subtitle' => esc_html__('Enable/Disable sidebar.', 'tf-real-estate'),
            'class'    => 'hide-icon-blank',
            'options'  => array(
                'enable'  => esc_html__('Enable', 'tf-real-estate'),
                'disable' => esc_html__('Disable', 'tf-real-estate'),
            ),
            'default'  => 'disable',
        ),
        array(
            'id'       => 'archive_agent_sidebar_position',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Position', 'tf-real-estate'),
            'subtitle' => esc_html__('Choose sidebar position.', 'tf-real-estate'),
            'class'    => 'hide-icon-blank',
            'options'  => array(
                'sidebar-left'  => esc_html__('Sidebar Left', 'tf-real-estate'),
                'sidebar-right' => esc_html__('Sidebar Right', 'tf-real-estate'),
            ),
            'default'  => 'sidebar-right',
            'required' => array( 'archive_agent_sidebar', '=', 'enable' )
        ),
    )
);