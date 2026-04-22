# InPost Integration API (ShipX) v.0.1.1

PHP Library Inpost ShipX.

Tracking,points,MPK,organizations,Status,Shipment,CreateShipment DispatchOrder,Sending,Batch,Sending,Service,

## Install
```bash
composer require maniek431/inpost_integration_api_rest
```

## Start

```php
require_once 'vendor/autoload.php';

use maniek431\Inpost_Integration_Api_Rest\InpostApiClient;

$client = new InpostApi('TOKEN_API', 'ID_ORGANIZACJI');


$points = $client->points()->getPoints(['city' => 'Warszawa']);
```
