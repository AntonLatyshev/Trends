<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-review" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
          <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-review" data-toggle="tab">Отзыв</a></li>
                <li><a href="#tab-answers" data-toggle="tab">Ответы к отзыву</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-review">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-review" class="form-horizontal">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-author"><?php echo $entry_author; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="author" value="<?php echo $author; ?>" placeholder="<?php echo $entry_author; ?>" id="input-author" class="form-control" />
                      <?php if ($error_author) { ?>
                      <div class="text-danger"><?php echo $error_author; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-email">Email</label>
                      <div class="col-sm-10">
                        <input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email" id="input-email" class="form-control" />
                      </div>
                  </div> 
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-product"><span data-toggle="tooltip" title="<?php echo $help_product; ?>"><?php echo $entry_product; ?></span></label>
                    <div class="col-sm-10">
                      <input type="text" name="product" value="<?php echo $product; ?>" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
                      <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                      <?php if ($error_product) { ?>
                      <div class="text-danger"><?php echo $error_product; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-text"><?php echo $entry_text; ?></label>
                    <div class="col-sm-10">
                      <textarea name="text" cols="60" rows="8" placeholder="<?php echo $entry_text; ?>" id="input-text" class="form-control"><?php echo $text; ?></textarea>
                      <?php if ($error_text) { ?>
                      <span class="text-danger">
                      <?php echo $error_text; ?></span>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_rating; ?></label>
                    <div class="col-sm-10">
                      <label class="radio-inline">
                        <?php if ($rating == 1) { ?>
                        <input type="radio" name="rating" value="1" checked="checked" />
                        1
                        <?php } else { ?>
                        <input type="radio" name="rating" value="1" />
                        1
                        <?php } ?>
                      </label>
                      <label class="radio-inline">
                        <?php if ($rating == 2) { ?>
                        <input type="radio" name="rating" value="2" checked="checked" />
                        2
                        <?php } else { ?>
                        <input type="radio" name="rating" value="2" />
                        2
                        <?php } ?>
                      </label>
                      <label class="radio-inline">
                        <?php if ($rating == 3) { ?>
                        <input type="radio" name="rating" value="3" checked="checked" />
                        3
                        <?php } else { ?>
                        <input type="radio" name="rating" value="3" />
                        3
                        <?php } ?>
                      </label>
                      <label class="radio-inline">
                        <?php if ($rating == 4) { ?>
                        <input type="radio" name="rating" value="4" checked="checked" />
                        4
                        <?php } else { ?>
                        <input type="radio" name="rating" value="4" />
                        4
                        <?php } ?>
                      </label>
                      <label class="radio-inline">
                        <?php if ($rating == 5) { ?>
                        <input type="radio" name="rating" value="5" checked="checked" />
                        5
                        <?php } else { ?>
                        <input type="radio" name="rating" value="5" />
                        5
                        <?php } ?>
                      </label>
                      <?php if ($error_rating) { ?>
                      <div class="text-danger"><?php echo $error_rating; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-like">Like</label>
                        <div class="col-sm-1">
                           <input type="text" name="like" value="<?php echo $like; ?>" placeholder="Количество like" id="input-like" class="form-control" />
                        </div>
                  </div>
                  <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-dislike">Dislike</label>
                        <div class="col-sm-1">
                           <input type="text" name="dislike" value="<?php echo $dislike; ?>" placeholder="Количество dislike" id="input-dislike" class="form-control" />
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
                </form>
            </div>
            <div class="tab-pane" id="tab-answers">
                <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                          <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-answers').submit() : false;"><i class="fa fa-trash-o"></i></button>
                      </div>
                      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-answers">
                        <div class="table-responsive">
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                <td class="text-left"><?php echo $column_author; ?></td>
                                <td class="text-left"><?php echo $column_status; ?></td>
                                <td class="text-left"><?php echo $column_date_added; ?></td>
                                <td class="text-right"><?php echo $column_action; ?></td>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if ($reviews) { ?>
                              <?php foreach ($reviews as $review) { ?>
                              <tr>
                                <td class="text-center"><?php if (in_array($review['answer_id'], $selected)) { ?>
                                  <input type="checkbox" name="selected[]" value="<?php echo $review['answer_id']; ?>" checked="checked" />
                                  <?php } else { ?>
                                  <input type="checkbox" name="selected[]" value="<?php echo $review['answer_id']; ?>" />
                                  <?php } ?></td>
                                <td class="text-left"><?php echo $review['author']; ?></td>
                                <td class="text-left"><?php echo $review['status']; ?></td>
                                <td class="text-left"><?php echo $review['date_added']; ?></td>
                                <td class="text-right"><a href="<?php echo $review['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                              </tr>
                              <?php } ?>
                              <?php } else { ?>
                              <tr>
                                <td class="text-center" colspan="7"><?php echo $text_no_results; ?></td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </form>
                    </div>
                </div>
            </div>   
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'product\']').val(item['label']);
		$('input[name=\'product_id\']').val(item['value']);		
	}	
});
//--></script></div>
<?php echo $footer; ?>