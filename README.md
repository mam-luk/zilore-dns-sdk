# Deprecation Notice

This SDK is deprecated as Zilore ceased operations in July, 2014.

# Zilore DNS SDK

This is a simple SDK for <a href="https://zilore.com/?r=455e9e0de5cd86a9c371000077f6bb9f" target="_blank">Zilore DNS</a> API. It is written in PHP 8.2 and allows for interaction with the 
Domains, Records, GeoRecords FailoverRecords APIs from Zilore (https://zilore.com/en/help/api). 

It was designed to be used with the Zilore DNS CLI, which allows you to declartively declare your DNS, GeoDNS and Failovers 
records in a YAML file and then sync them to Zilore DNS.

### Installation

```
composer require mamluk/zilore-dns-sdk
```

### Usage
```php
use Zilore\Api\Domains
use Zilore\Api\Records;
use Zilore\Api\GeoRecords;
use Zilore\Api\FailoverRecords;

$domains = new Domains('YOUR_ZILORE_API_KEY')
$dommains->list(); // Returns a list of all the domains in Zilore
$domains->add('example.com'); // Adds a new domain to Zilore
$domains->delete('example.com'); // Deletes a domain from Zilore

$records = new Records('YOUR_ZILORE_API_KEY');
$records->list('example.com'); // Returns a list of all the records for example.com
$records->add('example.com', 'A', 'subdomain.example.com', '22.33.44.55', 3600); // Adds a new record to example.com

// ... and so on so forth
```

### License

MIT. See [LICENSE](LICENSE) for more details.
