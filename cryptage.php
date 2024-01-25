<?php

function myCrypte($string, $cipher, $key, $options, $iv)
{
    return openssl_encrypt($string, $cipher, $key, $options, $iv);
}
function myDecrypte($string, $cipher, $key, $options, $iv)
{
    return openssl_decrypt($string, $cipher, $key, $options, $iv);
}

// Store a string into the variable which
// need to be Encrypted

$simple_string = "tanger";
// Display the original string

// Store the cipher method
$ciphering = "AES-128-CTR";
$options = 0;
$encryption_iv = '2019202020212022';
$encryption_key = "Insightsolutions";

// Non-NULL Initialization Vector for encryption

// Store the encryption key
$iv_length = openssl_cipher_iv_length($ciphering);

// Use openssl_encrypt() function to encrypt the data
// $encryption = openssl_encrypt(
//     $simple_string,
//     $ciphering,
//     $encryption_key,
//     $options,
//     $encryption_iv
// );
echo "Original String: " . $simple_string . "<br>";
$g = myCrypte($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
echo "Encrypted String: " . $g . "<br>";
echo "Decrypted String: " . myDecrypte($g, $ciphering, $encryption_key, $options, $encryption_iv) . "<br>";

$simple_string = 'marrakech';
echo "Original String: " . $simple_string . "<br>";
$g = myCrypte($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
echo "Encrypted String: " . $g . "<br>";
echo "Decrypted String: " . myDecrypte($g, $ciphering, $encryption_key, $options, $encryption_iv);

$simple_string = 'arma';
echo "Original String: " . $simple_string . "<br>";
$g = myCrypte($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
echo "Encrypted String: " . $g . "<br>";
echo "Decrypted String: " . myDecrypte($g, $ciphering, $encryption_key, $options, $encryption_iv);

// Use openssl_decrypt() function to decrypt the data
// $decryption = openssl_decrypt(
    //     $encryption,
    //     $ciphering,
    //     $decryption_key,
    //     $options,
    //     $decryption_iv
    // );
    
    // Display the decrypted string
    
    // $decryption_iv = '2019202020212022';
    
    // $decryption_key = "Insightsolutions";