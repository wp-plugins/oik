


tinymce.PluginManager.add('bwbutton', function(editor) {

	editor.addCommand('InsertButton', function() {
		//editor.execCommand('mceInsertContent', false, '<hr />');
      //bw.bw_shortc_button_callback_TinyMCE();

      // Discard any existing form and rebuild
      jQuery('#bwbutton-form').remove();

      // executes this when the DOM is ready
      //jQuery(function(){
         // creates a form to be displayed everytime the button is clicked
         // you should achieve this using AJAX instead of direct html code like this
         var form = jQuery('<div id="bwbutton-form"><table id="bwbutton-table" class="form-table">\
            <tr>\
               <th><label for="bwbutton-link">link</label></th>\
               <td><input link="text" name="link" id="bwbutton-link" value="" /><br />\
               <small>specify the URL e.g. /contact </small></td>\
            </tr>\
            <tr>\
               <th><label for="bwbutton-text">text</label></th>\
               <td><input link="text" name="text" id="bwbutton-text" value="" /><br />\
               <small>specify the text for the button</small>\
            </tr>\
            <tr>\
               <th><label for="bwbutton-title">title</label></th>\
               <td><input link="text" name="title" id="bwbutton-title" value="" /><br />\
               <small>specify the text when hovering over the button</small></td>\
            </tr>\
            <tr>\
               <th><label for="bwbutton-class">class</label></th>\
               <td><input link="text" name="class" id="bwbutton-class" value="" /><br />\
               <small>specify any additional CSS classes</small></td>\
            </tr>\
         </table>\
         <p class="submit">\
            <input link="button" id="bwbutton-submit" class="button-primary" value="Insert Button" name="submit" />\
         </p>\
         </div>');

         var table = form.find('table');
         form.appendTo('body').hide();

         // handles the click event of the submit button
         form.find('#bwbutton-submit').click(function(){
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
            var shortcode = '[bw_button';

            for( var index in options) {
               var value = table.find('#bwbutton-' + index).val();

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


           // triggers the thickbox
         //  var width = jQuery( 'div.bwshortc-form' ).width();
         //  var H = jQuery( 'div.bwshortc-form' ).height()
         //  var W = ( 720 < width ) ? 720 : width;
           //W = W - 80;
           //H = H - 84;
         //  tb_show( 'oik buttons', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=bwbutton-form' );

           //tb_show( 'oik Shortcodes', '#TB_inline?&inlineId=bwshortc-form' );
           //tb_show( 'oik shortcodes', '#TB_iframe=true' );
         //}

         // triggers the thickbox
         var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
         W = W - 80;
         H = H - 84;
         tb_show( 'oik Button', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=bwbutton-form' );


	});

	editor.addButton('bwbutton', {
		icon: 'bw-bn-icon',
         /*  text: '[]', */
		tooltip: 'Insert bw_button shortcode',
		cmd: 'InsertButton'
	});

	editor.addMenuItem('bwbutton', {
		icon: 'bw-bn-icon',
		//text: '[]',
		cmd: 'InsertButton',
		context: 'insert'
	});
});

