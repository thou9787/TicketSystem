<?php
namespace App\AddColumnData;

class AddColumnData 
{
    /**
     * Generate a value for ticket number
     * 
     * @return string
     */
    public static function generateHash()
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*() -';
        $random = $chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)];//Random 5 times
        $content = uniqid().$random;  // 類似 5443e09c27bf4aB4uT
        return sha1($content); 
    }
    
    /**
     * Determine if the ticket got paid
     * 
     * @return integer
     */
    public static function isPaid()
    {
        return 1;
    }
}