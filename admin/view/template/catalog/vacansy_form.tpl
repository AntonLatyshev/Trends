<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-vacansy" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-vacansy" class="form-horizontal">
          <div class="tab-content">
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
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">

                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-city<?php echo $language['language_id']; ?>">Город</label>
                    <div class="col-sm-10">
                      <input type="text" name="vacansy_description[<?php echo $language['language_id']; ?>][vac_city]" value="<?php echo isset($vacansy_description[$language['language_id']]) ? $vacansy_description[$language['language_id']]['vac_city'] : ''; ?>" placeholder="Город" id="input-city<?php echo $language['language_id']; ?>" list="city_list<?php echo $language['language_id']; ?>" class="form-control" />
                      <datalist id="city_list<?php echo $language['language_id']; ?>">
                        <?php foreach ($vacansy_cities[$language['language_id']] as $vacansy_city) { ?>
                          <option value="<?php echo $vacansy_city; ?>"><?php echo $vacansy_city; ?></option>
                        <?php } ?>
                      </datalist>
                      <?php if (isset($error_city[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_city[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="vacansy_description[<?php echo $language['language_id']; ?>][vac_name]" value="<?php echo isset($vacansy_description[$language['language_id']]) ? $vacansy_description[$language['language_id']]['vac_name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_name[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="vacansy_description[<?php echo $language['language_id']; ?>][vac_requirements]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($vacansy_description[$language['language_id']]) ? $vacansy_description[$language['language_id']]['vac_requirements'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group hidden">
                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description2; ?></label>
                    <div class="col-sm-10">
                      <textarea name="vacansy_description[<?php echo $language['language_id']; ?>][vac_conditions]" placeholder="<?php echo $entry_description; ?>" id="input-description2<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($vacansy_description[$language['language_id']]) ? $vacansy_description[$language['language_id']]['vac_conditions'] : ''; ?></textarea>
                    </div>
                  </div>					
                  <div class="form-group hidden">
                    <label class="col-sm-2 control-label" for="input-description-short<?php echo $language['language_id']; ?>"><?php echo $entry_description_short; ?></label>
                    <div class="col-sm-10">
                      <textarea name="vacansy_description[<?php echo $language['language_id']; ?>][vac_schort_text]" placeholder="<?php echo $entry_description_short; ?>" id="input-description-short<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($vacansy_description[$language['language_id']]) ? $vacansy_description[$language['language_id']]['vac_schort_text'] : ''; ?></textarea>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#input-description<?php echo $language['language_id']; ?>').summernote({ height: 250 });
$('#input-description2<?php echo $language['language_id']; ?>').summernote({ height: 250 });
$('#input-description-short<?php echo $language['language_id']; ?>').summernote({ height: 250 });
    <?php if ( !empty($custom_fields) && !empty($custom_fields[$language['language_id']]) ) { ?>
    <?php foreach ( $custom_fields[$language['language_id']] as $custom_field ) { ?>
    $('#textarea-custom-field-<?php echo $language['language_id']; ?>-<?php echo $custom_field['id']; ?>').summernote({ height: 200 });
    <?php } ?>
    <?php } ?>
<?php } ?>
//--></script>
  
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script>
</div>
<?php echo $footer; ?>