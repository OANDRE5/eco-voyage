function wpte_add_action(action_name,callback,priority){priority||(priority=10),priority>100&&(priority=100),priority<0&&(priority=0),"undefined"==typeof actions&&(actions={}),void 0===actions[action_name]&&(actions[action_name]=[]),void 0===actions[action_name][priority]&&(actions[action_name][priority]=[]),actions[action_name][priority].push(callback)}function wpte_do_action(){if(0!=arguments.length){var i,j,jlen,args_accepted=Array.prototype.slice.call(arguments),action_name=args_accepted.shift();if("undefined"==typeof actions&&(actions={}),void 0!==actions[action_name])for(i=0,100;i<=100;i++)if(actions[action_name][i])for(j=0,jlen=actions[action_name][i].length;j<jlen;j++){var fxn=actions[action_name][i][j];window[fxn](args_accepted)}}}function wpte_core_ui_fxn($){($=jQuery)(".wpte-toggle-item:not(.active) .wpte-toggle-content").hide(),$(document).on("click",".wpte-toggle-title a",function(){$(this).parents(".wpte-toggle-item").toggleClass("active"),$(this).parents(".wpte-toggle-title").siblings(".wpte-toggle-content").stop(!0,!1,!0).slideToggle()}),$(document).on("click",".wpte-onoff-block:not(.wpte-floated) .wpte-onoff-toggle",function(){$(this).toggleClass("active"),$(this).siblings(".wpte-onoff-popup").stop(!0,!1,!0).slideToggle()}),$(document).on("click",".wpte-onoff-block.wpte-floated .wpte-onoff-toggle",function(){$(this).toggleClass("active"),$(this).siblings(".wpte-onoff-popup").fadeToggle()}),$(document).on("click",".wpte-settings .wpte-repeater-block .wpte-system-btns .wpte-toggle-btn",function(){$(this).parents(".wpte-repeater-block").toggleClass("wpte-disabled")}),$(document).on("click",".wpte_save_continue_link",function(e){e.preventDefault();var parent=".wpte-tab-content.content_loaded",invalid=!1;if($(parent+" input, "+parent+" select, "+parent+" textarea").each(function(index){if($(this).parsley().validate(),!$(this).parsley().isValid()){invalid=!0;var Trigger=$(this).parents(".wpte-tab-content").data("trigger");return $(".wpte-tab-wrap a."+Trigger).click(),$(this).focus(),!1}}),invalid)toastr.error(WTE_UI.validation_error);else{var form_data={};$(parent+" input, "+parent+" select, "+parent+" textarea").each(function(index){if(filterby=$(this).attr("name"),filterby_val=$(this).val(),void 0===form_data[filterby]&&(form_data[filterby]=[]),"checkbox"==$(this).attr("type")||"radio"==$(this).attr("type"))1==$(this).data("multiple")?$(this).is(":checked")&&form_data[filterby].push(filterby_val):$(this).is(":checked")&&(form_data[filterby]=filterby_val);else if($(this).is("textarea")&&$(this).closest(".tmce-active").size()>0){id=$(this).attr("id");var content=tinymce.get(id).getContent();form_data[filterby]=content}else form_data[filterby]=filterby_val}),form_data.next_tab=$(this).data("next-tab"),form_data.tab=$(this).data("tab"),form_data.action="wpte_tab_trip_save_and_continue",form_data.nonce=$(this).data("nonce"),form_data.post_id=$(this).data("post-id");var selector=$('a[data-callback="'+form_data.next_tab+'"]');$.ajax({url:ajaxurl,data:form_data,type:"post",dataType:"json",beforeSend:function(xhr){$(".wpte-loading-anim").show()},success:function(data){$(".wpte-loading-anim").hide(),data.success&&(selector.trigger("click"),toastr.success(data.data.message))}})}}),$(".wte-global-tabs-holder").sortable(),$(document).on("click",".wpte-add-glb-tab",function(e){e.preventDefault();var template=wp.template("wpte-glb-tabs-row"),index=0<$(".wpte-glb-tab-row").length?$(".wpte-glb-tab-row").length+1:1;jQuery(".wte-global-tabs-holder").append(template({key:index})),++index}),$(document).on("click",".wpte-remove-glb-tab",function(e){e.preventDefault(),$(this).parents(".wpte-glb-tab-row").remove()}),$(".wpte-glb-trp-infos-holdr").sortable(),$(document).on("click",".wpte-add-glb-trp-info",function(e){e.preventDefault();var template=wp.template("wpte-add-trip-info-block"),index=Math.floor(99999998*Math.random())+1;jQuery(".wpte-glb-trp-infos-holdr").append(template({key:index})),++index}),$(document).on("click",".wpte-remove-glb-ti",function(e){e.preventDefault(),$(this).parents(".wpte-glb-trp-infos-row").remove()}),$(document).on("click",".wpte-save-global-settings",function(e){e.preventDefault();var parent=".wpte-global-settngstab.content_loaded",form_data={};$(parent+" input, "+parent+" select, "+parent+" textarea").each(function(index){if(filterby=$(this).attr("name"),filterby_val=$(this).val(),void 0===form_data[filterby]&&(form_data[filterby]=[]),"checkbox"==$(this).attr("type")||"radio"==$(this).attr("type"))1==$(this).data("multiple")?$(this).is(":checked")&&form_data[filterby].push(filterby_val):$(this).is(":checked")&&(form_data[filterby]=filterby_val);else if($(this).is("textarea")&&$(this).closest(".tmce-active").size()>0){id=$(this).attr("id");var content=tinymce.get(id).getContent();form_data[filterby]=content}else if($(this).is("textarea")&&0==$(this).closest(".tmce-active").size()){content=decodeEntities(filterby_val);form_data[filterby]=content}else form_data[filterby]=filterby_val}),form_data.action="wpte_global_tabs_save_data",form_data.nonce=$(this).data("nonce"),form_data.tab=$(this).data("tab"),$.ajax({url:ajaxurl,data:form_data,type:"post",dataType:"json",beforeSend:function(xhr){$(".wpte-loading-anim").show()},success:function(data){$(".wpte-loading-anim").hide(),data.success&&toastr.success(data.data.message)}})})}function wpte_trip_edit_scrolltop(){var target=jQuery("#trip_pricing_id");if(target.length)return jQuery("html,body").animate({scrollTop:target.offset().top},500,"swing"),!1}function wpte_tab_wpte_pricing(){jQuery(".wpte-multi-pricing-wrap").sortable(),jQuery("#wpte-adult-price-pertype-sel").change(function(e){e.preventDefault(),jQuery("#wpte-trip-default-pper").val(jQuery(this).val())})}function wpte_tab_wpte_overview(){jQuery(".wte-add-trip-highlight").on("click",function(e){e.preventDefault();var index=Math.floor(99999998*Math.random())+1,template=wp.template("tour-highlight-row");jQuery(".wpte-trip-highlights-hldr").append(template({key:index})),jQuery('input[name="wp_travel_engine_setting[trip_highlights]['+index+'][highlight_text]"]').focus(),++index,jQuery(".wte-delete-highlight:last").on("click",function(e){if(e.preventDefault(),!confirm(WTE_UI.suretodel))return!1;jQuery(this).parents(".wpte-trp-highlight").remove()})}),jQuery(".wte-delete-highlight").on("click",function(e){if(e.preventDefault(),!confirm(WTE_UI.suretodel))return!1;jQuery(this).parents(".wpte-trp-highlight").remove()}),jQuery(".wpte-trip-highlights-hldr").sortable()}function wpte_tab_wpte_itinerary(){jQuery(".wpte-add-itinerary").on("click",function(e){e.preventDefault();var iti_index=0<jQuery(".wpte-itinerary-repeter").length?jQuery(".wpte-itinerary-repeter").length+1:1,template=wp.template("wpte-add-iti-row");jQuery(".wpte-remove-iti").remove(),jQuery("#wpte-itinerary-repeter-holder").append(template({key:iti_index})),++iti_index}),jQuery(document).on("click",".wpte-remove-iti:last",function(e){if(e.preventDefault(),!confirm(WTE_UI.suretodel))return!1;jQuery(this).parents(".wpte-itinerary-repeter").remove(),jQuery(".wpte-itinerary-repeter:last").append('<button class="wpte-delete wpte-remove-iti"></button>')})}function wpte_tab_wpte_trip_facts(){jQuery("body").on("click",".add-info",function(e){e.preventDefault();var val=jQuery("#wte_global_trip_facts").find(":selected").val();if(""==val)return jQuery("#wte_global_trip_facts").css("-webkit-box-shadow","inset 0px 0px 1px 1px red"),jQuery("#wte_global_trip_facts").css("-moz-box-shadow","inset 0px 0px 1px 1px red"),void jQuery("#wte_global_trip_facts").css("box-shadow","inset 0px 0px 1px 1px red");jQuery("#wte_global_trip_facts").css("-webkit-box-shadow","inset 0px 0px 0px 0px red"),jQuery("#wte_global_trip_facts").css("-moz-box-shadow","inset 0px 0px 0px 0px red"),jQuery("#wte_global_trip_facts").css("box-shadow","inset 0px 0px 0px 0px red"),nonce=jQuery("#wte_global_trip_facts").attr("data-nonce"),jQuery.ajax({type:"post",url:ajaxurl,data:{action:"wp_add_trip_info",val:val,nonce:nonce},beforeSend:function(){},success:function(response){jQuery(".wpte-trip-facts-hldr").append(response),jQuery(".wpte-remove-trp-fact:last").on("click",function(e){if(e.preventDefault(),!confirm(WTE_UI.suretodel))return!1;jQuery(this).parents(".wpte-trip-fact-row").remove()})}})}),jQuery(".wpte-remove-trp-fact").on("click",function(e){if(e.preventDefault(),!confirm(WTE_UI.suretodel))return!1;jQuery(this).parents(".wpte-trip-fact-row").remove()}),jQuery(".wpte-trip-facts-hldr").sortable()}function wpte_tab_wpte_gallery(){var file_frame;$=jQuery;var allowed_filetype=["image/jpeg","image/png"];function wte_gal_sortable(){$(".wpte-gallery").length&&$(".wpte-gallery").sortable({opacity:.9,revert:!0})}function appendtemplate(ParsedURL,thumb){var template=wp.template("wpte-trip-videogallery-row"),rand=Math.floor(990*Math.random())+10,vidthumb=thumb;$(".wp-travel-engine-trip-video-gallery").append(template({index:rand,video_data:ParsedURL,thumb:vidthumb})),$("input#wte-trip-vid-url").val(""),$(".wte-video-list-srtable").sortable()}wte_gal_sortable(),$(document).on("click",".wpte-add-gallery-img",function(e){e.preventDefault();$(this);file_frame&&file_frame.close(),file_frame=wp.media.frames.file_frame=wp.media({title:$(this).data("uploader-title"),button:{text:$(this).data("uploader-button-text")},library:{type:allowed_filetype},multiple:!0});var index_max_count=Math.floor(99999998*Math.random())+1;file_frame.on("select",function(){file_frame.state().get("selection").map(function(attachment,i){attachment=attachment.toJSON();var file_html_content='<div class="wpte-gal-img"><input type="hidden" readonly name="wpte_gallery_id['+(index_max_count+i)+']" value="'+attachment.id+'"><img src="'+attachment.sizes.thumbnail.url+'" alt=""><div class="wpte-gal-btns"><button class="wpte-change wpte-change-gal-img"></button><button class="wpte-delete wpte-delete-gal-img"></button></div></div>';$(file_html_content).insertBefore("#wpte-gal-img-upldr-btn")})}),wte_gal_sortable(),file_frame.open()}),$(document).on("click",".wpte-change-gal-img",function(e){e.preventDefault();var that=$(this);file_frame&&file_frame.close(),(file_frame=wp.media.frames.file_frame=wp.media({title:$(this).data("uploader-title"),button:{text:$(this).data("uploader-button-text")},library:{type:allowed_filetype},multiple:!1})).on("select",function(){attachment=file_frame.state().get("selection").first().toJSON(),that.parents(".wpte-gal-img").children('input[type="hidden"]').val(attachment.id),that.parents(".wpte-gal-img").children("img").attr("src",attachment.sizes.thumbnail.url)}),file_frame.open()}),$(document).on("click",".wpte-delete-gal-img",function(e){e.preventDefault(),$(this).parents(".wpte-gal-img").remove()}),$(".wp-travel-engine-trip-video-gallery-add-video").click(function(e){e.preventDefault();var video_url=$("input#wte-trip-vid-url").val();if(""!=video_url){var videoObj,ParsedURL=function(url){url.match(/(http:\/\/|https:\/\/|)(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);var type=null;return RegExp.$3.indexOf("youtu")>-1?type="youtube":RegExp.$3.indexOf("vimeo")>-1&&(type="vimeo"),{type:type,id:RegExp.$6}}(video_url);if(null!=ParsedURL.type&&""!=ParsedURL.id)"youtube"==(videoObj=ParsedURL).type?appendtemplate(videoObj,"//img.youtube.com/vi/"+videoObj.id+"/hqdefault.jpg"):"vimeo"==videoObj.type&&$.get("http://vimeo.com/api/v2/video/"+videoObj.id+".json",function(data){appendtemplate(videoObj,data[0].thumbnail_medium)});else toastr.error(WTE_UI.invalid_url)}else toastr.error(WTE_UI.novid)}),$(document).on("click",".wp-travel-engine-trip-video-gallery .remove-video",function(e){if(e.preventDefault(),!confirm(WTE_UI.suretodel))return!1;$(this).parent("small").parent("li").remove()}),$(".wte-video-list-srtable").sortable()}function wpte_tab_wpte_map(){var file_frame;$=jQuery;var allowed_filetype=["image/jpeg","image/png"];$(document).on("click","#wpte-upload-map-img",function(e){e.preventDefault();$(this);file_frame&&file_frame.close(),(file_frame=wp.media.frames.file_frame=wp.media({title:"Upload Map image",button:{text:"Upload image"},library:{type:allowed_filetype},multiple:!1})).on("select",function(){file_frame.state().get("selection").map(function(attachment,i){attachment=attachment.toJSON();$("#map-image-prev-hldr").attr("src",attachment.sizes.medium.url),$('input[name="wp_travel_engine_setting[map][image_url]"]').val(attachment.id),$(".wpte-delete-map-img").show()})}),file_frame.open()}),$(document).on("click",".wpte-delete-map-img",function(e){e.preventDefault();var confirmation=confirm(WTE_UI.suretodel),fallback_img=$(this).data("fallback");if(!confirmation)return!1;$("#map-image-prev-hldr").attr("src",fallback_img),$('input[name="wp_travel_engine_setting[map][image_url]"]').val(""),$(this).hide()})}function wpte_tab_wpte_faq(){jQuery(document).on("click",".wpte-faq-block .wpte-faq-title",function(){jQuery(this).parents(".wpte-faq-block").toggleClass("wpte-active"),jQuery(this).parents(".wpte-faq-title-wrap").siblings(".wpte-faq-content").stop(!0,!1,!0).slideToggle()}),jQuery(document).on("click",".wpte-add-faq-blck",function(e){e.preventDefault();var index=0<jQuery(".wpte-faq-block-row").length?jQuery(".wpte-faq-block-row").length+1:1,template=wp.template("wpte-faq-block-tmp");jQuery(".wpte-faq-block-hldr").append(template({key:index})),++index}),jQuery(document).on("click",".wpte-del-faq",function(e){if(e.preventDefault(),!confirm(WTE_UI.suretodel))return!1;jQuery(this).parents(".wpte-faq-block-row").remove()}),jQuery(".wpte-faq-block-hldr").sortable()}function decodeEntities(encodedString){if(null!=encodedString&&""!=encodedString){var textArea=document.createElement("textarea"),newencodedString=encodedString.replace(/&amp;/g,"&");return textArea.innerHTML=newencodedString,textArea.value}}!function($){function show_admin_tab_content(selector){var wpteUniqueClass=selector.attr("class").split(" ")[1];selector.siblings(".wpte-tab").removeClass("current"),selector.addClass("current"),selector.parents(".wpte-tab-wrap").siblings(".wpte-tab-content-wrap").children(".wpte-tab-content").removeClass("current"),selector.parents(".wpte-tab-wrap").siblings(".wpte-tab-content-wrap").children("."+wpteUniqueClass+"-content").addClass("current content_loaded"),wpte_trip_edit_scrolltop()}jQuery(document).ready(function($){wpte_core_ui_fxn(),wpte_tab_wpte_overview(),$(".wpte-tab-nav").click(function(e){e.preventDefault();var selector=$(this);if($(this).hasClass("content_loaded"))show_admin_tab_content(selector);else{var tab_details=$(this).data("tab-details"),content_key=tab_details.content_key,data={action:"wpte_admin_load_tab_content",tab_details:tab_details,post_id:$(this).data("post-id"),next_tab:$(this).data("next-tab")};$.ajax({url:ajaxurl,data:data,type:"post",dataType:"json",beforeSend:function(xhr){$(".wpte-loading-anim").show()},success:function(data){if($(".wpte-loading-anim").hide(),data.success){var content=data.data.html;switch($(".wpte-tab-content-wrap").append(content),$(".wpte-tab-content-wrap textarea").each(function(){$(this).val(decodeEntities($(this).val()))}),show_admin_tab_content(selector),wpte_do_action("wpte_after_admin_tab_shown",content_key),content_key){case"wpte-pricing":wpte_tab_wpte_pricing();break;case"wpte-overview":wpte_tab_wpte_overview();break;case"wpte-itinerary":wpte_tab_wpte_itinerary();break;case"wpte-facts":wpte_tab_wpte_trip_facts();break;case"wpte-gallery":wpte_tab_wpte_gallery();break;case"wpte-map":wpte_tab_wpte_map();break;case"wpte-faqs":wpte_tab_wpte_faq()}selector.addClass("content_loaded")}}})}}),$(document).on("click",".wpte_load_global_settings_tab",function(e){e.preventDefault();var selector=$(this);if($(this).hasClass("content_loaded"))show_admin_tab_content(selector);else{var tab_details=$(this).data("tab-data"),content_key=$(this).data("content-key"),data={action:"wpte_global_settings_load_tab_content",tab_details:tab_details,content_key:content_key};$.ajax({url:ajaxurl,data:data,type:"post",dataType:"json",beforeSend:function(xhr){$(".wpte-loading-anim").show()},success:function(data){if($(".wpte-loading-anim").hide(),data.success){var content=data.data.html;switch($(".wpte-global-settings-tbswrp").append(content),show_admin_tab_content(selector),wpte_do_action("wpte_after_global_settings_tab_shown",content_key),content_key){case"wpte-miscellaneous":case"wpte-extensions":$("select.wpte-enhanced-select").select2()}selector.addClass("content_loaded")}}})}}),$(document).on("change keyup","*[bind]",function(e){var to_bind=$(this).attr("bind"),value=""!=$(this).val()?$(this).val():"";$("*[bind='"+to_bind+"']").val(value)}),$(document).on("change keyup","*[bindSale]",function(e){var to_bind=$(this).attr("bindSale"),value=""!=$(this).val()?$(this).val():"";$("*[bindSale='"+to_bind+"']").val(value)}),$(document).on("change",'input[name="wp_travel_engine_setting[multiple_pricing][adult][enable_sale]"]',function(e){$("#wpte-trip-enb-sale-price").prop("checked",this.checked)}),$(document).on("click",".wpte-copy-btn",function(e){e.preventDefault();var ID=$(this).data("copyid"),copyText=document.getElementById(ID);copyText.select(),copyText.setSelectionRange(0,99999),document.execCommand("copy"),toastr.success(WTE_UI.copied)}),$(document).on("click",".wpte-add-icon",function(){if($(".wpte-font-awesome-list").hide(),$(this).siblings(".wpte-font-awesome-list").length<1){var $iconlist=$(".wp-travel-engine-font-awesome-list-template").clone();$(this).after($iconlist.html()),$(this).siblings(".wpte-font-awesome-list").fadeIn("slow")}else $(this).siblings(".wpte-ico-search").remove(),$(this).siblings(".wpte-font-awesome-list").remove()}),$(document).on("click",".wpte-font-awesome-list li",function(event){event.preventDefault();var svg_data=$(this).children("svg"),val=$(this).children("svg").attr("data-prefix")+" fa-"+$(this).children("svg").attr("data-icon");$(this).parent().parent().siblings(".trip-tabs-icon").attr("value",val),$(this).parent().parent().siblings(".trip-tabs-icon").siblings("span.wpte-icon-preview").html(svg_data),$(this).parent().parent().fadeOut("slow",function(){}),$(this).parent().parent().siblings(".trip-tabs-icon").siblings(".wpte-font-awesome-list").remove(),$(this).parents(".wpte-icons-holder").find(".wpte-ico-search").remove()}),$(document).on("keyup",".wpte-ico-search",function(){var value=$(this).val(),matcher=new RegExp(value,"gi");$(this).parent(".wpte-font-awesome-list").find("li").show().not(function(){return matcher.test($(this).find("svg").attr("data-icon"))}).hide()}),$(".wpte-enhanced-select").select2({allowClear:!0,closeOnSelect:!1}),$(".wp-travel-engine-datetime").datepicker({dateFormat:"yy-mm-dd"}),$(document).on("click",".wpte-edit-bkng",function(e){e.preventDefault(),$(this).parents(".wpte-block").find(".wpte-block-content").fadeOut("slow").css({height:0,"padding-top":0,"padding-bottom":0,overflow:"hidden"}),$(this).parents(".wpte-block").find(".wpte-block-content-edit").fadeIn("slow").css("height","auto")}),$(document).on("click",".wpte-edit-prsnl-details",function(e){e.preventDefault(),$(this).parents(".wpte-prsnl-dtl-blk").find(".wpte-prsnl-dtl-blk-content").fadeOut("slow").css({height:0,"margin-top":0,overflow:"hidden"}),$(this).parents(".wpte-prsnl-dtl-blk").find(".wpte-prsnl-dtl-blk-content-edit").fadeIn("slow").css("height","auto")}),$(".wpte-glb-trp-infos-row").each(function(){"select"==$(this).find("select option:selected").val()?($(this).find(".select-options").show(),$(this).find(".input-placeholder").hide()):($(this).find(".select-options").hide(),$(this).find(".input-placeholder").show())}),$("body").on("change",".wpte-trp-inf-fieldtyp",function(e){"select"==$(this).find("select option:selected").val()?$(this).siblings(".wpte-field").find(".select-options").fadeIn("slow"):$(this).siblings(".wpte-field").find(".select-options").hide(),"text"==$(this).find("select option:selected").val()||"number"==$(this).find("select option:selected").val()||"textarea"==$(this).find("select option:selected").val()?$(this).siblings(".wpte-field").find(".input-placeholder").fadeIn("slow"):$(this).siblings(".wpte-field").find(".input-placeholder").hide()})}),$(function(){jQuery(document).ready(function($){$(document).on("click",".wpte-rich-textarea",function(e){var current_item=$(this),this_id=$(this).find("textarea.wte-editor-area").attr("id");current_item.hasClass("delay")&&(current_item.find(".wte-editor-notice").remove(),current_item.removeClass("delay"),function(this_id){wp.editor.initialize(this_id,{tinymce:{wpautop:!0,plugins:"charmap colorpicker compat3x directionality fullscreen hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview",toolbar1:"bold italic underline strikethrough | bullist numlist | blockquote hr wp_more | alignleft aligncenter alignright | link unlink | fullscreen | wp_adv",toolbar2:"formatselect alignjustify forecolor | pastetext removeformat charmap | outdent indent | undo redo | wp_help"},quicktags:!0,mediaButtons:!0})}(this_id))}),toastr.options.positionClass="toast-bottom-full-width",$(document).on("click",".wp-travel-engine-featured-trip",function(e){e.preventDefault();var featuredIcon=$(this),data={action:"wp_travel_engine_featured_trip",post_id:$(this).attr("data-post-id"),nonce:$(this).attr("data-nonce")};$.ajax({url:ajaxurl,data:data,type:"post",dataType:"json",success:function(data){"invalid"!=data&&(featuredIcon.removeClass("dashicons-star-filled").removeClass("dashicons-star-empty"),"yes"==data.new_status?featuredIcon.addClass("dashicons-star-filled"):featuredIcon.addClass("dashicons-star-empty"))}})}),$(document).on("click",".wp-travel-engine-featured-term",function(e){e.preventDefault();var featuredIcon=$(this),data={action:"wp_travel_engine_featured_term",post_id:$(this).attr("data-term-id"),nonce:$(this).attr("data-nonce")};$.ajax({url:ajaxurl,data:data,type:"post",dataType:"json",success:function(data){"invalid"!=data&&(featuredIcon.removeClass("dashicons-star-filled").removeClass("dashicons-star-empty"),"yes"==data.new_status?featuredIcon.addClass("dashicons-star-filled"):featuredIcon.addClass("dashicons-star-empty"))}})}),$(document).on("click",".wpte-tab-wrap .wpte-tab",function(){var wpteUniqueClass=$(this).attr("class").split(" ")[1];$(this).siblings(".wpte-tab").removeClass("current"),$(this).addClass("current"),$(this).parents(".wpte-tab-wrap").siblings(".wpte-tab-content-wrap").children(".wpte-tab-content").removeClass("current"),$(this).parents(".wpte-tab-wrap").siblings(".wpte-tab-content-wrap").children("."+wpteUniqueClass+"-content").addClass("current content_loaded")})})})}(jQuery);