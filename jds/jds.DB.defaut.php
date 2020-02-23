<?php
class DB
{

    protected static $myServer = "109.234.164.74";
    protected static $myUser = "zaah7051_jds_Defaut";
    protected static $myPassword = "2WI87U3ITszQ";
    protected static $myDB = "zaah7051_jds";
    protected static $myPort = 3306;

    private static $_instance = NULL;

    public static function connexion ()
    {
        if (is_null (self::$_instance))
        {
            self::$_instance = new mysqli(self::$myServer, self::$myUser, self::$myPassword, self::$myDB, self::$myPort);
                /* check connection */
            if (self::$_instance->connect_errno) {
                printf("Connection failed: %s\n", self::$_instance->connect_error);
                exit();
            }
			self::$_instance->autocommit(FALSE);
        }
        return self::$_instance;
    }

    public static function deconnexion ()
    {
        if (!is_null (self::$_instance))
        {
            self::$_instance->close ();
            self::$_instance = NULL;
        }
    }
} // myDB

