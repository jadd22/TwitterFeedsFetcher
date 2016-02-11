<?php
require_once('TwitterAPIExchange.php');
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
'oauth_access_token' => "200525567-scm8EeN6LU5RLGJNsQZYiB57wsCcXNq8ZSoN4yyD",
'oauth_access_token_secret' => "jVDxCVo2btLqeE6j70Vo2Y6Kjrcvtk1EPsYWUP7Ub99N7",
'consumer_key' => "IscLxDBTxrrUD2t4XQvmRkDAe",
'consumer_secret' => "NR8nw7s8ohekmSHeX4hy0McllsSOqnGjfZdzelELKe3aRxLTcm"
);
$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";

if (isset($_GET['user']))  {$user = $_GET['user'];}  else {$user  = "dev";}
if (isset($_GET['count'])) {$count = $_GET['count'];} else {$count = 20;}
echo "You're viewing tweets of $user";
$getfield = "?screen_name=$user&count=$count";
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);
if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
foreach($string as $items)
    {
        echo "Time and Date of Tweet: ".$items['created_at']."<br />";
        echo "Tweet: ". $items['text']."<br />";
        echo "Tweeted by: ". $items['user']['name']."<br />";
        echo "Screen name: ". $items['user']['screen_name']."<br />";
        echo "Followers: ". $items['user']['followers_count']."<br />";
        echo "Friends: ". $items['user']['friends_count']."<br />";
        echo "Listed: ". $items['user']['listed_count']."<br /><hr />";
    }
?>
