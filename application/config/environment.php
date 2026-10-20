<?php
/** Load env/.env.local or env/.env.prod before CodeIgniter starts. */
(function () {
    $directory = dirname(dirname(__DIR__)).'/env/';
    $environment = getenv('CI_ENV');
    if ($environment === FALSE && isset($_SERVER['CI_ENV']))
    {
        $environment = $_SERVER['CI_ENV'];
    }
    if ($environment === FALSE)
    {
        $environment = is_file($directory.'.env.local') ? 'development' : 'production';
    }
    if (!in_array($environment, array('development', 'testing', 'production'), TRUE))
    {
        throw new RuntimeException('CI_ENV must be development, testing, or production.');
    }
    putenv('CI_ENV='.$environment);
    $path = $directory.($environment === 'production' ? '.env.prod' : '.env.local');
    $lines = is_file($path) ? file($path, FILE_IGNORE_NEW_LINES) : array();
    foreach ($lines as $number => $line)
    {
        $line = trim($line);
        if ($line === '' || $line[0] === '#')
        {
            continue;
        }
        if (!preg_match('/^([A-Za-z_][A-Za-z0-9_]*)\s*=\s*(.*)$/', $line, $matches))
        {
            throw new RuntimeException('Invalid .env entry on line '.($number + 1));
        }
        $name = $matches[1];
        $value = trim($matches[2]);
        if ($value !== '' && ($value[0] === '"' || $value[0] === "'"))
        {
            if (strlen($value) < 2 || substr($value, -1) !== $value[0])
            {
                throw new RuntimeException('Unclosed .env quote on line '.($number + 1));
            }
            $value = substr($value, 1, -1);
        }
        // Existing process values win, including intentionally empty strings.
        if (getenv($name) === FALSE)
        {
            putenv($name.'='.(isset($_SERVER[$name]) ? $_SERVER[$name] : $value));
        }
    }
})();
