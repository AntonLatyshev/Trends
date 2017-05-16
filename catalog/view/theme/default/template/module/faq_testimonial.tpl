<div class="faq-blog">
    <?php if($success) { ?>
        <p><?php echo $text_success;?></p>
    <?php }?>
    <?php if ($faqs) { ?>
        <div class="content-faq">
            <ul>
                <?php foreach ($faqs as $faq) { ?>
                <li class="question">
                    <span><?php echo $faq['title']; ?></span>
                    <div class="answer">
                        <p><?php echo $faq['description']; ?></p>
                    </div>
                </li>
                <?php } ?>
            </ul>
<!--            <span class="see-more"><a href="#">--><?php //echo $button_more; ?><!--</a></span>-->
        </div>
    <?php } ?>
    <div class="sidebar-faq">
        <span class="sidebar-title"><?php echo $text_form_title;?></span>
        <form class="form-faq" action="<?php echo $action;?>" method="post" enctype="multipart/form-data">
            <input type="text" name="author_name" value="<?php echo $author_name;?>" placeholder="<?php echo $entry_author_name;?>*">
            <?php if($error_author_name) { ?>
                <label class="error"><?php echo $error_author_name;?></label>
            <?php }?>

            <input type="text" name="author_mail" value="<?php echo $author_mail;?>" placeholder="<?php echo $entry_author_mail;?>*">
            <?php if($error_author_email) { ?>
                <label class="error"><?php echo $error_author_email;?></label>
            <?php }?>

            <input type="text" name="title" value="<?php echo $title;?>" placeholder="<?php echo $entry_faq;?>*">
            <?php if($error_title) { ?>
                <label class="error"><?php echo $error_title;?></label>
            <?php }?>
            
            <button type="submit" class="submit-form"><?php echo $entry_submit; ?></button>
        </form>
    </div>
</div>
