<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
require_once( TF_PLUGIN_PATH . 'includes/class-background-emailer.php' );

function tfre_get_option( $key, $default = '' ) {
	global $tfre_options;
	return ( isset( $tfre_options[ $key ] ) && ! empty( $tfre_options[ $key ] ) ) ? $tfre_options[ $key ] : $default;
}

function tfre_get_permalink( $page ) {
	$page_id = tfre_get_option( $page );
	if ( $page_id ) {
		$page_id = absint( function_exists( 'pll_get_post' ) ? pll_get_post( $page_id ) : $page_id );
	} else {
		$page_id = 0;
	}
	return get_permalink( $page_id );
}

function tfre_get_template_with_arguments( $template_name, $arguments = array(), $template_path = '', $default_path = '' ) {
	if ( ! empty( $arguments ) && is_array( $arguments ) ) {
		extract( $arguments );
	}

	if ( ! $template_path ) {
		$template_path = TF_PLUGIN_PATH;
	}

	if ( ! $default_path ) {
		$default_path = TF_PLUGIN_PATH . '/public/templates/';
	}

	$template = locate_template( $template_name . '.php', false );

	// Get default template
	if ( ! $template ) {
		$template = $default_path . $template_name;
	}

	if ( ! file_exists( $template ) ) {
		return;
	}

	include( $template );
}

function tfre_get_template_widget_elementor( $template_name, $args = array(), $return = false ) {
	$template_file  = $template_name . '.php';
	$default_folder = TF_PLUGIN_PATH . 'includes/elementor-widget/';
	$theme_folder   = TF_PLUGIN_PATH;
	$template       = locate_template( $theme_folder . '/' . $template_file );
	if ( ! $template ) {
		$template = $default_folder . $template_file;
	}
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args );
	}
	if ( $return ) {
		ob_start();
	}
	if ( file_exists( $template ) ) {
		include $template;
	}
	if ( $return ) {
		return ob_get_clean();
	}
	return null;
}

function tfre_format_price( $price_value = '', $price_unit = '', $decimals = false, $short_price_unit = false ) {
	if ( ctype_digit( $price_value ) ) {
		$decimals = false;
	}

	if ( ! $decimals ) {
		$decimals = 0;
	} else {
		$decimals = tfre_get_option( 'number_of_decimal_digits', '1' );
	}

	$price_value         = doubleval( $price_value );
	$currency_sign       = tfre_get_option( 'currency_sign', '' );
	$currency_position   = tfre_get_option( 'currency_sign_position', esc_html__( 'before', 'tf-real-estate' ) );
	$decimal_separator   = tfre_get_option( 'decimal_separator', ',' );
	$thousands_separator = tfre_get_option( 'thousand_separator', '.' );
	$thousand_text       = esc_html__( 'thousand', 'tf-real-estate' );
	$million_text        = esc_html__( 'million', 'tf-real-estate' );
	$billion_text        = esc_html__( 'billion', 'tf-real-estate' );
	$thousand_short_text = tfre_get_option( 'thousand_text', $thousand_text );
	$million_short_text  = tfre_get_option( 'million_text', $million_text );
	$billion_short_text  = tfre_get_option( 'billion_text', $billion_text );
	$format_price        = number_format( $price_value, $decimals, $decimal_separator, $thousands_separator );

	if ( $price_unit !== '' ) {
		$unit_text  = '';
		$price_unit = intval( $price_unit );
		switch ( $price_unit ) {
			case 1000:
				$unit_text = $short_price_unit ? $thousand_short_text : $thousand_text;
				break;
			case 1000000:
				$unit_text = $short_price_unit ? $million_short_text : $million_text;
				break;
			case 1000000000:
				$unit_text = $short_price_unit ? $billion_short_text : $billion_text;
				break;
		}
		if ( $unit_text !== '' ) {
			$format_price = $format_price . ' ' . $unit_text . ' ';
		}
	}

	if ( $currency_position == 'before' ) {
		$format_price = $currency_sign . $format_price;
	} else {
		$format_price = $format_price . $currency_sign;
	}
	return $format_price;
}

function tfre_list_countries() {
	$countries = array(
		'AF' => esc_html__( 'Afghanistan', 'tf-real-estate' ),
		'AX' => esc_html__( 'Aland Islands', 'tf-real-estate' ),
		'AL' => esc_html__( 'Albania', 'tf-real-estate' ),
		'DZ' => esc_html__( 'Algeria', 'tf-real-estate' ),
		'AS' => esc_html__( 'American Samoa', 'tf-real-estate' ),
		'AD' => esc_html__( 'Andorra', 'tf-real-estate' ),
		'AO' => esc_html__( 'Angola', 'tf-real-estate' ),
		'AI' => esc_html__( 'Anguilla', 'tf-real-estate' ),
		'AQ' => esc_html__( 'Antarctica', 'tf-real-estate' ),
		'AG' => esc_html__( 'Antigua and Barbuda', 'tf-real-estate' ),
		'AR' => esc_html__( 'Argentina', 'tf-real-estate' ),
		'AM' => esc_html__( 'Armenia', 'tf-real-estate' ),
		'AW' => esc_html__( 'Aruba', 'tf-real-estate' ),
		'AU' => esc_html__( 'Australia', 'tf-real-estate' ),
		'AT' => esc_html__( 'Austria', 'tf-real-estate' ),
		'AZ' => esc_html__( 'Azerbaijan', 'tf-real-estate' ),
		'BS' => esc_html__( 'Bahamas the', 'tf-real-estate' ),
		'BH' => esc_html__( 'Bahrain', 'tf-real-estate' ),
		'BD' => esc_html__( 'Bangladesh', 'tf-real-estate' ),
		'BB' => esc_html__( 'Barbados', 'tf-real-estate' ),
		'BY' => esc_html__( 'Belarus', 'tf-real-estate' ),
		'BE' => esc_html__( 'Belgium', 'tf-real-estate' ),
		'BZ' => esc_html__( 'Belize', 'tf-real-estate' ),
		'BJ' => esc_html__( 'Benin', 'tf-real-estate' ),
		'BM' => esc_html__( 'Bermuda', 'tf-real-estate' ),
		'BT' => esc_html__( 'Bhutan', 'tf-real-estate' ),
		'BO' => esc_html__( 'Bolivia', 'tf-real-estate' ),
		'BA' => esc_html__( 'Bosnia and Herzegovina', 'tf-real-estate' ),
		'BW' => esc_html__( 'Botswana', 'tf-real-estate' ),
		'BV' => esc_html__( 'Bouvet Island (Bouvetoya)', 'tf-real-estate' ),
		'BR' => esc_html__( 'Brazil', 'tf-real-estate' ),
		'IO' => esc_html__( 'British Indian Ocean Territory (Chagos Archipelago)', 'tf-real-estate' ),
		'VG' => esc_html__( 'British Virgin Islands', 'tf-real-estate' ),
		'BN' => esc_html__( 'Brunei Darussalam', 'tf-real-estate' ),
		'BG' => esc_html__( 'Bulgaria', 'tf-real-estate' ),
		'BF' => esc_html__( 'Burkina Faso', 'tf-real-estate' ),
		'BI' => esc_html__( 'Burundi', 'tf-real-estate' ),
		'KH' => esc_html__( 'Cambodia', 'tf-real-estate' ),
		'CM' => esc_html__( 'Cameroon', 'tf-real-estate' ),
		'CA' => esc_html__( 'Canada', 'tf-real-estate' ),
		'CV' => esc_html__( 'Cape Verde', 'tf-real-estate' ),
		'KY' => esc_html__( 'Cayman Islands', 'tf-real-estate' ),
		'CF' => esc_html__( 'Central African Republic', 'tf-real-estate' ),
		'TD' => esc_html__( 'Chad', 'tf-real-estate' ),
		'CL' => esc_html__( 'Chile', 'tf-real-estate' ),
		'CN' => esc_html__( 'China', 'tf-real-estate' ),
		'CX' => esc_html__( 'Christmas Island', 'tf-real-estate' ),
		'CC' => esc_html__( 'Cocos (Keeling) Islands', 'tf-real-estate' ),
		'CO' => esc_html__( 'Colombia', 'tf-real-estate' ),
		'KM' => esc_html__( 'Comoros the', 'tf-real-estate' ),
		'CD' => esc_html__( 'Congo', 'tf-real-estate' ),
		'CG' => esc_html__( 'Congo the', 'tf-real-estate' ),
		'CK' => esc_html__( 'Cook Islands', 'tf-real-estate' ),
		'CR' => esc_html__( 'Costa Rica', 'tf-real-estate' ),
		'CI' => esc_html__( "Cote d'Ivoire", 'tf-real-estate' ),
		'HR' => esc_html__( 'Croatia', 'tf-real-estate' ),
		'CU' => esc_html__( 'Cuba', 'tf-real-estate' ),
		'CY' => esc_html__( 'Cyprus', 'tf-real-estate' ),
		'CZ' => esc_html__( 'Czech Republic', 'tf-real-estate' ),
		'DK' => esc_html__( 'Denmark', 'tf-real-estate' ),
		'DJ' => esc_html__( 'Djibouti', 'tf-real-estate' ),
		'DM' => esc_html__( 'Dominica', 'tf-real-estate' ),
		'DO' => esc_html__( 'Dominican Republic', 'tf-real-estate' ),
		'EC' => esc_html__( 'Ecuador', 'tf-real-estate' ),
		'EG' => esc_html__( 'Egypt', 'tf-real-estate' ),
		'SV' => esc_html__( 'El Salvador', 'tf-real-estate' ),
		'GQ' => esc_html__( 'Equatorial Guinea', 'tf-real-estate' ),
		'ER' => esc_html__( 'Eritrea', 'tf-real-estate' ),
		'EE' => esc_html__( 'Estonia', 'tf-real-estate' ),
		'ET' => esc_html__( 'Ethiopia', 'tf-real-estate' ),
		'FO' => esc_html__( 'Faroe Islands', 'tf-real-estate' ),
		'FK' => esc_html__( 'Falkland Islands (Malvinas)', 'tf-real-estate' ),
		'FJ' => esc_html__( 'Fiji the Fiji Islands', 'tf-real-estate' ),
		'FI' => esc_html__( 'Finland', 'tf-real-estate' ),
		'FR' => esc_html__( 'France', 'tf-real-estate' ),
		'GF' => esc_html__( 'French Guiana', 'tf-real-estate' ),
		'PF' => esc_html__( 'French Polynesia', 'tf-real-estate' ),
		'TF' => esc_html__( 'French Southern Territories', 'tf-real-estate' ),
		'GA' => esc_html__( 'Gabon', 'tf-real-estate' ),
		'GM' => esc_html__( 'Gambia the', 'tf-real-estate' ),
		'GE' => esc_html__( 'Georgia', 'tf-real-estate' ),
		'DE' => esc_html__( 'Germany', 'tf-real-estate' ),
		'GH' => esc_html__( 'Ghana', 'tf-real-estate' ),
		'GI' => esc_html__( 'Gibraltar', 'tf-real-estate' ),
		'GR' => esc_html__( 'Greece', 'tf-real-estate' ),
		'GL' => esc_html__( 'Greenland', 'tf-real-estate' ),
		'GD' => esc_html__( 'Grenada', 'tf-real-estate' ),
		'GP' => esc_html__( 'Guadeloupe', 'tf-real-estate' ),
		'GU' => esc_html__( 'Guam', 'tf-real-estate' ),
		'GT' => esc_html__( 'Guatemala', 'tf-real-estate' ),
		'GG' => esc_html__( 'Guernsey', 'tf-real-estate' ),
		'GN' => esc_html__( 'Guinea', 'tf-real-estate' ),
		'GW' => esc_html__( 'Guinea-Bissau', 'tf-real-estate' ),
		'GY' => esc_html__( 'Guyana', 'tf-real-estate' ),
		'HT' => esc_html__( 'Haiti', 'tf-real-estate' ),
		'HM' => esc_html__( 'Heard Island and McDonald Islands', 'tf-real-estate' ),
		'VA' => esc_html__( 'Holy See (Vatican City State)', 'tf-real-estate' ),
		'HN' => esc_html__( 'Honduras', 'tf-real-estate' ),
		'HK' => esc_html__( 'Hong Kong', 'tf-real-estate' ),
		'HU' => esc_html__( 'Hungary', 'tf-real-estate' ),
		'IS' => esc_html__( 'Iceland', 'tf-real-estate' ),
		'IN' => esc_html__( 'India', 'tf-real-estate' ),
		'ID' => esc_html__( 'Indonesia', 'tf-real-estate' ),
		'IR' => esc_html__( 'Iran', 'tf-real-estate' ),
		'IQ' => esc_html__( 'Iraq', 'tf-real-estate' ),
		'IE' => esc_html__( 'Ireland', 'tf-real-estate' ),
		'IM' => esc_html__( 'Isle of Man', 'tf-real-estate' ),
		'IL' => esc_html__( 'Israel', 'tf-real-estate' ),
		'IT' => esc_html__( 'Italy', 'tf-real-estate' ),
		'JM' => esc_html__( 'Jamaica', 'tf-real-estate' ),
		'JP' => esc_html__( 'Japan', 'tf-real-estate' ),
		'JE' => esc_html__( 'Jersey', 'tf-real-estate' ),
		'JO' => esc_html__( 'Jordan', 'tf-real-estate' ),
		'KZ' => esc_html__( 'Kazakhstan', 'tf-real-estate' ),
		'KE' => esc_html__( 'Kenya', 'tf-real-estate' ),
		'KI' => esc_html__( 'Kiribati', 'tf-real-estate' ),
		'KP' => esc_html__( 'Korea', 'tf-real-estate' ),
		'KR' => esc_html__( 'Korea', 'tf-real-estate' ),
		'KW' => esc_html__( 'Kuwait', 'tf-real-estate' ),
		'KG' => esc_html__( 'Kyrgyz Republic', 'tf-real-estate' ),
		'LA' => esc_html__( 'Lao', 'tf-real-estate' ),
		'LV' => esc_html__( 'Latvia', 'tf-real-estate' ),
		'LB' => esc_html__( 'Lebanon', 'tf-real-estate' ),
		'LS' => esc_html__( 'Lesotho', 'tf-real-estate' ),
		'LR' => esc_html__( 'Liberia', 'tf-real-estate' ),
		'LY' => esc_html__( 'Libyan Arab Jamahiriya', 'tf-real-estate' ),
		'LI' => esc_html__( 'Liechtenstein', 'tf-real-estate' ),
		'LT' => esc_html__( 'Lithuania', 'tf-real-estate' ),
		'LU' => esc_html__( 'Luxembourg', 'tf-real-estate' ),
		'MO' => esc_html__( 'Macao', 'tf-real-estate' ),
		'MK' => esc_html__( 'Macedonia', 'tf-real-estate' ),
		'MG' => esc_html__( 'Madagascar', 'tf-real-estate' ),
		'MW' => esc_html__( 'Malawi', 'tf-real-estate' ),
		'MY' => esc_html__( 'Malaysia', 'tf-real-estate' ),
		'MV' => esc_html__( 'Maldives', 'tf-real-estate' ),
		'ML' => esc_html__( 'Mali', 'tf-real-estate' ),
		'MT' => esc_html__( 'Malta', 'tf-real-estate' ),
		'MH' => esc_html__( 'Marshall Islands', 'tf-real-estate' ),
		'MQ' => esc_html__( 'Martinique', 'tf-real-estate' ),
		'MR' => esc_html__( 'Mauritania', 'tf-real-estate' ),
		'MU' => esc_html__( 'Mauritius', 'tf-real-estate' ),
		'YT' => esc_html__( 'Mayotte', 'tf-real-estate' ),
		'MX' => esc_html__( 'Mexico', 'tf-real-estate' ),
		'FM' => esc_html__( 'Micronesia', 'tf-real-estate' ),
		'MD' => esc_html__( 'Moldova', 'tf-real-estate' ),
		'MC' => esc_html__( 'Monaco', 'tf-real-estate' ),
		'MN' => esc_html__( 'Mongolia', 'tf-real-estate' ),
		'ME' => esc_html__( 'Montenegro', 'tf-real-estate' ),
		'MS' => esc_html__( 'Montserrat', 'tf-real-estate' ),
		'MA' => esc_html__( 'Morocco', 'tf-real-estate' ),
		'MZ' => esc_html__( 'Mozambique', 'tf-real-estate' ),
		'MM' => esc_html__( 'Myanmar', 'tf-real-estate' ),
		'NA' => esc_html__( 'Namibia', 'tf-real-estate' ),
		'NR' => esc_html__( 'Nauru', 'tf-real-estate' ),
		'NP' => esc_html__( 'Nepal', 'tf-real-estate' ),
		'AN' => esc_html__( 'Netherlands Antilles', 'tf-real-estate' ),
		'NL' => esc_html__( 'Netherlands the', 'tf-real-estate' ),
		'NC' => esc_html__( 'New Caledonia', 'tf-real-estate' ),
		'NZ' => esc_html__( 'New Zealand', 'tf-real-estate' ),
		'NI' => esc_html__( 'Nicaragua', 'tf-real-estate' ),
		'NE' => esc_html__( 'Niger', 'tf-real-estate' ),
		'NG' => esc_html__( 'Nigeria', 'tf-real-estate' ),
		'NU' => esc_html__( 'Niue', 'tf-real-estate' ),
		'NF' => esc_html__( 'Norfolk Island', 'tf-real-estate' ),
		'MP' => esc_html__( 'Northern Mariana Islands', 'tf-real-estate' ),
		'NO' => esc_html__( 'Norway', 'tf-real-estate' ),
		'OM' => esc_html__( 'Oman', 'tf-real-estate' ),
		'PK' => esc_html__( 'Pakistan', 'tf-real-estate' ),
		'PW' => esc_html__( 'Palau', 'tf-real-estate' ),
		'PS' => esc_html__( 'Palestinian Territory', 'tf-real-estate' ),
		'PA' => esc_html__( 'Panama', 'tf-real-estate' ),
		'PG' => esc_html__( 'Papua New Guinea', 'tf-real-estate' ),
		'PY' => esc_html__( 'Paraguay', 'tf-real-estate' ),
		'PE' => esc_html__( 'Peru', 'tf-real-estate' ),
		'PH' => esc_html__( 'Philippines', 'tf-real-estate' ),
		'PN' => esc_html__( 'Pitcairn Islands', 'tf-real-estate' ),
		'PL' => esc_html__( 'Poland', 'tf-real-estate' ),
		'PT' => esc_html__( 'Portugal, Portuguese Republic', 'tf-real-estate' ),
		'PR' => esc_html__( 'Puerto Rico', 'tf-real-estate' ),
		'QA' => esc_html__( 'Qatar', 'tf-real-estate' ),
		'RE' => esc_html__( 'Reunion', 'tf-real-estate' ),
		'RO' => esc_html__( 'Romania', 'tf-real-estate' ),
		'RU' => esc_html__( 'Russian Federation', 'tf-real-estate' ),
		'RW' => esc_html__( 'Rwanda', 'tf-real-estate' ),
		'BL' => esc_html__( 'Saint Barthelemy', 'tf-real-estate' ),
		'SH' => esc_html__( 'Saint Helena', 'tf-real-estate' ),
		'KN' => esc_html__( 'Saint Kitts and Nevis', 'tf-real-estate' ),
		'LC' => esc_html__( 'Saint Lucia', 'tf-real-estate' ),
		'MF' => esc_html__( 'Saint Martin', 'tf-real-estate' ),
		'PM' => esc_html__( 'Saint Pierre and Miquelon', 'tf-real-estate' ),
		'VC' => esc_html__( 'Saint Vincent and the Grenadines', 'tf-real-estate' ),
		'WS' => esc_html__( 'Samoa', 'tf-real-estate' ),
		'SM' => esc_html__( 'San Marino', 'tf-real-estate' ),
		'ST' => esc_html__( 'Sao Tome and Principe', 'tf-real-estate' ),
		'SA' => esc_html__( 'Saudi Arabia', 'tf-real-estate' ),
		'SN' => esc_html__( 'Senegal', 'tf-real-estate' ),
		'RS' => esc_html__( 'Serbia', 'tf-real-estate' ),
		'SC' => esc_html__( 'Seychelles', 'tf-real-estate' ),
		'SL' => esc_html__( 'Sierra Leone', 'tf-real-estate' ),
		'SG' => esc_html__( 'Singapore', 'tf-real-estate' ),
		'SK' => esc_html__( 'Slovakia (Slovak Republic)', 'tf-real-estate' ),
		'SI' => esc_html__( 'Slovenia', 'tf-real-estate' ),
		'SB' => esc_html__( 'Solomon Islands', 'tf-real-estate' ),
		'SO' => esc_html__( 'Somalia, Somali Republic', 'tf-real-estate' ),
		'ZA' => esc_html__( 'South Africa', 'tf-real-estate' ),
		'GS' => esc_html__( 'South Georgia and the South Sandwich Islands', 'tf-real-estate' ),
		'ES' => esc_html__( 'Spain', 'tf-real-estate' ),
		'LK' => esc_html__( 'Sri Lanka', 'tf-real-estate' ),
		'SD' => esc_html__( 'Sudan', 'tf-real-estate' ),
		'SR' => esc_html__( 'Suriname', 'tf-real-estate' ),
		'SJ' => esc_html__( 'Svalbard & Jan Mayen Islands', 'tf-real-estate' ),
		'SZ' => esc_html__( 'Swaziland', 'tf-real-estate' ),
		'SE' => esc_html__( 'Sweden', 'tf-real-estate' ),
		'CH' => esc_html__( 'Switzerland, Swiss Confederation', 'tf-real-estate' ),
		'SY' => esc_html__( 'Syrian Arab Republic', 'tf-real-estate' ),
		'TW' => esc_html__( 'Taiwan', 'tf-real-estate' ),
		'TJ' => esc_html__( 'Tajikistan', 'tf-real-estate' ),
		'TZ' => esc_html__( 'Tanzania', 'tf-real-estate' ),
		'TH' => esc_html__( 'Thailand', 'tf-real-estate' ),
		'TL' => esc_html__( 'Timor-Leste', 'tf-real-estate' ),
		'TG' => esc_html__( 'Togo', 'tf-real-estate' ),
		'TK' => esc_html__( 'Tokelau', 'tf-real-estate' ),
		'TO' => esc_html__( 'Tonga', 'tf-real-estate' ),
		'TT' => esc_html__( 'Trinidad and Tobago', 'tf-real-estate' ),
		'TN' => esc_html__( 'Tunisia', 'tf-real-estate' ),
		'TR' => esc_html__( 'Turkey', 'tf-real-estate' ),
		'TM' => esc_html__( 'Turkmenistan', 'tf-real-estate' ),
		'TC' => esc_html__( 'Turks and Caicos Islands', 'tf-real-estate' ),
		'TV' => esc_html__( 'Tuvalu', 'tf-real-estate' ),
		'UG' => esc_html__( 'Uganda', 'tf-real-estate' ),
		'UA' => esc_html__( 'Ukraine', 'tf-real-estate' ),
		'AE' => esc_html__( 'United Arab Emirates', 'tf-real-estate' ),
		'GB' => esc_html__( 'United Kingdom', 'tf-real-estate' ),
		'US' => esc_html__( 'United States', 'tf-real-estate' ),
		'UM' => esc_html__( 'United States Minor Outlying Islands', 'tf-real-estate' ),
		'VI' => esc_html__( 'United States Virgin Islands', 'tf-real-estate' ),
		'UY' => esc_html__( 'Uruguay, Eastern Republic of', 'tf-real-estate' ),
		'UZ' => esc_html__( 'Uzbekistan', 'tf-real-estate' ),
		'VU' => esc_html__( 'Vanuatu', 'tf-real-estate' ),
		'VE' => esc_html__( 'Venezuela', 'tf-real-estate' ),
		'VN' => esc_html__( 'Vietnam', 'tf-real-estate' ),
		'WF' => esc_html__( 'Wallis and Futuna', 'tf-real-estate' ),
		'EH' => esc_html__( 'Western Sahara', 'tf-real-estate' ),
		'YE' => esc_html__( 'Yemen', 'tf-real-estate' ),
		'ZM' => esc_html__( 'Zambia', 'tf-real-estate' ),
		'ZW' => esc_html__( 'Zimbabwe', 'tf-real-estate' ),
		'SS' => esc_html__( 'South Sudan', 'tf-real-estate' )
	);
	return $countries;
}

function tfre_list_language_datepicker() {
	$languages = array(
		'af'    => 'Afrikaans',
		'ar'    => 'Arabic',
		'ar-DZ' => 'Algerian',
		'az'    => 'Azerbaijani',
		'be'    => 'Belarusian',
		'bg'    => 'Bulgarian',
		'bs'    => 'Bosnian',
		'ca'    => 'Catalan',
		'cs'    => 'Czech',
		'cy-GB' => 'Welsh/UK',
		'da'    => 'Danish',
		'de'    => 'German',
		'el'    => 'Greek',
		'en-AU' => 'English/Australia',
		'en-GB' => 'English/UK',
		'en-NZ' => 'English/New Zealand',
		'eo'    => 'Esperanto',
		'es'    => 'Spanish',
		'et'    => 'Estonian',
		'eu'    => 'Karrikas-ek',
		'fa'    => 'Persian',
		'fi'    => 'Finnish',
		'fo'    => 'Faroese',
		'fr'    => 'French',
		'fr-CA' => 'Canadian-French',
		'fr-CH' => 'Swiss-French',
		'gl'    => 'Galician',
		'he'    => 'Hebrew',
		'hi'    => 'Hindi',
		'hr'    => 'Croatian',
		'hu'    => 'Hungarian',
		'hy'    => 'Armenian',
		'id'    => 'Indonesian',
		'ic'    => 'Icelandic',
		'it'    => 'Italian',
		'it-CH' => 'Italian-CH',
		'ja'    => 'Japanese',
		'ka'    => 'Georgian',
		'kk'    => 'Kazakh',
		'km'    => 'Khmer',
		'ko'    => 'Korean',
		'ky'    => 'Kyrgyz',
		'lb'    => 'Luxembourgish',
		'lt'    => 'Lithuanian',
		'lv'    => 'Latvian',
		'mk'    => 'Macedonian',
		'ml'    => 'Malayalam',
		'ms'    => 'Malaysian',
		'nb'    => 'Norwegian',
		'nl'    => 'Dutch',
		'nl-BE' => 'Dutch-Belgium',
		'nn'    => 'Norwegian-Nynorsk',
		'no'    => 'Norwegian',
		'pl'    => 'Polish',
		'pt'    => 'Portuguese',
		'pt-BR' => 'Brazilian',
		'rm'    => 'Romansh',
		'ro'    => 'Romanian',
		'ru'    => 'Russian',
		'sk'    => 'Slovak',
		'sl'    => 'Slovenian',
		'sq'    => 'Albanian',
		'sr'    => 'Serbian',
		'sr-SR' => 'Serbian-i18n',
		'sv'    => 'Swedish',
		'ta'    => 'Tamil',
		'th'    => 'Thai',
		'tj'    => 'Tajiki',
		'tr'    => 'Turkish',
		'uk'    => 'Ukrainian',
		'vi'    => 'Vietnamese',
		'zh-CN' => 'Chinese',
		'zh-HK' => 'Chinese-Hong-Kong',
		'zh-TW' => 'Chinese Taiwan',
	);
	return $languages;
}

function tfre_selected_countries() {
	$countries_selected = get_option( 'country_list' );
	$countries_list     = tfre_list_countries();
	if ( ! empty( $countries_selected ) && is_array( $countries_selected ) ) {
		$results = array();
		foreach ( $countries_selected as $country ) {
			foreach ( $countries_list as $key => $value ) {
				if ( $country === $key ) {
					$results[ $key ] = $value;
				}
			}
		}
		return $results;
	} else {
		return $countries_list;
	}
}

function tfre_get_taxonomy_options( $taxonomy_name, $selected_value = '', $is_value_slug = false, $display_default = true, $parent = 0, $prefix = '' ) {
	$taxonomies = get_categories(
		array(
			'taxonomy'   => $taxonomy_name,
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => false,
			'parent'     => $parent
		)
	);
	if ( $display_default && $parent === 0 ) {
		echo '<option value="" selected>' . esc_html__( 'None', 'tf-real-estate' ) . '</option>';
	}
	if ( ! empty( $taxonomies ) ) {
		foreach ( $taxonomies as $taxonomy ) {
			if ( empty( $taxonomy ) || ( ! isset( $taxonomy->parent ) ) )
				continue;
			if ( ( (int) $taxonomy->parent !== (int) $parent ) || ( $parent === null ) || ( $taxonomy->parent === null ) )
				continue;

			if ( $is_value_slug ) {
				echo '<option ' . selected( $selected_value, $taxonomy->slug, false ) . ' value="' . esc_attr( $taxonomy->slug ) . '">' . esc_html( $prefix . $taxonomy->name ) . '</option>';
			} else {
				echo '<option ' . selected( $selected_value, $taxonomy->term_id, false ) . ' value="' . esc_attr( $taxonomy->term_id ) . '">' . esc_html( $prefix . $taxonomy->name ) . '</option>';
			}

			tfre_get_taxonomy_options( $taxonomy_name, $selected_value, $is_value_slug, $display_default, $taxonomy->term_id, $prefix . '' );
		}
	}
}

function tfre_get_single_taxonomy_by_post_id( $post_id, $taxonomy_name, $is_value_slug ) {
	$tax_terms = get_the_terms( $post_id, $taxonomy_name );
	$tax_name  = '';
	if ( ! empty( $tax_terms ) ) {
		foreach ( $tax_terms as $tax_term ) {
			if ( is_object( $tax_term ) ) {
				if ( $is_value_slug ) {
					$tax_name = $tax_term->slug;
				} else {
					$tax_name = $tax_term->name;
				}
			}
			break;
		}
	}
	return $tax_name;
}

function tfre_get_multiple_taxonomy_by_post_id( $post_id, $taxonomy_name, $is_value_by_id = false, $show_default = true, $is_multiple = false, $parent = 0, $prefix = '', $value = null ) {
	$taxonomy_terms = get_categories(
		array(
			'taxonomy'   => $taxonomy_name,
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => false,
			'parent'     => $parent
		)
	);
	$value_by_id    = $value != null ? $value : ( $is_multiple ? array() : 0 );
	$tax_terms      = $value != null ? '' : get_the_terms( $post_id, $taxonomy_name );

	if ( $is_value_by_id ) {
		if ( ! empty( $tax_terms ) ) {
			foreach ( $tax_terms as $tax_term ) {
				if ( $is_multiple ) {
					$value_by_id[] = $tax_term->term_id;
				} else {
					$value_by_id = $tax_term->term_id;
					break;
				}
			}
		}
		if ( $show_default && $parent === 0 ) {
			if ( empty( $value_by_id ) ) {
				echo '<option value="-1" selected>' . esc_html__( 'None', 'tf-real-estate' ) . '</option>';
			} else {
				echo '<option value="-1">' . esc_html__( 'None', 'tf-real-estate' ) . '</option>';
			}
		}

		if ( ! empty( $taxonomy_terms ) ) {
			foreach ( $taxonomy_terms as $term ) {
				if ( empty( $term ) || ( ! isset( $term->parent ) ) ) {
					continue;
				}
				if ( ( (int) $term->parent !== (int) $parent ) || ( $parent === null ) || ( $term->parent === null ) ) {
					continue;
				}

				if ( ( is_array( $value_by_id ) && in_array( $term->term_id, $value_by_id ) ) || ( $value_by_id == $term->term_id ) ) {
					echo '<option value="' . esc_attr( $term->term_id ) . '" selected>' . esc_html( $prefix . $term->name ) . '</option>';
				} else {
					echo '<option value="' . esc_attr( $term->term_id ) . '">' . esc_html( $prefix . $term->name ) . '</option>';
				}

				tfre_get_multiple_taxonomy_by_post_id( $post_id, $taxonomy_name, $is_value_by_id, $show_default, $is_multiple, $term->term_id, $prefix . '&#8212;', $value_by_id );
			}
		}
	}
}

function tfre_check_value_is_selected_option( $property_price_unit_value, $value ) {

	if ( $property_price_unit_value == $value ) {
		echo ( 'selected' );
	}
}

function tfre_check_value_is_checked_option( $property_price_unit_value, $value ) {

	if ( $property_price_unit_value == $value ) {
		echo ( 'checked' );
	}
}

function tfre_sanitize_wp_filter_post_kses( $data ) {
	if ( is_array( $data ) ) {
		return array_map( 'tfre_sanitize_wp_filter_post_kses', $data );
	} else {
		return is_scalar( $data ) ? wp_filter_post_kses( wp_unslash( $data ) ) : $data;
	}
}

function tfre_send_email( $email, $email_template, $args = array() ) {
	$tfre_background_emailer = new Email_Background_Process();

	// $tfre_background_emailer->push_to_queue( array( 
	//     'email' => $email,
	//     'email_template' =>$email_template,
	//     'args'=>$args) 
	// );
	// $tfre_background_emailer->save()->dispatch();

	$tfre_background_emailer->task(
		array(
			'email_template' => $email_template,
			'email'          => $email,
			'args'           => $args,
		)
	);
}

function tfre_get_categories( $category_name ) {
	$list_categories = get_categories(
		array(
			'taxonomy'   => $category_name,
			'hide_empty' => false,
			'orderby'    => 'name',
			'order'      => 'ASC',
			'parent'     => 0
		)
	);
	return $list_categories;
}

function tfre_get_options_status_advanced_search_by_slug( $value_status = '', $prefix = '' ) {
	$property_status = tfre_get_categories( 'property-status' );
	if ( ! empty( $property_status ) ) {
		foreach ( $property_status as $term ) {
			if ( $value_status == $term->slug ) {
				echo '<option value="' . esc_attr( $term->slug ) . '" selected>' . esc_html( $prefix . $term->name ) . '</option>';
			} else {
				echo '<option value="' . esc_attr( $term->slug ) . '">' . esc_html( $prefix . $term->name ) . '</option>';
			}
		}
	}
}

function tfre_get_option_measurement_units() {
	$measurement_units = tfre_get_option( 'measurement_units', 'SqFt' );
	if ( $measurement_units === 'custom' ) {
		return tfre_get_option( 'custom_measurement_units', 'SqFt' );
	} else {
		if ( $measurement_units === 'm2' ) {
			$measurement_units = 'm<sup>2</sup>';
		}
		return $measurement_units;
	}
}

function tfre_get_option_measurement_units_land() {
	$measurement_units = tfre_get_option( 'measurement_units', '' );
	if ( empty( $measurement_units ) ) {
		$measurement_units = tfre_get_option_measurement_units();
	}
	if ( $measurement_units == 'custom' ) {
		return tfre_get_option( 'custom_measurement_units', 'SqFt' );
	} else {
		if ( $measurement_units === 'm2' ) {
			$measurement_units = 'm<sup>2</sup>';
		}
		return $measurement_units;
	}
}

function tfre_get_option_measurement_units_garage() {
	$measurement_units = tfre_get_option( 'measurement_units', '' );
	if ( empty( $measurement_units ) ) {
		$measurement_units = tfre_get_option_measurement_units();
	}
	if ( $measurement_units == 'custom' ) {
		return tfre_get_option( 'custom_measurement_units', 'SqFt' );
	} else {
		if ( $measurement_units === 'm2' ) {
			$measurement_units = 'm<sup>2</sup>';
		}
		return $measurement_units;
	}
}

function tfre_get_format_number( $number, $decimals = 0 ) {
	if ( $number === '' ) {
		return 0;
	}

	$number_floor = floor( $number );

	$decimal_sep   = tfre_get_option( 'decimal_separator', '.' );
	$thousands_sep = tfre_get_option( 'thousand_separator', ',' );
	$number_floor  = number_format( $number_floor, $decimals, $decimal_sep, $thousands_sep );


	$number_decimal       = $number . '';
	$number_decimal_index = strpos( $number_decimal, $decimal_sep );

	if ( $number_decimal_index !== false ) {
		$number_decimal = substr( $number_decimal, $number_decimal_index + 1 );
		if ( $number_decimal !== '' ) {
			for ( $i = strlen( $number_decimal ) - 1; $i >= 0; $i-- ) {
				if ( $number_decimal[ $i ] !== '0' ) {
					break;
				}
			}
			$number_decimal = substr( $number_decimal, 0, $i + 1 );
		}
	} else {
		$number_decimal = '';
	}

	return $number_decimal === '' ? $number_floor : $number_floor . $decimal_sep . $number_decimal;
}

function tfre_clean_doubleval( $number ) {
	$number = preg_replace( '/&#36;/', '', $number );
	$number = preg_replace( '/[^A-Za-z0-9\-]/', '', $number );
	$number = preg_replace( '/\D/', '', $number );
	return $number;
}

function tfre_get_comment_time( $comment_id = 0 ) {
	return sprintf(
		_x( '%s ago', 'Human-readable time', 'tf-real-estate' ),
		human_time_diff(
			get_comment_date( 'U', $comment_id ),
			current_time( 'timestamp' )
		)
	);
}

function tfre_get_all_pages( $multi = false ) {
	$args  = array(
		'sort_order'   => 'asc',
		'sort_column'  => 'post_title',
		'hierarchical' => 1,
		'exclude'      => '',
		'include'      => '',
		'meta_key'     => '',
		'meta_value'   => '',
		'authors'      => '',
		'child_of'     => 0,
		'parent'       => -1,
		'offset'       => 0,
		'post_type'    => 'page',
		'post_status'  => 'publish'
	);
	$data  = array();
	$pages = get_pages( $args );
	if ( $multi ) {
		$data[] = array( 'value' => '', 'label' => '' );
	}
	foreach ( (array) $pages as $page ) {
		if ( $multi ) {
			$data[] = array( 'value' => $page->ID, 'label' => $page->post_title );
		} else {
			$data[ $page->ID ] = $page->post_title;
		}
	}
	return $data;
}

function tfre_is_agent() {
	global $current_user;
	wp_get_current_user();
	$user_id = $current_user->ID;
	// $agent_id = get_the_author_meta('author_agent_id', $user_id);
	$agent_id = get_user_meta( $user_id, 'author_agent_id', true );
	if ( ! empty( $agent_id ) && ( get_post_type( $agent_id ) == 'agent' ) && ( get_post_status( $agent_id ) == 'publish' ) ) {
		return true;
	}
	return false;
}

function tfre_required_field( $field, $option_name ) {
	$required_fields = tfre_get_option( $option_name, array() );
	if ( ( count( $required_fields ) > 0 ) && ( $required_fields[ $field ] == 1 ) ) {
		return '*';
	}
	return '';
}

function tfre_check_required_field( $field, $option_name ) {
	$required_fields = tfre_get_option( $option_name, array() );
	if ( ( count( $required_fields ) > 0 ) && ( $required_fields[ $field ] == 1 ) ) {
		return true;
	}
	return false;
}

function tfre_get_show_hide_field( $field, $option_name ) {
	$required_fields = tfre_get_option( $option_name, array() );
	if ( ( count( $required_fields ) > 0 ) && ( $required_fields[ $field ] == 1 ) ) {
		return true;
	}
	return false;
}

function tfre_allow_submit_property() {
	$allow_submit_property_from_frontend = tfre_get_option( 'allow_submit_property_from_fe', 'y' );
	$all_user_can_submit_property        = tfre_get_option( 'all_user_can_submit_property', 'y' );
	$is_agent                            = tfre_is_agent();
	$allow_submit                        = true;
	if ( $allow_submit_property_from_frontend != 'y' ) {
		$allow_submit = false;
	} else {
		if ( ! current_user_can( 'administrator' ) && ! $is_agent && $all_user_can_submit_property != 'y' ) {
			$allow_submit = false;
		}
	}
	return $allow_submit;
}

function get_capabilities() {
	$capabilities = array();

	$capability_post_types = array( 'real-estate', 'agent', 'invoice', 'user-package', 'transaction-log' );

	foreach ( $capability_post_types as $capability_post_type ) {

		$capabilities[ $capability_post_type ] = array(
			// Post type
			"create_{$capability_post_type}",
			"edit_{$capability_post_type}",
			"read_{$capability_post_type}",
			"delete_{$capability_post_type}",
			"edit_{$capability_post_type}s",
			"edit_others_{$capability_post_type}s",
			"publish_{$capability_post_type}s",
			"read_private_{$capability_post_type}s",
			"delete_{$capability_post_type}s",
			"delete_private_{$capability_post_type}s",
			"delete_published_{$capability_post_type}s",
			"delete_others_{$capability_post_type}s",
			"edit_private_{$capability_post_type}s",
			"edit_published_{$capability_post_type}s",

			// Terms
			"manage_{$capability_post_type}_terms",
			"edit_{$capability_post_type}_terms",
			"delete_{$capability_post_type}_terms",
			"assign_{$capability_post_type}_terms"
		);
	}

	return $capabilities;
}

function tfre_get_taxonomies( $category = 'category' ) {
	$category_posts_name = [];
	$category_posts      = get_terms(
		array(
			'taxonomy'   => $category,
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => false,
		)
	);
	if ( ! empty( $category_posts ) ) {
		foreach ( $category_posts as $category_post ) {
			$category_posts_name[ $category_post->slug ] = $category_post->name;
		}

	}
	return $category_posts_name;
}

function get_sources_property_gallery_images( $property_gallery_Id, $is_vertical = false, $style = '' ) {
	if ( $property_gallery_Id === '' ) {
		return;
	}
	$property_gallery_Id = json_decode( $property_gallery_Id );
	$property_gallery    = array();
	foreach ( $property_gallery_Id as $image_id ) {
		if($style = 'style3'){
			$image_src = wp_get_attachment_image_src( $image_id, 'themesflat-property-thumbnail-style3');
		}else{
			$image_src = wp_get_attachment_image_src( $image_id, ( $is_vertical ? 'themesflat-property-thumbnail-vertical'
			: 'themesflat-property-thumbnail' ) );
		}
		
		if ( is_array( $image_src ) ) {
			$property_gallery[] = $image_src[0];
		}
	}
	$property_gallery_count = count( $property_gallery );
	if ( $property_gallery_count === 0 ) {
		return;
	}
	return $property_gallery;
}

function tfre_get_number_text( $number, $many_text, $singular_text ) {
	if ( $number != 0 && $number != 1 ) {
		return $many_text;
	} else {
		return $singular_text;
	}
}

function tfre_get_year_time( $year_past ) {
	$current_time = current_time( 'Y' );
	if ( empty( $year_past ) ) {
		return '';
	}
	if ( $year_past <= $current_time ) {
		$year_built = $current_time - $year_past;
		if ( $year_built > 1 ) {
			return sprintf( __( '%s years ago', 'tf-real-estate' ), $year_built );
		} else if ( $year_built == 0 ) {
			return __( 'Built this year', 'tf-real-estate' );
		} else {
			return sprintf( __( '%s year ago', 'tf-real-estate' ), $year_built );
		}
	} else {
		$year_built = $year_past - $current_time;
		if ( $year_built > 1 ) {
			return sprintf( __( '%s years later', 'tf-real-estate' ), $year_built );
		} else {
			return sprintf( __( '%s year later', 'tf-real-estate' ), $year_built );
		}
	}
}

function tfre_image_resize_id( $images_id, $width = NULL, $height = NULL, $crop = true, $retina = false ) {
	$output    = '';
	$image_src = wp_get_attachment_image_src( $images_id, 'full' );
	if ( is_array( $image_src ) ) {
		$resize = tfre_image_resize_url( $image_src[0], $width, $height, $crop, $retina );

		if ( $resize != null && is_array( $resize ) ) {
			$output = $resize['url'];
		}
	}
	return $output;
}

function tfre_image_resize_url( $url, $width = NULL, $height = NULL, $crop = true, $retina = false ) {

	global $wpdb;

	if ( empty( $url ) )
		return new WP_Error( 'no_image_url', esc_html__( 'No image URL has been entered.', 'tf-real-estate' ), $url );

	if ( class_exists( 'Jetpack' ) && method_exists( 'Jetpack', 'get_active_modules' ) && in_array( 'photon', Jetpack::get_active_modules() ) ) {
		$args_crop = array(
			'resize' => $width . ',' . $height,
			'crop'   => '0,0,' . $width . 'px,' . $height . 'px'
		);
		$url       = jetpack_photon_url( $url, $args_crop );
	}

	// Get default size from database
	$width  = ( $width ) ? $width : get_option( 'thumbnail_width' );
	$height = ( $height ) ? $height : get_option( 'thumbnail_height' );

	// Allow for different retina sizes
	$retina = $retina ? ( $retina === true ? 2 : $retina ) : 1;

	// Get the image file path
	$file_path        = parse_url( $url );
	$file_path        = sanitize_text_field( $_SERVER['DOCUMENT_ROOT'] ) . $file_path['path'];
	$wp_upload_folder = wp_upload_dir();
	$wp_upload_folder = $wp_upload_folder['basedir'];
	$file_path        = explode( '/uploads/', $file_path );
	if ( is_array( $file_path ) ) {
		if ( count( $file_path ) > 1 ) {
			$file_path = $wp_upload_folder . '/' . $file_path[1];
		} elseif ( count( $file_path ) > 0 ) {
			$file_path = $wp_upload_folder . '/' . $file_path[0];
		} else {
			$file_path = '';
		}
	}

	// Check for Multisite
	if ( is_multisite() ) {
		global $blog_id;
		$blog_details = get_blog_details( $blog_id );
		$file_path    = str_replace( $blog_details->path . 'files/', '/wp-content/blogs.dir/' . $blog_id . '/files/', $file_path );
	}

	// Destination width and height variables
	$dest_width  = $width * $retina;
	$dest_height = $height * $retina;

	// File name suffix (appended to original file name)
	$suffix = "{$dest_width}x{$dest_height}";

	// Some additional info about the image
	$info = pathinfo( $file_path );
	$dir  = $info['dirname'];
	$ext  = $info['extension'];
	$name = wp_basename( $file_path, ".$ext" );

	if ( 'bmp' == $ext ) {
		return new WP_Error( 'bmp_mime_type', esc_html__( 'Image is BMP. Please use either JPG or PNG.', 'tf-real-estate' ), $url );
	}

	// Suffix applied to filename
	$suffix = "{$dest_width}x{$dest_height}";

	$file_name = "{$name}-{$suffix}.{$ext}";
	$file_name = sanitize_file_name( $file_name );

	// Get the destination file name
	$dest_file_name = "{$dir}/{$file_name}";

	if ( ! file_exists( $dest_file_name ) ) {
		$query          = $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE guid='%s'", $url );
		$get_attachment = $wpdb->get_results( $query );

		if ( ! $get_attachment )
			return array( 'url' => $url, 'width' => $width, 'height' => $height );

		// Load Wordpress Image Editor
		$editor = wp_get_image_editor( $file_path );
		if ( is_wp_error( $editor ) )
			return array( 'url' => $url, 'width' => $width, 'height' => $height );

		// Get the original image size
		$size        = $editor->get_size();
		$orig_width  = $size['width'];
		$orig_height = $size['height'];

		$src_x = $src_y = 0;
		$src_w = $orig_width;
		$src_h = $orig_height;

		if ( $crop ) {

			$cmp_x = $orig_width / $dest_width;
			$cmp_y = $orig_height / $dest_height;

			// Calculate x or y coordinate, and width or height of source
			if ( $cmp_x > $cmp_y ) {
				$src_w = round( $orig_width / $cmp_x * $cmp_y );
				$src_x = round( ( $orig_width - ( $orig_width / $cmp_x * $cmp_y ) ) / 2 );
			} else if ( $cmp_y > $cmp_x ) {
				$src_h = round( $orig_height / $cmp_y * $cmp_x );
				$src_y = round( ( $orig_height - ( $orig_height / $cmp_y * $cmp_x ) ) / 2 );
			}

		}

		// Time to crop the image!
		$editor->crop( $src_x, $src_y, $src_w, $src_h, $dest_width, $dest_height );

		// Now let's save the image
		$saved = $editor->save( $dest_file_name );

		if ( is_a( $saved, 'WP_Error' ) ) {
			$image_array = array(
				'url'    => str_replace( wp_basename( $url ), wp_basename( $dest_file_name ), $url ),
				'width'  => $dest_width,
				'height' => $dest_height,
				'type'   => $ext
			);
		} else {
			$resized_url    = str_replace( wp_basename( $url ), wp_basename( $saved['path'] ), $url );
			$resized_width  = $saved['width'];
			$resized_height = $saved['height'];
			$resized_type   = $saved['mime-type'];

			$metadata = wp_get_attachment_metadata( $get_attachment[0]->ID );
			if ( isset( $metadata['image_meta'] ) ) {
				$metadata['image_meta']['resized_images'][] = $resized_width . 'x' . $resized_height;
				wp_update_attachment_metadata( $get_attachment[0]->ID, $metadata );
			}

			// Create the image array
			$image_array = array(
				'url'    => $resized_url,
				'width'  => $resized_width,
				'height' => $resized_height,
				'type'   => $resized_type
			);
		}

	} else {
		$image_array = array(
			'url'    => str_replace( wp_basename( $url ), wp_basename( $dest_file_name ), $url ),
			'width'  => $dest_width,
			'height' => $dest_height,
			'type'   => $ext
		);
	}

	// Return image array
	return $image_array;

}

function tfre_get_countries_name( $country ) {
	$result         = '';
	$countries_list = tfre_list_countries();
	if ( ! empty( $country ) && ! empty( $countries_list ) ) {
		foreach ( $countries_list as $key => $value ) {
			if ( $key === $country ) {
				$result = $value;
				break;
			}
		}
		return $result;
	} else {
		return $countries_list;
	}
}

function template_loader( $template ) {
	$find = array();
	$file = '';

	if ( is_single() && ( get_post_type() == 'real-estate' || get_post_type() == 'agent' ) ) {

		if ( get_post_type() == 'real-estate' ) {
			$file = 'single-property.php';
		}
		if ( get_post_type() == 'agent' ) {
			$file = 'single-agent.php';
		}
		if ( $file ) {
			$default_path = TF_PLUGIN_PATH . '/public/templates/';
			$template     = locate_template( $file, false );
			if ( ! $template ) {
				$template = $default_path . $file;
			}
			if ( ! file_exists( $template ) ) {
				return;
			}
			return $template;
		}
	} elseif ( is_agent_taxonomy() ) {
		$term = get_queried_object();
		if ( is_tax( 'agencies' ) ) {
			$file = 'taxonomy-' . $term->taxonomy . '.php';

			if ( $file ) {
				$default_path = TF_PLUGIN_PATH . '/public/templates/';
				$template     = locate_template( $file, false );
				if ( ! $template ) {
					$template = $default_path . $file;
				}
				if ( ! file_exists( $template ) ) {
					return;
				}
				return $template;
			}
		} else {
			return $template;
		}

	} else {
		return $template;
	}
}

//add_filter('template_include','template_loader');

function render_search_fields_widget_elementor( $search_fields_type, $settings, $no_class = false ) {
	$search_fields = $settings[ $search_fields_type ];
	$attrs         = array(
		'layout'                   => "tab",
		'column'                   => 3,
		'color_scheme'             => "color-dark",
		'status_enable'            => tfre_get_show_hide_field( 'property-status', 'advanced_search_fields' ),
		'type_enable'              => tfre_get_show_hide_field( 'property-type', 'advanced_search_fields' ),
		'keyword_enable'           => tfre_get_show_hide_field( 'keyword', 'advanced_search_fields' ),
		'title_enable'             => tfre_get_show_hide_field( 'property-title', 'advanced_search_fields' ),
		'label_enable'             => tfre_get_show_hide_field( 'property-label', 'advanced_search_fields' ),
		'address_enable'           => tfre_get_show_hide_field( 'property-address', 'advanced_search_fields' ),
		'country_enable'           => tfre_get_show_hide_field( 'property-country', 'advanced_search_fields' ),
		'state_enable'             => tfre_get_show_hide_field( 'province-state', 'advanced_search_fields' ),
		'neighborhood_enable'      => tfre_get_show_hide_field( 'property-neighborhood', 'advanced_search_fields' ),
		'rooms_enable'             => tfre_get_show_hide_field( 'property-rooms', 'advanced_search_fields' ),
		'bedrooms_enable'          => tfre_get_show_hide_field( 'property-bedrooms', 'advanced_search_fields' ),
		'bathrooms_enable'         => tfre_get_show_hide_field( 'property-bathrooms', 'advanced_search_fields' ),
		'price_enable'             => tfre_get_show_hide_field( 'property-price', 'advanced_search_fields' ),
		'price_is_slider'          => ( tfre_get_option( 'price_search_field_type', '' ) == 'slider' ),
		'size_enable'              => tfre_get_show_hide_field( 'property-size', 'advanced_search_fields' ),
		'size_is_slider'           => ( tfre_get_option( 'size_search_field_type', '' ) == 'slider' ),
		'land_size_enable'         => tfre_get_show_hide_field( 'property-land-size', 'advanced_search_fields' ),
		'land_size_is_slider'      => ( tfre_get_option( 'land_size_search_field_type', '' ) == 'slider' ),
		'garage_enable'            => tfre_get_show_hide_field( 'property-garage', 'advanced_search_fields' ),
		'garage_size_enable'       => tfre_get_show_hide_field( 'property-garage-size', 'advanced_search_fields' ),
		'garage_size_is_slider'    => ( tfre_get_option( 'garage_size_search_field_type', '' ) == 'slider' ),
		'property_identity_enable' => 'true',
		'features_enable'          => tfre_get_show_hide_field( 'property-feature', 'advanced_search_fields' ),
	);

	$address_enable = $keyword_enable = $title_enable = $type_enable = $status_enable = $rooms_enable = $bedrooms_enable = $bathrooms_enable = $price_enable = $price_is_slider = $size_enable = $size_is_slider = $land_size_enable = $land_size_is_slider = $country_enable = $state_enable = $neighborhood_enable = $label_enable = $garage_enable = $garage_size_enable = $garage_size_is_slider = $features_enable = '';

	extract(
		shortcode_atts(
			array(
				'layout'                   => 'tab',
				'column'                   => '3',
				'color_scheme'             => 'color-light',
				'status_enable'            => 'true',
				'type_enable'              => 'true',
				'keyword_enable'           => 'true',
				'title_enable'             => 'true',
				'address_enable'           => 'true',
				'country_enable'           => '',
				'state_enable'             => '',
				'neighborhood_enable'      => '',
				'rooms_enable'             => '',
				'bedrooms_enable'          => '',
				'bathrooms_enable'         => '',
				'price_enable'             => 'true',
				'price_is_slider'          => '',
				'size_enable'              => '',
				'size_is_slider'           => '',
				'land_size_enable'         => '',
				'land_size_is_slider'      => '',
				'label_enable'             => '',
				'garage_enable'            => '',
				'garage_size_enable'       => '',
				'garage_size_is_slider'    => '',
				'property_identity_enable' => '',
				'features_enable'          => '',
			),
			$attrs
		)
	);
	$status_default         = '';
	$value_status           = isset( $_GET['status'] ) ? ( wp_unslash( $_GET['status'] ) ) : $status_default;
	$value_keyword          = isset( $_GET['keyword'] ) ? ( wp_unslash( $_GET['keyword'] ) ) : '';
	$value_title            = isset( $_GET['title'] ) ? ( wp_unslash( $_GET['title'] ) ) : '';
	$value_address          = isset( $_GET['address'] ) ? ( wp_unslash( $_GET['address'] ) ) : '';
	$value_type             = isset( $_GET['type'] ) ? ( wp_unslash( $_GET['type'] ) ) : '';
	$value_bathrooms        = isset( $_GET['bathrooms'] ) ? ( wp_unslash( $_GET['bathrooms'] ) ) : '';
	$value_rooms            = isset( $_GET['rooms'] ) ? ( wp_unslash( $_GET['rooms'] ) ) : '';
	$value_bedrooms         = isset( $_GET['bedrooms'] ) ? ( wp_unslash( $_GET['bedrooms'] ) ) : '';
	$value_min_price        = isset( $_GET['min-price'] ) ? ( wp_unslash( $_GET['min-price'] ) ) : '';
	$value_max_price        = isset( $_GET['max-price'] ) ? ( wp_unslash( $_GET['max-price'] ) ) : '';
	$value_min_size         = isset( $_GET['min-size'] ) ? ( wp_unslash( $_GET['min-size'] ) ) : '';
	$value_max_size         = isset( $_GET['max-size'] ) ? ( wp_unslash( $_GET['max-size'] ) ) : '';
	$value_min_land_size    = isset( $_GET['min-land-size'] ) ? ( wp_unslash( $_GET['min-land-size'] ) ) : '';
	$value_max_land_size    = isset( $_GET['max-land-size'] ) ? ( wp_unslash( $_GET['max-land-size'] ) ) : '';
	$value_state            = isset( $_GET['state'] ) ? ( wp_unslash( $_GET['state'] ) ) : '';
	$value_country          = isset( $_GET['country'] ) ? ( wp_unslash( $_GET['country'] ) ) : '';
	$value_neighborhood     = isset( $_GET['neighborhood'] ) ? ( wp_unslash( $_GET['neighborhood'] ) ) : '';
	$value_label            = isset( $_GET['label'] ) ? ( wp_unslash( $_GET['label'] ) ) : '';
	$value_garage           = isset( $_GET['garage'] ) ? ( wp_unslash( $_GET['garage'] ) ) : '';
	$value_min_garage_size  = isset( $_GET['min-garage-size'] ) ? ( wp_unslash( $_GET['min-garage-size'] ) ) : '';
	$value_max_garage_size  = isset( $_GET['max-garage-size'] ) ? ( wp_unslash( $_GET['max-garage-size'] ) ) : '';
	$enable_search_features = isset( $_GET['enable-search-features'] ) ? ( wp_unslash( $_GET['enable-search-features'] ) ) : ( tfre_get_option( 'toggle_property_features', 'n' ) == 'y' ? '0' : '1' );
	$value_features         = isset( $_GET['features'] ) ? ( wp_unslash( $_GET['features'] ) ) : '';

	if ( ! empty( $value_features ) ) {
		$value_features = explode( ',', $value_features );
	}
	$css_class_field      = $no_class ? '' : 'col-xl-3 col-md-6 col-xs-12';
	$css_class_half_field = $no_class ? '' : 'col-xl-3 col-md-6 col-xs-12';
	if ( $search_fields ) :
		foreach ( $search_fields as $field => $value ) {
			switch ( $value ) {
				case 'property-status':
					if ( $status_enable == 'true' && $layout != 'tab' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_status'    => $value_status
							)
						);
					}
					break;
				case 'property-type':
					if ( $type_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_type'      => $value_type
							)
						);
					}
					break;
				case 'keyword':
					if ( $keyword_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_keyword'   => $value_keyword
							)
						);
					}
					break;
				case 'property-title':
					if ( $title_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_title'     => $value_title
							)
						);
					}
					break;
				case 'property-address':
					if ( $address_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_address'   => $value_address
							)
						);
					}
					break;
				case 'property-country':
					if ( $country_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_country'   => $value_country
							)
						);
					}
					break;
				case 'province-state':
					if ( $state_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_state'     => $value_state
							)
						);
					}
					break;
				case 'property-neighborhood':
					if ( $neighborhood_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field'    => $css_class_field,
								'value_neighborhood' => $value_neighborhood
							)
						);
					}
					break;
				case 'property-rooms':
					if ( $rooms_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_rooms'     => $value_rooms
							)
						);
					}
					break;
				case 'property-bathrooms':
					if ( $bathrooms_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_bathrooms' => $value_bathrooms
							)
						);
					}
					break;
				case 'property-bedrooms':
					if ( $bedrooms_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_bedrooms'  => $value_bedrooms
							)
						);
					}
					break;
				case 'property-price':
					if ( $price_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field'      => $css_class_field,
								'css_class_half_field' => $css_class_half_field,
								'value_min_price'      => $value_min_price,
								'value_max_price'      => $value_max_price,
								'value_status'         => $value_status,
								'price_is_slider'      => $price_is_slider
							)
						);
					}
					break;
				case 'property-size':
					if ( $size_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field'      => $css_class_field,
								'css_class_half_field' => $css_class_half_field,
								'value_min_size'       => $value_min_size,
								'value_max_size'       => $value_max_size,
								'size_is_slider'       => $size_is_slider
							)
						);
					}
					break;
				case 'property-land-size':
					if ( $land_size_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field'      => $css_class_field,
								'css_class_half_field' => $css_class_half_field,
								'value_min_land_size'  => $value_min_land_size,
								'value_max_land_size'  => $value_max_land_size,
								'land_size_is_slider'  => $land_size_is_slider
							)
						);
					}
					break;
				case 'property-label':
					if ( $label_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_label'     => $value_label
							)
						);
					}
					break;
				case 'property-garage':
					if ( $garage_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_garage'    => $value_garage
							)
						);
					}
					break;
				case 'property-garage-size':
					if ( $garage_size_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field'       => $css_class_field,
								'css_class_half_field'  => $css_class_half_field,
								'value_min_garage_size' => $value_min_garage_size,
								'value_max_garage_size' => $value_max_garage_size,
								'garage_size_is_slider' => $garage_size_is_slider
							)
						);
					}
					break;
				case 'property-feature':
					if ( $features_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $value . '.php',
							array(
								'css_class_field'                 => $css_class_field,
								'enable_search_features'          => $enable_search_features,
								'enable_toggle_property_features' => tfre_get_option( 'toggle_property_features', 'n' ),
								'value_features'                  => $value_features,
								'enable_label' => false
							)
						);
					}
					break;
				default:
					break;
			}
		}
	endif;
}

function render_search_fields( $search_fields, $no_class = false, $class = '' ) {
	$attrs = array(
		'layout'                   => "tab",
		'column'                   => 3,
		'color_scheme'             => "color-dark",
		'status_enable'            => tfre_get_show_hide_field( 'property-status', 'advanced_search_fields' ),
		'type_enable'              => tfre_get_show_hide_field( 'property-type', 'advanced_search_fields' ),
		'keyword_enable'           => tfre_get_show_hide_field( 'keyword', 'advanced_search_fields' ),
		'title_enable'             => tfre_get_show_hide_field( 'property-title', 'advanced_search_fields' ),
		'label_enable'             => tfre_get_show_hide_field( 'property-label', 'advanced_search_fields' ),
		'address_enable'           => tfre_get_show_hide_field( 'property-address', 'advanced_search_fields' ),
		'country_enable'           => tfre_get_show_hide_field( 'property-country', 'advanced_search_fields' ),
		'state_enable'             => tfre_get_show_hide_field( 'province-state', 'advanced_search_fields' ),
		'neighborhood_enable'      => tfre_get_show_hide_field( 'property-neighborhood', 'advanced_search_fields' ),
		'rooms_enable'             => tfre_get_show_hide_field( 'property-rooms', 'advanced_search_fields' ),
		'bedrooms_enable'          => tfre_get_show_hide_field( 'property-bedrooms', 'advanced_search_fields' ),
		'bathrooms_enable'         => tfre_get_show_hide_field( 'property-bathrooms', 'advanced_search_fields' ),
		'price_enable'             => tfre_get_show_hide_field( 'property-price', 'advanced_search_fields' ),
		'price_is_slider'          => ( tfre_get_option( 'price_search_field_type', '' ) == 'slider' ),
		'size_enable'              => tfre_get_show_hide_field( 'property-size', 'advanced_search_fields' ),
		'size_is_slider'           => ( tfre_get_option( 'size_search_field_type', '' ) == 'slider' ),
		'land_size_enable'         => tfre_get_show_hide_field( 'property-land-size', 'advanced_search_fields' ),
		'land_size_is_slider'      => ( tfre_get_option( 'land_size_search_field_type', '' ) == 'slider' ),
		'garage_enable'            => tfre_get_show_hide_field( 'property-garage', 'advanced_search_fields' ),
		'garage_size_enable'       => tfre_get_show_hide_field( 'property-garage-size', 'advanced_search_fields' ),
		'garage_size_is_slider'    => ( tfre_get_option( 'garage_size_search_field_type', '' ) == 'slider' ),
		'property_identity_enable' => 'true',
		'features_enable'          => tfre_get_show_hide_field( 'property-feature', 'advanced_search_fields' ),
	);

	$address_enable = $keyword_enable = $title_enable = $type_enable = $status_enable = $rooms_enable = $bedrooms_enable = $bathrooms_enable = $price_enable = $price_is_slider = $size_enable = $size_is_slider = $land_size_enable = $land_size_is_slider = $country_enable = $state_enable = $neighborhood_enable = $label_enable = $garage_enable = $garage_size_enable = $garage_size_is_slider = $features_enable = '';

	extract(
		shortcode_atts(
			array(
				'layout'                   => 'tab',
				'column'                   => '3',
				'color_scheme'             => 'color-light',
				'status_enable'            => 'true',
				'type_enable'              => 'true',
				'keyword_enable'           => 'true',
				'title_enable'             => 'true',
				'address_enable'           => 'true',
				'country_enable'           => '',
				'state_enable'             => '',
				'neighborhood_enable'      => '',
				'rooms_enable'             => '',
				'bedrooms_enable'          => '',
				'bathrooms_enable'         => '',
				'price_enable'             => 'true',
				'price_is_slider'          => '',
				'size_enable'              => '',
				'size_is_slider'           => '',
				'land_size_enable'         => '',
				'land_size_is_slider'      => '',
				'label_enable'             => '',
				'garage_enable'            => '',
				'garage_size_enable'       => '',
				'garage_size_is_slider'    => '',
				'property_identity_enable' => '',
				'features_enable'          => '',
			),
			$attrs
		)
	);
	$status_default         = '';
	$value_status           = isset( $_GET['status'] ) ? ( wp_unslash( $_GET['status'] ) ) : $status_default;
	$value_keyword          = isset( $_GET['keyword'] ) ? ( wp_unslash( $_GET['keyword'] ) ) : '';
	$value_title            = isset( $_GET['title'] ) ? ( wp_unslash( $_GET['title'] ) ) : '';
	$value_address          = isset( $_GET['address'] ) ? ( wp_unslash( $_GET['address'] ) ) : '';
	$value_type             = isset( $_GET['type'] ) ? ( wp_unslash( $_GET['type'] ) ) : '';
	$value_bathrooms        = isset( $_GET['bathrooms'] ) ? ( wp_unslash( $_GET['bathrooms'] ) ) : '';
	$value_rooms            = isset( $_GET['rooms'] ) ? ( wp_unslash( $_GET['rooms'] ) ) : '';
	$value_bedrooms         = isset( $_GET['bedrooms'] ) ? ( wp_unslash( $_GET['bedrooms'] ) ) : '';
	$value_min_price        = isset( $_GET['min-price'] ) ? ( wp_unslash( $_GET['min-price'] ) ) : '';
	$value_max_price        = isset( $_GET['max-price'] ) ? ( wp_unslash( $_GET['max-price'] ) ) : '';
	$value_min_size         = isset( $_GET['min-size'] ) ? ( wp_unslash( $_GET['min-size'] ) ) : '';
	$value_max_size         = isset( $_GET['max-size'] ) ? ( wp_unslash( $_GET['max-size'] ) ) : '';
	$value_min_land_size    = isset( $_GET['min-land-size'] ) ? ( wp_unslash( $_GET['min-land-size'] ) ) : '';
	$value_max_land_size    = isset( $_GET['max-land-size'] ) ? ( wp_unslash( $_GET['max-land-size'] ) ) : '';
	$value_state            = isset( $_GET['state'] ) ? ( wp_unslash( $_GET['state'] ) ) : '';
	$value_country          = isset( $_GET['country'] ) ? ( wp_unslash( $_GET['country'] ) ) : '';
	$value_neighborhood     = isset( $_GET['neighborhood'] ) ? ( wp_unslash( $_GET['neighborhood'] ) ) : '';
	$value_label            = isset( $_GET['label'] ) ? ( wp_unslash( $_GET['label'] ) ) : '';
	$value_garage           = isset( $_GET['garage'] ) ? ( wp_unslash( $_GET['garage'] ) ) : '';
	$value_min_garage_size  = isset( $_GET['min-garage-size'] ) ? ( wp_unslash( $_GET['min-garage-size'] ) ) : '';
	$value_max_garage_size  = isset( $_GET['max-garage-size'] ) ? ( wp_unslash( $_GET['max-garage-size'] ) ) : '';
	$enable_search_features = isset( $_GET['enable-search-features'] ) ? ( wp_unslash( $_GET['enable-search-features'] ) ) : ( tfre_get_option( 'toggle_property_features', 'n' ) == 'y' ? '0' : '1' );
	$value_features         = isset( $_GET['features'] ) ? ( wp_unslash( $_GET['features'] ) ) : '';

	if ( ! empty( $value_features ) ) {
		$value_features = explode( ',', $value_features );
	}
	$css_class_field      = $no_class ? '' : ( empty( $class ) ? 'col-xl-2 col-md-3 col-xs-12' : $class );
	$css_class_half_field = $no_class ? '' : ( empty( $class ) ? 'col-xl-2 col-md-3 col-xs-12' : $class );
	if ( is_array( $search_fields ) ) :
		foreach ( $search_fields as $field => $value ) {
			switch ( $field ) {
				case 'property-status':
					if ( $status_enable == 'true' && $layout != 'tab' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_status'    => $value_status
							)
						);
					}
					break;
				case 'property-type':
					if ( $type_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_type'      => $value_type
							)
						);
					}
					break;
				case 'keyword':
					if ( $keyword_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_keyword'   => $value_keyword
							)
						);
					}
					break;
				case 'property-title':
					if ( $title_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_title'     => $value_title
							)
						);
					}
					break;
				case 'property-address':
					if ( $address_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_address'   => $value_address
							)
						);
					}
					break;
				case 'property-country':
					if ( $country_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_country'   => $value_country
							)
						);
					}
					break;
				case 'province-state':
					if ( $state_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_state'     => $value_state
							)
						);
					}
					break;
				case 'property-neighborhood':
					if ( $neighborhood_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field'    => $css_class_field,
								'value_neighborhood' => $value_neighborhood
							)
						);
					}
					break;
				case 'property-rooms':
					if ( $rooms_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_rooms'     => $value_rooms
							)
						);
					}
					break;
				case 'property-bathrooms':
					if ( $bathrooms_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_bathrooms' => $value_bathrooms
							)
						);
					}
					break;
				case 'property-bedrooms':
					if ( $bedrooms_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_bedrooms'  => $value_bedrooms
							)
						);
					}
					break;
				case 'property-price':
					if ( $price_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field'      => $css_class_field,
								'css_class_half_field' => $css_class_half_field,
								'value_min_price'      => $value_min_price,
								'value_max_price'      => $value_max_price,
								'value_status'         => $value_status,
								'price_is_slider'      => $price_is_slider
							)
						);
					}
					break;
				case 'property-size':
					if ( $size_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field'      => $css_class_field,
								'css_class_half_field' => $css_class_half_field,
								'value_min_size'       => $value_min_size,
								'value_max_size'       => $value_max_size,
								'size_is_slider'       => $size_is_slider
							)
						);
					}
					break;
				case 'property-land-size':
					if ( $land_size_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field'      => $css_class_field,
								'css_class_half_field' => $css_class_half_field,
								'value_min_land_size'  => $value_min_land_size,
								'value_max_land_size'  => $value_max_land_size,
								'land_size_is_slider'  => $land_size_is_slider
							)
						);
					}
					break;
				case 'property-label':
					if ( $label_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_label'     => $value_label
							)
						);
					}
					break;
				case 'property-garage':
					if ( $garage_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field' => $css_class_field,
								'value_garage'    => $value_garage
							)
						);
					}
					break;
				case 'property-garage-size':
					if ( $garage_size_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field'       => $css_class_field,
								'css_class_half_field'  => $css_class_half_field,
								'value_min_garage_size' => $value_min_garage_size,
								'value_max_garage_size' => $value_max_garage_size,
								'garage_size_is_slider' => $garage_size_is_slider
							)
						);
					}
					break;
				case 'property-feature':
					if ( $features_enable == 'true' ) {
						tfre_get_template_with_arguments(
							'advanced-search/advanced-search-fields/' . $field . '.php',
							array(
								'css_class_field'                 => $css_class_field,
								'enable_search_features'          => $enable_search_features,
								'enable_toggle_property_features' => tfre_get_option( 'toggle_property_features', 'n' ),
								'value_features'                  => $value_features,
								'enable_label' => false
							)
						);
					}
					break;
				default:
					break;
			}
		}
	endif;
}
function is_agent_taxonomy() {
	return is_tax( get_object_taxonomies( 'agent' ) );
}

function tfre_get_total_properties_by_user( $agent_user_id ) {
	$args       = array(
		'post_type'   => 'real-estate',
		'post_status' => 'publish',
		'meta_query'  => array(
			array(
				'key'     => 'property_agent_info',
				'value'   => $agent_user_id,
				'compare' => 'IN',
			),
		),
	);
	$properties = new WP_Query( $args );
	return $properties->found_posts;
}

function tfre_get_link_order( $order ) {
	$link_order = add_query_arg( array( 'orderBy' => $order ) );
	return $link_order;
}

function tfre_get_user_comments( $uid ) {
	global $wpdb;
	$sql = "SELECT COUNT(*) as total
            FROM {$wpdb->comments} as c  
            JOIN {$wpdb->posts} as p ON p.ID = c.comment_post_ID 
            JOIN {$wpdb->commentmeta} AS meta on meta.comment_id = c.comment_ID
            WHERE c.comment_approved = '1' 
            AND p.post_status ='publish'   
            AND p.post_type ='real-estate'           
            AND c.user_id = %d
            AND meta.meta_key = %s
            ORDER BY c.comment_date DESC";

	$comments = $wpdb->get_var( $wpdb->prepare( $sql, $uid, 'property_rating' ) );

	return $comments;
}

function tfre_get_menu_user_login() {
	global $current_user;
	wp_get_current_user();
	$user_id                    = $current_user->ID;
	$menus                      = array();
	$class_property             = new Property_Public();
	$total_properties           = $class_property->tfre_get_total_my_properties( array( 'any', 'hidden', 'sold', 'expired' ) );
	$class_invoice              = new Invoice_Public();
	$total_invoices             = $class_invoice->tfre_get_total_my_invoice();
	$total_favorites            = $class_property->tfre_get_total_my_favorites();
	$class_save_advanced_search = new Save_Advanced_Search();
	$total_save_advanced_search = $class_save_advanced_search->tfre_get_total_my_save_advanced_search();
	$total_reviews              = $user_id ? tfre_get_user_comments( $user_id ) : '';
	$allow_submit               = tfre_allow_submit_property();
	$permalink                  = get_permalink();

	if ( tfre_get_permalink( 'dashboard_page' ) ) {
		$menus[] = array(
			'priority' => 10,
			'label'    => esc_html__( 'Dashboards', 'tf-real-estate' ),
			'url'      => tfre_get_permalink( 'dashboard_page' ),
			'icon'     => '<i class="fas fa-tachometer-alt"></i>',
			'total'    => false,
		);
	}

	if ( tfre_get_permalink( 'my_properties_page' ) ) {
		$menus[] = array(
			'priority' => 20,
			'label'    => esc_html__( 'My Properties', 'tf-real-estate' ),
			'url'      => tfre_get_permalink( 'my_properties_page' ),
			'icon'     => '<i class="fas fa-list-alt"></i>',
			'total'    => $total_properties,
		);
	}

	if ( tfre_get_option( 'enable_package') == 'y' ) {
		if ( tfre_get_permalink( 'my_invoices_page' ) ) {
			$menus[] = array(
				'priority' => 30,
				'label'    => esc_html__( 'My Invoices', 'tf-real-estate' ),
				'url'      => tfre_get_permalink( 'my_invoices_page' ),
				'icon'     => '<i class="fas fa-file-invoice"></i>',
				'total'    => $total_invoices,
			);
		}
	}

	if ( tfre_get_option( 'enable_package') == 'y' ) {
		if ( tfre_get_permalink( 'my_package_page' ) ) {
			$menus[] = array(
				'priority' => 40,
				'label'    => esc_html__( 'My Package', 'tf-real-estate' ),
				'url'      => tfre_get_permalink( 'my_package_page' ),
				'icon'     => '<i class="fas fa-box"></i>',
				'total'    => false
			);
		}
	}

	$enable_favorite = tfre_get_option( 'enable_favorite', 'y' );
	if ( $enable_favorite == 'y' && tfre_get_permalink( 'my_favorites_page' ) ) {
		$menus[] = array(
			'priority' => 50,
			'label'    => esc_html__( 'My Favorites', 'tf-real-estate' ),
			'url'      => tfre_get_permalink( 'my_favorites_page' ),
			'icon'     => '<i class="fas fa-heart"></i>',
			'total'    => $total_favorites,
		);
	}

	$enable_save_search = tfre_get_option( 'enable_save_search', 'y' );
	if ( $enable_save_search == 'y' && tfre_get_permalink( 'my_saved_advanced_searches_page' ) ) {
		$menus[] = array(
			'priority' => 60,
			'label'    => esc_html__( 'My Saved Searches', 'tf-real-estate' ),
			'url'      => tfre_get_permalink( 'my_saved_advanced_searches_page' ),
			'icon'     => '<i class="fas fa-search"></i>',
			'total'    => $total_save_advanced_search,
		);
	}

	if ( tfre_get_permalink( 'my_reviews_page' ) ) {
		$menus[] = array(
			'priority' => 70,
			'label'    => esc_html__( 'Reviews', 'tf-real-estate' ),
			'url'      => tfre_get_permalink( 'my_reviews_page' ),
			'icon'     => '<i class="fas fa-comment-dots"></i>',
			'total'    => $total_reviews,
		);
	}

	if ( tfre_get_permalink( 'my_profile_page' ) ) {
		$menus[] = array(
			'priority' => 80,
			'label'    => esc_html__( 'My Profile', 'tf-real-estate' ),
			'url'      => tfre_get_permalink( 'my_profile_page' ),
			'icon'     => '<i class="fas fa-user"></i>',
			'total'    => false,
		);
	}

	if ( $allow_submit && tfre_get_permalink( 'add_property_page' ) ) {
		$menus[] = array(
			'priority' => 90,
			'label'    => esc_html__( 'Add Property', 'tf-real-estate' ),
			'url'      => tfre_get_permalink( 'add_property_page' ),
			'icon'     => '<i class="fas fa-plus-square"></i>',
			'total'    => false,
		);
	}

	$menus[] = array(
		'priority' => 100,
		'label'    => esc_html__( 'Logout', 'tf-real-estate' ),
		'url'      => wp_logout_url( $permalink ),
		'icon'     => '<i class="fas fa-sign-out-alt"></i>',
		'total'    => false,
	);

	return $menus;
}

function tfre_get_additional_fields() {
	$additional_fields  = tfre_get_option( 'additional_fields' );
	$configs            = array();
	$first_option_value = '';
	if ( $additional_fields && is_array( $additional_fields ) ) {
		foreach ( $additional_fields as $key => $field ) {
			switch ( $key ) {
				case 'additional_field_label':
					for ( $i = 0; $i <= count( $field ) - 1; $i++ ) {
						$configs[ $additional_fields['additional_field_name'][ $i ] ]['title']   = $field[ $i ];
						$configs[ $additional_fields['additional_field_name'][ $i ] ]['section'] = 'additional-custom-fields';
					}
					break;
				case 'additional_field_type':
					for ( $i = 0; $i <= count( $field ) - 1; $i++ ) {
						$configs[ $additional_fields['additional_field_name'][ $i ] ]['type'] = $field[ $i ];
					}
					break;
				case 'additional_field_option_value':
					for ( $i = 0; $i <= count( $field ) - 1; $i++ ) {
						$choices = array();
						if ( in_array( $additional_fields['additional_field_type'][ $i ], array( 'radio', 'checkbox' ) ) ) {
							foreach ( $field[ $i ] as $key => $value ) {
								$choices[ preg_replace( "/[-]+/i", "-", str_replace( " ", "-", $value ) ) ] = array(
									'label' => esc_html__( $value ),
								);
							}
							$configs[ $additional_fields['additional_field_name'][ $i ] ]['choices'] = $choices;
							$first_option_value                                                      = preg_replace( "/[-]+/i", "-", str_replace( " ", "-", $field[ $i ][0] ) );
							$configs[ $additional_fields['additional_field_name'][ $i ] ]['default'] = $first_option_value;
						} else if ( $additional_fields['additional_field_type'][ $i ] == 'select' ) {
							foreach ( $field[ $i ] as $key => $value ) {
								$choices[ preg_replace( "/[-]+/i", "-", str_replace( " ", "-", $value ) ) ] = esc_html__( $value );
							}
							$configs[ $additional_fields['additional_field_name'][ $i ] ]['choices'] = $choices;
						}
					}
					break;
				default:
					# code...
					break;
			}
		}
	}
	return $configs;
}

function tfre_save_image_from_url( $image_url ) {
	include_once( ABSPATH . 'wp-admin/includes/image.php' );
	$image_type = end( explode( '/', getimagesize( $image_url )['mime'] ) );
	$uniq_name  = date( 'dmY' ) . '' . (int) microtime( true );
	$filename   = $uniq_name . '.' . $image_type;

	$upload_dir  = wp_upload_dir();
	$upload_file = $upload_dir['path'] . '/' . $filename;
	$contents    = file_get_contents( $image_url );
	$save_file   = fopen( $upload_file, 'w' );
	fwrite( $save_file, $contents );
	fclose( $save_file );

	$wp_filetype = wp_check_filetype( basename( $filename ), null );
	$attachment  = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title'     => $filename,
		'post_content'   => '',
		'post_status'    => 'inherit'
	);

	$attach_id      = wp_insert_attachment( $attachment, $upload_file );
	$image_new      = get_post( $attach_id );
	$full_size_path = get_attached_file( $image_new->ID );
	$attach_data    = wp_generate_attachment_metadata( $attach_id, $full_size_path );
	wp_update_attachment_metadata( $attach_id, $attach_data );

	return $attach_id;
}

function tfre_is_zero_decimal_currency( $currency_code ) {
	$zero_decimal_currencies = array(
		'BIF',
		'CLP',
		'DJF',
		'GNF',
		'JPY',
		'KMF',
		'KRW',
		'MGA',
		'PYG',
		'RWF',
		'UGX',
		'VND',
		'VUV',
		'XAF',
		'XOF',
		'XPF',
	);
	if ( in_array( $currency_code, $zero_decimal_currencies ) ) {
		return true;
	}
	return false;
}

function tfre_pagination_ajax( $query = null, $paged = 1 ) {
	global $wp_query, $wp_rewrite;
	if ( $query )
		$main_query = $query;
	else
		$main_query = $wp_query;
	$total = isset( $main_query->max_num_pages ) ? $main_query->max_num_pages : '';
	if ( $total > 1 )
		echo '<div class="tfre-pagination paging-navigation paging-navigation-ajax clearfix">';
	echo paginate_links( array(
		'base'      => '%_%',
		'format'    => '?paged=%#%',
		'current'   => max( 1, $paged ),
		'total'     => $total,
		'mid_size'  => '1',
		'prev_text' => esc_html__( 'Previous', 'tf-real-estate' ),
		'next_text' => esc_html__( 'Next', 'tf-real-estate' ),
	) );
	if ( $total > 1 )
		echo '</div>';
}