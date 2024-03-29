/*jshint browser:true, devel:true */
/*global jQuery, ajaxurl, icl_ajx_url, icl_ajxloaderimg, tm_basket_data */

(function ($) {
	"use strict";

	jQuery(document).ready(
		function () {

			//Basket

			/* enable button 'Remove from basket' in Translation management > Translate jobs */
			var translation_jobs_basket_form = jQuery('#translation-jobs-basket-form');
			var handle_basket_form_cb = function(cb_location){
				if (jQuery('#translation-jobs-basket-form').find(cb_location + ':checked').length > 0) {
					jQuery('#icl-tm-basket-delete-but').removeAttr('disabled');
				} else {
					jQuery('#icl-tm-basket-delete-but').attr('disabled', 'disabled');
				}
			};

			var cb_locations = ['td', 'tfoot th', 'thead th'];
			jQuery.each(cb_locations,function(cb_location){
				cb_location += ' :checkbox:checked';
				translation_jobs_basket_form.find(cb_location).click(
					function () {
						handle_basket_form_cb(cb_location);
					}
				);
			});

			jQuery('.js-translation-jobs-basket-form').on(
				'submit', function (e) { // Display confirmation on form submit
					e.preventDefault();

					var message = jQuery(this).data('message');
					var confirmation = confirm(message);

					if (confirmation) {
						jQuery(this).off('submit');
						jQuery(this).trigger('submit');
					}

					return false;
				}
			);

			function Translation_Jobs() {
				var form = jQuery('#translation-jobs-translators-form');
				var form_send_button = form.find('.button-primary');
				var form_delete_button = jQuery('[name="clear-basket"]');
				var basket_name_element = form.find('#basket_name');
				var basket_extra_fields_list = form.find('#basket_extra_fields_list');
				var message_box;
				var message_box_content;
				var additional_data;
                var progress_bar_object = new ProgressBar();
				var progress_bar = progress_bar_object.getDomElement();
				var batch_basket_items = [];
				var batch_number = 0;
				var batch_size;
				var batch_deadline = form.find( '#basket-deadline' );

				var init = function () {
					form.bind('submit', submit_form);

					// prevent sending basket by pressing Enter
					form.bind("keypress", function(e) {
						if (e.keyCode == 13) {
							e.preventDefault();
							return false;
						}
					});

					basket_name_element.bind('blur', basket_name_blur);

					message_box = jQuery('<div class="message_box"><div class="wpml-tm-basket-message-icon"></div></div>');
					message_box_content = jQuery('<div class="wpml-tm-basket-message-content"></div>');
					message_box_content.appendTo(message_box);
					message_box.insertBefore(form_send_button).hide();

					additional_data = jQuery('<div class="additional_data"></div>');

					progress_bar.insertAfter(message_box_content);
					progress_bar.hide();

					initDatePicker();
					$('#icl-translation-translators').on('change', '.js-wpml-translator-dropdown', refresh_deadline_date);
				};

				var initDatePicker = function() {
					batch_deadline.datepicker({
						minDate: new Date( Date.now() ),
						dateFormat: "yy-mm-dd",
						dayNames: wpml_tm_translation_basket_and_options.day_names,
						dayNamesMin: wpml_tm_translation_basket_and_options.day_initials,
						monthNames: wpml_tm_translation_basket_and_options.month_names
					});

					jQuery( 'body' ).addClass( 'wpml' );
				};

				var refresh_deadline_date = function(e) {
					var translatorsTable = $(e.delegateTarget);
					var selectors = translatorsTable.find('.js-wpml-translator-dropdown');
					var spinner = batch_deadline.siblings('.spinner');
					var translators = {};

					$.each(selectors, function(i, selector) {
						selector = $(selector);
						var lang_to = selector.data('lang-to');
						translators[ lang_to ] = selector.find(':selected').val();
					});

					spinner.addClass('is-active');

					$.post({
						url: ajaxurl,
						data: {
							action: 'wpml-tm-jobs-deadline-estimate-ajax-action',
							nonce: form.find('#_icl_nonce_refresh_deadline').val(),
							translators: translators
						},
						success: function(response) {
							form.find('#basket-deadline').val(response.data.deadline);
							spinner.removeClass('is-active');
						}
					});
				};

				var basket_name_blur = function (e) {
					if (e !== null && typeof e.preventDefault !== 'undefined') {
						e.preventDefault();
					}

					var spinner = jQuery('<span class="spinner" style="display: inline-block;"></span>');
					spinner.hide();

					spinner.insertAfter(jQuery(this));
					spinner.css('float', 'none');
					spinner.show();

					check_basket_name();

					spinner.hide();

					return false;
				};

                var get_nonce = function (action) {
                    var nonceField = jQuery('[id="_icl_nonce_' + action + '"]');

                    return nonceField ? nonceField.val() : '';
                };

				var check_basket_name = function () {

                    var action = 'check_basket_name';
                    var nonce = get_nonce(action);
					var check_result = false;
					var basket_name = get_basket_name();
                    form_send_button.attr('disabled', 'disabled');
                    jQuery.ajax(
                        {
                            type: "POST",
                            url: ajaxurl,
                            dataType: 'json',
                            async: false,
                            data: {
                                action: 'check_basket_name',
                                basket_name: basket_name,
                                _icl_nonce: nonce
                            },
							success:  function (result) {
                                result = result.data;
								/** @namespace result.new_value */
								if (result.valid) {
									if (result.modified) {
										set_basket_name(result.new_value);
									}
									form_send_button.removeAttr('disabled').show();
								} else {
									form_send_button.attr('disabled', 'disabled');
									alert(result.message);
									set_basket_name(result.new_value);
                                    check_basket_name();
								}

								check_result = result.valid;
							},
							error:    function (jqXHR, textStatus) {
								show_errors(jqXHR, textStatus);
								form_send_button.attr('disabled', 'disabled');
								check_result = false;
							}
						}
					);

					return check_result;
				};

				var get_basket_name = function () {
					if (typeof basket_name_element !== 'undefined' && basket_name_element.val().length === 0) {
						basket_name_element.val(basket_name_element.attr('placeholder'));
					}

					return basket_name_element.val();
				};

				var set_basket_name = function (value) {
					if (typeof basket_name_element !== 'undefined') {
						basket_name_element.val(value);
					}

					return basket_name_element.val();
				};

				// translator[it]
				// translator[en-US]
				var get_translators = function () {
					var extract_translator = function (translators, key, value) {
						if (typeof key !== 'undefined' && /^translator/.test(key)) {
                            key = key.replace('translator[', '').replace(']', '');
							if (translators[key] !== undefined) {
								if (!translators[key].push) {
									translators[key] = [translators[key]];
								}
								translators[key].push(value || '');
							} else {
								translators[key] = value || '';
							}
						}
					};

					//Todo: get only translators
					var translators = {};
					var a = form.serializeArray();
					jQuery.each(
						a, function () {
							var key = this.name;
							var value = this.value;
							extract_translator(translators, key, value);
						}
					);

					return translators;
				};

				var get_extra_fields = function () {
					var items  =  jQuery('#basket_extra_fields_list').find(':input').get();
					var string = '';
					var items_total = jQuery(items).length;

					if (items_total > 0) {
						jQuery(items).each(function (index, elm) {
							string += elm.name +":"+ jQuery(elm).val();
							if (index !== items_total - 1) {
								string += "|";
							}
						});
					}

					return encodeURIComponent(string);
				};

				var sending_only_to_professional_translation = function (translators) {
					var isProfessionalTranslator = function (translator) {
						return translator.match(/^ts-\d+$/);
					};

					var translatorsArray = Object.values(translators);
					return translatorsArray.length === translatorsArray.filter(isProfessionalTranslator).length;
				};

				var submit_form = function (e) {
					//Prevent submitting the form
					if (typeof e.preventDefault !== 'undefined') {
						e.preventDefault();
					}

					if (!check_basket_name()) {
						return false;
					}

					additional_data.empty();
					message_box.hide();
					additional_data.appendTo(message_box_content);

					var basket_name = get_basket_name();
					var translators = get_translators();
					translation_jobs_basket_form.find('.row-actions').hide();

					form_send_button.attr('disabled', 'disabled').hide();
					form_delete_button.attr('disabled', 'disabled');

					message_box.show();

					var header = sending_only_to_professional_translation(translators) ?
						tm_basket_data.strings['sending_batch_to_ts'] :
						tm_basket_data.strings['sending_batch'];

					update_message('<h4>' + header + '</h4>', true, 'sending', false);


					if (typeof translators === 'undefined' || translators.length === 0) {
						update_message(tm_basket_data.strings['error_no_translators'], true, 'error', false);
						end_process(false);
						return false;
					}

                    progress_bar_object.start();
                    var action = 'send_basket_items';
					var nonce = get_nonce(action);

					//Retrieve basket items
					jQuery.ajax(
						{
							type:     "POST",
							url:      ajaxurl,
							dataType: 'json',
                            data: {
                                action: action,
                                basket_name: basket_name,
                                _icl_nonce: nonce
                            },
							success:  function (result) {
                                result = result.data;
								/** @namespace result.basket */
								var basket = result.basket;
								/** @namespace result.allowed_item_types */
								var allowed_item_types = result.allowed_item_types;

								update_message(result.message, false, 'sending', false);

								batch_basket_items = [];

								//Loop through basket item group
								jQuery.each(
									basket, function (item_type, basket_group) {
										if (jQuery.inArray(item_type, allowed_item_types) >= 0) {
											jQuery.each(
												basket_group, function (post_id) {
													var batch_basket_item = {};
													batch_basket_item.type = item_type;
													batch_basket_item.post_id = post_id;
													batch_basket_items.push(batch_basket_item);
												}
											);
										}
									}
								);
                                progress_bar_object.overall_count = batch_basket_items.length;
                                update_basket_badge_count(progress_bar_object.getRemainingCount());
								batch_send_basket_to_tp(basket_name, translators);
							},
							error:    function (jqXHR, textStatus) {
								show_errors(jqXHR, textStatus);
                                show_rollback_message();
							}
						}
					);

					//Prevent submitting the form (backward compatibility)
					return false;
				};

                var progressbar_finish_text = '100%';
				var progressbar_callback = function (progress_bar) {
					progress_bar.dom.remove();
				};

				var update_basket_badge_count = function (count) {
					var badge = jQuery('#wpml-basket-items');
					count = parseInt(count, 10);

					if (count > 0) {
						badge.find('#basket-item-count').text(count);
					} else {
						badge.hide();
					}
				};

				var batch_send_basket_to_tp = function (basket_name, translators, skip_items) {

					if (typeof skip_items === 'undefined') {
						skip_items = 0;
						batch_number = 0;
						// We consider 2s per doc and per lang, and we don't want to exceed 20s per request
						var langs = Object.keys(translators);
						batch_size = Math.ceil(20 / langs.length); // 1 to 20
						batch_size = Math.min(5, batch_size); // 1 to 5
					}

					batch_number++;

					var extra_fields = get_extra_fields();

					var batch_length = batch_basket_items.length;
					if ((batch_length - skip_items) <= 0) {
						end_process(true);
						return;
					}

					if (batch_length > 1) {

						var batch_number_label = jQuery('<p><strong>' + tm_basket_data.strings['batch'] + ' #' + batch_number + '</strong></p>');

						update_message(batch_number_label, true, 'sending', true);
					}

					var batch_data = batch_basket_items.slice(skip_items, skip_items + batch_size);

					var error = false;
                    var action = 'send_basket_item';
                    var nonce  = get_nonce(action);

                    jQuery.ajax(
                        {
                            type: "POST",
                            url: ajaxurl,
                            dataType: 'json',
                            data: {
                                action: action,
                                _icl_nonce: nonce,
                                basket_name: basket_name,
                                batch: batch_data,
                                translators: translators,
                                extra_fields: extra_fields,
                                deadline_date: batch_deadline.val()
                            },
                            success: function (result) {
                                var success = result.success;
                                var data = result.data;
                                /** @namespace result.is_error */
                                if (success) {
                                    progress_bar_object.change(batch_size);
                                    //Let's give some rest to the server
                                    setTimeout(
                                        function () {
                                            batch_send_basket_to_tp(basket_name, translators, (skip_items + batch_size));
                                        }, 1000
                                    );
                                } else {
                                    update_message(data.message, true, 'error', true);
                                    show_additional_messages(data);
                                    progress_bar_object.stop();
                                    end_process(false);
                                }
                            },
                            error: function (jqXHR, textStatus) {
                            	if (jqXHR.status >= 500) {
									request_rollback_for_batch(basket_name);
								}

                                show_errors(jqXHR, textStatus);
                                show_rollback_message();
                            }
                        }
                    );
                };

				var show_additional_messages = function (result) {
					/** @namespace result.additional_messages */
					if (typeof result.additional_messages !== 'undefined' && result.additional_messages !== null && result.additional_messages.length > 0) {
						jQuery.each(
							result.additional_messages, function (i, additional_message) {
								update_message(additional_message.text, true, additional_message.type, true);
							}
						);
					}
				};

				var show_errors = function (jqXHR, textStatus) {
					if (jqXHR.responseText === 'undefined') {
						update_message('<strong>'+tm_basket_data.strings['error_occurred']+'</strong><div>' + textStatus + '</div>', false, 'error', true);
					} else if (jqXHR.responseText === 'Invalid nonce') {
						update_message(tm_basket_data.strings['error_not_allowed'], false, 'error', true);
					} else {
						var error_content = jQuery(jqXHR.responseText.substring(1, jqXHR.responseText.length - 1));
						update_message(tm_basket_data.strings['error_occurred'], false, 'error', true);
						update_message(error_content, true, 'error', true);
					}
				};

				var batch_send_basket_to_tp_commit = function () {
					update_message(tm_basket_data.strings['jobs_committing'], false, 'sending', false);

                    var action = 'send_basket_commit';
                    var nonce = get_nonce(action);
                    jQuery.ajax(
                        {
                            type: "POST",
                            url: ajaxurl,
                            dataType: 'json',
                            data: {
                                action: action,
                                _icl_nonce: nonce,
                                translators: get_translators(),
                                basket_name: get_basket_name()
                            },
							success:  function (result) {
                                var success = result.success;
                                result = result.data;
								if (success) {
                                    if(typeof result.result.is_local !== 'undefined' && result.result.is_local ) {
                                        var message = tm_basket_data.strings['jobs_sent_to_local_translator'];

                                        if(typeof result.result.emails_did_not_sent !== 'undefined' && result.result.emails_did_not_sent ){
                                        	message = message.replace(/<ul><li>[\s\S]*?<\/li>/, '<ul>' + tm_basket_data.strings['jobs_emails_local_did_not_sent'] );
										}
                                    }else{
                                        var message = tm_basket_data.strings['jobs_committed'];
									}
									if (typeof result.links !== 'undefined') {
										var links = jQuery('<ul></ul>');
										jQuery.each(
											result.links, function (i, link) {
												var link_item = jQuery('<li></li>');
												var link_anchor = jQuery('<a></a>');
												link_anchor.attr('href', link.url);
												link_anchor.text(link.text);

												link_anchor.appendTo(link_item);
												link_item.appendTo(links);
											}
										);
										links.appendTo(message);
									}
									update_message(message, false, 'updated', false);
									var call_to_action = false;
									/** @namespace result.result.call_to_action */
									if(typeof result.result.call_to_action !== 'undefined') {
										call_to_action = jQuery('<p>' + result.result.call_to_action + '</p>');
										update_message(call_to_action, true, 'updated', true);
									}

									batch_send_basket_to_tp_completed(result);

								} else {
                                    handle_response(result);
                                    show_rollback_message();
								}
                            },
							error:    function (jqXHR, textStatus) {
								show_errors(jqXHR, textStatus);
                                show_rollback_message();
                            }
						}
					);
				};

                var show_rollback_message = function () {
                    update_message(tm_basket_data.strings['rollbacks'], false, 'error', false);
                    update_message(tm_basket_data.strings['rolled'], false, 'error', true);
                    progress_bar_object.complete(progressbar_finish_text, progressbar_callback);
                };

                var request_rollback_for_batch = function(basket_name) {
                	var action = 'rollback_basket';

					jQuery.ajax(
						{
							type: "POST",
							url: ajaxurl,
							dataType: 'json',
							data: {
								action: action,
								_icl_nonce: get_nonce(action),
								basket_name: basket_name
							}
						}
					);
				};

				var batch_send_basket_to_tp_completed = function (response) {
					progress_bar_object.complete(progressbar_finish_text, progressbar_callback);
					form_send_button.attr('disabled', 'disabled');
					form_delete_button.attr('disabled', 'disabled');
					basket_name_element.attr('disabled', 'disabled');
					basket_name_element.attr('readonly', 'readonly');
					batch_deadline.attr('disabled', 'disabled');
					batch_deadline.attr('readonly', 'readonly');
					form.attr('disabled', 'disabled');
					form.attr('readonly', 'readonly');
					form.trigger('wpml-tm-basket-submitted', response);

					// hide the badge
					jQuery('#wpml-basket-items').hide();

				};

				var end_process = function (commit) {

					if (commit) {
						batch_send_basket_to_tp_commit();
					} else {
                        form_delete_button.removeAttr('disabled');
                        form_send_button.removeAttr('disabled').show();
                        show_rollback_message();
					}
				};

				var handle_response = function (response) {
					var errors = [];
					if (typeof response.errors !== 'undefined') {
						errors = response.errors;
					}

					if (errors.length > 0) {
						update_message(tm_basket_data.strings['errors'], false, 'error', true);
						jQuery.each(
							errors, function (i, error_message) {
								update_message(error_message, true, 'error', true);
							}
						);
					}
				};

				var update_message = function (message, details, status, append) {
					var target;

					if (typeof append !== 'undefined' && append !== false) {
						append = true;
					}

					if (typeof status !== 'undefined') {
						message_box.removeClass();
						message_box.addClass('wpml-tm-basket-message wpml-tm-basket-message-' + status);
					}

					if (typeof details !== 'undefined' && details !== false) {
						target = additional_data;
						if (!target.length) {
							target = message_box_content;
						}
					} else {
						target = message_box_content;
					}
					if (!append) {
						target.empty();
						if (target === message_box_content) {
							additional_data.appendTo(message_box_content);
						}
					}
					build_message(target, message);
				};

                var build_message = function (container, message_element_or_string) {

                    if (message_element_or_string && typeof container !== 'undefined') {
                        if (container.is(":hidden") || !container.is(':visible')) {
                            container.show();
                        }
                        if (typeof message_element_or_string === 'string') {
                            message_element_or_string = jQuery('<p>' + message_element_or_string + '</p>');
                        }
                        if (typeof message_element_or_string === 'object') {
                            message_element_or_string.appendTo(container);
                        }
                    }

                    return message_element_or_string;
                };

                init();
            }

			Translation_Jobs();

		var basket_extra_fields_refresh = jQuery('#basket_extra_fields_refresh');
		basket_extra_fields_refresh.click(function(event) {
			event.preventDefault();
			var basket_extra_fields_list = jQuery('#basket_extra_fields_list');
			var ajax_spinner = jQuery('<span class="spinner"></span>');
			ajax_spinner.show();
			ajax_spinner.css('visibility', 'visible');
			basket_extra_fields_list.html(ajax_spinner);
			var ajax_data = {
				'action': 'basket_extra_fields_refresh'
			};

			jQuery.post(ajaxurl, ajax_data, function(response) {
				basket_extra_fields_list.html(response);
			});
		});

			var duplicated = document.getElementById('icl_duplicate_post_in_basket'),
				button = $('.button-primary'),
				nonce = document.getElementById('icl_disconnect_nonce');
			if (duplicated !== null) {
				$('<div />', {
					id: 'icl_disconnect_message',
					text: tm_basket_data.tmi_message,
					class: 'icl-admin-message-warning'
				}).insertBefore('.button-primary');
				button.on('click', function () {
					$.ajax({
						method: "POST",
						url: ajaxurl,
						data: {
							action: 'icl_disconnect_posts',
							nonce: nonce.value,
							posts: duplicated.value
						}
					}).success(function (resp) {
						if (resp.success !== true) {
							alert(resp.data);
						}
					});
				});
			}
		}
	);
}(jQuery));
