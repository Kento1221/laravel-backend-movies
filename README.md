<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About the project

<p>Main objective of the project was to create a simple back-end solution for a movie collection. 
To learn and discover new functionalities.</p>
The project utilizes: token based authorization, local storage system for uploaded movie cover files 
(automatically resized to specified resolution values), request authentication, validation and 
extremely simple middleware based filtration. The collection of movies can be updated, expanded 
and thinned out by CRUD controllers.

## Endpoints

| Method    | URI                       | Name           |
|-----------|---------------------------|----------------|
| POST      | api/auth/login            |                |
| GET       | api/auth/logout           |                |
| GET       | api/auth/logout-all       |                |
| POST      | api/auth/register         |                |
| POST      | api/movie/cover           |                |
| DELETE    | api/movie/cover/{movieId} |                |
| POST      | api/movie/rating          |                |
| GET       | api/movie/rating/{movie}  |                |
| DELETE    | api/movie/rating/{rating} |                |
| POST      | api/movies                | movies.store   |
| GET       | api/movies                | movies.index   |
| DELETE    | api/movies/{movie}        | movies.destroy |
| PUT       | api/movies/{movie}        | movies.update  |
| GET       | api/movies/{movie}        | movies.show    |
| POST      | api/search                |                |
| GET       | api/user                  |                |

## Project's ERD diagram

<img src="https://postimg.cc/JHymcMHL" width="400" height="450"/>
