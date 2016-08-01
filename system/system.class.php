<?php

Class System
{
    protected static $user;

    public function __get($field)
    {
        if ($field === 'user')
        {
            if (self::$user === NULL)
            {
                self::$user = new ModelUser();
                self::$user->auth_flow();

            }
            return self::$user;
        }
    }
}