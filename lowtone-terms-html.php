<?php
/*
 * Plugin Name: HTML in Term Description
 * Plugin URI: http://wordpress.lowtone.nl/plugins/terms-html/
 * Description: Allow the use of HTML in term descriptions.
 * Version: 1.0
 * Author: Lowtone <info@lowtone.nl>
 * Author URI: http://lowtone.nl
 * License: http://wordpress.lowtone.nl/license
 */
/**
 * @author Paul van der Meijs <code@lowtone.nl>
 * @copyright Copyright (c) 2013, Paul van der Meijs
 * @license http://wordpress.lowtone.nl/license/
 * @version 1.0
 * @package wordpress\plugins\lowtone\terms\html
 */

namespace lowtone\terms\html {

	add_action("init", function() {
		remove_filter("pre_term_description", "wp_filter_kses");
	});

	add_action("load-edit-tags.php", function() {
		wp_enqueue_script("lowtone_terms_html", plugins_url("/assets/scripts/jquery.terms-html.js", __FILE__), array("jquery"));

		$addEditor = function($term) {
			echo '<tr>' . 
				'<th scope="row" valign="top"><label for="description">' . _x('Description', 'Taxonomy Description') . '</label></th>' . 
				'<td>';

			$editorOptions = array(
					"textarea_name" => "description",
					"editor_height" => 360
				);

			wp_editor(html_entity_decode($term->description), "html_description", $editorOptions);

			echo '<br />' .
				'<span class="description">' . __('The description is not prominent by default; however, some themes may show it.') . '</span></td>' .
				'</tr>';
		};

		foreach (array("edit_category_form_fields", "edit_link_category_form_fields", "edit_tag_form_fields") as $action) 
			add_action($action, $addEditor);

	});

}