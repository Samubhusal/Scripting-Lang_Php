<?php

    class Bank
    {
        
        private $accountNumber;
        private $accountHolderName;
        private $accountType;
        private $balance;

        
        public function __construct($accountNumber, $accountHolderName, $accountType, $balance)
        {
            $this->accountNumber = $accountNumber;
            $this->accountHolderName = $accountHolderName;
            $this->accountType = $accountType;
            $this->balance = $balance;
        }

        
        public function deposit($amount)
        {
            if ($amount > 0) {
                $this->balance = $this->balance + $amount;
                echo "Deposited: " . $amount . "<br>";
            } else {
                echo "Invalid deposit amount.<br>";
            }
        }

        
        public function withdraw($amount)
        {
            if ($amount > 0 && $amount <= $this->balance) {
                $this->balance = $this->balance - $amount;
                echo "Withdrawn: " . $amount . "<br>";
            } else {
                echo "Insufficient balance or invalid amount.<br>";
            }
        }

        
        public function changeType($newType)
        {
            $this->accountType = $newType;
            echo "Account type changed to: " . $newType . "<br>";
        }

        
        public function getBalance()
        {
            return $this->balance;
        }

        
        public function display()
        {
            echo "Account Number: " . $this->accountNumber . "<br>";
            echo "Account Holder Name: " . $this->accountHolderName . "<br>";
            echo "Account Type: " . $this->accountType . "<br>";
            echo "Balance: " . $this->balance . "<br>";
        }
    }


    $account = new Bank(
        "ACC1001",
        "Suman Bhushal",
        "Saving",
        5000
    );


    $account->display();

    echo "<br>";


    $account->deposit(2000);


    $account->withdraw(1000);

    $account->changeType("Current");

    echo "<br>";

    echo "Final Balance: " . $account->getBalance();

?>