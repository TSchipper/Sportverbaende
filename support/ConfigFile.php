<?php

/*
class ConfigSetting
{
    public $key;
    public $value;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function changeConfigSetting($key, $value)
    {
    }
}
*/

class ConfigFile
{
    public $configFilePathAndName;
    public $configSettings = array();

    public function __construct($configFilePathAndName)
    {
        $this->configFilePathAndName = $configFilePathAndName;

        /*
                $configFile = file_get_contents($configFilePathAndName);
                $configFileRows = explode(';', $configFile);

                foreach($configFileRows as $configFileRow) {
                    $splitRow = explode('=', $configFileRow);
                    $key =$splitRow[0];
                    $value =$splitRow[1];

                    $configSetting = new ConfigSetting($key, $value);
                    $this->configSettings[] = $configSetting;
                }
                */
    }

    public function getConfigSetting($configFilePathAndName, $requestedKey)
    {
        /*
        $result = null;
        foreach ($this->configSettings as $configSetting) {
            if ($configSetting->key == $key) {
                $result = $configSetting->value;
                echo "B I N G O<br>";
            }
        }
        echo $key." ".$result;
        return $result;
        */
        $result = null;
        $configFile = file_get_contents($configFilePathAndName);
        $configFileRows = explode(';', $configFile);

        foreach($configFileRows as $configFileRow) {
            $splitRow = explode('=', $configFileRow);
            $key =$splitRow[0];
            $value =$splitRow[1];
            if ($key == $requestedKey) {
                $result = $value;
            }
        }
        return $result;
    }

    /*
    mnb
    public function setConfigSetting($key)
    {
        $this->configSettings[$key]=$value;
    }

    public function addConfigSetting($key)
    {
        $this->configSettings[$key] = $value;
    }

    public function removeConfigSetting($key)
    {
        unset($this->configSettings[$key]);
    }
    */
}
