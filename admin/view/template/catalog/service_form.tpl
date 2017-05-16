<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-service" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-service" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
            <li><a href="#tab-design" data-toggle="tab"><?php echo $tab_design; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active in" id="tab-general">
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="service_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($service_description[$language['language_id']]) ? $service_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_name[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="service_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($service_description[$language['language_id']]) ? $service_description[$language['language_id']]['description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description-short<?php echo $language['language_id']; ?>"><?php echo $entry_description_short; ?></label>
                    <div class="col-sm-10">
                      <textarea name="service_description[<?php echo $language['language_id']; ?>][description_short]" placeholder="<?php echo $entry_description_short; ?>" id="input-description-short<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($service_description[$language['language_id']]) ? $service_description[$language['language_id']]['description_short'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-meta-title<?php echo $language['language_id']; ?>"><?php echo $entry_meta_title; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="service_description[<?php echo $language['language_id']; ?>][meta_title]" value="<?php echo isset($service_description[$language['language_id']]) ? $service_description[$language['language_id']]['meta_title'] : ''; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_meta_title[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_meta_title[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description<?php echo $language['language_id']; ?>"><?php echo $entry_meta_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="service_description[<?php echo $language['language_id']; ?>][meta_description]" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($service_description[$language['language_id']]) ? $service_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword<?php echo $language['language_id']; ?>"><?php echo $entry_meta_keyword; ?></label>
                    <div class="col-sm-10">
                      <textarea name="service_description[<?php echo $language['language_id']; ?>][meta_keyword]" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($service_description[$language['language_id']]) ? $service_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea>
                    </div>
                  </div>
                  <hr>
                  <div class="page-header clearfix">
                    <div class="pull-right">
                      <button type="button" id="add-custom-fields-<?php echo $language['language_id']; ?>" data-count="<?php echo isset($custom_fields[$language['language_id']]) ? count($custom_fields[$language['language_id']]) : '0'; ?>" data-language="<?php echo $language['language_id']; ?>" data-toggle="tooltip" title="Добавить новое поле" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div>
                    <h2 class="text-left">Custom Field's <i class="fa fa-comment" style="color: red;" data-toggle="tooltip" title="Добавил новове поле, заполнил навание и выбрал тип, пересохранил. Потом уже появиться поле 'Значение'"></i></h2>
                  </div>
                  <?php $i = 1; if ( !empty($custom_fields) && !empty($custom_fields[$language['language_id']]) ) { foreach ( $custom_fields[$language['language_id']] as $custom_field ) { ?>
                  <div id="custom-field-item-<?php echo $language['language_id']; ?>-<?php echo $custom_field['id']; ?>">
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="name-custom-field-<?php echo $language['language_id']; ?>-<?php echo $custom_field['id']; ?>">Название/Тип:</label>
                      <div class="col-sm-10">
                        <div class="row">
                          <div class="col-sm-8 col-xs-12">
                            <input type="hidden"
                                   name="custom_field[<?php echo $language['language_id']; ?>][<?php echo $i; ?>][id]"
                                   value="<?php echo $custom_field['id']; ?>" />
                            <input type="text"
                                   name="custom_field[<?php echo $language['language_id']; ?>][<?php echo $i; ?>][name]"
                                   value="<?php echo strip_tags(html_entity_decode($custom_field['name'], ENT_QUOTES, 'UTF-8')); ?>"
                                   id="name-custom-field-<?php echo $language['language_id']; ?>-<?php echo $custom_field['id']; ?>"
                                   class="form-control" />
                          </div>
                          <div class="col-sm-3 col-xs-12">
                            <select class="form-control" name="custom_field[<?php echo $language['language_id']; ?>][<?php echo $i; ?>][type]">
                              <option>--Выбирите--</option>
                              <option value="text"<?php if ($custom_field['type'] == 'text' ) { echo ' selected=""'; } ?>>Текст</option>
                              <option value="textarea"<?php if ($custom_field['type'] == 'textarea' ) { echo ' selected=""'; } ?>>Текстовая область</option>
                              <option value="image"<?php if ($custom_field['type'] == 'image' ) { echo ' selected=""'; } ?>>Изображение</option>
                            </select>
                          </div>
                          <div class="col-sm-1 col-xs-12 text-right">
                            <button type="button" id="delete-custom-fields" data-id="<?php echo $custom_field['id']; ?>" data-language="<?php echo $language['language_id']; ?>" data-toggle="tooltip" title="Удалить данную группу" class="btn btn-warning"><i class="fa fa-minus"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php if ($custom_field['type'] == 'text') { ?>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="text-custom-field-<?php echo $language['language_id']; ?>-<?php echo $custom_field['id']; ?>">Значение:</label>
                        <div class="col-sm-10">
                          <input type="text"
                                 name="custom_field[<?php echo $language['language_id']; ?>][<?php echo $i; ?>][value]"
                                 value="<?php echo isset($custom_field['value']) ? strip_tags(html_entity_decode($custom_field['value'], ENT_QUOTES, 'UTF-8')) : ''; ?>"
                                 id="text-custom-field-<?php echo $language['language_id']; ?>-<?php echo $custom_field['id']; ?>"
                                 class="form-control" /></div>
                      </div>
                    <?php } ?>
                    <?php if ($custom_field['type'] == 'textarea') { ?>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="textarea-custom-field-<?php echo $language['language_id']; ?>-<?php echo $custom_field['id']; ?>">Значение:</label>
                        <div class="col-sm-10">
                          <textarea rows="4"
                                    name="custom_field[<?php echo $language['language_id']; ?>][<?php echo $i; ?>][value]"
                                    id="textarea-custom-field-<?php echo $language['language_id']; ?>-<?php echo $custom_field['id']; ?>"
                                    class="form-control"><?php echo isset($custom_field['value']) ? html_entity_decode($custom_field['value'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
                        </div>
                      </div>
                    <?php } ?>
                    <?php if ($custom_field['type'] == 'image') { ?>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="textarea-custom-field-<?php echo $language['language_id']; ?><?php echo $custom_field['id']; ?>">Значение:</label>
                        <div class="col-sm-10">
                          <a href="" id="thumb-image-<?php echo $language['language_id']; ?>-<?php echo $custom_field['id']; ?>" data-toggle="image" class="img-thumbnail">
                            <img src="<?php echo isset($custom_field['value']) ? '/image/'.$custom_field['value'] : 'http://box-shop.lc/image/cache/no_image-100x100.png'; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" width="100" height="100" />
                          </a>
                          <input type="hidden" name="custom_field[<?php echo $language['language_id']; ?>][<?php echo $i; ?>][value]" value="<?php echo isset($custom_field['value']) ? html_entity_decode($custom_field['value'], ENT_QUOTES, 'UTF-8') : ''; ?>" id="input-image-<?php echo $language['language_id']; ?>-<?php echo $custom_field['id']; ?>" />
                        </div>
                      </div>
                    <?php } ?>
                    <hr>
                  </div>
                  <?php $i++; } } ?>
                  <div id="custom-field-<?php echo $language['language_id']; ?>"></div>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="tab-pane fade" id="tab-data">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-parent"><?php echo $entry_parent; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="path" value="<?php echo $path; ?>" placeholder="<?php echo $entry_parent; ?>" id="input-parent" class="form-control" />
                  <input type="hidden" name="parent_id" value="<?php echo $parent_id; ?>" />
                </div>
              </div>
              <div class="form-group hidden">
                <label class="col-sm-2 control-label" for="input-filter"><span data-toggle="tooltip" title="<?php echo $help_filter; ?>"><?php echo $entry_filter; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="filter" value="" placeholder="<?php echo $entry_filter; ?>" id="input-filter" class="form-control" />
                  <div id="service-filter" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($service_filters as $service_filter) { ?>
                    <div id="service-filter<?php echo $service_filter['filter_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $service_filter['name']; ?>
                      <input type="hidden" name="service_filter[]" value="<?php echo $service_filter['filter_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group hidden">
                <label class="col-sm-2 control-label"><?php echo $entry_store; ?></label>
                <div class="col-sm-10">
                  <div class="well well-sm" style="height: 150px; overflow: auto;">
                    <div class="checkbox">
                      <label>
                        <?php if (in_array(0, $service_store)) { ?>
                        <input type="checkbox" name="service_store[]" value="0" checked="checked" />
                        <?php echo $text_default; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="service_store[]" value="0" />
                        <?php echo $text_default; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php foreach ($stores as $store) { ?>
                    <div class="checkbox">
                      <label>
                        <?php if (in_array($store['store_id'], $service_store)) { ?>
                        <input type="checkbox" name="service_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                        <?php echo $store['name']; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="service_store[]" value="<?php echo $store['store_id']; ?>" />
                        <?php echo $store['name']; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-keyword"><span data-toggle="tooltip" title="<?php echo $help_keyword; ?>"><?php echo $entry_keyword; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" id="input-keyword" class="form-control" />
                  <?php if ($error_keyword) { ?>
                  <div class="text-danger"><?php echo $error_keyword; ?></div>
                  <?php } ?>                
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_image; ?></label>
                <div class="col-sm-10">
                  <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail">
                    <img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" />
                  </a>
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Фоновое изображение крошек</label>
                <div class="col-sm-10">
                  <a href="" id="thumb-image-bg" data-toggle="image" class="img-thumbnail">
                    <img src="<?php echo $thumb_bg; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" />
                  </a>
                  <input type="hidden" name="image_bg" value="<?php echo $image_bg; ?>" id="input-image-bg" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-top"><span data-toggle="tooltip" title="<?php echo $help_top; ?>"><?php echo $entry_top; ?></span></label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <label>
                      <?php if ($top) { ?>
                      <input type="checkbox" name="top" value="1" checked="checked" id="input-top" />
                      <?php } else { ?>
                      <input type="checkbox" name="top" value="1" id="input-top" />
                      <?php } ?>
                      &nbsp; </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-bottom">В подвале</label>
                <div class="col-sm-10">
                  <div class="checkbox">
                    <label>
                      <?php if ($bottom) { ?>
                      <input type="checkbox" name="bottom" value="1" checked="checked" id="input-bottom" />
                      <?php } else { ?>
                      <input type="checkbox" name="bottom" value="1" id="input-bottom" />
                      <?php } ?>
                      &nbsp; </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-column"><span data-toggle="tooltip" title="<?php echo $help_column; ?>"><?php echo $entry_column; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="column" value="<?php echo $column; ?>" placeholder="<?php echo $entry_column; ?>" id="input-column" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="sort_order" value="<?php echo $sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="customer_group_id"><?php echo $text_user_group; ?></label>
                <div class="col-sm-10">
                  <select name="customer_group_id" class="form-control">
                    <?php foreach ($customer_groups as $customer_group) { ?>
                      <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
                        <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                      <?php } else { ?>
                        <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-design">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $entry_store; ?></td>
                      <td class="text-left"><?php echo $entry_layout; ?></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-left"><?php echo $text_default; ?></td>
                      <td class="text-left"><select name="service_layout[0]" class="form-control">
                          <option value=""></option>
                          <?php foreach ($layouts as $layout) { ?>
                          <?php if ( isset($service_layout[0]) && $service_layout[0] == $layout['layout_id']) { ?>
                          <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                          <?php } elseif ( $layout['layout_id'] == '3' ) { ?>
                          <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <?php foreach ($stores as $store) { ?>
                    <tr>
                      <td class="text-left"><?php echo $store['name']; ?></td>
                      <td class="text-left"><select name="service_layout[<?php echo $store['store_id']; ?>]" class="form-control">
                          <option value=""></option>
                          <?php foreach ($layouts as $layout) { ?>
                          <?php if (isset($service_layout[$store['store_id']]) && $service_layout[$store['store_id']] == $layout['layout_id']) { ?>
                          <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#input-description<?php echo $language['language_id']; ?>').summernote({ height: 300 });
$('#input-description-short<?php echo $language['language_id']; ?>').summernote({ height: 300 });
    <?php if ( !empty($custom_fields) && !empty($custom_fields[$language['language_id']]) ) { ?>
    <?php foreach ( $custom_fields[$language['language_id']] as $custom_field ) { ?>
    $('#textarea-custom-field-<?php echo $language['language_id']; ?>-<?php echo $custom_field['id']; ?>').summernote({ height: 200 });
    <?php } ?>
    <?php } ?>
<?php } ?>
//--></script>
  <script type="text/javascript"><!--
$('input[name=\'path\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/service/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				json.unshift({
					service_id: 0,
					name: '<?php echo $text_none; ?>'
				});

				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['service_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'path\']').val(item['label']);
		$('input[name=\'parent_id\']').val(item['value']);
	}
});
//--></script> 
  <script type="text/javascript"><!--
$('input[name=\'filter\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/filter/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['filter_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter\']').val('');

		$('#service-filter' + item['value']).remove();

		$('#service-filter').append('<div id="service-filter' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="service_filter[]" value="' + item['value'] + '" /></div>');
	}
});

$('#service-filter').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script> 
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script>

  <script type="text/javascript">
    <?php foreach ($languages as $language) { ?>
    $(document).on('click', '#add-custom-fields-<?php echo $language['language_id']; ?>', function(){
      var count     = $(this).attr('data-count'),
          language  = $(this).attr('data-language');
      addCustomFields(count, language);
    });
    <?php } ?>

    $(document).on('click', '#delete-custom-fields', function(){
      var id        = $(this).attr('data-id'),
          language  = $(this).attr('data-language');
      deleteCustomFields(id, language);
    });

    function addCustomFields(count, language) {
      if(!count) {
        count = 1;
      } else {
        count++;
        <?php foreach ($languages as $language) { ?>
        $('#add-custom-fields-<?php echo $language['language_id']; ?>').attr('data-count', count);
        <?php } ?>
      }

      var html = '';
      html += '<div id="custom-field-item-' + language + '-' + count + '">';
      html += '<div class="form-group">';
      html += '<label class="col-sm-2 control-label" for="name-custom-field-' + language + '-' + count + '">Название/Тип:</label>';
      html += '<div class="col-sm-10">';
      html += '<div class="row">';
      html += '<div class="col-sm-8 col-xs-12">';
      html += '<input type="hidden" name="custom_field[' + language + '][' + count + '][id]" value="' + count + '">';
      html += '<input type="text" name="custom_field[' + language + '][' + count + '][name]" placeholder="Название поля (латиница, через _ . Пример: same_field_1)" id="name-custom-field-' + language + '-' + count + '" class="form-control">';
      html += '</div>';
      html += '<div class="col-sm-4 col-xs-12">';
      html += '<select class="form-control" name="custom_field[' + language + '][' + count + '][type]">';
      html += '<option>--Выбирите--</option>';
      html += '<option value="text">Текст</option>';
      html += '<option value="textarea">Текстовая область</option>';
      html += '<option value="image">Изображение</option>';
      html += '</select>';
      html += '</div>';
      html += '</div>';
      html += '</div>';
      html += '</div>';
      html += '<hr>';
      html += '</div>';

      $('#custom-field-' + language).append(html);

      return true;
    }

    function deleteCustomFields (id, language) {
      $('#custom-field-item-' + language + '-' + id + '').remove();
    }

  </script>
</div>
<?php echo $footer; ?>