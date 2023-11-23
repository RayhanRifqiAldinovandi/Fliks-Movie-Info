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

//Specific Movie Request
$response = $client->request('GET', "https://api.themoviedb.org/3/movie/$movie_id?append_to_response=videos&language=en-US", [
    'headers' => [
        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZjg1ZGIxMDQ0ZTIzYjQ2OTdkZTBlMmE3Yzg4MzJjMSIsInN1YiI6IjY0YzdiYjUyNjNlNmZiMDExYjNiNGNlMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.fJbi9gdWnSVOaaGX4jQQyT-oip9Fm1N1N7ub-BTpJ2U',
        'accept' => 'application/json',
    ],
]);

$movie = $response->getBody();
$link = json_decode($movie,true);

$backdrop = "https://image.tmdb.org/t/p/original/".$link['backdrop_path'];
//Trailer link
$trailer = $link['videos']['results'];


//Reccomendation
$response = $client->request('GET', "https://api.themoviedb.org/3/movie/$movie_id/recommendations?language=en-US&page=1", [
    'headers' => [
      'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZjg1ZGIxMDQ0ZTIzYjQ2OTdkZTBlMmE3Yzg4MzJjMSIsInN1YiI6IjY0YzdiYjUyNjNlNmZiMDExYjNiNGNlMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.fJbi9gdWnSVOaaGX4jQQyT-oip9Fm1N1N7ub-BTpJ2U',
      'accept' => 'application/json',
    ],
  ]);
  
  $rec = $response->getBody();
  $rec_data = json_decode($rec,true);
  $recom_res = $rec_data['results']



?>