<?php
  require_once('libs/simple_html_dom.php');
  
   //Storing new user and returns user details
	function createBlogTable(){
		$sql = "CREATE TABLE IF NOT EXISTS `sfera_blogs` (
	   `id` int(11) unsigned NOT NULL auto_increment,
	   `title` varchar(255) NULL,
	   `image` varchar(255) NULL,
	   `description` varchar(500) NULL,
	   `link` varchar(255) NULL,
	   `author_email` varchar(255) NULL,
	   `justclick_user_id` varchar(255) NULL,
	   `justclick_user_key` varchar(255) NULL,
	   `justclick_user_group` varchar(255) NULL,
	   `smartresponder_api_id` varchar(255) NULL,
	   `smartresponder_delivery_id` varchar(255) NULL,
	    PRIMARY KEY  (`id`)
	   ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	   $result = mysql_query($sql);
	   if($result){
			echo "created successfully";
	   }
	}

	function createArticleTable(){
		$sql = "CREATE TABLE IF NOT EXISTS `sfera_articles` (
	   `id` int(11) unsigned NOT NULL auto_increment,
	   `blogId` int(11) unsigned NULL,
	   `title` varchar(255) NULL,
	   `image` varchar(255) NULL,
	   `description` varchar(500) NULL,
	   `link` varchar(255) NULL,
	   `date` varchar(255) NULL,
	   `text` LONGTEXT NULL,
	    PRIMARY KEY  (`id`)
	   ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	   $result = mysql_query($sql);
	   if($result){
			echo "created successfully";
	   }
	}
	/*	
		  function addVersionColumns() {
        $result = mysql_query("ALTER TABLE gcm_users ADD COLUMN version_app int(11) NOT NULL");
        return $result;
    }*/
    
    function dropTable() {
        $result = mysql_query("DROP TABLE sfera_articles");
        return $result;
    }

    function dropAllArticles() {
        $result = mysql_query("DELETE FROM sfera_articles");
        return $result;
    }
	
   function addArticle($fields) {
		$blogId = mysql_real_escape_string($fields["blogId"]);
		$title = mysql_real_escape_string($fields["title"]);
		$image = mysql_real_escape_string($fields["image"]);
		$description = mysql_real_escape_string($fields["description"]);
		$link = mysql_real_escape_string($fields["link"]);
		$date = mysql_real_escape_string($fields["date"]);
		$text = mysql_real_escape_string($fields["text"]);
			
		//echo "BEFORE INSERT -- ".$date;
			
        // insert user into database
        $result = mysql_query("INSERT INTO sfera_articles (blogId, title, image, description, link, date, text) 
							   VALUES ($blogId, '$title', '$image', '$description', '$link', '$date', '$text')");
    
		//echo "AFTER INSERT -- ";
		
        // check for successful store
        if ($result) {
             
            // get user details
            $id = mysql_insert_id(); // last inserted id
			//echo "ID inserted -- ".$id;
            $result = mysql_query(
                               "SELECT * 
                                     FROM sfera_articles 
                                     WHERE id = $id") or die(mysql_error());
            // return user details 
            if (mysql_num_rows($result) > 0) {
				//echo 'rows - '. mysql_num_rows($result);			
                return mysql_fetch_array($result);
            } else {
                return false;
            }
             
        } else {
			//echo "returned FALSE";
            return false;
        }
    }
	
   function addBlog($fields) {
	
	        $title = mysql_real_escape_string($fields["title"]);
			$image = mysql_real_escape_string($fields["image"]);
			$description = mysql_real_escape_string($fields["description"]);
			$link = mysql_real_escape_string($fields["link"]);
			$author_email = mysql_real_escape_string($fields["author_email"]);
			$justclick_user_id = mysql_real_escape_string($fields["justclick_user_id"]);
			$justclick_user_key = mysql_real_escape_string($fields["justclick_user_key"]);
			$justclick_user_group = mysql_real_escape_string($fields["justclick_user_group"]);
			$smartresponder_api_id = mysql_real_escape_string($fields["smartresponder_api_id"]);
			$smartresponder_delivery_id = mysql_real_escape_string($fields["smartresponder_delivery_id"]);
			$user_id = mysql_real_escape_string($fields["user_id"]);

        // insert user into database
        $result = mysql_query("INSERT INTO sfera_blogs (title, image, description, link, author_email, justclick_user_id,
												 justclick_user_key, justclick_user_group, smartresponder_api_id, smartresponder_delivery_id, user_id)
							   VALUES ('$title', '$image', '$description','$link',
										'$author_email','$justclick_user_id', 
										'$justclick_user_key','$justclick_user_group',
										'$smartresponder_api_id','$smartresponder_delivery_id','$user_id')");
         
        // check for successful store
        if ($result) {
             
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query(
                               "SELECT * 
                                     FROM sfera_blogs 
                                     WHERE id = $id") or die(mysql_error());
            // return user details 
            if (mysql_num_rows($result) > 0) { 
                return mysql_fetch_array($result);
            } else {
                return false;
            }
             
        } else {
            return false;
        }
    }

	 function updateBlog($fields, $id) {
	
	        $title = mysql_real_escape_string($fields["title"]);
			$image = mysql_real_escape_string($fields["image"]);
			$description = mysql_real_escape_string($fields["description"]);
			$link = mysql_real_escape_string($fields["link"]);
			$author_email = mysql_real_escape_string($fields["author_email"]);
			$justclick_user_id = mysql_real_escape_string($fields["justclick_user_id"]);
			$justclick_user_key = mysql_real_escape_string($fields["justclick_user_key"]);
			$justclick_user_group = mysql_real_escape_string($fields["justclick_user_group"]);
			$smartresponder_api_id = mysql_real_escape_string($fields["smartresponder_api_id"]);
			$smartresponder_delivery_id = mysql_real_escape_string($fields["smartresponder_delivery_id"]);
            $user_id = mysql_real_escape_string($fields["user_id"]);
			
        // insert user into database
        $result = mysql_query("UPDATE sfera_blogs SET title='$title', image='$image', description='$description', link='$link',
												author_email='$author_email', justclick_user_id='$justclick_user_id',
												justclick_user_key='$justclick_user_key', justclick_user_group='$justclick_user_group',
												smartresponder_api_id='$smartresponder_api_id', smartresponder_delivery_id='$smartresponder_delivery_id', user_id='$user_id'
							   WHERE id = $id");
         
        // check for successful store
        if ($result) {

			// return user details 
            /*if (mysql_num_rows($result) > 0) { 
                return mysql_fetch_array($result);
            } else {
                return false;
            }*/
             return true;
        } else {
            return false;
        }
    }
	
	function getArticlesByBlogId($blogId, $startOffset, $endOffset) {
		$result = mysql_query("SELECT * FROM sfera_articles WHERE blogId=$blogId LIMIT $startOffset , $endOffset");
        return $result;
    }
	
	function getAllArticlesByBlogId($blogId) {
		$result = mysql_query("SELECT * FROM sfera_articles WHERE blogId=$blogId");
        return $result;
    } 
	
	function getArticleByURL($url){
		$result = mysql_query("SELECT * FROM sfera_articles WHERE link=$url");
        return $result;
	}
	
	function isArticleExist($url){
		$result = getArticleByURL($url);
		if (mysql_num_rows($result) > 0) { 
			return true;
		} else {
			return false;
		}
	}
	
    function getBlogById($id) {
        $result = mysql_query("SELECT * FROM sfera_blogs WHERE id=$id");
        return $result;
    }

	function getAllBlogsByUserID($userID) {
		$result = mysql_query("SELECT * FROM sfera_blogs WHERE user_id='$userID'");
		return $result;
	}

	function getIdUsersByLogin($login) {
		$result = mysql_query("SELECT * FROM sfera_authors WHERE login='$login'");
		$row=mysql_fetch_array($result);
		return $row['id'];
	}
    
    function getAllBlogs() {
			$result = mysql_query("SELECT * FROM sfera_blogs");
        return $result;
    } 

	function deleteBlog($id) {
        $result = mysql_query("DELETE FROM sfera_blogs WHERE id = ".$id);
        return $result;
    }
	
	function deleteAllBlogs() {
        $result = mysql_query("DELETE FROM sfera_blogs");
        return $result;
    }
	
	function showEditData($blogId) {
		$resBlog = getBlogById($blogId); 
		while($row = mysql_fetch_array($resBlog)){
			echo "$('#blogID').val('".$row['id']."');";
			echo "$('.blog_url').val('".$row['link']."');";
			echo "$('.blog_title').val('".$row['title']."');";
			echo "$('.blog_description').val('".$row['description']."');";
			echo "$('.blog_image').val('".$row['image']."');";
			echo "$('.blog_author_email').val('".$row['author_email']."');";
			echo "$('.justclick_user_id').val('".$row['justclick_user_id']."');";
			echo "$('.justclick_user_key').val('".$row['justclick_user_key']."');";
			echo "$('.justclick_user_group').val('".$row['justclick_user_group']."');";
			echo "$('.smartresponder_api_id').val('".$row['smartresponder_api_id']."');";
			echo "$('.smartresponder_delivery_id').val('".$row['smartresponder_delivery_id']."');";
            echo "$('.user_id').val('".$row['user_id']."');";
		}
	}
	
	function getArticlesLinks($url){
		//echo "url in method".$url."<br>";
		$html = file_get_html($url);
		$articlesLinks = array();
		foreach($html->find('a[rel=full-article]') as $element){
			$link = $url.$element->href;
			array_push($articlesLinks, $link);
		}

		$pageNumber = 2;
		$pageURL = $url.'/blog/page/';
		$response = file_get_contents($pageURL);
		if($response == null){
			$pageURL = $url.'/page/';
			//echo 'request successful<br>';
		}
		
		//echo '1 array count -- '. count($articlesLinks). '<br>' ;
		//<a class="dalee" href="http://nrsecrets.ru/andreev2/">Далее...</a>
		while($html != NULL){
			$html = file_get_html($pageURL.$pageNumber.'/');
			if(!empty($html)){
				$pageNumber = $pageNumber + 1;
				$elemetStr = 'a[rel=full-article]';
				$elementArray = $html->find($elemetStr);
				if(count($elementArray) == 0){
					$elemetStr = 'a[class=dalee]';
				}
				foreach($html->find($elemetStr) as $element){
					$link2 = $url.$element->href;
					array_push($articlesLinks, $link2);
					//echo 'array count -- '. count($articlesLinks). '<br>' ;
					//echo $row['link'].$element->href . '<br>';
					//echo $link2.'<br>';
				}
			}else{
				break;
			}
		}
		return $articlesLinks;
	}
	
	function saveArticle($url, $blogId){
		//echo "BLOGID ---  ".$blogId . '<br>';
		
		$html = file_get_html($url);
		$title = '';
		foreach($html->find('h1[class=entry-title]') as $element){
		    $title = $element->innertext;
			//echo "TITLE --- ".$element->innertext . '<br>';
		}
		
		$dateElement = $html->find('time');
		$date = $dateElement[0]->datetime;
		//echo "DATE ---  ". $date. '<br>';
		
		$textElement = $html->find('div[class=entry-content]');
		$text = $textElement[0]->innertext;
		//echo "TEXT -- ". $text. '<br>';

		$imageElement = $html->find('div[class=entry-content] img');
		$image = $imageElement[0]->src;
		//echo "IMAGE -- ".$image. '<br>';
		
		$descriptionElement = $html->find('meta[name=description]');
		$description = $descriptionElement[0]->content;
		//echo "DESCRIPTION --- ". $description . '<br>';
		
		$fields = array("blogId" => $blogId,
						"title" => $title,
						"image" => $image,
						"description" => $description,
						"link" => $url,
						"date" => $date,
						"text" => $text);
						
		if(!isArticleExist($url)){				
			addArticle($fields);
			//echo 'Added successfully!';
		}
	}
///

function getUserById($id) {
    $result = mysql_query("SELECT * FROM sfera_authors WHERE id=$id");
    return $result;
}

function showEditDataUsers($userId) {
    $resBlog = getUserById($userId);
    while($row = mysql_fetch_array($resBlog)){
        echo "$('.id').val('".$row['id']."');";
        echo "$('.login').val('".$row['login']."');";
        echo "$('.password').val('".$row['password']."');";
    }
}
function deleteUser($id) {
    $result = mysql_query("DELETE FROM sfera_authors WHERE id = ".$id);
    return $result;
}

function getAllUsers() {
    $result = mysql_query("SELECT * FROM sfera_authors");
    return $result;
}

function setNewUser($login, $password) {
    global $link;

    $query="INSERT INTO sfera_authors (login, password) VALUES('$login', '$password')";
    $result=mysql_query($query, $link) or die("Died inserting login info into db.  Error returned if any: ".mysql_error());

    return true;
}
function checkLoggedIn($status){
    switch($status){
        case "yes":
            if(!isset($_SESSION["loggedIn"])){
                header("Location: login.php");
                exit;
            }
            break;
        case "no":
            if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true ){
                header("Location: index.php");
            }
            break;
    }
    return true;
}
function checkPass($login, $password) {
    global $link;


    $query="SELECT login, password FROM sfera_authors WHERE login='$login' and password='$password'";
    $result=mysql_query($query)
    or die("checkPass fatal error: ".mysql_error());

    if(mysql_num_rows($result)==1) {
        $row=mysql_fetch_array($result);
        return $row;
    }
    return false;
}
function cleanMemberSession($login, $password) {
    $_SESSION["login"]=$login;
    $_SESSION["password"]=$password;
    $_SESSION["loggedIn"]=true;
}
function flushMemberSession() {
    unset($_SESSION["login"]);
    unset($_SESSION["password"]);
    unset($_SESSION["loggedIn"]);
    session_destroy();
    return true;
}
function field_validator($field_descr, $field_data, $field_type, $min_length="", $max_length="", $field_required=1) {

    global $messages;

    if(!$field_data && !$field_required){ return; }

    $field_ok=false;

    $email_regexp="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|";
    $email_regexp.="(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$";

    $data_types=array(
        "email"=>$email_regexp,
        "digit"=>"^[0-9]$",
        "number"=>"^[0-9]+$",
        "alpha"=>"^[a-zA-Z]+$",
        "alpha_space"=>"^[a-zA-Z ]+$",
        "alphanumeric"=>"^[a-zA-Z0-9]+$",
        "alphanumeric_space"=>"^[a-zA-Z0-9 ]+$",
        "string"=>""
    );

    if ($field_required && empty($field_data)) {
        $messages[] = "Поле $field_descr является обезательным";
        return;
    }

    if ($field_type == "string") {
        $field_ok = true;
    } else {
        $field_ok = ereg($data_types[$field_type], $field_data);
    }

    if (!$field_ok) {
        $messages[] = "Пожалуйста введите нормальный $field_descr.";
        return;
    }

    if ($field_ok && ($min_length > 0)) {
        if (strlen($field_data) < $min_length) {
            $messages[] = "$field_descr должен быть не короче $min_length символов.";
            return;
        }
    }

    if ($field_ok && ($max_length > 0)) {
        if (strlen($field_data) > $max_length) {
            $messages[] = "$field_descr не должен быть длиннее $max_length символов.";
            return;
        }
    }
}
function displayErrors($messages) {
    print("<b>Возникли следующие ошибки:</b>\n<ul>\n");

    foreach($messages as $msg){
        print("<li>$msg</li>\n");
    }
    print("</ul>\n");
}
function newUser($login, $password) {

    $query="INSERT INTO sfera_authors (login, password) VALUES('$login', '$password')";
    $result=mysql_query($query) or die("Died inserting login info into db.  Error returned if any: ".mysql_error());

    return true;
}

function addUser($fields) {

    $id= mysql_real_escape_string($fields["id"]);
    $login = mysql_real_escape_string($fields["login"]);
    $password = mysql_real_escape_string($fields["password"]);


    // insert user into database
    $result = mysql_query("INSERT INTO sfera_authors (id, login, password)
							   VALUES ('$id', '$login', '$password')");

    // check for successful store
    if ($result) {

        // get user details
        $id = mysql_insert_id(); // last inserted id
        $result = mysql_query(
            "SELECT *
                                     FROM sfera_authors
                                     WHERE id = $id") or die(mysql_error());
        // return user details
        if (mysql_num_rows($result) > 0) {
            return mysql_fetch_array($result);
        } else {
            return false;
        }

    } else {
        return false;
    }
}
function updateUser($fields) {

    $id= mysql_real_escape_string($fields["id"]);
    $login = mysql_real_escape_string($fields["login"]);
    $password = mysql_real_escape_string($fields["password"]);

    // insert user into database
    $result = mysql_query("UPDATE sfera_authors SET id='$id', login='$login', password='$password' WHERE id = $id");

    // check for successful store
    if ($result) {

        // return user details
        /*if (mysql_num_rows($result) > 0) {
            return mysql_fetch_array($result);
        } else {
            return false;
        }*/
        return true;
    } else {
        return false;
    }
}

?>