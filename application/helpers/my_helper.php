<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * NOTES: 
 * - make sure you have enable composer_autoload in config.php
 */


/**
 * TOKEN KEY.
 */
function getKey() : string
{
	$CI = get_instance();
	return $CI->config->item('encryption_key');
}

/**
 * Generate New Token 
 */
function generateToken(String $userId,String $privilege,bool $rememberme): array
{
    $payload = array(
        "userId"     => $userId,
        "privilege"  => $privilege,
        "expired"    => ($rememberme == true) ? time()+2592000 : time()+(3600*24), 
    );

    return [
        'token'   => JWT::encode($payload, getKey(), 'HS256'),
        "expired" => $payload['expired'], 
    ];
}

/**
 * Check Token 
 */
function checkToken(?string $token=null,bool $withApiResponse = false): array
{
    try {
        $arrayReturn = [];
        $decoded     = JWT::decode($token, new Key(getKey(), 'HS256'));

        if (time() < $decoded->expired) {
            $arrayReturn = [
                'status' => true,
                'message'=> 'success',
                'data'   => $decoded,
            ];
        }
        else {
            $arrayReturn = [
                'status' => false,
                'message'=> 'token expired',
            ];
        }

        return $arrayReturn;
    } 
    catch (\Throwable $th) {
        $arrayReturn = [
            'status' => false,
            'message'=> 'invalid token'
        ];

        if ($withApiResponse==false) {
            return $arrayReturn;
        }
    }
}

function generateSalam()
{
	$start = strtotime(date("d-m-Y", time()). " 00:00:00");
	$end   = time();

	$x = "";

	if ($end-$start <= 86400) {
		$x = "malam";
	}
	if ($end-$start <= 64800) {
		$x = "sore";
	}
	if ($end-$start <= 54000) {
		$x = "siang";
	}
	if ($end-$start <= 36000) {
		$x = "pagi";
	}

	return "selamat " . $x . "";
}
