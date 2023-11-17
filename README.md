# Larva Forge SDK

<a href="https://github.com/larvatecn/forge-sdk/actions"><img src="https://github.com/larvatecn/forge-sdk/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/larva/forge-sdk"><img src="https://img.shields.io/packagist/dt/larva/forge-sdk" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/larva/forge-sdk"><img src="https://img.shields.io/packagist/v/larva/forge-sdk" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/larva/forge-sdk"><img src="https://img.shields.io/packagist/l/larva/forge-sdk" alt="License"></a>

## Introduction

The [Larva Forge](https://forge.larva.com.cn) SDK provides an expressive interface for interacting with Forge's API and managing Laravel Forge servers.

## Official Documentation

### Installation

To install the SDK in your project you need to require the package via composer:

```bash
composer require larva/pusher-sdk
```

### Basic Usage

You can create an instance of the SDK like so:

```php
$forge = new Larva\Pusher\Forge('http://ws.domain.com', TOKEN_HERE);
```

Using the `Forge` instance you may perform multiple actions as well as retrieve the different resources Forge's API provides:

```php
$servers = $forge->servers();
```

## License

Larva Forge SDK is open-sourced software licensed under the [MIT license](LICENSE.md).
