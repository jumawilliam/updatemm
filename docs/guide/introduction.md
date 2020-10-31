## About This Package

This is a *Laravel 5.5+* package for mobile-money and Equity API. 
The API allows a merchant to initiate C2B,B2C and B2B transactions including balance query and reversals.

## What has been done

This package includes Controllers, Migrations and Routes which simplifies everything for you.
You only need to setup a few things in the published configuration file and you are good to go.
It comes with a admin section to monitor transactions, send money via b2c and reverse transactions.

::: tip Mobile Money Interoperability
With recent mobile network interoperability, it will be possible to accept payment from any provider
See [this article about mobile money interoperability](https://www.standardmedia.co.ke/business/article/2001276005/operators-to-launch-money-transfer-across-networks)
:::

## Operator Support

| Platform      | C2B                   | B2C                   | B2B                   | Balance Query         | Reversals             |
| :------------ |:--------------------: | :----------------:    | :----:                | :-----------:         | :--------:            |
| Mpesa         | :heavy_check_mark:    | :heavy_check_mark:    | :heavy_check_mark:    | :heavy_check_mark:    | :heavy_check_mark:    |
| Equitel       | :heavy_check_mark:    | :heavy_check_mark:    | :x:                   | :heavy_check_mark:    | :heavy_check_mark:    |
| Airtel Money  | :heavy_check_mark:    | :heavy_check_mark:    | :x:                   | :heavy_check_mark:    | :x:                   |
| T-Cash        | :heavy_check_mark:    | :heavy_check_mark:    | :x:                   | :heavy_check_mark:    | :x:                   |

## Features

### All Players
  - This package works for Mpesa, Equitel, T-cash and Airtel Money.
  
### Minimal Configuration
  - This package handles the donkey-work, you just add your config and you should start processing payments
   
### Real Time :money_mouth_face:
  - We have leveraged the laravel event system and optional slack notifications to get all payment activity



### Glossary

| Term | Name | Description
| :------: | :-------- | :---------
| C2B | Customer to Business | Accept payments from you customer to business account
| B2C | Business to Customer Remittance | Send money from business account to customer
| B2B | Business to Business Payment | Send money to another business from your business
