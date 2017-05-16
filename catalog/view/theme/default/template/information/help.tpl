<?php echo $header; ?>

<div id="main">
    <div class="image-top" style="background-image: url('/image/<?php echo $banners[0]['image']; ?>');">
        <div class="image-holder">
            <ul class="breadcrumbs">
                <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
                    <li><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a> <?php } else { ?><span><?php echo $breadcrumb['text']; ?></span><?php } ?></li>
                <?php } ?>
            </ul>
            <span class="title-text"><?php echo $heading_title; ?></span>
        </div>
    </div>
    <?php echo $content_top; ?>
</div>

<?php echo $footer; ?>