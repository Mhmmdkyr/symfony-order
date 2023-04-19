<br />
<div align="center">
<h3 align="center">Simple restful ordering service with Symfony 5</h3>
</div>

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Tasks</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

## About The Project

This service includes JWT login and registration. The purpose of the service is to create an order, edit the created order, view all orders and present the order details via API for the customer logged in with JWT.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Getting Started

You can follow the simple guidelines below to get the project working.

### Prerequisites

To run this project, PHP 7.4 (or higher) and composer must be installed.

### Installation

Below is an example of how you can instruct your audience on installing and setting up your app. This template doesn't rely on any external dependencies or services._

1. Clone the repo
   ```sh
   git clone https://github.com/Mhmmdkyr/symfony-order.git
   ```
3. Install composer packages
   ```sh
   composer install
   ```
4. Edit the .env file yourself.
   ```
   DATABASE_URL=mysql://root:root@127.0.0.1:3309/symfony_case
   ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Usage

### Register [POST]
All field required.
```
   /api/register
   ```

| Param    | Type   | Default | Description    |
|----------| ------ | ------- |----------------|
| username | string | null    | Username       |
| password | string | null    | Password       |
| email    | string | null    | E-mail address |

### Login [POST]
All field required.
```
   /api/login_check
   ```


| Param    | Type   | Default | Description    |
|----------| ------ | ------- |----------------|
| username | string | null    | Username       |
| password | string | null    | Password       |

### All Orders [GET]
```
   /api/order
   ```

### Show Order [GET]
```
   /api/order/show/{order_code}
   ```

### New Order [POST]
```
   /api/order/add
   ```

| Param     | Type    | Required | Description            |
|-----------|---------|----------|------------------------|
| orderCode | string  | yes      | Order Code             |
| productId | integer | yes      | Product ID             |
| quantity  | integer | yes      | Quantity to order      |
| address   | string  | yes      | Order delivery address |

### Edit Order [POST]
As all parameters update know, only one parameter can also be updated.
```
   /api/order/edit/{order_code}
   ```

| Param     | Type    | Required | Description            |
|-----------|---------|----------|------------------------|
| orderCode | string  | no       | Order Code             |
| productId | integer | no       | Product ID             |
| quantity  | integer | no       | Quantity to order      |
| address   | string  | no       | Order delivery address |


<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Tasks

- [x] JWT Login and Register
- [x] Show all orders
- [x] Add an order
- [x] Show an order
- [x] Edit an order
- [x] Add README.md file
- [x] Add Postman Collection
- [ ] Unit Tests
- [ ] Docker Image

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Contact

Muhammed Kayar - [@mhmmdkyr](https://twitter.com/mhmmdkyr) - mail@muhammedkayar.com.tr

Project Link: [https://github.com/Mhmmdkyr/symfony-order](https://github.com/Mhmmdkyr/symfony-order)

<p align="right">(<a href="#readme-top">back to top</a>)</p>