<?php
if ( ! function_exists( 'dreamhome_child_enqueue_child_styles' ) ) {
	function dreamhome_child_enqueue_child_styles() {
	    // loading parent style
	    wp_register_style(
	      'dreamhome-theme-style',
	      get_template_directory_uri() . '/style.css'
	    );

	    wp_enqueue_style( 'dreamhome-theme-style' );
	    // loading child style
	    wp_register_style(
	      'dreamhome-child-theme-style',
	      get_stylesheet_directory_uri() . '/style.css'
	    );
	    wp_enqueue_style( 'dreamhome-child-theme-style');
	 }
}
add_action( 'wp_enqueue_scripts', 'dreamhome_child_enqueue_child_styles' );

add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );

//for importing listings data
// Set unlimited execution time for long-running sync processes
ignore_user_abort(true);
set_time_limit(0);
// Register the API route
add_action('rest_api_init', function () {
    register_rest_route('property/v1', '/insert/', array(
        'methods' => 'GET',
        'callback' => 'insert_property_api',
        'permission_callback' => '__return_true',
    ));
});

// Register the API route
add_action('rest_api_init', function () {
    register_rest_route('property/v1', '/insert2/', array(
        'methods' => 'POST',  // Use POST to accept data
        'callback' => 'insert_property_api2',
        'permission_callback' => '__return_true',  // Modify for secure endpoints
    ));
});

// Define the callback function to handle the request
function insert_property_api2() {
    global $wpdb;

    // Fetch records from the `wp_properties` table where status = 0, limit 10
    $properties = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}properties WHERE status = 0 LIMIT 10", ARRAY_A);

    // Response data
    $response = [];

    if (!empty($properties)) {
        foreach ($properties as $property_data) {
            // Prepare response data for each property
            $property_response = [
                'property_id' => $property_data['id'] ?? '',
                'url' => $property_data['url'] ?? '',
                'city' => $property_data['city'] ?? '',
                'city_id' => $property_data['city_id'] ?? '',
                'data' => $property_data,
                'amenities' => !empty($property_data['amenities']) ? $property_data['amenities'] : 'No amenities available'
            ];

            // Insert or update property in the database (if needed)
            insert_or_update_property($property_data, $property_data['amenities']);

            // Add property response to the overall response
            $response[] = $property_response;
        }
    } else {
        $response['error'] = 'No properties found with status = 0.';
    }

    return new WP_REST_Response($response, 200);
}

function clean_description($description) {
    // Replace multiple line breaks with a single break
    if(!$description){
        return '';
    }

    $description = preg_replace('/\n+/', "\n", $description);

    // Remove any excessive spaces at the beginning or end of each line
    $description = preg_replace('/^\s+|\s+$/m', '', $description);

    // Convert line breaks to HTML <br> tags for better readability in HTML format
    $description = nl2br($description);

    return $description;
}

function insert_or_update_property($property_data, $amenities) {
    global $wpdb;

    $raw_description = null;

    if (!empty($property_data['descriptionFull'])) {
        foreach ($property_data['descriptionFull'] as $description) {
            if ($description['language'] === 'en') {
                $raw_description = $description['text'];
                break;
            } elseif ($description['language'] === 'es') {
                $raw_description = $description['text']; // Set Spanish description as fallback
            }
        }
    }

    // Clean the description if it's found
    $cleaned_description = !empty($raw_description) ? clean_description($raw_description) : 'No description available';
    //echo $cleaned_description; die;
    
    // Extract necessary data
    if (!empty($property_data['title'])) {
        $title = null;
    
        foreach ($property_data['title'] as $title_option) {
            if ($title_option['language'] === 'en') {
                $title = $title_option['text'];
                break;
            }
        }
        
        if ($title === null) {
            $title = $property_data['automaticTitle'] ?? 'Default Title';
        }
    } else {
        $title = $property_data['automaticTitle'] ?? 'Default Title';
    }

    $property_id = @$property_data['id'];
    $description = @$cleaned_description; // Assuming description in English
    $type = @$property_data['type']['name'];
    $subtype = @$property_data['subType']['name'];
    
    // Check if 'resources', 'pictures', and 'items' keys exist in $property_data
    $image_urls = array();
    if (isset($property_data['resources']['pictures']['items']) && is_array($property_data['resources']['pictures']['items'])) {
        // Loop through items to get URLs
        $image_urls = [];
        foreach ($property_data['resources']['pictures']['items'] as $item) {
            if (isset($item['url'])) {
                $image_urls[] = $item['url'];
            }
        }
        
        // Print or use $image_urls
        //print_r($image_urls); // This should show the array of URLs
    } else {
        //echo "No images found in the data structure.";
    }


    // Check if property already exists in the database
    $existing_post_id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'real-estate' AND post_name = %s LIMIT 1",
        'property-' . $property_id
    ));

    // Insert or update the post
    if ($existing_post_id) {
        // Update existing post
        $post_id = wp_update_post([
            'ID'           => $existing_post_id,
            'post_title'   => $title,
            'post_content' => $description,
            'post_type'    => 'real-estate',
            'post_status'  => 'publish',
            'post_author'  => 1,
        ]);
        //echo "old";
    } else {
        //echo "new";
        // Insert new post
        $post_id = wp_insert_post([
            'post_title'   => $title,
            'post_content' => $description,
            'post_type'    => 'real-estate',
            'post_status'  => 'publish',
            'post_name'    => 'property-' . $property_id,
            'post_author'  => 1,
        ]);
    }

    // Only proceed if the post was successfully inserted/updated
    if (!is_wp_error($post_id)) {
        // Update meta fields for the property
        update_post_meta($post_id, 'property_id', @$property_id);
        update_post_meta($post_id, 'property_address', @$property_data['location']['address1']);
        update_post_meta($post_id, 'property_bedrooms', @$property_data['numberOf']['bedrooms']);
        update_post_meta($post_id, 'property_bathrooms', @$property_data['numberOf']['bathrooms']);
        update_post_meta($post_id, 'property_latitude', @$property_data['location']['latitude']);
        update_post_meta($post_id, 'property_longitude', @$property_data['location']['longitude']);
        update_post_meta($post_id, 'property_size', @$property_data['area']['total']);
        update_post_meta($post_id, 'property_country', @$property_data['location']['countryISO']);

        $property_price = null;
        if (!empty($property_data['price']['values'])) {
            foreach ($property_data['price']['values'] as $price) {
                if ($price['type'] === 'Converted') {
                    $property_price = isset($price['value']) ? (int)$price['value'] : 0;
                    break;
                } elseif ($price['type'] === 'Original' && $property_price === null) {
                    $property_price = $price['value']; // Set Converted as fallback only if Original is not set
                }
            }
        }

        // Update post meta with the selected price, or set to a default value if no price is available
        update_post_meta($post_id, 'property_price', $property_price ?? 0);

        // Check if 'price' and 'values' keys exist in $property_data
        $price_value = null;
        if (isset($property_data['price']['values']) && is_array($property_data['price']['values'])) {
            foreach ($property_data['price']['values'] as $price) {
                if (isset($price['currencyId'])) {
                    if ($price['currencyId'] === 'MXN') {
                        // If MXN is found, store it and break out of the loop
                        $price_value = $price['value'];
                        break;
                    } elseif ($price_value === null) {
                        // If no MXN yet, store the first available currency as a fallback
                        $price_value = $price['value'];
                    }
                }
            }
        }

        // Update the post meta with the price value
        if ($price_value !== null) {
            update_post_meta($post_id, 'property_price_value', $price_value);
        } else {
            // Handle the case where no price is available at all
            update_post_meta($post_id, 'property_price_value', 0); // Or any other default value
        }
        
        // Add property type and subtype as taxonomy terms
        wp_set_object_terms($post_id, $type, 'property-type', true);
        wp_set_object_terms($post_id, $subtype, 'property-type', true);

        // Handle images and store gallery IDs
        //echo "<pre>"; print_r($image_url); die;
        $gallery_image_ids = store_images_and_create_gallery($post_id, $image_urls);
        //update_post_meta($post_id, 'gallery_images', $gallery_image_ids);
        insert_amenities($post_id, $amenities);
        insert_transaction_type($post_id, @$property_data['transactionType']);
        insert_province_state_custom($post_id, @$property_data['location']);

        //echo "<p>Property ID {$property_id} {$post_id} processed successfully.</p>";
    } else {
        //echo "<p>Error processing Property ID {$property_id}: " . $post_id->get_error_message() . "</p>";
    }

    return $post_id;
}

// Function to handle the main image processing
function store_images_and_create_gallery($post_id, $image_urls) {
    $attachment_ids = [];

    $first_id = '';
    foreach ($image_urls as $key=>$image_url) {
        // Check if image already exists as an attachment
        $attachment_id = check_if_image_exists($image_url);

        if (!$attachment_id) {
            // If image doesn't exist, insert it as an attachment
            $attachment_id = insert_image_as_attachment($image_url, $post_id);
        }

        if($key==0){
            $first_id = $attachment_id;
        }

        if ($attachment_id) {
            $attachment_ids[] = (string) $attachment_id; // Convert to string
        }
    }

    // Store the attachment IDs as a JSON-encoded array in the gallery meta field
    if (!empty($attachment_ids)) {
        update_post_meta($post_id, 'gallery_images', json_encode($attachment_ids));
        update_post_meta($post_id, '_thumbnail_id', $first_id);
    }

    return $attachment_ids;
}

// Function to check if an image already exists in the database
function check_if_image_exists($image_url) {
    global $wpdb;
    $attachment_id = $wpdb->get_var($wpdb->prepare(
        "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_wp_attached_file' AND meta_value LIKE %s",
        '%' . basename($image_url)
    ));

    return $attachment_id;
}

// Function to insert an image as an attachment
function insert_image_as_attachment($image_url, $post_id) {
    // Download the file temporarily
    $tmp = download_url($image_url);

    if (is_wp_error($tmp)) {
        return false;
    }

    // Extract the file name and extension from the URL or assign a default extension
    $file_name = basename($image_url);
    if (!preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file_name)) {
        // Get MIME type to detect file type if extension is missing
        $file_info = getimagesize($tmp);
        $mime_type = $file_info['mime'];

        // Set the file extension based on the MIME type or default to .jpg
        switch ($mime_type) {
            case 'image/jpeg':
                $file_name .= '.jpg';
                break;
            case 'image/png':
                $file_name .= '.png';
                break;
            case 'image/gif':
                $file_name .= '.gif';
                break;
            case 'image/webp':
                $file_name .= '.webp';
                break;
            default:
                $file_name .= '.jpg'; // Default to .jpg if MIME type is unrecognized
                break;
        }
    }

    $file_array = [
        'name' => $file_name,
        'tmp_name' => $tmp,
    ];

    // Handle the file sideload as an attachment
    $attachment_id = media_handle_sideload($file_array, $post_id);

    // If there's an error, delete the temporary file
    if (is_wp_error($attachment_id)) {
        @unlink($file_array['tmp_name']);
        return false;
    }

    return $attachment_id;
}

function insert_amenities($post_id, $amenities) {
    global $wpdb;

    $amenities = @json_decode($amenities, true);
    if(!empty($amenities) && is_array($amenities)){
            //echo "<pre>"; print_r($amenities); die;
            foreach ($amenities as $amenity) {
                // Extract the amenity name
                $name = $amenity['value'];
                $slug = sanitize_title($name);

                // Check if the amenity already exists in wp_terms
                $term = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}terms WHERE slug = %s", $slug));
                if (!$term) {
                    // Insert new term if it doesn't exist
                    $wpdb->insert("{$wpdb->prefix}terms", [
                        'name' => $name,
                        'slug' => $slug,
                        'term_group' => 0
                    ]);
                    $term_id = $wpdb->insert_id;

                    // Insert taxonomy relationship in wp_term_taxonomy
                    $wpdb->insert("{$wpdb->prefix}term_taxonomy", [
                        'term_id' => $term_id,
                        'taxonomy' => 'property-feature',
                        'description' => '',
                        'parent' => 0,
                        'count' => 0
                    ]);
                    $term_taxonomy_id = $wpdb->insert_id;
                } else {
                    // If term exists, get the term_taxonomy_id
                    $term_taxonomy = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}term_taxonomy WHERE term_id = %d AND taxonomy = %s", $term->term_id, 'property-feature'));
                    $term_taxonomy_id = $term_taxonomy->term_taxonomy_id;
                }

                // Link the term with the post in wp_term_relationships
                $exists = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}term_relationships WHERE object_id = %d AND term_taxonomy_id = %d", $post_id, $term_taxonomy_id));
                if (!$exists) {
                    $wpdb->insert("{$wpdb->prefix}term_relationships", [
                        'object_id' => $post_id,
                        'term_taxonomy_id' => $term_taxonomy_id,
                        'term_order' => 0
                    ]);

                    // Update the count in wp_term_taxonomy
                    $wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}term_taxonomy SET count = count + 1 WHERE term_taxonomy_id = %d", $term_taxonomy_id));
                }
        }
    }
}

function insert_transaction_type($post_id, $transactionType) {
    global $wpdb;

    // Extract the transaction type name and ID
    $name = 'For Sale';

    if (!empty($transactionType['name'])) {
        $name = 'For ' . $transactionType['name'];
    }

    // Correct any instance where 'For Sell' should be 'For Sale'
    if ($name === 'For Sell') {
        $name = 'For Sale';
    }

    $slug = sanitize_title($name);
    //echo $slug;
    // Check if the transaction type term already exists in wp_terms
    $term = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}terms WHERE slug = %s", $slug));

    if (!$term) {
        // Insert new term if it doesn't exist
        $wpdb->insert("{$wpdb->prefix}terms", [
            'name' => $name,
            'slug' => $slug,
            'term_group' => 0
        ]);
        $term_id = $wpdb->insert_id;

        // Insert taxonomy relationship in wp_term_taxonomy
        $wpdb->insert("{$wpdb->prefix}term_taxonomy", [
            'term_id' => $term_id,
            'taxonomy' => 'property-status',
            'description' => '',
            'parent' => 0,
            'count' => 0
        ]);
        $term_taxonomy_id = $wpdb->insert_id;
    } else {
        // If term exists, get the term_taxonomy_id
        $term_taxonomy = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}term_taxonomy WHERE term_id = %d AND taxonomy = %s", $term->term_id, 'property-status'));
        $term_taxonomy_id = $term_taxonomy->term_taxonomy_id;
    }

    // Link the term with the post in wp_term_relationships if not already linked
    $exists = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}term_relationships WHERE object_id = %d AND term_taxonomy_id = %d", $post_id, $term_taxonomy_id));
    
    if (!$exists) {
        $wpdb->insert("{$wpdb->prefix}term_relationships", [
            'object_id' => $post_id,
            'term_taxonomy_id' => $term_taxonomy_id,
            'term_order' => 0
        ]);

        // Update the count in wp_term_taxonomy
        $wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}term_taxonomy SET count = count + 1 WHERE term_taxonomy_id = %d", $term_taxonomy_id));
    }
}

function insert_province_state_custom($post_id, $location) {
    global $wpdb;

    // Get the postcode or fallback to city if postcode is missing
    $postcode = $location['postcode'] ?? null;
    $city = $location['city'] ?? null;
    $country = $location['countryISO'] ?? null;
    $state_name = '';

    if ($postcode) {
        // Fetch location data from the Zippopotam.us API based on postcode
        $api_url = "https://api.zippopotam.us/mx/" . urlencode($postcode);
        $response = wp_remote_get($api_url);

        if (!is_wp_error($response)) {
            $data = json_decode(wp_remote_retrieve_body($response), true);
            $state_name = $data['places'][0]['state'] ?? null;
        } else {
            error_log("Error fetching data from Zippopotam.us API for postcode {$postcode}");
            $state_name = null;
        }
    } else {
        // If no postcode, use the city name as the fallback
        $state_name = '';
    }

    // If Zippopotam.us API did not return a state, fall back to Google Geocoding API using city
    if (!$state_name && $city) {
        $google_api_key = "AIzaSyAjvANG3aBwPeDKfxQbGwVZU6Swf0iIhR8"; // Replace with your Google API Key
        $google_api_url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($city . ", " . $country) . "&key=" . $google_api_key;
        $google_response = wp_remote_get($google_api_url);

        if (!is_wp_error($google_response)) {
            $google_data = json_decode(wp_remote_retrieve_body($google_response), true);

            // Look for the state in the address components
            if (!empty($google_data['results'][0]['address_components'])) {
                foreach ($google_data['results'][0]['address_components'] as $component) {
                    if (in_array("administrative_area_level_1", $component['types'])) {
                        $state_name = $component['long_name'];
                        break;
                    }
                }
            }
        } else {
            error_log("Error fetching data from Google Geocoding API for city {$city}");
        }
    }

    // Ensure we have a valid state or city name to proceed
    if ($state_name) {
        $state_slug = sanitize_title($state_name);

        // Check if the term already exists in wp_terms
        $term = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}terms WHERE slug = %s", $state_slug));

        if (!$term) {
            // Insert new term into wp_terms if it doesn't exist
            $wpdb->insert("{$wpdb->prefix}terms", [
                'name' => $state_name,
                'slug' => $state_slug,
                'term_group' => 0
            ]);
            $term_id = $wpdb->insert_id;

            // Insert into wp_term_taxonomy to associate the term with 'province-state' taxonomy
            $wpdb->insert("{$wpdb->prefix}term_taxonomy", [
                'term_id' => $term_id,
                'taxonomy' => 'province-state',
                'description' => '',
                'parent' => 0,
                'count' => 0
            ]);
            $term_taxonomy_id = $wpdb->insert_id;
        } else {
            // If the term exists, get the term_taxonomy_id
            $term_taxonomy = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}term_taxonomy WHERE term_id = %d AND taxonomy = %s", $term->term_id, 'province-state'));
            $term_taxonomy_id = $term_taxonomy->term_taxonomy_id;
        }

        // Check if the term is already linked with the post in wp_term_relationships
        $exists = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}term_relationships WHERE object_id = %d AND term_taxonomy_id = %d", $post_id, $term_taxonomy_id));

        if (!$exists) {
            // Link the term with the post in wp_term_relationships if not already linked
            $wpdb->insert("{$wpdb->prefix}term_relationships", [
                'object_id' => $post_id,
                'term_taxonomy_id' => $term_taxonomy_id,
                'term_order' => 0
            ]);

            // Update the count in wp_term_taxonomy
            $wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}term_taxonomy SET count = count + 1 WHERE term_taxonomy_id = %d", $term_taxonomy_id));
        }
    } else {
        error_log("No valid state or city found for post ID {$post_id}");
    }
}

// Register the API route
function insert_property_api(WP_REST_Request $request) {
    global $wpdb;

    // Fetch records from the `wp_properties` table where status = 0, limit 1
    $properties = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}properties WHERE status = 0 LIMIT 5", ARRAY_A);

    // Response data
    $response = [];

    if (!empty($properties)) {
        foreach ($properties as $property_data_arr) {
            // Decode JSON data
            $property_data = json_decode($property_data_arr['data'], true);

            // Prepare response data for each property
            $property_response = [
                'property_id' => $property_data['id'] ?? '',
                'url' => $property_data['url'] ?? '',
                'city' => $property_data['city'] ?? '',
                'city_id' => $property_data['city_id'] ?? '',
                'data' => $property_data,
                'amenities' => !empty($property_data_arr['amenities']) ? $property_data_arr['amenities'] : 'No amenities available'
            ];

            // Insert or update property in the database (if needed)
            insert_or_update_property($property_data, $property_data_arr['amenities']);

            // Update the status to 1 for the processed property
            $wpdb->update(
                "{$wpdb->prefix}properties",
                ['status' => 1], // Set status to 1
                ['id' => $property_data_arr['id']], // Condition: match the property ID
                ['%d'], // Format for the new value (integer)
                ['%d']  // Format for the condition (integer)
            );

            // Add property response to the overall response
            $response[] = $property_data['id'];
        }
    } else {
        $response['error'] = 'No properties found with status = 0.';
    }

    return new WP_REST_Response($response, 200);
}
