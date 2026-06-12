<?php
if (!function_exists('fitnessFusionConfig')) {
    function fitnessFusionConfig(string $key, $default = null)
    {
        static $config = null;

        if ($config === null) {
            $config = [
                'smtp_host' => getenv('FITNESS_FUSION_SMTP_HOST') ?: '',
                'smtp_port' => (int) (getenv('FITNESS_FUSION_SMTP_PORT') ?: 465),
                'smtp_username' => getenv('FITNESS_FUSION_SMTP_USERNAME') ?: '',
                'smtp_password' => getenv('FITNESS_FUSION_SMTP_PASSWORD') ?: '',
                'smtp_from' => getenv('FITNESS_FUSION_SMTP_FROM') ?: '',
                'smtp_to' => getenv('FITNESS_FUSION_SMTP_TO') ?: '',
            ];
        }

        return $config[$key] ?? $default;
    }
}
