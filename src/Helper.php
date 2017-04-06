<?php

namespace Merkeleon\Laravel\HttpAuth;

use File;

class Helper
{
    public static function lockFile()
    {
        return storage_path('app/httpauth');
    }

    public static function isLocked()
    {
        return self::lockFileExists() && count(self::getUsers());
    }

    public static function lockFileExists()
    {
        return File::exists(self::lockFile());
    }

    private static function putContent($content) {
        if (!self::lockFileExists()) {
            File::put(self::lockFile(), json_encode($content));
        }
        File::put(self::lockFile(), json_encode($content));
    }

    private static function getContent()
    {
        if (!self::lockFileExists())
        {
            return [];
        }
        $content = File::get(self::lockFile());

        return json_decode($content, true) ?: [];
    }

    public static function getUsers()
    {
        return array_get(self::getContent(), 'users', []);
    }

    public static function setUsers($users)
    {
        $data = self::getContent();
        array_set($data, 'users', $users);
        self::putContent($data);
    }

    public static function getUserPassword($username)
    {
        return array_get(self::getUsers(), $username);
    }

    public static function makeUser($username, $password)
    {
        $users = self::getUsers();
        array_set($users, $username, $password);
        self::setUsers($users);
    }

    public static function getWhiteListIps()
    {
        return array_get(self::getContent(), 'whitelist', []);
    }

    public static function setWhiteListIps($ips)
    {
        $data = self::getContent();
        array_set($data, 'whitelist', array_unique($ips));
        self::putContent($data);
    }

    public static function addWhiteListIp($ip)
    {
        $ips   = self::getWhiteListIps();
        $ips[] = $ip;
        self::setWhiteListIps($ips);
    }

    public static function forgetWhiteListIp($ip)
    {
        $ips = self::getWhiteListIps();
        $ips = array_diff($ips, [$ip]);
        self::setWhiteListIps($ips);
    }

    public static function forgetUser($username)
    {
        $users = self::getUsers();
        array_forget($users, $username);
        self::setUsers($users);
    }
}