<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

//All Movie Request
$movies = $client->request('GET', 'https://api.themoviedb.org/3/movie/now_playing?language=en-US&page=1', [
  'headers' => [
    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZjg1ZGIxMDQ0ZTIzYjQ2OTdkZTBlMmE3Yzg4MzJjMSIsInN1YiI6IjY0YzdiYjUyNjNlNmZiMDExYjNiNGNlMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.fJbi9gdWnSVOaaGX4jQQyT-oip9Fm1N1N7ub-BTpJ2U',
    'accept' => 'application/json',
  ],
]);

$res = $movies->getBody();
$data = json_decode($res,true);
$data_res = $data['results'];
$backdrop = "https://image.tmdb.org/t/p/original/".$data_res[0]['backdrop_path'];



//Specific Movie Request
$specific_trailer = $data_res[0]['id'];
$response = $client->request('GET', "https://api.themoviedb.org/3/movie/$specific_trailer/videos?language=en-US", [
    'headers' => [
      'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZjg1ZGIxMDQ0ZTIzYjQ2OTdkZTBlMmE3Yzg4MzJjMSIsInN1YiI6IjY0YzdiYjUyNjNlNmZiMDExYjNiNGNlMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.fJbi9gdWnSVOaaGX4jQQyT-oip9Fm1N1N7ub-BTpJ2U',
      'accept' => 'application/json',
    ],
  ]);
  
  $trailer = $response->getBody();
  $link = json_decode($trailer,true);
  $link_res = $link['results'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=4, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;1,600&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <header>
            <div class="navbar">
                <h1>Fliks</h1>
                <ul>
                    <li><a href="home.php">Now Showing</a></li>
                    <li><a href="upcoming.php">Coming Soon</a></li>
                    <li><a href="">Profile</a></li>
                </ul>
            </div>
        </header> 
        <div class="movie">
            <div class="desc-container">
               <div class="desc-items">
                   <li><h1><?=$data_res[0]['original_title']  ?></h1></li>
                   <li><p><?=$data_res[0]['release_date']  ?></p></li>
                   <li><p><?=$data_res[0]['overview']  ?></p></li>
                   <div class="buttons">
                     <button type="button" id="watch-trailer" onclick="location.href='https://www.youtube.com/watch?v=<?= $link_res[0]['key']?>'">Watch Trailer</button>
                     <button id="more-info">More Info</button>
                   </div>
               </div>
            </div>
            <div class="grad"></div>
            <img src=<?=$backdrop?> alt="">
        </div>
        <div class="genres-container">
            <div class="genres">
                <div class="action">
                    <p>Action</p>
                    <?php $iter = -1 ?>
                    <?php foreach($data_res as $d): ?>
                        <?php if(in_array('28',$d['genre_ids']) ) : ?>
                            <?php $iter++ ?>
                            <a href="details.php?movie_id=<?=$d['id']?>"><img src=<?="https://image.tmdb.org/t/p/w500/".$d['poster_path'];?> alt=""></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                </div>
                <div class="comedy">
                    <p>Comedy</p>
                    <?php foreach($data_res as $d): ?>
                        <?php if(in_array('35',$d['genre_ids']) ) : ?>
                            <a href="details.php?movie_id=<?=$d['id']?>"><img src=<?="https://image.tmdb.org/t/p/w500/".$d['poster_path'];?> alt=""></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                </div>
            </div>
        </div>
        <footer>
            <div class="footing">
                <h3>Rayhan Rifqi Aldinovandi</h3>
            </div>
        </footer>
    </div>
</body>
</html>