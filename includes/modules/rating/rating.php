<?php

if (isset($_GET['score'])) {
    //function connection Db
    chdir('../../../');
    $rootPath = defined('DIR_ROOT') ? DIR_ROOT : $_SERVER['DOCUMENT_ROOT'];
    require_once($rootPath . '/includes/bootstrap.php');
    require_once($rootPath . '/includes/configure.php');
    require_once($rootPath . '/includes/functions/database.php'); // include server parameters
}

class rating
{

    public $average = 0;
    public $averageP = 0;
    public $quantity;
    public $votes;
    public $status;
    public $table;
    public $total = 0;
    private $path;
    public $ip;
    public $personalVotes;


    function __construct($table, $ip)
    {
        try {
            //connection DB  Mysql
            tep_db_connect();
            $statement = tep_db_query("SELECT rating FROM ratings where product_id='$table'");
            $this->total = $quantity = 0;
            while ($row = tep_db_fetch_array($statement)) {
                $this->total = $this->total + $row['rating'];
                $quantity++;
            }
            if ($quantity == 0) {
                $this->average = 0;
            } else {
                $this->average = round((($this->total * 20) / $quantity), 0);
                $this->quantity = $quantity;
            }

            //Para rating actual
            $personalVotes = 0;
            $statement = tep_db_query("SELECT rating FROM ratings where product_id='$table' and ip_address='$ip'");
            if ($row = tep_db_fetch_array($statement)) {
                $personalVotes = $row['rating'];
            }
            $this->averageP = ($personalVotes * 20);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
        $dbh = null;
    }

    function set_score($score, $ip, $product)
    {
        try {
             $type = 0;
            if (strpos($ip, '.') == 0) {
                $type = 1;
            }
            $voted = tep_db_query("SELECT ratings_id FROM ratings WHERE product_id='$product' and ip_address='$ip'");

            if (tep_db_num_rows($voted) == 0) {
                tep_db_query("INSERT INTO ratings (ip_address,product_id,rating,type) VALUES ('$ip',$product,$score,$type)");
                $this->votes++;

                $statement = tep_db_query("SELECT rating FROM ratings where product_id='$product'");
                $this->total = $quantity = 0;
                while ($row = tep_db_fetch_array($statement)) {
                    $this->total = $this->total + $row['rating'];
                    $quantity++;
                }
                if ($quantity == 0) {
                    $this->average = 0;
                } else {
                    $this->average = round((($this->total * 20) / $quantity), 0);
                }
                //Para rating actual
                $personalVotes = 0;
                $statement = tep_db_query("SELECT rating FROM ratings where product_id='$product' and ip_address='$ip'");
                if ($row = tep_db_fetch_array($statement)) {
                    $personalVotes = $row['rating'];
                }
                $this->averageP = ($personalVotes * 20);
            } else {
                tep_db_query("update ratings set rating=$score where product_id='$product' and ip_address='$ip'");

                $statement = tep_db_query("SELECT rating FROM ratings where product_id='$product'");
                $this->total = $quantity = 0;
                while ($row = tep_db_fetch_array($statement)) {
                    $this->total = $this->total + $row['rating'];
                    $quantity++;
                }
                if ($quantity == 0) {
                    $this->average = 0;
                } else {
                    $this->average = round((($this->total * 20) / $quantity), 0);
                }
                //Para rating actual
                $personalVotes = 0;
                $statement = tep_db_query("SELECT rating FROM ratings where product_id='$product' and ip_address='$ip'");
                if ($row = tep_db_fetch_array($statement)) {
                    $personalVotes = $row['rating'];
                }
                $this->averageP = ($personalVotes * 20);
            }
        } catch (Exception $exception) {
                die($exception->getMessage());
        }
        $dbh = null;
    }
}

function rating_form($table, $mode = '')
{
    if (!empty($_SESSION['customer_id'])) {
          $ip = $_SESSION['customer_id'];
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }
    //echo "table: $table";
    if (!isset($table) && isset($_GET['table'])) {
        $table = $_GET['table'];
    }
    $table = (int)$table;
    $rating = new rating($table, $ip);
    $status = '<div class="score review_score">
				<span class="score1"></span>
				<span class="score2"></span>
				<span class="score3"></span>
				<span class="score4"></span>
				<span class="score5"></span>
			</div>';


    $z_rate = '<div class="sp_rating">
          			<div class="base">
          				<div class="average" style="width:' . $rating->average . '%">' . $rating->average . '</div>
                </div>
          			<div class="status">' . $status . '</div>
        		 </div>';

    if (!isset($_GET['update'])) {
        $z_rate = '<div class="rating_wrapper">' . $z_rate . '</div>';
    }

    if ($mode == 'listing') {
        return $z_rate;
    } else {
        echo $z_rate;
    }

    if (class_exists("\JsonLd\Container")) {
        \JsonLd\Container::get("product")->setRating($rating->average ?: 100)
            ->setRatingCount(($rating->quantity > 0) ? $rating->quantity : 1);
    }
    ?>

    <?php
}


if (isset($_GET['update']) && isset($_GET['table'])) {
    rating_form($_GET['table']);
}
