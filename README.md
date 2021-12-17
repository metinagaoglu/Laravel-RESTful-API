<div align="center">


<h3 align="center">Laravel API example</h3>

  <p align="center">
    A simple restful api for realtors that creates appointments and calculates distances based on location
    <br />
    <br />
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project




<p align="right">(<a href="#top">back to top</a>)</p>



### Built With

This section should list any major frameworks/libraries used to bootstrap your project. Leave any add-ons/plugins for the acknowledgements section. Here are a few examples.


* [Laravel](https://laravel.com)
* [PostgreSQL](https://www.postgresql.org/)
* [Docker](https://www.docker.com/)


<p align="right">(<a href="#top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

### Prerequisites

This is an example of how to list things you need to use the software and how to install them.
* PHP8
* Composer
* PostgesQL(Recommended) or MariaDB
* Docker(Optional)


### Manual Installation



1. Clone the repo
   ```sh
   git clone https://github.com/metinagaoglu/Laravel-API-example
   ```
2. Move source directory
   ```sh
   cd src/
   ```
2. Copy the .env file.
   ```sh
   cp .env.example .env
   ```
3. Configure your database,google maps api keys etc. settings
```shell
POSTCODES_URL=https://api.postcodes.io/
REAL_ESTATE_AGENT_POSTCODE=
GOOGLE_MAPS_API=
```
5. Install dependency
   ```sh
   composer install
   ```
5. Generate key
   ```sh
   php artisan key:generate
   ``` 
5. Generate jwt secret key
   ```sh
   php artisan jwt:secret
   ``` 
6. Run migrate command (Be sure your db settings are correct)
   ```sh
   php artisan migrate
   ``` 
7. Run the development serve
   ```sh
   php artisan serve
   ```
8. Send the get request
   ```sh
   localhost:8000
   ```


<p align="right">(<a href="#top">back to top</a>)</p>




<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#top">back to top</a>)</p>


<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#top">back to top</a>)</p>


<!-- CONTACT -->
## Contact

Metin Ağaoğlu - [@metnagaoglu](https://twitter.com/metnagaoglu) - metnagaoglu@gmail.com

<p align="right">(<a href="#top">back to top</a>)</p>