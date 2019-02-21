jQuery(document).ready(function($){
    "use strict";
    $(document).on("click",'.form-field .radio-images',function(){
        jQuery(this).closest('.type-radio').find('img.radio-image').removeClass('radio-image-selected');
        jQuery(this).find('img.radio-image').toggleClass('radio-image-selected');
        jQuery(this).find('.option-tree-ui-radio').prop('checked', true);
    });
    
    /* Type Layout */
    $( "body" ).on( "click",".type_layout>a",function(e){e.preventDefault();
        var $c=$(this);
        $c.addClass('active').siblings('.active').removeClass('active');
        $c.siblings('input').val($c.data('value')).trigger('change');
    });
    /* Post Layout field */
    var $tmp=$('.post-layouts-item').last().clone();
    $( "body" ).on( "click", ".post-layouts-container>.post-layouts-item .post-layouts-item-remove", function(e){e.preventDefault();
        $(this).closest('.post-layouts-item').remove();
        postLayoutFieldMultiSelect();
        return false;
    });
    $( "body" ).on( "click", ".post-layouts-container>.add-buttons>.post-layouts-item-add", function(e){e.preventDefault();
        if($('.post-layouts-item').length){$tmp=$('.post-layouts-item').last().clone();}
        $tmp.find('select').change();
        $tmp.attr('data-row-type',$(this).data('type')).find('.row-type-hidden').val($(this).data('type'));
        $(this).closest('.add-buttons').before($tmp.clone());
        postLayoutFieldMultiSelect();
        return false;
    });
    $( "body" ).on( "click", ".post-layouts-container>.post-layouts-item .move-buttons>.post-layouts-item-move", function(e){e.preventDefault();
        var $type=$(this).data('type');
        var $row=$(this).closest('.post-layouts-item');
        if($type==='up'){
            $row.insertBefore($row.prev('.post-layouts-item'));
        }else{
            $row.insertAfter($row.next('.post-layouts-item'));
        }        
        postLayoutFieldMultiSelect();
        return false;
    });
    postLayoutFieldMultiSelect();
});
function postLayoutFieldMultiSelect(){
    "use strict";
    jQuery('.post-layouts-item .category select[multiple]').each(function(i){
        jQuery(this).attr('name',jQuery(this).data('name').replace("%index%",i));
    });
}
function showHidePostFormatField(){
    "use strict";
    jQuery('#normal-sortables>[id*="tw-format-"]').each(function(){
        if ( jQuery('#post-formats-select input:radio:checked') . length ) {
            if(jQuery(this).attr('id').replace("tw","post")===jQuery('#post-formats-select input:radio:checked').attr('id').replace('image', 'gallery')){
                jQuery(this).css('display', 'block');
            } else {
                jQuery(this).css('display', 'none');
            }
        }
    });    
}
jQuery(function($){
    "use strict";
    	
    /* Color Picker */
//    $(".color_picker").each(function(){
//        var $currColPick=$(this);
//        var $currColor=$currColPick.next('.color_picker_value').val();
//        $currColPick.wavesColorPicker({
//            color:$currColor,
//            onShow: function (colpkr) {
//                $(colpkr).stop().fadeIn(500);
//                return false;
//            },
//            onHide: function (colpkr) {
//                $(colpkr).stop().fadeOut(500);
//                return false;
//            },
//            onChange: function (hsb, hex, rgb, el) {
//                $(el).parent().find('.color_picker_inner').css('background-color', '#' + hex);
//                $(el).parent().find('.color_picker_value').val('#' + hex);
//            }
//        });
//    });

    /* Dependency */
    $('[data-dependency]').each(function(){
        var $cr=$(this);
        var $dep=$(this).data('dependency');
        var $name=$dep.element;
        var $el=$cr.siblings('[data-name="'+$name+'"]');
        var $elField=$el.find('[name="'+$name+'"]').length?$el.find('[name="'+$name+'"]'):$el.find('select,input');
        var $elChild=$el.data('def-child');
        if($elChild){
            $elChild.push($cr.data('name'));
        }else{
            $elChild='["'+$cr.data('name')+'"]';
        }
        $el.attr('data-def-child',$elChild);
        $elField.off('change').on('change',function(){
            if($elField.attr('type')=='checkbox'){$elField.val($elField.is(':checked')?'1':'0');}            
            $elChild=$el.data('def-child');
            for (var i = 0; i < $elChild.length; i++) {
                var $cEC=$el.siblings('.'+$elChild[i]);
                var $cDep=$cEC.data('dependency');
                var $value=$cDep.value;
                var $elSubChild=$cEC.data('def-child');
                var $hiden=true;
                if($value.indexOf($elField.val())==-1||$el.css('display')==='none'){
                    $cEC.hide();
                }else{
                    $hiden=false;
                    $cEC.show();
                }
                if($elSubChild){
                    for(var j in $elSubChild){
                        if($hiden){
                            $cEC.siblings('.'+$elSubChild[j]).hide();
                        }else{
                            $cEC.find('[name="'+$cEC.data('name')+'"]').change();
                        }
                    }
                }
            }
        });
        setTimeout(function(){$elField.trigger('change');},1000);
    });

    /* Page Template Change */
    $('#page_template').change(function(){
        if($(this).val()==='page-rowbuilder.php'){
            $('#page_meta_settings').stop().show();
        }else{
            $('#page_meta_settings').stop().hide();
        }
    }).change();
    
    /* Post format */
    showHidePostFormatField();
    $('#post-formats-select input').change(showHidePostFormatField);
    
    
    /* Gallery */
    
    var frame;
    var images = ever_script_data.image_ids;
    var selection = loadImages(images);

    $('#gallery_images_upload').on('click', function(e) {
        e.preventDefault();

        /* Set options for 1st frame render */
        var options = {
                title: ever_script_data.label_create,
                state: 'gallery-edit',
                frame: 'post',
                selection: selection
        };

        /* Check if frame or gallery already exist */
        if( frame || selection ) {
                options['title'] = ever_script_data.label_edit;
        }

        frame = wp.media(options).open();

        /* Tweak views */
        frame.menu.get('view').unset('cancel');
        frame.menu.get('view').unset('separateCancel');
        frame.menu.get('view').get('gallery-edit').el.innerHTML = ever_script_data.label_edit;
        frame.content.get('view').sidebar.unset('gallery'); /* Hide Gallery Settings in sidebar */

        /* When we are editing a gallery */
        overrideGalleryInsert();
        frame.on( 'toolbar:render:gallery-edit', function() {
        overrideGalleryInsert();
        });

        frame.on( 'content:render:browse', function( browser ) {
            if ( !browser ) return;
            /* Hide Gallery Setting in sidebar */
            browser.sidebar.on('ready', function(){
                browser.sidebar.unset('gallery');
            });
            /* Hide filter/search as they don't work  */
                browser.toolbar.on('ready', function(){ 
                        if(browser.toolbar.controller._state === 'gallery-library'){ 
                                browser.toolbar.$el.hide(); 
                        } 
                }); 
        });

        /* All images removed */
        frame.state().get('library').on( 'remove', function() {
            var models = frame.state().get('library');
                if(models.length === 0){
                    selection = false;
                    $.post(ajaxurl, { 
                        ids: '',
                        action: 'ever_save_images',
                        post_id: ever_script_data.post_id,
                        nonce: ever_script_data.nonce 
                    });
                }
        });

        /* Override insert button */
        function overrideGalleryInsert() {
                frame.toolbar.get('view').set({
                        insert: {
                                style: 'primary',
                                text: ever_script_data.label_save,

                                click: function() {                                            
                                        var models = frame.state().get('library'),
                                            ids = '';

                                        models.each( function( attachment ) {
                                            ids += attachment.id + ',';
                                        });

                                        this.el.innerHTML = ever_script_data.label_saving;

                                        $.ajax({
                                                type: 'POST',
                                                url: ajaxurl,
                                                data: { 
                                                    ids: ids, 
                                                    action: 'ever_save_images', 
                                                    post_id: ever_script_data.post_id, 
                                                    nonce: ever_script_data.nonce 
                                                },
                                                success: function(){
                                                    selection = loadImages(ids);
                                                    $('input#gallery_image_ids').val( ids );
                                                    frame.close();
                                                },
                                                dataType: 'html'
                                        }).done( function( data ) {
                                                $('.gallery-thumbs').html( data );
                                        }); 
                                }
                        }
                });
        }
    });

    /* Load images */
    function loadImages(images) {
            if( images && typeof wp.shortcode !== "undefined"){
                var shortcode = new wp.shortcode({
                    tag:    'gallery',
                    attrs:   { ids: images },
                    type:   'single'
                });

                var attachments = wp.media.gallery.attachments( shortcode );

                var selection = new wp.media.model.Selection( attachments.models, {
                        props:    attachments.props.toJSON(),
                        multiple: true
                });

                selection.gallery = attachments.gallery;

                /* Fetch the query's attachments, and then break ties from the */
                /* query to allow for sorting. */
                selection.more().done( function() {
                        /* Break ties with the query. */
                        selection.props.set({ query: false });
                        selection.unmirror();
                        selection.props.unset('orderby');
                });

                return selection;
            }
            return false;
    }
    /* Image */
    $(document).on("click",".tw-browseimage",function(e){e.preventDefault();
        var $currBtn = $(this);
        var $currBtnTxt = $currBtn.text();
        var $loadingTxt = 'Loading...';
        if($currBtnTxt!==$loadingTxt){
            $currBtn.text($loadingTxt);
            window.original_send_to_editor = window.send_to_editor;
            window.custom_editor = true;    
            window.send_to_editor = function(html){
                if(html){
                    html='<div>'+html+'</div>';
                    $(html).find('img').each(function(){
                        var imgurl = $(this).attr('src');
                        $currBtn.siblings('input').val(imgurl); 
                    });
                    $currBtn.text($currBtnTxt);
                }
            };
            wp.media.editor.open();
        }
    });
});