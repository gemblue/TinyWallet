<?php namespace Gemblue\TinyWallet\Migrations;

class MigrationCreateTable {

	public function queryUp()
	{
		$query[] = "CREATE TABLE `wallet` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `subject_id` int(10) NOT NULL,
		  `balance` int(10) NOT NULL,
		  `created_at` datetime NOT NULL,
		  `updated_at` datetime NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

		$query[] = "CREATE TABLE `wallet_ledger` (
		  `id` int(10) NOT NULL AUTO_INCREMENT,
		  `subject_id` int(10) NOT NULL,
		  `transaction_id` int(10) NOT NULL,
		  `amount` float NOT NULL,
		  `entry` varchar(10) NOT NULL,
		  `created_at` datetime NOT NULL,
		  `updated_at` datetime DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

		$query[] = "CREATE TABLE `wallet_transaction` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `subject_id` int(10) NOT NULL,
		  `type` varchar(20) NOT NULL,
		  `currency` varchar(3) NOT NULL,
		  `amount` int(10) NOT NULL,
		  `code` varchar(10) NOT NULL,
		  `metadata` varchar(100) NOT NULL,
		  `created_at` datetime NOT NULL,
		  `updated_at` datetime DEFAULT NULL,
		  `deleted_at` datetime DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

		$query[] = "CREATE TABLE `wallet_transaction_log` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `transaction_id` int(11) NOT NULL,
		  `status` varchar(30) NOT NULL,
		  `created_at` datetime NOT NULL,
		  `expired_at` datetime DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

		return $query;
	}

	public function queryDown()
	{
		$query[] = "DROP TABLE `wallet`;";
		$query[] = "DROP TABLE `wallet_ledger`;";
		$query[] = "DROP TABLE `wallet_transaction`;";
		$query[] = "DROP TABLE `wallet_transaction_log`;";

		return $query;
	}

}