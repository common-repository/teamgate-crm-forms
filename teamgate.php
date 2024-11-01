<?php
/*
    Plugin Name: Teamgate CRM Lead Management
    Author: Teamgate
    Plugin URI: https://www.teamgate.com
    Description: A simple Teamgate CRM plugin to generate new sales opportunities within WordPress. That adds support for Contact Form 7 fields that have teamgate- input name prefix.
    Version: 1.6.3
    Author URI: https://www.teamgate.com
    License: GPL2
    License URI: https://www.gnu.org/licenses/gpl-2.0.html
    Domain Path /teamgate-crm
    Text Domain: teamgate-crm
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

register_activation_hook( __FILE__, 'teamgate_activation_check' );

function teamgate_activation_check() {
	if ( ! in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		wp_die( __( '<b>Warning</b> : Install/Activate Contact Form 7 to activate "Teamgate CRM Lead Management" plugin', 'teamgate' ) );
	}
}

function handleListValueFields( $name, $fieldGroup, $groupIndex, $value, &$dataset ) {
	$fieldId = preg_replace( '/teamgate-' . $fieldGroup . '-?(\d+)?-?/', '', $name );
	if ( $fieldGroup === 'address' ) {
		$fieldGroup = 'addresses';
	}

	if ( in_array( $fieldGroup, [ 'phone', 'email', 'url' ] ) ) {
		$fieldGroup .= 's';
	}

	if ( ! isset( $dataset[ $fieldGroup ] ) ) {
		$dataset[ $fieldGroup ] = [];
	}

	if ( $groupIndex !== null ) {
		if ( ! is_int( $groupIndex ) ) {
			$groupIndex = (int) $groupIndex;
		}
		if ( $fieldId === 'type' ) {
			$dataset[ $fieldGroup ][ $groupIndex ]['type'] = $value;
		} elseif ( empty( $fieldId ) ) {
			$dataset[ $fieldGroup ][ $groupIndex ]['value'] = $value;
		} else {
			$dataset[ $fieldGroup ][ $groupIndex ]['value'][ $fieldId ] = $value;
		}
	} else if ( ! empty( $fieldId ) && $fieldId === 'type' ) {
		$dataset[ $fieldGroup ][0]['type'] = $value;
	} else if ( ! empty( $fieldId ) ) {
		$dataset[ $fieldGroup ][0]['value'][ $fieldId ] = $value;
	} else {
		$dataset[ $fieldGroup ][0]['value'] = $value;
	}
}

/* Capture post data on form submit in Contact Form 7 */
add_action( 'wpcf7_mail_sent', 'teamgate_wpcf7_mail_sent' );

/**
 * @param WPCF7_ContactForm $contact_form
 *
 * @return void
 */
function teamgate_wpcf7_mail_sent( $contact_form ) {
	$title            = $contact_form->title();
	$submission       = WPCF7_Submission::get_instance();
	$appKey           = esc_attr( get_option( 'teamgate-app-key' ) );
	$authToken        = esc_attr( get_option( 'teamgate-auth-token' ) );
	$teamgatePostData = array();

	if ( $submission ) {
		$posted_data = $submission->get_posted_data();
		$files       = array_filter($submission->uploaded_files(), static function ($nameOfInput) {
            return strpos( $nameOfInput, 'teamgate' ) === 0;
        }, ARRAY_FILTER_USE_KEY);
        $files = array_filter($files);
	}

	if ( ! empty( $posted_data['teamgate-entry-handler'] ) && in_array(
			$posted_data['teamgate-entry-handler'],
			array( 'leads', 'people', 'companies', 'deals' )
		) ) {
		try {
			require __DIR__ . '/php-sdk/vendor/autoload.php';
			$api = new \Teamgate\API( [
				'apiKey'    => $appKey,
				'authToken' => $authToken
			] );
			// reformat custom fields
			foreach ( $posted_data as $index => $item ) {
				$item = is_array( $item ) && count( $item ) === 1 ? $item[0] : $item;
				if ( strpos( $index, 'teamgate-customFields-' ) !== false ) {
					$fieldId = str_replace( 'teamgate-customFields-', '', $index );
					if ( empty( $teamgatePostData['customFields'] ) ) {
						$teamgatePostData['customFields'] = array();
					}
					$teamgatePostData['customFields'][ $fieldId ] = $item;
					unset( $posted_data[ $index ] );
				} else if ( preg_match( '/teamgate-(address|email|url|phone)-?(\d+)?-?/', $index, $addressIndexes ) ) {
					handleListValueFields( $index, $addressIndexes[1], $addressIndexes[2] ?? null, $item, $teamgatePostData );
				} else if ( preg_match( '/teamgate-tags-?(\d+)?/', $index ) ) {
					if ( empty( $teamgatePostData['tags'] ) ) {
						$teamgatePostData['tags'] = [];
					}

					if ( is_array( $item ) ) {
						$teamgatePostData['tags'] = array_merge( $teamgatePostData['tags'], $item );
					} else {
						$teamgatePostData['tags'][] = $item;
					}
				} else if ( strpos( $index, 'teamgate-' ) !== false ) {
					$teamgatePostData[ str_replace( 'teamgate-', '', $index ) ] = $item;
				}
			}
			$method = $posted_data['teamgate-entry-handler'];
			$data   = $api->$method->create( $teamgatePostData );
		} catch ( Exception $e ) {
			error_log( $e->getMessage() );

			return;
		}
	}

	try {
		if ( ! empty( $posted_data['teamgate-entry-handler'] ) && ! empty( $files ) && ! empty( $data->data->id ) ) {
			$entityId      = $data->data->id;
			$headers       = [
				'X-App-Key'    => $appKey,
				'X-Auth-Token' => $authToken,
				'Content-Type' => 'application/json',
			];
			$filesToAttach = [];
			foreach ( $files as $fileName => $filePath ) {
				// make wordpress request to upload file to Teamgate Files api
				$fileInfo = wp_check_filetype( $filePath[0] );
				$body     = wp_json_encode([
					'name'        => trim(strrchr($filePath[0], '/'), '/') ?? $fileName . $fileInfo['ext'],
					'type'        => $fileInfo['type'],
					'size'        => filesize( $filePath[0] ),
					'description' => null,
					// think of the way to extract description from file name or from some CF7 input field or leave it empty or remove this field because it is optional
					'content'     => base64_encode( file_get_contents( $filePath[0] ) ),
					// add same tags that are submitted with the form or remove this field or add your own tag strings
					'tags'        => ! empty( $teamgatePostData['tags'] ) ? $teamgatePostData['tags'] : [],
				]);


                $params = [
                    'timeout' => 60,
                    'headers' => $headers,
                    'body'    => $body,
                ];

				$response = wp_remote_post( 'https://api.teamgate.com/v4/files', $params );

				if ( is_wp_error( $response ) ) {
					error_log( $response->get_error_message() );
				} else {
					if ( $response['response']['code'] !== 200 ) {
                        $body = json_decode($response['body'], true);
						error_log( $response['response']['message'] . ' ' . $body['error'] . ' at ' . __FILE__ . ':' . __LINE__ );
                        return;
					}

					// Process the response data
					$fileData = json_decode( wp_remote_retrieve_body( $response ), true );
					// Do something with the response data
					if ( ! empty( $fileData['data']['id'] ) ) {
						$filesToAttach[] = $fileData['data']['id'];
					}
				}
			}

			if ( ! empty( $filesToAttach ) ) {
				$response = wp_remote_request( 'https://api.teamgate.com/v4/' . $posted_data['teamgate-entry-handler'] . '/' . $entityId . '/files', [
                    'method' => 'PATCH',
					'headers' => $headers,
					'body'    => wp_json_encode([
						'value' => $filesToAttach,
					]),
				] );

				if ( is_wp_error( $response ) ) {
					error_log( $response->get_error_message() );
				} else {
                    if ( $response['response']['code'] !== 200 ) {
                        error_log( $response['response']['message'] . ' at ' . __FILE__ . ':' . __LINE__ );
                    }
                }
			}
		}
	} catch ( Exception $e ) {
		error_log( $e->getMessage() );

		return;
	}
}

/* Shortcode handler */
add_action( 'init', 'contact_form_7_teamgate_submit', 11 );

function contact_form_7_teamgate_submit() {
	if ( function_exists( 'wpcf7_add_form_tag' ) ) {
		wpcf7_add_form_tag( 'teamgatesubmit', 'wpcf7_teamgate_submit_shortcode_handler', false );
	} elseif ( function_exists( 'wpcf7_add_shortcode' ) ) {
		wpcf7_add_shortcode( 'teamgatesubmit', 'wpcf7_teamgate_submit_shortcode_handler', false );
	}
}

/**
 * Regenerate shortcode into Teamgate submit button
 */
function wpcf7_teamgate_submit_shortcode_handler( $tag ) {
	$tag   = new WPCF7_FormTag( $tag );
	$class = wpcf7_form_controls_class( $tag->type, 'has-spinner' );
	$atts  = array();

	$atts['class'] = $tag->get_class_option( $class );
	$atts['id'] = $tag->get_id_option();
	$atts['tabindex'] = $tag->get_option( 'tabindex', 'signed_int', true );

	$entry = $tag->get_option( 'entry' );
	$type  = ( empty( $entry ) ) ? 'leads' : $entry[0];

	$value = isset( $tag->values[0] ) ? $tag->values[0] : '';

	if ( empty( $value ) ) {
		$value = __( 'Submit', 'contact-form-7' );
	}

	$atts['type']  = 'submit';
	$atts['value'] = $value;

	$atts = wpcf7_format_atts( $atts );

	$html = '<input type="hidden" name="teamgate-entry-handler" value="' . $type . '" />';
	$html .= sprintf( '<input %1$s />', $atts );

	return $html;
}

/* * **********************************~: Admin Section of Teamgate submit button :~*********************************** */

/* Tag generator */

add_action( 'admin_init', 'wpcf7_add_tag_generator_teamgate_submit', 55 );

function wpcf7_add_tag_generator_teamgate_submit() {
	if ( class_exists( 'WPCF7_TagGenerator' ) ) {
		$tag_generator = WPCF7_TagGenerator::get_instance();
		$tag_generator->add( 'teamgate-submit', __( 'Teamgate Submit button', 'teamgate' ), 'wpcf7_tg_pane_teamgate_submit', array( 'nameless' => 1 ) );
	}
}

/** Parameters field for generating tag at backend * */
function wpcf7_tg_pane_teamgate_submit( $contact_form, $args = [] ) {
	$args = wp_parse_args( $args, [] );

	$description = __( "Generate a form-tag for a Teamgate submit button which call to Teamgate API after submitting the form. Fields must have matching Teamgate API entry type parameters.", 'contact-form-7' );

	$desc_link   = wpcf7_link( '', __( 'Teamgate submit', 'teamgate' ) );
	?>
    <div class="control-box">
        <fieldset>
            <legend><?php echo sprintf( esc_html( $description ), $desc_link ); ?></legend>
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-values' ); ?>"><?php echo esc_html( __( 'Label', 'contact-form-7' ) ); ?></label></th>
                    <td><input type="text" name="values" class="oneline" id="<?php echo esc_attr( $args['content'] . '-values' ); ?>" /></td>
                </tr>

                <tr>
                    <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-id' ); ?>"><?php echo esc_html( __( 'Id attribute', 'contact-form-7' ) ); ?></label></th>
                    <td><input type="text" name="id" class="idvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-id' ); ?>" /></td>
                </tr>

                <tr>
                    <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Class attribute', 'contact-form-7' ) ); ?></label></th>
                    <td><input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-class' ); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-types' ); ?>"><?php echo esc_html( __( 'Teamgate Entry Type', 'teamgate' ) ); ?></label></th>
                    <td>
                        <select id="<?php echo esc_attr( $args['content'] . '-types' ); ?>" name="types" onchange="document.getElementById('entry').value = this.value;">
                            <option value="leads">Lead</option>
                            <option value="people">Contact</option>
                            <option value="companies">Company</option>
                            <option value="deals">Deal</option>
                        </select>
                        <input type="hidden" name="entry" id="entry" value="leads" class="oneline option">
                    </td>
                </tr>
                </tbody>
            </table>
        </fieldset>
    </div>
    <div class="insert-box">
        <input type="text" name="teamgatesubmit" class="tag code" readonly="readonly" onfocus="this.select()"/>

        <div class="submitbox">
            <input type="button" class="button button-primary insert-tag"
                   value="<?php echo esc_attr( __( 'Insert Tag', 'teamgate' ) ); ?>"/>
        </div>
    </div>
	<?php
}

add_action( 'admin_menu', 'teamgate_settings_admin_menu' );

function teamgate_settings_admin_menu() {
	if ( current_user_can( 'administrator' ) ) {
		add_submenu_page( 'wpcf7',
			__( 'Teamgate CRM', 'teamgate' ),
			__( 'Teamgate CRM', 'teamgate' ),
			'wpcf7_edit_contact_forms', 'wpcf7-teamgate',
			'teamgate_settings_page' );
	}
}

function teamgate_settings_page() {
	?>
    <div class="wrap">
        <h2>Teamgate CRM Settings</h2>
        <form method="post" action="">
			<?php wp_nonce_field( 'teamgate-settings-apply' ); ?>
            <p><?php echo esc_html( __( 'API Key', 'teamgate' ) ); ?>:
                <input type="text" name="teamgate-app-key"
                       value="<?php echo esc_attr( get_option( 'teamgate-app-key' ) ); ?>" size="85"/></p>
            <p><?php echo esc_html( __( 'Auth Token', 'teamgate' ) ); ?>:
                <input type="text" name="teamgate-auth-token"
                       value="<?php echo esc_attr( get_option( 'teamgate-auth-token' ) ); ?>" size="85"/></p>
            <p><a href="https://www.teamgate.com/" target="_blank">More about Teamgate</a></p>
            <p><input type="submit" value="<?php echo esc_attr( __( 'Apply', 'teamgate' ) ); ?>"
                      class="button button-primary button-large"></p>
        </form>
    </div>
	<?php
}

//Save the data
add_action( 'admin_init', 'teamgate_settings_admin_data' );

function teamgate_settings_admin_data() {
	if ( isset( $_POST['teamgate-app-key'] ) && isset( $_POST['teamgate-auth-token'] ) && check_admin_referer( 'teamgate-settings-apply' ) ) {
		if ( ! empty( $_POST['teamgate-app-key'] ) ) {
			update_option( 'teamgate-app-key', sanitize_text_field( $_POST['teamgate-app-key'] ) );
		} else {
			update_option( 'teamgate-app-key', '' );
		}
		if ( ! empty( $_POST['teamgate-auth-token'] ) ) {
			update_option( 'teamgate-auth-token', sanitize_text_field( $_POST['teamgate-auth-token'] ) );
		} else {
			update_option( 'teamgate-auth-token', '' );
		}
		wp_safe_redirect( menu_page_url( 'wpcf7-teamgate', false ) );
	}

}
