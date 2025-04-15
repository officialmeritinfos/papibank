<?php

if (!function_exists('maskAccountNumber')) {
    /**
     * Shorten an account number by replacing all but the last four digits with '*'.
     *
     * @param string $accountNumber
     * @return string
     */
    function maskAccountNumber(string $accountNumber): string
    {
        if (strlen($accountNumber) < 4) {
            return str_repeat('*', strlen($accountNumber));
        }
        return str_repeat('*', strlen($accountNumber) - 4) . substr($accountNumber, -4);
    }
}

if (!function_exists('generateUniqueAccountNumber')) {
    /**
     * Generate a unique 10-digit account number.
     *
     * @return string
     */
    function generateUniqueAccountNumber(): string
    {
        do {
            $accountNumber = (string) mt_rand(1000000000, 9999999999);
        } while (\App\Models\User::where('account_number', $accountNumber)->exists());

        return $accountNumber;    
    
    }
    
    function maskEmail($email)
{
    // Split the email into username and domain
    $parts = explode("@", $email);

    if (count($parts) !== 2) {
        return "Invalid email format"; // Fallback if email format is incorrect
    }

    $username = $parts[0];
    $domain = $parts[1];

    // Mask username with asterisks, keeping only the first and last character
    $maskedUsername = substr($username, 0, 1) . str_repeat('*', max(1, strlen($username) - 2)) . substr($username, -1);

    // Return masked email
    return $maskedUsername . "@" . $domain;
}

}
