<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">     
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">   
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $product_build; ?></h3>
      </div>
      <div class="panel-body" style="padding:0;">
		<iframe width="100%" height="750px"  style="border:0;" id="tshirtecommerce-build" src="<?php echo $url; ?>"></iframe>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function setHeightF(height){
	document.getElementById('tshirtecommerce-build').setAttribute('height', height + 'px');
}
</script>
<?php echo $footer; ?>