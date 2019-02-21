(function() {
    "use strict";
    if ( $( 'body' ) . is( ':not(.block-editor-page)' ) ) {
        /* Post Carousel Shortcode */
        tinymce.PluginManager.requireLangPack('twshortcodegenerator');
        tinymce.create('tinymce.plugins.twshortcodegenerator', {
            init : function(ed, url) {
                ed.addCommand('twshortcodegenerator', function() {
                    ed.insertContent('<p>[tw_posts layout="1,2" title="Trending Posts" posts_per_page="6"]</p>');
                });
                ed.addButton('twshortcodegenerator', {title : 'Post Carousel',cmd : 'twshortcodegenerator',image : url + '/../img/shortcode-btn.png'});
            },
            createControl : function(n, cm) {return null;},
            getInfo : function() {return {longname : "Shortcode",author : '',authorurl : '',infourl : '',version : "1.0"};}
        });
        tinymce.PluginManager.add('twshortcodegenerator', tinymce.plugins.twshortcodegenerator);
        
        /* Author List Shortcode */
        tinymce.PluginManager.requireLangPack('evershortcodeauthorlist');
        tinymce.create('tinymce.plugins.evershortcodeauthorlist', {
            init : function(ed, url) {
                ed.addCommand('evershortcodeauthorlist', function() {
                    ed.insertContent('<p>[tw_author_list names="admin"]</p>');
                });
                ed.addButton('evershortcodeauthorlist', {title : 'Author List',cmd : 'evershortcodeauthorlist',image : url + '/../img/shortcode-btn.png'});
            },
            createControl : function(n, cm) {return null;},
            getInfo : function() {return {longname : "Shortcode",author : '',authorurl : '',infourl : '',version : "1.0"};}
        });
        tinymce.PluginManager.add('evershortcodeauthorlist', tinymce.plugins.evershortcodeauthorlist);
        
        /* Author List Shortcode */
        tinymce.PluginManager.requireLangPack('evershortcodedropcap');
        tinymce.create('tinymce.plugins.evershortcodedropcap', {
            init : function(ed, url) {
                ed.addCommand('evershortcodedropcap', function() {
                    ed.insertContent('[tw_dropcap]L[/tw_dropcap]');
                });
                ed.addButton('evershortcodedropcap', {title : 'Dropcap',cmd : 'evershortcodedropcap',image : url + '/../img/shortcode-btn.png'});
            },
            createControl : function(n, cm) {return null;},
            getInfo : function() {return {longname : "Shortcode",author : '',authorurl : '',infourl : '',version : "1.0"};}
        });
        tinymce.PluginManager.add('evershortcodedropcap', tinymce.plugins.evershortcodedropcap);
    }
})();