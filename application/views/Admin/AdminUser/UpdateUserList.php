<?php 
	$this->load->helper('url');
?>
<?php
	$lastestUser = $data->content->addingUser;
	$id = $lastestUser->Id;
	$name = $lastestUser->Name;
	$email = $lastestUser->Email;
	$createDate = $lastestUser->CreateDate;
?>
<tr id = "<?php echo $id;?>" class="<?php echo $id % 2 == 0 ? 'odd' : 'event';?>">
	<td class=" sorting_1" align="center"><?php echo $id;?></td>
	<td id = "<?php echo "name-".$id;?>" class=""><?php echo $name;?></td>
	<td class=" "><?php echo $email;?></td>
	<td class=" "><?php echo $createDate;?></td>
	<td align = "center" ><div href="Javascript:void(0)" class = "changePasswordButtons" onclick="ChangePassword('<?php echo site_url(array('AdminUser','ChangePassword', $id)); ?>');" class="btn btn-primary"><i class="fa  fa-lock fa-2x "></i></button></td>
	<td align = "center" ><div href="Javascript:void(0)" onclick = "EditUserPopup('<?php echo site_url(array('AdminUser','EditUser', $id)); ?>')" class="btn btn-primary btn-sm"><i class="fa fa-x fa-pencil-square-o"></i></div></td>
	<td align = "center" ><a href="Javascript:void(0)" onclick = "DeleteUser('<?php echo site_url(array('AdminUser','DeleteUser', $id)); ?>', <?php echo $id; ?>)" class="btn btn-primary btn-danger btn-sm"><i class="glyphicon fa-x glyphicon-trash"></i></a></td>
</tr>