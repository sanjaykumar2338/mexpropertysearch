<?php
return array(
    'id'     => 'email-options',
    'title'  => esc_html__('Email Templates', 'tf-real-estate'),
    'desc'   => '',
    'icon'   => 'el el-envelope',
    'fields' => array(
        // Approve Agent
        array(
            'id'     => 'begin_user_email_approve_agent',
            'type'   => 'section',
            'title'  => esc_html__('User Email Approve Agent', 'tf-real-estate'),
            'indent' => true
        ),
        array(
            'id'      => 'enable_user_email_approve_agent',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Send Email', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'y',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'       => 'subject_user_email_approve_agent',
            'type'     => 'text',
            'title'    => esc_html__('Subject', 'tf-real-estate'),
            'default'  => esc_html__('Approved Agent', 'tf-real-estate'),
            'required' => array( 'enable_user_email_approve_agent', '=', 'y' )
        ),
        array(
            'id'       => 'user_email_approve_agent',
            'type'     => 'editor',
            'title'    => esc_html__('Mail Body', 'tf-real-estate'),
            'default'  => esc_html__('Hi $agent_name,
            Your account on $website_url has been approved to agent account.
            Agent Name: $agent_name
            Thank you!', 'tf-real-estate'),
            'args'     => array(
                'wpautop'       => true,
                'media_buttons' => true,
                'textarea_rows' => 15,
                'quicktags'     => true,
            ),
            'required' => array( 'enable_user_email_approve_agent', '=', 'y' )
        ),
        array(
            'id'     => 'end_user_email_approve_agent',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'     => 'begin_admin_email_approve_agent',
            'type'   => 'section',
            'title'  => esc_html__('Admin Email Approve Agent', 'tf-real-estate'),
            'indent' => true
        ),
        array(
            'id'      => 'enable_admin_email_approve_agent',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Send Email', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'y',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'       => 'subject_admin_email_approve_agent',
            'type'     => 'text',
            'title'    => esc_html__('Subject', 'tf-real-estate'),
            'default'  => esc_html__('Agent Approval', 'tf-real-estate'),
            'required' => array( 'enable_admin_email_approve_agent', '=', 'y' ),
        ),
        array(
            'id'       => 'admin_email_approve_agent',
            'type'     => 'editor',
            'title'    => esc_html__('Mail Body', 'tf-real-estate'),
            'default'  => esc_html__('Hello Admin, 
            A new agent $agent_name is waiting for approval.
            Thank you!', 'tf-real-estate'),
            'args'     => array(
                'teeny'         => true,
                'textarea_rows' => 15
            ),
            'required' => array( 'enable_admin_email_approve_agent', '=', 'y' )
        ),
        array(
            'id'     => 'end_admin_email_approve_agent',
            'type'   => 'section',
            'indent' => false,
        ),

        // Matching new properties with saved searches
        array(
            'id'     => 'begin_user_email_matching_new_property',
            'type'   => 'section',
            'title'  => esc_html__('User Email matching new properties with saved searches', 'tf-real-estate'),
            'indent' => true
        ),
        array(
            'id'      => 'enable_user_email_matching_new_property',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Send Email', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'y',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'       => 'subject_user_email_matching_new_property',
            'type'     => 'text',
            'title'    => esc_html__('Subject', 'tf-real-estate'),
            'default'  => esc_html__('You have new properties matching with your saved advanced searches', 'tf-real-estate'),
            'required' => array( 'enable_user_email_matching_new_property', '=', 'y' ),
        ),
        array(
            'id'       => 'user_email_matching_new_property',
            'type'     => 'editor',
            'title'    => esc_html__('Mail Body', 'tf-real-estate'),
            'default'  => esc_html__('Hello, You have new listings properties matching with your saved advanced searches:
            $links_matching
            If you don\'t want to be receive this mail anymore in the future. Please login your dashboard and delete the saved advanced search.
            Thank you!', 'tf-real-estate'),
            'args'     => array(
                'teeny'         => true,
                'textarea_rows' => 15
            ),
            'required' => array( 'enable_user_email_matching_new_property', '=', 'y' )
        ),
        array(
            'id'     => 'end_user_email_matching_new_property',
            'type'   => 'section',
            'indent' => false,
        ),

        // Approve Property
        array(
            'id'     => 'begin_user_email_approve_property',
            'type'   => 'section',
            'title'  => esc_html__('User Email Approve Property', 'tf-real-estate'),
            'indent' => true
        ),
        array(
            'id'      => 'enable_user_email_approve_property',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Send Email', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'y',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'       => 'subject_user_email_approve_property',
            'type'     => 'text',
            'title'    => esc_html__('Subject', 'tf-real-estate'),
            'default'  => esc_html__('Your property approved!', 'tf-real-estate'),
            'required' => array( 'enable_user_email_approve_property', '=', 'y' ),
        ),
        array(
            'id'       => 'user_email_approve_property',
            'type'     => 'editor',
            'title'    => esc_html__('Mail Body', 'tf-real-estate'),
            'default'  => esc_html__('Hi $user_name,
            Your property on $website_url has been approved.
            
            Property Title: $property_title
            Property Url: $property_url
            Thank you!', 'tf-real-estate'),
            'args'     => array(
                'teeny'         => true,
                'textarea_rows' => 15
            ),
            'required' => array( 'enable_user_email_approve_property', '=', 'y' )
        ),
        array(
            'id'     => 'end_user_email_approve_property',
            'type'   => 'section',
            'indent' => false,
        ),

        // Paid Package
        array(
            'id'     => 'begin_user_email_paid_package',
            'type'   => 'section',
            'title'  => esc_html__('User Email Paid Package', 'tf-real-estate'),
            'indent' => true
        ),
        array(
            'id'      => 'enable_user_email_paid_package',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Send Email', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'y',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'       => 'subject_user_email_paid_package',
            'type'     => 'text',
            'title'    => esc_html__('Subject', 'tf-real-estate'),
            'default'  => esc_html__('Your purchase was successfully!', 'tf-real-estate'),
            'required' => array( 'enable_user_email_paid_package', '=', 'y' ),
        ),
        array(
            'id'       => 'user_email_paid_package',
            'type'     => 'editor',
            'title'    => esc_html__('Mail Body', 'tf-real-estate'),
            'default'  => esc_html__('Hi there,
            Welcome to $website_name and thank you for purchasing a package with us. We are excited you have chosen $website_name .
            Your package on $website_url purchasing successfully! You can now list your properties according with your plan.', 'tf-real-estate'),
            'args'     => array(
                'teeny'         => true,
                'textarea_rows' => 15
            ),
            'required' => array( 'enable_user_email_paid_package', '=', 'y' )
        ), 
        array(
            'id'     => 'end_user_email_paid_package',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'     => 'begin_admin_email_paid_package',
            'type'   => 'section',
            'title'  => esc_html__('Admin Email Paid Package', 'tf-real-estate'),
            'indent' => true
        ),
        array(
            'id'      => 'enable_admin_email_paid_package',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Send Email', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'y',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'       => 'subject_admin_email_paid_package',
            'type'     => 'text',
            'title'    => esc_html__('Subject', 'tf-real-estate'),
            'default'  => esc_html__('Somebody ordered a new Package!', 'tf-real-estate'),
            'required' => array( 'enable_admin_email_paid_package', '=', 'y' ),
        ),
        array(
            'id'       => 'admin_email_paid_package',
            'type'     => 'editor',
            'title'    => esc_html__('Mail Body', 'tf-real-estate'),
            'default'  => esc_html__('Hi there,
            Have new ordered package payment request on $website_url !
            Please follow the information below in order to activated package as soon as possible.
            The invoice number is: $invoice_no, Amount: $total_price.', 'tf-real-estate'),
            'args'     => array(
                'teeny'         => true,
                'textarea_rows' => 15
            ),
            'required' => array( 'enable_admin_email_paid_package', '=', 'y' )
        ), 
        array(
            'id'     => 'end_admin_email_paid_package',
            'type'   => 'section',
            'indent' => false,
        ),

        // Wire Transfer
        array(
            'id'     => 'begin_user_email_wire_transfer',
            'type'   => 'section',
            'title'  => esc_html__('User Email Wire Transfer', 'tf-real-estate'),
            'indent' => true
        ),
        array(
            'id'      => 'enable_user_email_wire_transfer',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Send Email', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'y',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'       => 'subject_user_email_wire_transfer',
            'type'     => 'text',
            'title'    => esc_html__('Subject', 'tf-real-estate'),
            'default'  => esc_html__('You ordered a new Wire Transfer!', 'tf-real-estate'),
            'required' => array( 'enable_user_email_wire_transfer', '=', 'y' ),
        ),
        array(
            'id'       => 'user_email_wire_transfer',
            'type'     => 'editor',
            'title'    => esc_html__('Mail Body', 'tf-real-estate'),
            'default'  => esc_html__('Hi there,
            We received your Wire Transfer payment request on $website_url !
            Please follow the information below in order to start submitting properties as soon as possible.
            The invoice number is: $invoice_no, Amount: $total_price.', 'tf-real-estate'),
            'args'     => array(
                'teeny'         => true,
                'textarea_rows' => 15
            ),
            'required' => array( 'enable_user_email_wire_transfer', '=', 'y' )
        ), 
        array(
            'id'     => 'end_user_email_wire_transfer',
            'type'   => 'section',
            'indent' => false,
        ),


        array(
            'id'     => 'begin_admin_email_wire_transfer',
            'type'   => 'section',
            'title'  => esc_html__('Admin Email Wire Transfer', 'tf-real-estate'),
            'indent' => true
        ),
        array(
            'id'      => 'enable_admin_email_wire_transfer',
            'type'    => 'button_set',
            'title'   => esc_html__('Enable Send Email', 'tf-real-estate'),
            'options' => array(
                'y' => esc_html__('Yes', 'tf-real-estate'),
                'n' => esc_html__('No', 'tf-real-estate'),
            ),
            'default' => 'y',
            'class'   => 'hide-icon-blank',
        ),
        array(
            'id'       => 'subject_admin_email_wire_transfer',
            'type'     => 'text',
            'title'    => esc_html__('Subject', 'tf-real-estate'),
            'default'  => esc_html__('Somebody ordered a new Wire Transfer!', 'tf-real-estate'),
            'required' => array( 'enable_admin_email_wire_transfer', '=', 'y' ),
        ),
        array(
            'id'       => 'admin_email_wire_transfer',
            'type'     => 'editor',
            'title'    => esc_html__('Mail Body', 'tf-real-estate'),
            'default'  => esc_html__('Hi there,
            A new Wire Transfer payment request on $website_url !
            The invoice number is: $invoice_no, Amount: $total_price.', 'tf-real-estate'),
            'args'     => array(
                'teeny'         => true,
                'textarea_rows' => 15
            ),
            'required' => array( 'enable_admin_email_wire_transfer', '=', 'y' )
        ), 
        array(
            'id'     => 'end_admin_email_wire_transfer',
            'type'   => 'section',
            'indent' => false,
        ),
    )
);
?>