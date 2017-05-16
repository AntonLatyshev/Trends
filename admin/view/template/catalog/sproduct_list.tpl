<?php echo $header; ?><?php echo $column_left; ?>
    <div id="content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                    <button type="button" data-toggle="tooltip" title="<?php echo $button_copy; ?>" class="btn btn-default" onclick="$('#form-sproduct').attr('action', '<?php echo $copy; ?>').submit()"><i class="fa fa-copy"></i></button>
                    <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-sproduct').submit() : false;"><i class="fa fa-trash-o"></i></button>
                </div>
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
            <?php if ($success) { ?>
                <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
                </div>
                <div class="panel-body">
                    <div class="well hidden">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                                    <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-model"><?php echo $entry_model; ?></label>
                                    <input type="text" name="filter_model" value="<?php echo $filter_model; ?>" placeholder="<?php echo $entry_model; ?>" id="input-model" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-price"><?php echo $entry_price; ?></label>
                                    <input type="text" name="filter_price" value="<?php echo $filter_price; ?>" placeholder="<?php echo $entry_price; ?>" id="input-price" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-quantity"><?php echo $entry_quantity; ?></label>
                                    <input type="text" name="filter_quantity" value="<?php echo $filter_quantity; ?>" placeholder="<?php echo $entry_quantity; ?>" id="input-quantity" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
                                    <select name="filter_status" id="input-status" class="form-control">
                                        <option value="*"></option>
                                        <?php if ($filter_status) { ?>
                                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                        <?php } else { ?>
                                            <option value="1"><?php echo $text_enabled; ?></option>
                                        <?php } ?>
                                        <?php if (!$filter_status && !is_null($filter_status)) { ?>
                                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                        <?php } else { ?>
                                            <option value="0"><?php echo $text_disabled; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-service">Категории</label>
                                    <input type="text" data-cat-id="2" name="filter_service" value="<?php  echo $sproduct_services[0]['name']; ?>" placeholder="Категории" id="input-service" class="form-control" />
                                    <input type="hidden" name="filter_service_id" value="<?php echo $filter_service_id; ?>" />
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                            </div>
                        </div>
                    </div>
                    <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-sproduct">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                    <td class="text-center"><?php echo $column_image; ?></td>
                                    <td class="text-left"><?php if ($sort == 'pd.name') { ?>
                                            <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                                        <?php } else { ?>
                                            <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                                        <?php } ?></td>
                                    <td class="text-left"><?php if ($sort == 'p.status') { ?>
                                            <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                                        <?php } else { ?>
                                            <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                                        <?php } ?></td>
                                    <td class="text-right"><?php echo $column_action; ?></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($sproducts) { ?>
                                    <?php foreach ($sproducts as $sproduct) { ?>
                                        <tr>
                                            <td class="text-center"><?php if (in_array($sproduct['sproduct_id'], $selected)) { ?>
                                                    <input type="checkbox" name="selected[]" value="<?php echo $sproduct['sproduct_id']; ?>" checked="checked" />
                                                <?php } else { ?>
                                                    <input type="checkbox" name="selected[]" value="<?php echo $sproduct['sproduct_id']; ?>" />
                                                <?php } ?>
                                                <a class="eye_link" style="cursor: pointer;" onclick="window.open('/index.php?route=sproduct/sproduct&sproduct_id=<?php echo $sproduct['sproduct_id'];?>','_blank');"><i class="fa fa-eye"></i></a>
                                            </td>
                                            <td class="text-center"><?php if ($sproduct['image']) { ?>
                                                    <img src="<?php echo $sproduct['image']; ?>" alt="<?php echo $sproduct['name']; ?>" class="img-thumbnail" />
                                                <?php } else { ?>
                                                    <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
                                                <?php } ?></td>
                                            <td class="text-left"><?php echo $sproduct['name']; ?></td>
                                            <td>
                                                <div class="form-group toggle-sproduct-status-change-on" sproduct-id="<?php print $sproduct['sproduct_id']; ?>" field-name="sproduct_on">
                                                    <div class="col-sm-10">
                                                        <select name="status" id="input-status-1" class="form-control">
                                                            <?php if ($sproduct['status'] == "Включено") { ?>
                                                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                            <?php } else { ?>
                                                                <option value="1"><?php echo $text_enabled; ?></option>
                                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right"><a href="<?php echo $sproduct['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript"><!--
            $('#button-filter').on('click', function() {
                var url = 'index.php?route=catalog/sproduct&token=<?php echo $token; ?>';

                var filter_name = $('input[name=\'filter_name\']').val();

                if (filter_name) {
                    url += '&filter_name=' + encodeURIComponent(filter_name);
                }

                var filter_model = $('input[name=\'filter_model\']').val();

                if (filter_model) {
                    url += '&filter_model=' + encodeURIComponent(filter_model);
                }

                var filter_price = $('input[name=\'filter_price\']').val();

                if (filter_price) {
                    url += '&filter_price=' + encodeURIComponent(filter_price);
                }

                var filter_service_id = $('input[name=\'filter_service_id\']').val();

                if (filter_service_id) {
                    url += '&filter_service_id=' + encodeURIComponent(filter_service_id);
                }

                var filter_quantity = $('input[name=\'filter_quantity\']').val();

                if (filter_quantity) {
                    url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
                }

                var filter_status = $('select[name=\'filter_status\']').val();

                if (filter_status != '*') {
                    url += '&filter_status=' + encodeURIComponent(filter_status);
                }

                location = url;
            });
            //--></script>


        <script>
            $(document).on('blur', '.toggle-sproduct-status', function(){
                var data = {
                    pk: parseInt($(this).attr('sproduct-id')),
                    value: parseInt($(this).val()),
                    name: $(this).attr('field-name')
                };
                $.ajax({
                    url: 'index.php?route=catalog/sproduct/fastUpdate&token=<?php echo $token; ?>',
                    type: 'post',
                    data: data,
                    success: function(response) {
                        // Pnotify here
                    },
                    error: function(e1, e2){
                        console.log(e1);
                        console.log(e2);
                    }
                });
            });
        </script>
        <script>
            $(document).on('blur', '.toggle-sproduct-status-percent', function(){
                var data = {
                    pk: parseInt($(this).attr('sproduct-id')),
                    value: parseInt($(this).val()),
                    name: $(this).attr('field-name')
                };
                $.ajax({
                    url: 'index.php?route=catalog/sproduct/fastUpdate&token=<?php echo $token; ?>',
                    type: 'post',
                    data: data,
                    success: function() {
                        $.ajax({
                            url: 'index.php?route=catalog/sproduct/editProductSpecial&token=<?php echo $token; ?>',
                            type: 'post',
                            data: data,
                            success: function(answer){
                                $('#spc_input'+data.pk).val(answer);
                            }
                        })
                    },
                    error: function(e1, e2){
                        console.log(e1);
                        console.log(e2);
                    }
                });
            });
        </script>

        <script>
            $(document).on('change', '.toggle-sproduct-status-change', function(){
                var data = {
                    pk: parseInt($(this).attr('sproduct-id')),
                    value: parseInt($(this).children().children('#input-stock-status').val()),
                    name: $(this).attr('field-name')
                };
                $.ajax({
                    url: 'index.php?route=catalog/sproduct/fastUpdate&token=<?php echo $token; ?>',
                    type: 'post',
                    data: data,
                    success: function(response) {
                        // Pnotify here
                    },
                    error: function(e1, e2){
                        console.log(e1);
                        console.log(e2);
                    }
                });
            });
        </script>
        <script>
            $(document).on('change', '.toggle-sproduct-status-change-on', function(){
                var data = {
                    pk: parseInt($(this).attr('sproduct-id')),
                    value: parseInt($(this).children().children('#input-status-1').val()),
                    name: $(this).attr('field-name')
                };
                $.ajax({
                    url: 'index.php?route=catalog/sproduct/fastUpdate&token=<?php echo $token; ?>',
                    type: 'post',
                    data: data,
                    success: function(response) {
                        // Pnotify here
                    },
                    error: function(e1, e2){
                        console.log(e1);
                        console.log(e2);
                    }
                });
            });
        </script>
        <script>
            $(document).on('change', '.toggle-sproduct-lable-change', function(){
                var data = {
                    pk: parseInt($(this).attr('sproduct-id')),
                    value: parseInt($('option:selected', this).val()),
                    name: $(this).attr('field-name')
                };
                $.ajax({
                    url: 'index.php?route=catalog/sproduct/fastUpdate&token=<?php echo $token; ?>',
                    type: 'post',
                    data: data,
                    success: function(response) {
                        // Pnotify here
                    },
                    error: function(e1, e2){
                        console.log(e1);
                        console.log(e2);
                    }
                });
            });
        </script>

        <script type="text/javascript"><!--
            $('input[name=\'filter_name\']').autocomplete({
                'source': function(request, response) {
                    $.ajax({
                        url: 'index.php?route=catalog/sproduct/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                        dataType: 'json',
                        success: function(json) {
                            response($.map(json, function(item) {
                                return {
                                    label: item['name'],
                                    value: item['sproduct_id']
                                }
                            }));
                        }
                    });
                },
                'select': function(item) {
                    $('input[name=\'filter_name\']').val(item['label']);
                }
            });

            $('input[name=\'filter_service\']').autocomplete({
                'source': function(request, response) {
                    $.ajax({
                        url: 'index.php?route=catalog/sproduct/autocomplete_services&token=<?php echo $token; ?>&filter_service=' +  encodeURIComponent(request),
                        dataType: 'json',
                        success: function(json) {
                            json.unshift({
                                manufacturer_id: 0,
                                name: 'Ничего не выбрано'
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
                    $('input[name=\'filter_service\']').val(item['label']);
                    $('input[name=\'filter_service_id\']').val(item['value']);
//              $('input[name=\'filter_service\']').attr('data-cat-id',item['value']);
                }
            });

            $('input[name=\'filter_model\']').autocomplete({
                'source': function(request, response) {
                    $.ajax({
                        url: 'index.php?route=catalog/sproduct/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request),
                        dataType: 'json',
                        success: function(json) {
                            response($.map(json, function(item) {
                                return {
                                    label: item['model'],
                                    value: item['sproduct_id']
                                }
                            }));
                        }
                    });
                },
                'select': function(item) {
                    $('input[name=\'filter_model\']').val(item['label']);
                }
            });
            //--></script></div>
<?php echo $footer; ?>