<?php 
	$this->load->helper('url');
?>
<?php
	$newCate = $data->content->addingCategory;
	$id = $newCate->Id;
	$parentId = $newCate->ParentId;
	$name = $newCate->Name;
	$order = $newCate->Order;
	$parentCate = $data->content->parentOfAddingCategory;
	$grandParentId = $parentCate->ParentId;
	$parentOrder = $parentCate->Order;
	$listBrothers = $data->content->listBrothers;
	$listBrothersLength = count($listBrothers);
?>
<h1><?php echo $id;?></h1>
<h1><?php echo $parentId;?></h1>
<h1><?php echo $order;?></h1>
<h1><?php echo $grandParentId; ?></h1>
<h1><?php echo $parentOrder; ?></h1>
<h1><?php echo $listBrothersLength; ?></h1>
<tr id = "<?php echo $parentId."-".$order;?>" class="<?php echo $id % 2 == 0 ? 'odd' : 'event';?>">
	<td id = "<?php echo "stt-".$parentId."-"."$order";?>" class=" sorting_1" align="center"><?php echo $id;?></td>
	<td id = "<?php echo "name-".$id;?>" class=""><?php echo $name;?></td>
	<td class=" "><?php echo $order;?></td>
	<td align = "center" ><div href="Javascript:void(0)" class="btn btn-primary btn-sm"><i class="fa fa-x fa-pencil-square-o"></i></div></td>
	<td align = "center" ><a href="Javascript:void(0)"	class="btn btn-primary btn-sm btn-danger"><i class="glyphicon fa-x glyphicon-trash"></i></a></td>
</tr>