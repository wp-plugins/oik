// closure to avoid namespace collision
(function(){
	// creates the plugin
	tinymce.create('tinymce.plugins.bwshortc', {
		// creates control instances based on the control's id.
		// our button's id is "bwshortc_button"
		createControl : function(id, controlManager) {
			if (id == 'bwshortc_button') {
				// creates the button
				var button = controlManager.createButton('bwshortc_button', {
					title : 'oik Shortcodes', // title of the button
					image : '../wp-content/plugins/oik/bw-sc-icon.gif',
					onclick : function() {
						// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'oik Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=bwshortc-form' );
					}
				});
				return button;
			}
			return null;
		}
	});
	
	// registers the plugin. DON'T MISS THIS STEP!!!
	tinymce.PluginManager.add('bwshortc', tinymce.plugins.bwshortc);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="bwshortc-form"><table id="bwshortc-table" class="form-table">\
                        <th><label for="bwshortc-type">Type</label></th>\
                        <td><select name="type" id="bwshortc-type">\
                           <option selected="selected" value="clear">Clear [clear]</option>\
                           <option value="bw_address">Extended address [bw_address]</option>\
                           <option value="bw_admin">Admin contact [bw_admin]</option>\
                           <option value="bw_alt_slogan">Alt. slogan [bw_alt_slogan]</option>\
                           <option value="bw_business">Business [bw_business]</option>\
                           <option value="bw_company">Company [bw_company]</option>\
                           <option value="bw_contact">Contact name [bw_contact]</option>\
                           <option value="bw_domain">Domain name [bw_domain]</option>\
                           <option value="bw_email">Email (formal) [bw_email]</option>\
                           <option value="bw_fax">Fax [bw_fax]</option>\
                           <option value="bw_formal">Formal company name [bw_formal]</option>\
                           <option value="bw_geo">Lat. and Long. [bw_geo]</option>\
                           <option value="bw_mailto">Mailto (inline) [bw_mailto]</option>\
                           <option value="bw_mob">Mobile phone [bw_mobile] (inline) </option>\
                           <option value="bw_mobile">Mobile phone [bw_mobile]</option>\
                           <option value="bw_show_googlemap">Show Google map [bw_show_googlemap]</option>\
                           <option value="bw_slogan">Slogan [bw_slogan]</option>\
                           <option value="bw_tel">Telephone number [bw_tel] (inline) /option>\
                           <option value="bw_telephone">Telephone number [bw_telephone]</option>\
                           <option value="bw_wpadmin">wp-admin link [bw_wpadmin]</option>\
                           <option value="bw_facebook">Facebook link [bw_facebook]</option>\
                           <option value="bw_flickr">Flickr link [bw_flickr]</option>\
                           <option value="bw_linkedin">LinkedIn link [bw_linkedin]</option>\
                           <option value="bw_picasa">Picase link[bw_picasa]</option>\
                           <option value="bw_twitter">Twitter link [bw_twitter]</option>\
                           <option value="bw_youtube">YouTube link [bw_youtube]</option>\
                           <option value="bw_google_plus">Google Plus link [bw_google_plus]</option>\
                           <option value="bw">Bobbing Wide [bw]</option>\
                           </select><br />\
                        <small>select the shortcode</small></td>\
                     </tr>\
                           <tr>\
				<th><label for="bwshortc-link">Choose the link</label></th>\
				<td><input link="text" name="link" id="bwshortc-link" value="" /><br />\
				<small>specify the URL e.g. /contact </small></td>\
			</tr>\
			<tr>\
				<th><label for="bwshortc-text">text</label></th>\
				<td><input link="text" name="text" id="bwshortc-text" value="" /><br />\
				<small>specify the text for the link</small>\
			</tr>\
			<tr>\
				<th><label for="bwshortc-title">title</label></th>\
				<td><input link="text" name="title" id="bwshortc-title" value="" /><br />\
				<small>specify the text when hovering over the link</small></td>\
			</tr>\
			<tr>\
				<th><label for="bwshortc-class">class</label></th>\
				<td><input link="text" name="class" id="bwshortc-class" value="" /><br />\
				<small>specify any additional CSS classes</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input link="button" id="bwshortc-submit" class="button-primary" value="Insert Shortcode" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#bwshortc-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
         //'shipcost'	: '',
          //'shipcost2'	: '',								
          //'weight'	: ''

			var options = { 
				'link'    : '',
				'text' : '',
				'title'       : '',
				'class'    : '',
			 			};
			var shortcode = '[';
         shortcode += table.find('#bwshortc-type').val();
			
			for( var index in options) {
				var value = table.find('#bwshortc-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()