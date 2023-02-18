<?php

require('includes/application_top.php');



global $languages_id;
if(isset($_POST['link']) && isset($_POST['count'])) {
    $url = $_POST['link'];
    $count = $_POST['count'];
    if (preg_match('/instagram\.com\/[a-zA-Z0-9._]+/', $url, $matches)) {
        $nickname = explode('/', $matches[0])[1];
    }
    getInstaData($nickname, $count, $languages_id);
    echo "success"; die;
}
function getInstaData($username, $count, $languages_id){

    $url     = sprintf("https://www.instagram.com/$username");
    $content = file_get_contents($url);
    $content = explode("window._sharedData = ", $content)[1];
    $content = explode(";</script>", $content)[0];
    $data    = json_decode($content, true);
    $data =  $data['entry_data']['ProfilePage'][0];
    insertInDbDataFromInsta($data, $username, $languages_id, 1);
    $count = $count - 12;
    $end_cursor = $data['graphql']['user']['edge_owner_to_timeline_media']['page_info']['end_cursor'];
    $user_id = $data['graphql']['user']['id'];
    while($count > 50 ){
        $temp_count = 50;
        $content = file_get_contents('https://www.instagram.com/graphql/query/?query_hash=472f257a40c653c64c666ce877d59d2b&variables={"id":"'.$user_id.'","first":'.$temp_count.',"after":"'.$end_cursor.'"}');
        $data    = json_decode($content, true);
        insertInDbDataFromInsta($data, $username, $languages_id, 2);
        $end_cursor = $data['data']['user']['edge_owner_to_timeline_media']['page_info']['end_cursor'];
        $count = $count - 50;
    }
    if($count > 0){
        $content = file_get_contents('https://www.instagram.com/graphql/query/?query_hash=472f257a40c653c64c666ce877d59d2b&variables={"id":"'.$user_id.'","first":'.$count.',"after":"'.$end_cursor.'"}');
        $data    = json_decode($content, true);
        insertInDbDataFromInsta($data, $username, $languages_id, 2);
    }



}
function insertInstaCategory($langArr){
    $sql = "SELECT categories_id
            FROM " . TABLE_CATEGORIES_DESCRIPTION . "
            WHERE categories_name = 'Instagram' ";
    $query = tep_db_query($sql);
    if($query->num_rows == 0){
        tep_db_query("INSERT INTO " . TABLE_CATEGORIES ."(date_added, last_modified)
                VALUES (now(), now())");
        $categories_id = tep_db_insert_id();
        foreach ($langArr as $e){
            $sql = "SELECT categories_id
            FROM " . TABLE_CATEGORIES_DESCRIPTION . "
            WHERE categories_name = 'Instagram' and language_id = ".$e['id'];
            $query = tep_db_query($sql);
            if($query->num_rows==0){
                tep_db_query("INSERT INTO " . TABLE_CATEGORIES_DESCRIPTION . "(categories_id, language_id, categories_name)
                VALUES (".$categories_id.",".$e['id'].", 'Instagram')");
            }
        }
    }else{
        $categories_id = tep_db_fetch_array($query)['categories_id'];
    }
    return $categories_id;
}
function insertInDbDataFromInsta($data, $nickname, $languages_id, $type){
    $pdo = new PDO('mysql:host='.env("DB_HOST").';dbname='.env("DB_DATABASE"), env("DB_USERNAME"), env("DB_PASSWORD"), [PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8mb4']);
    $instaResult = json_decode(json_encode($data));
    if($type == 1) $edges = $instaResult->graphql->user->edge_owner_to_timeline_media->edges;
    else $edges = $instaResult->data->user->edge_owner_to_timeline_media->edges;
    $langArr = tep_get_languages();
    $categories_id = insertInstaCategory($langArr);

    foreach ($edges as $edge){
        $text = $edge->node->edge_media_to_caption->edges[0]->node->text;
        $photoUrl = $edge->node->display_url;
        //$type = $imageTypes[exif_imagetype($photoUrl) - 1];
        $type = "jpeg";
        $savePath = realpath(__DIR__ . '/..')."/images/products/";
        $fileName = "instagram_".$nickname.rand(1,1000000);
        file_put_contents($savePath.$fileName.'.'.$type, file_get_contents($photoUrl));
        $sql = "INSERT INTO " . TABLE_PRODUCTS . "(products_image, products_status	)
            VALUES (:filename, :products_status)";
        $cat = $pdo->prepare($sql);
        $cat->execute(['filename'=>$fileName.'.'.$type, 'products_status'=>1]);
        $productId = $pdo->lastInsertId();
        foreach ($langArr as $e){
            $sql = "INSERT INTO " . TABLE_PRODUCTS_DESCRIPTION . "(products_id, language_id, products_name, products_description, products_url)
            VALUES (:products_id, :language_id, :products_name, :products_description, :products_url)";
            $cat = $pdo->prepare($sql);
            $cat->execute(['products_id'=>$productId, 'language_id'=>$e['id'], 'products_name'=>'Instagram post', 'products_description'=>$text, 'products_url'=>$fileName]);
        }
        tep_db_query("INSERT INTO " . TABLE_PRODUCTS_TO_CATEGORIES ."(products_id, categories_id)
                VALUES (".$productId.", " . $categories_id . ")");
    }
}


include_once('html-open.php');
include_once('header.php');
?>

<div class="container">
    <h1><?=INSTAGRAM_PRODUCTS_TITLE; ?></h1>
    <form action = "instagram.php" method="post">
        <div class="form-group">
            <label for="link"><?= INSTAGRAM_LINK; ?></label>
            <input class="form-control" required type="text" name = "link" id = "link">
        </div>
        <div class="form-group">
            <label for="link"><?= INSTAGRAM_COUNT; ?></label>
            <input class="form-control" required type="text" name = "count" id = "count">
        </div>
        <input class="form-control" type="hidden" name = "success_text" id = "success_text" value="<?=INSTAGRAM_SUCCESS; ?>">
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>
<script>
    $(document).ready(function(){
        $("form").submit(function (e) {
            e.preventDefault();
            $("form button").attr("disabled", "true");
            jQuery.ajax({
                type: "POST",
                data:  $("form").serialize(),
                success: function(data) {
                    if(data=='success') {
                        alert($("#success_text").val());
                        $("form button").removeAttr("disabled");
                    }
                }, error:function () {
                        alert("remove");
                }
            });
        });
    });
</script>
<?php include_once('footer.php');?>
<?php
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
