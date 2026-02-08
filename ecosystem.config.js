module.exports = {
  apps: [
    {
      name: 'stage-pari-main',
      script: '/www/server/php/83/bin/php',
      args: [
        '/www/wwwroot/stage.pari-kz24.com/artisan',
        'serve',
        '--host=127.0.0.1',
        '--port=8003'
      ],
      cwd: '/www/wwwroot/stage.pari-kz24.com',
      instances: 1,
      autorestart: true,
      watch: false,
      max_memory_restart: '1G',
      error_file: '/root/.pm2/logs/stage-pari-main-error.log',
      out_file: '/root/.pm2/logs/stage-pari-main-out.log',
      log_date_format: 'YYYY-MM-DD HH:mm:ss Z',
      merge_logs: true,
      env: {
        APP_ENV: 'staging',
        APP_DEBUG: 'true'
      }
    },
    {
      name: 'stage-pari-admin',
      script: '/www/server/php/83/bin/php',
      args: [
        '/www/wwwroot/stage.pari-kz24.com/artisan',
        'serve',
        '--host=127.0.0.1',
        '--port=8004'
      ],
      cwd: '/www/wwwroot/stage.pari-kz24.com',
      instances: 1,
      autorestart: true,
      watch: false,
      max_memory_restart: '1G',
      error_file: '/root/.pm2/logs/stage-pari-admin-error.log',
      out_file: '/root/.pm2/logs/stage-pari-admin-out.log',
      log_date_format: 'YYYY-MM-DD HH:mm:ss Z',
      merge_logs: true,
      env: {
        APP_ENV: 'staging',
        APP_DEBUG: 'true'
      }
    }
  ]
};

