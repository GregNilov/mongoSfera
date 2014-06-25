<?php

    require_once('loader.php');
    //require_once('add_new_blog.php');
	//require_once('edit_blog.php');
	//require_once('remove_blog.php');
echo 'blogs --'.$collection.<br>';

/*
if (!isset($_SESSION["loggedIn"])) {
    header("Location: login.php");
    error_reporting(E_ALL);
    exit;
}


    if($_SESSION["login"]=="admin"){
        $resBlogs = getAllBlogs();
        $admin=true;
    }
   else{
       $resBlogs=getAllBlogsByUserID(getIdUsersByLogin($_SESSION["login"]));
       $admin=false;
   };

    if ($resBlogs != false)
        $NumOfBlogs = mysql_num_rows($resBlogs);
    else
        $NumOfBlogs = 0;
		/*
		$json = json_decode(file_get_contents('blog_data.json'), true);
		echo json_last_error();
		echo "title4 -- ".$json['blogs'][1]['title'];*/
		
		*/
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                <?php
				    $isEditMode = $_GET["editMode"];
					$blogId = $_GET["blogId"];
					 if (isset($isEditMode) && isset($blogId)) {
						echo "showEditForm(true); $('#isUpdate').val(true);";
						echo "$('#btnSave').val('Update blog');";
						echo "$('#headerTitle').text('Edit');";
						showEditData($blogId);
					 }
				?>
            });
            function addNewBlog(){
				var isUpdate = $('#isUpdate').val();
				var id = $('#blogID').val();
				var actionUrl = "";
			    if(!isUpdate){
					actionUrl = "add_new_blog.php"  ;
				}else{
					actionUrl = "add_new_blog.php?editMode=true&blogId="+id;
				}

				var data = $('form#addForm').serialize();
				$('form#addForm').unbind('submit');
				$.ajax({
					url: actionUrl,
					type: 'GET',
					data: data,
					beforeSend: function() {

					},
					success: function(data, textStatus, xhr) {
						//cleanForm();
						//alert(xhr.responseText);
						window.location.href = "index.php";
					},
					error: function(xhr, textStatus, errorThrown) {
						//cleanForm();
						//alert(xhr.responseText);
						window.location.href = "index.php";
					}
				});

                return false;
            }

			function cleanForm(){
				$('.blog_url').val("");
				$('.blog_title').val("");
				$('.blog_description').val("");
				$('.blog_image').val("");
				$('.blog_author_email').val("");
				$('.justclick_user_id').val("");
				$('.justclick_user_key').val("");
				$('.justclick_user_group').val("");
				$('.smartresponder_api_id').val("");
				$('.smartresponder_delivery_id').val("");
			}

			function showEditForm(showForm){
				if(showForm){
					document.getElementById('editBlog').style.display = '';
					document.getElementById('addLink').style.display = 'none';
					document.getElementById('hideLink').style.display = '';
				}else{
					document.getElementById('editBlog').style.display = 'none';
					document.getElementById('addLink').style.display = '';
					document.getElementById('hideLink').style.display = 'none';
				}
			}

			function editBlog(id){
				window.location.href = "index.php?editMode=true&blogId="+id;
			}

			function removeBlog(id){
							var xhr;
				if (window.XMLHttpRequest) xhr = new XMLHttpRequest(); // all browsers
				else xhr = new ActiveXObject("Microsoft.XMLHTTP");     // for IE

				var url = 'remove_blog.php?blogId=' + id;
				xhr.open('GET', url, false);
				xhr.onreadystatechange = function () {
					if (xhr.readyState===4 && xhr.status===200) {
						window.location.href = "index.php";
					}
				}
				xhr.send();
				// ajax stop
				return false;
			}
        </script>
        <style type="text/css">

            h1{
                font-family:Helvetica, Arial, sans-serif;
                font-size: 24px;
                color: #777;
            }
            div.clear{
                clear: both;
            }

            textarea{
                float: left;
                resize: none;
            }

			div.edit{
				border:1px solid #CCC;
				background-color:#f4f4f4;
				width: 900px;
				padding-left:10px;
			}

			div.edit input{
				width: 300px;
			}

        </style>
    </head>
    <body style="padding-left:10px;">
		<h1>Sfera Project Backend</h1>
		<hr/>

		<div id="editContainer"></div>
        <div style="float: right"><?php print("<a href=\"logout.php"."\">(<b>".$_SESSION["login"]."</b>) Выход </a>"); ?></div>
        <div style="float: right; padding-right: 30px"><?php if($admin==true) print("<a href=\"pass.php"."\"> Управление паролями </a>"); ?></div>
         <div class="edit" id="editBlog" style="display:none;">
			<h1><span id="headerTitle">Add new</span> blog</h1>


              <hr/>
                    <form id="addForm" name="" method="post" onSubmit="return addNewBlog()">
						<input type="hidden" id="isUpdate" name="isUpdate" value=""/>
						<input type="hidden" id="blogID" name="blogID" value=""/>
                        <? if ($admin==false){?>
                        <input   type="hidden" id="userID" name="userID" value="<?  print(getIdUsersByLogin($_SESSION["login"]));?>"/>
						<?}else{?>
                            <td width="190"><label><b>User ID</b></label></td>
                        <input    id="userID" name="userID" value="" class="user_id"/>
                        <?}?>
                        <table>
							<tr>
							    <td width="190"><label><b>Blog URL</b></label></td>
								<td><input type="input" name="blogUrl" value="" class="blog_url"/></td>
							</tr>
							<tr>
							    <td width="190"><label><b>Title</b></label></td>
								<td><input type="input" name="blogTitle" value="" class="blog_title"/></td>
							</tr>
							<tr>
							    <td width="190"><label><b>Description</b></label></td>
								<td><input type="input" name="blogDescription" value="" class="blog_description"/></td>
							</tr>
							<tr>
							    <td width="190"><label><b>Image</b></label></td>
								<td><input type="input" name="blogImage" value="" class="blog_image"/></td>
							</tr>
							<tr>
							    <td width="190"><label><b>Author email</b></label></td>
								<td><input type="input" name="blogAuthorEmail" value="" class="blog_author_email"/></td>
							</tr>
							<tr>
							    <td width="190"><label><b>Justclick user id</b></label></td>
								<td><input type="input" name="justclickUserID" value="" class="justclick_user_id"/></td>
							</tr>
							<tr>
							    <td width="190"><label><b>Justclick user key</b></label></td>
								<td><input type="input" name="justclickUserKey" value="" class="justclick_user_key"/></td>
							</tr>
							<tr>
							    <td width="190"><label><b>Justclick user group</b></label></td>
								<td><input type="input" name="justclickUserGroup" value="" class="justclick_user_group"/></td>
							</tr>
							<tr>
							    <td width="190"><label><b>Smartresponder API ID</b></label></td>
								<td><input type="input" name="smartresponderApiID" value="" class="smartresponder_api_id"/></td>
							</tr>
							<tr>
							    <td width="190"><label><b>Smartresponder delivery ID</b></label></td>
								<td><input type="input" name="smartresponderDeliveryID" value="" class="smartresponder_delivery_id"/></td>
							</tr>
							<tr></br>
								<td width="190"></td>
							    <td> <input id="btnSave" type="submit" value="Save blog" onClick="" style="float:right;width:100px;"/></td>
							</tr>
						</table>
                    </form>
					</div>
					<div id="addLink" style="padding-left:10px;"><a href="javascript:showEditForm(true);" >Add new blog</a></div>
					<div id="hideLink" style="display:none;padding-left:10px;"><a href="javascript:showEditForm(false);" >Hide edit form</a></div>
        <table  width="100%" cellpadding="1" cellspacing="1">
         <tr>
           <td align="left" style="padding-left:10px;">
              <h1>Number of existed blogs: <?php echo $NumOfBlogs; ?></h1>
              <hr/>
           </td>
          </tr>
          <tr>
            <td align="center">
              <table width="100%" cellpadding="2"
                        cellspacing="2"
                        style="border:1px solid #CCC;" >
							<tr bgcolor="#f4f4f4">
								<th width="50"><label><b>Image</b></label></th>
								<th width="80"><label><b>Title</b></label></th>
								<th width="100"><label><b>Description</b></label></th>
								<th width="100"><label><b>Blog URL</b></label></th>
								<!--<th width="100"><label><b>Author email</b></label></th>
								<th width="80"><label><b>Justclick user id</b></label></th>
								<th width="200"><label><b>Justclick user key</b></label></th>
								<th width="80"><label><b>Justclick user group</b></label></th>
								<th width="80"><label><b>Smartresponder API ID</b></label></th>
								<th width="80"><label><b>Smartresponder delivery ID</b></label></th>-->
								<th width="80"><label><b>UserID</b></label></th>
								<th width="30"><label><b>Edit</b></label></th>
								<th width="30"><label><b>Remove</b></label></th>
							</tr>
							<?php
							while($row = mysql_fetch_array($resBlogs)) {
								echo "<tr>";
								echo "<td><img style='width:50px;height:50px;' src='".$row['image']."' /></td>";
								echo "<td>".$row['title']."</td>";
								echo "<td>".$row['description']."</td>";
								//echo "<td>".$row['link']."</td>";
								echo "<td><a href='".$row['link']."'>".$row['link']."</a></td>";
								/*echo "<td>".$row['author_email']."</td>";
								echo "<td>".$row['justclick_user_id']."</td>";
								echo "<td>".$row['justclick_user_key']."</td>";
								echo "<td>".$row['justclick_user_group']."</td>";
								echo "<td>".$row['smartresponder_api_id']."</td>";
								echo "<td>".$row['smartresponder_delivery_id']."</td>";*/
								echo "<td>".$row['user_id']."</td>";
								echo "<td><a href='javascript:editBlog(".$row['id'].");' >Edit</a></td>";
								echo "<td><a href='javascript:removeBlog(".$row['id'].");' >Remove</a></td>";
								echo "</tr>";
								}
							?>
                </table>
            </td>
          </tr>
        </table>


    </body>
</html>