<?php

namespace Merkeleon\Laravel\HttpAuth;

use Storage;

class Helper
{
    public static function lockFile()
    {
        return 'httpauth';
    }

    public static function isLocked()
    {
        return self::lockFileExists() && (self::getRedirect() || count(self::getUsers()));
    }

    public static function lockFileExists()
    {
        return Storage::exists(self::lockFile());
    }

    private static function putContent($content) {
        if (!self::lockFileExists()) {
            Storage::put(self::lockFile(), json_encode($content));
        }
        Storage::put(self::lockFile(), json_encode($content));
    }

    private static function getContent()
    {
        if (!self::lockFileExists())
        {
            return [];
        }
        $content = Storage::get(self::lockFile());

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

    public static function makeRedirect($redirectUrl)
    {
        $data = self::getContent();
        array_set($data, 'redirect', $redirectUrl);
        self::putContent($data);
    }

    public static function getRedirect()
    {
        return array_get(self::getContent(), 'redirect');
    }
}