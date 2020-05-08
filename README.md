# TinyWallet
Wallet Library for PHP Projects.

## Installation

```
composer require gemblue/tiny-wallet
```

## DB Migration

```
./bin/install
```

## Usage

```
use Gemblue\TinyWallet;

$wallet = new Wallet;
```

## API

| Method | Desc |
--- | --- |
| getBalance | Get use balance |
| record | To record a transaction |
| syncronize | To sync transaction to ledger |
