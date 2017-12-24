<?php
/**
 * A scws client
 *
 * @version 1.0.0
 * @author fenton ma
 * @package libscwsclient
 */
declare(strict_types = 1);

namespace Fenton\Scws;

final class Client
{

    const XDICT_TXT = SCWS_XDICT_TXT;

    const XDICT_XDB = SCWS_XDICT_XDB;

    const XDICT_MEM = SCWS_XDICT_MEM;

    const MULTI_SHORT = SCWS_MULTI_SHORT;

    const MULTI_DUALITY = SCWS_MULTI_DUALITY;

    const MULTI_ZMAIN = SCWS_MULTI_ZMAIN;

    const MULTI_ZALL = SCWS_MULTI_ZALL;

    protected static $instance = null;

    protected static $scwsObject = null;

    protected $string = null;

    protected function __construct(){}

    public static function getInstance()
    {
        if (!is_null(self::$instance)) {
            return self::$instance;
        }
        if (extension_loaded("scws")) {
            self::$scwsObject = scws_new();
            self::$instance = new self;
            return self::$instance;
        }
        return false;
    }

    public function setCharset(string $charset)
    {
        if (!is_null(self::$scwsObject)) {
            return self::$scwsObject->set_charset($charset);
        }
        return false;
    }

    public function addDict(string $dictPath, int $mode = SCWS_XDICT_XDB)
    {
        if (!is_null(self::$scwsObject)) {
            return self::$scwsObject->add_dict($dictPath, $mode);
        }
        return false;
    }

    public function setDict(string $dictPath, int $mode = SCWS_XDICT_XDB)
    {
        if (!is_null(self::$scwsObject)) {
            return self::$scwsObject->set_dict($dictPath, $mode);
        }
        return false;
    }

    public function setRule(string $rulePath)
    {
        if (!is_null(self::$scwsObject)) {
            return self::$scwsObject->set_rule($rulePath);
        }
        return false;
    }

    public function setIgnore(bool $bool)
    {
        if (!is_null(self::$scwsObject)) {
            return self::$scwsObject->set_ignore($bool);
        }
        return false;
    }

    public function setMulti(int $mode)
    {
        if (!is_null(self::$scwsObject)) {
            return self::$scwsObject->set_multi($mode);
        }
        return false;
    }

    public function setDuality(bool $bool)
    {
        if (!is_null(self::$scwsObject)) {
            return self::$scwsObject->set_duality($bool);
        }
        return false;
    }

    public function getResult(string $string = null)
    {
        if (!is_null(self::$scwsObject)) {
            if (is_string($string)) {
                $this->string = $string;
                self::$scwsObject->send_text($this->string);
                return self::$scwsObject->get_result();
            } elseif (is_null($string) && is_string($this->string)) {
                return self::$scwsObject->get_result();
            }
        }
        return false;
    }

    public function getTops(string $attr = null, string $string = null, int $limit = 10)
    {
        if (!is_null(self::$scwsObject)) {
            if (is_string($string)) {
                $this->string = $string;
                self::$scwsObject->send_text($this->string);
                return self::$scwsObject->get_tops($limit, $attr);
            } elseif (is_null($string) && is_string($this->string)) {
                self::$scwsObject->send_text($this->string);
                return self::$scwsObject->get_tops($limit, $attr);
            }
        }
        return false;
    }

    public function getWords(string $attr, string $string = null)
    {
        if (!is_null(self::$scwsObject)) {
            if (is_string($string)) {
                $this->string = $string;
                self::$scwsObject->send_text($this->string);
                return self::$scwsObject->get_words($attr);
            } elseif (is_null($string) && is_string($this->string)) {
                self::$scwsObject->send_text($this->string);
                return self::$scwsObject->get_words($attr);
            }
        }
        return false;
    }

    public function hasWords(string $attr, string $string = null)
    {
        if (!is_null(self::$scwsObject)) {
            if (is_string($string)) {
                $this->string = $string;
                self::$scwsObject->send_text($this->string);
                return self::$scwsObject->has_words($attr);
            } elseif (is_null($string) && is_string($this->string)) {
                self::$scwsObject->send_text($this->string);
                return self::$scwsObject->has_words($attr);
            }
        }
        return false;
    }

    public function version()
    {
        if (!is_null(self::$scwsObject)) {
            return self::$scwsObject->version();
        }
        return false;
    }

    public function close()
    {
        if (!is_null(self::$scwsObject)) {
            self::$scwsObject->close();
        }
    }

    protected function __clone(){}

    public function __destrcut()
    {
        $this->close();
    }

}
