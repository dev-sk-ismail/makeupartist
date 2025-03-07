<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * @property string $fromEmail
 * @property string $fromName
 * @property string $recipients
 * @property string $userAgent
 * @property string $protocol
 * @property string $mailPath
 * @property string $SMTPHost
 * @property string $SMTPUser
 * @property string $SMTPPass
 * @property int $SMTPPort
 * @property int $SMTPTimeout
 * @property bool $SMTPKeepAlive
 * @property string $SMTPCrypto
 * @property bool $wordWrap
 * @property int $wrapChars
 * @property string $mailType
 * @property string $charset
 * @property bool $validate
 * @property int $priority
 * @property string $CRLF
 * @property string $newline
 * @property bool $BCCBatchMode
 * @property int $BCCBatchSize
 * @property bool $DSN
 */
class Email extends BaseConfig
{
    public string $fromEmail  = 'dev.sk.ismail@gmail.com';
    public string $fromName   = 'Makeup Artist Hena';
    public string $recipients = '';
    public string $userAgent = 'CodeIgniter';
    public string $protocol = 'smtp';
    public string $mailPath = '/usr/sbin/sendmail';
    public string $SMTPHost = 'smtp.gmail.com';
    public string $SMTPUser = 'dev.sk.ismail@gmail.com';
    public string $SMTPPass = 'utdfkbcctrquiimq'; // Use an app-specific password here
    public int $SMTPPort = 465;
    public int $SMTPTimeout = 5;
    public bool $SMTPKeepAlive = false;
    public string $SMTPCrypto = 'ssl';
    public bool $wordWrap = true;
    public int $wrapChars = 76;
    public string $mailType = 'html';
    public string $charset = 'UTF-8';
    public bool $validate = false;
    public int $priority = 3;
    public string $CRLF = "\r\n";
    public string $newline = "\r\n";
    public bool $BCCBatchMode = false;
    public int $BCCBatchSize = 200;
    public bool $DSN = false;
}
