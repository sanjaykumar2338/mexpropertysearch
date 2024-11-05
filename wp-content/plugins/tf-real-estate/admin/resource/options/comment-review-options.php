<?php
return array(
    'id'     => 'comment-review-options',
    'title'  => esc_html__('Comment & Review', 'tf-real-estate'),
    'desc'   => '',
    'icon'   => 'el el-comment',
    'fields' => array(
        array(
            'id'    => 'item_per_page_my_review',
            'type'  => 'text',
            'title' => esc_html__('Item Per Page My Reviews', 'tf-real-estate'),
        ),
        // Property
        array(
            'id'       => 'begin_comment_review_for_property',
            'type'     => 'accordion',
            'title'    => esc_html__('Property', 'tf-real-estate'),
            'position' => 'start',
            'open'     => false
        ),
        array(
            'id'      => 'enable_comment_review_property',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Comment & Review Property', 'tf-real-estate'),
            'options' => array(
                'hide'    => esc_html__('Hide', 'tf-real-estate'),
                'comment' => esc_html__('Comment', 'tf-real-estate'),
                'review'  => esc_html__('Review', 'tf-real-estate'),
            ),
            'default' => 'comment',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'       => 'enable_review_property_approve_by_admin',
            'type'     => 'button_set',
            'title'    => esc_html__('Enable Review Property Approve By Admin', 'tf-real-estate'),
            'options'  => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default'  => 'n',
            'class'    => 'hide-icon-blank',
            'required' => array( 'enable_comment_review_property', '=', 'review' )
        ),
        array(
            'id'       => 'end_comment_review_for_property',
            'type'     => 'accordion',
            'position' => 'end',
        ),
        // Agent
        array(
            'id'       => 'begin_comment_review_for_agent',
            'type'     => 'accordion',
            'title'    => esc_html__('Agent', 'tf-real-estate'),
            'position' => 'start',
            'open'     => false
        ),
        array(
            'id'      => 'enable_comment_review_agent',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Comment & Review Agent', 'tf-real-estate'),
            'options' => array(
                'hide'    => esc_html__('Hide', 'tf-real-estate'),
                'comment' => esc_html__('Comment', 'tf-real-estate'),
                'review'  => esc_html__('Review', 'tf-real-estate'),
            ),
            'default' => 'comment',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'       => 'enable_review_agent_approve_by_admin',
            'type'     => 'button_set',
            'title'    => esc_html__('Enable Review Agent Approve By Admin', 'tf-real-estate'),
            'options'  => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default'  => 'n',
            'class'    => 'hide-icon-blank',
            'required' => array( 'enable_comment_review_agent', '=', 'review' )
        ),
        array(
            'id'       => 'end_comment_review_for_agent',
            'type'     => 'accordion',
            'position' => 'end',
        ),
    )
);
?>