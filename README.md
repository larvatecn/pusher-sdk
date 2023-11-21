# Pusher Server SDK

<a href="https://packagist.org/packages/larva/pusher-sdk"><img src="https://img.shields.io/packagist/dt/larva/pusher-sdk" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/larva/pusher-sdk"><img src="https://img.shields.io/packagist/v/larva/pusher-sdk" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/larva/pusher-sdk"><img src="https://img.shields.io/packagist/l/larva/pusher-sdk" alt="License"></a>

## Introduction

Pusher 服务 Sdk

## Official Documentation

### 安装

To install the SDK in your project you need to require the package via composer:

```bash
composer require larva/pusher-sdk
```

### 基本使用

您可以创建这样的SDK实例:

```php
$forge = new Larva\Pusher\Forge('http://ws.domain.com', TOKEN_HERE);
```

发布点对点事件：

```php
$res = $forge->publish('6557749ee6d95#32131','event', ['name'=>'张三']);
```

向频道广播事件：

```php
$res = $forge->trigger('room1','event', ['name'=>'张三']);
```

查询频道在线人数：

```php
$res = $forge->getOnlineUsers('room1');
```

## License

Larva Forge SDK is open-sourced software licensed under the [MIT license](LICENSE.md).
